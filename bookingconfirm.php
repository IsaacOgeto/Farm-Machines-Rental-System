 <!DOCTYPE html>
<html >

<?php
 include('session_customer.php');
if(!isset($_SESSION['login_customer'])){
    session_destroy();
    header("location: customerlogin.php");
}
?>

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/bookingconfirm.css" />
  </head>

<body>

<?php


    $type = $_POST['radio'];
    $CHARGE_TYPE = $_POST['radio1'];
    $OPERATOR_ID = $_POST['OPERATOR_ID_FROM_DROPDOWN'];
    $customer_username = $_SESSION["login_customer"];
    $MACHINE_ID = $conn->real_escape_string($_POST['hidden_machineid']);
    $RENT_START_DATE = date('Y-m-d', strtotime($_POST['rent_start_date']));
    $RENT_END_DATE = date('Y-m-d', strtotime($_POST['rent_end_date']));
    $RETURN_STATUS = "NR"; // not returned
    $CHARGE = "NA";


    function dateDiff($start, $end) {
        $start_ts = strtotime($start);
        $end_ts = strtotime($end);
        $diff = $end_ts - $start_ts;
        return round($diff / 86400);
    }
    
    $err_date = dateDiff("$RENT_START_DATE", "$RENT_END_DATE");

    $sql0 = "SELECT * FROM MACHINES WHERE MACHINE_ID = '$MACHINE_ID'";
    $result0 = $conn->query($sql0);

    if (mysqli_num_rows($result0) > 0) {
        while($row0 = mysqli_fetch_assoc($result0)) {

            if($type == "Fueled" && $CHARGE_TYPE == "hr"){
                $CHARGE = $row0["FUELED_PRICE_PER_HR"];
            } else if ($type == "Fueled" && $CHARGE_TYPE == "days"){
                $CHARGE = $row0["FUELED_PRICE_PER_DAY"];
            } else if ($type == "Non_fueled" && $CHARGE_TYPE == "hr"){
                $CHARGE = $row0["NON_FUELED_PRICE_PER_HR"];
            } else if ($type == "Non_fueled" && $CHARGE_TYPE == "days"){
                $CHARGE = $row0["NON_FUELED_PRICE_PER_DAY"];
            } else {
                $CHARGE = "NA";
            }
        }
    }
    if($err_date >= 0) { 
    $sql1 = "INSERT into RENTED_MACHINES(customer_username,MACHINE_ID,OPERATOR_ID,BOOKING_DATE,RENT_START_DATE,RENT_END_DATE,CHARGE,CHARGE_TYPE,RETURN_STATUS) 
    VALUES('" . $customer_username . "','" . $MACHINE_ID . "','" . $OPERATOR_ID . "','" . date("Y-m-d") ."','" . $RENT_START_DATE ."','" . $RENT_END_DATE . "','" . $CHARGE . "','" . $CHARGE_TYPE . "','" . $RETURN_STATUS . "')";
    $result1 = $conn->query($sql1);

    $sql2 = "UPDATE MACHINES SET MACHINE_AVAILABILITY = 'no' WHERE MACHINE_ID = '$MACHINE_ID'";
    $result2 = $conn->query($sql2);

    $sql3 = "UPDATE OPERATORS SET OPERATOR_AVAILABILITY = 'no' WHERE OPERATOR_ID = '$OPERATOR_ID'";
    $result3 = $conn->query($sql3);

    $sql4 = "SELECT * FROM  MACHINES M, MACHINE_OWNERS MO, OPERATORS O, RENTED_MACHINES RM WHERE M.MACHINE_ID = '$MACHINE_ID' AND O.OPERATOR_ID = '$OPERATOR_ID'";
    $result4 = $conn->query($sql4);


    if (mysqli_num_rows($result4) > 0) {

        while($row = mysqli_fetch_assoc($result4)) {
            $ID = $row["ID"];
            $MACHINE_NAME = $row["MACHINE_NAME"];
            $MACHINE_REGISTRATION_NO = $row["MACHINE_REGISTRATION_NO"];
            $OPERATOR_NAME = $row["OPERATOR_NAME"];
            $OPERATOR_GENDER = $row["OPERATOR_GENDER"];
            $DL_NUMBER = $row["DL_NUMBER"];
            $OPERATOR_PHONE = $row["OPERATOR_PHONE"];
            //$OWNER_NAME = $row["OWNER_NAME"];
            //$OWNER_PHONE = $row["MO.OWNER_PHONE"];
        }
    }

    if (!$result1 | !$result2 | !$result3){
        die("Couldnt enter data: ".$conn->error);
    }

?>
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
    <div class="container">
        <div class="jumbotron">
            <h1 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span> Booking Confirmed.</h1>
        </div>
    </div>
    <br>

    <h2 class="text-center"> Thank you for using Farm Rental System! We wish you a lovely day. </h2>

 

    <h3 class="text-center"> <strong>Your Order Number:</strong> <span style="color: blue;"><?php echo "$ID"; ?></span> </h3>


    <div class="container">
        <h5 class="text-center">Please read the following information about your order.</h5>
        <div class="box">
            <div class="col-md-10" style="float: none; margin: 0 auto; text-align: center;">
                <h3 style="color: orange;">Your booking has been received and placed into out order processing system.</h3>
                <br>
                <h4>Please make a note of your <strong>order number</strong> now and keep in the event you need to communicate with us about your order.</h4>
                <br>
                <h3 style="color: orange;">Invoice</h3>
                <br>
            </div>
            <div class="col-md-10" style="float: none; margin: 0 auto; ">
                <h4> <strong>Machine Name: </strong> <?php echo $MACHINE_NAME; ?></h4>
                <br>
                <h4> <strong>Machine Registration:</strong> <?php echo $MACHINE_REGISTRATION_NO; ?></h4>
                <br>
                
                <?php     
                if($CHARGE_TYPE == "days"){
                ?>
                     <h4> <strong>Charge:</strong> Kshs. <?php echo $CHARGE; ?>/day</h4>
                <?php } else {
                    ?>
                    <h4> <strong>Charge:</strong> Kshs. <?php echo $CHARGE; ?>/hr</h4>

                <?php } ?>

                <br>
                <h4> <strong>Booking Date: </strong> <?php echo date("Y-m-d"); ?> </h4>
                <br>
                <h4> <strong>Start Date: </strong> <?php echo $RENT_START_DATE; ?></h4>
                <br>
                <h4> <strong>Return Date: </strong> <?php echo $RENT_END_DATE; ?></h4>
                <br>
                <h4> <strong>Operator Name: </strong> <?php echo $OPERATOR_NAME; ?> </h4>
                <br>
                <h4> <strong>Operator Gender: </strong> <?php echo $OPERATOR_GENDER; ?> </h4>
                <br>
                <h4> <strong>Operator License number: </strong>  <?php echo $DL_NUMBER; ?> </h4>
                <br>
                <h4> <strong>Operator Contact:</strong>  <?php echo $OPERATOR_PHONE; ?></h4>
                <br>
<!--                /<h4> <strong>Owner Name:</strong>  --><?php //echo $OWNER_NAME; ?><!--</h4>-->
<!--                <br>-->
<!--                <h4> <strong>Owner Contact: </strong> --><?php //echo $OWNER_PHONE; ?><!--</h4>-->
<!--                <br>-->
            </div>
        </div>
        <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
            <h6>Warning! <strong>Do not reload this page</strong> or the above display will be lost. If you want a hardcopy of this page, please print it now.</h6>
        </div>
    </div>
</body>
<?php } else { ?>
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
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Garage <span class="caret"></span> </a>
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
                        <a href="clientlogin.php">Employee</a>
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
    <div class="container">
	<div class="jumbotron" style="text-align: center;">
        You have selected an incorrect date.
        <br><br>
</div>
                <?php } ?>
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