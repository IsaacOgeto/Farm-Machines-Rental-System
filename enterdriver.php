
<!DOCTYPE html>
<html>
<?php 
include('session_client.php'); ?>
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
<body>
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
                    <li>
                        <a href="#">History</a>
                    </li>
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
        <form role="form" action="enterdriver1.php" method="POST">
        <br style="clear: both">
          <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> Enter Operator Details </h3>

          <div class="form-group">
            <input type="text" class="form-control" id="OPERATOR_NAME" name="OPERATOR_NAME" placeholder="Operator Name " required autofocus="">
          </div>

          <div class="form-group">
            <input type="text" class="form-control" id="DL_NUMBER" name="DL_NUMBER" placeholder="Driving License Number" required>
          </div>     

          <div class="form-group">
            <input type="text" class="form-control" id="OPERATOR_PHONE" name="OPERATOR_PHONE" placeholder="Contact" required>
          </div>

          <div class="form-group">
            <input type="text" class="form-control" id="OPERATOR_ADDRESS" name="OPERATOR_ADDRESS" placeholder="Address" required>
          </div>

          <div class="form-group">
            <input type="text" class="form-control" id="OPERATOR_GENDER" name="OPERATOR_GENDER" placeholder="Gender" required>
          </div>

           <button type="submit" id="submit" name="submit" class="btn btn-primary pull-right"> Add Operator</button>    
        </form>
      </div>
    </div>
    <div class="col-md-9" style="float: none; margin: 0 auto;">
    <div class="form-area" style="padding: 0px 100px 100px 100px;">
        <br style="clear: both">
          <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> My Operators </h3>
<?php
// Storing Session
$user_check=$_SESSION['login_client'];
$sql = "SELECT * FROM OPERATORS O WHERE O.OWNER_USERNAME='$user_check' ORDER BY OPERATOR_NAME";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  ?>

  <table class="table table-striped">
    <thead class="thead-dark">
      <tr>
        <th>     </th>
        <th> Name</th>
        <th> Gender </th>
        <th> License No. </th>
        <th> Contact </th>
        <th> Address </th>
        <th> Availability </th>
        <!-- 
          
         -->
      </tr>
    </thead>

    <?PHP
      //OUTPUT DATA OF EACH ROW
      while($row = mysqli_fetch_assoc($result)){
    ?>

  <tbody>
    <tr>
      <td> <span class="glyphicon glyphicon-menu-right"></span> </td>
      <td><?php echo $row["OPERATOR_NAME"]; ?></td>
      <td><?php echo $row["OPERATOR_GENDER"]; ?></td>
      <td><?php echo $row["DL_NUMBER"]; ?></td>
      <td><?php echo $row["OPERATOR_PHONE"]; ?></td>
      <td><?php echo $row["OPERATOR_ADDRESS"]; ?></td>
      <td><?php echo $row["OPERATOR_AVAILABILITY"]; ?></td>
      <td>
          <form role="form" action="delete_operator.php" method="post">
                        <input type="hidden" name="OPERATOR_ID" value="<?php echo $row['OPERATOR_ID']; ?>">
                        <button type="submit" class="btn btn-danger">Delete</button>
          </form>

      </td>
      
    </tr>
  </tbody>

  <?php } ?>
  </table>
    <br>


  <?php } else { ?>

  <h4><center>0 Operators available</center> </h4>

  <?php } ?>

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