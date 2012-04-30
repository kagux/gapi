<?php
namespace GoogleAPI\Contrib\Analytics;
use GoogleAPI\Service\apiModel;


class Webproperty extends apiModel {
    public $kind;
    public $name;
    public $created;
    public $updated;
    public $websiteUrl;
    public $internalWebPropertyId;
    protected $__childLinkType = '\GoogleAPI\Contrib\Analytics\WebpropertyChildLink';
    protected $__childLinkDataType = '';
    public $childLink;
    protected $__parentLinkType = '\GoogleAPI\Contrib\Analytics\WebpropertyParentLink';
    protected $__parentLinkDataType = '';
    public $parentLink;
    public $id;
    public $selfLink;
    public $accountId;
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
    public function setWebsiteUrl($websiteUrl) {
        $this->websiteUrl = $websiteUrl;
    }
    public function getWebsiteUrl() {
        return $this->websiteUrl;
    }
    public function setInternalWebPropertyId($internalWebPropertyId) {
        $this->internalWebPropertyId = $internalWebPropertyId;
    }
    public function getInternalWebPropertyId() {
        return $this->internalWebPropertyId;
    }
    public function setChildLink(WebpropertyChildLink $childLink) {
        $this->childLink = $childLink;
    }
    public function getChildLink() {
        return $this->childLink;
    }
    public function setParentLink(WebpropertyParentLink $parentLink) {
        $this->parentLink = $parentLink;
    }
    public function getParentLink() {
        return $this->parentLink;
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
    public function setAccountId($accountId) {
        $this->accountId = $accountId;
    }
    public function getAccountId() {
        return $this->accountId;
    }
}
