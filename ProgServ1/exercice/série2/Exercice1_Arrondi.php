<?php
$nombreRelou = 1978.652;

echo (int)$nombreRelou;
echo "<br>";
echo (round($nombreRelou)-$nombreRelou);
echo "<br>";
echo  (round($nombreRelou / 0.05) * 0.05);
echo "<br>";
echo  (round($nombreRelou / 0.50) * 0.50);
echo "<br>";
echo round($nombreRelou);
echo "<br>";
echo round($nombreRelou, -3);