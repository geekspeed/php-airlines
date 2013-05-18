
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Hood Airlines</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 60px;
      }

      /* Custom container */
      .container {
        margin: 0 auto;
        max-width: 1000px;
      }
      .container > hr {
        margin: 60px 0;
      }

      /* Main marketing message and sign up button */
      .jumbotron {
        margin: 80px 0;
        text-align: center;
      }
      .jumbotron h1 {
        font-size: 100px;
        line-height: 1;
      }
      .jumbotron .lead {
        font-size: 24px;
        line-height: 1.25;
      }
      .jumbotron .btn {
        font-size: 21px;
        padding: 14px 24px;
      }

      /* Supporting marketing content */
      .marketing {
        margin: 60px 0;
      }
      .marketing p + h4 {
        margin-top: 28px;
      }


      /* Customize the navbar links to be fill the entire space of the .navbar */
      .navbar .navbar-inner {
        padding: 0;
      }
      .navbar .nav {
        margin: 0;
        display: table;
        width: 100%;
      }
      .navbar .nav li {
        display: table-cell;
        float: none;
      }
      .navbar .nav li a {
        font-weight: bold;
        text-align: center;
        border-left: 1px solid rgba(255,255,255,.75);
        border-right: 1px solid rgba(0,0,0,.1);
      }
      .navbar .nav li:first-child a {
        border-left: 0;
        border-radius: 3px 0 0 3px;
      }
      .navbar .nav li:last-child a {
        border-right: 0;
        border-radius: 0 3px 3px 0;
      }

      .navbar .nav .dropdown-menu li {
        display: block;
      }

      .navbar .nav .dropdown-menu li a {
        text-align: left;
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

  </head>

  <body>

    <div class="container">

      <div class="masthead">
        <h3 class="muted">Hood Airlines</h3>
        <div class="navbar">
          <div class="navbar-inner">
            <div class="container">
              <ul class="nav">
                <li><a href="index.php">Airline</a></li>
                <li><a href="add-airport.php">Airport</a></li>
                <li><a href="add-flightinfo.php">Flight Info</a></li>
                <li><a href="add-flight.php">Flight</a></li>
                <li class="active"><a href="purchase.php">Purchase</a></li>
                <li><a href="cancel.php">Cancel</a></li>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Queries <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="airport-info.php">Airport Info</a></li>
                  <li><a href="flight-info.php">Flight Info</a></li>
                  <li><a href="specific-flight.php">Specific Flight</a></li>
                  <li><a href="ticket-info.php">Ticket Info</a></li>
                </ul>
              </li>
              </ul>
            </div>
          </div>
        </div><!-- /.navbar -->
      </div>

      <div class="row-fluid">
        <div class="span12">
          <?php
            require_once('config.php');
              $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE) or die("<div class='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Error!</strong> Could not connect to database.</div>");
               
            if(isset($_POST['submit']) && isset($_POST['seatNum']))
            {

              $customerID = mysqli_real_escape_string($dbc, $_POST['customerID']);
              $airline = mysqli_real_escape_string($dbc, $_POST['airline']);
              $flightNum = mysqli_real_escape_string($dbc, $_POST['flightNumber']);
              $date = mysqli_real_escape_string($dbc, $_POST['date']);
              $seatNum = mysqli_real_escape_string($dbc, $_POST['seatNum']);

              if(intval($customerID) > 99 && intval($customerID) < 1000)
              {
                // Is the seat less than the number of seats on that flight?
                $how_many_seats = "SELECT num_of_seats FROM `Flights` WHERE `airline` = '$airline' AND `flightNumber` = '$flightNumber' AND `date` = '$date'";
                $number_of_seats_result = mysqli_query($dbc, $how_many_seats);
                $number_of_seats_row = mysqli_fetch_array($number_of_seats_result);
                $number_of_seats = intval($number_of_seats_row['num_of_seats']);

                // Less than because we're counting seat 0
                if($seatNum < $num_of_seats)
                {
                  $purchase_ticket = "INSERT INTO `comp3715project1`.`Tickets` (`customerID`, `airline`, `flightNumber`, `date`, `seat_number`) VALUES ('$customerID', '$airline', '$flightNum', '2013-03-14', '$seatNum')";
                  $result = mysqli_query($dbc, $purchase_ticket) or die("<div class='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Error!</strong> Buying Ticket.\n" .  mysqli_error($dbc) . "</div>");
                  if($result)
                  {
                    echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Success!</strong> Ticket Bought.</div>";
                  }
                // Seat number is too high
                } else {
                  echo "<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Error!</strong> That seat is not on this flight! No jump seats.</div>";
                }
                
              // CustomerID must be between 100 and 999 inclusive
              } else {
                echo "<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Error!</strong> Customer ID must be between 100 and 999.</div>";
              }
              
            
            } else if(isset($_POST['airline']) && isset($_POST['flightNumber'])) {
              $airline = mysqli_real_escape_string($dbc, $_POST['airline']);
              $flightNumber = mysqli_real_escape_string($dbc, $_POST['flightNumber']);
              $customerID = mysqli_real_escape_string($dbc, $_POST['customerID']);
              ?>

              <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-horizontal">
            <fieldset>
              <legend>Purchase Ticket</legend>
              <input type="hidden" name="customerID" value="<?php echo $customerID; ?>">
              <input type="hidden" name="airline" value="<?php echo $airline; ?>">
              <input type="hidden" name="flightNumber" value="<?php echo $flightNumber; ?>">
          <div class="control-group">
            <label class="control-label" for="date">Date</label>
            <div class="controls">
              <select name="date">
                <?php
                  $select_dates_from_flightnum = "SELECT `date` FROM `Flights` WHERE `airline` = '$airline' AND `flightNumber` = '$flightNumber'";
                  $result = mysqli_query($dbc, $select_dates_from_flightnum);
                  while($row = mysqli_fetch_array($result))
                  {
                    echo "<option value='" . $row['date'] . "'>" . $row['date'] . "</option>";
                  }

                ?>
              </select>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="seatNum">Seat Number</label>
            <div class="controls">
              <input type="text" name="seatNum" placeholder="4">
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
              <button type="submit" name="submit" class="btn">Purchase Ticket</button>
            </div>
          </div>
          </fieldset>
        </form>

              <?php
            }else if(isset($_POST['airline'])) {
              $airline = mysqli_real_escape_string($dbc, $_POST['airline']);
              $customerID = mysqli_real_escape_string($dbc, $_POST['customerID']);
          ?>
          <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-horizontal">
            <fieldset>
              <legend>Purchase Ticket</legend>
              <input type="hidden" name="customerID" value="<?php echo $customerID; ?>">
              <input type="hidden" name="airline" value="<?php echo $airline; ?>">
          <div class="control-group">
            <label class="control-label" for="flightNumber">Flight Number</label>
            <div class="controls">
              <select name="flightNumber">
                <?php
                  $select_flight_from_airline = "SELECT * FROM `FlightInfo` WHERE `airline` = '$airline'";
                  $result = mysqli_query($dbc, $select_flight_from_airline);
                  while($row = mysqli_fetch_array($result))
                  {
                    echo "<option value='" . $row['flightNumber'] . "'>" . $row['flightNumber'] . "</option>";
                  }

                ?>
              </select>
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
              <button type="submit" name="submit" class="btn">Select Flight</button>
            </div>
          </div>
          </fieldset>
        </form>

          <?php
            } else {
              ?>

              <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-horizontal">
            <fieldset>
              <legend>Purchase Ticket</legend>
          <div class="control-group">
            <label class="control-label" for="customerID">Customer ID</label>
            <div class="controls">
              <input type="text" name="customerID" placeholder="360">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="airline">Airline</label>
            <div class="controls">
              <select name="airline">
                <?php
                  $select_all_airlines = "SELECT * FROM `Airlines`";
                  $result = mysqli_query($dbc, $select_all_airlines);
                  while($row = mysqli_fetch_array($result))
                  {
                    echo "<option value='" . $row['code'] . "'>" . $row['name'] . "</option>";
                  }

                ?>
              </select>
            </div>
          </div>
          
          <div class="control-group">
            <div class="controls">
              <button type="submit" name="submit" class="btn">Select Airline</button>
            </div>
          </div>
          </fieldset>
        </form>

              <?php
            }
            mysqli_close($dbc);
            ?>

        </div>
      </div>

      <hr>

      <div class="footer">
        <p>&copy; <a href="http://andrew-hood.com/">Andrew Hood</a> 2013</p>
      </div>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>
