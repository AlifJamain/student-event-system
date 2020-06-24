<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
$PackageId=intval($_GET['PackageId']);	
if(isset($_POST['submit']))
{
$PackageName=$_POST['PackageName'];
$PackageLocation=$_POST['PackageLocation'];
$PackageDate=$_POST['PackageDate'];
$PackageTime=$_POST['PackageTime'];
$PackageFetures=$_POST['PackageFetures'];
$PackageDetails=$_POST['PackageDetails'];	
$pimage=$_FILES["packageimage"]["name"];
$sql="update TblPackages set PackageName=:PackageName, PackageLocation=:PackageLocation, PackageDate=:PackageDate, PackageTime=:PackageTime, PackageFetures=:PackageFetures, PackageDetails=:PackageDetails where PackageId=:PackageId";
$query = $dbh->prepare($sql);
$query->bindParam(':PackageName',$PackageName,PDO::PARAM_STR);
$query->bindParam(':PackageLocation',$PackageLocation,PDO::PARAM_STR);
$query->bindParam(':PackageDate',$PackageDate,PDO::PARAM_STR);
$query->bindParam(':PackageTime',$PackageTime,PDO::PARAM_STR);
$query->bindParam(':PackageFetures',$PackageFetures,PDO::PARAM_STR);
$query->bindParam(':PackageDetails',$PackageDetails,PDO::PARAM_STR);
$query->bindParam(':PackageId',$PackageId,PDO::PARAM_STR);
$query->execute();
$msg="Kemaskini Aktiviti Berjaya";
}

	?>
<!DOCTYPE HTML>
<html>
<head>
<title>Sistem Pengurusan Pelajar | Pentadbir</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Pooled Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery-2.1.4.min.js"></script>
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
<link rel="stylesheet" href="css/jquery-ui.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<script src="js/jquery-ui.js"></script>
					<script>
						$(function() {
						$( "#datepicker,#datepicker1" ).datepicker();
						});
					</script>
        <script>
						$(document).ready(function(){
    $('input.timepicker').timepicker({});
});
					</script>
    <script>
        $('.timepicker').timepicker({
    timeFormat: 'h:mm p',
    interval: 60,
    minTime: '10',
    maxTime: '6:00pm',
    defaultTime: '11',
    startTime: '10:00',
    dynamic: true,
    dropdown: true,
    scrollbar: true
});
    </script>
	  <style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>				

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
                <li class="breadcrumb-item"><a href="dashboard.php">Utama</a><i class="fa fa-angle-right"></i>Kemaskini Aktiviti</li>
            </ol>
		<!--grid-->
 	<div class="grid-form">
 
<!---->
  <div class="grid-form1">
  	       <h3>Kemaskini Aktiviti</h3>
  	        	  <?php if($error){?><div class="errorWrap"><strong>GAGAL</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>BERJAYA</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
  	         <div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">
						
<?php 
$PackageId=intval($_GET['PackageId']);
$sql = "SELECT * from TblPackages where PackageId=:PackageId";
$query = $dbh -> prepare($sql);
$query -> bindParam(':PackageId', $PackageId, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	?>

							<form class="form-horizontal" name="package" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Nama Aktiviti</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="PackageName" id="packagename" placeholder="Nama Aktiviti" value="<?php echo htmlentities($result->PackageName);?>" required>
									</div>
								</div>

<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Lokasi Aktiviti</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="PackageLocation" id="packagelocation" placeholder="Lokasi Aktiviti" value="<?php echo htmlentities($result->PackageLocation);?>" required>
									</div>
								</div>
                                
                                <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Tarikh Aktiviti</label>
									<div class="col-sm-8">
										<input class="date form-control" id="datepicker1" type="text" placeholder="hh-bb-tttt" name="PackageDate" required="" value="<?php echo htmlentities($result->PackageDate);?>">
									</div>
								</div>
                                
                                <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Masa Aktiviti</label>
									<div class="col-sm-8">
                                        
										<input class="timepicker form-control" id="timepicker" type="text" placeholder="Masa Aktiviti" name="PackageTime" required="" value="<?php echo htmlentities($result->PackageTime);?>">
									</div>
								</div>

<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Maklumat Aktivtiti</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="PackageFetures" id="packagefeatures" placeholder="Maklumat Aktivtiti Cth: - Makanan Disediakan, - Pengangkutan Disediakan" value="<?php echo htmlentities($result->PackageFetures);?>" required>
									</div>
								</div>		


<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Maklumat Lain Aktiviti</label>
									<div class="col-sm-8">
										<textarea class="form-control" rows="5" cols="50" name="PackageDetails" id="packagedetails" placeholder="Maklumat Lain Aktiviti" required><?php echo htmlentities($result->PackageDetails);?></textarea> 
									</div>
								</div>															
<div class="form-group">
<label for="focusedinput" class="col-sm-2 control-label">Gambar Aktiviti (Banner)</label>
<div class="col-sm-8">
<img src="pacakgeimages/<?php echo htmlentities($result->PackageImage);?>" width="200">&nbsp;&nbsp;&nbsp;<a href="change-image.php?imgid=<?php echo htmlentities($result->PackageId);?>">Change Image</a>
</div>
</div>

<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Kali Terakhir Dikemaskini</label>
									<div class="col-sm-8">
<?php echo htmlentities($result->UpdationDate);?>
									</div>
								</div>		
								<?php }} ?>

								<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<button type="submit" name="submit" class="btn-primary btn">Kemaskini</button>
			</div>
		</div>
						
					
						
						
						
					</div>
					
					</form>

     
      

      
      <div class="panel-footer">
		
	 </div>
    </form>
  </div>
 	</div>
 	<!--//grid-->

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