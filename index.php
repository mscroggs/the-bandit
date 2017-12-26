<style type='text/css'>
a.bandit
    {display:inline-block;border-width:0px 3px 3px 0px;border-color:black;border-style:solid;height:80px;width:80px;background-color:#EEEEEE}
.bandit-container {border-width:3px 0px 0px 3px;border-color:black;border-style:solid;width:415px;height:415px}

a#starter {display:block;position:relative;border:3px solid black;width:181px;height:51px;top:-239px;left:117px;
           background-color:white;text-align:center;line-height:51px;font-size:18pt;box-shadow:0px 0px 3px 1px white;color:black;
           text-decoration:none}
a#starter:hover {color:red}
#timer {width:415px;text-align:right;font-family:monospace;font-size:12pt}
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
<a id='starter' href='javascript:start()'>Begin</a>

<textarea id='debug'></textarea>

<script type='text/javascript' src='bandit.js'></script>
