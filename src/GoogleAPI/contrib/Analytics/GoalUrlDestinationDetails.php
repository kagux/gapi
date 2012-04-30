<?php
namespace GoogleAPI\Contrib\Analytics;
use GoogleAPI\Service\apiModel;


class GoalUrlDestinationDetails extends apiModel {
    public $url;
    public $caseSensitive;
    public $matchType;
    protected $__stepsType = '\GoogleAPI\Contrib\GoalUrlDestinationDetailsSteps';
    protected $__stepsDataType = 'array';
    public $steps;
    public $firstStepRequired;
    public function setUrl($url) {
        $this->url = $url;
    }
    public function getUrl() {
        return $this->url;
    }
    public function setCaseSensitive($caseSensitive) {
        $this->caseSensitive = $caseSensitive;
    }
    public function getCaseSensitive() {
        return $this->caseSensitive;
    }
    public function setMatchType($matchType) {
        $this->matchType = $matchType;
    }
    public function getMatchType() {
        return $this->matchType;
    }
    public function setSteps(/* array(GoalUrlDestinationDetailsSteps) */ $steps) {
        $this->assertIsArray($steps, 'GoalUrlDestinationDetailsSteps', __METHOD__);
        $this->steps = $steps;
    }
    public function getSteps() {
        return $this->steps;
    }
    public function setFirstStepRequired($firstStepRequired) {
        $this->firstStepRequired = $firstStepRequired;
    }
    public function getFirstStepRequired() {
        return $this->firstStepRequired;
    }
}