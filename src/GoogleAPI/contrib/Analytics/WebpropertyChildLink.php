<?php
namespace GoogleAPI\Contrib\Analytics;
use GoogleAPI\Service\apiModel;


class WebpropertyChildLink extends apiModel {
    public $href;
    public $type;
    public function setHref($href) {
        $this->href = $href;
    }
    public function getHref() {
        return $this->href;
    }
    public function setType($type) {
        $this->type = $type;
    }
    public function getType() {
        return $this->type;
    }
}