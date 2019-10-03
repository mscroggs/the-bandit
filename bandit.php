<style type='text/css'>
a.bandit
    {display:inline-block;border-width:0px 3px 3px 0px;border-color:black;border-style:solid;height:80px;width:80px;background-color:#EEEEEE}
.bandit-container {border-width:3px 0px 0px 3px;border-color:black;border-style:solid;width:415px;height:415px}

a.starter {display:block;border:3px solid black;width:181px;height:51px;position:relative;left:60px;
           background-color:white;text-align:center;line-height:51px;font-size:18pt;box-shadow:0px 0px 3px 1px white;color:black;
           text-decoration:none;margin-top:5px}
a.starter:hover {color:red}
#timer {width:415px;text-align:right;font-family:monospace;font-size:12pt}
#infobox {display:block;position:relative;border:3px solid black;
          background-color:white;text-align:center;box-shadow:0px 0px 4px 2px white;color:black;
          width:281px;height:331px;top:-389px;left:57px; margin-bottom:-357px;display:none;padding:10px}

#startinfo h1, #endinfo h1, #thankinfo h1 {margin:5px}

</style>


<div id='timer'></div>
<div class='bandit-container'>
<?php

$n=0;
for($i=0;$i<5;$i++){
    for($j=0;$j<5;$j++){
        echo("<a href='javascript:click(".$n.")' id='bandit-".$n."' class='bandit'> </a>");
        $n++;
    }
    echo("<br />");
}

?>
</div>
<div id='infobox'></div>
<script type='text/javascript' src='bandit.js'></script>
