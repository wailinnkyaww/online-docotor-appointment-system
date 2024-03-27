<?php
include_once '../admin/config.php';
// Assuming this file contains your database connection function

$query = "SELECT day, time_from, time_to FROM schedule where doct_id='20'";
$result = mysqli_query( dbConnect(), $query );

if ( $result ) {
    function format_time( $time_str ) {
        return date( 'g:i A', strtotime( $time_str ) );
    }

    // Echo the beginning of the table
    echo '<div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Day</th>
                        <th>Time From</th>
                        <th>Time To</th>
                    </tr>
                </thead>
                <tbody>';

    // Loop through the query result and echo each row of the table
    while ( $row = mysqli_fetch_assoc( $result ) ) {
        $day = $row[ 'day' ];
        $start = format_time( $row[ 'time_from' ] );
        $end = format_time( $row[ 'time_to' ] );
        echo '<tr>
                <td>' . $day . '</td>
                <td>' . $start . '</td>
                <td>' . $end . '</td>
            </tr>';
    }

    // Echo the end of the table
    echo '</tbody>
        </table>
    </div>';
} else {
    echo 'Error fetching schedule details: ' . mysqli_error( dbConnect() );
}
?>