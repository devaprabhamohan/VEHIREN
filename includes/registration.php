<script src="assets/js/jquery.min.js"></script>

<?php 

session_start();
include('includes/config.php');
error_reporting(0);
if(isset($_POST['signup']))
{
$fname=$_POST['fullname'];
$email=$_POST['emailid']; 
$mobile=$_POST['mobileno'];
$password=md5($_POST['password']); 
$dob=$_POST['dob'];
$liscenceno=$_POST['liscenceno'];
$filename = rand(1000,10000)."-".$_FILES["myfile"]["name"];

  $file = $_FILES['myfile']['tmp_name'];
  $size = $_FILES['myfile']['size'];
  $destination = 'uploads/' . $filename;
      move_uploaded_file($file, $destination.'/'.$filename);
$sql="INSERT INTO  tblusers(FullName,EmailId,ContactNo,Password,dob,liscenceno,liscence,filesize) VALUES(:fname,:email,:mobile,:password,:dob,:liscenceno,:filename,:size)";

         
$query = $dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->bindParam(':dob',$dob,PDO::PARAM_STR);
$query->bindParam(':liscenceno',$liscenceno,PDO::PARAM_STR);
$query->bindParam(':filename',$filename,PDO::PARAM_STR);
$query->bindParam(':size',$size,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Registration successfull. Now you can login');</script>";
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
}
}

?>
<script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'emailid='+$("#emailid").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
<script type="text/javascript">
function valid()
{
if(document.signup.password.value!= document.signup.confirmpassword.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.signup.confirmpassword.focus();
return false;
}
return true;
}

</script>
<div class="modal fade" id="signupform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Sign Up</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="signup_wrap">
            <div class="col-md-12 col-sm-6">
             
  <div style="height:340px;width:600px;border:solid 2px red;overflow:scroll;overflow-x:hidden;overflow-y:scroll;"> 
             <form  action="#" method="post" class="form-disable"  enctype="multipart/form-data"  name="signup" onSubmit="return valid();">
      
                <div class="form-group">
                  <input type="text" class="form-control" name="fullname" placeholder="Full Name" required="required">
                </div>
                      <div class="form-group">
                  <input type="text" class="form-control" name="mobileno" placeholder="Mobile Number" maxlength="10" required="required">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="emailid" id="emailid" onBlur="checkAvailability()" placeholder="Email Address" required="required">
                   <span id="user-availability-status" style="font-size:12px;"></span> 
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Password" required="required">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" required="required">
                </div>
               <div class="form-group">
                  <label>Date-of-Birth</label>
                  <input type="date" class="form-control" name="dob" placeholder="Date-Of-Birth" required="required">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="liscenceno" placeholder="Liscence Number" maxlength="20" required="required">
                </div>
                <div class="form-group" >
                <label>Upload Liscence</label>
              <input type="file" name="myfile"> <br>
          </div>
                <div class="form-group checkbox">
                  <input type="checkbox" id="terms_agree" required="required" checked="">
                  <label for="terms_agree">I Agree with <a href="page.php?type=terms">Terms and Conditions</a></label>
                </div>
                <div class="form-group">
                  <input type="submit" value="Sign Up" name="signup" id="submit" class="btn btn-block">
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        <p>Already got an account? <a href="#loginform" data-toggle="modal" data-dismiss="modal">Login Here</a></p>
      </div>
    </div>
  </div>
</div>
</div>