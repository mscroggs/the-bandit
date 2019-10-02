<?php

include("file_handler.php");

function zeromat($r,$c){
    return array_fill(0,$r,array_fill(0,$c,0));
}

saveR(zeromat(20,20));
savebs(zeromat(20,4));
savescores(zeromat(1,8));

$f = fopen($SAVEPATH."data.txt","w");
fclose($f);

end_lock();

shell_exec("chmod 777 ".$SAVEPATH."R.matrix ".$SAVEPATH."b.vector ".$SAVEPATH."data.txt ".$SAVEPATH."_lock_ ".$SAVEPATH."scores.txt");

?>
