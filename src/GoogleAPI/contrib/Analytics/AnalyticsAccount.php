<?php
namespace GoogleAPI\Contrib\Analytics;
use GoogleAPI\Service\apiModel;


class AnalyticsAccount extends apiModel {
    public $kind;
    public $name;
    public $created;
    public $updated;
    protected $__childLinkType = '\GoogleAPI\Contrib\Analytics\AccountChildLink';
    protected $__childLinkDataType = '';
    public $childLink;
    public $id;
    public $selfLink;
    public function setKind($kind) {
        $this->kind = $kind;
    }
    public function getKind() {
        return $this->kind;
    }
    public function setName($name) {
        $this->name = $name;
    }
    public function getName() {
        return $this->name;
    }
    public function setCreated($created) {
        $this->created = $created;
    }
    public function getCreated() {
        return $this->created;
    }
    public function setUpdated($updated) {
        $this->updated = $updated;
    }
    public function getUpdated() {
        return $this->updated;
    }
    public function setChildLink(AccountChildLink $childLink) {
        $this->childLink = $childLink;
    }
    public function getChildLink() {
        return $this->childLink;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function getId() {
        return $this->id;
    }
    public function setSelfLink($selfLink) {
        $this->selfLink = $selfLink;
    }
    public function getSelfLink() {
        return $this->selfLink;
    }
}

