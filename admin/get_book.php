<?php 
require_once("includes/config.php");
if(!empty($_POST["bookid"])) {
  $bookid= $_POST["bookid"];
 
    $sql ="SELECT BookName,Status FROM tblbooks WHERE bid=:bookid";
$query= $dbh -> prepare($sql);
$query-> bindParam(':bookid', $bookid, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
foreach ($results as $result) {
if($result->Status==0)
{
echo "<span style='color:red'> Book Blocked </span>"."<br />";
echo "<b>Book Name -</b> ".$result->BookName;
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else {
?>


<?php 
echo "<label>Book Name</label><br/>";
echo htmlentities($result->BookName);
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}
}
 else{
  
  echo "<span style='color:red'> Invaid ISBN Number !Please Enter Valid ISBN Number .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
}
}
?>
