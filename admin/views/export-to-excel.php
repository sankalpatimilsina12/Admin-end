<?php require_once("../controllers/connection.php") ?>

<?php
  $db = new Connect;

  $query = "SELECT id, email, subscribed_date FROM subscribers";
  $result = mysqli_query($db->getConnection(), $query);
  $row = $result->fetch_all();
?>

<?php
$filename ="excelreport.xls";
$contents = null;

for($i = 0; $i < count($row); $i++)
{
  $contents .= $row[$i][0]."\t".$row[$i][1]."\t".$row[$i][2];
}

header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename='.$filename);
echo $contents;
 ?>