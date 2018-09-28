<?php

/*
     ===================
   ===== Items Page =====
     ===================
 */
ob_start();

session_start();

$pageTitle = 'Items';

    if (isset($_SESSION['username'])) {

    include 'int.php';

    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
}
    if ($do == 'Manage') {

        // Select All Users Except Admin
        $stmt = $con->prepare("SELECT
                                               items.*,
                                               categories.Name  AS category_name, 
                                               users.username 
                                        FROM 
                                               items 
                                        INNER JOIN
                                               categories 
                                        ON
                                               categories.iD = items.Cat_ID

                                        INNER JOIN 
                                               users 
                                        ON
                                               users.useriD = items.Member_iD
                                                                              ");
        // Execute The Statement

        $stmt->execute();

        // Assign To Variable

          $items = $stmt->fetchAll();

        ?>

        <h1 class="text-center">Manage Items</h1>
        <div class="container">
            <div class="table-responsive">
                <table class="main-table text-center table table-bordered">
                    <tr>
                        <td>#ID</td>
                        <td>Name</td>
                        <td>Description</td>
                        <td>Price</td>
                        <td>Adding Date</td>
                        <td>Category</td>
                        <td>Username</td>
                        <td>Control</td>
                    </tr>
                    <?php
                    foreach($items as $item){
                        echo "<tr>";
                        echo "<td>" . $item['Item_ID'] . "</td>";
                        echo "<td>" . $item['Name'] . "</td>";
                        echo "<td>" . $item['Description'] . "</td>";
                        echo "<td>" . $item['Price'] . "</td>";
                        echo "<td>" . $item['Add_Date'] . "</td>";
                        echo "<td>" . $item['category_name'] . "</td>";
                        echo "<td>" . $item['username'] . "</td>";
                        echo "<td>
                                                 <!-- Edit -->
                             <a href='items.php?do=Edit&itemid= " . $item['Item_ID'] . " 'class='btn btn-success'> <i class='fa fa-edit'></i> Edit</a>
                              <a href='items.php?do=Delete&itemid= " . $item['Item_ID'] . " 'class='btn btn-danger confirm'> <i class='far fa-closed-captioning'></i> Delete </a>";
                        if ($item['Approve'] == 0){
                            echo "<a href='items.php?do=Approve&itemid= " . $item['Item_ID'] .
                                 " 'class='btn btn-info activate'> 
                                  <i class=\"far fa-thumbs-up\"></i> Approve</a>";
                        }

                            echo"</td>";

                        echo "</tr>";

                    }

                    ?>
                    <tr>
                </table>
            </div>
            <a href= "items.php?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> New Item</a>

        </div>

<?php

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
            <!-- Start Members field-->
            <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label">Member</label>
                <div class="col-sm-10 col-md-6">
                    <select name="member">
                        <option value="0">...</option>
                     <?php
                     $stmt = $con->prepare("SELECT * FROM users");
                     $stmt->execute();
                     $users = $stmt->fetchAll();
                     foreach ($users as $user) {
                         echo "<option value='" .$user['useriD']  ." '>" . $user['username'] . "</option>";
                     }
                     ?>
                    </select>
                </div>
            </div>
            <!-- End Member field-->
            <!-- Start Members field-->
            <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label">Category</label>
                <div class="col-sm-10 col-md-6">
                    <select name="category">
                        <option value="0">...</option>
                        <?php
                        $stmt2 = $con->prepare("SELECT * FROM categories");
                        $stmt2->execute();
                        $cats = $stmt2->fetchAll();
                        foreach ($cats as $cat) {
                            echo "<option value='" .$cat['ID']  ." '>" . $cat['Name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <!-- End Member field-->

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

            $name    = $_POST['name'];
            $desc    = $_POST['description'];
            $price   = $_POST['price'];
            $country = $_POST['country'];
            $status  = $_POST['status'];
            $member  = $_POST['member'];
            $cat     = $_POST['category'];


            // validate The Form
            $formErrors = array();

            if (empty($name)) {
                $formErrors[] = 'Name can\'t be  <strong> Empty </strong>';
            }

            if (empty($desc)) {

                $formErrors[] = 'Description can\'t be  <strong> Empty </strong>';
            }
            if (empty($price)) {

                $formErrors[] = 'Price can\'t be  <strong> Empty </strong>';
            }

            if (empty($country)) {

                $formErrors[] = 'Country cant be  <strong> Empty</strong>';
            }
            if ($status == 0) {

                $formErrors[] = 'You Must Choose The Status <strong> Status</strong>';
            }
            if ($member == 0) {

                $formErrors[] = 'You Must Choose The Status <strong> Member</strong>';
            }

            if ($cat == 0) {

                $formErrors[] = 'You Must Choose The Status <strong> Category</strong>';
            }



            // Loop Into Errors Array And Echo It

            foreach ($formErrors as $error) {

                echo '<div class = "alert alert-danger">' . $error . '</div>';
            }

            // Check If Ther no Error Proceed The Update Operation
            if (empty($formErrors)) {

                // Check If User Exist in Database

                // Insert Userinfo Database

                $stmt = $con->prepare("INSERT INTO 
                                                 items(Name, Description, Price, Country_Made, Status, Add_Date, Cat_ID, Member_ID)  

                                             VALUES(:zname, :zdesc, :zprice, :zcountry, :zstatus, now(), :zcat, :zmember)");
                $stmt->execute(array(

                    'zname'    => $name,
                    'zdesc'    => $desc,
                    'zprice'   => $price,
                    'zcountry' => $country,
                    'zstatus'  => $status,
                    'zcat'     => $cat,
                    'zmember'  => $member


                ));

                // Echo Success Message

                $theMsg = "<div class = 'alert alert-success'>" . $stmt->rowCount() . 'Record Inserted </div>';

                redirectHome($theMsg, 'back', 4);

            }

        }else {

                echo "<div class='container'>";

                // Home Redirect function this function accept parameters

                $theMsg = '<div class = "alert alert-danger"> .  Sorry You Cant Browse This Page Directly</div>';

                redirectHome($theMsg, 'back', 4);

                echo "</div>";
            }

            echo "</div>";


    }
    elseif ($do == 'Edit') {

        // Check If Get Request item Is Numeric & Get Its Integer Value

        $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

        // Chek If The User Exist In Database
        // select all data depend on this id

        $stmt = $con->prepare("SELECT  * FROM items WHERE item_ID = ? ");

        // execute Query

        $stmt->execute(array($itemid));

        // fetch the data

        $item = $stmt->fetch();
        //  the row count
        $count = $stmt->rowCount();

        // if ther's such id show the form

        if (  $count > 0 ){    ?>

            <h1 class="text-center">Edit Item</h1>

            <div class="container">
                <form class="form-horizontal" action="?do=Update" method="POST">
                    <input type="hidden" name="itemid" value="<?php echo $itemid?>"/>

                    <!-- Start name field-->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10 col-md-6">
                            <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    placeholder=" Name Of The Item"
                                    value="<?php echo $item ['Name']?>"/>
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
                                    placeholder=" Description Of The Item"
                                    value="<?php echo $item ['Description']?>"/>

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
                                    placeholder=" Price Of The Item"
                                    value="<?php echo $item ['Price']?>"/>

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
                                    placeholder=" Country Of The Item"
                                    value="<?php echo $item ['Country_Made']?>"/>

                        </div>
                    </div>
                    <!-- End Country field-->
                    <!-- Start Status field-->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10 col-md-6">
                            <select name="status">
                                <option value="0">...</option>
                                <option value="1"<?php if ($item['Status'] == 1) { echo 'selected';}?>>New</option>
                                <option value="2"<?php if ($item['Status'] == 2) { echo 'selected';}?>>Like New</option>
                                <option value="3"<?php if ($item['Status'] == 3) { echo 'selected';}?>>Used</option>
                                <option value="4"<?php if ($item['Status'] == 4) { echo 'selected';}?>>Old</option>
                            </select>
                        </div>
                    </div>
                    <!-- End Status field-->
                    <!-- Start Members field-->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Member</label>
                        <div class="col-sm-10 col-md-6">
                            <select name="member">
                                <option value="0">...</option>
                                <?php
                                $stmt = $con->prepare("SELECT * FROM users");
                                $stmt->execute();
                                $users = $stmt->fetchAll();
                                foreach ($users as $user) {
                                    echo "<option value= '" .$user['useriD']  ." ' ";
                                    if ($item['Member_iD'] == $user['useriD']) { echo 'selected'; }
                                    echo">" . $user['username'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <!-- End Member field-->
                    <!-- Start Members field-->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Category</label>
                        <div class="col-sm-10 col-md-6">
                            <select name="category">
                                <option value="0">...</option>
                                <?php
                                $stmt2 = $con->prepare("SELECT * FROM categories");
                                $stmt2->execute();
                                $cats = $stmt2->fetchAll();
                                foreach ($cats as $cat) {
                                    echo "<option value='" .$cat['ID']  ." '";
                                    if ($item['Cat_ID'] == $cat['ID']) { echo 'selected'; }
                                    echo">" . $cat['Name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <!-- End Member field-->

                    <!-- Start submit field-->

                    <div class="form-group form-group-lg">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" value="Save Item" class="btn btn-primary btn-sm"/>
                        </div>
                    </div>

                    <!-- End submit field-->

                </form>
            </div>

            <?php

            // else show message

        } else {

            echo"<div class='container'>";

            $theMsg =  '<div class="alert alert-danger"> Theres  No Such ID</div>';

            redirectHome($theMsg);

            echo "</div>";
        }

        }
    elseif ($do == 'Update') {

        echo "<h1 class='text-center'>Update Item</h1>";

        echo "<div class = 'container'>";

        if ($_SERVER['REQUEST_METHOD']=='POST'){


            // Get variables Form The Form

            $id         =   $_POST['itemid'];
            $name       =   $_POST['name'];
            $desc       =   $_POST['description'];
            $price      =   $_POST['price'];
            $country    =   $_POST['country'];
            $status     =   $_POST['status'];
            $member     =   $_POST['member'];
            $cat        =   $_POST['category'];

            // validate The Form
            $formErrors = array();

            if (empty($name)) {
                $formErrors[] = 'Name can\'t be  <strong> Empty </strong>';
            }

            if (empty($desc)) {

                $formErrors[] = 'Description can\'t be  <strong> Empty </strong>';
            }
            if (empty($price)) {

                $formErrors[] = 'Price can\'t be  <strong> Empty </strong>';
            }

            if (empty($country)) {

                $formErrors[] = 'Country cant be  <strong> Empty</strong>';
            }
            if ($status == 0) {

                $formErrors[] = 'You Must Choose The Status <strong> Status</strong>';
            }
            if ($member == 0) {

                $formErrors[] = 'You Must Choose The Status <strong> Member</strong>';
            }

            if ($cat == 0) {

                $formErrors[] = 'You Must Choose The Status <strong> Category</strong>';
            }

            // Loop Into Errors Arry And Echo It

            foreach ($formErrors as $error){

                echo  '<div class = "alert alert-danger">' . $error . '</div>';
            }

            // Check If Thers no Error Proceed The Update Operation
            if (empty($formErrors)){



                // Update The Database With This Info

                $stmt = $con->prepare("UPDATE
                                                      items 
                                                SET   
                                                      name = ?,
                                                      Description = ?,
                                                      Price = ?,
                                                      Country_Made = ?,
                                                      Status = ?,
                                                      Cat_ID = ?,
                                                      Member_iD = ? 
                                                WHERE 
                                                      Item_ID = ?");

                $stmt->execute(array($name, $desc, $price, $country, $status, $cat, $member, $id));

                // Echo Success Message

                $theMsg =  "<div class = 'alert alert-success'>" .  $stmt->rowCount() . 'Record Updated</div>';

                redirectHome($theMsg, 'back', 4);
            }

        }else{

            $theMsg =  '<div class = "alert alert-danger"> Sorry You Cant Browse This Page Directly</div>';

            redirectHome($theMsg);

        }

        echo "</div>";
        }
    elseif ($do == 'Delete') {

        echo "<h1 class='text-center'>Delete Item</h1>";
        echo" <div class='container'>";

        // Check If Get Request Item ID Is Numeric & Get The Integer Value Of It

        $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

        // Check If The User Exist In Database

        // select all data depend on this id

        // $stmt = $con->prepare("SELECT  * FROM users WHERE UserID = ? LIMIT 1 ");

        $check = checkItem ('Item_ID', 'items', $itemid);



        // if ther's such id show the form

        if (  $check > 0 ) {

            $stmt = $con->prepare("DELETE FROM items WHERE Item_ID = :zid");

            $stmt->bindParam(":zid",$itemid);

            $stmt->execute();


            $theMsg = "<div class = 'alert alert-success'>" .  $stmt->rowCount() . 'Record Delete</div>';

            redirectHome($theMsg, 'back');

        }  else{

            $theMsg =  '<div class = "alert alert-danger">This ID is Not Exist</div>';

            redirectHome($theMsg);
        }

        echo '</div>';



    }
    elseif ($do == 'Approve') {

         echo "<h1 class='text-center'>Approve</h1>";
       echo" <div class='container'>";

       // Check If Get Request Item ID Numeric & get The Integer Value Of It

       $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

       // Check If The User Exist In Database

       // select all data depend on this id

       // $stmt = $con->prepare("SELECT  * FROM users WHERE UserID = ? LIMIT 1 ");

       $check = checkItem ('Item_ID', 'items', $itemid);



       // if ther's such id show the form

       if (  $check > 0 ) {

           $stmt = $con->prepare("UPDATE items SET Approve = 1 WHERE Item_ID = ?");


           $stmt->execute(array($itemid));


           $theMsg = "<div class = 'alert alert-success'>" .  $stmt->rowCount() . 'Record Activate</div>';

           redirectHome($theMsg, 'back');

       }  else{

           $theMsg =  '<div class = "alert alert-danger">This ID is Not Exist</div>';

           redirectHome($theMsg);
       }

       echo '</div>';

        include $tpl . 'footer.php';
    }
    else {
        header ('Location: index.php');
        exit();
    }

 ob_end_flush();

    ?>
