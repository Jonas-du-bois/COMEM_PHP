<?php
$min = 01;
$max = 25;
for ($varBoucle=$min; $varBoucle<=$max; $varBoucle++) {
    if($varBoucle<=9){
        echo "img0".$varBoucle.".png",'<br>';
    }else{
    echo "img".$varBoucle.".png",'<br>';}
}



