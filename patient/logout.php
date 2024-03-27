<?php
include_once '../admin/config.php';

//destroy the session
unset( $_SESSION[ 'pat_id' ] );
unset( $_SESSION[ 'pat_name' ] );
//redirect to login page
header( 'location: index.php' );
?>