<?php
include '../admin/config.php';

//destroy the session
unset( $_SESSION[ 'doctor_email' ] );
//redirect to login page
header( 'location: signin.php' );
?>