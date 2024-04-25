<!DOCTYPE html>
<html lang="en">
<?php 
 include('session_customer.php');
if(!isset($_SESSION['login_customer'])){
    session_destroy();
    header("location: customerlogin.php");
}
?> 
<title>Book Machine </title>
<head>
    <script type="text/javascript" src="assets/ajs/angular.min.js"> </script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="shortcut icon" type="image/png" href="assets/img/p.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>  
  <script type="text/javascript" src="assets/js/custom.js"></script> 
 <link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
</head>
<body ng-app=""> 


      <!-- Navigation -->
     <!-- Navigation -->
     <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                    </button>
                <a class="navbar-brand page-scroll" href="index.php">
                  Farm Rentals </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->

            <?php
                if(isset($_SESSION['login_client'])){
            ?> 
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_client']; ?></a>
                    </li>
                    <li>
                    <ul class="nav navbar-nav navbar-right">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Control Panel <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="entercar.php">Add Machine</a></li>
              <li> <a href="enterdriver.php"> Add Operator</a></li>
              <li> <a href="clientview.php">View</a></li>

            </ul>
            </li>
          </ul>
                    </li>
                    <li>
                        <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                    </li>
                </ul>
            </div>
            
            <?php
                }
                else if (isset($_SESSION['login_customer'])){
            ?>
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_customer']; ?></a>
                    </li>
                    <ul class="nav navbar-nav">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Garagge <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="prereturncar.php">Return Now</a></li>
              <li> <a href="mybookings.php"> My Bookings</a></li>
            </ul>
            </li>
          </ul>
                    <li>
                        <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                    </li>
                </ul>
            </div>

            <?php
            }
                else {
            ?>

            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="clientlogin.php">Owner</a>
                    </li>
                    <li>
                        <a href="customerlogin.php">Customer</a>
                    </li>
                    <li>
                        <a href="#"> FAQ </a>
                    </li>
                </ul>
            </div>
                <?php   }
                ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    
<div class="container" style="margin-top: 65px;" >
    <div class="col-md-7" style="float: none; margin: 0 auto;">
      <div class="form-area">
        <form role="form" action="bookingconfirm.php" method="POST">
        <br style="clear: both">
          <br>

        <?php
        $MACHINE_ID = $_GET["id"];
        $sql1 = "SELECT * FROM MACHINES WHERE MACHINE_ID = '$MACHINE_ID'";
        $result1 = mysqli_query($conn, $sql1);

        if(mysqli_num_rows($result1)){
            while($row1 = mysqli_fetch_assoc($result1)){
                $MACHINE_NAME = $row1["MACHINE_NAME"];
                $MACHINE_REGISTRATION_NO = $row1["MACHINE_REGISTRATION_NO"];
                $FUELED_PRICE_PER_HR = $row1["FUELED_PRICE_PER_HR"];
                $NON_FUELED_PRICE_PER_HR = $row1["NON_FUELED_PRICE_PER_HR"];
                $FUELED_PRICE_PER_DAY = $row1["FUELED_PRICE_PER_DAY"];
                $NON_FUELED_PRICE_PER_DAY = $row1["NON_FUELED_PRICE_PER_DAY"];
            }
        }

        ?>

          <!-- <div class="form-group"> -->
              <h5> Selected Machine:&nbsp;  <b><?php echo($MACHINE_NAME);?></b></h5>
         <!-- </div> -->
         
          <!-- <div class="form-group"> -->
            <h5> Registration No.:&nbsp;<b> <?php echo($MACHINE_REGISTRATION_NO);?></b></h5>
          <!-- </div>      -->
        <!-- <div class="form-group"> -->
        <?php $today = date("Y-m-d") ?>
          <label><h5>Start Date:</h5></label>
            <input type="date" name="rent_start_date" min="<?php echo($today);?>" required="">
            &nbsp; 
          <label><h5>End Date:</h5></label>
          <input type="date" name="rent_end_date" min="<?php echo($today);?>" required="">
        <!-- </div>      -->
        
        <h5> Choose your car type:  &nbsp;
            <input onclick="reveal()" type="radio" name="radio" value="Fueled" ng-model="myVar"> <b>Fueled </b>&nbsp;
            <input onclick="reveal()" type="radio" name="radio" value="Non_fueled" ng-model="myVar"><b>Non Fueled </b>
                
        
        <div ng-switch="myVar"> 
        <div ng-switch-default>
                    <!-- <div class="form-group"> -->
                <h5>Charge: <h5>    
                <!-- </div>    -->
                     </div>
                    <div ng-switch-when="Fueled">
                    <!-- <div class="form-group"> -->
                <h5>Charge: <b><?php echo("Kshs. " . $FUELED_PRICE_PER_HR . "/hr and Kshs. " . $FUELED_PRICE_PER_DAY . "/day");?></b><h5>    
                <!-- </div>    -->
                     </div>
                     <div ng-switch-when="Non_fueled">
                     <!-- <div class="form-group"> -->
                <h5>Charge: <b><?php echo("Kshs. " . $NON_FUELED_PRICE_PER_HR . "/hr and Kshs. " . $NON_FUELED_PRICE_PER_DAY . "/day");?></b><h5>    
                <!-- </div>   -->
                     </div>
        </div>

         <h5> Charge type:  &nbsp;
            <input onclick="reveal()" type="radio" name="radio1" value="hr"><b> per hr</b> &nbsp;
            <input onclick="reveal()" type="radio" name="radio1" value="days"><b> per day</b>

            <br><br>
                <!-- <form class="form-group"> -->
                Select an operator: &nbsp;
                <select name="OPERATOR_ID_FROM_DROPDOWN" ng-model="myVar1">
                        <?php
                        $sql2 = "SELECT * FROM OPERATORS O WHERE O.OPERATOR_AVAILABILITY = 'yes' AND O.OWNER_USERNAME IN (SELECT MO.OWNER_USERNAME FROM MACHINE_OWNERS MO WHERE MO.MACHINE_ID = '$MACHINE_ID')";
                        $result2 = mysqli_query($conn, $sql2);

                        if(mysqli_num_rows($result2) > 0){
                            while($row2 = mysqli_fetch_assoc($result2)){
                                $OPERATOR_ID = $row2["OPERATOR_ID"];
                                $OPERATOR_NAME = $row2["OPERATOR_NAME"];
                                $OPERATOR_GENDER = $row2["OPERATOR_GENDER"];
                                $OPERATOR_PHONE = $row2["OPERATOR_PHONE"];
                    ?>
  

                    <option value="<?php echo($OPERATOR_ID); ?>"><?php echo($OPERATOR_NAME); ?>
                   

                    <?php }} 
                    else{
                        ?>
                    Sorry! No Operators are currently available, try again later...
                        <?php
                    }
                    ?>
                </select>
                <!-- </form> -->
                <div ng-switch="myVar1">
                

                <?php
                        $sql3 = "SELECT * FROM OPERATORS O WHERE O.OPERATOR_AVAILABILITY = 'yes' AND O.OWNER_USERNAME IN (SELECT MO.OWNER_USERNAME FROM MACHINE_OWNERS MO WHERE MO.MACHINE_ID = '$MACHINE_ID')";
                        $result3 = mysqli_query($conn, $sql3);

                        if(mysqli_num_rows($result3) > 0){
                            while($row3 = mysqli_fetch_assoc($result3)){
                                $OPERATOR_ID = $row3["OPERATOR_ID"];
                                $OPERATOR_NAME = $row3["OPERATOR_NAME"];
                                $OPERATOR_GENDER = $row3["OPERATOR_GENDER"];
                                $OPERATOR_PHONE = $row3["OPERATOR_PHONE"];

                ?>

                <div ng-switch-when="<?php echo($OPERATOR_ID); ?>">
                    <h5>Operator Name:&nbsp; <b><?php echo($OPERATOR_NAME); ?></b></h5>
                    <p>Gender:&nbsp; <b><?php echo($OPERATOR_GENDER); ?></b> </p>
                    <p>Contact:&nbsp; <b><?php echo($OPERATOR_PHONE); ?></b> </p>
                </div>
                <?php }} ?>
                </div>
                <input type="hidden" name="hidden_machineid" value="<?php echo $MACHINE_ID; ?>">
                
         
           <input type="submit"name="submit" value="Rent Now" class="btn btn-warning pull-right">     
        </form>
        
      </div>
      <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
            <h6><strong>Note:</strong> You will be charged with extra <span class="text-danger">Kshs. 1500</span> for each day after the due date ends.</h6>
        </div>
    </div>

</body>
<footer class="site-footer">
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <h5>© <?php echo date("Y"); ?> Farm Rentals</h5>
                </div>
            </div>
        </div>
    </footer>
</html>