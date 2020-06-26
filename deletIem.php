<?php

include_once "sessionCheck.php";
include_once "credentials.php";

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
        <input type="hidden" name="userToDelete" value="<?php print $rowUsers["UserName"]; ?>">
        <input type="submit" name="Delete" id="deleteButton" value="Delete">
    </form>
<?php
}
?>
<table>
    <form action="deletItem.php.php" method="post">
        <tr>
            <td>Name: <input type="text" name="ProductName" placeholder="Product Name" required></td>
        </tr>
        <tr>
            <td> ID: <input type="text" name="Id" placeholder="Product ID" required><td>
        </tr>
        <input type="submit" value="Delete" id="userToDelete" name="UserToDelete">
    </form>
   
</table


?>