<?php
include_once 'navber.php';
include_once 'sidebar.php';
include_once 'config.php';
$db=dbConnect();

if ($_GET['action'] == 'delete_pat') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $result = delete_patient($id);
        if ($result) {
            echo 1; // Return success
        } else {
            echo 0; // Return failure
        }
        exit;
    }
}
function delete_patient($id) {
    $db = dbConnect();
    $qry = "DELETE FROM `patient` WHERE `id` = $id";
    $result = mysqli_query($db, $qry);
    return $result;
}

?>
<style>
.table {
    margin-left: 18rem !important;
    margin-top: 5rem !important;
    width: 70%;
}

table {
    caption-side: top;
}
</style>



<div class="container-md-8 ">
    <table class="table table-light table-hover ">
        <caption class="fs-4 text-dark">Patient Lists</caption>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col"> Name</th>
                <th scope="col">Email</th>
                <th scope="col">Password</th>
                <th scope="col">Phone No.</th>
                <th scope="col">Date Of Birth:</th>
                <th scope="col">Gender</th>
                <th scope="col">Address</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
$num=1;
$apps=mysqli_query($db,"SELECT * FROM patient ORDER BY id DESC");
while($row=$apps->fetch_assoc()):

?>

            <tr>
                <th scope="row"><?php echo $num++ ?></th>
                <td><?php echo $row['name']?></td>
                <td><?php echo  $row['email']?></td>
                <td><?php  echo $row['password'] ?></td>
                <td><?php  echo $row['phone'] ?></td>
                <td><?php  echo  $row['dob'] ?></td>
                <td><?php  echo  $row['gender'] ?></td>
                <td><?php  echo  $row['address'] ?></td>
                <td class='text-center'>
                    <button class='btn btn-sm btn-danger delete_patient'' type = ' button'
                        data-id="<?php echo $row['id'] ?>">Delete</button>
                </td>
            </tr>
            <?php 
  endwhile; 
  ?>
        </tbody>
    </table>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
</script>
<script>
$(document).ready(function() {


    $('.delete_patient').click(function() {
        var id = $(this).attr('data-id');
        if (confirm("Are you sure to delete this Patient?")) {
            delete_patient(id);
        }
    });

    function delete_patient(id) {
        $.ajax({
            url: 'patientlist.php?action=delete_pat',
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