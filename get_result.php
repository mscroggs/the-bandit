<?php

include("file_handler.php");
include("matrix_operations.php");

$data = Array();
for($i=0;isset($_POST["data".$i]);$i++){
    $data[] = $_POST["data".$i];
}

$R = loadR();
$bs = loadbs();
$x = solve_upper_tri($R, $bs);
$res = mat_inner_product($x, $data);

foreach($res as $i=>$it){
    echo($it);
    if($i<count($res)-1){echo(",");}
}

?>
