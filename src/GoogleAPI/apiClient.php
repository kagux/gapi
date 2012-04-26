<?php
/*
 * Copyright 2010 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace GoogleAPI;

use GoogleAPI\Cache\apiCache;
use GoogleAPI\IO\apiIO;
use GoogleAPI\Auth\apiAuth;

// Check for the required json and curl extensions, the Google API PHP Client won't function without them.
if (! function_exists('curl_init')) {
  throw new \Exception('Google PHP API Client requires the CURL PHP extension');
}

if (! function_exists('json_decode')) {
  throw new \Exception('Google PHP API Client requires the JSON PHP extension');
}

if (! function_exists('http_build_query')) {
  throw new \Exception('Google PHP API Client requires http_build_query()');
}

if (! ini_get('date.timezone') && function_exists('date_default_timezone_set')) {
  date_default_timezone_set('UTC');
}

/**
 * The Google API Client
 * http://code.google.com/p/google-api-php-client/
 *
 * @author Chris Chabot <chabotc@google.com>
 * @author Chirag Shah <chirags@google.com>
 */
class apiClient {
  // the version of the discovery mechanism this class is meant to work with
  const discoveryVersion = 'v0.3';

  /**
   * @static
   * @var apiAuth $auth
   */
  static $auth;

  /** @var apiIo $io */
  static $io;

  /** @var apiCache $cache */
  static $cache;

  /** @var array $scopes */
  protected $scopes = array();

  /** @var bool $useObjects */
  protected $useObjects = false;

  // definitions of services that are discovered.
  protected $services = array();

  // Used to track authenticated state, can't discover services after doing authenticate()
  private $authenticated = false;

  private $defaultService = array(
      'authorization_token_url' => 'https://www.google.com/accounts/OAuthAuthorizeToken',
      'request_token_url' => 'https://www.google.com/accounts/OAuthGetRequestToken',
      'access_token_url' => 'https://www.google.com/accounts/OAuthGetAccessToken');


  public function __construct(apiAuth $auth, apiIO $apiIO, apiCache $cache) {
    self::$cache = $cache;
    self::$auth = $auth;
    self::$io = $apiIO;
  }

  public function discover($service, $version = 'v1') {
    $this->addService($service, $version);
    $this->$service = $this->discoverService($service, $this->services[$service]['discoveryURI']);
    return $this->$service;
  }

    /**
     * Add a service
     * @param $service
     * @param $version
     * @throws apiException
     */
  public function addService($service, $version) {
    global $apiConfig;
    if ($this->authenticated) {
      // Adding services after being authenticated, since the oauth scope is already set (so you wouldn't have access to that data)
      throw new apiException('Cant add services after having authenticated');
    }
    $this->services[$service] = $this->defaultService;
    if (isset($apiConfig['services'][$service])) {
      // Merge the service descriptor with the default values
      $this->services[$service] = array_merge($this->services[$service], $apiConfig['services'][$service]);
    }
    $this->services[$service]['discoveryURI'] = $apiConfig['basePath'] . '/discovery/' . self::discoveryVersion . '/describe/' . urlencode($service) . '/' . urlencode($version);
  }

  /**
   * Set the type of Auth class the client should use.
   * @param string $authClassName
   */
  public function setAuthClass($authClassName) {
    self::$auth = new $authClassName();
  }

  public function authenticate() {
    $service = $this->prepareService();
    $this->authenticated = true;
    return self::$auth->authenticate($service);
  }

  /**
   * Construct the OAuth 2.0 authorization request URI.
   * @return string 
   */
  public function createAuthUrl() {
    $service = $this->prepareService();
    return self::$auth->createAuthUrl($service['scope']);
  }

  private function prepareService() {
    $service = $this->defaultService;
    $scopes = array();
    if ($this->scopes) {
      $scopes = $this->scopes;
    } else {
      foreach ($this->services as $key => $val) {
        if (isset($val['scope'])) {
          if (is_array($val['scope'])) {
            $scopes = array_merge($val['scope'], $scopes);
          } else {
            $scopes[] = $val['scope'];
          }
        } else {
          $scopes[] = 'https://www.googleapis.com/auth/' . $key;
        }
        unset($val['discoveryURI']);
        unset($val['scope']);
        $service = array_merge($service, $val);
      }
    }
    $service['scope'] = implode(' ', $scopes);
    return $service;
  }

  /**
   * Set the OAuth 2.0 access token using the string that resulted from calling authenticate()
   * or apiClient#getAccessToken().
   * @param string $accessToken JSON encoded string containing in the following format:
   * {"access_token":"TOKEN", "refresh_token":"TOKEN", "token_type":"Bearer",
   *  "expires_in":3600, "id_token":"TOKEN", "created":1320790426}
   */
  public function setAccessToken($accessToken) {
    if ($accessToken == null || 'null' == $accessToken) {
      $accessToken = null;
    }
    self::$auth->setAccessToken($accessToken);
  }

  /**
   * Get the OAuth 2.0 access token.
   * @return string $accessToken JSON encoded string in the following format:
   * {"access_token":"TOKEN", "refresh_token":"TOKEN", "token_type":"Bearer",
   *  "expires_in":3600,"id_token":"TOKEN", "created":1320790426}
   */
  public function getAccessToken() {
    $token = self::$auth->getAccessToken();
    return (null == $token || 'null' == $token) ? null : $token;
  }

  /**
   * Set the developer key to use, these are obtained through the API Console.
   * @see http://code.google.com/apis/console-help/#generatingdevkeys
   * @param string $developerKey
   */
  public function setDeveloperKey($developerKey) {
    self::$auth->setDeveloperKey($developerKey);
  }

  /**
   * Set OAuth 2.0 "state" parameter to achieve per-request customization.
   * @see http://tools.ietf.org/html/draft-ietf-oauth-v2-22#section-3.1.2.2
   * @param string $state
   */
  public function setState($state) {
    self::$auth->setState($state);
  }

  /**
   * @param string $accessType Possible values for access_type include:
   *  {@code "offline"} to request offline access from the user. (This is the default value)
   *  {@code "online"} to request online access from the user.
   */
  public function setAccessType($accessType) {
    self::$auth->setAccessType($accessType);
  }

  /**
   * @param string $approvalPrompt Possible values for approval_prompt include:
   *  {@code "force"} to force the approval UI to appear. (This is the default value)
   *  {@code "auto"} to request auto-approval when possible.
   */
  public function setApprovalPrompt($approvalPrompt) {
    self::$auth->setApprovalPrompt($approvalPrompt);
  }

  /**
   * Set the application name, this is included in the User-Agent HTTP header.
   * @param string $applicationName
   */
  public function setApplicationName($applicationName) {
    global $apiConfig;
    $apiConfig['application_name'] = $applicationName;
  }

  /**
   * Set the OAuth 2.0 Client ID.
   * @param string $clientId
   */
  public function setClientId($clientId) {
    global $apiConfig;
    $apiConfig['oauth2_client_id'] = $clientId;
    self::$auth->clientId = $clientId;
  }
  
  /**
   * Set the OAuth 2.0 Client Secret.
   * @param string $clientSecret
   */
  public function setClientSecret($clientSecret) {
    global $apiConfig;
    $apiConfig['oauth2_client_secret'] = $clientSecret;
    self::$auth->clientSecret = $clientSecret;
  }

  /**
   * Set the OAuth 2.0 Redirect URI.
   * @param string $redirectUri
   */
  public function setRedirectUri($redirectUri) {
    global $apiConfig;
    $apiConfig['oauth2_redirect_uri'] = $redirectUri;
    self::$auth->redirectUri = $redirectUri;
  }

  /**
   * Fetches a fresh OAuth 2.0 access token with the given refresh token.
   * @param string $refreshToken
   * @return void
   */
  public function refreshToken($refreshToken) {
    self::$auth->refreshToken($refreshToken);
  }

  /**
   * Revoke an OAuth2 access token or refresh token. This method will revoke the current access
   * token, if a token isn't provided.
   * @throws apiAuthException
   * @param string|null $token The token (access token or a refresh token) that should be revoked.
   * @return boolean Returns True if the revocation was successful, otherwise False.
   */
  public function revokeToken($token = null) {
    self::$auth->revokeToken($token);
  }

  /**
   * Verify an id_token. This method will verify the current id_token, if one
   * isn't provided.
   * @throws apiAuthException
   * @param string|null $token The token (id_token) that should be verified.
   * @return apiLoginTicket Returns an apiLoginTicket if the verification was
   * successful.
   */
  public function verifyIdToken($token = null) {
    return self::$auth->verifyIdToken($token);
  }

  /**
   * This function allows you to overrule the automatically generated scopes,
   * so that you can ask for more or less permission in the auth flow
   * Set this before you call authenticate() though!
   * @param array $scopes, ie: array('https://www.googleapis.com/auth/plus', 'https://www.googleapis.com/auth/moderator')
   */
  public function setScopes($scopes) {
    $this->scopes = is_string($scopes) ? explode(" ", $scopes) : $scopes;
  }

  /**
   * Declare if objects should be returned by the api service classes.
   *
   * @param boolean $useObjects True if objects should be returned by the service classes.
   * False if associative arrays should be returned (default behavior).
   */
  public function setUseObjects($useObjects) {
    global $apiConfig;
    $apiConfig['use_objects'] = $useObjects;
  }

  private function discoverService($serviceName, $serviceURI) {
    $request = self::$io->makeRequest(new apiHttpRequest($serviceURI));
    if ($request->getResponseHttpCode() != 200) {
      throw new apiException("Could not fetch discovery document for $serviceName, code: "
            . $request->getResponseHttpCode() . ", response: " . $request->getResponseBody());
    }
    $discoveryResponse = $request->getResponseBody();
    $discoveryDocument = json_decode($discoveryResponse, true);
    if ($discoveryDocument == NULL) {
      throw new apiException("Invalid json returned for $serviceName");
    }
    return new apiService($serviceName, $discoveryDocument, apiClient::getIo());
  }

  /**
   * @static
   * @return apiAuth the implementation of apiAuth.
   */
  public static function getAuth() {
    return apiClient::$auth;
  }

  /**
   * @static
   * @return apiIo the implementation of apiIo.
   */
  public static function getIo() {
    return apiClient::$io;
  }

  /**
   * @return apiCache the implementation of apiCache.
   */
  public function getCache() {
    return apiClient::$cache;
  }

    /**
     * Default configurations
     * @return array
     */
  private function defaultConfig() {
      return array(
          // True if objects should be returned by the service classes.
          // False if associative arrays should be returned (default behavior).
          'use_objects' => false,

          // The application_name is included in the User-Agent HTTP header.
          'application_name' => '',

          // OAuth2 Settings, you can get these keys at https://code.google.com/apis/console
          'oauth2_client_id' => '',
          'oauth2_client_secret' => '',
          'oauth2_redirect_uri' => '',

          // The developer key, you get this at https://code.google.com/apis/console
          'developer_key' => '',

          // OAuth1 Settings.
          // If you're using the apiOAuth auth class, it will use these values for the oauth consumer key and secret.
          // See http://code.google.com/apis/accounts/docs/RegistrationForWebAppsAuto.html for info on how to obtain those
          'oauth_consumer_key'    => 'anonymous',
          'oauth_consumer_secret' => 'anonymous',

          // Site name to show in the Google's OAuth 1 authentication screen.
          'site_name' => 'www.example.org',

          // Which Authentication, Storage and HTTP IO classes to use.
          'authClass'    => 'GoogleAPI\Auth\apiOAuth2',
          'ioClass'      => 'GoogleAPI\IO\apiCurlIO',
          'cacheClass'   => 'GoogleAPI\Cache\apiFileCache',

          // If you want to run the test suite (by running # phpunit AllTests.php in the tests/ directory), fill in the settings below
          'oauth_test_token' => '', // the oauth access token to use (which you can get by runing authenticate() as the test user and copying the token value), ie '{"key":"foo","secret":"bar","callback_url":null}'
          'oauth_test_user' => '', // and the user ID to use, this can either be a vanity name 'testuser' or a numberic ID '123456'

          // Don't change these unless you're working against a special development or testing environment.
          'basePath' => 'https://www.googleapis.com',

          // IO Class dependent configuration, you only have to configure the values for the class that was configured as the ioClass above
          'ioFileCache_directory'  =>
          (function_exists('sys_get_temp_dir') ?
              sys_get_temp_dir() . '/apiClient' :
              '/tmp/apiClient'),
          'ioMemCacheStorage_host' => '127.0.0.1',
          'ioMemcacheStorage_port' => '11211',

          // Definition of service specific values like scopes, oauth token URLs, etc
          'services' => array(
              'analytics' => array('scope' => 'https://www.googleapis.com/auth/analytics.readonly'),
              'calendar' => array(
                  'scope' => array(
                      "https://www.googleapis.com/auth/calendar",
                      "https://www.googleapis.com/auth/calendar.readonly",
                  )
              ),
              'books' => array('scope' => 'https://www.googleapis.com/auth/books'),
              'latitude' => array(
                  'scope' => array(
                      'https://www.googleapis.com/auth/latitude.all.best',
                      'https://www.googleapis.com/auth/latitude.all.city',
                  )
              ),
              'moderator' => array('scope' => 'https://www.googleapis.com/auth/moderator'),
              'oauth2' => array(
                  'scope' => array(
                      'https://www.googleapis.com/auth/userinfo.profile',
                      'https://www.googleapis.com/auth/userinfo.email',
                  )
              ),
              'plus' => array('scope' => 'https://www.googleapis.com/auth/plus.me'),
              'siteVerification' => array('scope' => 'https://www.googleapis.com/auth/siteverification'),
              'tasks' => array('scope' => 'https://www.googleapis.com/auth/tasks'),
              'urlshortener' => array('scope' => 'https://www.googleapis.com/auth/urlshortener')
          )
      );
  }
}

// Exceptions that the Google PHP API Library can throw
class apiException extends \Exception {}
class apiAuthException extends apiException {}
class apiCacheException extends apiException {}
class apiIOException extends apiException {}
class apiServiceException extends apiException {}
