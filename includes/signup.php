<?php
error_reporting(0);
if(isset($_POST['submit']))
{
$fname=$_POST['fname'];
$mnumber=$_POST['mobilenumber'];
$email=$_POST['email'];
$password=md5($_POST['password']);
$FacultyId=$_POST['FacultyId'];
$Status=1;
$sql="INSERT INTO  tblusers(FullName,MobileNumber,EmailId,Password, FacultyId, Status) VALUES(:fname,:mnumber,:email,:password, :FacultyId, :Status)";
$query = $dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':mnumber',$mnumber,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->bindParam(':FacultyId',$FacultyId,PDO::PARAM_STR);
$query->bindParam(':Status',$Status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Maklumat Telah Berjaya Di Simpan.');</script>";
echo "<script type='text/javascript'> document.location = 'package-list.php'; </script>";
}
else 
{
$_SESSION['msg']="Something went wrong. Please try again.";
echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
}
}
?>
<!--Javascript for check email availabilty-->
<script>
function checkAvailability() {

$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'emailid='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
						</div>
							<section>
								<div class="modal-body modal-spa">
									<div class="login-grids">
										<div class="login">
											<div class="login-left">
												<img src="images/logo-uthm-web.png" width="250"><br>
                                                <img src="images/upword.png" width="250"><br>
											</div>
											<div class="login-right">
												<form name="signup" method="post">
													<h3>Daftar Pengguna</h3>
					

				<input type="text" value="" placeholder="Nama" name="fname" autocomplete="off" required="">
				<input type="text" value="" placeholder="Nombor Telefon" maxlength="10" name="mobilenumber" autocomplete="off" required="">
		<input type="text" value="" placeholder="E-mel" name="email" id="email" onBlur="checkAvailability()" autocomplete="off"  required="">	
		 <span id="user-availability-status" style="font-size:12px;"></span> 
	<input type="password" value="" placeholder="Kata Laluan" name="password" required="">
                                                    <select  name="FacultyId" autocomplete="off">
<option value="">---Fakulti---</option>
<?php $sql = "SELECT * from tblfaculty";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>                                            
<option value="<?php echo htmlentities($result->FacultyId);?>"><?php echo htmlentities($result->FacultyName);?></option>
<?php }} ?>
</select>
													<input type="submit" name="submit" id="submit" value="Daftar Pengguna">
												</form>
											</div>
												<div class="clearfix"></div>								
										</div>
									</div>
								</div>
							</section>
					</div>
				</div>
			</div>