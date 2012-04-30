<?php
namespace GoogleAPI\Contrib\Analytics;
use GoogleAPI\Service\apiModel;
class GaData extends apiModel {
    public $kind;
    public $rows;
    public $containsSampledData;
    public $totalResults;
    public $itemsPerPage;
    public $totalsForAllResults;
    public $nextLink;
    public $id;
    protected $__queryType = '\GoogleAPI\Contrib\Analytics\GaDataQuery';
    protected $__queryDataType = '';
    public $query;
    public $previousLink;
    protected $__profileInfoType = '\GoogleAPI\Contrib\Analytics\GaDataProfileInfo';
    protected $__profileInfoDataType = '';
    public $profileInfo;
    protected $__columnHeadersType = '\GoogleAPI\Contrib\Analytics\GaDataColumnHeaders';
    protected $__columnHeadersDataType = 'array';
    public $columnHeaders;
    public $selfLink;
    public function setKind($kind) {
        $this->kind = $kind;
    }
    public function getKind() {
        return $this->kind;
    }
    public function setRows(/* array(string) */ $rows) {
        $this->assertIsArray($rows, 'string', __METHOD__);
        $this->rows = $rows;
    }
    public function getRows() {
        return $this->rows;
    }
    public function setContainsSampledData($containsSampledData) {
        $this->containsSampledData = $containsSampledData;
    }
    public function getContainsSampledData() {
        return $this->containsSampledData;
    }
    public function setTotalResults($totalResults) {
        $this->totalResults = $totalResults;
    }
    public function getTotalResults() {
        return $this->totalResults;
    }
    public function setItemsPerPage($itemsPerPage) {
        $this->itemsPerPage = $itemsPerPage;
    }
    public function getItemsPerPage() {
        return $this->itemsPerPage;
    }
    public function setTotalsForAllResults($totalsForAllResults) {
        $this->totalsForAllResults = $totalsForAllResults;
    }
    public function getTotalsForAllResults() {
        return $this->totalsForAllResults;
    }
    public function setNextLink($nextLink) {
        $this->nextLink = $nextLink;
    }
    public function getNextLink() {
        return $this->nextLink;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function getId() {
        return $this->id;
    }
    public function setQuery(GaDataQuery $query) {
        $this->query = $query;
    }
    public function getQuery() {
        return $this->query;
    }
    public function setPreviousLink($previousLink) {
        $this->previousLink = $previousLink;
    }
    public function getPreviousLink() {
        return $this->previousLink;
    }
    public function setProfileInfo(GaDataProfileInfo $profileInfo) {
        $this->profileInfo = $profileInfo;
    }
    public function getProfileInfo() {
        return $this->profileInfo;
    }
    public function setColumnHeaders(/* array(GaDataColumnHeaders) */ $columnHeaders) {
        $this->assertIsArray($columnHeaders, 'GaDataColumnHeaders', __METHOD__);
        $this->columnHeaders = $columnHeaders;
    }
    public function getColumnHeaders() {
        return $this->columnHeaders;
    }
    public function setSelfLink($selfLink) {
        $this->selfLink = $selfLink;
    }
    public function getSelfLink() {
        return $this->selfLink;
    }
}
