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
            $query->displayServicesByCountry($query,$argv[2]);
            exit;
        }

         // TASK #2
        if(CleanData::transformTo($command,"lower")=="service_summary"){
            $query->displaySummary($query);
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


