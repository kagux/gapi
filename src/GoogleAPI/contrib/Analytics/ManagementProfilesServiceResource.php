<?php
namespace GoogleAPI\Contrib\Analytics;
use GoogleAPI\Service\apiServiceResource;

/**
 * The "profiles" collection of methods.
 * Typical usage is:
 *  <code>
 *   $analyticsService = new apiAnalyticsService(...);
 *   $profiles = $analyticsService->profiles;
 *  </code>
 */
class ManagementProfilesServiceResource extends apiServiceResource {


    /**
     * Lists profiles to which the user has access. (profiles.list)
     *
     * @param string $accountId Account ID for the web properties to retrieve. Can either be a specific account ID or '~all', which refers to all the accounts to which the user has access.
     * @param string $webPropertyId Web property ID for the web properties to retrieve. Can either be a specific web property ID or '~all', which refers to all the web properties to which the user has access.
     * @param array $optParams Optional parameters. Valid optional parameters are listed below.
     *
     * @opt_param int max-results The maximum number of entries to include in this response.
     * @opt_param int start-index An index of the first entity to retrieve. Use this parameter as a pagination mechanism along with the max-results parameter.
     * @return Profiles
     */
    public function listManagementProfiles($accountId, $webPropertyId, $optParams = array()) {
        $params = array('accountId' => $accountId, 'webPropertyId' => $webPropertyId);
        $params = array_merge($params, $optParams);
        $data = $this->__call('list', array($params));
        if ($this->useObjects()) {
            return new Profiles($data);
        } else {
            return $data;
        }
    }
}