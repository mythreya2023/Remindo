<?php
include 'db_conn.php';
session_start();
class shrdpsts extends dbconnect{
private function fthpst($sop,$s,$p){
    $conn=$this->connect();
    if($sop=="p"){$pid=$this->sbldc(htmlentities(mysqli_real_escape_string($conn,$p)),$this->strec);$strid=$this->enc($this->sbldc(htmlentities(mysqli_real_escape_string($conn,$s)),$this->strec),$this->strec,'strix');$sql="SELECT strnmr,strspdtnum,prdtnm,prdtpto,prdtstrtmtp,IF (prdtqnty='Ojo','',prdtqnty) AS prdtqnty,pdtqlty,prdtprc,pdtsts,pdtmrdlsdsrpn,pdtfhrs,pdtlvmdlig,pdtlstupdt,pdtlrgvws FROM prdcsinstr WHERE strnmr='$strid' AND strspdtnum='$pid' LIMIT 1 ;";}
    elseif($sop=="s"){$strid=$this->sbldc(htmlentities(mysqli_real_escape_string($conn,$s)),$this->strec);$sql="SELECT stnmr,strrctgre,strnm,stratmnt,strbprflig FROM stsinmtplc WHERE stnmr='$strid' LIMIT 1 ;";}
    $query=$conn->query($sql);
    if($query){if($query->num_rows>0){
        return $row=$query->fetch_assoc();
    }else{return 0;}}else{return 'q0';}
}
public function shrdcntnt($tp,$s,$p){
    $pdt=$this->fthpst("p",$s,$p);
    if($pdt!=0&&$pdt!="q0"){
        $pto=$this->dec($pdt["prdtpto"],$this->strec);
        $lvpig=$this->dec($pdt["pdtlvmdlig"],$this->strec);
        $pdtnm=$this->sbldc($pdt["prdtnm"],$this->strec);
        $vrnts=$this->sbldc($pdt["prdtqnty"],$this->strec);
        $pdcpn=$this->dec($pdt["pdtmrdlsdsrpn"],$this->strec);
        $pdfrs=($pdt["pdtfhrs"]!="Ojo")?$this->sbldc($pdt["pdtfhrs"],$this->strec):"";
        $pdtsks=$this->dec($pdt["pdtsts"],$this->strec);
        $prc=$this->sbldc($pdt["prdtprc"],$this->strec);
        $pdvws=$pdt["pdtlrgvws"];
        $plsupt=$this->dec($pdt["pdtlstupdt"],$this->strec);
        $puptm=$this->dec($pdt["prdtstrtmtp"],$this->iky);
        $ptos=explode("/,",$pto);
        $str=$this->fthpst("s",$s,$p);
        $strnm=$this->sbldc($str['strnm'],$this->strec);
        $strunm=$this->sbldc($str['stratmnt'],$this->strec);
        $strpfig=$this->dec($str['strbprflig'],$this->strec);
        $strctgre=$this->dec($str['strrctgre'],$this->strec);
    }
    $hpg="<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta property='og:url' content='http://localhost/remindo/shared?tp=pt&s='".htmlentities($s)."'&p='".htmlentities($p)."' />";
        if($pdt!=0&&$pdt!="q0"){$hpg.="<meta property='og:title' content='$strnm | Remindo.in' />
        <meta property='og:description' content='$pdtnm' />
        <meta property='og:image' content='strpdtspcs/$ptos[0]' />";}
        $hpg.="<title>Shared | Remindo</title>";
    $hpg.=include "commonfiles/commoncss.php";
    $hpg.='
    </head>
    <body>
    <div class="pageloader" style="display:none;"><div class="remindopageloaderdivbox"></div></div><style>
    .docs-lgn-bn-dvbx {
        padding: 7px;
        background: #f5a84a;
        border-radius: 32px;
        margin: 12px 3px;
        color: white;
        font-weight: 600;
    }
    </style>';
    if(!isset($_SESSION['usrml'])){
    $hpg.="<div class='remindomainheader'>
    <nav class='remindo-mobile-header-nav'>
    <div class='remindo-title-box-mobile'>
        <a href='/' class='remnidoataghomelink'>
        <div id='remindo-icon'>
            <div class='rmdicn'>
                <div class='remindo-icon-box'>
                    <div class='cover-clock'></div>
                    <div class='remindo-clock-icon'>
                        <div class='clock-ear1'></div>
                        <div class='clock-ear2'></div>
                        <div class='clock-icon'>
                            <div class='clock-icon-min'></div>
                            <div class='clock-icon-hour'></div>
                        </div>
                    </div>
                </div>
            </div>
            <h3 class='remindo-title'>REMINDO</h3>
        </div></a>
        <div class='remindobtns'>
        <div class='oth-lgo-cntngdvbx' style='display:flex;justify-content:space-around;align-items=center;'>
        <a href='http://localhost/remindo/signin' class='docs-login-a-tg'><div class='docs-lgn-bn-dvbx'>Login</div></a>
        <a href='http://localhost/remindo/signin?s=signup' class='docs-login-a-tg'><div class='docs-lgn-bn-dvbx'>Signup</div></a>
        </div>
        </div>
        </div>
    </div>
    </nav>
    </div>";
    }else{$hpg.='<div class="remindomainheaderlptpvsn"></div>';}
    $hpg.="
    <div class='remindochildboxycontainer'>
    <div class='rmdohomepagediv'>
    <div class='rmdohmpghdr'></div>
    <div class='rmdohmpgcntrdvbx'>
        <div class='rmdormdrhlefeeddvbx'>";
        if($pdt!=0&&$pdt!="q0"){
            // $hpg.="<div class='nonsrprdtlbxopn prdtditmnmcntnrdvbx' style='display:block;' data-tle='$pdtnm' data-pce='$prc' data-szs='$vrnts' data-pfcrs='$pdfrs' data-dcptn='$pdcpn' data-rpigs='$pto' data-lmig='../srptlvmdlpcs/$lvpig'  data-sid='".$this->enc($this->dec($pdt['strnmr'],$this->strec),$this->strec,'mtr')."' data-pid='".$this->sblen($pdt['strspdtnum'],$this->strec,'strix')."'data-istk='".(($pdtsks=="1")?"In stock":"Out of stock")."' data-luptd='".$this->timefrendly($plsupt,$puptm)."'></div>";
        // if($tp=="pt"){
        $hpg.="<div class='rmdo-srptaspst-cntngdvbxorgnl'>
            <div class='rmo-srpdtcntngdvbx-mn'>
                <div class='srpdtaspsthdr-ctngdvbx'>
                    <div class='strpstfrmdlspcs-cntgdvbx tketothstr' data-unm='$strunm'>
                        <div class='pdtaspststrdspligdvbx'>";
                            if(file_exists("fhupuppts/$strpfig")&&$strpfig!=""){$hpg.="<img src='fhupuppts/$strpfig' class='pdtsrdpflig'>";}
                        $hpg.="</div>
                        <div class='pdtaspststrdpnmdlsdvbx'>
                            <div class='pfdlsnms'>$strnm</div>
                            <div class='pfdlsbnm'>@$strunm <span style='color:gray;font-weight:500;font-size:11px;'>.".$this->timefrendly($plsupt,$puptm)."</span></div>
                        </div>
                    </div>
                </div>
                <div class='nonsrprdtlbxopn prdtditmnmcntnrdvbx' style='display:block;' data-tle='$pdtnm' data-pce='$prc' data-szs='$vrnts' data-pfcrs='$pdfrs' data-dcptn='$pdcpn' data-rpigs='$pto' data-lmig='../srptlvmdlpcs/$lvpig' data-pid='".$this->enc($pdt['strspdtnum'],$this->strec,'strix')."' data-istk='".(($pdtsks=="1")?"In stock":"Out of stock")."' data-luptd='".$this->timefrendly($plsupt,$puptm)."' data-srcgr='$strctgre' data-srnm='$strnm' data-srunm='@$strunm' data-srpc='";
                if(file_exists("fhupuppts/$strpfig")&&$strpfig!=""){$hpg.="fhupuppts/$strpfig";}
            $hpg.= "'>
                <div class='pdtaspst-cntdsplydvbx'>
                    <div class='srpdtpsttxcntcntngdvbx'><span class='bksnts'>$strnm added new product!</span><span class='bksnts'>$pdtnm</span></div>
                    <div class='pstigovdcntngdvbx'>
                        <div class='vdorigclsfr'>
                            <img src='strpdtspcs/$ptos[0]' class='pdtpstig'>
                        </div>
                    </div>
                    <div class='srpdtpsttxcntcntngdvbx'><span class='bksnts'>$pdcpn</span></div>
                </div>
                </div>
                <div class='pdtdvbx-ftrdsplydvbxw'>
                    <div class='ftrlfthlf'>
                        <div class='pstvwsdsplydvbx hstpt' data-tooltip='Views'><span><i class='fas fa-eye remindosymbols'></i></span><span>$pdvws</span></div>";
                        if($strctgre!="Grocery Store"){if($lvpig!=""&&file_exists("srptlvmdlpcs/$lvpig")){$hpg.="<div class='blewhtbns pstmtchmebn mhmebtn coumhebn' data-sid='".$this->enc($this->dec($pdt['strnmr'],$this->strec),$this->strec,'mtr')."' data-pid='".$this->sblen($pdt['strspdtnum'],$this->strec,'strix')."' data-m='srptlvmdlpcs/$lvpig'>Match me</div>";}}
                    $hpg.="</div>
                    <div class='ftrrghthlf'>
                        <div class='shrpstbn' data-ttl='$strnm | Remindo.in' data-txt='$pdtnm' data-pic='http://localhost/remindo/strpdtspcs/$ptos[0]' data-url='http://localhost/remindo/shared?tp=pt&s=".htmlentities($s)."&p=".htmlentities($p)."'><i class='fas fa-share remindosymbols'></i> Share</div>
                    </div>
                </div>
            </div>
        </div>";
        // }elseif($tp=="prdt"){
            // $isstr=true;
            $hpg.="<div class='cmn-lbx-bckgrond-cntngdvbx' style='display:block;'>
            <div class='cmn-lbx-pdt-dsplyr-cntngdvbx' style='display:block;'>
                <div class='lbx-dsplyr-tphdr-ctngdvbx'>
                    <div class='lbx-dsplr-bckbtn-dvbx'><i class='fas fa-chevron-left remindosymbols'></i>Back</div>
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
                    <div class='lbx-igsld-shw-dsplr-dbx'>";
                        if($strctgre!="Grocery Store"){$hpg.="<div class='lbx-sldshw-fwbw-bns-dvbx'>
                            <div class='lxslshwchvrnbtn lbx-sldshw-pew-chrvn-btn'><i class='fas fa-chevron-left remindosymbols'></i></div>
                            <div class='lxslshwchvrnbtn lbx-sldshw-nt-chrvn-btn'><i class='fas fa-chevron-right remindosymbols'></i></div>
                        </div>";}
                        $hpg.="<div class='lbx-sld-shw-dsply-dvbx'";
                        if($strctgre=="Grocery Store"){$hpg.="style='margin-top:0;'";}
                        $hpg.=">
                            <div class='lbx-lrgdsplyprvig-tg'></div>
                        </div>
                    </div>
                    <div class='lbx-igpcs-mrgn-dvbx'>
                    <div class='lbx-igpcs-rltdtosldshw-dsplr-dbx' data-pigs=''>
                        <div class='lbx-iothpcs-rltosldsh-pxs lbx-pt-pvigs'></div>";
                        if($strctgre!="Grocery Store"){$hpg.="<div class='lbx-iothpcs-rltosldsh-pxs lbx-pt-pvigs'></div>
                        <div class='lbx-iothpcs-rltosldsh-pxs lbx-pt-pvigs'></div>
                        <div class='lbx-iothpcs-rltosldsh-pxs lbx-pt-pvigs'></div>";}
                    $hpg.="</div>
                    </div>
                </div>
                </div>
                <div class='lbx-txtims-dls-cntngdvbx'>
                <div class='lbx-pdt-edtbx-mrgn'>
                <div class='lbx-pdstks-lstupdtmstp-dvbx'>
                    <div class='lbx-pdsts-updtyp-stks' style='color:green;'></div>
                    <div class='lbx-pdtlst-updt-tmshwn'>".$this->timefrendly($plsupt,$puptm)."</div>
                </div>
                </div>
                <div class='lbx-pdt-dls-mrgndvbx'>
                <div class='lbx-pdt-dls-dsplr-dvbx'>
                <strong>Details:</strong>
                    <div><div class='lbx-pdt-nmdsplydvbx' data-phdr='Product name'></div>
                    <div class='lbx-ptnme-cotmnrtngdvbx'><span class='lbx-alnmctrs-mnrtd-spn '></span></div></div>
                    <div class='lbx-pdt-szevrnts-dsplycntngdvbx'>
                        <strong class='subsrngfntsz'>";
                        $vrtls=["Variants","Quantity","Sizes"];
                        $sctgs=["Electronics","Grocery Store","Clothing & Textile"];
                        if(in_array($strctgre,$sctgs)){$hpg.=$vrtls[array_search($strctgre,$sctgs)];}else{$hpg.="Variants";}
                        $hpg.="</strong>
                        <div><div class='lbx-pdt-szedsplydvbx'>
                            <div class='lbx-szes-slctn-dsply' data-aszs='' data-aspce='' data-tslds=''>
                            <div class='lbx-pdt-szeaded-spntg'></div>
                            </div>
                        </div>
                        <div class='lbx-ptszes-cotmnrtngdvbx'><span class='lbx-alszes-mnrtd-spn '></span></div></div>
                    </div>
                    <div class='lbx-pdt-ftres-dsplydvbx-edtstoo'>
                        <strong class='subsrngfntsz'>features</strong>
                        <div><div class='lbx-pdt-fchrswrtn-dvbx' data-phdr='Product features'></div></div>
                    </div>
                </div>
                </div>
                <div class='lbx-pdt-prcmthme-dvbx-mrgn wchvdobnctngdvbx'>
                <div class='lbx-pdt-prcmchme-dsplybx wchvdobnctngdvbx'>
                    <div class='wchebdytvdo' data-vul='' style='padding: 6px;border: 1px solid #e4e4e4;box-shadow: 0 0 12px -7px #6b5b5b;border-radius: 4px;cursor:pointer;'><strong>Watch video</strong></div>
                </div>
                </div>
                <div class='lbx-pdt-prcmthme-dvbx-mrgn'>
                <div class='lbx-pdt-prcmchme-dsplybx'>
                    <div class='lbxpthlfcmncls lbx-pdt-prccntngbx'><strong>Price: </strong><span class='lbx-pdtprce-dsply'></span></div>";
                    if($strctgre!="Grocery Store"){if($lvpig!=""&&file_exists("srptlvmdlpcs/$lvpig")){$hpg.="<div class='lbxpthlfcmncls lbx-pdt-mtchmebtn mhmebtn coumhebn' data-sid='".$this->enc($this->dec($pdt['strnmr'],$this->strec),$this->strec,'mtr')."' data-pid='".$this->sblen($pdt['strspdtnum'],$this->strec,'strix')."' data-m='srptlvmdlpcs/$lvpig'>Match me</div>";}}
                $hpg.="
                </div>
                </div>
                <div class='lbx-pdt-adrmqty-mrgn'>
                <div class='lbx-pdt-adqty-dsply-bx'>
                    <div class='lbxpthlfcmncls pdtadtolstbtn lbx-pdtshr-btn shrpstbn' data-ttl='$strnm | Remindo.in' data-txt='$pdtnm' data-pic='http://localhost/remindo/strpdtspcs/$ptos[0]' data-url='http://localhost/remindo/shared?tp=pt&s=".htmlentities($s)."&p=".htmlentities($p)."'><i class='fas fa-share remindosymbols' style='font-weight:500;'></i>Share</div>
                    <div class='lbxpthlfcmncls pdtadtolstbtn lbx-adto-lst-btn tketothstr'  data-unm='$strunm'>Buy</div>
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
            </div>
            <div class='lbx-main-mchme-cntngdvbx'>
            </div>
            </div>
            </div>";
        // }
    }else{
        $hpg.="<div style='margin:10px;'>
            <center><h3 style='color:gray;'><i class='fas fa-exclamation-triangle remindosymbols' style='color:#c4c40e'></i>Sorry, this content is'nt available for now!</h3><br><a href='http://localhost/remindo/'><div class='blewhtbns'><i class='fas fa-arrow-left remindosymbols' style='color:white;font-weight:500px;'></i><span> Back to home</span></div></a></center>
        </div>";
    }
    $hpg.="</div>
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
                <div class='sclshrbns whtsapshr'><a  href='https://api.whatsapp.com/send?phone=&text=".urlencode("HI Hello")."https://remindo.in' target='_blank' class='sclshrlnktg whtsapshratg'><i class='fab fa-whatsapp' style='color:#086508;'></a></i></div>
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
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js'></script>
    <script src='http://localhost/remindo/js/cobnfns.js'></script>
    <script src='http://localhost/remindo/js/shrd.js'></script>
    <script src='http://localhost/remindo/js/cmnlbxs.js'></script>
    </div>
    </div>
    </body>
    </html>";
    return $hpg;
}
}
$hmpg=new shrdpsts();
if(isset($_GET['tp'])&&isset($_GET['s'])&&isset($_GET['p'])){
echo $hmpg->shrdcntnt($_GET['tp'],$_GET['s'],$_GET['p']);
}elseif(isset($_POST['ppsttevt'])){if($_POST['ppsttevt']=="frdppstt"){$hmpg->shrdcntnt($_GET['tp'],$_GET['s'],$_GET['p']);}}

?>