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
    for($i=0;isset($_POST["correct".$i]);$i++){
        $s[] = $_POST["correct".$i];
    }

    save($d,$a,$s);


    // scores format:
    // guessed type 1,correct type 1,guessed type 2,correct type 2, (repeat 4 times)

    $scores = loadscores();
    print_r($s);
    print_r($scores);
    for($i=0;$i<count($s);$i++){
        if($s[$i]){
            $scores[$i*4+$a[$i]*2]++;
            $scores[$i*4+$a[$i]*2+1]++;
        } else {
            $scores[$i*4+(1-$a[$i])*2]++;
        }
    } // TODO: This is adding to the wrong place....

    savescores($scores);


    $bs = loadbs();
    $R = loadR();

    add_data($R,$bs,$d,$a);

    savebs($bs);
    saveR($R);

    end_lock();

}

?>
