<?php include_once "sessionCheck.php";
include_once "credentials.php";
$userSelect = $connection->prepare("SELECT User_type FROM ppl WHERE PERSON_ID=?");
$userSelect->bind_param("i", $_SESSION["CurrentUser"]);
$userSelect->execute();
$resultUser = $userSelect->get_result();
$rowUser = $resultUser->fetch_assoc();
if ($rowUser["User_type"] !== 1) { ?>
<img src="noAccessSign.jpg">
<a href='2tpifeProducts.php'> Go to the products page </a>
<?php exit();}
if (isset($_POST["itemToDelete"])) {
/* array_splice($_SESSION["Delete"], $_POST["ItemToDelete"], 1); */
$deleteItem = $connection->prepare("DELETE FROM Products WHERE ID=?");
$deleteItem->bind_param("i", $_POST["itemToDelete"]);
$deleteItem->execute();
 }
$deleteItem = $connection->prepare("SELECT ID, NAME, Price FROM Products WHERE ID <>?");
$deleteItem->bind_param("i", $_SESSION["Delete"]);
$deleteItem->execute();
$resultItem = $deleteItem->get_result();
while ($rowItem = $resultItem->fetch_assoc()) { ?>
<table>
<form action="deleteItem.php" method="post">
<input type="hidden" name="itemToDelete" value="<?php print $rowItem["ID"]; ?>" >
<tr>
<td>
<?php print "ID: ". $rowItem["ID"] ."<br>". " Name: " . $rowItem["NAME"]. "<br>" . " Price: " . $rowItem["Price"]. " &euro;"; ?>
</td>
<td><input type="submit" name="Delete" id="itemToDelete" value="Delete"></td>
</tr>
</form>
</table> <br><br>
<?php } ?>
<table>
<form action="deleteItem.php" method="post">
<tr><td>Product's ID: <input type="text" name="itemToDelete" placeholder="Product's ID" required></td></tr>
<tr><td><input type="submit" name="Delete" id="deleteButton" value="Delete"></td></tr>
</form>
</table>