<?php

require_once __DIR__.'/vendor/autoload.php';

use App\Data\CleanData;
use App\CSV\CSV_Query;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Serializer;


//1.  Define the document from where to extract the data
$query = new CSV_Query("services.csv","csv");


//2.  Get the user CLI instruction
if(isset($argv[1])){

        $command = $argv[1];

        // TASK #1
        if(CleanData::transformTo($command,"lower")=="get_service_by_country" && isset($argv[2])){
            echo "Here are the following services for the following country: ".$argv[2]." \n";
            $results = $query->getByCountryCode(CleanData::transformTo($argv[2],"lower"));
            print_r($results);
            exit;
        }

         // TASK #2
        if(CleanData::transformTo($command,"lower")=="service_summary"){
            echo "Total of services by country ".$argv[1]." \n";
            $results = $query->getSummaryOfRegions();
            print_r($results);
            exit;
        }

        echo "\n Please verify that you are giving the correct instruction \n ";

    exit;
}








//3.  In case that the user doesn't provide intructions
echo "\nPlease select one command: \n";
echo " php index.php get_service_by_country [country code] \n";
echo " php index.php service_summary \n";





?>


