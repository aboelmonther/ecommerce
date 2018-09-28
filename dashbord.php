<?php
ob_start();// Output Buffering Start
session_start();

if (isset($_SESSION['username'])){
     
     $pageTitle = 'Dashboard';

   include 'int.php';
   /* start Dashboard Page*/

    $numUsers = 5 ; // Number Of Latest Users

     $latestUser = getLatest("*","users","useriD", $numUsers);// Latest User Array

    $numItems = 6 ;// Number Of latest Items

    $latestItems = getlatest("*", 'items','Item_ID', $numItems);// Latest Items Array


    ?>
    <div class="home-stats">
        <div class="container  text-center">
            <h1>Dashboard</h1>
            <div class="row">
                <div class="col-md-3">
                    <div class="stat st-members">
                        <i class="fa fa-users"></i>
                        <div class="info">
                            Total Members
                            <span>
                            <a href="members.php"><?php echo countItems('useriD', 'users')?></a>
                        </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat st-pending">
                        <i class="fa fa-user-plus"></i>
                        <div class="info">
                            Pending Members
                            <span>
                                <a href="members.php?do=Manage&page=Pending">
                                <?php echo checkItem("Regstatus", "users", 0)?></a>
                            </span>
                        </div>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat st-items">
                        <i class="fa fa-tag"></i>
                       <div class="info">
                           Total Items
                           <span>
                               <a href="items.php"><?php echo countItems('Item_ID', 'items')?>
                            </a></span>
                       </div>

                    </div>
                 </div>
                <div class="col-md-3">
                    <div class="stat st-comments">
                  <i class="fa fa-comments"></i>
                        <div class="info">
                            Total Comments
                            <span>0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="latest">
          <div class="container ">
              <div class="row">
                  <div class="col-sm-6">

                      <div class="panel panel-defualt">
                          <div class="panel-heading">
                              <i class="fa fa-users"></i> Latest <?php echo $numUsers ?> Register Usersa
                              <span class="toggle-info pull-right">
                                  <i class="fa fa-plus fa-lg"></i>
                              </span>
                          </div>
                          <div class="panel-body">
                              <ul class="list-unstyled latest-users">
                                      <?php

                                         foreach ($latestUser as $user) {

                                              echo '<li>';
                                                  echo $user['username'];
                                                  echo '<a href="members.php?do=Edit&userid= '. $user['useriD'] . '">';
                                                  echo '<span class="btn btn-success pull-right">';
                                                       echo '<i class="fa fa-edit"></i> Edit';
                                              if ($user['RegStatus'] == 0){

                                                   echo "<a href='members.php?do=Activate&userid= " . $user['useriD'] . " 'class='btn btn-info pull-right activate'> <i class='far fa-closed-captioning'></i> Activate</a>";
                                              }

                                                  echo '</span>';
                                                  echo'</a>';
                                              echo '</li>';
                                          }
                                      ?>
                              </ul>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="panel panel-defualt">
                          <div class="panel-heading">
                              <i class="fa fa-tag"></i>Latest Items
                              <span class="toggle-info pull-right">
                                  <i class="fa fa-plus fa-lg"></i>
                              </span>
                          </div>
                          <div class="panel-body">
                              <ul class="list-unstyled latest-users">
                                  <?php

                                  foreach ($latestItems as $item) {

                                      echo '<li>';
                                          echo $item['Name'];
                                          echo '<a href="items.php?do=Edit&itemid= '. $item['Item_ID'] . '">';
                                          echo '<span class="btn btn-success pull-right">';
                                          echo '<i class="fa fa-edit"></i> Edit';
                                          if ($item['Approve'] == 0){

                                              echo "<a
                                               href='items.php?do=Approve&itemid= " . $item['Item_ID'] .
                                                  " 'class='btn btn-info pull-right activate'> 
                                               <i class='far fa-closed-captioning'></i> Approve</a>";
                                          }

                                          echo '</span>';
                                          echo'</a>';
                                      echo '</li>';
                                  }
                                  ?>
                              </ul>
                          </div>
                      </div>
                  </div>

              </div>
          </div>
    </div>



  <?php

    /* End Dashbord Page*/

   include $tpl . 'footer.php' ;

          } else {

          	header('location: index.php');

          	exit();

          }

ob_end_flush();

?>