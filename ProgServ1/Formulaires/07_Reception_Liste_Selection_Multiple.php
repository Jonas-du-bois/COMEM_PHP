<?php

// Documentation officielle : http://php.net/manual/fr/function.filter-input.php
if (filter_has_var(INPUT_POST, 'id_languages')) {
    $languages = filter_input(INPUT_POST, 'id_languages', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
    if ($languages) {
        foreach ($languages as $id_language) {
            echo $id_language, '<br>';
        }
    }
}

