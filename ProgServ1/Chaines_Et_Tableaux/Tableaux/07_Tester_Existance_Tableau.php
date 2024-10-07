<?php

$tab = [1,2,3];

if (isset($tab) && is_array($tab) && !empty($tab)) {
    echo "<pre/>"; print_r($tab); echo '<br><br>';
}