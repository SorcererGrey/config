<?php

include_once 'cmanager.v1.php';

// Test create
$config = new ConfigManager('test');

if (file_exists('test.conf.json')) {
    echo '[Test One] Create configuration file > Success</br>';
} else {
    echo '[Test One] Create configuration file > Fail</br>';
}

// Test set
$config -> set('test', 'success');
$decodedConfig = json_decode(file_get_contents('test.conf.json'), true);

if ($decodedConfig['test'] == 'success') {
    echo '[Test two] Write new value to config file > Success </br>';
} else {
    echo '[Test two] Write new value to config file > Fail</br>';
}

// Test get
$response = $config -> get(1, 'test');

if ($response === 'success') {
    echo '[Test three] Read from config file > Success</br>';
} else {
    echo '[Test three] Read from config file > Fail</br>';
}
