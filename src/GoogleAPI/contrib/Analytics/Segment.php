<?php
namespace GoogleAPI\Contrib\Analytics;
use GoogleAPI\Service\apiModel;


class Segment extends apiModel {
    public $definition;
    public $kind;
    public $segmentId;
    public $created;
    public $updated;
    public $id;
    public $selfLink;
    public $name;
    public function setDefinition($definition) {
        $this->definition = $definition;
    }
    public function getDefinition() {
        return $this->definition;
    }
    public function setKind($kind) {
        $this->kind = $kind;
    }
    public function getKind() {
        return $this->kind;
    }
    public function setSegmentId($segmentId) {
        $this->segmentId = $segmentId;
    }
    public function getSegmentId() {
        return $this->segmentId;
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
    public function setName($name) {
        $this->name = $name;
    }
    public function getName() {
        return $this->name;
    }
}
