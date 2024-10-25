<?php
include 'commonfiles/comuser.php';
class prfle extends usrslfdtls{
public function showusrprofile(){
    $data=json_decode($this->usrs());
    $prticn="";
    $ppg= "
    <div class='remindoprofiletopnavigator'>
    <div class='remindobackbtnuname'>
        <div class='remindoprofilebacknavigationbtn'>
        <i class='fas fa-arrow-left remindoprofilebackbtn'></i>
        </div><div class='remindoprofileusernamebox' style='overflow:hidden;'>$data->usrnm</div>
    </div>
    <div class='remindoprofilemenunavigationbtn'><i class='fas fa-bars'></i></div>
</div>
<div class='remindoprofileenunavigationbtn'><i class='fas fa-bars'></i></div>
<div class='rmdoprofilepgsidebarbox'>
    <ul class='rmdosidnavul'>
        <li class='rmdosidnavulli settingsli'>
            <i class='fas fa-cog'></i>
            <h3 class='lititle'>Settings</h3>
        </li>";
        if(!isset($_COOKIE['_hpa_'])){
        $ppg.="<li class='rmdosidnavulli istlrmrpmptbx'>
        <div class='istlappmptpfldvbx'>
            <div class='inpflpg'>
                <div class='isalapcntntngdvbx'>
                    <div class='istlimgiconcntng'><img src='http://localhost/remindo/includes/fn_img/alarmclock.png' style='width:25px;height:25px;border-radius:50%;' alt='Remindo'></div>
                    <div class='iapcntxtxdvbx'>Install as app!</div>
                </div>
            </div>
            <div class='istalrmoapbtn' role='button'>Install</div>
        </div>
        </li>";}
    $ppg.="</ul>
</div>
<div class='remindoprofiledtailscontainerbox'>
<div class='remindopfnm'>
    <div class='profileandstatus'>
    <h1 class='profilepgnameremindo'>Profile</h1>
    <div class='usrisprvtsyminrmdo'>$prticn</div>
    </div>
    <div class='editprofilebtncontainer'>
    <button type='button' class='editremindouserprofilebtn' call_type='editProfile'><i class='fas fa-pen editprofilebtn'></i></button>
    </div>
</div>
<div class='remindorowsmallbiocontainerbox'>
    <div class='remindoprofilepicinprofilecontainer'>
    <input type='hidden' id='hdipttostrprigsc' value='pflmgs/".$data->urprfig."'>
        <div class='rmdprfpicimgcontainerdivbox'>";
        if($data->urprfig!=""&&file_exists("pflmgs/".$data->urprfig)){$ppg.="<img src='pflmgs/".$data->urprfig."' class='remindologineduserprofilepic rdprnpfig'>";}
        $ppg.="</div>
        <div class='remindouserprofilepicchangeingbtnbox rmdcgprfpicinprfgp' role='button'><i class='fas fa-camera remindouserprofilepicchangebtn'></i></div>
    </div>
    <div class='remindoprofiledetailsbox'>
        <div class='remindousrfulnamcontainer'>
            <h4 class='remindousrfulnameh4tag'>".$data->usrflnm."</h4>
        </div>
        <div class='remindouserfullusername'>
            <i class='fas fa-at remindoatsymbol'></i><h5 class='remindousername'>".$data->usrnm."</h5>
        </div>
        <div class='remindouserenvlopemaildetails'>
            <i class='fas fa-envelope remindoenvmailsymbol'></i><h5 class='remindousermailid twotxtelpss' style='
            word-break: break-all;'>$data->mal</h5>
        </div>
    </div>
</div>
<div class='rowremindoprofiledetailscontainer'>
<div class='remindouserconflgdetails rmdusrlcotcontainerdivbox'>
    <i class='fas fa-map-marker-alt usrprfcoticon remindosymbols'></i><h5 class='remindousernewdt usrconr onetxtelpss' style='font-size:16px;'>$data->usrmlc</h5>
</div>
<div class='remindouserconflgdetails'>
    <i class='fas fa-thumbtack remindosymbols remindothumbbackpinsymbol'></i><h5 class='remindousernewdt'>$data->uspnsts Stores pinned</h5>
</div>
<div class='remindouserconflgdetails'>
    <span class='rmdusrgenlogbox'></span>
    <h5 class='remindousernewdt usrpfgen'>$data->gndr</h5>
</div>
<div class='remindouserconflgdetails'>
    <i class='fas fa-calendar-day remindosymbols'></i><h5 class='remindousernewdt usrdtbrh'>".date_format(date_create($data->usrdbth),"d M Y")."</h5>
</div>
</div>
</div>
<div class='popupbackground chngprflppup'>
<div class='popupcontainerbox chngprflppup'>
    <div class='popupheaderbox'>
        <h2 class='popupheadertitle'>Profile Pic</h2>
        <button type='button' class='hidepopupbtn'>X</button>
    </div>
    <div class='popupcontentcontainerbox'>
        <center>
        <div class='rmvrmdprflpicbtndvbx' role='button' style='cursor:pointer;color:red;'>Remove</div><hr>
        <div class='chngnwrmdoprflpicdvbx' role='button' style='cursor:pointer;color: #1967d2;'><label>Change<input type='file' id='rmdprpicchngipt' class='rmdprpicchngiptinprfpg'>
        </label></div>
        </center>
    </div>
</div>
</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js'></script>
<script src='http://localhost/remindo/js/comfle.js'></script>
<script src='http://localhost/remindo/js/srg.js'></script>
<script src='http://localhost/remindo/profilepgs/js/poflee.js'></script>";
return $ppg;
}
}
$prfle=new prfle();
function bdyjsn($prf){
    echo json_encode(array(
    'title'=> "Profile | Remindo",
    'body'=> $prf->showusrprofile(),
));}
if(isset($_GET['nvprfpg'])){
    bdyjsn($prfle);
}
elseif(isset($_POST['ppsttevt'])){if($_POST['ppsttevt']=="frdppstt"){bdyjsn($prfle);}}
else{
if(!isset($_SESSION['usrml'])){
    header('Location: signin');
}
echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Profile | Remindo</title>";
    include 'commonfiles/commoncss.php';
    echo "</head>
<body>
<div class='pageloader' style='display:none;'><div class='remindopageloaderdivbox'></div></div>
<div class='rmdohmpghdr remindomainheaderlptpvsn'></div>
<div class='remindochildboxycontainer'>";
echo $prfle->showusrprofile();
echo "</div>
</body>
</html>";
 }
 ?>