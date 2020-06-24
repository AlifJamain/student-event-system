<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{ 
	// code for cancel
if(isset($_REQUEST['bkid']))
	{
$bid=intval($_GET['bkid']);
$status=2;
$cancelby='a';
$sql = "UPDATE tblbooking SET status=:status,CancelledBy=:cancelby WHERE  BookingId=:bid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query -> bindParam(':cancelby',$cancelby , PDO::PARAM_STR);
$query-> bindParam(':bid',$bid, PDO::PARAM_STR);
$query -> execute();

$msg="Tempahan Berjaya Ditolak";
}


if(isset($_REQUEST['bckid']))
	{
$bcid=intval($_GET['bckid']);
$status=1;
$cancelby='a';
$sql = "UPDATE tblbooking SET status=:status WHERE BookingId=:bcid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':bcid',$bcid, PDO::PARAM_STR);
$query -> execute();
$msg="Tempahan Berjaya Diterima";
}




	?>
<!DOCTYPE HTML>
<html>
<head>
<title>Sistem Pengurusan Pelajar | Pentadbir</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<!-- Graph CSS -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<script src="js/jquery-2.1.4.min.js"></script>
<!-- //jQuery -->
<!-- tables -->
<link rel="stylesheet" type="text/css" href="css/table-style.css" />
<link rel="stylesheet" type="text/css" href="css/basictable.css" />
<script type="text/javascript" src="js/jquery.basictable.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#table').basictable();

      $('#table-breakpoint').basictable({
        breakpoint: 768
      });

      $('#table-swap-axis').basictable({
        swapAxis: true
      });

      $('#table-force-off').basictable({
        forceResponsive: false
      });

      $('#table-no-resize').basictable({
        noResize: true
      });

      $('#table-two-axis').basictable();

      $('#table-max-height').basictable({
        tableWrapper: true
      });
    });
</script>
<!-- //tables -->
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<!-- lined-icons -->
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<!-- //lined-icons -->
</head> 
<body>
   <div class="page-container">
   <!--/content-inner-->
<div class="left-content">
	   <div class="mother-grid-inner">
            <!--header start here-->
				<?php include('includes/header.php');?>
				     <div class="clearfix"> </div>	
				</div>
<!--heder end here-->
<ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Utama</a><i class="fa fa-angle-right"></i>Senarai Nama Penuh</li>
            </ol>
<div class="agile-grids">	
				<!-- tables -->
				
				<div class="agile-tables">
					<div class="w3l-table-info">
					  <h2>Senarai Nama Penuh</h2>
                        <?php
                    $PackageId=intval($_GET['PackageId']);
                    $sql = "SELECT f.FacultyId, f.FacultyName from tblfaculty as f";
                    $query = $dbh -> prepare($sql);
                    $query -> bindParam(':PackageId', $PackageId, PDO::PARAM_STR);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query->rowCount() > 0)
                    {
                    foreach($results as $result)
{				?>
                        <a href="list-name.php?PackageId=<?php echo intval($_GET['PackageId']);?>&FacultyId=<?php echo htmlentities($result->FacultyId);?>" class="btn btn-primary"><?php echo htmlentities($result->FacultyName);?></a>
                            <?php $cnt=$cnt+1;} }?>
					    <table id="table">
						<thead>
						  <tr>
						  <th>#</th>
                              <th>Nama</th>
							<th>E-Mail</th>
                            <th>No. Telefon</th>
                              <th>Tarikh Daftar</th>
                              <th>Status</th>
                              <th>Tindakan</th>
						  </tr>
						</thead>
						<tbody>
<?php 
     $PackageId=intval($_GET['PackageId']);
    //$sql = "SELECT u.UserId, u.EmailId, u.FacultyId, f.FacultyId, b.PackageId, p.PackageId, b.uid from tblusers as u join tblbooking as b on u.UserId=b.uid join tblfaculty as f on u.FacultyId=f.FacultyId join tblpackages as p on p.PackageId=b.PackageId where b.PackageId=:PackageId";
    $sql ="SELECT u.UserId, u.EmailId, u.FullName, u.MobileNumber, u.RegDate, b.status, b.CancelledBy, b.UpdationDate, b.uid, b.BookingId as bookid, b.PackageId, p.PackageId FROM tblusers as u join tblbooking as b on u.UserId=b.uid join tblpackages as p on b.PackageId=p.PackageId where p.PackageId=:PackageId ";
$query = $dbh -> prepare($sql);
$query -> bindParam(':PackageId', $PackageId, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>		
						  <tr>
							<td><?php echo htmlentities($cnt);?></td>
                              <td><?php echo htmlentities($result->FullName);?></td>
							<td><?php echo htmlentities($result->EmailId);?></td>
                              <td><?php echo htmlentities($result->MobileNumber);?></td>
                              <td><?php echo htmlentities($result->RegDate);?></td>
                              <td><?php if($result->status==0)
{
echo "Dalam Proses";
}
if($result->status==1)
{
echo "Terima";
}
if($result->status==2 and  $result->CancelledBy=='a')
{
echo "Ditolak Oleh " .$result->UpdationDate;
} 
if($result->status==2 and $result->CancelledBy=='u')
{
echo "Ditolak Oleh " .$result->UpdationDate;

}
?></td>
                              <?php if($result->status==2)
{
	?><td>Ditolak</td>
<?php } else {?>
<td><a href="manage-bookings.php?bkid=<?php echo htmlentities($result->bookid);?>" onclick="return confirm('Adakah Anda Pasti Untuk Menolak?')" class="btn btn-danger" >Tolak</a><a href="manage-bookings.php?bckid=<?php echo htmlentities($result->bookid);?>" onclick="return confirm('Adakah Anda Pasti Untuk Terima?')" class="btn btn-primary" >Terima</a></td>
<?php }?>

						  </tr>
						 <?php $cnt=$cnt+1;} } else {?>
                                <td colspan="7"><center>Maklumat Tiada Dalam Pangkalan Data</center></td>
                            <?php } ?>
						</tbody>
					  </table>
					</div>
				  </table>

				
			</div>
<!-- script-for sticky-nav -->
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

</div>
<!--inner block end here-->
<!--copy rights start here-->
<?php include('includes/footer.php');?>
<!--COPY rights end here-->
</div>
</div>
  <!--//content-inner-->
		<!--/sidebar-menu-->
						<?php include('includes/sidebarmenu.php');?>
							  <div class="clearfix"></div>		
							</div>
							<script>
							var toggle = true;
										
							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$("#menu span").css({"position":"absolute"});
							  }
							  else
							  {
								$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								  $("#menu span").css({"position":"relative"});
								}, 400);
							  }
											
											toggle = !toggle;
										});
							</script>
<!--js -->
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
   <!-- /Bootstrap Core JavaScript -->	   

</body>
</html>
<?php } ?>