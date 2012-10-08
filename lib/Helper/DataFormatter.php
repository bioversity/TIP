<?php

namespace Lib\Helper;

class DataFormatter
{  
  public function formatData($tableInformation, $table_data){
    $formattedData= array();
    
    while ($row = $tableInformation->fetch()) {
      if($row['COLUMN_NAME'] != 'ID'){
        while ($record= $table_data->fetch()){
          $formattedData[$row['COLUMN_NAME']]['VALUE'][]= $record[$row['COLUMN_NAME']];
        }
        $formattedData[$row['COLUMN_NAME']]['FIELD_TYPE']= $row['DATA_TYPE'];
        $formattedData[$row['COLUMN_NAME']]['FORM_TYPE'] = $this->getFormType($row['DATA_TYPE']);
      }
    }
    
    return $formattedData;
  }
  
  public function getFormType($fieldType){
    switch($fieldType){
      case 'varchar':
        return 'multiselect';
      case 'char':
        return 'checkbox';
      case 'enum':
        return 'checkbox';
      case 'double':
        return 'radio';
      case 'smallint':
        return 'multiselect';
    }
  }
}