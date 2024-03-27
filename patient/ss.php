<<?php
//  include "header.php"
include_once 's.php';
 ?> 
<style>
    .search{
      margin-left: 27%;
    }
    .doctorList{
        padding: 30px;
        margin: 10px;
    }
    .modal-open .card{
    opacity: 0.2;
  }
  .card {
    margin-left:20%;
    max-width: 800px;
  }
</style>
<div class="search p-5 -8 mt-5">
<form class="row g-3 ">
  <div class="col-auto">
    <label for="doctorname" class="visually-hidden"></label>
    <input type="text" class="form-control" id="inputPassword2" placeholder="Doctor name">
  </div>
  <div class="col-auto">
  <select class="form-select" aria-label="Default select example">
  <option selected>Select this specialties</option>
  <option value="1">Orthopaedics</option>
  <option value="2">Neurologists</option>
  <option value="3">Cardiology</option>
</select>
  </div>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary mb-3">Search</button>
  </div>
</form>
</div>
<div class="doctorList p-4  d-flex-col"> <!-- Main div -->    
    <!-- card end -->
<div class="card mb-3 me-5">
  <div class="row g-3 p-4">
    <div class="col-md-3">
      <img src="images/doctor1.jpg" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">Doctor Name:</h5>
        <p class="card-text">specialties:</p>
        <p class="card-text">Contact:</p>
        <a href="ss.php?id=9" class="btn btn-primary">See Schedule</a>
        <a href="ss.php?id=9" class="btn btn-primary">Set Appointment</a>
      </div>
    </div>
  </div>
</div>
    <!-- card end -->
    <!-- card start -->
<div class="card mb-3">
  <div class="row g-0 p-4">
    <div class="col-md-3">
      <img src="images/doctor2.jpg" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">Doctor name:</h5>
        <p class="card-text">specialties:</p>
        <p class="card-text">Contact:</p>
        <a href="ss.php?id=10" class="btn btn-primary">See Schedule</a>
        <a href="ss.php?id=10" class="btn btn-primary">Set Appointment</a>
      </div>
    </div>
  </div>
</div>
    <!-- card end -->
</div>
<?php include"footer.php" ?>


<?php
if($_GET['id']==10){
echo genschedule();
}
function genschedule() {
    echo "<div class='modal fade' id='exampleModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <form action='' method='post'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='exampleModalLabel'>Appointment Form</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <input type='hidden' name='idd' value=''>
                        <div class='mb-3'>
                            <label for='recipient-name' class='col-form-label'>Date:</label>
                            <input type='date' class='form-control' id='date' name='sddate'>
                        </div>
                        <div class='mb-3'>
                            <label for='message-text' class='col-form-label'>Time:</label>
                            <input type='time' class='form-control' id='time' name='sdtime'>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                        <button type='submit' name='setAppoint' value='' class='btn btn-primary'>Set Appointment</button>
                    </div>
                </div>
            </form>
        </div>
    </div>";

    // if (isset($_POST['setAppoint']) && $row['id'] == $_POST['idd']) {
    //     $ID = $_POST['idd'];
    //     $name = $_POST['sddate'];
    //     $time = $_POST['sdtime'];
    //     $day = changeDay($name);
    //     $qry = "SELECT * FROM schedule where doct_id = '$ID' and day = '$day'";
    //     $result = mysqli_query(dbConnect(), $qry);
    //     if ($result) {
    //         $rr = $result->fetch_assoc();
    //         if (checkTime($time, $rr['time_from'], $rr['time_to'])) {
    //             $qrys = "INSERT INTO appointment( id, doct_id, pat_id, date, time, status ) VALUES ( '', '$ID', '1', '$name', '$time', '1' )";
    //             $res = mysqli_query(dbConnect(), $qrys);
    //             echo "<script type='text/javascript'>alert('Appointment is Successfully Requested')</script>";
    //         } else {
    //             echo "<script type='text/javascript'>alert('Please Check *! Requested date or Docoter's time');</script>";
    //         }
    //     }
    // }
    //echo $modal_content;
}

?>