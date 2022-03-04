<!--
  COMP 333: Software Engineering
  hw2 Problem 1(b)
  Tomoshi Ishida (tishida@wesleyan.edu)

  PHP sample script for querying a database with SQL. This script can be run
  from inside the htdocs directory in XAMPP. The script assumes that there is a
  database set up (e.g., via phpMyAdmin) named music-db with a
  artists, ratings, and users table per the readme-sql.md.
-->

<!DOCTYPE HTML>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="application/x-www-form-urlencoded"/>
<title>TITLE TITLE</title>
<link rel="stylesheet" href="style.css">
</head>

<body>
  <header>
    <div class="logozone">
      <img class="logo" src="logo.png" alt="Company Logo" width="100%">
    </div>

    <div class="navigation">
      <nav>
        <ul>
          <li><a href="landing.html" style="color: red;">Home</a></li>
          <li><a href="#">Search</a></li>
          <li><a href="#">Write review</a></li>
          <li><a href="#">My Reviews</a></li>
          <li><a href="contactus.html">Contact Us</a></li>
        </ul>
      </nav>
    </div>
　</header>

  <hr>

  <div class="main">
    <div>
      <h1> music-db </h1>
    </div>

    <hr>

    <div class="registration">
      <h1>Registration</h1>

      <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "music-db";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        if(isset($_REQUEST["submit"])){
          $out_value1 = "";
          $user_name = $_REQUEST['username'];
          $pwd = $_REQUEST['password'];

          if(!empty($user_name) && !empty($pwd)){
            $sql1 = "SELECT * FROM users WHERE username = ('$user_name')";
            $result1 = mysqli_query($conn, $sql1);

            if (mysqli_num_rows($result1) == 0) {
              $sql2 = "INSERT INTO users (username, password) VALUES ('$user_name', '$pwd')";
              $result2 = mysqli_query($conn, $sql2);
              $out_value1 = "Successfully registered.";
            }
            else {
              $out_value1 = "This username already exists.";
            }
          }
          elseif (empty($user_name) && !empty($pwd)) {
            $out_value1 = "Please enter username.";
          }
          elseif (!empty($user_name) && empty($pwd)) {
            $out_value1 = "Please enter password.";
          }
          else {
            $out_value1 = "Please enter username and password.";
          }
        }

        $conn->close();
      ?>

      <form method="GET" action="">
        Username </br> <input type="text" class="form_input" name="username"/><br>
        Password </br> <input type="text" class="form_input" name="password"/><br>
        <input type="submit" class="submit" name="submit" value="Register"/>

        <p class="output"><?php
          if(!empty($out_value1)){
            echo $out_value1;
          }
        ?></p>
      </form>
    </div>
    <!-- registration div ends -->

    <hr>

    <div class="retrieval">
      <h1>Retrieve songs by username</h1>
      <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "music-db";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        if(isset($_REQUEST["retrieve"])){
          $user_name = $_REQUEST['username'];

          if(!empty($user_name)){
            $sql3 = "SELECT * FROM users WHERE username = ('$user_name')";
            $result3 = mysqli_query($conn, $sql3);

            if (mysqli_num_rows($result3) == 0) {
              $out_value2 = array("This username is not registered.");
            } else {
              $sql4 = "SELECT * FROM ratings WHERE username = ('$user_name')";
              $result4 = mysqli_query($conn, $sql4);
              if (mysqli_num_rows($result4) == 0) {
                $out_value2 = array("This person hasn't rated yet.");
              } elseif (mysqli_num_rows($result4) == 1) {
                $row = mysqli_fetch_assoc($result4);
                $out_value2 = array($row['song'] . ": " . $row['rating']);
              } else {
                $out_value2 = array();
                while ($row = mysqli_fetch_assoc($result4)) {
                  array_push($out_value2, $row['song'] . ": " . $row['rating']);
                }
              }
            }
          } else {
            $out_value2 = array("Please enter username!");
          }
        }
        $conn->close();
      ?>

      <form method="GET" action="">
        Username: <input type="text" class="form_input" name="username"/><br>
        <input type="submit" class="submit" name="retrieve" value="Retrieve"/>

        <p class="output">
          <?php
          foreach ($out_value2 as $value) {
            echo $value . "<br/>";
          }
          ?>
        </p>
      </form>
    </div>
    <!-- retrieval div ends -->

  </div>
</body>
</html>
