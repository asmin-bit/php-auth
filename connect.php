<?php

$HOSTNAME = 'localhost';
$USERNAME = 'root';
$PASSWORD = '';
$DATABASE = 'signupforms';

// Establish connection
$con = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);

// Check connection
if (!$con) {
    die(mysqli_error($con));
}

?>
