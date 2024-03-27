<style>
.mt-5 {
    margin-top: 3.9rem !important;
}
</style>

<div class="container-fluid ">
    <div class="row flex-nowrap ">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark mt-5 position-fixed pt-3">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="home.php"
                    class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <i class="fa-solid fa-house-chimney fs-4"></i><span class="fs-5 ms-1 d-none d-sm-inline">Home</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">

                    <li>
                        <a href="#submenu1" data-bs-toggle="collapse"
                            class="nav-link px-0 align-middle text-decoration-none text-white">
                            <i class="fa-solid fa-file fs-4"></i> <span
                                class="ms-1 d-none d-sm-inline fs-5 text-white">Appointment</span> </a>
                        <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="appointmentlist.php" class="nav-link px-0"> <span
                                        class="d-none d-sm-inline ">View Appointment </span></a>
                            </li>
                            <li>
                                <a href="visitedappointment.php" class="nav-link px-0"> <span
                                        class="d-none d-sm-inline ">Finished Appointment</span></a>
                            </li>
                            <li>
                                <a href="cancelappointment.php" class="nav-link px-0"> <span
                                        class="d-none d-sm-inline ">Cancel Appointment</span></a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#submenu2" data-bs-toggle="collapse"
                            class="nav-link px-0 align-middle text-decoration-none text-white">
                            <i class="fa-solid fa-user-doctor fs-4"></i> <span
                                class="ms-1 d-none d-sm-inline fs-5 text-white">Profile</span></a>
                        <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="profile.php" class="nav-link px-0"> <span
                                        class="d-none d-sm-inline">View</span>Profile</a>
                            </li>
                            <li>
                                <a href="changepassword.php" class="nav-link px-0"> <span
                                        class="d-none d-sm-inline">Change </span> Password</a>
                            </li>
                        </ul>
                    </li>


            </div>
        </div>
    </div>
</div>