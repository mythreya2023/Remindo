<?php
include "../db_conn.php";
session_start();
class strpdctmrs extends dbconnect {
    public function strdtls($strng){
        $conn=$this->connect();
        $strid=$this->dec(htmlentities(mysqli_real_escape_string($conn,$strng)),$this->strec);
        $unm=$this->sblen(htmlentities(mysqli_real_escape_string($conn,$strng)),$this->strec,'strix');
        $sql="SELECT stnmr,stratmnt,strnm,strrctgre,strbsnonr,strbsntmnmbrs FROM stsinmtplc WHERE stnmr='$strid' OR stratmnt='$unm';";
        $query=$conn->query($sql);
        if($query){
            if($query->num_rows>0){
                return $row=$query->fetch_assoc();
            }else{return 0;}
        }else{return 0;}
        return;
    }
    public function vfycmrol($str){
        $conn=$this->connect();
        $strid=$this->enc(htmlentities(mysqli_real_escape_string($conn,$str)),$this->strec,'strix');
        $unm=$this->enc(htmlentities(mysqli_real_escape_string($conn,$_SESSION['ssndi'])),$this->iky,'idx');
        $sql="SELECT rlid,strolofpsn FROM strtemrls WHERE sridtoasngrl='$strid' AND psnidassrol='$unm' AND stortmbrsts='YmcU3cVFEU2cUVEUUE';";
        $query=$conn->query($sql);
        if($query){if($query->num_rows>0){return $row=$query->fetch_assoc();}else{return 0;}}else{return "e0";}
    }
    public function strecmrs($strdls){
        $strpds= "<div class='rmdohomepagediv'>
            <div class='rmdohmpghdr'></div>
            <div class='bsnstrstupdvbbxx'>
            <input type='hidden' id='hnitsidval' value='".$this->enc($strdls['stnmr'],$this->strec,'mtr')."'>
            <div class='remindobackbtnuname' style='cursor:pointer;padding:6px;'>
                <div class='rmdobctostrbtn'><i class='fas fa-arrow-left remindosymbols remindonavibackbtn'></i></div>
                <div class='remindopagenamecontainerbox'>Customers</div>
            </div>
            <div class='strallprdtscntngdvbx'>
                <div class='strprdtspgsrchbxhdrdvbx'>
                    <div class='strprdtspghdtbtnscntngdvbx'>
                        <div class='blewhtbns strcasavlcmrsbtn' role='button'>C.A.S</div>
                    </div>
                </div><hr>
                <div class='strsallprdtelmscntngdvbx'>
                    <div class='prdtsdsplngwall'></div>
                </div>
            </div>
            </div>
            <div id='snackbar'></div>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js'></script>
            <script src='http://localhost/remindo/js/comfle.js'></script>
            <script src='http://localhost/remindo/stores/pcmses.js'></script>
            <div class='dvsrpts'></div>
        </div>";
        return $strpds;
    }
    public function vfyusr($usr){
        $s=$this->strdtls($usr);
        if($s!=0){
            if($this->dec($s['strbsnonr'],$this->iky)==htmlentities($_SESSION['ssndi'])){return "o";}else{
            if($this->vfycmrol($s["stnmr"])!=0){
                $rol=$this->dec($this->vfycmrol($s["stnmr"])['strolofpsn'],$this->iky);
                if($rol=="Admin"){return "o";}else{return 'c';}
            }
            else{return "c";}
            }
        }else {return 0;}
    }
}
$stds= new strpdctmrs();
function bdyjsn($s){
    echo json_encode(array(
    'title'=> "Customers | Remindo",
    'body'=> $s,
));}
if(isset($_POST['s'])){
    $s=htmlspecialchars($_POST['s']);
    if($stds->vfyusr($s)=="o"){$str=$stds->strecmrs($stds->strdtls($s));bdyjsn($str);}
    else{echo "<center><h2 style='color:gray;'>This page is no longer available.</h2><br><div class='pgnavblbtn blewhtbns'><i class='fas fa-arrow-left remindosymbols' style='color:white; font-size:14px;'></i>Back to home</div><br></center>";}
}
elseif(isset($_POST['ppsttevt'])){if($_POST['ppsttevt']=="frdppstt"&&isset($_GET['s'])){if($stds->vfyusr($_GET['s'])=="o"){$str=$stds->strecmrs($stds->strdtls($_GET['s']));bdyjsn($str);}
else{echo "<center><h2 style='color:gray;'>This page is no longer available.</h2><br><div class='pgnavblbtn blewhtbns'><i class='fas fa-arrow-left remindosymbols' style='color:white; font-size:14px;'></i>Back to home</div><br></center>";}}}
else{
if(!isset($_SESSION['usrml'])){
    header("Location: ../signin");
}
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>'; echo 'Customers | Remindo</title>';
    include '../commonfiles/commoncss.php';
echo '</head>
<body>
<div class="pageloader" style="display:none;"><div class="remindopageloaderdivbox"></div></div>
<div class="remindomainheaderlptpvsn strpghdrcntnrdvbx"></div>
<div class="remindochildboxycontainer rmdchldbxstrecustmruidvbx">';
if(isset($_GET['s'])){
$s=htmlspecialchars($_GET['s']);
if($s!=""){if($stds->vfyusr($s)=="o"){echo $stds->strecmrs($stds->strdtls($s));}
else{echo "<center><h2 style='color:gray;'>This page is no longer available.</h2><br><div class='pgnavblbtn blewhtbns'><i class='fas fa-arrow-left remindosymbols' style='color:white; font-size:14px;'></i>Back to home</div><br></center>";}}
else{echo "<center><h2 style='color:gray;'>This page is no longer available.</h2><br><div class='pgnavblbtn blewhtbns'><i class='fas fa-arrow-left remindosymbols' style='color:white; font-size:14px;'></i>Back to home</div><br></center>";}
}
echo '
</div>
</body>
</html>';
}
?>