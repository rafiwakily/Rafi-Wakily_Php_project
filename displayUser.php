<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='stylesheet' type='text/css' media='screen' href='2tpife.css'>
  <title>Display User</title>
</head>

<body>
  <?php function displayUserDetails($connection)
  {
    if (!isset($_SESSION["CurrentUser"])) {
      print "You are trying to display a user's details without logging in ";
    } else {
      $userFromMyDatabase = $connection->prepare("SELECT * FROM ppl WHERE PERSON_ID=?");
      $userFromMyDatabase->bind_param("i", $_SESSION["CurrentUser"]);
      $userFromMyDatabase->execute();
      $result = $userFromMyDatabase->get_result();
      $row = $result->fetch_assoc();

      if ($result->num_rows == 0) {
        session_unset();
        session_destroy();
        die("Failed displaying user data. Something is wrong with the database -> Loggin out automatically");
      }
      print "First Name : " .
        $row["First_Name"] .
        "<br>" .
        " Last Name : " .
        $row["Second_Name"] .
        "<br>" .
        " Age : " .
        $row["Age"] .
        "<br>" .
        " Username : " .
        $row["UserName"] .
        "<br>";
      $counrty = $connection->prepare("SELECT * FROM countries WHERE COUNTRY_ID=?");
      $counrty->bind_param("i", $row["Nationality"]);
      $counrty->execute();
      $myResultOfCountries = $counrty->get_result();
      $countrySelected = $myResultOfCountries->fetch_assoc();
      print "You are from : " . $countrySelected["COUNTRY_NAME"] . "<br>";
    } ?>
    <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post">
      <input type="submit" name="Logout" id="logoutButton" value="Logout">
    </form>
  <?php
  } ?>
</body>

</html>