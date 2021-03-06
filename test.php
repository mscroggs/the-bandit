<?php

function abseq($a,$b){
    if(abs(abs($a)-abs($b)) > 0.001){
        return false;
    } else {
        return true;
    }
}

$pass = 0;$fail = 0;

$RED = "\033[31m";
$GREEN = "\033[32m";
$DEFAULT = "\033[0m";

function Gecho($what){global $GREEN,$DEFAULT;echo($GREEN.$what.$DEFAULT);}
function Recho($what){global $RED,$DEFAULT;echo($RED.$what.$DEFAULT);}

include("matrix_operations.php");

/*******************************/
/**** test QR decomposition ****/
/*******************************/
$mat = Array(Array(0.6,1.2),Array(0,0.8));
$vec = Array(Array(1),Array(1));
echo("testing QR decomposition\n");
add_data($mat,$vec,Array(0.8,2.35),Array(2));
if(!abseq($mat[0][0],1) || !abseq($mat[0][1],2.6) || !abseq($mat[1][0],0) || !abseq($mat[1][1],0.917)){
    Recho("<!> FAIL <!>\n");
    print_matrix($mat);
    echo("Should be  1 2.6\n");
    echo("           0 0.917\n");
    $fail++;
} else {
    Gecho("PASS\n");
    $pass++;
}
echo("=============\n");

/********************/
/**** test solve ****/
/********************/
$mat = Array(Array(4,2),Array(0,3));
$vec = Array(Array(14),Array(3));
echo("testing solve\n");
$res = solve_upper_tri($mat,$vec);
if(!abseq($res[0][0],3) || !abseq($res[1][0],1)){
    Recho("<!> FAIL <!>\n");
    print_matrix($res);
    echo("Should be  3\n");
    echo("           1\n");
    $fail++;
} else {
    Gecho("PASS\n");
    $pass++;
}
echo("=============\n");

/*************************************/
/**** test multi QR decomposition ****/
/*************************************/
$mat = Array(Array(0,0),Array(0,0));
$vec = Array(Array(0),Array(0));
echo("testing multi QR decomposition\n");
add_data($mat,$vec,Array(0.6,1.2),Array(1));
add_data($mat,$vec,Array(0,0.8),Array(1));
add_data($mat,$vec,Array(0.8,2.35),Array(2));
if(!abseq($mat[0][0],1) || !abseq($mat[0][1],2.6) || !abseq($mat[1][0],0) || !abseq($mat[1][1],0.917)){
    Recho("<!> FAIL <!>\n");
    print_matrix($mat);
    echo("Should be  1 2.6\n");
    echo("           0 0.917\n");
    $fail++;
} else {
    Gecho("PASS\n");
    $pass++;
}
echo("=============\n");

/*************************************/
/**** test mat_inner_product ****/
/*************************************/
$mat = Array(Array(1,2,3),Array(4,5,6));
$vec = Array(1,2);
echo("testing mat_inner_product\n");
$res = mat_inner_product($mat,$vec);
if(!abseq($res[0],9) || !abseq($res[1],12) || !abseq($res[2],15)){
    Recho("<!> FAIL <!>\n");
    echo($res[0]." ".res[1]." ".$res[2]."\n");
    echo("Should be  9 12 15\n");
    $fail++;
} else {
    Gecho("PASS\n");
    $pass++;
}
echo("=============\n");



/*******************/
/*** * summary * ***/
/*******************/

if($fail == 0){
    Gecho("All ".$pass." tests passed.\n");
} else {
    Gecho($pass." tests passed. ");
    Gecho($fail." tests failed.\n");
}


?>
