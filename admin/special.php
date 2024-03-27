<?php
include_once 'navber.php';
include_once 'sidebar.php';
include_once 'config.php';
error_reporting(0);

if ( isset( $_POST[ 'submit' ] ) ) {
    $name = $_POST[ 'name' ];
    $img = $_FILES[ 'file' ][ 'name' ];
    $qry = "INSERT INTO `special` (`id`, `name`, `img`) VALUES ('','$name','$img')";
    $result = mysqli_query( dbConnect(), $qry );
    if ( $result ) {
        $img = $_FILES[ 'file' ][ 'tmp_name' ];
        $imageName = $_FILES[ 'file' ][ 'name' ];
        $imagePath = 'uploads/'. $imageName;
        move_uploaded_file( $img, $imagePath );
        echo '<script type="text/Javascript"> alert("Register successfully.")</script>';
        header( 'Location: ' . $_SERVER[ 'PHP_SELF' ] );
    } else {
        echo 'Error inserting user: '. mysqli_error( $db );
    }
}
if ($_GET['action'] == 'delete_doct') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $result = delete_special($id);
        if ($result) {
            echo 1; // Return success
        } else {
            echo 0; // Return failure
        }
        exit;
    }
}
function delete_special($id) {
    $db = dbConnect();
    $qry = "DELETE FROM `special` WHERE `id` = $id";
    $result = mysqli_query($db, $qry);
    return $result;
}

?>
<style>
form {
    margin: 5rem 0px 0px 258px;
    width: 49%;
}

.doctList {
    margin: -250px 0px 0px 635px;
}

.doctList img {
    width: 250px;
    height: 200px;
}
</style>
<div class='col-md-6 doctForm float-right'>
    <form action='' id='manage-special' enctype='multipart/form-data' method='post'>
        <div class='card'>
            <div class='card-header'>
                Specialties Form
            </div>
            <div class='card-body'>
                <div class='form-group'>
                    <label for='' class='control-label'>Specialties Name</label>
                    <input type='text' class='form-control' name='name' placeholder='' required=''>
                </div>
                <div class='form-group'>
                    <label for='' class='control-label'>Image</label>
                    <input type='file' class='form-control' name='file'>
                </div>
            </div>

            <div class='card-footer'>
                <div class='row'>
                    <div class='col-md-12'>
                        <button class='btn btn-sm btn-primary col-sm-3 offset-md-3' name='submit'> Save</button>
                        <button class='btn btn-sm btn-success col-sm-3' type='button'>
                            Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- FORM Panel -->

<!-- Table Panel -->
<div class='col-md-7 doctList'>
    <div class='card'>
        <div class='card-body p-0'>
            <table class='table table-bordered table-hover m-0'>

                <thead>
                    <tr>
                        <th class='text-center'>#</th>
                        <th class='text-center'>Image</th>
                        <th class='text-center'>Specialties</th>
                        <th class='text-center'>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $cats = dbConnect()->query( 'SELECT * FROM special order by id asc' );
                    while( $row = $cats->fetch_assoc() ):
                    ?>
                    <tr>
                        <td class='text-center'><?php echo $i++ ?></td>
                        <td class='text-center'>
                            <img src='../admin/uploads/<?php echo $row[ 'img' ] ?>' alt=''>
                        </td>
                        <td class=''>
                            <p><b><?php echo $row[ 'name' ] ?></b></p>
                        </td>
                        <td class='text-center'>
                            <input type="text" id="myInput" value="<?php echo $row['id'] ?>" hidden>
                            <button class='btn btn-sm btn-primary edit_special'
                                data-id="<?php echo $row['id'] ?>">Edit</button>
                            <button class='btn btn-sm btn-danger delete_special'' type = ' button'
                                data-id="<?php echo $row['id'] ?>">Delete</button>
                        </td>
                    </tr>
                    <?php endwhile;
?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
    </script>
    <script>
    $(document).ready(function() {
        $('.edit_special').click(function() {
            var id = $(this).attr('data-id');
            // Redirect to another page
            window.location.href = "editspecial.php?id=" + id;
        });

        $('.delete_special').click(function() {
            var id = $(this).attr('data-id');
            if (confirm("Are you sure to delete this Specialties?")) {
                delete_doctor(id);
            }
        });

        function delete_doctor(id) {
            $.ajax({
                url: 'special.php?action=delete_doct',
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