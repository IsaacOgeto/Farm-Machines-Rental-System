<!DOCTYPE html>
<html>
<?php 
session_start(); 
require 'connection.php';
$conn = Connect();
?>
<head>
<link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
<link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
</head>
<body ID="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
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
              <li> <a href="returncar.php">Return Now</a></li>
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
<?php
function dateDiff($start, $end) {
    $start_ts = strtotime($start);
    $end_ts = strtotime($end);
    $diff = $end_ts - $start_ts;
    return round($diff / 86400);
}
 $ID = $_GET["ID"];
 $sql1 = "SELECT M.MACHINE_NAME, M.MACHINE_REGISTRATION_NO, RM.RENT_START_DATE, RM.RENT_END_DATE, RM.CHARGE, RM.CHARGE_TYPE, O.OPERATOR_NAME, O.OPERATOR_PHONE
 FROM RENTED_MACHINES RM, MACHINES M, OPERATORS O
 WHERE ID = '$ID' AND M.MACHINE_ID=RM.MACHINE_ID AND O.OPERATOR_ID = RM.OPERATOR_ID";
 $result1 = $conn->query($sql1);
 if (mysqli_num_rows($result1) > 0) {
    while($row = mysqli_fetch_assoc($result1)) {
        $MACHINE_NAME = $row["MACHINE_NAME"];
        $MACHINE_REGISTRATION_NO = $row["MACHINE_REGISTRATION_NO"];
        $OPERATOR_NAME = $row["OPERATOR_NAME"];
        $OPERATOR_PHONE = $row["OPERATOR_PHONE"];
        $RENT_START_DATE = $row["RENT_START_DATE"];
        $RENT_END_DATE = $row["RENT_END_DATE"];
        $CHARGE = $row["CHARGE"];
        $CHARGE_TYPE = $row["CHARGE_TYPE"];
        $NO_OF_DAYS = dateDiff("$RENT_START_DATE", "$RENT_END_DATE");
    }
}
?>
    <div class="container" style="margin-top: 65px;" >
    <div class="col-md-7" style="float: none; margin: 0 auto;">
      <div class="form-area">
        <form role="form" action="printbill.php?ID=<?php echo $ID ?>" method="POST">
        <br style="clear: both">
          <h3 style="margin-bottom: 5px; text-align: center; font-size: 30px;"> Work Details </h3>
          <h6 style="margin-bottom: 25px; text-align: center; font-size: 12px;"> Allow your operator to fill the below form </h6>

           <h5> Machine:&nbsp;  <?php echo($MACHINE_NAME);?></h5>

           <h5> Machine Number:&nbsp;  <?php echo($MACHINE_REGISTRATION_NO);?></h5>

           <h5> Rent date:&nbsp;  <?php echo($RENT_START_DATE);?></h5>

           <h5> End Date:&nbsp;  <?php echo($RENT_END_DATE);?></h5>

           <h5> Charge:&nbsp;  Kshs. <?php 
            if($CHARGE_TYPE == "days"){
                    echo ($CHARGE . "/day");
                } else {
                    echo ($CHARGE . "/hr");
                }
            ?>
            </h5>

           <h5> Operator Name:&nbsp;  <?php echo($OPERATOR_NAME);?></h5>

           <h5> Operator Contact:&nbsp;  <?php echo($OPERATOR_PHONE);?></h5>
          <?php if($CHARGE_TYPE == "hr") { ?>
          <div class="form-group">
            <input type="text" class="form-control" ID="HOURS_OR_DAYS" name="HOURS_OR_DAYS" placeholder="Enter the time taken (in hr)" required="" autofocus>
          </div>
          <?php }  else { ?>
            <h5> Number of Day(s):&nbsp;  <?php echo($NO_OF_DAYS);?></h5>
            <input type="hidden" name="HOURS_OR_DAYS" value="<?php echo $NO_OF_DAYS; ?>">
          <?php } ?>
          <input type="hidden" name="hid_fare" value="<?php echo $CHARGE; ?>">

           <input type="submit" name="submit" value="submit" class="btn btn-success pull-right">    
        </form>
      </div>
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