<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show User</title>
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "rafi";
$connection = mysqli_connect($servername, $username, $password, $database);
if (!$connection) {
  die("Connection failed: " . mysqli_connect_error());
}
$showUsers = $connection->prepare("SELECT * FROM countries");
$showUsers->execute();
$result = $showUsers->get_result();
if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc()) { ?> <option value="1"><?php print $row["COUNTRY_NAME"]; ?></option>
   <?php }
} else {
  echo "0 results";
}
?>

</body>
</html>