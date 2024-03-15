
Services displayed by country: <?php echo $cc."\n";?>
<?php 
if(isset($results)){
foreach($results as $key => $val): ?>

    <?php  echo "| ".$val["Ref"]." |  Centre: ".$val["Centre"]." | Service: ".$val["Service"]." |\n"; ?>

<?php endforeach; }?>
