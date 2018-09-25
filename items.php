<?php

/*
     ===================
   ===== Items Page =====
     ===================
 */
ob_start();

session_start();

$pageTitle = 'Items';

if (isset($_SESSION['username']))
{

    include 'int.php';

    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

    if ($do == 'Manage') {

    echo 'welcome to items page';
 }
    elseif ($do == 'Add')
    { ?>


        <h1 class="text-center">Add New Item</h1>

         <div class="container">
        <form class="form-horizontal" action="?do=Insert" method="POST">
            <!-- Start name field-->
            <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10 col-md-6">
                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        placeholder=" Name Of The Item" />
                </div>
            </div>
            <!-- End name field-->
            <!-- Start Description field-->
            <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10 col-md-6">
                    <input
                        type="text"
                        name="description"
                        class="form-control"
                        placeholder=" Description Of The Item" />
                </div>
            </div>
            <!-- End Description field-->
            <!-- Start Price field-->
            <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label">Price</label>
                <div class="col-sm-10 col-md-6">
                    <input
                        type="text"
                        name="price"
                        class="form-control"
                        placeholder=" Price Of The Item" />
                </div>
            </div>
            <!-- End Description field-->
            <!-- Start Country field-->
            <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label">Country</label>
                <div class="col-sm-10 col-md-6">
                    <input
                        type="text"
                        name="country"
                        class="form-control"
                        placeholder=" Country Of The Item" />
                </div>
            </div>
            <!-- End Country field-->
            <!-- Start Status field-->
            <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-10 col-md-6">
                  <select name="status">
                      <option value="0">...</option>
                      <option value="1">New</option>
                      <option value="2">Like New</option>
                      <option value="3">Used</option>
                      <option value="4">Old</option>
                  </select>
                </div>
            </div>
            <!-- End Status field-->

            <!-- Start submit field-->

            <div class="form-group form-group-lg">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" value="Add Item" class="btn btn-primary btn-sm"/>
                </div>
            </div>

            <!-- End submit field-->

        </form>
    </div>
        <?php

    }
    elseif ($do == 'Insert') {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            echo "<h1 class='text-center'>Insert Item</h1>";

            echo "<div class = 'container'>";


            // Get variables Form The Form

            $name = $_POST['name'];
            $desc = $_POST['description'];
            $price = $_POST['price'];
            $country = $_POST['country'];
            $status = $_POST['status'];

            // validate The Form
            $formErrors = array();

            if (empty($name)) {

                $formErrors[] = 'Name can\'t be  <strong> Empty</strong>';

            }

            $formErrors = array();

            if (strlen($desc)) {

                $formErrors[] = 'Description can\'t be  <strong> Empty</strong>';

            }
            if (empty($price)) {

                $formErrors[] = 'Price can\'t be  <strong> Empty</strong>';

                if (empty($country)) {

                    $formErrors[] = 'Country cant be  <strong> Empty</strong>';
                }
                if ($status === 0) {

                    $formErrors[] = 'You Must Choose The Status<strong> Status</strong>';
                }


                // Loop Into Errors Arry And Echo It

                foreach ($formErrors as $error) {

                    echo '<div class = "alert alert-danger">' . $error . '</div>';
                }

                // Check If Ther no Error Proceed The Update Operation

                if (empty($formErrors)) {

                    // Check If User Exist in Database

                    $check = checkItem("username", "users", $user);

                    if ($check == 1) {

                        $theMsg = '<div class="alert alert-danger">Sorry This User Is Exist</div>';

                        redirectHome($theMsg);

                    } else {
                        // Insert Userinfo Database

                        $stmt = $con->prepare("INSERT INTO users(username, password, Email, FullName, RegStatus, Date)  

                                             VALUES(:zuser, :zpass, :zmail, :zname, 1, now()) ");
                        $stmt->execute(array(

                            'zuser' => $user,
                            'zpass' => $hashPass,
                            'zmail' => $email,
                            'zname' => $name

                        ));

                        // Echo Success Message

                        $theMsg = "<div class = 'alert alert-success'>" . $stmt->rowCount() . 'Record Inserted</div>';

                        redirectHome($theMsg, 'back', 4);

                    }
                }

            } else {

                echo "<div class='container'>";

                // Home Redirect function this function accept parameters

                $theMsg = '<div class = "alert alert-danger"> .  Sorry You Cant Browse This Page Directly</div>';

                redirectHome($theMsg, 'back', 4);

                echo "</div>";
            }

            echo "</div>";

        }
    }
    elseif ($do == 'Edit') {

        }
    elseif ($do == 'Update') {

        }
    elseif ($do == 'Delete') {

        }
    elseif ($do == 'Approve') {


            include $tpl . 'footer.php';
    }

} else {
    header ('Location: index.php');
    exit();
}

 ob_end_flush();

    ?>
