<?php
/*
 * Copyright (c) 2010 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */
namespace GoogleAPI\Contrib;

use GoogleAPI\Service\apiServiceResource;
use GoogleAPI\Contrib\Analytics\ManagementSegmentsServiceResource;
use GoogleAPI\Contrib\Analytics\DataGaServiceResource;
use GoogleAPI\Contrib\Analytics\ManagementProfilesServiceResource;
use GoogleAPI\Contrib\Analytics\ManagementGoalsServiceResource;
use GoogleAPI\Contrib\Analytics\ManagementAccountsServiceResource;
use GoogleAPI\Contrib\Analytics\ManagementWebpropertiesServiceResource;
use GoogleAPI\Service\apiService;
use GoogleAPI\Service\apiModel;
use GoogleAPI\apiClient;


/**
 * Service definition for Analytics (v3).
 *
 * <p>
 * View and manage your Google Analytics data
 * </p>
 *
 * <p>
 * For more information about this service, see the
 * <a href="http://code.google.com/apis/analytics" target="_blank">API Documentation</a>
 * </p>
 *
 * @author Google, Inc.
 */
class apiAnalyticsService extends apiService {
  public $management_webproperties;
  public $management_segments;
  public $management_accounts;
  public $management_goals;
  public $management_profiles;
  public $data_ga;
  /**
   * Constructs the internal representation of the Analytics service.
   *
   * @param apiClient apiClient
   */
  public function __construct(apiClient $apiClient) {
    $this->rpcPath = '/rpc';
    $this->restBasePath = '/analytics/v3/';
    $this->version = 'v3';
    $this->serviceName = 'analytics';

    $apiClient->addService($this->serviceName, $this->version);
    $this->management_webproperties = new ManagementWebpropertiesServiceResource($this, $this->serviceName, 'webproperties', json_decode('{"methods": {"list": {"scopes": ["https://www.googleapis.com/auth/analytics.readonly"], "parameters": {"max-results": {"format": "int32", "type": "integer", "location": "query"}, "start-index": {"format": "int32", "minimum": "1", "type": "integer", "location": "query"}, "accountId": {"required": true, "type": "string", "location": "path"}}, "id": "analytics.management.webproperties.list", "httpMethod": "GET", "path": "management/accounts/{accountId}/webproperties", "response": {"$ref": "Webproperties"}}}}', true));
    $this->management_segments = new ManagementSegmentsServiceResource($this, $this->serviceName, 'segments', json_decode('{"methods": {"list": {"scopes": ["https://www.googleapis.com/auth/analytics.readonly"], "parameters": {"max-results": {"format": "int32", "type": "integer", "location": "query"}, "start-index": {"format": "int32", "minimum": "1", "type": "integer", "location": "query"}}, "response": {"$ref": "Segments"}, "httpMethod": "GET", "path": "management/segments", "id": "analytics.management.segments.list"}}}', true));
    $this->management_accounts = new ManagementAccountsServiceResource($this, $this->serviceName, 'accounts', json_decode('{"methods": {"list": {"scopes": ["https://www.googleapis.com/auth/analytics.readonly"], "parameters": {"max-results": {"format": "int32", "type": "integer", "location": "query"}, "start-index": {"format": "int32", "minimum": "1", "type": "integer", "location": "query"}}, "response": {"$ref": "Accounts"}, "httpMethod": "GET", "path": "management/accounts", "id": "analytics.management.accounts.list"}}}', true));
    $this->management_goals = new ManagementGoalsServiceResource($this, $this->serviceName, 'goals', json_decode('{"methods": {"list": {"scopes": ["https://www.googleapis.com/auth/analytics.readonly"], "parameters": {"max-results": {"format": "int32", "type": "integer", "location": "query"}, "profileId": {"required": true, "type": "string", "location": "path"}, "start-index": {"format": "int32", "minimum": "1", "type": "integer", "location": "query"}, "accountId": {"required": true, "type": "string", "location": "path"}, "webPropertyId": {"required": true, "type": "string", "location": "path"}}, "id": "analytics.management.goals.list", "httpMethod": "GET", "path": "management/accounts/{accountId}/webproperties/{webPropertyId}/profiles/{profileId}/goals", "response": {"$ref": "Goals"}}}}', true));
    $this->management_profiles = new ManagementProfilesServiceResource($this, $this->serviceName, 'profiles', json_decode('{"methods": {"list": {"scopes": ["https://www.googleapis.com/auth/analytics.readonly"], "parameters": {"max-results": {"format": "int32", "type": "integer", "location": "query"}, "start-index": {"format": "int32", "minimum": "1", "type": "integer", "location": "query"}, "accountId": {"required": true, "type": "string", "location": "path"}, "webPropertyId": {"required": true, "type": "string", "location": "path"}}, "id": "analytics.management.profiles.list", "httpMethod": "GET", "path": "management/accounts/{accountId}/webproperties/{webPropertyId}/profiles", "response": {"$ref": "Profiles"}}}}', true));
    $this->data_ga = new DataGaServiceResource($this, $this->serviceName, 'ga', json_decode('{"methods": {"get": {"scopes": ["https://www.googleapis.com/auth/analytics.readonly"], "parameters": {"max-results": {"format": "int32", "type": "integer", "location": "query"}, "sort": {"type": "string", "location": "query"}, "dimensions": {"type": "string", "location": "query"}, "start-date": {"required": true, "type": "string", "location": "query"}, "start-index": {"format": "int32", "minimum": "1", "type": "integer", "location": "query"}, "end-date": {"required": true, "type": "string", "location": "query"}, "ids": {"required": true, "type": "string", "location": "query"}, "metrics": {"required": true, "type": "string", "location": "query"}, "filters": {"type": "string", "location": "query"}, "segment": {"type": "string", "location": "query"}}, "id": "analytics.data.ga.get", "httpMethod": "GET", "path": "data/ga", "response": {"$ref": "GaData"}}}}', true));
  }

    /** Returns Analytics data for a profile. (ga.get)
     *
     * @param string $ids Unique table ID for retrieving Analytics data. Table ID is of the form ga:XXXX, where XXXX is the Analytics profile ID.
     * @param string $start_date Start date for fetching Analytics data. All requests should specify a start date formatted as YYYY-MM-DD.
     * @param string $end_date End date for fetching Analytics data. All requests should specify an end date formatted as YYYY-MM-DD.
     * @param string $metrics A comma-separated list of Analytics metrics. E.g., 'ga:visits,ga:pageviews'. At least one metric must be specified.
     * @param array $optParams Optional parameters. Valid optional parameters are listed below.
     *
     * @opt_param int max-results The maximum number of entries to include in this feed.
     * @opt_param string sort A comma-separated list of dimensions or metrics that determine the sort order for Analytics data.
     * @opt_param string dimensions A comma-separated list of Analytics dimensions. E.g., 'ga:browser,ga:city'.
     * @opt_param int start-index An index of the first entity to retrieve. Use this parameter as a pagination mechanism along with the max-results parameter.
     * @opt_param string segment An Analytics advanced segment to be applied to data.
     * @opt_param string filters A comma-separated list of dimension or metric filters to be applied to Analytics data.
     * @return GaData
     */
    public function getAnalyticsData($ids, $start_date, $end_date, $metrics, $optParams = array()) {
        return $this->data_ga->get($ids, $start_date, $end_date,$metrics, $optParams);
    }

}






