<?php

/* TODO: swap this file out for a file that reads writes using mysql */

function load_all(){
    $c = file_get_contents("data.txt");
    $c = explode("\n",$c);
    $out = Array();
    foreach($c as $item){
        if($item!=""){
            $item = explode("|",$item);
            $out[] = Array(explode(",",$item[0]),explode(",",$item[1]));
        }
    }
    return $out;
}

function wrapup($ls){
    return join(",",$ls);
}

function save($data, $ans){
    $f = fopen("data.txt","a");
    fwrite($f, wrapup($data)."|".wrapup($ans));
    fclose($f);
}

?>
