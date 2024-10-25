<?php
session_start();
include '../db_conn.php';
class acntstngs extends dbconnect{
    public function accountSettings($type,$uod){
        $conn=$this->connect();
        $u=htmlentities($_SESSION['ssndi']);
        $tp=htmlentities(mysqli_real_escape_string($conn,$type));
        $ud=htmlentities(mysqli_real_escape_string($conn,$uod));
        $eml0=$this->enc(0,$this->iky,'mtr');
        $eml1=$this->enc(1,$this->iky,'mtr');
        $acstngs="";
        if($tp=="milntfy"){if($ud==1){$sqlUPDT="UPDATE roupldls SET rualmlsnfy='$eml1' WHERE usid='$u';";}
        elseif($ud==0){$sqlUPDT="UPDATE roupldls SET rualmlsnfy='$eml0' WHERE usid='$u';";}}
        if($conn->query($sqlUPDT)){echo "updated";}else{echo"failed";}
        return ;
    }
    protected function getaccdtls(){
        $conn=$this->connect();
        $u=htmlentities($_SESSION['ssndi']);
        $sql="SELECT rualmlsnfy FROM roupldls WHERE usid='$u';";
        $query=$conn->query($sql);
        if($query){
            if($query->num_rows>0){$row=$query->fetch_assoc();return $row;}
            else{return "none";}
        }else{return 0;}
    }
    public function pwdupdt($odpd,$nwpd,$cnwpd){
        $conn=$this->connect();
        $u=htmlentities($_SESSION['ssndi']);
        $old=htmlentities(mysqli_real_escape_string($conn,$odpd));
        $np=htmlentities(mysqli_real_escape_string($conn,$nwpd));
        $cnp=htmlentities(mysqli_real_escape_string($conn,$cnwpd));
        if(strlen($np)<8||strlen($cnp)<8){echo "Passwords should be more than 8 characters.";}
        elseif($np!=$cnp){echo "New passwords mismatched.";}
        else{
            $sql="SELECT rusacpd FROM roupldls WHERE usid='$u';";
            $query=$conn->query($sql);
            if($query){
                if($query->num_rows>0){
                    $row=$query->fetch_assoc();
                    if(password_verify($old,$row['rusacpd'])){
                        $hp=password_hash($cnp,PASSWORD_DEFAULT);
                        $sqlU="UPDATE roupldls SET rusacpd='$hp' WHERE usid='$u';";
                        if($conn->query($sqlU)){echo "Updated!";}else{echo "Failed to update. Try again after sometime.";}
                    }else{echo "Old password is incorrect.";}
                }else{echo "You have no account.";}
            }else{echo "Failed to verify old password. Try again after sometime.";}
        }
        return;
    }
    public function newpwdform(){
        $body="<div class='ppcntrbdydvbx'>
        <center>
          <input type='password' class='odpasiptbx' placeholder='Old Password'>
          <input type='password' class='nwpasiptbx' placeholder='New Password'>
          <input type='password' class='cnwpasiptbx' placeholder='Confirm New Password'>
          <div class='buttonbox'><span class='pderrcs'></span><br><button type='button' role='button' class='chngacpwdbtn'>Change Password</button></div>
        </center>
      </div>";
        echo json_encode(array(
            "ppttle"=>"Change Password",
            "ppbdy"=>"$body",
        ));
    }
}
$c=new acntstngs();
if(isset($_POST['udtstngs'])){
    if($_POST['udtstngs']=="udttre"&&isset($_POST['tp'])&&isset($_POST['uod'])){
        $typ=htmlentities(mysqli_real_escape_string($conn,$_POST['tp']));
        $ud=htmlentities(mysqli_real_escape_string($conn,$_POST['uod']));
        echo $ud=($ud=="tre")?1:(($ud=="fls")?0:"");
        $c->accountSettings($typ,$ud);
    }
}
if(isset($_POST['chngdtpwd'])){
    if($_POST['chngdtpwd']=="chngudttre"&&isset($_POST['odpd'])&&isset($_POST['nwpd'])&&isset($_POST['cnwpd'])){
        $old=htmlentities(mysqli_real_escape_string($conn,$_POST['odpd']));
        $new=htmlentities(mysqli_real_escape_string($conn,$_POST['nwpd']));
        $cnew=htmlentities(mysqli_real_escape_string($conn,$_POST['cnwpd']));
        $c->pwdupdt($old,$new,$cnew);
    }
}
if(isset($_POST['cngpwdfrm'])){if($_POST['cngpwdfrm']=="cngtreshw"){$c->newpwdform();}}
?>