<?php
session_start();
$msg = "";
$error = "";
$delmsg = "";
$con = mysqli_connect('localhost', 'root', '', 'bookdb');

//db connection
try{
    $conn=new PDO("mysql:host=localhost;dbname=bookdb;",'root','');
    echo "<script>console.log('connection successful');</script>";
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "<script>window.alert('Database connection error');</script>";
}


if ((!isset($_SESSION['username'])) || isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: ../../login.php");
} else {
    $user_id=$_SESSION['user_id'];
    $user_name=$_SESSION['username'];

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>Online Book Shop | Manage Shopkeeper List</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!--        <link href="assets/css/materialdesignicons.css.map" rel="stylesheet" type="text/css"/>-->
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.css">
        <script src="assets/js/modernizr.min.js"></script>

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <?php include('includes/topheader.php'); ?>

            <!-- ========== Left Sidebar Start ========== -->
            <?php include('includes/leftsidebar.php'); ?>
            <!-- Left Sidebar End -->


            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">


                        <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Manage Shopkeeper List</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Admin</a>
                                        </li>
                                        <li>
                                            <a href="#">Shopkeeper List </a>
                                        </li>
                                        <li class="active">
                                            Manage Shopkeeper List
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->


                        <div class="row">
                            <div class="col-sm-6">

                                <?php if ($msg) { ?>
                                    <div class="alert alert-success" role="alert">
                                        <strong>Well done!</strong> <?php echo htmlentities($msg); ?>
                                    </div>
                                <?php } ?>

                                <?php if ($delmsg) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Oh snap!</strong> <?php echo htmlentities($delmsg); ?>
                                    </div>
                                <?php } ?>


                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="demo-box m-t-20">

                                        <div class="table-responsive">
                                            <table class="table m-0 table-colored-bordered table-bordered-primary">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Shopkeeper Name</th>
                                                        <th>Active</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    try{
                                                        $sql= "Select * from users where usertype = 2";
                                                        $cnt = 1;
                                                        $adminobject=$conn->query($sql);
                                                        $adminTab= $adminobject->fetchAll();
                                                        foreach($adminTab as $key){
                                                            
                                                                    ?>
                                                                    <tr>
                                                                        <th scope="row"><?php echo htmlentities($cnt); ?></th>
                                                                        <td><?php echo $key[8]; ?></td> <!-- customer name -->
                                                                        <td id="updateApprvVal<?php echo $key[9]; ?>">
                                                                        <?php
                                                                        if($key[9] == 0){
                                                                            echo 'No'; 
                                                                        }else {
                                                                            echo 'Yes';
                                                                        }
                                                                         
                                                                         
                                                                         ?></td> <!-- apprv -->
                                                                        <td>
                                                                            <a style="cursor: pointer;" onclick="statusUpdate(1,<?php echo $key[0]; ?>)"><i class="fa fa-check" style="color: #3AF629;"></i></a>
                                                                            &nbsp;
                                                                            <a style="cursor: pointer;" onclick="statusUpdate(0,<?php echo $key[0]; ?>)"><i class="fa fa-times" style="color: #f05050"></i></a>
                                                                        </td>
                                                                    </tr>
                                                                    <?php

                                                            
                                                            
                                                        $cnt++;
                                                        }/* users  */
                                                    }catch(PDOException $err){
                                                        echo $err;
                                                    }

                                                    ?>

                                                </tbody>

                                            </table>
                                        </div>


                                    </div>

                                </div>


                            </div>
                            <!--- end row -->


                            


                        </div> <!-- container -->

                    </div> <!-- content -->
                    <?php include('includes/footer.php'); ?>
                </div>

            </div>
            <!-- END wrapper -->


<script>
    var resizefunc = [];
    //update user active functionality  
    function statusUpdate(updateVal,admin_orderID){
        var ajaxreq=new XMLHttpRequest();
        ajaxreq.open("GET","updateApprv_ajax.php?updateVal="+updateVal+"&admin_orderID="+admin_orderID );
        //console.log(member.id);
        ajaxreq.onreadystatechange=function ()
        {
        if(ajaxreq.readyState==4 && ajaxreq.status==200)
                {


                    var response=ajaxreq.responseText;
                    
                    var divelm=document.getElementById('updateApprvVal'+admin_orderID);

                    if(updateVal == 0){
                        divelm.innerHTML='No';
                        divelm.style.color = "Red";
                    }
                    if(updateVal == 1)
                    {
                        divelm.innerHTML='Yes';
                        divelm.style.color = "#00FF40";
                    }

                    
                    
                }
        }
        
        ajaxreq.send();
    }
</script>

            <!-- jQuery  -->
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/bootstrap.min.js"></script>
            <script src="assets/js/detect.js"></script>
            <script src="assets/js/fastclick.js"></script>
            <script src="assets/js/jquery.blockUI.js"></script>
            <script src="assets/js/waves.js"></script>
            <script src="assets/js/jquery.slimscroll.js"></script>
            <script src="assets/js/jquery.scrollTo.min.js"></script>
            <script src="../plugins/switchery/switchery.min.js"></script>

            <!-- App js -->
            <script src="assets/js/jquery.core.js"></script>
            <script src="assets/js/jquery.app.js"></script>

    </body>

    </html>
<?php } ?>