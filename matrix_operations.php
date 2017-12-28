<?php

function print_matrix($A){
    foreach($A as $row){
        foreach($row as $entry){
            echo($entry." ");
        }
        echo("\n");
    }
}

function print_matrix_one_line($A){
    foreach($A as $row){
        foreach($row as $entry){
            echo($entry." ");
        }
        echo("; ");
    }
    echo("\n");
}

function givens($a,$b){
    $d = sqrt($a*$a+$b*$b);
    return Array($a/$d,-$b/$d);
}

function add_data(&$R,&$bs,$a,$d){
    $cs = Array();
    $ss = Array();
    for($j=0;$j<count($bs);$j++){
        $cs[] = $R[$j][$j];
        $ss[] = $a[$j];
    }
    for($j=0;$j<count($bs);$j++){
        //$c = $cs[$j];
        //$s = $ss[$j];
        list($c,$s) = givens($R[$j][$j],$a[$j]);
        $R[$j][$j] = $c*$R[$j][$j] - $s * $a[$j];
        // update jth row of R and u
        $t1 = Array();
        $t2 = Array();
        for($k=$j+1;$k<count($bs);$k++){
            $t1[$k] = $R[$j][$k];
            $t2[$k] = $a[$k];
        }
        for($k=$j+1;$k<count($bs);$k++){
            $R[$j][$k] = $c * $t1[$k] - $s * $t2[$k];
            $a[$k] = $s * $t1[$k] + $c * $t2[$k]; /// CHECK THIS
        }
        // update jth row of d and mu
        $t1 = $bs[$j];
        $t2 = $d;
        for($k=0;$k<count($bs[$j]);$k++){
            $bs[$j][$k] = $c*$t1[$k] - $s * $t2[$k];
            $d[$k] = $s*$t1[$k] + $c * $t2[$k];
        }
    }
}

function inner_product($a,$b){
    $out = 0;
    for($i=0;$i<count($a);$i++){
        $out += $a[$i] * $b[$i];
    }
    return $out;
}

function outer_product($a,$b){
    $out = Array();
    foreach($a as $r){
        $row = Array();
        foreach($b as $c){
            $row[] = $r*$c;
        }
        $out[] = $row;
    }
    return $out;
}

function matrix_add($A, $B){
    for($i=0;$i<count($A);$i++){
        for($j=0;$j<count($A[$i]);$j++){
            $A[$i][$j] += $B[$i][$j];
        }
    }
    return $A;
}

function matvec($A,$v){
    $out = Array();
    for($i=0;$i<count($A);$i++){
        $e = 0;
        for($j=0;$j<count($A[$i]);$j++){
            $e += $A[$i][$j] * $v[$j];
        }
        $out[] = $e;
    }
    return $out;
}

function matmat($A,$B){
    $out = Array();
    for($i=0;$i<count($A);$i++){
        $row = Array();
        for($k=0;$k<count($B[0]);$k++){
            $e = 0;
            for($j=0;$j<count($A[$i]);$j++){
                $e += $A[$i][$j] * $B[$j][$k];
            }
            $row[] = $e;
        }
        $out[] = $row;
    }
    return $out;
}

function solve_upper_tri($A,$B){
    for($i=count($A)-1;$i>=0;$i--){
        for($j=0;$j<count($B[0]);$j++){
            for($k=$i+1;$k<count($B);$k++){
                $B[$i][$j] -= $A[$i][$k] * $B[$k][$j];
            }
            if($A[$i][$i] != 0){
                $B[$i][$j] /= $A[$i][$i];
            }
        }
    }
    return $B;
}

?>
