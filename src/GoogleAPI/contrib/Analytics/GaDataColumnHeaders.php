<?php
namespace GoogleAPI\Contrib\Analytics;
use GoogleAPI\Service\apiModel;



class GaDataColumnHeaders extends apiModel {
    public $dataType;
    public $columnType;
    public $name;
    public function setDataType($dataType) {
        $this->dataType = $dataType;
    }
    public function getDataType() {
        return $this->dataType;
    }
    public function setColumnType($columnType) {
        $this->columnType = $columnType;
    }
    public function getColumnType() {
        return $this->columnType;
    }
    public function setName($name) {
        $this->name = $name;
    }
    public function getName() {
        return $this->name;
    }
}

