<?php
namespace GoogleAPI\Contrib\Analytics;
use GoogleAPI\Service\apiServiceResource;

/**
 * The "segments" collection of methods.
 * Typical usage is:
 *  <code>
 *   $analyticsService = new apiAnalyticsService(...);
 *   $segments = $analyticsService->segments;
 *  </code>
 */
class ManagementSegmentsServiceResource extends apiServiceResource {


    /**
     * Lists advanced segments to which the user has access. (segments.list)
     *
     * @param array $optParams Optional parameters. Valid optional parameters are listed below.
     *
     * @opt_param int max-results The maximum number of entries to include in this response.
     * @opt_param int start-index An index of the first entity to retrieve. Use this parameter as a pagination mechanism along with the max-results parameter.
     * @return Segments
     */
    public function listManagementSegments($optParams = array()) {
        $params = array();
        $params = array_merge($params, $optParams);
        $data = $this->__call('list', array($params));
        if ($this->useObjects()) {
            return new Segments($data);
        } else {
            return $data;
        }
    }
}

