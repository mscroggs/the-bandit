<?php

include("file_handler.php");
include("matrix_operations.php");

/*$a = Array();
for($i=0;isset($_POST["actual".$i]);$i++){
    $a[] = $_POST["actual".$i];
}
$d = Array();
for($i=0;isset($_POST["data".$i]);$i++){
    $d[] = $_POST["data".$i];
}
*/

$a = Array(1,1,1,1,1,1,1,1,1,1,1,1,3,1,1,1,1,1,1,-1);
$d = Array(1,1,0,1);

save($d,$a);

$bs = loadbs();
$R = loadR();

add_data($bs,$R,$a,$d);

savebs($bs);
saveR($R);

?>
