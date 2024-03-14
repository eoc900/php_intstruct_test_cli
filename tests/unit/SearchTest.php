<?php
declare(strict_types=1);
require_once __DIR__.'/../../vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use App\Data\CleanData;
use App\CSV\CSV_Query;



class SearchTest extends TestCase{

    public function testRecordsObtained(){
        $csv = new CSV_Query("services.csv","csv");
        $records = $csv->getRecords();
        $this->assertIsArray($records,"The records variable should return some values within an array as part of serialize library.");
    }

    public function testRecordsHaveKeys(){
        $csv = new CSV_Query("services.csv","csv");
        $records = $csv->getRecords();
        $this->assertArrayHasKey('Ref',$records[0]);
        $this->assertArrayHasKey('Centre',$records[0]);
        $this->assertArrayHasKey('Service',$records[0]);
        $this->assertArrayHasKey('Country',$records[0]);
    }

    public function testCountryExists(){
        $csv = new CSV_Query("services.csv","csv");
        $results = $csv->getByCountryCode("gb");
        $this->assertNotEmpty($results);
    }

    public function testDocumentNotEmpty(){
        $csv = new CSV_Query("services.csv","csv");
        $results = $csv->getSummaryOfRegions();
        $this->assertNotEmpty($results);
    }

}