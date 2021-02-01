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
if(isset($_POST['issue']))
{
    $con=mysqli_connect("localhost","root","","library");
    $studentid=strtoupper($_POST['studentid']);
    $bbid=$_POST['bookid'];
    $sql="SELECT * FROM tblbooks WHERE bid LIKE '%$bbid%';";
    $arr=mysqli_query($con,$sql);
    if($arr)
    {
      $val=mysqli_fetch_row($arr);
      if ($val[5]>0 && $val[6] == 5)
      {
        $sql2="INSERT INTO tblissuedbookdetails (BookId,StudentID,IssuesDate,DueDate) 
                VALUES ('$bbid','$studentid',now(),now()+INTERVAL 5 DAY);";
        $arr2=mysqli_query($con,$sql2);

        $sql5="INSERT INTO tblissuedbookdetailshistory (BookId,StudentID,IssuesDate,DueDate) 
                VALUES ('$bbid','$studentid',now(),now()+INTERVAL 5 DAY);";
        $arr5 = mysqli_query($con,$sql5);
        
        $sql3="UPDATE tblbooks SET Stock=Stock-1 WHERE bid LIKE '%$bbid%';";
        $arr3=mysqli_query($con,$sql3);

        if ($arr2 && $arr3 && $arr5)

        echo "<script>alert('Book Issued successfully!');window.location='manage-issued-books.php'</script>";
        echo "<script>alert('Duplicate Entries are not allowed!');window.location='issue-book.php'</script>";
    }
                if ($val[5]>0 && $val[6] == 3)
                {
                $sql2="INSERT INTO tblissuedbookdetails (BookId,StudentID,IssuesDate,DueDate) 
                        VALUES ('$bbid','$studentid',now(),now()+INTERVAL 3 DAY);";
                $arr2=mysqli_query($con,$sql2);

                $sql5="INSERT INTO tblissuedbookdetailshistory (BookId,StudentID,IssuesDate,DueDate) 
                        VALUES ('$bbid','$studentid',now(),now()+INTERVAL 3 DAY);";
                $arr5 = mysqli_query($con,$sql5);
                
                $sql3="UPDATE tblbooks SET Stock=Stock-1 WHERE bid LIKE '%$bbid%';";
                $arr3=mysqli_query($con,$sql3);

                if ($arr2 && $arr3 && $arr5)

                echo "<script>alert('Book Issued successfully!');window.location='manage-issued-books.php'</script>";
                echo "<script>alert('Duplicate Entries are not allowed!');window.location='issue-book.php'</script>";
            }
                if ($val[5]>0 && $val[6] == 1)
                {
                    $sql2="INSERT INTO tblissuedbookdetails (BookId,StudentID,IssuesDate,DueDate) 
                            VALUES ('$bbid','$studentid',now(),now()+INTERVAL 1 DAY);";
                    $arr2=mysqli_query($con,$sql2);

                    $sql5="INSERT INTO tblissuedbookdetailshistory (BookId,StudentID,IssuesDate,DueDate) 
                            VALUES ('$bbid','$studentid',now(),now()+INTERVAL 1 DAY);";
                    $arr5 = mysqli_query($con,$sql5);
                    
                    $sql3="UPDATE tblbooks SET Stock=Stock-1 WHERE bid LIKE '%$bbid%';";
                    $arr3=mysqli_query($con,$sql3);

                    if ($arr2 && $arr3 && $arr5)

                    echo "<script>alert('Book Issued successfully!');window.location='manage-issued-books.php'</script>";
                    echo "<script>alert('Duplicate Entries are not allowed!');window.location='issue-book.php'</script>";
                }
                if ($val[5]>0 && $val[6] == 4)
                {
                $sql2="INSERT INTO tblissuedbookdetails (BookId,StudentID,IssuesDate,DueDate) 
                        VALUES ('$bbid','$studentid',now(),now()+INTERVAL 4 DAY);";
                $arr2=mysqli_query($con,$sql2);

                $sql5="INSERT INTO tblissuedbookdetailshistory (BookId,StudentID,IssuesDate,DueDate) 
                        VALUES ('$bbid','$studentid',now(),now()+INTERVAL 4 DAY);";
                $arr5 = mysqli_query($con,$sql5);
                
                $sql3="UPDATE tblbooks SET Stock=Stock-1 WHERE bid LIKE '%$bbid%';";
                $arr3=mysqli_query($con,$sql3);

                if ($arr2 && $arr3 && $arr5)

                echo "<script>alert('Book Issued successfully!');window.location='manage-issued-books.php'</script>";
                echo "<script>alert('Duplicate Entries are not allowed!');window.location='issue-book.php'</script>";
                }
                    if ($val[5]>0 && $val[6] == 2)
                    {
                    $sql2="INSERT INTO tblissuedbookdetails (BookId,StudentID,IssuesDate,DueDate) 
                            VALUES ('$bbid','$studentid',now(),now()+INTERVAL 2 DAY);";
                    $arr2=mysqli_query($con,$sql2);

                    $sql5="INSERT INTO tblissuedbookdetailshistory (BookId,StudentID,IssuesDate,DueDate) 
                            VALUES ('$bbid','$studentid',now(),now()+INTERVAL 2 DAY);";
                    $arr5 = mysqli_query($con,$sql5);
                    
                    $sql3="UPDATE tblbooks SET Stock=Stock-1 WHERE bid LIKE '%$bbid%';";
                    $arr3=mysqli_query($con,$sql3);

                    if ($arr2 && $arr3 && $arr5)

                    echo "<script>alert('Book Issued successfully!');window.location='manage-issued-books.php'</script>";
                    echo "<script>alert('Duplicate Entries are not allowed!');window.location='issue-book.php'</script>";
                    }
      else{
        echo "<script>alert('No stock available!');window.location='issue-book.php'</script>";
    }  
    
}}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Issue a new Book</title>
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
                <h4 class="header-line">Borrow a New Book</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1"">
<div class="panel panel-info">
<div class="panel-heading">
Borrow a New Book
</div>
<div class="panel-body">
<form role="form" method="post">

<div class="form-group">
<label>Student id<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="studentid" id="studentid" onBlur="getstudent()" autocomplete="off"  required />
</div>

<div class="form-group">
<span id="get_student_name" style="font-size:16px;"></span> 
</div>

<div class="form-group">
<label>ISBN Number<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="bookid" id="bookid" onBlur="getbook()" autocomplete="off"  required="required" />
</div>

<div class="form-group">
<span id="get_book_name" style="font-size:16px;">    
</div>

<button type="submit" name="issue" id="submit" class="btn btn-info">OK</button>

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
