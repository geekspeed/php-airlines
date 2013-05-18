
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
                <li class="active"><a href="index.php">Airline</a></li>
                <li><a href="add-airport.php">Airport</a></li>
                <li><a href="add-flightinfo.php">Flight Info</a></li>
                <li><a href="add-flight.php">Flight</a></li>
                <li><a href="purchase.php">Purchase</a></li>
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
            if(isset($_POST['submit'])) 
            {
              require_once('config.php');
              $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE) or die("<div class='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Error!</strong> Could not connect to database.</div>");
              
              // Stop SQL injections
              $code = mysqli_real_escape_string($dbc, $_POST['code']);
              $name = mysqli_real_escape_string($dbc, $_POST['name']);
              $shortName = mysqli_real_escape_string($dbc, $_POST['shortName']);

              if(strlen($code) == 2) 
              {
                $insert_airline_query = "INSERT INTO `comp3715project1`.`Airlines` (`code`, `name`, `shortName`) VALUES ('$code', '$name', '$shortName')";
                $result = mysqli_query($dbc, $insert_airline_query) or die("<div class='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Error!</strong> Inserting Airline into the database.\n" .  mysqli_error($dbc) . "</div>");
                if($result)
                {
                  echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Success!</strong> Airline inserted.</div>";
                }
              // code not correct length
              } else {
                echo "<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Error!</strong> Code must be of length two.</div>";
              }
              
              
                mysqli_close($dbc);
            } else {
          ?>
          <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-horizontal">
            <fieldset>
              <legend>Add Airline</legend>
          <div class="control-group">
            <label class="control-label" for="code">Code</label>
            <div class="controls">
              <input type="text" name="code" placeholder="DL">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="name">Name</label>
            <div class="controls">
              <input type="text" name="name" placeholder="Delta Airlines">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="shortName">Short Name</label>
            <div class="controls">
              <input type="text" name="shortName" placeholder="Delta">
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
              <button type="submit" name="submit" class="btn">Add Airline</button>
            </div>
          </div>
          </fieldset>
        </form>
        <?php 
          }
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
