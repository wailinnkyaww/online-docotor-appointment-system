<?php

require_once 'config.php';

if ( isset( $_POST[ 'submit' ] ) ) {
    $id = $_GET[ 'id' ];
    $patname = $_POST[ 'patname' ];
    $doctname = $_POST[ 'doctname' ];
    $date = $_POST[ 'date' ];
    $time = $_POST[ 'time' ];
    $status = $_POST[ 'status' ];
    $qry = "UPDATE `appointment` SET `date`='$date',`time`='$time',`status` = '$status',`pat_name`='$patname',`doct_name`='$doctname' WHERE id = {$id}";
    $result = mysqli_query( dbConnect(), $qry );
    if ( $result ) {
        echo '<script type="text/Javascript"> alert("Edit successfully.")</script>';
        header( 'Location:appointment.php' );
    } else {
        echo 'Error inserting user: ' . mysqli_error( $db );
    }
}
include_once 'navber.php';
include_once 'sidebar.php';
?>

<style>
.doctForm {
    margin: 5rem 0px 0px 400px;
}
</style>
<div class='col-md-6 doctForm float-right'>
    <?php
$id = $_GET[ 'id' ];
$cats = dbConnect()->query( "SELECT * FROM appointment where id = {$id}" );
while ( $row = $cats->fetch_assoc() ) :
?>
    <form action='' id='manage-appointment' enctype='multipart/form-data' method='post'>
        <div class='card'>
            <div class='card-header'>
                Edit Appointment Form
            </div>
            <div class='card-body'>
                <div class='form-group'>
                    <label for='' class='control-label'>Patient Name</label>
                    <input type='text' class='form-control' name='patname' value="<?php echo $row['pat_name'] ?>"
                        required=''>
                </div>
                <div class='form-group'>
                    <label for='' class='control-label'>Doctor Name</label>
                    <input type='text' class='form-control' name='doctname' value="<?php echo $row['doct_name'] ?>"
                        required=''>

                </div>
                <div class='form-group'>
                    <label for='' class='control-label'>Date</label>

                    <input type='date' class='form-control' name='date' value="<?php
                    echo $row[ 'date' ] ? date("Y-m-d",strtotime($row['date'])): 'no';
                    ?>">
                </div>
                <div class='form-group'>
                    <label for='' class='control-label'>Time</label>
                    <input type='time' class='form-control' name='time' value="<?php
                    echo $row[ 'date' ] ? date("H:i:s",strtotime($row['time'])): 'no';
                    ?>">
                </div>
                <div class='form-group'>
                    <label for='' class='control-label'>Status</label>
                    <select class='form-select' name='status' id='floatingSelect' aria-label='Floating label select'>
                        <option value='request' <?php if ( $row[ 'status' ] == 'request' ) echo 'selected'  ?>>Request
                        </option>
                        <option value='confirm' <?php if ( $row[ 'status' ] == 'confirm' ) echo 'selected'  ?>>Confirm
                        </option>
                        <option value='done' <?php if ( $row[ 'status' ] == 'done' ) echo 'selected'  ?>>Done</option>
                        <option value='cancel' <?php if ( $row[ 'status' ] == 'cancel' ) echo 'selected'  ?>>Cancel
                        </option>
                    </select>

                </div>
            </div>

            <div class='card-footer'>
                <div class='row'>
                    <div class='col-md-12'>
                        <button class='btn btn-sm btn-primary col-sm-3 offset-md-3' type='submit' name='submit'>
                            Save</button>
                        <button class='btn btn-sm btn-success col-sm-3' type='button'><a href='appointment.php'
                                style='text-decoration: none;color:white'>
                                Cancel </a></button>
                    </div>
                </div>
            </div>
            <?php endwhile;
?>
        </div>
    </form>
</div>