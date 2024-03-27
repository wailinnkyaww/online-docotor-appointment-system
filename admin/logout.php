<?php

include_once 'config.php';
//destroy the session
unset( $_SESSION[ 'admin_name' ] );
//redirect to login page
header( 'location: login.php' );
?>