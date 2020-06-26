<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Administration</title>
  <link rel='stylesheet' type='text/css' media='screen' href='2tpife.css'>
</head>
<body>
<?php
/* 
This will be a page ACCESSIBLE ONLY to ADMINISTRATOR users !!!
All the other users should be KICKED OUT of this page!!!

This page is made with two purpose:
    1. Administrator users MUST be able to DELETE other USERS!
    2. Administrator users MUST be able to ADD new products to our webpage!
*/

include_once "sessionCheck.php";
include_once "credentials.php";

if (!$_SESSION["UserLogged"]) {
  die("You are NOT allowed here !");
}

$userSelect = $connection->prepare(
  "SELECT User_type FROM ppl WHERE PERSON_ID=?"
);
$userSelect->bind_param("i", $_SESSION["CurrentUser"]);
$userSelect->execute();
$resultUser = $userSelect->get_result();
$rowUser = $resultUser->fetch_assoc();
if ($rowUser["User_type"] !== 1) {
  die("You are not an admin and not allowed here");
}
if (isset($_POST["userToDelete"])) {
  $users = $connection->prepare("DELETE FROM ppl WHERE UserName=?");
  $users->bind_param("s", $_POST["userToDelete"]);
  $users->execute();
}
$users = $connection->prepare("SELECT UserName FROM ppl WHERE PERSON_ID <>?");
$users->bind_param("i", $_SESSION["CurrentUser"]);
$users->execute();
$resultUsers = $users->get_result();
while ($rowUsers = $resultUsers->fetch_assoc()) {
  print $rowUsers["UserName"] . "<br>"; ?>
  <form action="Administration.php" method="post">
        <input type="hidden" name="userToDelete" value="<?php print $rowUsers[
          "UserName"
        ]; ?>" >
        <input type="submit" name="Delete" id="deleteButton" value="Delete">
    </form>
  <?php
}
if (isset($_POST["Add"])) {
  $addProduct = $connection->prepare(
    "INSERT INTO products(NAME,Description,Price,Picture) VALUES(?,?,?,?)"
  );
  $addProduct->bind_param(
    "ssis",
    $_POST["ProductName"],
    $_POST["Description"],
    $_POST["Price"],
    $_POST["Picture"]
  );
  $addProduct->execute();
  $resultProduct = $addProduct->get_result();
}
?>
<table>
  <form action="Administration.php" method="post">
    <tr><td>Name: <input type="text" name="ProductName" placeholder="Product Name" required></td></tr>
    <tr><td>Description: <input type="text" name="Description" placeholder="Description"></td></tr>
    <tr><td>Price: <input type="text" name="Price" placeholder="Price" required></td></tr>
    <tr><td>Picture: <input type="text" name="Picture" placeholder="Picture" required></td></tr>
    <input type="submit" name="Add" id="addButton" value="Add">
  </form>
</table>


</body>
</html>

