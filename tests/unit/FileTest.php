<?php
declare(strict_types=1);
require_once __DIR__.'/../../vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use App\Data\CleanData;
use App\CSV\CSV_Query;



class FileTest extends TestCase{

    public function testThatFileExists(){

        $csv = new CSV_Query("services.csv","csv");

        $this->assertFileExists(dirname(__DIR__).'/../'.'services.csv');

    }

}