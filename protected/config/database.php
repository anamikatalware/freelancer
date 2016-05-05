<?php

if ($_SERVER['SERVER_NAME'] == 'localhost') {
    $db = array(
        'connectionString' => 'mysql:host=localhost;dbname=freelancer',
        'emulatePrepare' => true,
        'username' => 'root',
        'password' => '',
        'tablePrefix' => 'tbl_',
        'charset' => 'utf8',
    );
} else {
    $db = array(
        'connectionString' => 'mysql:host=localhost;dbname=freelancer',
        'emulatePrepare' => true,
        'username' => 'root',
        'password' => 'root',
        'tablePrefix' => 'tbl_',
        'charset' => 'utf8',
    );
}

return $db;
