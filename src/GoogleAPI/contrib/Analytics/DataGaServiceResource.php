<?php

namespace GoogleAPI\Contrib\Analytics;
use GoogleAPI\Service\apiServiceResource;

/**
 * The "ga" collection of methods.
 * Typical usage is:
 *  <code>
 *   $analyticsService = new apiAnalyticsService(...);
 *   $ga = $analyticsService->ga;
 *  </code>
 */
class DataGaServiceResource extends apiServiceResource {


    /**
     * Returns Analytics data for a profile. (ga.get)
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
    public function get($ids, $start_date, $end_date, $metrics, $optParams = array()) {
        $params = array('ids' => $ids, 'start-date' => $start_date, 'end-date' => $end_date, 'metrics' => $metrics);
        $params = array_merge($params, $optParams);
        $data = $this->__call('get', array($params));
        if ($this->useObjects()) {
            return new GaData($data);
        } else {
            return $data;
        }
    }
}
