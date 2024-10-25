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
        $vfr="";
        if(isset($this->vfycmrol($strdls['stnmr'])['strolofpsn'])){$vfr=$this->vfycmrol($strdls['stnmr'])['strolofpsn'];}else{$vfr="";}
        $strols="<div class='rmdohomepagediv'>
            <div class='rmdohmpghdr'></div>
            <div class='bsnstrstupdvbbxx' style='overflow:visible;'>
            <input type='hidden' id='hnitsidval' value='".$this->enc($strdls['stnmr'],$this->strec,'mtr')."'>
            <input type='hidden' id='strlval' value='$vfr'>
            <div class='remindobackbtnuname' style='cursor:pointer;padding:6px;'>
                <div class='rmdobctostrbtn'><i class='fas fa-arrow-left remindosymbols remindonavibackbtn'></i></div>
                <div class='remindopagenamecontainerbox'>Store Team</div>
            </div>
            <div class='strallprdtscntngdvbx'>
                <div class='strprdtspgsrchbxhdrdvbx'>
                    <div class='strprdtssrchbxcntngdvbx' style='align-items:center;'>
                        <div class='usrstobtmbrdsplydvbx' style='width:60%;position: relative;width: 60%;'>
                            <input type='text' class='srchprdtsinstrtostronr' id='srchpplinrmdo'  autocomplete='off' style='width: 88%;' placeholder='Type a name or username...'>
                            <div class='iptsrchusrdcntngdvbx'></div>
                        </div>
                    </div>
                    <div class='strprdtspghdtbtnscntngdvbx' style='justify-content:space-between;'>
                        <div class='ttltmatsofstrdvbx' style='float:left;padding: 3px;color: gray;margin-left: 5px;'></div>
                    </div>
                </div><hr>
                <div class='strsallprdtelmscntngdvbx'>
                    <div class='prdtsdsplngwall strolsdsplycntngdvbx' data-r='".strtolower($this->dec($vfr,$this->strec))."'></div>
                </div>
            </div>
            </div>
            <div class='popupbackground strolsppup'>
            <div class='popupcontainerbox strolsppup' style='width:fit-content;width:337px;'>
                <div class='popupheaderbox'>
                    <h2 class='popupheadertitle strqrpupttl'>Edit Team</h2>
                    <button type='button' class='hidepopupbtn'>X</button>
                </div>
                <div class='popupcontentcontainerbox'>
                    <div class='adstrolstotmcntngdvbx'>
                        <div class='strtmbrcntngdvbx'>
                        <div class='strtmbrpfig'>";
                        if(file_exists("../pflmgs/defa.png")){$strols.="<img src='../pflmgs/defa.png'>";}
                        $strols.="
                        </div>
                        <div class='strtmbrnam'>Mythreya Reddy Chowla</div>
                        </div>
                        <div class='stredtmerlsoptnsctngdvbx'>
                            <div class='strolshdng'>Store Roles</div>
                            <div class='strolscntngdvbx'>
                                <div class='strole' data-srl='Admin'><span>Admin</span><span class='tckspan'></span></div>
                                <div class='strole' data-srl='Product Manager'><span>Product Manager</span><span class='tckspan'></span></div>
                                <div class='strole' data-srl='Embedder'><span>Embedder</span><span class='tckspan'></span></div>
                                <div class='strole' data-srl='A Member'><span>A Member</span><span class='tckspan'><i class='fas fa-check remindosymbols' style='color:#1e88e5;padding:0;'></i></span></div>
                            </div>
                            <div class='strolsadoruodbns'>
                                <div class='blewhtbns strasgnrlsbtns adstroltostr'>Add</div>
                                <div class='blewhtbns strasgnrlsbtns svedtdstrolinstr'>Change</div>
                                <div class='blewhtbns strasgnrlsbtns dscrdstrolinstrstr'>Discard</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class='popupbackground vfypwd'>
            <div class='popupcontainerbox vfypwd' style='width:340px;'>
                <div class='popupheaderbox'>
                <h2 class='popupheadertitle'>Password</h2>
                <button type='button' class='hidepopupbtn'>X</button>
                </div>
                <div class='popupcontentcontainerbox'>
                <div class='rdlocationinfcontainerdivbox'>
                    <div style='display:flex;align-items;center;'><i class='fas fa-key remindosymbols passwordIcon'></i>
                    <div for='remindousrpwdtoupdt'>For security please enter your password to verify!</div></div>
                    <input type='password' class='rmdowiseluprsd rmdoprflpwd' id='rmndousrpwdtoupdt' style='width: 91%;min-width: 261px;' placeholder='Password' required>
                    <div class='buttonbox'>
                    <span class='pderrcs'>lsd</span>
                    <button type='button' class='submitrmdresform sbmttocngrol'>Verify And Continue</button>
                </div>
                </div>
            </div>
            </div>
            </div>
            <div id='snackbar'></div>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js'></script>
            <script src='http://localhost/remindo/js/comfle.js'></script>
            <script src='http://localhost/remindo/stores/pcmses.js'></script>
            <div class='dvsrpts'></div>
        </div>";
        return $strols;
    }
    public function vfyusr($usr){
        $s=$this->strdtls($usr);
        if($s!=0){
            if($this->dec($s['strbsnonr'],$this->iky)==htmlentities($_SESSION['ssndi'])){return "o";}else{
                if($this->vfycmrol($s["stnmr"])!=0){return "o";}
                else{return "c";}
            }
        }else {return 0;}
    }
    public function dc($v){
        return $this->dec($v,$this->strec);
    }
}
$stds= new strpdctmrs();
function bdyjsn($s){
    echo json_encode(array(
    'title'=> "Store Team | Remindo",
    'body'=> $s,
));}
if(isset($_GET['gtit'])&&$_GET['gtit']=='ystregtit'&&isset($_GET['s'])){
    $s=htmlspecialchars($_GET['s']);
    if($stds->vfyusr($s)=="o"){echo $str=$stds->strecmrs($stds->strdtls($s));}
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
    <title>'; echo 'Store Team | Remindo</title>';
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