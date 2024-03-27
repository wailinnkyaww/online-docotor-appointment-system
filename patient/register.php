<?php
include_once '../admin/config.php';
include_once 'header.php';
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['contact'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];

    function checkEmail($email)
    {
        $email = $email;
        $db = dbConnect();
        $qry = "SELECT * FROM `patient` WHERE email = '$email'";
        $result = mysqli_query($db, $qry);
        $row = $result->fetch_assoc();
        if ($row == null) {
            return true;
        } else {
            if ($row['email'] == $email) {
                return false;
            } else {
                return true;
            }
        }
    }
    if (checkEmail($email) == true) {
        $qry = "INSERT INTO `patient`(`id`, `name`, `email`, `password`, `phone`, `dob`, `gender`, `address`) VALUES ('','$name','$email','$password','$phone','$dob','$gender','$address')";
        $result = mysqli_query(dbConnect(), $qry);
        if ($result) {
            echo '<script type="text/javascript">';
            echo 'alert("Register successfully.");';
            echo 'window.location.href = "index.php";';
            // Redirect after showing the alert
            echo '</script>';
        } else {
            echo 'Error inserting user: ' . mysqli_error($db);
        }
    } else {
        echo '<script type="text/Javascript"> alert("Email is already exist!")</script>';
    }
}
?>
<style>
    body {
        background: url(images/modelPhoto.jpg );
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;

    }

    label {
        color: darkblue;
        font-size: 18px;
        font-weight: 400;
    }

    #signup-form {
        background-color: #fff;
        padding: 30px;
        margin-top: 100px;

    }
</style>

<body>

    <div class='container-fluid col-md-4'>
        <form action='' id='signup-form' method='post'>
            <h3>Create your new account</h3>
            <div class='form-group'>
                <label for='' class='control-label'>Name:</label>
                <input type='text' name='name' required='' class='form-control'>
            </div>
            <div class='form-group'>
                <label for='' class='control-label'>Email:</label>
                <input type='email' name='email' required='' class='form-control'>
            </div>
            <div class='form-group'>
                <label for='' class='control-label'>Password:</label>
                <input type='password' name='password' required='' class='form-control'>
            </div>
            <div class='form-group'>
                <label for='' class='control-label'>Contact( Phone no ):</label>
                <input type='tel' name='contact' required='' class='form-control'>
            </div>
            <div class='form-group'>
                <label for='' class='control-label'>Date of Birth:</label>
                <input type='date' name='dob' required='' class='form-control'>
            </div><br>
            <label for='' class='control-label'>Gender</label><br>
            <div class='form-check form-check-inline'>
                <input class='form-check-input' type='radio' name='gender' id='male' value='male' checked>
                <label class='form-check-label' for='male'>Male</label>
            </div>
            <div class='form-check form-check-inline'>
                <input class='form-check-input' type='radio' name='gender' id='female' value='female'>
                <label class='form-check-label' for='female'>Female</label>
            </div><br>

            <div class='form-group'>
                <label for='' class='control-label'>Address:</label>
                <textarea cols='30' rows='3' name='address' required='' class='form-control'></textarea>
            </div><br>
            <button type='button' class='button btn btn-info btn-secondary btn-sm' data-dismiss='modal'><a href='index.php' style='text-decoration: none; color:black'>Cancel</a></button>
            <button type='submit' name='submit' class='button btn btn-info btn-sm'>Create</button>
        </form>
    </div>
</body>