<?php

/*Categories Page*/
ob_start();

session_start();

$pageTitle = 'Categories';

if (isset($_SESSION['username'])){

    include 'int.php';

$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

if ($do == 'Manage') {

    echo 'Welcome';

} elseif ($do == 'Add'){ ?>

    <h1 class="text-center">Add New Category</h1>

    <div class="container">
        <form class="form-horizontal" action="?do=Insert" method="POST">
            <!-- Start name field-->

            <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10 col-md-6">
                    <input type="text" name="name" class="form-control" autocomplete="off" required="required"
                           placeholder=" Name Of The Category"/>
                </div>
            </div>

            <!-- End name field-->

            <!-- Start Description field-->

            <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10 col-md-6">

                    <!--google dont remamber bassword-->
                    <input type="text" name="description" class="form-control"
                           placeholder="Describe The Category"/>

                </div>
            </div>

            <!-- End Description field-->

            <!-- Start email field-->

            <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10 col-md-6">
                    <input type="email" name="email" class="form-control" required="required"
                           placeholder="Email Must Be Valid"/>
                </div>
            </div>

            <!-- End email field-->

            <!-- Start fullname field-->

            <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label">Full Name</label>
                <div class="col-sm-10 col-md-6">
                    <input type="text" name="full" class="form-control" required="required"
                           placeholder="Full Name Appear In Your Profile Page"/>
                </div>
            </div>

            <!-- End fullname field-->

            <!-- Start submit field-->

            <div class="form-group form-group-lg">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" value="Add Member" class="btn btn-primary btn-lg"/>
                </div>
            </div>

            <!-- End submit field-->

        </form>
    </div>

<?php

} elseif ($do == 'Insert'){

} elseif ($do == 'Edit'){

} elseif ($do == 'Update'){

} elseif ($do == 'Delete') {


}
    include $tpl . 'footer.php';

} else {

    header ('Location: index.php');

    exit();
}

ob_end_flush();

?>
