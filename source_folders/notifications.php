<?php
include 'db_conn.php';
session_start();
class hompgcnts extends dbconnect{
private function updtnfstosn(){
    $conn=$this->connect();
    $usr=$this->enc(htmlentities(mysqli_real_escape_string($conn,$_SESSION['ssndi'])),$this->iky,'idx');$nosn=$this->enc(0,$this->strec,'strix');$nfsn=$this->enc(1,$this->strec,'strix');
    $sql="UPDATE alntfcns SET ntfysen='$nfsn' WHERE rcvr='$usr' AND ntfysen='$nosn';";
    $query=$conn->query($sql);
}
public function ntfspg($nfs){
    if($nfs>0){$this->updtnfstosn();}elseif($nfs=="nfs"){$this->updtnfstosn();}
    $hpg="<div class='rmdohomepagediv'>
    <div class='rmdohmpghdr'></div>
    <div class='rmdohmpgcntrdvbx'>
        <div class='rmdntfcns-hdr-cntngdvbx'>
            <div class='rmdntfcns-hdrttl'>
                <h2>Notifications</h2>
                <div class='ntfcnsshwmroptnsbtn'><i class='fas fa-sliders-h remindosymbols'></i></div>
            </div>
        </div>
        <div class='rmdusr-ntfcns-drucooptns-ddvbx'>
            <div class='ntf-opnscntngdvbx'>
            <div class='tnfcs-alctedcntngdvbx'><span class='ttlntfcnsslctd'>0</span><span>Selected</span></div>
            <div class='ntfcnsactnbnsonly'><span class='mroptns-mrkrd'><i class='fas fa-check-circle remindosymbols'></i></span>
            <span class='mroptns-delntfs'><i class='fas fa-trash remindosymbols'></i></span>
            <span class='mroptns-clsebtn'><i class='fas fa-times remindosymbols'></i></span></div>
            </div>
        </div>
        <div class='rmdntfcns-bdy-cntngdvbx'>
            <div class='rmdalntfcns-dsply-dvbx'></div>
        </div>
    </div>
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js'></script>
    <script src='http://localhost/remindo/js/cobnfns.js'></script>
    <script src='http://localhost/remindo/js/comfle.js'></script>
    <script src='http://localhost/remindo/js/nfcns.js'></script>
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
        <script src='http://localhost/remindo/js/comfle.js'></script>
    ";
    return (isset($_SESSION['ssndi']))?$hpg:$nlgnd;
}
}
$hmpg=new hompgcnts();
function bdyjsn($hmpg,$tns){
    echo json_encode(array(
    'title'=> "Notifications | Remindo",
    'body'=> $hmpg->ntfspg($tns),
));}
if(isset($_GET['nfpg'])&&isset($_GET['tns'])){
if($_GET['nfpg']=="ysnfcs"){
    bdyjsn($hmpg,htmlentities($_GET['tns']));
}
}
elseif(isset($_POST['ppsttevt'])){if($_POST['ppsttevt']=="frdppstt"){bdyjsn($hmpg,0);}}
else{
if(!isset($_SESSION['usrml'])){ if((isset($_COOKIE['_ugdae'])&&isset($_COOKIE['_urdi_']))||(isset($_SESSION['ssndi'])&&isset($_SESSION['usrml']))){
    $ugdae=htmlentities(htmlspecialchars($_COOKIE['_ugdae']));
    $urdi=htmlentities(htmlspecialchars($_COOKIE['_urdi_']));
    session_start();
    $_SESSION['ssndi']=$prsclss->dc($urdi);
    $_SESSION['usrml']=$prsclss->dc($ugdae);
    }else{
        header("Location: signin");
    }
}
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications | Remindo</title>';
    include 'commonfiles/commoncss.php';
echo '</head>
<body>
<div class="pageloader" style="display:none;"><div class="remindopageloaderdivbox"></div></div>
<div class="remindomainheaderlptpvsn"></div>
<div class="remindochildboxycontainer">';
echo $hmpg->ntfspg("nfs");
echo '
</div>
</body>
</html>';
}
?>