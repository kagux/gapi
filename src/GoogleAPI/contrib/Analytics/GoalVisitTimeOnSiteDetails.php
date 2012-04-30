<?php
namespace GoogleAPI\Contrib\Analytics;
use GoogleAPI\Service\apiModel;

class GoalVisitTimeOnSiteDetails extends apiModel {
    public $comparisonType;
    public $comparisonValue;
    public function setComparisonType($comparisonType) {
        $this->comparisonType = $comparisonType;
    }
    public function getComparisonType() {
        return $this->comparisonType;
    }
    public function setComparisonValue($comparisonValue) {
        $this->comparisonValue = $comparisonValue;
    }
    public function getComparisonValue() {
        return $this->comparisonValue;
    }
}
