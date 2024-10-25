<?php
include 'db_conn.php';
//css of this is equal to header's
session_start();
function searchpage($q){
    $q=htmlspecialchars(htmlentities($q));
    $spg="<div class='rmdohomepagediv'>
    <div class='rmdohmpghdr'></div>
    <div class='rmdofindpeoplecontainerdivbox'>
    <div class='serhbrdvbxinsrchpg' style='position: sticky;z-index: 3;top: 118px;background: white;'>
        <div class='bckbtnsrchiptdvcntbx'>";
            // $spg.="<div class='pfbcksrchbtn' roll='button'><i class='fas fa-arrow-left remindosymbols'></i></div>";
            $spg.="<input type='text' class='rmdomainsrchiptbx' style='width:100%;' placeholder='Search'>
            <div class='clrtxtinmainsrchbx' role='button'><i class='fas fa-times remindosymbols' style='background:#FFFFFF;cursor:pointer;'></i></div>
        </div>
    </div>
    <div class='srpgttle1dvbx'>    
        <h3 class='srpgttle srpgttle1'>Search :</h3><p class='srpgttle srptg srchqurforcntr'>".$q."</p>
    </div><hr>
    <div class='mainsrchrsltsdvbx' style='padding:6px;margin:5px;'></div>
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js'></script>
    <script src='http://localhost/remindo/js/cobnfn.js'></script>
    <script src='http://localhost/remindo/js/comfle.js'></script>
    <script src='http://localhost/remindo/js/hdre.js'></script>
    <script src='http://localhost/remindo/srch/srchtpcses.js'></script>
    </div>";
    return $spg;
}
if(isset($_GET['opnsrchpg'])){
if($_GET['opnsrchpg']=="opnsrch"&&isset($_GET['q'])){
    $q=htmlentities($_GET['q']);
    echo json_encode(array(
        "body"=>searchpage($q)
    ));
}
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
    <title>Search | Remindo</title>';
    include 'commonfiles/commoncss.php';
echo '</head>
<body>
<div class="pageloader" style="display:none;"><div class="remindopageloaderdivbox"></div></div>
<div class="remindomainheaderlptpvsn"></div>
<div class="remindochildboxycontainer">';
if(isset($_GET['q'])){
    $q=htmlentities(mysqli_real_escape_string($conn,$_GET['q']));
    echo searchpage($q);
}
echo '
</div>
</body>
</html>';
}
?>