<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{ 
header('location:adminlogin.php');
}
else{
    ?>
<?php
if(isset($_POST['return']))         
{
$db = mysqli_connect("localhost","root","","library");
    $bid=$_POST['bookid'];
    $cid=strtoupper($_POST['studentid']);
    $rstatus=1;
    $sql="SELECT * FROM tblissuedbookdetailshistory WHERE tblissuedbookdetailshistory.BookId 
                LIKE '%$bid%' AND tblissuedbookdetailshistory.StudentID LIKE '%$cid%';";
    $asd = mysqli_query($db,$sql);
   if ($val = mysqli_fetch_row($asd))
    {
      $return = "UPDATE tblissuedbookdetailshistory SET ReturnDate=now() WHERE BookId=$bid;";
      $return1 = mysqli_query($db,$return);
      $sql1 = "DELETE FROM tblissuedbookdetails WHERE BookId=:bid;";
      $arr1 = mysqli_query($db,$sql1);
      $sql2="UPDATE tblissuedbookdetailshistory SET RetrunStatus=$rstatus WHERE BookId=$bid;";
      mysqli_query($db,$sql2);
            
            $date_expire = $val[4];
            $now = new DateTime();
            $duedate = new DateTime($date_expire);
            
            if($duedate < $now){
                $diff1 = $duedate->diff($now)->format("%a");
                $diff = $diff1 * 2;
            }else{
                $diff = 0;
            }


            $sql3 = "UPDATE tblissuedbookdetailshistory SET Fine=$diff WHERE BookId=$bid;";
      mysqli_query($db,$sql3);
      $sql4="UPDATE tblbooks SET Stock=Stock+1 WHERE bid=$bid;";
      mysqli_query($db,$sql4);
      echo "<script>alert('Successfully Returned!');window.location='manage-issued-books.php'</script>";
    }
    else echo "<script>alert('There is some type of error! Please check your input.');window.location='return-issue-book.php'</script>";
  }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Issued Book Details</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<script>
// function for get student name
function getstudent() {
$("#loaderIcon").show();
jQuery.ajax({
url: "get_student.php",
data:'studentid='+$("#studentid").val(),
type: "POST",
success:function(data){
$("#get_student_name").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

//function for book details
function getbook() {
$("#loaderIcon").show();
jQuery.ajax({
url: "get_book.php",
data:'bookid='+$("#bookid").val(),
type: "POST",
success:function(data){
$("#get_book_name").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script> 
<style type="text/css">
  .others{
   color:red;
}

</style>


</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wra
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">RETURN BORROWED BOOK</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1"">
<div class="panel panel-info">
<div class="panel-heading">
Borrowed Book Details
</div>
<div class="panel-body">
<form role="form" method="post">
                                     
            <div class="form-group">
            <label>Student ID<span style="color:red;">*</span></label>
            <input class="form-control" type="text" name="studentid" id="studentid" onBlur="getstudent()" autocomplete="off"  required />
            </div>

            <div class="form-group">
            <span id="get_student_name" style="font-size:16px;"></span> 
            </div>

            <div class="form-group">
            <label>ISBN Number<span style="color:red;">*</span></label>
            <input class="form-control" type="text" name="bookid" id="bookid" onBlur="getbook()" autocomplete="off" required="required" />
            </div>

            <div class="form-group">
            <span id="get_book_name" style="font-size:16px;">    
            </div>

            <!-- <label>Fine</label>
            <div class="form-group">
            <input class="form-control" type="number" name="fine" id="fine" readonly />           
            </div> -->

<button type="submit" name="return" id="submit" class="btn btn-info"> Return Book </button>
</form>
</div>
</div>
</div>

        </div>
   
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>

</body>
</html>
<?php } ?>
