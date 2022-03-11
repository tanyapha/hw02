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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="application/x-www-form-urlencoded"/>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
<title>Online Music Rating Platform</title>
<link rel="stylesheet" href="style.css">
</head>

<body>
  <nav>
    <ul class="nav-content">
      <li class="nav-items"><a href="#home">Home</a></li>
      <li class="nav-items"><a href="#registration">Register</a></li>
      <li class="nav-items"><a href="#retrieval">Find Songs</a></li>
    </ul>
  </nav>

  <div id=sign-up>
    <header id="home">
      <h1 class="title"> Music DB </h1>
      <p class="message">Rate songs, and connect with listeners all over the world.</p>
    　</header>
    <section id="registration">
      <h1 id = create-account>Create an Account</h1>
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
         </br> <input type="text" class="form_input" name="username"
                              placeholder= "username"/><br>
                <input type="text" class="form_input" 
                              name="password" placeholder="password"/><br>
        <input type="submit" class="submit" name="submit" value="Register"/>
        <p class="output"><?php
          if(!empty($out_value1)){
            echo $out_value1;
          }
        ?></p>
      </form>
    </section>
  </div>

  <!-- registration section ends -->

  <!-- <hr> -->

  <section id="retrieval">
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

        $out_value2 = isset($out_value2)? $out_value2 : [];

        foreach ($out_value2 as $value) {
          echo $value . "<br/>";
        }
        ?>
      </p>
    </form>
  </section>
  <!-- retrieval section ends -->

  <hr>

  <div class="acknowledgement">
      <h3>Acknowledgement</h3>
      <p>This site was designed and published as part of the COMP
          333 Software Engineering class at Wesleyan University. The described platform is not publicly
          available but rather is created as a training exercise.</p>
  </div>
</body>
</html>
