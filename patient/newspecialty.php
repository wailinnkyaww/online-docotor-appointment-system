<?php
include_once 'header.php';
include_once '../admin/config.php';
?>
<style>
.search {
    margin-left: 25%;
}

.doctorList {
    width: 100%;
    padding-top: 20px;
    padding-left: 0px;
    margin: 10px 0px 0px -0px;
}

.card {
    margin-left: 5px;
}

.only {
    margin-left: 1%;
}
</style>

<div class='search p-5 -8 mt-5'>
    <form class='row g-3 ' method='post' action=''>
        <div class='col-auto'>
            <label for='doctorname' class='visually-hidden'></label>
            <input type='text' class='form-control' name='DoctName' placeholder='Doctor name'>
        </div>
        <div class='col-auto'>
            <select name='deptName' id='' aria-label='Default select example' class='form-select'>
                <option></option>
                <?php
$qry = dbConnect()->query( 'SELECT * FROM special ORDER BY id ASC' );
while ( $row = $qry->fetch_assoc() ) :
?>
                <option value="<?php echo $row['name'] ?>"><?php echo $row[ 'name' ] ?></option>
                <?php endwhile;
?>
            </select>
        </div>
        <div class='col-auto'>
            <button type='submit' name='search' class='btn btn-primary mb-3'>Search</button>
        </div>
    </form>
    <!---------------------->