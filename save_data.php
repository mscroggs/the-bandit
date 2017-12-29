<?php

include("file_handler.php");
include("matrix_operations.php");

$a = Array();
for($i=0;isset($_POST["actual".$i]);$i++){
    $a[] = $_POST["actual".$i];
}
$d = Array();
for($i=0;isset($_POST["data".$i]);$i++){
    $d[] = $_POST["data".$i];
}

save($d,$a);


$bs = loadbs();
$R = loadR();

add_data($R,$bs,$d,$a);

savebs($bs);
saveR($R);

?>
