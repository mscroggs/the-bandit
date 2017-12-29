<?php

include("file_handler.php");
if(get_lock()){
    echo("locked");
} else {

start_lock();

include("matrix_operations.php");

$a = Array();
for($i=0;isset($_POST["actual".$i]);$i++){
    $a[] = $_POST["actual".$i];
}
$d = Array();
for($i=0;isset($_POST["data".$i]);$i++){
    $d[] = $_POST["data".$i];
}
$s = Array();
for($i=0;isset($_POST["score".$i]);$i++){
    $s[] = $_POST["score".$i];
}

save($d,$a,$s);

$scores = loadscores();
for($i=0;i<count($s);$i++){
    $scores[$i][$s[$i]]++;
}
savescores($scores);


$bs = loadbs();
$R = loadR();

add_data($R,$bs,$d,$a);

savebs($bs);
saveR($R);

end_lock();

}

?>
