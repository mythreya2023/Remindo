<?php
include '../db_conn.php';
session_start();
class strovrisgts extends dbconnect{
    public function strdtls($strng){
        $conn=$this->connect();
        $strid=$this->dec(htmlentities(mysqli_real_escape_string($conn,$strng)),$this->strec);
        $unm=$this->sblen(htmlentities(mysqli_real_escape_string($conn,$strng)),$this->strec,'strix');
        $sql="SELECT stnmr,stratmnt,strnm,strbprflig,strbsnonr FROM stsinmtplc WHERE stnmr='$strid' OR stratmnt='$unm';";
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
    public function strovrandisgts($strdls){
    $srovrvwpg="<div class='rmdohomepagediv'>
    <div class='rmdohmpghdr'></div>
    <div class='rmdohmpgcntrdvbx'><input type='hidden' id='hnitsidval' value='".$this->enc($strdls['stnmr'],$this->strec,'mtr')."'>
        <div class='rmdostrovrvwcntngmanorgnldvbx'>
            <div class='rmdostrovrvwpgshdrcntngdvbx'>
                <div class='rmdostrgthfcntngdvbx'>
                    <div class='ovrvwpgbckbtn'><i class='fas fa-arrow-left remindosymbols'></i></div>
                    <div class='ovrinsgtspgttle'>Overview & Insights</div>
                </div>
            </div>
            <div class='rmdostrmidbdystrpfadtmdtlscntngdvbx'>
                <div class='strpfldtlscntngdvbx'>
                    <div class='strpflimgcntngdvbx'>";
                    if($this->dec($strdls['strbprflig'],$this->strec)!=""&&file_exists("../fhupuppts/".$this->dec($strdls['strbprflig'],$this->strec))){
                        $srovrvwpg.="<img src='../fhupuppts/".$this->dec($strdls['strbprflig'],$this->strec)."' class='strpfigpc'>";}
               $srovrvwpg.="</div>
                    <div class='strpflnmusnmcntngdvbx'>
                        <div class='strpfnmcntngdvbx'>".$this->sbldc($strdls['strnm'],$this->strec)."</div>
                        <div class='strpfusnmcntngdvbx'>@".$this->sbldc($strdls['stratmnt'],$this->strec)."</div>
                    </div>
                </div>
                <div class='strtmbrscntngdvbx'></div>
            </div>
            <div class='rmdostrovrvwpgsbdycntngdvbx'>
                <div class='rmdoovrpgdvbxcmrspdtscntngdvbx'>
                    <div class='ovrvwpullbarcntnr'></div>
                    <div class='rmoothcntrsovrldvcntnrdvbx'></div>
                </div>
            </div>
        </div>
    </div>
    <div id='snackbar'></div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js'></script>
    <script src='http://localhost/remindo/js/comfle.js'></script>
    <script src='http://localhost/remindo/stores/ovrvigts.js'></script>
    <div class='dvsrpts'></div>
    </div>";
    return $srovrvwpg;
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
$ovrvwigs=new strovrisgts();
function bdyjsn($ovrvwigs){
    echo json_encode(array(
    'title'=> "Overview & Insights | Remindo",
    'body'=> $ovrvwigs,
));}
if(isset($_GET['srovrigs'])&&$_GET['srovrigs']=="ytopovrigstre"&&isset($_GET['s'])){
    $s=htmlspecialchars($_GET['s']);
    if($ovrvwigs->vfyusr($s)=="o"){$str=$ovrvwigs->strovrandisgts($ovrvwigs->strdtls($s));bdyjsn($str);}
    else{echo "<center><h2 style='color:gray;'>This page is no longer available.</h2><br><div class='pgnavblbtn blewhtbns'><i class='fas fa-arrow-left remindosymbols' style='color:white; font-size:14px;'></i>Back to home</div><br></center>";}
}
elseif(isset($_POST['ppsttevt'])){if($_POST['ppsttevt']=="frdppstt"&&isset($_GET['s'])){if($ovrvwigs->vfyusr($_GET['s'])=="o"){$str=$ovrvwigs->strovrandisgts($ovrvwigs->strdtls($_GET['s']));bdyjsn($str);}
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
    <title>Overview & Insights | Remindo</title>';
    include '../commonfiles/commoncss.php';
echo '</head>
<body>
<div class="pageloader" style="display:none;"><div class="remindopageloaderdivbox"></div></div>
<div class="remindomainheaderlptpvsn"></div>
<div class="remindochildboxycontainer">';
if(isset($_GET['s'])){
$s=htmlspecialchars($_GET['s']);
if($s!=""){if($ovrvwigs->vfyusr($s)=="o"){echo $ovrvwigs->strovrandisgts($ovrvwigs->strdtls($s));}
else{echo "<center><h2 style='color:gray;'>This page is no longer available.</h2><br><div class='pgnavblbtn blewhtbns'><i class='fas fa-arrow-left remindosymbols' style='color:white; font-size:14px;'></i>Back to home</div><br></center>";}}
else{echo "<center><h2 style='color:gray;'>This page is no longer available.</h2><br><div class='pgnavblbtn blewhtbns'><i class='fas fa-arrow-left remindosymbols' style='color:white; font-size:14px;'></i>Back to home</div><br></center>";}
}else{echo "<center><h2 style='color:gray;'>This page is no longer available.</h2><br><div class='pgnavblbtn blewhtbns'><i class='fas fa-arrow-left remindosymbols' style='color:white; font-size:14px;'></i>Back to home</div><br></center>";}
echo '
</div>
</body>
</html>';
}
?>