<?php
namespace GoogleAPI\Contrib\Analytics;
use GoogleAPI\Service\apiModel;


class GoalUrlDestinationDetailsSteps extends apiModel {
    public $url;
    public $name;
    public $number;
    public function setUrl($url) {
        $this->url = $url;
    }
    public function getUrl() {
        return $this->url;
    }
    public function setName($name) {
        $this->name = $name;
    }
    public function getName() {
        return $this->name;
    }
    public function setNumber($number) {
        $this->number = $number;
    }
    public function getNumber() {
        return $this->number;
    }
}
