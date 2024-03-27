<?php
include_once 'navber.php';
include_once 'sidebar.php';
include_once 'config.php';
if ( isset( $_POST[ 'submit' ] ) ) {
    $id = $_GET[ 'id' ];
    $name = $_POST[ 'name' ];
    $img = $_FILES[ 'file' ][ 'name' ];
    if ( $img = $_FILES[ 'file' ][ 'name' ] == null ) {
        $img = $_POST[ 'oldimg' ];
    } else {
        $img = $_FILES[ 'file' ][ 'name' ];

    }

    $qry = "UPDATE `special` SET `name`='$name',`img`='$img' WHERE id = $id";
    $result = mysqli_query( dbConnect(), $qry );
    if ( $result ) {
        $img = $_FILES[ 'file' ][ 'tmp_name' ];
        $imageName = $_FILES[ 'file' ][ 'name' ];
        $imagePath = 'uploads/'. $imageName;
        move_uploaded_file( $img, $imagePath );
        echo '<script type="text/Javascript"> alert("Edit successfully.")</script>';
        echo "<script>window.location.href='special.php';</script>";
    } else {
        echo 'Error inserting user: '. mysqli_error( $db );
    }
}
?>
<style>
.doctForm {
    margin: 5rem 0px 0px 400px;
}

img {
    margin-left: 20px;
    width: 400px;
    height: 200px;
}
</style>
<div class='col-md-6 doctForm float-right'>
    <?php
$id = $_GET[ 'id' ];
$cats = dbConnect()->query( "SELECT * FROM special where id = {$id}" );
while( $row = $cats->fetch_assoc() ):
?>
    <form action='' id='manage-special' enctype='multipart/form-data' method='post'>
        <div class='card'>
            <div class='card-header'>
                Specialties Form
            </div>
            <div class='card-body'>
                <div class='form-group'>
                    <label for='' class='control-label'>Specialties Name</label>
                    <input type='text' class='form-control' name='name' value="<?php echo $row[ 'name' ] ?>"
                        required=''>
                </div>
                <div class='form-group'>
                    <label for='' class='control-label'>Image</label><br>
                    <img src='../admin/uploads/<?php echo $row[ 'img' ] ?>' alt=''>
                    <br>
                    <input type='text' name='oldimg' value="<?php echo $row['img'] ?>" hidden> <br>
                    <input type='file' class='form-control' name='file'>
                </div>
            </div>

            <div class='card-footer'>
                <div class='row'>
                    <div class='col-md-12'>
                        <button class='btn btn-sm btn-primary col-sm-3 offset-md-3' name='submit'> Save</button>
                        <button class='btn btn-sm btn-success col-sm-3' type='button'><a href='special.php'
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