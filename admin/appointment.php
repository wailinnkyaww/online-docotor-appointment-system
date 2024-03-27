<?php
include_once 'navber.php';
include_once 'sidebar.php';
include_once 'config.php';
$db=dbConnect();

if ($_GET['action'] == 'delete_appoint') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $result = delete_appointment($id);
        if ($result) {
            echo 1; // Return success
        } else {
            echo 0; // Return failure
        }
        header('Location:'.$_SERVER['PHP_SELF']);
        exit;
    }
}
function delete_appointment($id) {
    $db = dbConnect();
    $qry = "DELETE FROM `appointment` WHERE `id` = $id";
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
        <caption class="fs-4 text-dark">Appointment Lists</caption>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Date</th>
                <th scope="col">Patient Name</th>
                <th scope="col">Doctor Name</th>
                <th scope="col">Day</th>
                <th scope="col">Schedule</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
$num=1;
$apps=mysqli_query($db,"SELECT * FROM appointment ORDER BY id DESC");
while($row=$apps->fetch_assoc()):

?>

            <tr>
                <th scope="row"><?php echo $num++ ?></th>
                <td><?php
                echo $row[ 'date' ] ? date("d-m-y",strtotime($row['date'])): 'no';
                ?></td>
                <td><?php echo $row['pat_name']?></td>
                <td><?php echo 'Dr.'. $row['doct_name']?></td>
                <td><?php  echo changeDay($row['date']) ?></td>
                <td><?php  $time = $row['time'];echo changeTime($time); ?></td>
                <td><?php  echo  $row['status'] ?></td>
                <td class='text-center'>
                    <input type="text" id="myInput" value="<?php echo $row['id'] ?>" hidden>
                    <button class='btn btn-sm btn-primary edit_appointment'
                        data-id="<?php echo $row['id'] ?>">Edit</button>
                    <button class='btn btn-sm btn-danger delete_appointment'' type = ' button'
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
    $('.edit_appointment').click(function() {
        var id = $(this).attr('data-id');
        // Redirect to another page
        window.location.href = "editappointment.php?id=" + id;
    });

    $('.delete_appointment').click(function() {
        var id = $(this).attr('data-id');
        if (confirm("Are you sure to delete this Appointments?")) {
            delete_appointment(id);
        }
    });

    function delete_appointment(id) {
        $.ajax({
            url: 'appointment.php?action=delete_appoint',
            method: 'POST',
            data: {
                id: id
            },
            success: function(resp) {
                if (resp == 1) {
                    alert("Data successfully deleted");
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }
            }
        });
    }


});
</script>