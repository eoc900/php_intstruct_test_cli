<?php


namespace App\CSV;


use App\Data\CleanData;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Serializer;


class CSV_Query{

    public $fileName;
    public $fileType;
    public $fileStatus;
    
    public function __construct(
        string $fileName = "services.csv", 
        string $fileType = 'csv'
    ){
        $this->fileName = $fileName;
        $this->fileType = $fileType;
        //Check if file exists and update status property
        $this->fileStatus = (file_exists($this->fileName)) ? true : false;
    }

    public function getFileStatus(){

        return $this->fileStatus;

    }

    public function getRecords(){
    // ----> Purpose: Extracts all the values and turns them into a multidimensional array
        if($this->fileStatus){
            $serializer = new Serializer([], [new CsvEncoder()]);
            $data = file_get_contents($this->fileName);
            $records = $serializer->decode($data, $this->fileType);
            return $records;
        }

        return false;
    }

    public function getByCountryCode($countryCode=""){
    // ----> Purpose: All services from a given country code
        $records = $this->getRecords();
        $results = array();
        foreach($records as $record){
            foreach($record as $key => $val){
                 // --> Issue #1: Currently country codes are written inconsistently (uppercase and lower)
                if((CleanData::transformTo($val,"lower") == CleanData::transformTo($countryCode,"lower")) && $key=="Country"){
                    array_push($results, $record);
                }
            }
        }
        return $results;
    }

    public function getSummaryOfRegions(){
    // ----> Purpose: Counts services from each region
        $records = $this->getRecords();
        $countries = array();
        $results = array();
        foreach($records as $record){
            foreach($record as $key => $val){
                $val = CleanData::transformTo($val,"lower");
                if( $key=="Country" && !in_array($val,$countries)){
                    $countries[]=$val;
                    $results[$val] = 0;
                }
                if( $key=="Country" && in_array($val,$countries)){
                    $results[$val] += 1;
                }
            }
        }
        return $results;
    }

    public function displayServicesByCountry($obj,$countryCode){

        $results = $obj->getByCountryCode(CleanData::transformTo($countryCode,"lower"));
        $cc = $countryCode;
        include_once __DIR__."/../views/servicesByCountry.php";

    }

     public function displaySummary($obj){

        $results = $obj->getSummaryOfRegions();
        include_once __DIR__."/../views/summary.php";

    }

}

?>