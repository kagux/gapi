<?php
namespace GoogleAPI\Contrib\Analytics;
use GoogleAPI\Service\apiModel;


class GaDataProfileInfo extends apiModel {
    public $webPropertyId;
    public $internalWebPropertyId;
    public $tableId;
    public $profileId;
    public $profileName;
    public $accountId;
    public function setWebPropertyId($webPropertyId) {
        $this->webPropertyId = $webPropertyId;
    }
    public function getWebPropertyId() {
        return $this->webPropertyId;
    }
    public function setInternalWebPropertyId($internalWebPropertyId) {
        $this->internalWebPropertyId = $internalWebPropertyId;
    }
    public function getInternalWebPropertyId() {
        return $this->internalWebPropertyId;
    }
    public function setTableId($tableId) {
        $this->tableId = $tableId;
    }
    public function getTableId() {
        return $this->tableId;
    }
    public function setProfileId($profileId) {
        $this->profileId = $profileId;
    }
    public function getProfileId() {
        return $this->profileId;
    }
    public function setProfileName($profileName) {
        $this->profileName = $profileName;
    }
    public function getProfileName() {
        return $this->profileName;
    }
    public function setAccountId($accountId) {
        $this->accountId = $accountId;
    }
    public function getAccountId() {
        return $this->accountId;
    }
}