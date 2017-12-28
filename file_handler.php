<?php

include_once("config.php");

function load_all(){
    global $SAVEPATH;
    $c = file_get_contents($SAVEPATH."data.txt");
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
    global $SAVEPATH;
    $f = fopen($SAVEPATH."data.txt","a");
    fwrite($f, wrapup($data)."|".wrapup($ans));
    fclose($f);
}

function saveR($R){
    global $SAVEPATH;
    saveMatrix($R, $SAVEPATH."R.matrix");
}

function loadR(){
    global $SAVEPATH;
    return loadMatrix($SAVEPATH."R.matrix");
}

function savebs($b){
    global $SAVEPATH;
    saveMatrix($b, $SAVEPATH."b.vector");
}

function loadbs(){
    global $SAVEPATH;
    return loadMatrix($SAVEPATH."b.vector");
}

function saveMatrix($mat, $file){
    $out = "";
    foreach($mat as $row){
        $out .= join(",",$row);
        $out .= "\n";
    }
    $f = fopen($file, "w");
    fwrite($f, $out);
    fclose($f);
}

function loadMatrix($file){
    $c = file_get_contents($file);
    $c = explode("\n",$c);
    $out = Array();
    foreach($c as $row){if($row != ""){
        $out[] = explode(",",$row);
    }}
    return $out;
}

?>
