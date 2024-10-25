<?php
include "../db_conn.php";
session_start();
class strpdts extends dbconnect {
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
        $sql="SELECT rlid,strolofpsn FROM strtemrls WHERE sridtoasngrl='$strid' AND psnidassrol='$unm';";
        $query=$conn->query($sql);
        if($query){if($query->num_rows>0){return $row=$query->fetch_assoc();}else{return 0;}}else{return "e0";}
    }
    public function stpdts($strdls,$rol){
        $strpds= "<div class='rmdohomepagediv'>
            <div class='rmdohmpghdr'></div>
            <div class='bsnstrstupdvbbxx'>
            <div class='remindobackbtnuname' style='cursor:pointer;padding:6px;'>
                <div class='rmdobctostrbtn'><i class='fas fa-arrow-left remindosymbols remindonavibackbtn'></i></div>
                <div class='remindopagenamecontainerbox'>Products</div>
            </div>
            <div class='strallprdtscntngdvbx'>
                <div class='strprdtspgsrchbxhdrdvbx'>
                    <div class='strprdtssrchbxcntngdvbx'>
                        <input type='text' class='srchprdtsinstrtostronr' id='srchprdtsinstrtostronr' placeholder='Search products'>
                        <div class='prdtstxtbxsrchbtn'><i class='fas fa-search remindosymbols'></i></div>
                    </div>
                    <div class='strprdtspghdtbtnscntngdvbx'>";
                    if($rol!="ebd"){$strpds.="<div class='blewhtbns straddprdtsbtn' role='button'>Add Item</div>";}
                    $strpds.="</div>
                    </div><hr>
                <div class='strsallprdtelmscntngdvbx' data-srl='$rol'>
                    <div class='prdtadedtsts'></div>
                    <div class='prdtsdsplngwall'>
                    </div>
                    <div class='prdtspgldrmsgdvbx'></div>
                </div>
            </div>
            </div>
            <input type='hidden' id='hdniptptignm'>
            <input type='hidden' id='ustzhnipt' value='";
            if(isset($_COOKIE['_utg_'])){$strpds.=$_COOKIE['_utg_'];}else{$strpds.=$this->enc("Asia/kolkata",$this->strec,'mtr');}
            $strpds.="'>
            <input type='hidden' id='hnpdtprvsig'>
            <input type='hidden' id='hdnpdvlitbx'>
            <input type='hidden' id='hnitsidval' value='".$this->enc($strdls['stnmr'],$this->strec,'strix')."'>
            ".$this->pdtadedtppup($strdls,$rol)."
            <div id='snackbar'></div>
            <div class='popupbackground strwchvdoytb' style='z-index:300'>
            <div class='popupcontainerbox strwchvdoytb'>
                <div class='popupheaderbox'>
                    <h2 class='popupheadertitle' style='marign:2px;'>Watch Video</h2>
                    <button type='button' class='hidepopupbtn stpvdocncl'>X</button>
                </div>
                <div class='popupcontentcontainerbox'></div>
            </div>
            </div>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js'></script>
            <script src='http://localhost/remindo/js/comfle.js'></script>
            <script src='http://localhost/remindo/js/cmnlbx.js'></script>
            <script src='http://localhost/remindo/stores/prdtseses.js'></script>
            <script src='http://localhost/remindo/js/htoc.js'></script>
            <script src='http://localhost/remindo/js/cmdtr.js'></script>
            <div class='dvsrpts'></div>
        </div>";
        return $strpds;
    }
    protected function pdtadedtppup($strdls,$rol){
        $pdtdsply="<div class='cmn-lbx-bckgrond-cntngdvbx'>
        <div class='cmn-lbx-pdt-dsplyr-cntngdvbx'>
            <div class='lbx-dsplyr-tphdr-ctngdvbx'>
                <div class='lbx-dsplr-bckbtn-dvbx'><i class='fas fa-chevron-left remindosymbols'></i>Back</div>
                <div class='lbx-dsplr-nxpvbtns-dvbx'>
                    <div class='lbxblftsbns lbx-dsplr-pewpdt-vwbtn'><i class='fas fa-chevron-left remindosymbols'></i>prev</div>
                    <div class='lbxblftsbns lbx-dsplr-nxtpdt-vwbtn'>next<i class='fas fa-chevron-right remindosymbols'></i></div>
                </div>
            </div>
            <div class='lbx-dsplyr-bdy-cntngdvbx'>
            <div class='lbx-pcs-and-pdtimdls-cntng-dvbx'>
            <div class='lbx-onypcs-dsply-cntng-dvbx'>
            <div class='lbx-dsplr-igvwrdvbx'>
                <div class='lbx-igsld-shw-dsplr-dbx'>";
                    if($this->dec($strdls['strrctgre'],$this->strec)!="Grocery Store"){$pdtdsply.="<div class='lbx-sldshw-fwbw-bns-dvbx'>
                        <div class='lxslshwchvrnbtn lbx-sldshw-pew-chrvn-btn'><i class='fas fa-chevron-left remindosymbols'></i></div>
                        <div class='lxslshwchvrnbtn lbx-sldshw-nt-chrvn-btn'><i class='fas fa-chevron-right remindosymbols'></i></div>
                    </div>";}
                    $pdtdsply.="<div class='lbx-sld-shw-dsply-dvbx'";
                    if($this->dec($strdls['strrctgre'],$this->strec)=="Grocery Store"){$pdtdsply.="style='margin-top:0;'";}
                    $pdtdsply.=">
                        <div class='lbx-lrgdsplyprvig-tg'></div>
                        <div class='lbx-lrdpy-bkdrpftr-nuldvbx'>Adding...</div>";
                        if($rol!="ebd"){$pdtdsply.="<div class='lbx-pdtpto-udtbns-cntngdbx'>
                            <div class='lbx-pdtlvmdl-pto-txrdvbx' >
                                <div class='lbx-pdtlvmdl-icnsandtxt' ><i class='fas fa-eye'></i><h3 style='margin: 4px;'>Live Model</h3></div>
                                <p>Add a green screen image for live model.</p>
                            </div>
                            <div class='lbxpto-updtbns-mrgns'>
                            <div><label><input type='file' class='lbx-picfle lbx-rmdpdtpc-flipt' style='display:none;'>
                            <div class='blewhtbns lbx-adptobn lbx-ptpto-cmbntocng-pic'><i class='fas fa-camera remindosymbols'></i>Add Photo</div></label></div>
                            <div class='blewhtbns lbx-rmvptobtn lbx-pdto-rmvpic-btn' style='background:lightslategray;margin:auto;'><i class='fas fa-times remindosymbols'></i>Remove</div>
                            </div>
                        </div>";}
                    $pdtdsply.="</div>
                </div>
                <div class='lbx-igpcs-mrgn-dvbx'>
                <div class='lbx-igpcs-rltdtosldshw-dsplr-dbx' data-pigs=''>
                    <div class='lbx-iothpcs-rltosldsh-pxs lbx-pt-pvigs'></div>";
                    if($this->dec($strdls['strrctgre'],$this->strec)!="Grocery Store"){$pdtdsply.="<div class='lbx-iothpcs-rltosldsh-pxs lbx-pt-pvigs'></div>
                    <div class='lbx-iothpcs-rltosldsh-pxs lbx-pt-pvigs'></div>
                    <div class='lbx-iothpcs-rltosldsh-pxs lbx-pt-pvigs'></div>";
                    $pdtdsply.="<div class='lbx-iothpcs-rltosldsh-pxs lbx-pdt-lvpc'>
                        <div class='lbx-pdtlvig-prvwicn'><i class='fas fa-eye remindosymbols lbx-lvmdleysmblicn'></i></div>
                    </div>";}
                $pdtdsply.="</div>
                </div>
            </div>
            </div>
            <div class='lbx-txtims-dls-cntngdvbx'>
            <div class='lbx-pdt-edtbx-mrgn'>
            <div class='lbx-pdstks-lstupdtmstp-dvbx'>
                <div class='lbx-pdsts-updtyp-stks' style='color:green;'>Instock</div>
                <div class='lbx-pdtlst-updt-tmshwn'></div>
            </div>
            </div>";
            if($rol!="ebd"){$pdtdsply.="<div class='lbx-pdt-edtbx-mrgn'>
            <div class='lbx-pdt-edtbx-dsply-bx'>
                <div class='lbx-pdt-stketandothbns-cntngdvbx'>
                    <div class='strprdtedtinstkstsdvbxbtn' role='button'>
                        <span class='intle'>Instock</span>
                        <div class='toggleswitch tglbtn lbx-sktlbn-iptdvbx'>
                        <label class='switch'><input type='checkbox' id='lbx-strpdtstksts' class='lbx-pdt-stkstsupdt' data-pd='' data-sd='' data-ud='fs' checked><span class='slider round'></span></label>
                        </div>
                    </div>
                    <div class='blewhtbns lbx-adpdt-andls-btn'>Add</div>
                    <div class='lbx-pn-shwedls-icnbtn' role='button'><i class='fas fa-pen remindosymbols'></i></div>
                </div>
                <div class='lbx-pdt-edbns-cntng-dvbx'>
                <strong>Edit:</strong>
                <div class='lbx-pdtmr-edtbx-dsplybx'>
                    <div class='pdetbxbtns blewhtbns lbx-pdtls-sve-btn'>Save</div>
                    <div class='pdetbxbtns blewhtbns lbx-pdtls-dscrd-btn'>discard</div>
                </div>
                </div>
            </div>
            </div>";}
            $pdtdsply.="<div class='lbx-pdt-dls-mrgndvbx'>
            <div class='lbx-pdt-dls-dsplr-dvbx' data-ctg='".$this->dec($strdls['strrctgre'],$this->strec)."'>
            <strong>Details:</strong>
                <div><div class='lbx-pdt-nmdsplydvbx lbx-pdt-dnmc-cntetbls' data-phdr='Product name'></div>
                <div class='lbx-ptnme-cotmnrtngdvbx'><span class='lbx-alnmctrs-mnrtd-spn lbx-dvedbl-mntrng-spntgs'></span></div></div>
                <div class='lbx-pdt-szevrnts-dsplycntngdvbx'>
                    <strong class='subsrngfntsz'>";
                    $vrtls=["Variants","Quantity","Sizes"];
                    $vrtlsglr=["Variant","Quantity","Size"];
                    $sctgs=["Electronics","Grocery Store","Clothing & Textile"];
                    if(in_array($this->dec($strdls['strrctgre'],$this->strec),$sctgs)){$pdtdsply.=$vrtls[array_search($this->dec($strdls['strrctgre'],$this->strec),$sctgs)];}else{$pdtdsply.="Variants";}
                    $pdtdsply.="</strong>
                    <div><div class='lbx-pdt-szedsplydvbx'>
                        <div class='lbx-szes-slctn-dsply' data-aszs='' data-aspce='' data-tslds=''></div>
                        <span class='lbx-pdt-adszbtninszedsply-dvbx'><i class='fas fa-plus remindosymbols'></i>Add ";if(in_array($this->dec($strdls['strrctgre'],$this->strec),$sctgs)){$pdtdsply.=$vrtlsglr[array_search($this->dec($strdls['strrctgre'],$this->strec),$sctgs)];}else{$pdtdsply.="Variant";}$pdtdsply.="</span>
                    </div>
                    <div class='lbx-ptszes-cotmnrtngdvbx'><span class='lbx-alszes-mnrtd-spn lbx-dvedbl-mntrng-spntgs'></span></div></div>
                </div>
                <div class='lbx-pdt-ftres-dsplydvbx-edtstoo'>
                    <strong class='subsrngfntsz'>features</strong>
                    <div><div class='lbx-pdt-fchrswrtn-dvbx lbx-pdt-dnmc-cntetbls' data-phdr='Product features'></div></div>
                </div>
            </div>
            </div>
            <div class='lbx-pdt-prcmthme-dvbx-mrgn'>
            <div class='lbx-pdt-prcmchme-dsplybx'>
                <div class='embdsavdolnk' style='padding:6px;'><strong>Embed</strong><input type='text' id='ytblnkipt' placeholder='YouTube video link'><input type='text' id='ytvdostrtatipt' style='width:40px;' value='0:00' placeholder=Starts at'><span class='blewhtbns adebdlnkbn' style='box-shadow:0 0 0;'>Add</span><span class='blewhtbns prewvdobtn' style='box-shadow:0 0 0;margin-left: 9px;color: #787778;background: #f4f3f4;'>Preview Video</span></div>
            </div>
            </div>
            <div class='lbx-pdt-prcmthme-dvbx-mrgn'>
            <div class='lbx-pdt-prcmchme-dsplybx'>
                <div class='lbxpthlfcmncls lbx-pdt-prccntngbx'><strong>Price: </strong><span class='lbx-pdtprce-dsply lbx-pdt-dnmc-cntetbls'>0</span></div>
                <div class='lbxpthlfcmncls lbx-pdt-mtchmebtn mhmebtn' data-m=''>Match me</div>
            </div>
            </div>
            <div class='lbx-pdt-dscrptn-mrgn'>
            <div class='lbx-pdt-dscrptn-dsply-bx'>
                <strong>More about this:</strong>
                <div><div class='lbx-pdtmr-dls-dsplybx lbx-pdt-dnmc-cntetbls' data-phdr='More details about this product.'></div>
                <div class='lbx-mbtns-cotmnrtngdvbx'><span class='lbx-alwdsmbths-mnrtd-spn lbx-dvedbl-mntrng-spntgs'></span></div></div>
            </div>
            </div>
            <div class='lbx-pdt-insgts-mrgn'>
            <div class='lbx-pdt-insghts-dsply-bx'>
                <strong style='text-decoration:underline dashed gray;'>Insights:</strong>
                <div class='lbx-pdtmr-insghtdls-dsplybx'>
                    <div class='insghtscmncls lbx-pdtinsghts-sld-ims'><strong>Sold:</strong> <span class='lbx-pdtisgts-sld-spn'>0</span></div>
                    <div class='insghtscmncls lbx-pdtinsghts-vws-ims'><strong>Views:</strong> <span class='lbx-pdtisgts-viws-spn'>0</span></div>
                    <div class='insghtscmncls lbx-pdtinsghts-sld-ims'><strong>Match me:</strong> <span class='lbx-pdtisgts-mchme-spn'>0</span></div>
                </div>
            </div>
            </div>
            </div>
            </div>
        </div>
        <div class='lbx-main-mchme-cntngdvbx'>
        </div>
        </div>
        </div>";
        return $pdtdsply;
    }
    public function vfyusr($usr){
        $s=$this->strdtls($usr);
        if($s!=0){
            if($this->dec($s['strbsnonr'],$this->iky)==htmlentities($_SESSION['ssndi'])){return "o";}else{
            if($this->vfycmrol($s["stnmr"])!=0){
                $rol=$this->dec($this->vfycmrol($s["stnmr"])['strolofpsn'],$this->iky);
                if($rol=="Product Manager" || $rol=="Admin"){return "o";}elseif($rol=='Embedder'){return 'ebd';}else{return 'c';}
            }
            else{return "c";}
            }
        }else {return 0;}
    }
}
$stds= new strpdts();
function bdyjsn($s){
    echo json_encode(array(
    'title'=> "Products | Remindo",
    'body'=> $s,
));}
if(isset($_POST['s'])){
    $s=htmlspecialchars($_POST['s']);
    if($stds->vfyusr($s)=="o"){$str=$stds->stpdts($stds->strdtls($s),"");bdyjsn($str);}
    elseif($stds->vfyusr($s)=="ebd"){$str=$stds->stpdts($stds->strdtls($s),"ebd");bdyjsn($str);}
    else{echo "<center><h2 style='color:gray;'>This page is no longer available.</h2><br><div class='pgnavblbtn blewhtbns'><i class='fas fa-arrow-left remindosymbols' style='color:white; font-size:14px;'></i>Back to home</div><br></center>";}
}
elseif(isset($_POST['ppsttevt'])){if($_POST['ppsttevt']=="frdppstt"&&isset($_GET['s'])){if($stds->vfyusr($_GET['s'])=="o"){$str=$stds->stpdts($stds->strdtls($_GET['s']),"");bdyjsn($str);}elseif($stds->vfyusr($_GET['s'])=="ebd"){$str=$stds->stpdts($stds->strdtls($_GET['s']),"ebd");bdyjsn($str);}
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
    <title>'; echo 'Products | Remindo</title>';
    include '../commonfiles/commoncss.php';
echo '</head>
<body>
<div class="pageloader" style="display:none;"><div class="remindopageloaderdivbox"></div></div>
<div class="remindomainheaderlptpvsn strpghdrcntnrdvbx"></div>
<div class="remindochildboxycontainer rmdchldbxstrecustmruidvbx">';
if(isset($_GET['s'])){
$s=htmlspecialchars($_GET['s']);
if($s!=""){if($stds->vfyusr($s)=="o"){echo $stds->stpdts($stds->strdtls($s),"");}elseif($stds->vfyusr($s)=="ebd"){echo $stds->stpdts($stds->strdtls($s),"ebd");}
else{echo "<center><h2 style='color:gray;'>This page is no longer available.</h2><br><div class='pgnavblbtn blewhtbns'><i class='fas fa-arrow-left remindosymbols' style='color:white; font-size:14px;'></i>Back to home</div><br></center>";}}
else{echo "<center><h2 style='color:gray;'>This page is no longer available.</h2><br><div class='pgnavblbtn blewhtbns'><i class='fas fa-arrow-left remindosymbols' style='color:white; font-size:14px;'></i>Back to home</div><br></center>";}
}
echo '
</div>
</body>
</html>';
}
?>