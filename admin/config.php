<?php
define( 'DB_NAME', 'medical_appointment' );
define( 'DB_HOST', 'localhost' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', '' );
session_start();

function dbConnect() {
    $db = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
    if ( mysqli_connect_error() ) {
        echo 'Database Connection Fail!!';
    } else {
        return $db;
    }
}

function setSession( $key, $value ) {
    $_SESSION[ $key ] = $value;
}

function getSession( $key ) {
    return $_SESSION[ $key ];
}

function changeDay( $datetime ) {
    $dday = date( 'w', strtotime( $datetime ) );
    if ( $dday == 0 ) {
        $day = 'Sunday';
        return $day;
    } elseif ( $dday == 1 ) {
        $day = 'Monday';
        return $day;
    } elseif ( $dday == 2 ) {
        $day = 'Tuesday';
        return $day;
    } elseif ( $dday == 3 ) {
        $day = 'Wednesday';
        return $day;
    } elseif ( $dday == 4 ) {
        $day = 'Thursday';
        return $day;
    } elseif ( $dday == 5 ) {
        $day = 'Friday';
        return $day;
    } elseif ( $dday == 6 ) {
        $day = 'Saturday';
        return $day;
    }
}

function checkTime( $t, $t1, $t2 ) {
    $time = strtotime( $t );
    $time1 = strtotime( $t1 );
    $time2 = strtotime( $t2 );
    if ( $time >= $time1 && $time <= $time2 ) {
        true;
    } else {
        false;
    }
}

function changeTime( $time ) {
    $time = DateTime::createFromFormat( 'H:i:s.u', $time );
    $h = $time->format( 'h' );
    $m = $time->format( 'i' );
    $s = $time->format( 's' );
    $am = $time->format( 'a' );
    return $h.':'.$m.':'.$s.'&nbsp;'.$am;
}