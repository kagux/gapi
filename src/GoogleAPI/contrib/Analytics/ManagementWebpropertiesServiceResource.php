<?php
namespace GoogleAPI\Contrib\Analytics;
use GoogleAPI\Service\apiServiceResource;

/**
 * The "webproperties" collection of methods.
 * Typical usage is:
 *  <code>
 *   $analyticsService = new apiAnalyticsService(...);
 *   $webproperties = $analyticsService->webproperties;
 *  </code>
 */
class ManagementWebpropertiesServiceResource extends apiServiceResource {


    /**
     * Lists web properties to which the user has access. (webproperties.list)
     *
     * @param string $accountId Account ID for the web properties to retrieve. Can either be a specific account ID or '~all', which refers to all the accounts to which user has access.
     * @param array $optParams Optional parameters. Valid optional parameters are listed below.
     *
     * @opt_param int max-results The maximum number of entries to include in this response.
     * @opt_param int start-index An index of the first entity to retrieve. Use this parameter as a pagination mechanism along with the max-results parameter.
     * @return Webproperties
     */
    public function listManagementWebproperties($accountId, $optParams = array()) {
        $params = array('accountId' => $accountId);
        $params = array_merge($params, $optParams);
        $data = $this->__call('list', array($params));
        if ($this->useObjects()) {
            return new Webproperties($data);
        } else {
            return $data;
        }
    }
}
