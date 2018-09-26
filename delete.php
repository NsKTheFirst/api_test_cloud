<?php
$conn = new MongoDB\Driver\Manager("mongodb+srv://NsK:N23s05K78@nsk-jirog.gcp.mongodb.net/test?retryWrites=true");
$delete = new MongoDB\Driver\Bulkwrite();
$delete->delete(['_id'=> new MongoDB\BSON\ObjectID($_GET['id'])]);
$conn->executeBulkWrite("Cinema.Cinema.Cinema", $delete);
header("Location: proto.php");
?>