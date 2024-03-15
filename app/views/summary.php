
General summary (Number of services found by country): 

<?php 
if(isset($results) && count($results)>0):
    echo "| Country | Service Count  \n"; 
foreach($results as $key => $val): ?>
<?php 
    echo "|    ".$key."   |   ".$val."     "; 
?>

<?php 
endforeach; 
endif;
?>

