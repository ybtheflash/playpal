<?php
/*
This file contains database configuration assuming you are running mysql using user "root" and password ""
*/

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'xplaypal');

// Try connecting to the Database
$dconn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

//Check the connection
if ($dconn == false) {
    dir('Error: Cannot connect');
}
date_default_timezone_set('Asia/Kolkata');
