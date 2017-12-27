<?php

include("file_handler.php");

$a = Array();
for($i=0;isset($_POST["actual".$i]);$i++){
    $a[] = $_POST["actual".$i];
}
$d = Array();
for($i=0;isset($_POST["data".$i]);$i++){
    $d[] = $_POST["data".$i];
}

save($d,$a);

print_r($d);
print_r($a);

?>
