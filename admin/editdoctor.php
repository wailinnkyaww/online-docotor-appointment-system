<?php
include_once 'navber.php';
include_once 'sidebar.php';
include_once 'config.php';
if ( isset( $_POST[ 'submit' ] ) ) {
    $doctorname = $_POST[ 'doctname' ];
    $position = $_POST[ 'name_pref' ];
    $specialties = $_POST[ 'specialty_ids' ];
    $phone = $_POST[ 'phone' ];
    $email = $_POST[ 'email' ];
    $password = $_POST[ 'password' ];
    if ( $img = $_FILES[ 'file' ][ 'name' ] == null ) {
        $img = $_POST[ 'oldimg' ];
    } else {
        $img = $_FILES[ 'file' ][ 'name' ];

    }

    // $specilties = implode( ',', $_POST[ 'specialty_ids' ] );
    // $qry = "SELECT name FROM special where id = $specilties ";
    // $result = mysqli_query( dbConnect(), $qry );
    // $how = $result->fetch_assoc();
    // $dept_name = $how[ 'name' ];
    if ( $_POST[ 'specialty_ids' ] == null ) {
        $dept = $_POST[ 'old_specialties' ];
    } else {
        $dept = $dept_name;
    }
    $id = $_GET[ 'id' ];
    $time = time();
    $db = dbConnect();
    $qry = "UPDATE `doctor` SET `name`='$doctorname',`name_pref`='$position',`specialties`='$dept',`phone`='$phone',`email`='$email',`password`='$password',`img`='$img',`create_at`='' WHERE id = $id";
    $result = mysqli_query( $db, $qry );
    if ( $result ) {
        $img = $_FILES[ 'file' ][ 'tmp_name' ];
        $imageName = $_FILES[ 'file' ][ 'name' ];
        $imagePath = 'uploads/'. $imageName;
        move_uploaded_file( $img, $imagePath );
        echo '<script type="text/Javascript"> alert("Update successfully.")</script>';
        echo "<script>window.location.href='doctorlist.php';</script>";
        exit();
    } else {
        echo 'Error inserting user: '. mysqli_error( $db );
    }
}

?>
<style>
.doctForm {
    margin: 5rem 0px 0px 300px;
}
</style>
<div class='col-md-9 doctForm float-right'>
    <?php
$id = $_GET[ 'id' ];
$cats = dbConnect()->query( "SELECT * FROM doctor where id = {$id} " );
while( $row = $cats->fetch_assoc() ):
?>
    <form action='' id='manage-doctor' method='post' enctype='multipart/form-data' id='manage_doctor'>

        <div class='card'>
            <div class='card-header'>
                Doctor's Form
            </div>
            <div class="card-body">
                <div id="msg"></div>
                <input type="hidden" name="id">
                <div class="form-group">
                    <label class="control-label">Name</label>
                    <input name="doctname" id="" class="form-control" value="<?php echo $row['name'] ?>" required="">
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Prefix</label>
                    <input type="text" class="form-control" name="name_pref" value="<?php echo $row['name_pref']; ?>"
                        required="">
                </div>
                <div class="form-group">
                    <label class="control-label ">Medical Specialties</label>
                    <p name="old_specialties" value="<?php echo $row['specialties'] ?>" id="" class="form-control">
                        Selected Specialties
                        : <b><?php echo $row['specialties'] ?></b> </p>
                    <select name="specialty_ids[]" id="" multiple="" class="custom-select browser-default select2">
                        <?php 
                        $qry = dbConnect()->query("SELECT * FROM special order by id asc");
                            while($mow=$qry->fetch_assoc()):
                         ?>
                        <option value="<?php echo $mow['id'] ?>"><?php echo $mow['name'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Phone Number</label>
                    <input type="text" name="phone" id="" class="form-control" value="<?php echo $row['phone'] ?>"
                        required="">
                </div>
                <div class=" form-group">
                    <label for="" class="control-label">Email</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $row['email'] ?>"
                        required="">
                </div>
                <div class=" form-group">
                    <label for="" class="control-label">Password</label>
                    <input type="password" class="form-control" value="<?php echo $row['password'] ?>" name=" password">
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Image</label> <br>
                    <input type="file" class="form-control" name="file" value="">
                    <input type="text" name="oldimg" value="<?php echo $row['img'] ?>" hidden>
                </div>
                <div class="form-group">
                    <br>
                    <button class="btn btn-sm btn-primary col-sm-3 offset-md-3" name='submit'>Submit</button>
                    <button class='btn btn-sm btn-success col-sm-3' type='button'><a href='doctorlist.php' style='text-decoration: none;
color:white'>
                            Cancel </a></button>
                </div>
            </div>
            <?php endwhile;
?>
        </div>
    </form>
</div>
<!-- FORM Panel -->