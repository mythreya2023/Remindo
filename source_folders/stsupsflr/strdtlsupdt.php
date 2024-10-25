<?php
session_start();
include '../db_conn.php';
class strdtlscurd extends dbconnect{
    public function updtstrdtsl($sid,$sname,$satment,$stremail,$strmoblnum,$ctgre,$avlptmts,$straddress,$lnglat,$oct,$mnpch){
        $conn=$this->connect();
        $strid=htmlentities(mysqli_real_escape_string($conn,$sid));
        if(empty($sname)||empty($satment)||empty($strmoblnum)||empty($avlptmts)||empty($ctgre)||empty($straddress)){
            echo "Please fill all the details.";
        }elseif($this->chckatmtavble($satment)!=0&&$this->chckatmtavble($satment)!=$strid){
            return "u1";
        }
        else{
            $satment=explode(" ",$satment);$stat="";
            foreach($satment as $at){$stat.=$at;}
        $stronr=$this->enc(htmlentities($_SESSION['ssndi']),$this->iky,'idx');
        $snam=$this->sblen(htmlentities(mysqli_real_escape_string($conn,strtolower($sname))),$this->strec,'strix');
        $atmt=$this->sblen(htmlentities(mysqli_real_escape_string($conn,strtolower($stat))),$this->strec,'strix');
        $seml=$this->enc(htmlentities(mysqli_real_escape_string($conn,$stremail)),$this->strec,'mtr');
        $smoblnum=$this->enc(htmlentities(mysqli_real_escape_string($conn,$strmoblnum)),$this->strec,'mtr');
        $avlptmtds=$this->enc(htmlentities(mysqli_real_escape_string($conn,$avlptmts)),$this->strec,'mtr');
        $cg=$this->enc(htmlentities(mysqli_real_escape_string($conn,$ctgre)),$this->strec,'strix');
        $saddress=$this->enc(htmlentities(mysqli_real_escape_string($conn,$straddress)),$this->strec,'mtr');
        $slglt=$this->enc(htmlentities(mysqli_real_escape_string($conn,$lnglat)),$this->strec,'mtr');
        $o_c_t=$this->enc(htmlentities(mysqli_real_escape_string($conn,$oct)),$this->strec,'mtr');
        $mnamtbld=$this->enc(htmlentities(mysqli_real_escape_string($conn,$mnpch)),$this->strec,'mtr');
        $sql="UPDATE stsinmtplc SET strnm='$snam', stratmnt='$atmt', strseml='$seml', stsbsnmblnum='$smoblnum',stracptbluipmtmtds='$avlptmtds',strrctgre='$cg', stradrs='$saddress', strlgtdlatd='$slglt',stropngclsngtmgs='$o_c_t',strpdtmnprchs='$mnamtbld' WHERE stnmr='$strid' AND strbsnonr='$stronr';";
        $query=$conn->query($sql);
        if($query){return "1";}else{return "0";}
    }
    }
    public function usrshpngdlsupdt($unm,$ulcy,$ucy,$ust,$upcd,$umbnm){
        $conn=$this->connect();
        $u=htmlentities($_SESSION['ssndi']);
        $usnm=$this->sblen(htmlentities(mysqli_real_escape_string($conn,$unm)),$this->iky,'idx');
        $ulcty=$this->enc(htmlentities(mysqli_real_escape_string($conn,$ulcy)),$this->iky,'mtr');
        $ucty=$this->enc(htmlentities(mysqli_real_escape_string($conn,$ucy)),$this->iky,'mtr');
        $ustat=$this->enc(htmlentities(mysqli_real_escape_string($conn,$ust)),$this->iky,'mtr');
        $upd=$this->enc(htmlentities(mysqli_real_escape_string($conn,$upcd)),$this->iky,'mtr');
        $usmbn=$this->enc(htmlentities(mysqli_real_escape_string($conn,$umbnm)),$this->iky,'mtr');
        $sql="UPDATE roupldls SET rmuflm='$usnm',usrlocty='$ulcty',usrcty='$ucty',usrstat='$ustat',usrpncd='$upd',usrpnmr='$usmbn' WHERE usid='$u';";
        $query=$conn->query($sql);
        if($query){return 1;}else{return 0;}
    }
    public function opnrcvngstsupdts($sid,$uod,$typ){
        $conn=$this->connect();
        $strid=$this->dec(htmlentities(mysqli_real_escape_string($conn,$sid)),$this->strec);
        $uod=($uod==1?1:0);
        $uod=$this->enc(htmlentities(mysqli_real_escape_string($conn,$uod)),$this->strec,'strix');
        $tp=htmlentities(mysqli_real_escape_string($conn,$typ));
        if($tp=='onsts'){
            $sql="UPDATE stsinmtplc SET stropnsts='$uod' WHERE stnmr='$strid';";
        }elseif($tp=='rvabl'){
            $sql="UPDATE stsinmtplc SET strsodrrcvngsts='$uod', strodrlmts='OjrINsLDwFxV9lUsEvfOaBhk' WHERE stnmr='$strid';";
        }
        $query=$conn->query($sql);
        if($query){return "1";}else{return "0";}
    }
    public function avlcasupdts($sid,$uod){
        $conn=$this->connect();
        $strid=$this->dec(htmlentities(mysqli_real_escape_string($conn,$sid)),$this->strec);
        $uod=($uod==1?1:0);
        $uod=$this->enc(htmlentities(mysqli_real_escape_string($conn,$uod)),$this->strec,'strix');
        $stronr=$this->enc(htmlentities($_SESSION['ssndi']),$this->iky,'idx');
        $sql="UPDATE stsinmtplc SET stravblcstoevyon='$uod' WHERE stnmr='$strid' AND strbsnonr='$stronr';";
        $query=$conn->query($sql);
        if($query){return "1";}else{return "0";}
    }
    public function updsrhlts($s,$h){
        $conn=$this->connect();
        $strid=$this->dec(htmlentities(mysqli_real_escape_string($conn,$s)),$this->strec);
        $hlts=$this->enc(htmlentities(mysqli_real_escape_string($conn,$h)),$this->strec,'strix');
        $sql="UPDATE stsinmtplc SET strhlgts='$hlts' WHERE stnmr='$strid';";
        $query=$conn->query($sql);
        if($query){return "1";}else{return "0";}
    }
    public function pinstore($sid){
        $conn=$this->connect();
        $stid=$this->dec(htmlentities(mysqli_real_escape_string($conn,$sid)),$this->strec);
        $strid=$this->enc(htmlentities(mysqli_real_escape_string($conn,$stid)),$this->strec,'strix');
        $cstmrid=$this->enc(htmlentities(mysqli_real_escape_string($conn,$_SESSION['ssndi'])),$this->iky,'idx');
        $ntfsts=$this->enc("0",$this->strec,'mtr');
        $casoptn=$this->enc("0",$this->strec,'mtr');
            $sqpn="INSERT INTO stspdbycstms (stsnm,stscmnm,mtntfsfmstr,strcstmrcsonavbl,strttlitrcns)VALUES('$strid','$cstmrid','$ntfsts','$casoptn','0');";
            if($conn->query($sqpn)){
                $sqlinst="UPDATE stsinmtplc SET strstcmspnd=strstcmspnd+1 WHERE stnmr='$stid';";
                if($conn->query($sqlinst)){return 1;}return 1;
            }else{return 0;}
    }
    public function casavailupdt($cncnid,$cstmr,$strid,$casavail){
        $conn=$this->connect();
        $strid=$this->enc(htmlentities($this->dec(mysqli_real_escape_string($conn,$strid),$this->strec)),$this->strec,'strix');
        $cstmrid=$this->enc(htmlentities($this->dec(mysqli_real_escape_string($conn,$cstmr),$this->iky)),$this->iky,'idx');
        $casuod=htmlentities(mysqli_real_escape_string($conn,$casavail));
        $cncnid=$this->dec(htmlentities(mysqli_real_escape_string($conn,$cncnid)),$this->strec);
        $casopn0=$this->enc("0",$this->strec,'mtr');
        $casoptn1=$this->enc("1",$this->strec,'strix');
        if($casuod==1){
            $sqlcas="UPDATE stspdbycstms SET strcstmrcsonavbl='$casoptn1' WHERE stsrnum='$cncnid' AND stsnm='$strid' AND stscmnm='$cstmrid';";
        }else{
            $sqlcas="UPDATE stspdbycstms SET strcstmrcsonavbl='$casopn0' WHERE stsrnum='$cncnid' AND stsnm='$strid' AND stscmnm='$cstmrid';";
        }
        if($conn->query($sqlcas)){return 1;}else{return 0;}
    }
    private function setupbusiness($sname,$satment,$ctgre,$stremail,$strmoblnum,$avlptmts,$straddress,$strupic,$strcvpg,$strprfpc,$opn_clsng_tmng,$psntme){
        $conn=$this->connect();
        if(empty($sname)||empty($satment)||empty($strmoblnum)||empty($avlptmts)||empty($straddress)){
            echo "Please fill all the details.";
        }elseif($this->chckatmtavble(strtolower($satment))!=0){
            echo "This is already taken. Try including numbers and Other letters.";
        }
        else{
        $satment=explode(" ",$satment);$stat="";
        foreach($satment as $at){$stat.=$at;}
        $stronr=$this->enc(htmlentities($_SESSION['ssndi']),$this->iky,'idx');
        $snam=$this->sblen(htmlentities(mysqli_real_escape_string($conn,strtolower($sname))),$this->strec,'strix');
        $atmt=$this->sblen(htmlentities(mysqli_real_escape_string($conn,strtolower($stat))),$this->strec,'strix');
        $cg=$this->enc(htmlentities(mysqli_real_escape_string($conn,$ctgre)),$this->strec,'strix');
        $seml=$this->enc(htmlentities(mysqli_real_escape_string($conn,$stremail)),$this->strec,'mtr');
        $smoblnum=$this->enc(htmlentities(mysqli_real_escape_string($conn,$strmoblnum)),$this->strec,'mtr');
        $avlptmtds=$this->enc(htmlentities(mysqli_real_escape_string($conn,$avlptmts)),$this->strec,'mtr');
        $saddress=$this->enc(htmlentities(mysqli_real_escape_string($conn,$straddress)),$this->strec,'mtr');
        $slglt=$this->enc(htmlentities(mysqli_real_escape_string($conn,"")),$this->strec,'mtr');
        $stupi=$this->enc(htmlentities(mysqli_real_escape_string($conn,$strupic)),$this->strec,'mtr');
        $stcvpg=$this->enc(htmlentities(mysqli_real_escape_string($conn,$strcvpg)),$this->strec,'mtr');
        $stpfc=$this->enc(htmlentities(mysqli_real_escape_string($conn,$strprfpc)),$this->strec,'mtr');
        $o_c_t=$this->enc(htmlentities(mysqli_real_escape_string($conn,$opn_clsng_tmng)),$this->strec,'mtr');
        $psntme=$this->enc(htmlentities(mysqli_real_escape_string($conn,$psntme)),$this->strec,'mtr');
        $sops=$this->enc("0",$this->strec,'strix');
        $savbl=$sops;
        $rtng=$sops;
        $avblcas=$sops;
        $zro=$sops;
            $sql="INSERT INTO stsinmtplc(strbsnonr,strnm,stratmnt,strrctgre,strseml,stsbsnmblnum,stracptbluipmtmtds,stradrs,strlgtdlatd,strbprflig,strcvrpto,strbupimg,stropngclsngtmgs,stropnsts,strsodrrcvngsts,stravblcstoevyon,strsprtng,strcrtdtmstp,strodrs1,strtrvnu1,strigtdt1,strodrs2,strtrvnu2,strigtdt2) VALUES('$stronr','$snam','$atmt','$cg','$seml','$smoblnum','$avlptmtds','$saddress','$slglt','$stpfc','$stcvpg','$stupi','$o_c_t','$sops','$savbl','$avblcas','$rtng','$psntme','$zro','$zro','$psntme','$zro','$zro','$zro');";
            $query=$conn->query($sql);
            if($query){
                $this->trckstrs($ctgre);
                return 1;
            }else{
                if(file_exists("../qrstsbprfpcs/".$strupic)){unlink("../qrstsbprfpcs/".$strupic);}
                if(file_exists("../fhupuppts/".$strprfpc)){unlink("../fhupuppts/".$strprfpc);}
                if(file_exists("../fhstsbsncvpcs/".$strcvpg)){unlink("../fhstsbsncvpcs/".$strcvpg);}
                return 0;
            }
        }
    }
    public function stupnwstr($sname,$satment,$ctgre,$stremail,$strmoblnum,$avlptmts,$straddress,$opn_clsng_tmng,$psntme,$pfig,$cvig,$pmig){
        $strupic="";$strcvpg="";$strprfpc="";
        $_FILES=[$pfig,$cvig,$pmig];
        $phsary=["../fhupuppts/","../fhstsbsncvpcs/","../qrstsbprfpcs/"];
        for($i=0;$i<=count($_FILES)-1;$i++){
            if(isset($_FILES[$i]['name'])&&$_FILES[$i]!=""){
            $fileName=$_FILES[$i]['name'];
            $extension= pathinfo($fileName,PATHINFO_EXTENSION);
            $file_removed_ext=pathinfo($fileName,PATHINFO_FILENAME);
            $valid_Ext = array("jpg","jpeg","png");
                if(in_array($extension,$valid_Ext)){
                    $newName=time()."."."jpg";$tmp=$_FILES[$i]['tmp_name'];
                    if(!file_exists($phsary[$i].$newName)){if(move_uploaded_file($tmp,$phsary[$i].$newName)){
                    if($i==0){$strprfpc=$newName;}
                    elseif($i==1){$strcvpg=$newName;}
                    elseif($i==2){$strupic=$newName;}
                    }}
                }else{if($i==0){$strprfpc="";}
                elseif($i==1){$strcvpg="";}
                elseif($i==2){$strupic="";}}
            }else{if($i==0){$strprfpc="";}
            elseif($i==1){$strcvpg="";}
            elseif($i==2){$strupic="";}}
        }
        return $this->setupbusiness($sname,$satment,$ctgre,$stremail,$strmoblnum,$avlptmts,$straddress,$strupic,$strcvpg,$strprfpc,$opn_clsng_tmng,$psntme);
    }
    private function adpcuig($sid,$pimg,$newName,$type,$tmp){
        $userloginid=$this->enc(htmlentities($_SESSION['ssndi']),$this->iky,'idx');
        $nm=$this->enc($newName,$this->strec,'mtr');
        $str=$this->dec(htmlentities($sid),$this->strec);
        $uptyp="";$path="";
        if($type=="bsnstrcvpc"||$type=="rmvbncv"){$uptyp="strcvrpto";$path="../fhstsbsncvpcs/";if(file_exists($path.$pimg)){unlink("../fhstsbsncvpcs/".$pimg);}}
        elseif($type=="bnstrpfpt"||$type=="rmvbnpfpc"){$uptyp="strbprflig";$path="../fhupuppts/";if(file_exists($path.$pimg)){unlink("../fhupuppts/".$pimg);}}
        elseif($type=="upptpc"||$type=="rmvbnuppc"){$uptyp="strbupimg";$path="../qrstsbprfpcs/";if(file_exists($path.$pimg)){unlink("../qrstsbprfpcs/".$pimg);}}
        $sql_update_img="UPDATE stsinmtplc SET $uptyp='$nm' WHERE stnmr='$str';";
        $query_update_img=$this->connect()->query($sql_update_img);
        if($query_update_img){
            if(!file_exists($path.$newName)){if(move_uploaded_file($tmp,$path.$newName)){echo $path.$newName;}}
        }
        else{if(file_exists($path.$newName)){unlink($path.$newName);}return "n0";}
    }
    public function vfypcupicig($s,$prig,$ptp,$igs){  
    $_FILES=$igs;$conn=$this->connect();
    if(isset($_FILES['name'])&&$_FILES['name']!=""){
    $fileName=$_FILES['name'];
    $extension= pathinfo($fileName,PATHINFO_EXTENSION);
    $file_removed_ext=pathinfo($fileName,PATHINFO_FILENAME);
    $valid_Ext = array("jpg","jpeg","png");
        if(in_array($extension,$valid_Ext)){
            $newName=time()."."."jpg";
            $usrprvImg=htmlentities(mysqli_real_escape_string($conn,$prig));
            $usrprvImg=$usrprvImg==""?"-":$usrprvImg;
            $nm=htmlentities(mysqli_real_escape_string($conn,$newName));
            $sid=htmlentities(mysqli_real_escape_string($conn,$s));
            if($ptp=='bnstrcvpt'){$tp="bsnstrcvpc";echo $this->adpcuig($sid,$usrprvImg,$nm,$tp,$_FILES['tmp_name']);}
            elseif($ptp=='bnstrpfpt'){$tp="bnstrpfpt";echo $this->adpcuig($sid,$usrprvImg,$nm,$tp,$_FILES['tmp_name']);}
            elseif($ptp=='bnstrppt'){$tp="upptpc";echo $this->adpcuig($sid,$usrprvImg,$nm,$tp,$_FILES['tmp_name']);}
        }
        else{echo "e1";}
    }else{echo "e0";}
    }
}
$stsups=new strdtlscurd();
if(isset($_POST['vrfat'])){
    echo $stsups->chckatmtavble($_POST['vrfat']);
}
if(isset($_POST['stpac'])&&$_POST['stpac']=='trestp'){
    if(isset($_POST['strnm'])&&isset($_POST['at'])&&isset($_POST['cg'])&&isset($_POST['mlm'])&&isset($_POST['apmts'])&&isset($_POST['eml'])&&isset($_POST['ads'])&&isset($_POST['octms'])&&isset($_POST['jtms'])){
         echo $stsups->stupnwstr($_POST['strnm'],$_POST['at'],$_POST['cg'],$_POST['eml'],$_POST['mlm'],$_POST['apmts'],$_POST['ads'],$_POST['octms'],$_POST['jtms'],(isset($_FILES['pfpc']))?$_FILES['pfpc']:"",(isset($_FILES['cvig']))?$_FILES['cvig']:"",(isset($_FILES['pmig']))?$_FILES['pmig']:"");
    }
}
if(isset($_POST['onrvsts'])&&$_POST['onrvsts']=='udttre'){
    if(isset($_POST['s'])&&isset($_POST['ud'])&&isset($_POST['tp'])){
        echo $stsups->opnrcvngstsupdts($_POST['s'],($_POST['ud']=="tre")?1:0,$_POST['tp']);
    }
}
if(isset($_POST['csavlsts'])&&$_POST['csavlsts']=='udcsttre'){
    if(isset($_POST['s'])&&isset($_POST['ud'])){
        echo $stsups->avlcasupdts($_POST['s'],($_POST['ud']=="tre")?1:0);
    }
}
if(isset($_POST['edtextac'])&&$_POST['edtextac']=='treedtext'){
    if(isset($_POST['sid'],$_POST['strnm'])&&isset($_POST['at'])&&isset($_POST['cg'])&&isset($_POST['mbl'])&&isset($_POST['pmts'])&&isset($_POST['eml'])&&isset($_POST['ads'])&&isset($_POST['oct'])&&isset($_POST['mps'])){
        echo $stsups->updtstrdtsl($_POST['sid'],$_POST['strnm'],$_POST['at'],$_POST['eml'],$_POST['mbl'],$_POST['cg'],implode(",",$_POST['pmts']),$_POST['ads'],$_POST['lalg'],$_POST['oct'],$_POST['mps']);
    }
}
if(isset($_POST['csavl'])&&$_POST['csavl']=='avlcstre'){
    if(isset($_POST['cn'])&&isset($_POST['s'])&&isset($_POST['ud'])&&isset($_POST['c'])){
        echo $stsups->casavailupdt($_POST['cn'],$_POST['c'],$_POST['s'],($_POST['ud']=="tre")?1:0);
    }
}
if(isset($_POST['pnsr'])&&isset($_POST['sd'])&&$_POST['pnsr']=="trepnstr"){
    echo $stsups->pinstore($_POST['sd']);
}
if(isset($_POST['strhlts'])&&isset($_POST['s'])&&isset($_POST['h'])&&$_POST['strhlts']=="tresrhlts"){
    echo $stsups->updsrhlts($_POST['s'],$_POST['h']);
}
if(isset($_POST['s'])&&isset($_POST['prigtcg'])&&isset($_POST['ptp'])&&isset($_FILES["file"])){
    echo $stsups->vfypcupicig($_POST['s'],$_POST['prigtcg'],$_POST['ptp'],$_FILES['file']);
}
if(isset($_POST['usdls'])&&$_POST['usdls']=="tushpgdls"&&isset($_POST['u'])&&isset($_POST['a'])&&isset($_POST['c'])&&isset($_POST['s'])&&isset($_POST['p'])&&isset($_POST['m'])){
    echo $stsups->usrshpngdlsupdt($_POST['u'],$_POST['a'],$_POST['c'],$_POST['s'],$_POST['p'],$_POST['m']);
}
?>