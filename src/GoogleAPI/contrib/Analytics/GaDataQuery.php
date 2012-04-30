<?php
namespace GoogleAPI\Contrib\Analytics;
use GoogleAPI\Service\apiModel;


class GaDataQuery extends apiModel {
    public $max_results;
    public $sort;
    public $dimensions;
    public $start_date;
    public $start_index;
    public $segment;
    public $ids;
    public $metrics;
    public $filters;
    public $end_date;
    public function setMax_results($max_results) {
        $this->max_results = $max_results;
    }
    public function getMax_results() {
        return $this->max_results;
    }
    public function setSort(/* array(string) */ $sort) {
        $this->assertIsArray($sort, 'string', __METHOD__);
        $this->sort = $sort;
    }
    public function getSort() {
        return $this->sort;
    }
    public function setDimensions($dimensions) {
        $this->dimensions = $dimensions;
    }
    public function getDimensions() {
        return $this->dimensions;
    }
    public function setStart_date($start_date) {
        $this->start_date = $start_date;
    }
    public function getStart_date() {
        return $this->start_date;
    }
    public function setStart_index($start_index) {
        $this->start_index = $start_index;
    }
    public function getStart_index() {
        return $this->start_index;
    }
    public function setSegment($segment) {
        $this->segment = $segment;
    }
    public function getSegment() {
        return $this->segment;
    }
    public function setIds($ids) {
        $this->ids = $ids;
    }
    public function getIds() {
        return $this->ids;
    }
    public function setMetrics(/* array(string) */ $metrics) {
        $this->assertIsArray($metrics, 'string', __METHOD__);
        $this->metrics = $metrics;
    }
    public function getMetrics() {
        return $this->metrics;
    }
    public function setFilters($filters) {
        $this->filters = $filters;
    }
    public function getFilters() {
        return $this->filters;
    }
    public function setEnd_date($end_date) {
        $this->end_date = $end_date;
    }
    public function getEnd_date() {
        return $this->end_date;
    }
}
