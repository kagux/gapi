<?php
namespace GoogleAPI\Contrib\Analytics;
use GoogleAPI\Service\apiModel;


class Segments extends apiModel {
    public $username;
    public $kind;
    protected $__itemsType = '\GoogleAPI\Contrib\Analytics\Segment';
    protected $__itemsDataType = 'array';
    public $items;
    public $itemsPerPage;
    public $previousLink;
    public $startIndex;
    public $nextLink;
    public $totalResults;
    public function setUsername($username) {
        $this->username = $username;
    }
    public function getUsername() {
        return $this->username;
    }
    public function setKind($kind) {
        $this->kind = $kind;
    }
    public function getKind() {
        return $this->kind;
    }
    public function setItems(/* array(Segment) */ $items) {
        $this->assertIsArray($items, 'Segment', __METHOD__);
        $this->items = $items;
    }
    public function getItems() {
        return $this->items;
    }
    public function setItemsPerPage($itemsPerPage) {
        $this->itemsPerPage = $itemsPerPage;
    }
    public function getItemsPerPage() {
        return $this->itemsPerPage;
    }
    public function setPreviousLink($previousLink) {
        $this->previousLink = $previousLink;
    }
    public function getPreviousLink() {
        return $this->previousLink;
    }
    public function setStartIndex($startIndex) {
        $this->startIndex = $startIndex;
    }
    public function getStartIndex() {
        return $this->startIndex;
    }
    public function setNextLink($nextLink) {
        $this->nextLink = $nextLink;
    }
    public function getNextLink() {
        return $this->nextLink;
    }
    public function setTotalResults($totalResults) {
        $this->totalResults = $totalResults;
    }
    public function getTotalResults() {
        return $this->totalResults;
    }
}

