<?php
include_once '../admin/config.php';
include_once 'header.php';
?>
<style>
.search {
    margin-left: 27%;
}

.doctorList {
    width: 100%;
    padding-top: 20px;
    padding-left: 180px;
    margin: 10px 0px 0px -200px;
}

.card {
    margin-left: 5px;
}

.only {
    margin-left: 20%;
}
</style>
<div class = 'search p-5 -8 mt-5'>
<form class = 'row g-3 ' method = 'post' action = ''>
<div class = 'col-auto'>
<label for = 'doctorname' class = 'visually-hidden'></label>
<input type = 'text' class = 'form-control' name = 'doctName' placeholder = 'Doctor name'>
</div>
<div class = 'col-auto'>
<select name = 'deptName' id = '' aria-label = 'Default select example' class = 'form-select'>
<option></option>
<?php
$qry = dbConnect()->query( 'SELECT * FROM special ORDER BY id ASC' );
while( $row = $qry->fetch_assoc() ):
?>
<option value = "<?php echo $row['name'] ?>"><?php echo $row[ 'name' ] ?></option>
<?php endwhile;
?>
</select>
</div>
<div class = 'col-auto'>
<button type = 'submit' name = 'search' class = 'btn btn-primary mb-3'>Search</button>
</div>
</form>
<!-- DEFAULT FORM  -->
<?php
if ( !isset( $_POST[ 'search' ] ) && !isset( $_POST[ 'doctName' ] ) && !isset( $_POST[ 'deptName' ] ) ) {
    $cats = dbConnect()->query( 'SELECT * FROM doctor order by id asc' );
    ?>
    <div class = 'doctorList  col-lg-12  bg-light d-flex row w-100 '>
    <?php
    while( $row = $cats->fetch_assoc() ):
    ?>
    <div class = 'container d-flex'>
    <div class = 'count mt-5 me-3'> <?php $doctor = $row[ 'id' ];
    ?> </div>
    <div class = 'card mb-3 col-md-10 ms-1 '>
    <div class = 'row g-3 p-4'>
    <div class = 'col-md-3'>
    <img src = '../admin/uploads/<?php echo $row['img'] ?>' class = 'img-fluid rounded-start h-75 w-80'
    alt = '...'>
    </div>
    <div class = 'col-md-8 ps-1'>
    <div class = 'card-body ms-5'>
    <h5 class = 'card-title'>Doctor&nbsp;
    :<?php echo $row[ 'name' ] ?>( <i><?php echo $row[ 'name_pref' ] ?></i> )
    </h5>
    <p class = 'card-text'>Specialties:<?php echo $row[ 'specialties' ] ?></p>
    <p class = 'card-text'>Contact:<?php echo $row[ 'phone' ] ?></p>
    <!-- Button trigger modal -->
    <button type = 'button' class = 'btn btn-primary' data-toggle = 'modal'
    data-target = '#exampleModalL<?php echo $row['id'] ?>'>
    <i class = 'fa-regular fa-calendar-days'></i>&nbsp;
    Schedule
    </button>
    <!-- Modal -->
    <div class = 'modal fade' id = 'exampleModalL<?php echo $row['id'] ?>' tabindex = '-1'
    role = 'dialog' aria-labelledby = 'exampleModalLabel' aria-hidden = 'true'>
    <div class = 'modal-dialog' role = 'document'>
    <div class = 'modal-content'>
    <div class = 'modal-header'>
    <h5 class = 'modal-title' id = 'exampleModalLabel'>
    <?php echo $row[ 'name' ] ?>'s
                                                Schedule</h5>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                <span aria-hidden='true'>&times;
                                                </span>
                                            </button>
                                        </div>
                                        <div class='modal-body'>
                                            <table>
                                                <tr>
                                                    <th class=''>Day</th>
                                                    <th class=''>Time From</th>
                                                    <th class=''>Time To</th>
                                                </tr>
                                                <?php    
    $catt = dbConnect()->query( "SELECT * FROM schedule where doct_id = {$doctor}" );
    while ( $moe = $catt->fetch_assoc() ):
    $timef =  $moe[ 'time_from' ];
    $timet =  $moe[ 'time_to' ];
    ?>

                                                <tr>
                                                    <td class='w-25'>
                                                        <?php echo $moe[ 'day' ]?>
                                                    </td>
                                                    <td class='w-25'><?php echo date( 'g:i A', strtotime( $timef ) );
    ?></td>
                                                    <td class='w-25'><?php echo date( 'g:i A', strtotime( $timet ) );
    ?></td>
                                                </tr>
                                                <?php  endwhile;
    ?>
                                            </table>

                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-secondary'
                                                data-dismiss='modal'>Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type='button' class='btn btn-primary' data-bs-toggle='modal'
                                data-bs-target='#exampleModal<?php echo $row[ 'id' ]?>'>Set
                                Appointment</button>

                            <div class='modal fade' id='exampleModal<?php echo $row[ 'id' ]?>' tabindex='-1'
                                aria-labelledby='exampleModalLabel<?php echo $row[ 'id' ]?>' aria-hidden='true'>
                                <div class='modal-dialog'>
                                    <!-- INSERT DATA TO DATABASE FROM MODAL  -->
                                    <?php
                                    if(isset($_POST['setAppoint']) && $row[ 'id' ] == $_POST['idd']){
                                          
                                        $ID = $_POST['idd'];
                                        $name = $_POST['sddate'];
                                        $time = $_POST['sdtime'];
                                        $day = changeDay($name);
                                        $qry = "SELECT * FROM schedule where doct_id = '$ID' and day = '$day'";
                                        $result = mysqli_query( dbConnect(), $qry );
                                        if($result){
                                        $rr = $result->fetch_assoc();                    
                                        if(checkTime($time,$rr['time_from'],$rr['time_to'])) {
                                        $qrys = "INSERT INTO `appointment`( `id`, `doct_id`, `pat_id`, `date`, `time`, `status` ) VALUES ( '', '$ID', '1', '$name', '$time', '1' )"; 
                                        $res = mysqli_query(dbConnect(),$qrys); 
                                        echo "<script type='text/javascript'>alert('Appointment is Successfully Requested')</script>" ;
                                        } else {
                                        echo "<script type='text/javascript'>alert('Please Check *! Requested date or Docoter's time' );
    </script>";
                                     }
                                    }     
                                }                         
                                    ?>
                                    <form action='' method="post">
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='exampleModalLabel<?php echo $row[ 'id' ]?>'>
                                                    <?php echo $row[ 'name' ]?>'s'
                                                    Appointment Form</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal'
                                                    aria-label='Close'></button>
                                            </div>
                                            <div class='modal-body'>
                                                <input type='hidden' name='idd' value='<?php echo $row[ 'id' ]?>'>
                                                <div class='mb-3'>
                                                    <label for='recipient-name' class='col-form-label'>Date:</label>
                                                    <input type='date' class='form-control' id='date' name=" sddate">
                                                </div>
                                                <div class='mb-3'>
                                                    <label for='message-text' class='col-form-label'>Time:</label>
                                                    <input type='time' class='form-control' id='time' name="sdtime">
                                                </div>

                                            </div>
                                            <div class='modal-footer'>
                                                <button type='button' class='btn btn-secondary'
                                                    data-bs-dismiss='modal'>Close
                                                </button>
                                                <button type='submit' name='setAppoint'
                                                    value="setAppoint<?php echo $row[ 'id' ]?>"
                                                    class='btn btn-primary'>Set
                                                    Appointment
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- php code -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php  endwhile;
}
?>
    </div>
</div>
<!-- SELECT Doctor Name -->
<?php
if ( isset( $_POST[ 'search' ] ) && isset( $_POST[ 'doctName' ] ) ) {
    $name = $_POST[ 'doctName' ];
    $cats = dbConnect()->query( "SELECT * FROM doctor where name = '$name'" );
    while( $row = $cats->fetch_assoc() ):
    ?>
<div class='doctorList  col-lg-12   d-flex row w-100'>
    <div class='card mb-3 col-md-10 only'>
        <div class='row g-3 p-4'>
            <div class='col-md-3'>
                <img src='../admin/uploads/<?php echo $row[ 'img' ] ?>' class='img-fluid rounded-start h-75 w-80'
                    alt='...'>
            </div>
            <div class='col-md-8'>
                <div class='card-body'>
                    <h5 class='card-title'>Doctor
                        &nbsp;
                        :&nbsp;
                        <?php echo $row[ 'name' ] ?>( <i><?php echo $row[ 'name_pref' ] ?></i> )</h5>
                    <p class='card-text'>specialties:<?php echo $row[ 'specialties' ] ?></p>
                    <p class='card-text'>Contact:<?php echo $row[ 'phone' ] ?></p>
                    <!-- Button trigger modal -->
                    <button type='button' class='btn btn-primary' data-toggle='modal'
                        data-target='#exampleModalL<?php echo $row['name'] ?>'>
                        <i class='fa-regular fa-calendar-days'></i>&nbsp;
                        Schedule
                    </button>
                    <!-- Modal -->
                    <div class='modal fade' id='exampleModalL<?php echo $row['id'] ?>' tabindex='-1' role='dialog'
                        aria-labelledby='exampleModalLabel' aria-hidden='true'>
                        <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h5 class='modal-title' id='exampleModalLabel'>
                                        <?php echo $row[ 'name' ] ?>'s
                                        Schedule</h5>
                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                        <span aria-hidden='true'>&times;
                                        </span>
                                    </button>
                                </div>
                                <div class='modal-body'>
                                    <table>
                                        <tr>
                                            <th class=''>Day</th>
                                            <th class=''>Time From</th>
                                            <th class=''>Time To</th>
                                        </tr>
                                        <?php    
                    $catt = dbConnect()->query( "SELECT * FROM schedule where doct_id = {
        $doctor}
        " );
        while ( $moe = $catt->fetch_assoc() ):
        $timef =  $moe[ 'time_from' ];
        $timet =  $moe[ 'time_to' ];
        ?>

        <tr>
        <td class = 'w-25'>
        <?php echo $moe[ 'day' ]?>
        </td>
        <td class = 'w-25'><?php echo date( 'g:i A', strtotime( $timef ) );
        ?></td>
        <td class = 'w-25'><?php echo date( 'g:i A', strtotime( $timet ) );
        ?></td>
        </tr>
        <?php  endwhile;
        ?>
        </table>

        </div>
        <div class = 'modal-footer'>
        <button type = 'button' class = 'btn btn-secondary' data-dismiss = 'modal'>Close</button>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        <!-- SELECTED DEPTMENT NAME -->
        <?php  endwhile;
        ?>

        <?php
    }

    if ( isset( $_POST[ 'search' ] ) && isset( $_POST[ 'deptName' ] ) ) {

    }
    ?>

    <?php include'footer.php' ?>