<?php

// Require class file
require '../config_v2.php';

// Create new config object
$config = new Config('./', 'general');

// Test new doc
$new_config = $config->new_doc();
echo 'Document create: ';
if ($new_config) {

    echo 'TRUE <br>';

} else {

    echo 'FALSE <br>';

}

// Test add to doc
$set_config = $config->set_value('1', 'name', 'Dylan Lavery');
echo 'Document write: ';
if ($set_config) {

    echo 'TRUE <br>';

} else {

    echo 'FALSE <br>';

}

// Test read doc
$get_config = $config->get_doc();
echo 'Document read: ';
if ($get_config['name'] == 'Dylan Lavery') {

    echo 'TRUE <br>';

} else {

    echo 'FALSE <br>';

}

// Test backup
$bk_config = $config->backup('system');
echo 'Document backup: ';
if ($bk_config) {

    echo 'TRUE <br>';

} else {

    echo 'FALSE <br>';

}
