<?php
include_once 'navber.php';
include_once 'sidebar.php';
include_once 'config.php';

if ( isset( $_POST[ 'submit' ] ) ) {
    $doctorname = $_POST[ 'doctname' ];
    $position = $_POST[ 'name_pref' ];
    $phone =$_POST[ 'phone' ];
    $email = $_POST[ 'email' ];
    $password = $_POST[ 'password' ]; 
    $img = $_FILES[ 'file' ][ 'name' ];
    $time = time();
    $db = dbConnect();

    //Name of specialties
    $specilties = implode(',', $_POST['specialty_ids']);
    $qry = "SELECT name FROM special where id = $specilties ";
    $result = mysqli_query( $db, $qry );
    $row = $result->fetch_assoc();
    $dept_name = $row['name'];
    //HASH PASSWORD
    //$password = password_hash($password,PASSWORD_DEFAULT);
    //INSERT DATA
    if ( checkEmail( $email ) == true ) {
        $qry = "INSERT INTO `doctor`(`id` , `name`,`name_pref`, `specialties`,  `phone`, `email`, `password`, `img`, `create_at`) 
        VALUES ('','$doctorname','$position','$dept_name','$phone','$email','$password','$img','$time')";
        $result = mysqli_query( $db, $qry );
        if ( $result ) {
            $img = $_FILES[ 'file' ][ 'tmp_name' ];
            $imageName = $_FILES[ 'file' ][ 'name' ];
            $imagePath = 'uploads/'. $imageName;
            move_uploaded_file( $img, $imagePath );
            echo '<script type="text/Javascript"> alert("Register successfully.")</script>';
            header('Location: ' . $_SERVER['PHP_SELF']);
        } else {
            echo 'Error inserting user: '. mysqli_error( $db );
        }
    } else {
        echo '<script type="text/Javascript"> alert("Email is already exist!")</script>';
    }
}

if ($_GET['action'] == 'delete_doct') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $result = delete_doctor($id);
        if ($result) {
            echo 1; // Return success
        } else {
            echo 0; // Return failure
        }
        exit;
    }
}
//emial check function to check duplicate email
function checkEmail( $email )
 {
    $email = $email;
    $db = dbConnect();
    $qry = "SELECT * FROM `doctor` WHERE email = '$email'";
    $result = mysqli_query( $db, $qry );
    $row = $result->fetch_assoc();
    if ( $row == null ) {
        return true;
    } else {
        if ( $row[ 'email' ] == $email ) {
            return false;
        } else {
            return true;
        }
    }
}

// Function to delete a doctor from the database
function delete_doctor($id) {
    $db = dbConnect();
    $qry = "DELETE FROM `doctor` WHERE `id` = $id";
    $result = mysqli_query($db, $qry);
    return $result;
}


?>
<style>
form {
    margin: 3.5rem 0px 0px 255px;
    width: 49%;
}

.doctList {
    margin: -620px 0px 0px 630px;
}

.doctList img {
    width: 250px;
    height: 200px;
}
</style>
<form action='' id='manage-doctor' method='post' enctype='multipart/form-data'>
    <div class='col-md-6 doctForm float-right'>

        <div class='card'>
            <div class='card-header'>
                Doctor's Form
            </div>
            <div class="card-body">
                <div id="msg"></div>
                <input type="hidden">
                <div class="form-group">
                    <label class="control-label">Name</label>
                    <input name="doctname" class="form-control" required="">
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Prefix</label>
                    <input type="text" class="form-control" name="name_pref" placeholder="(M.D.)" required="">
                </div>
                <div class="form-group">
                    <label class="control-label">Medical Specialties</label> <br>
                    <select name="specialty_ids[]" multiple=""
                        class="custom-select col-md-9 ms-3 browser-default select2">
                        <?php 
                        $qry = dbConnect()->query("SELECT * FROM special order by name asc");
                            while($row=$qry->fetch_assoc()):
                         ?>
                        <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Phone Number</label>
                    <input type="text" name="phone" id="" class="form-control" required="">
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Email</label>
                    <input type="email" class="form-control" name="email" required="">
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Password</label>
                    <input type="password" class="form-control" name="password" value="doctor123">
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Image</label>
                    <input type="file" class="form-control" name="file" required="">
                </div>
                <div class="form-group">
                    <br>
                    <button class="btn btn-sm btn-primary col-sm-3 offset-md-3" name='submit'>Submit</button>
                    <button class="btn btn-sm btn-success col-sm-3" type="button">Cancel</button>
                </div>
            </div>
        </div>
</form>
</div>
<!-- FORM Panel -->

<!-- Table Panel -->
<div class="col-md-7 doctList">
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-bordered table-hover m-0">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Image</th>
                        <th class="text-center">Info</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  
                    $num = 1;
                    $cats = dbConnect()->query("SELECT * FROM doctor order by id asc");
                    while($row=$cats->fetch_assoc()):
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $num++ ?></td>
                        <td class="text-center">
                            <img src="../admin/uploads/<?php echo $row['img'] ?>" alt="">
                        </td>
                        <td class="">
                            <p>Name: <b><?php echo "Dr. ".$row['name'].', '.$row['name_pref'] ?></b></p>
                            <p><small>Email: <b><?php echo $row['email'] ?></b></small></p>
                            <p><small>Phone <b><?php echo $row['phone'] ?></b></small></p>
                            <p><small>Specialties <b><?php echo $row['specialties'] ?></b></small></p>
                            <p><small><a
                                        href="manageSchedule.php?id=<?php echo $row['id']; ?>&&name=<?php echo $row['name']; ?>"><button
                                            type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target=" #exampleModalCenter"><i class='fa fa-calendar'></i>
                                            Schedule
                                        </button></a>
                                </small></p>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-primary edit_doctor" type="button"
                                data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['name'] ?>"
                                data-name_pref="<?php echo $row['name_pref'] ?>" data-img="<?php echo $row['img'] ?>"><a
                                    href="editdoctor.php?id=<?php //echo $row['id'] ?>"></a>Edit</button>
                            <button class="btn btn-sm btn-danger delete_doctor" type="button"
                                data-id="<?php echo $row['id']; ?>">Delete</button>
                        </td>
                    </tr>
                    <?php endwhile;
?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('.edit_doctor').click(function() {
        var id = $(this).attr('data-id');
        // Redirect to another page
        window.location.href = "editdoctor.php?id=" + id;
    });
    $('.delete_doctor').click(function() {
        var id = $(this).attr('data-id');
        if (confirm("Are you sure to delete this doctor?")) {
            delete_doctor(id);
        }
    });

    function delete_doctor(id) {
        $.ajax({
            url: 'doctorlist.php?action=delete_doct',
            method: 'POST',
            data: {
                id: id
            },
            success: function(resp) {
                if (resp == 1) {
                    alert("Data successfully deleted");
                    setTimeout(function() {
                        location.reload();
                    }, 500);
                }
            }
        });
    }
});
</script>