<?php
include 'db_conn.php';
session_start();
class hompgcnts extends dbconnect{
public function homebdcont(){
    $hpg="<div class='rmdohomepagediv'>
    <div class='rmdohmpghdr'></div>
    <div class='rmdohmpgcntrdvbx'>
        <div class='rmdohmpgitrctivdvbx' style='display:none;'>
            <div class='rmoditrctivdvbxwelcmcm'><h2 class='wlcm_pg_ttl'>WELECOME TO REMINDO</h2></div>
            <div class='itrctiv_pg_bdy'>
            <div class='str_grw_bsn_dvbx'>
            <div class='rmoditrctivdvbximgctng' style='margin:20px;'>
                <img src='includes/fn_img/gry_sr_hpg.jpg' style='border: 4px solid white;width: 272px;'>
            </div>
            <div class='rmoditrctivdvbxtxtctng' style='color:gray;'>Pin stores near you, get updates from the stores you pin, and buy your desired things from the store you know! Click on the <i class='fas fa-store storBtnSgnIcn'></i> button to find and pin stores near you!</div>
            </div>
            </div>
        </div>
        <div class='rmdstnwadpplcntrdvbx'>
            <div class='rmdomcntpndppldvbx' style='display:flex;'></div>
        </div>
        <div class='rmdormdrhlefeeddvbx'>
        <div class='strdshbrddvbx'></div>
        <section class='rmontfcnsdvbxctnbx'>
        <div class='sctnttlecntngdvb sctnlstupdsttledvbx'></div>
        <div class='sctnlstupdtsbdydvbx'></div>
        </section>
        </div>
    </div>";
    if(!isset($_COOKIE['_hpa_'])){
    $hpg.="<div class='istlapprmptppupdvbx'>
        <div class='isalappcntdvbx'>
            <div class='isalapcntntngdvbx'>
                <div class='istlimgiconcntng'><img src='http://localhost/remindo/includes/fn_img/alarmclock.png' style='width:25px;height:25px;border-radius:50%;' alt='Remindo'></div>
                <div class='iapcntxtxdvbx'>Install as app!</div>
            </div>
            <div class='istlhdppupdvbx'>x</div>
        </div>
        <div class='istalrmoapbtn' role='button'>Install</div>
    </div>";}
    $hpg.="
    <div class='popupbackground shrrmdocnt'>
    <div class='popupcontainerbox shrrmdocnt'>
        <div class='popupheaderbox'>
            <h2 class='popupheadertitle'>Share On</h2>
            <button type='button' class='hidepopupbtn'>X</button>
        </div>
        <div class='popupcontentcontainerbox'>
            <div class='alshrbnsavblonrmdo shrbns-cplylnk'>Copy Link</div>
            <div class='alshropnsavlonrmodsplydvbx'>
                <div class='sclshrbns fbshr'><a href='https://facebook.com/sharer.php?u=https://remindo.in' target='_blank' class='sclshrlnktg fbshratg'><i class='fab fa-facebook' style='color:#1c6a90;'></a></i></div>
                <div class='sclshrbns whtsapshr'><a  href='https://api.whatsapp.com/send?phone=&text=".urlencode("Remindo")."https://remindo.in' target='_blank' class='sclshrlnktg whtsapshratg'><i class='fab fa-whatsapp' style='color:#086508;'></a></i></div>
                <div class='sclshrbns twtrshr'><a href='https://twitter.com/share?text=text&url=https://remidno.in' target='_blank' class='sclshrlnktg twtrshratg'><i class='fab fa-twitter' style='color:#2d91ba;'></a></i></div>
                <div class='sclshrbns pntrstshr'><a href='https://pinterest.com/pin/create/button/?url=https://remindo.in/includes/fn_img/alarmclock.png' target='_blank' class='sclshrlnktg pntrstshratg'><i class='fab fa-pinterest' style='color:darkred;'></a></i></div>
            </div>
        </div>
    </div>
    </div>
    <div class='popupbackground strwchvdoytb' style='z-index:300'>
    <div class='popupcontainerbox strwchvdoytb'>
        <div class='popupheaderbox'>
            <h2 class='popupheadertitle' style='marign:2px;'>Watch Video</h2>
            <button type='button' class='hidepopupbtn stpvdocncl'>X</button>
        </div>
        <div class='popupcontentcontainerbox'></div>
    </div>
    </div>
    ".$this->prdtlrgdsply()."
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js'></script>
    <script src='http://localhost/remindo/js/cobnfns.js'></script>
    <script src='http://localhost/remindo/js/cmnlbxs.js'></script>
    <script src='http://localhost/remindo/js/hmes.js'></script>
    <script src='http://localhost/remindo/js/srg.js'></script>
    </div>";
    $nlgnd="
        <div>
            <center>
                <div><img src='http://localhost/remindo/includes/fn_img/login-3305943-2757111.png' style='
                width: 80%;max-width: 392px;'></div>
                <div style='color:gray'>Login for more</div>
                <a href='http://localhost/remindo/signin' style=''><div style='width: 100px;padding: 6px;border: 1px solid;background: darkslategray;color: white;border-radius: 6px;box-shadow: inset 0 0 19px -11px white;margin: 10px;'>Login</div></a>
        </center>
        </div>
    ";
    return (isset($_SESSION['ssndi']))?$hpg:$nlgnd;
}
protected function prdtlrgdsply(){
    $pdtdsply="<div class='cmn-lbx-bckgrond-cntngdvbx'>
    <div class='cmn-lbx-pdt-dsplyr-cntngdvbx'>
        <div class='lbx-dsplyr-tphdr-ctngdvbx' data-adpdck data-pd>
            <div class='lbx-dsplr-bckbtn-dvbx'><i class='fas fa-chevron-left remindosymbols'></i>Back</div>
            <div class='lbx-dsplr-nxpvbtns-dvbx'>
                <div class='lbxblftsbns lbx-dsplr-pewpdt-vwbtn'><i class='fas fa-chevron-left remindosymbols'></i>prev</div>
                <div class='lbxblftsbns lbx-dsplr-nxtpdt-vwbtn'>next<i class='fas fa-chevron-right remindosymbols'></i></div>
            </div>
        </div>
        <div class='lbx-cmsrsr-dlsdvbx-mrgnr'>
            <div class='lbx-csmrorstr-dtls-dsply-cntngdvbx'>
                <div class='lbx-cmsrsr-pflpc-dsply'></div>
                <div class='lbx-cmrsr-pfldls'>
                    <strong><div class='lbx-srctgredsply'></div></strong>
                    <div class='srcmrtxtdls'></div>
                    <div class='lbx-srcmr-pfunm'></div>
                </div>
            </div>
        </div>
        <div class='lbx-dsplyr-bdy-cntngdvbx'>
        <div class='lbx-pcs-and-pdtimdls-cntng-dvbx'>
        <div class='lbx-onypcs-dsply-cntng-dvbx'>
        <div class='lbx-dsplr-igvwrdvbx'>
            <div class='lbx-igsld-shw-dsplr-dbx'>
                <div class='lbx-sldshw-fwbw-bns-dvbx'>
                    <div class='lxslshwchvrnbtn lbx-sldshw-pew-chrvn-btn'><i class='fas fa-chevron-left remindosymbols'></i></div>
                    <div class='lxslshwchvrnbtn lbx-sldshw-nt-chrvn-btn'><i class='fas fa-chevron-right remindosymbols'></i></div>
                </div>
                <div class='lbx-sld-shw-dsply-dvbx'>
                    <div class='lbx-lrgdsplyprvig-tg'></div>
                </div>
            </div>
            <div class='lbx-igpcs-mrgn-dvbx'>
            <div class='lbx-igpcs-rltdtosldshw-dsplr-dbx' data-pigs=''>
                <div class='lbx-iothpcs-rltosldsh-pxs lbx-pt-pvigs'></div>
                <div class='lbx-iothpcs-rltosldsh-pxs lbx-pt-pvigs'></div>
                <div class='lbx-iothpcs-rltosldsh-pxs lbx-pt-pvigs'></div>
                <div class='lbx-iothpcs-rltosldsh-pxs lbx-pt-pvigs'></div>
            </div>
            </div>
        </div>
        </div>
        <div class='lbx-txtims-dls-cntngdvbx'>
        <div class='lbx-pdt-edtbx-mrgn'>
        <div class='lbx-pdstks-lstupdtmstp-dvbx'>
            <div class='lbx-pdsts-updtyp-stks' style='color:green;'>Instock</div>
            <div class='lbx-pdtlst-updt-tmshwn'></div>
        </div>
        </div>
        <div class='lbx-pdt-dls-mrgndvbx'>
        <div class='lbx-pdt-dls-dsplr-dvbx'>
        <strong>Details:</strong>
            <div><div class='lbx-pdt-nmdsplydvbx' data-phdr='Product name'>banars pure cotton pattu saree</div>
            <div class='lbx-ptnme-cotmnrtngdvbx'><span class='lbx-alnmctrs-mnrtd-spn '></span></div></div>
            <div class='lbx-pdt-szevrnts-dsplycntngdvbx'>
                <strong class='subsrngfntsz'>Variants</strong>
                <div><div class='lbx-pdt-szedsplydvbx'>
                    <div class='lbx-szes-slctn-dsply' data-aszs='' data-aspce='' data-tslds=''></div>
                </div>
                <div class='lbx-ptszes-cotmnrtngdvbx'><span class='lbx-alszes-mnrtd-spn '></span></div></div>
            </div>
            <div class='lbx-pdt-ftres-dsplydvbx-edtstoo'>
                <strong class='subsrngfntsz'>features</strong>
                <div><div class='lbx-pdt-fchrswrtn-dvbx' data-phdr='Product features'></div></div>
            </div>
        </div>
        </div>
        <div class='lbx-pdt-prcmthme-dvbx-mrgn'>
        <div class='lbx-pdt-prcmchme-dsplybx'>
            <div class='lbxpthlfcmncls lbx-pdt-prccntngbx'><strong>Price: </strong><span class='lbx-pdtprce-dsply'></span>₹</div>
            <div class='lbxpthlfcmncls lbx-pdt-mtchmebtn'>Match me</div>
        </div>
        </div>
        <div class='lbx-pdt-prcmthme-dvbx-mrgn wchvdobnctngdvbx'>
        <div class='lbx-pdt-prcmchme-dsplybx wchvdobnctngdvbx'>
            <div class='wchebdytvdo' data-vul='' style='padding: 6px;border: 1px solid #e4e4e4;box-shadow: 0 0 12px -7px #6b5b5b;border-radius: 4px;cursor:pointer;'><strong>Watch video</strong></div>
        </div>
        </div>
        <div class='lbx-pdt-adrmqty-mrgn'>
        <div class='lbx-pdt-adqty-dsply-bx'>
            <div class='lbxpthlfcmncls pdtadtolstbtn lbx-pdtshr-btn shrpstbn'><i class='fas fa-share remindosymbols' style='font-weight:500;' data-ttl='Remindo.in' data-txt='' data-pic='' data-url='https://remindo.in'></i>Share</div>
            <div class='lbxpthlfcmncls pdtadtolstbtn lbx-adto-lst-btn'>Add</div>
        </div>
        </div>
        <div class='lbx-pdt-dscrptn-mrgn'>
        <div class='lbx-pdt-dscrptn-dsply-bx'>
        <strong>More about this:</strong>
        <div><div class='lbx-pdtmr-dls-dsplybx' data-phdr='More details about this product.'></div>
        <div class='lbx-mbtns-cotmnrtngdvbx'><span class='lbx-alwdsmbths-mnrtd-spn lbx-dvedbl-mntrng-spntgs'></span></div></div>
        </div>
        </div>
        </div>
        </div>
        </div>
        <div class='lbx-rltd-pdts-dsply-cntngbx'>
            <div class='lbx-rltd-pdts-hdng'></div>
            <div class='lbx-rltd-pdts-bdy'>
            <div class='lbx-rld-rltdpds-dvbx str-alpdts-dspl-dvbx prdtsdsplngwall'>
            </div>
            </div>
        </div>
        </div>
        </div>
        </div>
    </div>
    </div>
    </div>";
    return $pdtdsply;
}
public function dc($txt){return $this->dec($txt,$this->iky);}
}
$hmpg=new hompgcnts();
function bdyjsn($hmpg){
    echo json_encode(array(
    'title'=> "Remindo",
    'body'=> $hmpg->homebdcont(),
));}
if(isset($_GET['shmpgrm'])){
if($_GET['shmpgrm']=="yshm"){
    bdyjsn($hmpg);
}
}
elseif(isset($_POST['ppsttevt'])){if($_POST['ppsttevt']=="frdppstt"){bdyjsn($hmpg);}}
else{
if(!isset($_SESSION['ssndi'])&&!isset($_SESSION['usrml'])){
if((isset($_COOKIE['_ugdae'])&&isset($_COOKIE['_urdi_']))){
$ugdae=htmlentities(htmlspecialchars($_COOKIE['_ugdae']));
$urdi=htmlentities(htmlspecialchars($_COOKIE['_urdi_']));
$_SESSION['ssndi']=$hmpg->dc($urdi);
$_SESSION['usrml']=$hmpg->dc($ugdae);
}else{
header("Location: stores.php");
}
}
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remindo</title>';
    include 'commonfiles/commoncss.php';
echo '</head>
<body>
<div class="pageloader" style="display:none;"><div class="remindopageloaderdivbox"></div></div>
<div class="remindomainheaderlptpvsn"></div>
<div class="remindochildboxycontainer">';
echo $hmpg->homebdcont();
echo '
</div>
</body>
</html>';
}
?>