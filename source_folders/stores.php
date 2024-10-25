<?php
include 'commonfiles/comuser.php';
class pplcnts extends usrslfdtls{
private function vrfytnmsrs(){
    $conn=$this->connect();
    $stronr=$this->enc(htmlentities(mysqli_real_escape_string($conn,$_SESSION['ssndi'])),$this->iky,'idx');
    $sql="SELECT COUNT(stnmr) AS srs FROM stsinmtplc WHERE strbsnonr='$stronr' ORDER BY strstcmspnd ;";
    $query=$conn->query($sql);
    if($query){$tot=$query->fetch_object();
    return $tsrs=$tot->srs;}else{return "q0";}
}
public function fndstrsandsps(){
    if(isset($_SESSION['ssndi'])){
    $data=json_decode($this->usrs());
    $vfycmag=$this->vrfytnmsrs();}
    $nwppl="<div class='rmdohomepagediv'>
    <div class='rmdohmpghdr'></div>
    <div class='rmdoppltabbdsec'>";
    if(isset($_SESSION['ssndi'])){
    if(date("Y")-$data->byr>18&&$vfycmag<5){
        $nwppl.="<div class='stupastreinstrspgbtndvbx' role='button'>Set up A Business</div>";
    }
    $nwppl.="<div class='rmdppltabscontainerbox' style='margin-top:5px;'>
    <div class='rmdpinppledivbox rmdpplpgtabs'><i class='fas fa-thumbtack rdusrpnpllicon rmdppltabsicon'></i><h4 class='rppltabttle'>Pinned</h4></div><hr class='cleavetabshr'>
    <div class='rmddiscovdivbox rmdpplpgtabs'><i class='fas fa-store discoverusericon rmdppltabsicon'></i><h4 class='rppltabttle'>Discover</h4></div>
    </div><hr id='hrafdiscpinppl'>";}else{
        $nwppl.="<h2 style='margin-left:6px;margin-bottom:3px;'>Discover Stores</h2>";
    }
    $nwppl.="<div class='rmdo_srs_cnt_dplydvbx'>";
    if(isset($_SESSION['ssndi'])){$nwppl.="<div class='rmdofindpeoplecontainerdivbox rmdo_shw_pd_ppl'></div>";}
    $nwppl.="<div class='rmdofindpeoplecontainerdivbox rmdo_shw_ppl_to_pn'></div>
    </div>
    </div>";
    if(isset($_SESSION['ssndi'])){
    if(date("Y")-$data->byr>18&&$vfycmag<5){
        $nwppl.="<div class='popupbackground spedsppupdvbx'>
    <div class='popupcontainerbox spedsppupdvbx'>
        <div class='popupheaderbox'>
            <h2 class='popupheadertitle'>Set up a business</h2>
            <button type='button' class='hidepopupbtn'>X</button>
        </div>
        <div class='popupcontentcontainerbox'>
        <div class='bsnstrstupdvbbxx'>
            <div class='stuperrstsdvbx'></div>
            <div class='strstupelmtscntngcntnrdvbx'>
                <div class='stptbsncntbxs bsnacntstupnunemlcntngbx'>
                    <div class='stupnunemiptscntngdvbx'>
                        <div class='snmiptdvbx'><div class='stpiptttlbx'>Business name</div><input type='text' class='stupits strflnm' placeholder='Business name' required/></div>
                        <div class='sunmiptdvbx'>
                        <div class='stpiptttlbx'>Username</div><input type='text' class='stupits streusat' placeholder='Username' required/>
                        <div class='stupusnmnotebx'><strong>Note:</strong> It's easier for people to find your business in search when it has a unique username.</div>
                        </div>
                        <div class='strcatgoriedvbx'>
                        <div class='stpiptttlbx'>Category</div>
                            <select class='strecatgreselct' required>
                                <option>-- Select Category --</option>
                                <option>Electronics</option>
                                <option>Furniture</option>
                                <option>Grocery Store</option>
                                <option>Clothing & Textile</option>
                            </select>
                        </div>
                        <div class='stuppgntndvbx'><div class='stupgnntn' style='background:#1771e6e0;'></div><div class='stupgnntn'></div><div class='stupgnntn'></div><div class='stupgnntn'></div><div class='stupgnntn'></div></div>
                    </div>
                    <div class='stupnxtbtn enumfmcmpltdnxtpgbtn' role='button'><span class='stpnxtbtntxt'>Next</span><span class='stpnxtbtntxt'><i class='fas fa-chevron-right remindosymbols'></i><i class='fas fa-chevron-right remindosymbols'></i></span></div>
                </div>
                <div class='stptbsncntbxs bsnacntstupmladscntngbx'>
                    <div class='stupmnmadrsiptscntngdvbx'>
                        <div class='mnmiptdvbx'>
                        <div class='stpiptttlbx'>Mobile number</div><span>+91</span><input type='number' class='stupits strmblnm' placeholder='Mobile Number' required/><br />
                        <div class='stupusnmnotebx'><strong>Note:</strong> Try to give a mobile number that has UPI accessibility.</div></div>
                        <div class='mliptdvbx'>
                        <div class='stpiptttlbx'>Email (optional)</div><input type='text' class='stupits edtstreml' value='' placeholder='E-mail' /></div>
                        <div class='sunmiptdvbx'>
                            <div class='stpiptttlbx'>Payment methods</div>
                            <select class='strepmtmtdsselct'  multiple='multiple' required>
                                <option>Paytm</option>
                                <option>Phone pe</option>
                                <option>Google pay</option>
                                <option>Amazon pay</option>
                                <option>Mobikwik</option>
                                <option>I don't have any of these.</option>
                            </select>
                            <div class='stupusnmnotebx'><strong>Note:</strong> Your customers can know what payment methods are accessible above the phone number and pays you through it.</div>
                        </div>
                        <div class='stuppgntndvbx'><div class='stupgnntn' id='stupbcknmunmctgpg'></div><div class='stupgnntn' style='background:#1771e6e0;'></div><div class='stupgnntn'></div><div class='stupgnntn'></div><div class='stupgnntn'></div></div>
                    </div>
                    <div class='stupnxtbtn mnmempmcmpltdnxtpgbtn' role='button'><span class='stpnxtbtntxt'>Next</span><span class='stpnxtbtntxt'><i class='fas fa-chevron-right remindosymbols'></i><i class='fas fa-chevron-right remindosymbols'></i></span></div>
                </div>
                <div class='stptbsncntbxs bsnacntstuplcncntngbx'>
                    <div class='stupmnmadrsiptscntngdvbx'>
                        <div class='sunmiptdvbx'>
                            <div class='stpiptttlbx'>Address</div>
                            <textarea class='stupits streadrsipt' placeholder='Address' required/></textarea>
                            <div class='stupusnmnotebx'><strong>Note:</strong> Your business or store is physically known by your address.</div><br>
                        </div>
                        <div class='stuppgntndvbx'><div class='stupgnntn' id='stupbcknmunmctgpg'></div><div class='stupgnntn' id='stupdcktomblemlpg'></div><div class='stupgnntn'' style='background:#1771e6e0;'></div><div class='stupgnntn'></div><div class='stupgnntn'></div></div>
                    </div>
                    <div class='stupnxtbtn adrslccmpltdnxtpgbtn' role='button'><span class='stpnxtbtntxt'>Next</span><span class='stpnxtbtntxt'><i class='fas fa-chevron-right remindosymbols'></i><i class='fas fa-chevron-right remindosymbols'></i></span></div>
                </div>
                <div class='stptbsncntbxs bsnacntstupupipccntngbx'>
                    <div class='stupmnmadrsiptscntngdvbx'>
                        <div class='sunmiptdvbx'>
                        <input type='hidden' value='' id='hdtpiptofqrcd'>
                        <div class='stpiptttlbx'>BHIM UPI qr code</div>
                        <div class='stupusnmnotebx'><strong>Note:</strong> Add your BHIM UPI QR code, so that your customers can directly pay through the scan. You can edit this later.</div><br>
                        <div class='strstupimgdsplydvbx'></div><br>
                        <label><div class='strstupadupibtn stupstrptobtns' role='button' data-tp='bnstrppt'>Add QR code</div><input type='file' class='stuppgadupimgbtn' data-up='abc.png' style='display:none;' ></label>
                        </div></br>
                        <div class='stuppgntndvbx'><div class='stupgnntn' id='stupbcknmunmctgpg'></div><div class='stupgnntn' id='stupdcktomblemlpg'></div><div class='stupgnntn' id='stupbcktoadrspg'></div><div class='stupgnntn'' style='background:#1771e6e0;'></div><div class='stupgnntn'></div></div>
                    </div>
                    <div class='stupnxtbtn upupldcmpltdnxtpgbtn' role='button'><span class='stpnxtbtntxt'>Next</span><span class='stpnxtbtntxt'><i class='fas fa-chevron-right remindosymbols'></i><i class='fas fa-chevron-right remindosymbols'></i></span></div>
                </div>
                <div class='stptbsncntbxs bsnacntstcvrpflscntngbx'>
                    <div class='stupmnmadrsiptscntngdvbx'>
                        <input type='hidden' id='hdndtatpvl'>
                        <div class='sunmiptdvbx'>
                        <input type='hidden' id='hdtpiptofcpc'>
                        <input type='hidden' id='hdtpiptofppc'>
                        <div class='stpiptttlbx'>Cover And Profile Photo</div>
                        <div class='stupusnmnotebx'><strong>Note:</strong> We suggest you add your physical store's image as a cover pic so that customers can know your store when they arrive. You can edit these later.</div><br>
                        <div class='strstuppcsdsplydvbx'>
                            <div class='strsstupcvrdsplybx'></div><br>
                            <div class='strsstupprfldsplybx'></div>
                        </div><br>
                        <div class='stradstrspcsbtns'><label><div class='strstupadcvrprfbtn rmdstrcvpcchng stupstrptobtns' data-tp='bnstrcvpt' role='button'>Add Cover</div><input type='file' style='display:none;' class='rmdprpicchngipt rmdprpicchngiptincvrpg'></label>
                        <label><div class='strstupadcvrprfbtn strstupadprflbtn rmdstrpfpcchng stupstrptobtns' data-tp='bnstrpfpt' role='button'>Add Profile</div><input type='file' class='rmdprpicchngipt rmdprpicchngiptinprfpg'  style='display:none;'>
                        </label></div>
                        </div></br>
                        <div class='stuppgntndvbx'><div class='stupgnntn' id='stupbcknmunmctgpg'></div><div class='stupgnntn' id='stupdcktomblemlpg'></div><div class='stupgnntn' id='stupbcktoadrspg'></div><div class='stupgnntn' id='bcktoupistupg'></div><div class='stupgnntn' style='background:#1771e6e0;'></div></div>
                    </div>
                    <div class='stupnxtbtn strcppcmpltdnxtpgbtn' role='button'><span class='stpnxtbtntxt'>Setup</span></div>
                </div>
                <div class='stptbsncntbxs bsnactstupsscflyscntngbx'>
                    <div class='stupmnmadrsiptscntngdvbx'>
                        <div class='sunmiptdvbx'>
                            <center><h4 style='color:gray'>You have set up your business successfully. Now you can add your products to your business and receive orders from your pinned customers online through Remindo.</h4></center>
                        </div><br>
                    </div>
                    <div class='stupnxtbtn aftrstupgtstrebtn' style='background:green;' role='button'><span class='stpnxtbtntxt'>Go to store</span></div>
                </div>
            </div>
        </div>
    </div>
    </div>";}}
$nwppl.="</div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js'></script>
    <script src='http://localhost/remindo/js/cobnfns.js'></script>
    <script src='http://localhost/remindo/js/strse.js'></script>
    <script src='http://localhost/remindo/stores/strsdtsupdts.js'></script>
    </div>";
    if(!isset($_SESSION['ssndi'])){$nwppl.="<script>strsgnsfn(true, 0, 5);</script>";}
    return $nwppl;
}
}
$ppl=new pplcnts();
function bdyjsn($ppl){
    echo json_encode(array(
    'title'=> "Stores | Remindo",
    'body'=> $ppl->fndstrsandsps(),
));}
if(isset($_POST['ppsttevt'])){if($_POST['ppsttevt']=="frdppstt"){bdyjsn($ppl);}}
elseif(isset($_GET['sstrsnm'])){
if($_GET['sstrsnm']=="treshw"){bdyjsn($ppl);}
}else{
// if(!isset($_SESSION['usrml'])){
//     header("Location: signin");
// }
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stores | Remindo</title>';
    include 'commonfiles/commoncss.php';
echo '</head>
<body>
<div class="pageloader" style="display:none;"><div class="remindopageloaderdivbox"></div></div>
<div class="remindomainheaderlptpvsn"></div>
<div class="remindochildboxycontainer">';
echo $ppl->fndstrsandsps();
echo '
</div>
</body>
</html>';
}
?>