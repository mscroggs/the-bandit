<?php

include_once("config.php");

function start_lock(){
    global $SAVEPATH;
    $f = fopen($SAVEPATH."_lock_","w");
    fwrite($f,"locked");
    fclose($f);
}

function get_lock(){
    global $SAVEPATH;
    $r = file_get_contents($SAVEPATH."_lock_");
    $r = substr($r,0,4);
    if($r=="free"){
        return false;
    } else {
        return true;
    }
}
function end_lock(){
    global $SAVEPATH;
    $f = fopen($SAVEPATH."_lock_","w");
    fwrite($f,"free");
    fclose($f);
}

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

function save($data, $ans, $scores){
    global $SAVEPATH;
    $f = fopen($SAVEPATH."data.txt","a");
    fwrite($f, wrapup($data)."|".wrapup($ans)."|".wrapup($scores)."\n");
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

function savescores($scores){
    global $SAVEPATH;
    saveMatrix(Array($scores), $SAVEPATH."scores.txt","a");
}

function loadscores(){
    global $SAVEPATH;
    return loadFinalRow($SAVEPATH."scores.txt");
}

function savebs($b){
    global $SAVEPATH;
    saveMatrix($b, $SAVEPATH."b.vector");
}

function loadbs(){
    global $SAVEPATH;
    return loadMatrix($SAVEPATH."b.vector");
}

function saveMatrix($mat, $file, $typ="w"){
    $out = "";
    foreach($mat as $row){
        $out .= join(",",$row);
        $out .= "\n";
    }
    $f = fopen($file, $typ);
    fwrite($f, $out);
    fclose($f);
}

function split_row($row){
    $out = Array();
    foreach(explode(",",$row) as $e){
        $out[] = floatval($e);
    }
    return $out;
}

function loadMatrix($file){
    $c = file_get_contents($file);
    $c = explode("\n",$c);
    $out = Array();
    foreach($c as $row){if($row != ""){
        $out[] = split_row($row);
    }}
    return $out;
}

function loadFinalRow($file){
    $c = file_get_contents($file);
    $c = explode("\n",$c);
    $out = Array();
    foreach($c as $row){if($row != ""){
        $out = $row;
    }}
    return split_row($out);
}

?>
