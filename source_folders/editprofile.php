<?php
include 'commonfiles/comuser.php';
class entprfl extends usrslfdtls{
public function usrprofileUpdate($fulname,$email,$usnm,$usbo,$gender,$date,$month,$year,$location,$paswd){
  $conn=$this->connect();
    $usrid=$_SESSION['ssndi'];
    $userid=htmlentities(mysqli_real_escape_string($conn,$usrid));
    $fullname=strtolower(htmlentities(mysqli_real_escape_string($conn,$fulname)));
    $Email=htmlentities(mysqli_real_escape_string($conn,$email));
    $usnm=strtolower(htmlentities(mysqli_real_escape_string($conn,$usnm)));
    $usbo=htmlentities(mysqli_real_escape_string($conn,$usbo));
    $Gen=strtolower(htmlentities(mysqli_real_escape_string($conn,$gender)));
    $Date=strtolower(htmlentities(mysqli_real_escape_string($conn,$date)));
    $Month=strtolower(htmlentities(mysqli_real_escape_string($conn,$month)));
    $Year=strtolower(htmlentities(mysqli_real_escape_string($conn,$year)));
    $Loc=htmlentities(mysqli_real_escape_string($conn,$location));
    $pass=htmlentities(mysqli_real_escape_string($conn,$paswd));
    $dateOfBirth=$Date."-".$Month."-".$Year;
    if($Email ==""||empty($Email)){
    return 'Please fill in your Email address.';
    }elseif ($fullname == ""||empty($fullname)) {
    return 'Please fill in your full name.';
    }elseif (strlen($fullname) >20) {
    return 'Your full name exceeded the maximum limit 20 characters.';
    }elseif ($usnm == ""||empty($usnm)) {
    return 'Please fill in your user name.';
    }elseif (strlen($usnm) >20) {
    return 'Your username exceeded the maximum limit 20 characters.';
    }elseif ($Gen == ""||empty($Gen)) {
    return 'Please fill in your Gender.';
    }elseif ($Date == ""||empty($Date)) {
    return 'Please fill in your Date in data of birth.';
    }elseif ($Month == ""||empty($Month)) {
    return 'Please fill in your Month in data of birth.';
    }elseif ($Year == ""||empty($Year)) {
    return 'Please fill in your Year in data of birth.';
    }else if(date("Y")-$Year<13){
    return "You age is not valid to use remindo.";
    }elseif (strlen($Loc) >112) {
    return 'Your locality exceeded the maximum limit 112 characters.';
    }elseif($paswd ==""){
    return 'Please enter your password';
    }else{
    $sqlcheck="SELECT rusacpd,runm FROM roupldls WHERE usid='$usrid';";
    $queryCheck=$this->connect()->query($sqlcheck);
    if($queryCheck){
        if($queryCheck->num_rows>0){
        $row=$queryCheck->fetch_assoc();
        $sqlpwd=$row['rusacpd'];
            if(password_verify($paswd,$sqlpwd)){
              $usch=$usnm;
              $usnm=$this->sblen(htmlentities(mysqli_real_escape_string($conn,$usnm)),$this->iky,'idx');
              $ckunm=$row['runm'];
              $sqlvrfy="SELECT usid FROM roupldls WHERE runm='$usnm' AND runm!='$ckunm';";
              $queryvfy=$conn->query($sqlvrfy);
              if($queryvfy){
              if($queryvfy->num_rows>0&&$usch!=$this->dec($row['runm'],$this->iky)){
                      return 'This username is already taken.';
              }else{
              $fullname=$this->sblen(htmlentities(mysqli_real_escape_string($conn,$fulname)),$this->iky,'idx');
              $email=$this->enc(htmlentities(mysqli_real_escape_string($conn,$email)),$this->iky,'idx');
              // $usnm=$this->sblen(htmlentities(mysqli_real_escape_string($conn,$usnm)),$this->iky,'idx');
              $usbo=$this->enc(htmlentities(mysqli_real_escape_string($conn,$usbo)),$this->iky,'mtr');
              $Gen=$this->enc(htmlentities(mysqli_real_escape_string($conn,$gender)),$this->iky,'mtr');
              $Loc=$this->enc(htmlentities(mysqli_real_escape_string($conn,$location)),$this->iky,'mtr');
              $dateOfBirth=$this->enc($dateOfBirth,$this->iky,"mtr");  
              $sqlUpdate="UPDATE roupldls SET rmuflm='$fullname',runm='$usnm',usml='$email',usrlocty='$Loc',rugdr='$Gen',bio='$usbo',rusdob='$dateOfBirth' WHERE usid='$userid';";
                $queryUpdate=$this->connect()->query($sqlUpdate);
                if($queryUpdate){
                $_SESSION['usml']=$email;
                return 'Updated';
                }else{
                  echo "Sorry failed to update. Please try again later.";
                }
                }
            }else{
              echo "Sorry failed to update. Please try again later.";
            }
            }else{
                return 'Invalid Password!';
            }
          }
    }else{
        return'Failed to update. Please try again after sometime.';
    }
    }
}
public function editprofilepgbody(){
  $data=json_decode($this->usrs());
  return "<div class='editprofileinprfpgg'>
  <div class='remindoprofilepgsnavigatorcontainerbox'>
  <div class='remindoprofiletopnavigator'>
      <div class='remindobackbtnuname'>
          <div class='remindobacknavigationbtn remindobackedtprfnavigationbtn'>
          <i class='fas fa-arrow-left remindonavibackbtn'></i>
          </div>
          <div class='remindopagenamecontainerbox'>
          Edit Profile
          </div>
      </div>
  </div>
  </div>
  <div class='remindobodyofeditprofile'>
  <div class='editprofileinputs' style='padding:6px;margin: auto;'>
      <form action=' class='rmdoprofileditform' method='post'>
        <span class='formchangableinputscontainerbox'>
        <div class='editprofilefullnamcontainer dpgriddivbox'>
            <label for='editfullName'>Full Name</label>
            <input type='text' class='edtprflinptbx' id='editfullName' value='$data->usrflnm' placeholder='full Name'>
        </div>
        <div class='editprofileemailcontainer dpgriddivbox'>
            <label for='editemail'>Email</label>
            <input type='text' class='edtprflinptbx' id='editemail' value='$data->mal' placeholder='Email'>
        </div>
        <div class='editprofileusrnmcontainer dpgriddivbox'>
            <label for='editemail'>Username</label>
            <input type='text' class='edtprflinptbx' id='usrname' value='$data->usrnm' placeholder='Username'>
        </div><br>
        <div class='editprofilegendercontainer'>
            <span class='rmdusrgenlogbox'></span>
            <label for='editgender'>Gender</label>
            <select name='' class='u_gdreditprofile'>
            <option class='optgndr'>$data->gndr</option>
            </select>
        </div><br>
        <div class='editprofiledateofbirthcontainer'>
        <div class='cakedaycontainer'>
        <i class='fas fa-birthday-cake remindosymbols'></i>   
        <label for='editdateofbirth' class='dateofbirthlabel'>Date Of Birth</label>
        </div>
        <div class='dateofbitheditcontainer'>
        <select name='data-of-birth-date' class='usrbirthdate usrbdttt' requird>
        <option class='optd'>$data->bdt</option>
        </select>
        <select name='data-of-birth-month' class='ussrbmttt rmdousrbirthmonth' requird>
        <option class='optm' value='".date_format(date_create($data->usrdbth),'m')."'>".date_format(date_create($data->usrdbth),'F')."</option>
        <option value='01'>January</option>
        <option value='02'>February</option>
        <option value='03'>March</option>
        <option value='04'>April</option>
        <option value='05'>May</option>
        <option value='06'>June</option>
        <option value='07'>July</option>
        <option value='08'>August</option>
        <option value='09'>September</option>
        <option value='10'>October</option>
        <option value='11'>November</option>
        <option value='12'>December</option>
        </select>
        <select name='data-of-birth-year' class='usrbysubt rmdousrbirthyear' requird>
        <option class='opty'>$data->byr</option>  
        </select>
        </div>
        </div><br>
        <div class='rdlocationinfcontainerdivbox'>
        <i class='fas fa-map-marker-alt remindosymbols locationIcon'></i><label for='locinputid'>Current Address</label></br>
        <textarea class='locinput edtprflinptbx' id='locinputid' placeholder='Add address' style='height: 100px;width: 250px;padding: 4px;background: #f4f3f4;border: none;margin: 5px;padding: 10px;border-radius: 5px;font-size: 15px;font-family: Helvetica;'>$data->usrmlc</textarea>
        </div><br>
        <div class='rdlocationinfcontainerdivbox'>
        <label for='bioo'>Bio</label><br>
        <textarea class='edtprflbio edtprflinptbx' value='$data->usrbio' id='bioo' placeholder='Bio'></textarea>
        </span>
        <div class='formsubmitbtncontainerbox'>
        <button type='button' class='submiteditprofileform'>Update Changes</button>
        </div>
      </form>
  </div>
  <div class='popupbackground'>
    <div class='popupcontainerbox'>
    <div class='pageloader' style='display:none;'><div class='remindopageloaderdivbox'></div></div>
      <div class='popupheaderbox'>
        <h2 class='popupheadertitle'>Password</h2>
        <button type='button' class='hidepopupbtn'>X</button>
      </div>
      <div class='popupcontentcontainerbox'>
        <div class='rdlocationinfcontainerdivbox'>
          <i class='fas fa-key remindosymbols passwordIcon'></i><label for='remindousrpwdtoupdt'>Enter your password to confirm update</label>
          <input type='password' class='rmdowiseluprsd edtprflinptbx' id='remindousrpwdtoupdt' placeholder='Password' required>
          <div class='buttonbox'>
          <span class='pderrcs'></span>
          <button type='button' class='submitrmdresform'>Update Changes</button>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js'></script>
<script src='http://localhost/remindo/js/comfle.js'></script>
<script src='http://localhost/remindo/profilepgs/js/edtplee.js'></script>
<div class='dvsrpts'></div>
  </div>";
}
}
if(isset($_GET['editprofile'])){
  $upu=new entprfl();
  echo json_encode(array(
    'title'=>"Edit Profile | Remindo",
    'url'=>'editprofile.php',
    'body'=>$upu->editprofilepgbody(),
  ));
}
elseif(isset($_POST['upusreprfl'])){
    if($_POST['upusreprfl']=='trys'&&isset($_POST['usbbmt'])){
        sleep(1);
        $upu=new entprfl();
       echo $upu->usrprofileUpdate($_POST['flusrn'],$_POST['useml'],$_POST['usnm'],$_POST['usbo'],$_POST['gnusr'],$_POST['usrbdt'],$_POST['usrbmt'],$_POST['usrbyt'],$_POST['uslct'],$_POST['usltc']);
    }
}
elseif(!isset($_POST['editprofile'])&&!isset($_POST['upusreprfl'])&&!isset($_POST['usbbmt'])){
if(!isset($_SESSION['usrml'])){
    header("Location: signin");
}
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile | Remindo</title>';
    include 'commonfiles/commoncss.php';
    echo '
</head>
<body>
<div class="pageloader" style="display:none;"><div class="remindopageloaderdivbox"></div></div>
<div class="remindomainheaderlptpvsn"></div>
<div class="remindochildboxycontainer">';
$upu=new entprfl();
 echo $upu->editprofilepgbody();
echo '
</div>
</body>
</html>';
  }
?>