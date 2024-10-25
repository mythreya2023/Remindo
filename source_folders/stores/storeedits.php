<?php
include "../db_conn.php";
session_start();
class stredts extends dbconnect {
    public function strdtls($strng){
        $conn=$this->connect();
        $strid=$this->dec(htmlentities(mysqli_real_escape_string($conn,$strng)),$this->strec);
        $unm=$this->sblen(htmlentities(mysqli_real_escape_string($conn,$strng)),$this->strec,'strix');
        $sql="SELECT stnmr,stratmnt,stsbsnmblnum,strseml,stradrs,stracptbluipmtmtds,strnm,strrctgre,strbsnonr,strbsntmnmbrs,stropngclsngtmgs,strpdtmnprchs FROM stsinmtplc WHERE stnmr='$strid' OR stratmnt='$unm';";
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
    public function streds($strdls){
        $bnm=strtoupper(substr($this->sbldc($strdls['strnm'],$this->strec),0,1)).substr($this->sbldc($strdls['strnm'],$this->strec),1);
        $srtmgs=$this->dec($strdls['stropngclsngtmgs'],$this->strec);$ed=[];$su=[];
        if($srtmgs!="nha"&&$srtmgs!=""){$edsus=explode("||",$srtmgs);$ed=explode("//",$edsus[0]);$su=explode("//",$edsus[1]);}
        return "<div class='rmdohomepagediv'>
            <div class='rmdohmpghdr'></div>
            <div class='bsnstrstupdvbbxx'>
            <div class='remindobackbtnuname' style='cursor:pointer;padding:6px;'>
                <div class='rmdobctostrbtn'><i class='fas fa-arrow-left remindonavibackbtn'></i></div>
                <div class='remindopagenamecontainerbox'>Edit Store</div>
            </div><hr><style>.stupusnmnotebx{width:100%;}</style>
                <div class='stuperrstsdvbx'></div>
                <div class='stredtelmtscntngcntnrdvbx'>
                    <div class='stptbsncntbxs bsnacntedtnunemlcntngbx'>
                        <div class='stupnunemiptscntngdvbx'>
                            <input type='hidden' id='stnmrecptd' value='".$this->enc($strdls['stnmr'],$this->strec,'mtr')."'>
                            <div class='snmiptdvbx'><div class='stpiptttlbx'>Business name</div><input type='text' class='stupits strflnm' placeholder='Business name' value='$bnm' required/></div>
                            <div class='sunmiptdvbx'>
                            <div class='stpiptttlbx'>Username</div><input type='text' class='stupits streusat' placeholder='Username' value='".$this->sbldc($strdls['stratmnt'],$this->strec)."' required/>
                            <div class='stupusnmnotebx'><strong>Note:</strong> It's easier for people to find your store in search when it has a unique username.</div>
                            </div>
                            <div class='strcatgoriedvbx'>
                            <div class='stpiptttlbx'>Category</div>
                                <select class='strecatgreselct' required>
                                    <option>".$this->dec($strdls['strrctgre'],$this->strec)."</option>
                                    <option>-- Select Category --</option>
                                    <option>Electronics</option>
                                    <option>Furniture</option>
                                    <option>Grocery Store</option>
                                    <option>Clothing & Fashion</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class='stptbsncntbxs bsnacntedtmladscntngbx'>
                        <div class='stupmnmadrsiptscntngdvbx'>
                            <div class='mnmiptdvbx'>
                            <div class='stpiptttlbx'>Mobile number</div><span>+91</span><input type='number' class='stupits strmblnm' placeholder='Mobile Number' value='".$this->dec($strdls['stsbsnmblnum'],$this->strec)."' required/><br />
                            <div class='stupusnmnotebx'><strong>Note:</strong> Try to give a mobile number that has UPI accessibility.</div></div>
                            <div class='mliptdvbx'>
                            <div class='stpiptttlbx'>Email (optional)</div><input type='email' class='stupits edtstreml' placeholder='E-mail' value='".$this->dec($strdls['strseml'],$this->strec)."' /></div>
                            <div class='sunmiptdvbx'>
                                <div class='stpiptttlbx'>Payment methods</div>
                                <select class='strepmtmtdsselct' multiple='multiple' required>
                                    <option>Paytm</option>
                                    <option>Phone pe</option>
                                    <option>Google pay</option>
                                    <option>Amazon pay</option>
                                    <option>Mobikwik</option>
                                    <option>I don't have any of these.</option>
                                </select>
                                <div class='stupusnmnotebx'><strong>Note:</strong> Your customers can know what payment methods are accessible above the phone number and pays you through it.</div>
                            </div>
                        </div>
                    </div>
                    <div class='stptbsncntbxs bsnacntedtlcncntngbx'>
                        <div class='stupmnmadrsiptscntngdvbx'>
                            <div class='sunmiptdvbx'>
                                <div class='stpiptttlbx'>Address</div>
                                <textarea class='stupits streadrsipt' placeholder='Address' required/>".$this->dec($strdls['stradrs'],$this->strec)."</textarea>
                                <div class='stupusnmnotebx'><strong>Note:</strong> Your store is physically known by your address.</div><br>
                            </div>
                        </div>
                    </div>
                    <div class='stptbsncntbxs bsnacntedtlcncntngbx'>
                        <div class='stupmnmadrsiptscntngdvbx'>
                            <div class='sunmiptdvbx'>
                                <div class='stpiptttlbx'>Timings</div>
                                <div class='' style='border: 1px solid gray;border-radius: 5px;margin: auto;'>
                                    <div class='' style='display: flex;flex-direction: row;align-items: center;justify-content: center;'>
                                        <div class='' style='color: darkslategray;font-size: 15px;'>Everyday: </div>
                                        <div class=''>
                                            <span>
                                                <span class='opntmngs'><input class='tmgsipt' id='opnsatmgsipt' placeholder='Opens' style='width:50px;padding:5px;' value='".substr(trim($ed[0]),0,-2)."'></span>
                                                <span><select id='eoapm' style='padding:0;'><option ".((substr(trim($ed[0]),-2)=="AM")?"selected":"").">AM</option><option ".((substr(trim($ed[0]),-2)=="PM")?"selected":"").">PM</option></select></span>
                                            </span>
                                            <span>-</span>
                                            <span>
                                                <span class='opntmngs'><input class='tmgsipt' id='clsatmgsipt' placeholder='Closes' style='width:50px;padding:5px;' value='".substr(trim($ed[1]),0,-2)."'></span>
                                                <span><select id='ecapm' style='padding:0;'><option ".((substr(trim($ed[1]),-2)=="AM")?"selected":"").">AM</option><option ".((substr(trim($ed[1]),-2)=="PM")?"selected":"").">PM</option></select></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class='' style='display: flex;flex-direction: row;align-items: center;justify-content: center;'>
                                        <div class='' style='color: darkslategray;font-size: 15px;'>Sunday: </div>
                                        <div class=''>
                                            <span>
                                                <span class='opntmngs'><input class='tmgsipt' id='snopnsatmgsipt' placeholder='Opens' style='width:50px;padding:5px;' value='".substr(trim($su[0]),0,-2)."'></span>
                                                <span><select id='soapm' style='padding:0;'><option ".((substr(trim($su[0]),-2)=="AM")?"selected":"").">AM</option><option ".((substr(trim($su[0]),-2)=="PM")?"selected":"").">PM</option></select></span>
                                            </span>
                                            <span>-</span>
                                            <span>
                                                <span class='opntmngs'><input class='tmgsipt' id='snclsatmgsipt' placeholder='Closes' style='width:50px;padding:5px;'value='".substr(trim($su[1]),0,-2)."'></span>
                                                <span><select id='scapm' style='padding:0;'><option ".((substr(trim($su[1]),-2)=="AM")?"selected":"").">AM</option><option ".((substr(trim($su[1]),-2)=="PM")?"selected":"").">PM</option></select></span>
                                            </span>
                                        </div>
                                    </div>
                                    <h4 style='margin:5px;text-align:center;'>OR</h4>
                                    <div class='' style='display:flex;align-items:center;
                                    color: darkslategray;'>
                                    <input type='radio' style='width:fit-content;' id='nhavblipt' value='nha' ".(($srtmgs=="nha"||$srtmgs=="")?"checked":"").">
                                        <h4 style='margin:0;width:fit-content;display: flex;align-items: center;justify-content: center;'>No Hours Available.</h4>
                                    </div>
                                </div>
                                <div class='stupusnmnotebx'><strong>Note:</strong> Your physical store's timings can be known by your customers.</div><br>
                            </div>
                        </div>
                    </div>
                    <div class='stptbsncntbxs bsnacntedtlcncntngbx'>
                        <div class='stupmnmadrsiptscntngdvbx'>
                            <div class='sunmiptdvbx'>
                                <div class='stpiptttlbx'>Min Purchase</div>
                                <input type='number' class='mnpchseipt' placeholder='Minimum Purchase' value='".$this->dec($strdls['strpdtmnprchs'],$this->strec)."'/>
                                <div class='stupusnmnotebx'></div><br>
                            </div>
                        </div>
                    </div>
                    <input type='hidden' id='hdptsvledts' value='".$this->dec($strdls['stracptbluipmtmtds'],$this->strec)."'>
                    <input type='hidden' id='hdnusrvledts' value='".$strdls['stnmr']."'>
                    <div class='stupnxtbtn stredtsupdtcmpltdnxtpgbtn' role='button'><span class='stpnxtbtntxt'>Update</span></div>
                </div>
                <div id='snackbar'></div>
            </div>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js'></script>
            <script src='http://localhost/remindo/js/comfle.js'></script>
            <script src='http://localhost/remindo/stores/stredt.js'></script>
            <div class='dvsrpts'></div>
        </div>";
    }
    public function vfyusr($usr){
        $s=$this->strdtls($usr);
        if($s!=0){
            if($this->dec($s['strbsnonr'],$this->iky)==htmlentities($_SESSION['ssndi'])){return "o";}else{
            // if($this->vfycmrol($s["stnmr"])!=0){
            //     $rol=$this->dec($this->vfycmrol($s["stnmr"])['strolofpsn'],$this->iky);
            //     if($rol=="Admin"){return "o";}else{return 'c';}
            // }
            // else{
                return "c";
            // }
            }
        }else {return 0;}
    }
}
$stds= new stredts();
function bdyjsn($s){
    echo json_encode(array(
    'title'=> "Store edits | Remindo",
    'body'=> $s,
));}
if(isset($_POST['s'])){
    $s=htmlspecialchars($_POST['s']);
    if($stds->vfyusr($s)=="o"){$str=$stds->streds($stds->strdtls($s));bdyjsn($str);}
    else{echo "<center><h2 style='color:gray;'>This store is no longer available.</h2><br><a href='https://remindo.in'><div class='pgnavblbtn blewhtbns'><i class='fas fa-arrow-left remindosymbols' style='color:white; font-size:14px;'></i>Back to home</div><br></a></center>";}
}
elseif(isset($_POST['ppsttevt'])){if($_POST['ppsttevt']=="frdppstt"&&isset($_GET['s'])){if($stds->vfyusr($_GET['s'])=="o"){$str=$stds->streds($stds->strdtls($_GET['s']));bdyjsn($str);}
else{echo "<center><h2 style='color:gray;'>This store is no longer available.</h2><br><a href='https://remindo.in'><div class='pgnavblbtn blewhtbns'><i class='fas fa-arrow-left remindosymbols' style='color:white; font-size:14px;'></i>Back to home</div><br></a></center>";}}}
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
    <title>'; echo 'Store edits | Remindo</title>';
    include '../commonfiles/commoncss.php';
echo '</head>
<body class="storeedtspgbdy">
<div class="pageloader" style="display:none;"><div class="remindopageloaderdivbox"></div></div>
<div class="remindomainheaderlptpvsn strpghdrcntnrdvbx"></div>
<div class="remindochildboxycontainer rmdchldbxstrecustmruidvbx">';
if(isset($_GET['s'])){
$s=htmlspecialchars($_GET['s']);
if($s!=""){if($stds->vfyusr($s)=="o"){echo $stds->streds($stds->strdtls($s));}
else{echo "<center><h2 style='color:gray;'>This store is no longer available.</h2><br><a href='https://remindo.in'><div class='pgnavblbtn blewhtbns'><i class='fas fa-arrow-left remindosymbols' style='color:white; font-size:14px;'></i>Back to home</div><br></a></center>";}}
else{echo "<center><h2 style='color:gray;'>This store is no longer available.</h2><br><a href='https://remindo.in'><div class='pgnavblbtn blewhtbns'><i class='fas fa-arrow-left remindosymbols' style='color:white; font-size:14px;'></i>Back to home</div><br></a></center>";}
}
echo '
</div>
</body>
</html>';
}
?>