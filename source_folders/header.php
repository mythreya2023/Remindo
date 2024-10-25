<?php
include 'commonfiles/comuser.php';
class header extends usrslfdtls{
public function headerpage(){
    if(isset($_SESSION['ssndi'])){$data=json_decode($this->usrs());}
  $header= "<nav class='remindo-mobile-header-nav'>
<div class='remindo-title-box-mobile' >
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
    <div class='serhbradsugdvbx serchdvbx'>
        <div class='bckbtnsrchiptdvbx'>
            <div class='hdsrchbtn' roll='button'><i class='fas fa-arrow-left remindosymbols'></i></div>
            <input type='text' class='rmdomainsrchbar' placeholder='Search'>
            <div class='clrtxtinsrchbx' roll='button'><i class='fas fa-times remindosymbols'></i></div>
        </div>
        <div class='srchsugstnsdvbx'></div>
    </div>
    <div class='remindobtns' >";
    if(isset($_SESSION['ssndi'])){$header.="<div style='display:none;'><input type='hidden' class='gtusrctz' value='".$data->ustmzn."'></div>";}
    $header.="<ul class='search_profile'>
        <li class='search_profileli searchbtn'><div class='remindosearchbtn rmdmnsrchbxshwbtn' role='button'>
        <i class='fas fa-search mainsearchbtn'></i>
        </div>
        </li>";
        if(isset($_SESSION['ssndi'])){$header.="<li class='search_profileli userprofile'>
        <div class='remindoprofilebtn'>
        <img src='http://localhost/remindo/pflmgs/".$data->urprfig."' style='object-fit:cover;' class='reminouserprofilepic rdprnpfig'>
        </div>
        </li>";}else{
        $header.="<li><a href='http://localhost/remindo/signin'><div class='lgn_btn_stplvtcns' style='padding: 6px;border: 1px solid;border-radius: 5px;margin: 18px 12px 5px 15px;color: white;box-shadow: inset 0 0 24px -8px white;'>Login</div></a></li>";
        }
    $header.="</ul>
    </div>
    </div>
</div>
</nav>";
return $header;
}
public function shortheader(){
return "<div class='remindo-short-nav-box'>
<ul class='remindopagenavigatorlist'>
<li class='remindohomenavigator remindomobileviewnavigator'>
    <span class='remindonavhomebtn'>
    <div class='remindonavhomebtncontainer remindocommondivs'>
    <a href='/'><svg xmlns='http://www.w3.org/2000/svg' x='0px' y='0px'
    width='30' height='30'
    viewBox='0 0 172 172'
    style=' fill:#000000;'><g fill='none' fill-rule='nonzero' stroke='none' stroke-width='1' stroke-linecap='butt' stroke-linejoin='miter' stroke-miterlimit='10' stroke-dasharray=' stroke-dashoffset='0' font-family='none' font-weight='none' font-size='none' text-anchor='none' style='mix-blend-mode: normal'><path d='M0,172v-172h172v172z' fill='none'></path><g fill='#e4740b'><path d='M86,14.33333c-1.91435,0.00025 -3.74903,0.76638 -5.09506,2.1276l-72.28255,63.07226c-0.9155,0.67554 -1.45577,1.74571 -1.45573,2.88347c0,1.97902 1.60431,3.58333 3.58333,3.58333h17.91667v57.33333c0,3.956 3.21067,7.16667 7.16667,7.16667h28.66667c3.956,0 7.16667,-3.21067 7.16667,-7.16667v-43h28.66667v43c0,3.956 3.21067,7.16667 7.16667,7.16667h28.66667c3.956,0 7.16667,-3.21067 7.16667,-7.16667v-57.33333h17.91667c1.97902,0 3.58333,-1.60431 3.58333,-3.58333c0.00004,-1.13776 -0.54023,-2.20792 -1.45573,-2.88347l-72.24056,-63.03027c-0.01394,-0.01406 -0.02794,-0.02805 -0.04199,-0.04199c-1.34603,-1.36123 -3.18071,-2.12736 -5.09506,-2.1276z'></path></g></g></svg></a>
    </div>
    <div class='remindohomebar'></div>
    </span>
</li>
<li class='remindomktplcnavigator remindomobileviewnavigator'>
    <span class='remindonavstrebtn'>
    <div class='remindonavmktstsbtncontainer remindocommondivs'>
    <div class='belbadge' style='float:right;margin-bottom:-21px;'></div>
    <a href='/stores.php'><div><i class='far fa-store'></i></div></a>
    </div>
    <div class='remindomktbar'></div>
    </span>
</li>
<li class='remindonfcsnavigator remindomobileviewnavigator'>
    <span class='remindonavstrebtn'>
    <div class='remindonfcstsbtncontainer remindocommondivs'>
    <div class='rem-badge nfcnsbdge' style='display:none;float:right;margin-bottom:-21px;background:red;'>0</div>
    <a href='/notifications'><div><i class='far fa-bell'></i></div></a>
    </div>
    <div class='remindnfcsbar'></div>
    </span>
</li>
</ul>
</div>
<div id='snackbar'></div>
";
}
public function hdrscrpt(){
    return "<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js'></script>
    <script src='http://localhost/remindo/js/hdre.js'></script>
    <script src='http://localhost/remindo/search/srchtpcses.js'></script>";
}
public function topadnbtmhdr(){
    return $this->headerpage().$this->shortheader().$this->hdrscrpt();
}
}
$hdr=new header();
if(isset($_GET['gthdrfpg'])){
    $showheader=htmlspecialchars($_GET['gthdrfpg']);
 if($showheader=="trys"){
    echo $hdr->topadnbtmhdr();
 }
}
if(isset($_GET['olscrpts'])&&$_GET['olscrpts']=="trescrpts"){
    echo $hdr->hdrscrpt();
}
?>