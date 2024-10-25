<?php
session_start();
include '../db_conn.php';
class strprdts extends dbconnect{
    private function nwvsnadpds($sid,$pdtnm,$pdtqty,$ptsts,$lstupdt,$ptprc,$tz,$pfchrs,$pmabt,$palslds,$lvumdlpto,$pdtpics){
        $conn=$this->connect();
        if(empty($pdtnm)){
            if(file_exists($lvumdlpto)&&$lvumdlpto!="pflmgs/defa.png"&&$path!="../pflmgs/defa.png"){unlink(htmlentities($lvumdlpto));}
            $pvig=explode(",",$pdtpics);
            foreach ($pvig as $pvig) {
                if(file_exists($pvig)&&$pvig!="pflmgs/defa.png"&&$path!="../pflmgs/defa.png"){unlink(htmlentities($pvig));}
            }
            return "pm0";
        }else{
        $strid=htmlentities(mysqli_real_escape_string($conn,$sid));
        if($this->chckatmtavble($strid)!=0){
        $stronr=$this->enc(htmlentities(mysqli_real_escape_string($conn,$_SESSION['ssndi'])),$this->iky,'idx');
        $pdtnm=$this->sblen(htmlentities(mysqli_real_escape_string($conn,strtolower($pdtnm))),$this->strec,'strix');
        $pdtqlty=$this->enc(htmlentities(mysqli_real_escape_string($conn,"")),$this->strec,'strix');
        $pdtsts=$this->enc(htmlentities(mysqli_real_escape_string($conn,($ptsts=="In stock")?1:0)),$this->strec,'idx');
        $lstupdt=$this->enc(htmlentities(mysqli_real_escape_string($conn,$lstupdt)),$this->strec,'strix');
        $tmz=htmlentities(mysqli_real_escape_string($conn,$tz));
        $pdtqty=$this->sblen(htmlentities(mysqli_real_escape_string($conn,strtolower($pdtqty))),$this->strec,'strix');
        $pfcrs=$this->sblen(htmlentities(mysqli_real_escape_string($conn,strtolower($pfchrs))),$this->strec,'strix');
        $ptpto=$this->enc(htmlentities(mysqli_real_escape_string($conn,$pdtpics)),$this->strec,'mtr');
        $lvmdlig=$this->enc(htmlentities(mysqli_real_escape_string($conn,$lvumdlpto)),$this->strec,'mtr');
        $pdtmdls=$this->enc(htmlentities(mysqli_real_escape_string($conn,$pmabt)),$this->strec,'mtr');
        $pdtprc=$this->sblen(htmlentities(mysqli_real_escape_string($conn,strtolower($ptprc))),$this->strec,'strix');
        $plsolds=$this->sblen(htmlentities(mysqli_real_escape_string($conn,strtolower($palslds))),$this->strec,'strix');
        $sql="INSERT INTO prdcsinstr(strnmr,stronrnmr,prdtnm,prdtpto,prdtqnty,pdtqlty,prdtprc,pdtsts,pdtlstupdt,prdtstrtmtp,pdttlpchs,pdtlrgvws,pdtmhmes,pdtfhrs,pdtmrdlsdsrpn,pdtlvmdlig)VALUES('$strid','$stronr','$pdtnm','$ptpto','$pdtqty','$pdtqlty','$pdtprc','$pdtsts','$lstupdt','$tmz','$plsolds','0','0','$pfcrs','$pdtmdls','$lvmdlig');";
        if($conn->query($sql)){return 1;}else{
            if(file_exists($lvumdlpto)&&$lvumdlpto!="pflmgs/defa.png"&&$path!="../pflmgs/defa.png"){unlink(htmlentities($lvumdlpto));}
            $pvig=explode(",",$pdtpics);
            foreach ($pvig as $pvig) {
                if(file_exists($pvig)&&$pvig!="pflmgs/defa.png"&&$path!="../pflmgs/defa.png"){unlink(htmlentities($pvig));}
            }
            return 0;
        }
        }else {
            return "noacc";
        }
        }
    }
    public function adnwpdtstxtsigs($sid,$pdtnm,$pdtqty,$ptsts,$lstupdt,$ptprc,$tz,$pfchrs,$pmabt,$palslds,$lvmdl,$pdtpics){
        $pdtptos="";
        if(isset($_FILES['file'])&&$pdtpics!=""){
        $_FILES['file']=$pdtpics;
        if(count($_FILES['file']['name'])>0){
        for($ig=0;$ig<=count($_FILES['file']['name'])-1;$ig++){
        if($ig<=4){
        $fileName=$_FILES['file']['name'][$ig];
        $extension= pathinfo($fileName,PATHINFO_EXTENSION);
        $file_removed_ext=pathinfo($fileName,PATHINFO_FILENAME);
        $valid_Ext = array("jpg","jpeg","png");
        if(in_array($extension,$valid_Ext)){
            $newName=substr($file_removed_ext,0,rand(0,strlen($file_removed_ext))).rand()."."."jpg";
            $path="../strpdtspcs/".$newName;
            $tmp=$_FILES['file']['tmp_name'][$ig];
            if(!file_exists($path)){
                if(move_uploaded_file($tmp,$path)){
                    if($ig < count($_FILES['file']['name'])-1){$pdtptos .=$newName."/,";}else{$pdtptos .=$newName;}
                }
            }
        }
        }else{break;}
        }
        }}$lvmdlnm="";
        // if(isset($_FILES['lvmdl'])&&$lvmdl!=""){
        // $_FILES['lvmdl']=$lvmdl;
        // if(isset($_FILES['lvmdl']['name'])){
        // $fileName=$_FILES['lvmdl']['name'];
        // $extension= pathinfo($fileName,PATHINFO_EXTENSION);
        // $file_removed_ext=pathinfo($fileName,PATHINFO_FILENAME);
        // $valid_Ext = array("jpg","jpeg","png");
        // if(in_array($extension,$valid_Ext)){
        //     $newName=substr($file_removed_ext,0,rand(0,strlen($file_removed_ext))).rand()."."."jpg";
        //     $path="../srptlvmdlpcs/".$newName;
        //     $tmp=$_FILES['lvmdl']['tmp_name'];
        //     if(!file_exists($path)){
        //         if(move_uploaded_file($tmp,$path)){$lvmdlnm=$newName;}
        //     }
        // }
        // }}
        $lvmdl=htmlentities($lvmdl);
        if(strlen($lvmdl)>0){
        $lvmdl = explode(';base64,', $lvmdl);
        if(strlen($lvmdl[1])>0){
            $data = base64_decode($lvmdl[1]);
            $newName=time()."."."jpg";
            $path="../srptlvmdlpcs/".$newName;
            if(!file_exists($path)){
                if(file_put_contents($path,$data)){$lvmdlnm=$newName;}
            }
        }}
        $txtpdtsts=$this->nwvsnadpds($sid,$pdtnm,$pdtqty,$ptsts,$lstupdt,$ptprc,$tz,$pfchrs,$pmabt,$palslds,$lvmdlnm,$pdtptos);
        return $txtpdtsts;
        
    }
    public function updtstck($sid,$pid,$uod){
        $conn=$this->connect();
        $stronr=$this->enc(htmlentities(mysqli_real_escape_string($conn,$_SESSION['ssndi'])),$this->iky,'idx');
        $strid=htmlentities(mysqli_real_escape_string($conn,$sid));
        $pid=$this->dec(htmlentities(mysqli_real_escape_string($conn,$pid)),$this->strec);
        $uod=$this->enc(($uod=="tre")?1:0,$this->strec,'idx');
        $sql="UPDATE prdcsinstr SET pdtsts='$uod' WHERE strspdtnum='$pid' AND strnmr='$strid' AND stronrnmr='$stronr';";
        if($conn->query($sql)){return 1;}else{return 0;}
    }
    public function dltprdt($sid,$pid,$pc,$lvpc){
        $conn=$this->connect();
        $stronr=$this->enc(htmlentities(mysqli_real_escape_string($conn,$_SESSION['ssndi'])),$this->iky,'idx');
        $strid=htmlentities(mysqli_real_escape_string($conn,$sid));
        $pic=$this->dec(htmlentities(mysqli_real_escape_string($conn,$pc)),$this->strec);
        $lmdig=$this->dec(htmlentities(mysqli_real_escape_string($conn,$lvpc)),$this->strec);
        $pid=$this->dec(htmlentities(mysqli_real_escape_string($conn,$pid)),$this->strec);
        $sql="DELETE FROM prdcsinstr WHERE strspdtnum='$pid' AND strnmr='$strid' AND stronrnmr='$stronr';";
        if($conn->query($sql)){
            if(file_exists("../srptlvmdlpcs/".$lmdig)&&$lmdig!=""&&$lmdig!="pflmgs/defa.png"&&$lmdig!="../pflmgs/defa.png"){unlink("../srptlvmdlpcs/".htmlentities($lmdig));}
            $pvig=explode("/,",$pic);
            foreach ($pvig as $pvig) {
            if(file_exists("../strpdtspcs/".$pvig)&&$pvig!=""&&$pvig!="pflmgs/defa.png"&&$pvig!="../pflmgs/defa.png"){unlink("../strpdtspcs/".htmlentities($pvig));}}
            return 1;}else{return 0;}
    }
    public function nwudtpdls($pid,$sid,$pdtnm,$pdtqty,$pmabt,$pfchrs,$lstupdt,$ptprc,$tz,$palslds){
        $conn=$this->connect();
        if(empty($pdtnm)||empty($pdtqty)||empty($ptprc)){return "epty";}
        else{
        $stronr=$this->enc(htmlentities(mysqli_real_escape_string($conn,$_SESSION['ssndi'])),$this->iky,'idx');
        $pid=$this->dec(htmlentities(mysqli_real_escape_string($conn,$pid)),$this->strec);
        $strid=htmlentities(mysqli_real_escape_string($conn,$sid));
        $pdtnm=$this->sblen(htmlentities(mysqli_real_escape_string($conn,strtolower($pdtnm))),$this->strec,'strix');
        $pdtqty=$this->sblen(htmlentities(mysqli_real_escape_string($conn,strtolower($pdtqty))),$this->strec,'strix');
        $pfcrs=$this->sblen(htmlentities(mysqli_real_escape_string($conn,strtolower($pfchrs))),$this->strec,'strix');
        $pdtmdls=$this->enc(htmlentities(mysqli_real_escape_string($conn,$pmabt)),$this->strec,'mtr');
        $lstedt=$this->enc(htmlentities(mysqli_real_escape_string($conn,$lstupdt)),$this->strec,'strix');
        $pdtprc=$this->sblen(htmlentities(mysqli_real_escape_string($conn,strtolower($ptprc))),$this->strec,'strix');
        $pdtslds=$this->sblen(htmlentities(mysqli_real_escape_string($conn,strtolower($palslds))),$this->strec,'strix');
        $tmz=htmlentities(mysqli_real_escape_string($conn,$tz));
        $sql="UPDATE prdcsinstr SET prdtnm='$pdtnm',prdtqnty='$pdtqty',pdtfhrs='$pfcrs',pdtmrdlsdsrpn='$pdtmdls',prdtprc='$pdtprc',pdtlstupdt='$lstedt',prdtstrtmtp='$tmz',pdttlpchs='$pdtslds' WHERE strspdtnum='$pid' AND strnmr='$strid' AND  stronrnmr='$stronr';";
        $query=$conn->query($sql);
        if($query){return 1;}else{return 0;}
        }
        return;
    }
    public function udtpdtbydnmr($pd,$s){
        $conn=$this->connect();
        $p=explode("//,",$pd);
        $strogid=$this->dec(htmlentities(mysqli_real_escape_string($conn,$s)),$this->strec);
        $sid=$this->enc($strogid,$this->strec,'strix');
        $sqlpsh="";$sdsary=[];$trnvu=0;$altpdsld=0;
        foreach($p as $p){
        $p=explode(",/,/",$p);
        $pid=$this->dec(htmlentities(mysqli_real_escape_string($conn,$p[0])),$this->strec);
        $qnty=htmlentities(mysqli_real_escape_string($conn,$p[1]));
        $qty=htmlentities(mysqli_real_escape_string($conn,$p[2]));
        $prdpc=htmlentities(mysqli_real_escape_string($conn,$p[3]));
        $trnvu += $prdpc*$qty;$altpdsld+=$qty;
        if(!isset($sdsary[$pid])){$sqlpsh.="OR strspdtnum='$pid' ";$sdsary=$sdsary+[$pid=>[$qnty=>$qty.":".$qnty]];}
        else{$sdsary[$pid]=$sdsary[$pid]+[$qnty=>$qty.":".$qnty];}
        }$sqlpsh=substr($sqlpsh,3);
        $query=$conn->query("SELECT strspdtnum,pdttlpchs FROM prdcsinstr WHERE $sqlpsh;");
        if($query){if($query->num_rows>0){while($row=$query->fetch_assoc()){
            $pid=$row['strspdtnum'];$nwsmt="";$prc=explode(",",$this->sbldc($row["pdttlpchs"],$this->strec));
            foreach ($prc as $idx => $prc) {
                $sld=explode(":",$prc);
                if(isset($sdsary[$pid][$sld[0]])){$qy=explode(":",$sdsary[$pid][$sld[0]]);$nwsmt.=$qy[1].":".$sld[1]+$qy[0].",";}else{$nwsmt.=$prc.",";}
            }$nwsmt=$this->sblen(substr($nwsmt,0,-1),$this->strec,'strix');
            $conn->query("UPDATE prdcsinstr SET pdttlpchs ='$nwsmt' WHERE strspdtnum ='$pid' AND strnmr='$sid';");
        }}}
        $sql="SELECT strigtdt1,strigtdt2,strodrs1,strodrs2,strtrvnu1,strtrvnu2,strtpdsld1,strtpdsld2 FROM stsinmtplc WHERE stnmr='$strogid' LIMIT 1;";
        $query=$conn->query($sql);
        if($query){if($query->num_rows>0){
            $strovrw=$query->fetch_assoc();
            $d1=$this->dec($strovrw['strigtdt1'],$this->strec);
            $d2=$this->dec($strovrw['strigtdt2'],$this->strec);
            date_default_timezone_set("Asia/kolkata");
            $date=date("d-m-Y");$tdo="";$rdo="";$pdo="";
            $ydt=date('d-m-Y',strtotime("-1 days"));
            if($date==$d1){
                $tdo=$this->dec($strovrw['strodrs1'],$this->strec);
                $rdo=$this->dec($strovrw['strtrvnu1'],$this->strec);
                $pdo=$this->dec($strovrw['strtpdsld1'],$this->strec);
            }elseif($date==$d2){
                $tdo=$this->dec($strovrw['strodrs2'],$this->strec);
                $rdo=$this->dec($strovrw['strtrvnu2'],$this->strec);
                $pdo=$this->dec($strovrw['strtpdsld2'],$this->strec);
            }elseif($ydt==$d1&&$date!=$d2&&$date!=$d1){
                $tdo=$this->dec($strovrw['strodrs2'],$this->strec);
                $rdo=$this->dec($strovrw['strtrvnu2'],$this->strec);
                $pdo=$this->dec($strovrw['strtpdsld2'],$this->strec);
            }elseif($ydt==$d2&&$date!=$d1&&$date!=$d2){
                $tdo=$this->dec($strovrw['strodrs1'],$this->strec);
                $rdo=$this->dec($strovrw['strtrvnu1'],$this->strec);
                $pdo=$this->dec($strovrw['strtpdsld1'],$this->strec);
            }else{
                $tdo=$this->dec($strovrw['strodrs1'],$this->strec);
                $rdo=$this->dec($strovrw['strtrvnu1'],$this->strec);
                $pdo=$this->dec($strovrw['strtpdsld1'],$this->strec);
            }$tdo=$tdo!=""?$tdo:0;$rdo=$rdo!=""?$rdo:0;$pdo=$pdo!=""?$pdo:0;
            $stupdt="";
            $tdo=$this->enc($tdo + 1,$this->strec,'strix');
            $rdo=$this->enc($rdo + $trnvu,$this->strec,'strix');
            $pdo=$this->enc($pdo + $altpdsld,$this->strec,'strix');
            if($date==$d1){$stupdt="strodrs1='$tdo',strtrvnu1='$rdo',strtpdsld1='$pdo'";}
            elseif($date==$d2){$stupdt="strodrs2='$tdo',strtrvnu2='$rdo',strtpdsld2='$pdo'";}
            elseif($date!=$d2&&$date!=$d1){
                $date=$this->enc($date,$this->strec,'strix');
                if(strtotime($d1)>strtotime($d2)){$stupdt="strodrs2='$tdo',strtrvnu2='$rdo',strtpdsld2='$pdo',strigtdt2='$date'";}
                else{$stupdt="strodrs1='$tdo',strtrvnu1='$rdo',strtpdsld1='$pdo',strigtdt1='$date'";}
            }
            $conn->query("UPDATE stsinmtplc SET $stupdt WHERE stnmr='$strogid';");
        }}
    }
    public function updtpdtigs($igtp,$pid,$sid,$pvig,$fls){
        $conn=$this->connect();
        $igtp=htmlentities(mysqli_real_escape_string($conn,$igtp));
        $pd=$this->dec(htmlentities(mysqli_real_escape_string($conn,$pid)),$this->strec);
        $stronr=$this->enc(htmlentities(mysqli_real_escape_string($conn,$_SESSION['ssndi'])),$this->iky,'idx');
        $sd=htmlentities(mysqli_real_escape_string($conn,$sid));
        $pvg=htmlentities(mysqli_real_escape_string($conn,$pvig));
        $pvg=str_replace("http://localhost/remindo","..",$pvg);
        $img64=htmlentities(mysqli_real_escape_string($conn,$fls));
        $img64 = explode(';base64,', $img64);
        if(strlen($img64[1])>0){
            $data = base64_decode($img64[1]);
            $newName=time()."."."jpg";
                if($igtp=="csulptig"){$path="../strpdtspcs/".$newName;}
                elseif($igtp=="igfrlvml"){$path="../srptlvmdlpcs/".$newName;}
                if(!file_exists($path)){
                    if(file_put_contents($path, $data)){
                        if(file_exists($pvg)&&$pvg!=""&&$pvg!="pflmgs/defa.png"&&$path!="../pflmgs/defa.png"){unlink(htmlentities($pvg));}
                    if($igtp=="csulptig"){
                    $sql="SELECT prdtpto FROM prdcsinstr WHERE strspdtnum='$pd' AND strnmr='$sd' AND stronrnmr='$stronr';";
                    $query=$conn->query($sql);
                    if($query){
                        if($query->num_rows>0){
                            $row=$query->fetch_assoc();
                            $pvig=str_replace("../strpdtspcs/","",$pvg);
                            $pdpic=$this->dec($row['prdtpto'],$this->strec);
                            $pdpc=explode("/,",$pdpic);$pg="";
                            if(in_array($pvig,$pdpc)){
                              $pdpc[array_search($pvig,$pdpc)]=$newName;
                            }else{
                              array_push($pdpc,$newName);
                            }
                            foreach ($pdpc as $idx=>$pig) {
                            if($idx < 4){
                              if($idx < count($pdpc)-1 && $idx < 4){$pg.=$pig."/,";}
                              else{$pg.=$pig;}}
                            }$plntxt=$pg;
                            $pg=$this->enc($pg,$this->strec,'mtr');
                            $sql="UPDATE prdcsinstr SET prdtpto='$pg' WHERE strspdtnum='$pd' AND strnmr='$sd' AND stronrnmr='$stronr';";
                            if($conn->query($sql)){
                                echo $path."/|/".$plntxt;
                            }else{
                                if(file_exists($path)&&$path!=""&&$path!="pflmgs/defa.png"&&$path!="../pflmgs/defa.png"){unlink(htmlentities($path));}return 0;}
                        }else{
                            if(file_exists($path)&&$path!=""&&$path!="pflmgs/defa.png"&&$path!="../pflmgs/defa.png"){unlink(htmlentities($path));}return 0;}
                    }else{
                        if(file_exists($path)&&$path!=""&&$path!="pflmgs/defa.png"&&$path!="../pflmgs/defa.png"){unlink(htmlentities($path));}}
                    }elseif($igtp=="igfrlvml"){
                        $lvig=$this->enc($newName,$this->strec,'mtr');
                        $sql="UPDATE prdcsinstr SET pdtlvmdlig='$lvig' WHERE strspdtnum='$pd' AND strnmr='$sd' AND stronrnmr='$stronr';";
                        if($conn->query($sql)){
                            if(file_exists($pvg)&&$pvg!=""&&$pvg!="pflmgs/defa.png"&&$path!="../pflmgs/defa.png"){unlink(htmlentities($pvg));}
                            echo $path;
                        }else{if(file_exists($path)&&$path!=""&&$path!="pflmgs/defa.png"&&$path!="../pflmgs/defa.png"){unlink(htmlentities($path));}}
                    }
                }
                }
        }else{return "e0";}
    }
    public function rmvslctdptig($igtp,$rvpig,$pid,$sid){
        $conn=$this->connect();
        $igtp=htmlentities(mysqli_real_escape_string($conn,$igtp));
        $pd=$this->dec(htmlentities(mysqli_real_escape_string($conn,$pid)),$this->strec);
        $stronr=$this->enc(htmlentities(mysqli_real_escape_string($conn,$_SESSION['ssndi'])),$this->iky,'idx');
        $sd=htmlentities(mysqli_real_escape_string($conn,$sid));
        $pvig=htmlentities(mysqli_real_escape_string($conn,$rvpig));
        $pvig=str_replace("http://localhost/remindo","..",$pvig);
        $path=$pvig;
        if($igtp=="csulptig"){
            $sql="SELECT prdtpto FROM prdcsinstr WHERE strspdtnum='$pd' AND strnmr='$sd' AND stronrnmr='$stronr';";
            $query=$conn->query($sql);
            if($query){
                if($query->num_rows>0){
                    $row=$query->fetch_assoc();
                    $pvig=str_replace("../strpdtspcs/","",$pvig);
                    $pdpic=$this->dec($row['prdtpto'],$this->strec);
                    $pdpc=explode("/,",$pdpic);$pg="";
                    if(in_array($pvig,$pdpc)){
                        array_splice($pdpc,array_search($pvig,$pdpc),1);
                    }
                    foreach ($pdpc as $idx=>$pig) {
                        if(in_array("",$pdpc)){
                            array_splice($pdpc,array_search("",$pdpc),1);
                        }
                    if($idx < 4){
                        if($idx < count($pdpc)-1 && $idx < 4){$pg.=$pig."/,";}
                        else{$pg.=$pig;}}
                    }$plntxt=$pg;
                    $pg=$this->enc($pg,$this->strec,'mtr');
                    $sql="UPDATE prdcsinstr SET prdtpto='$pg' WHERE strspdtnum='$pd' AND strnmr='$sd';";
                    if($conn->query($sql)){
                        if(file_exists($path)&&$path!=""&&$path!="pflmgs/defa.png"&&$path!="../pflmgs/defa.png"){unlink(htmlentities($path));}
                        return $plntxt;
                    }else{return 0;}
                }
            }else{return 0;}
        }elseif($igtp=="igfrlvml"){
            $lvig=$this->enc("",$this->strec,'mtr');
            $sql="UPDATE prdcsinstr SET pdtlvmdlig='$lvig' WHERE strspdtnum='$pd' AND strnmr='$sd' AND stronrnmr='$stronr';";
            if($conn->query($sql)){
                if(file_exists($path)&&$path!=""&&$path!="pflmgs/defa.png"&&$path!="../pflmgs/defa.png"){unlink(htmlentities($path));}
                return 1;
            }else{return 0;}
        }
    }
    public function uptvom($s,$p,$vom){
        $conn=$this->connect();
        $sid=$this->enc($this->dec(htmlentities(mysqli_real_escape_string($conn,$s)),$this->strec),$this->strec,'strix');
        $pid=$this->sbldc(htmlentities(mysqli_real_escape_string($conn,$p)),$this->strec);
        $vom=htmlentities(mysqli_real_escape_string($conn,$vom));
        if($vom=="v"){$conn->query("UPDATE prdcsinstr SET pdtlrgvws=pdtlrgvws+1 WHERE strspdtnum='$pid' AND strnmr='$sid';");}
        elseif($vom=="m"){$conn->query("UPDATE prdcsinstr SET pdtmhmes=pdtmhmes+1 WHERE strspdtnum='$pid' AND strnmr='$sid';");}
    }
}
$pdts = new strprdts();
if(isset($_POST['adnwptdls'])&&$_POST['adnwptdls']=="adnwpdt"){
    if(isset($_POST['sid'])&&isset($_POST['pdtnm'])&&isset($_POST['ptqny'])&&isset($_POST['pmabs'])&&isset($_POST['pdsksts'])&&isset($_POST['pfrs'])&&isset($_POST['lstuts'])&&isset($_POST['pz'])&&isset($_POST['tz'])&&isset($_POST['nmslds'])){
        echo $pdts->adnwpdtstxtsigs($_POST['sid'],$_POST['pdtnm'],$_POST['ptqny'],$_POST['pdsksts'],$_POST['lstuts'],$_POST['pz'],$_POST['tz'],$_POST['pfrs'],$_POST['pmabs'],$_POST['nmslds'],isset($_FILES['lvmdl'])?$_FILES["lvmdl"]:$_POST["lvmdl"],isset($_FILES["file"])?$_FILES['file']:"");
    }
}
if(isset($_POST['nwedtdpdls'])&&$_POST['nwedtdpdls']=="etpdls"){
    if(isset($_POST['pid'])&&isset($_POST['sid'])&&isset($_POST['pdtnm'])&&isset($_POST['ptqny'])&&isset($_POST['pmabs'])&&isset($_POST['pfrs'])&&isset($_POST['lstuts'])&&isset($_POST['pz'])&&isset($_POST['tz'])&&isset($_POST['nmslds'])){
        echo $pdts->nwudtpdls($_POST['pid'],$_POST['sid'],$_POST['pdtnm'],$_POST['ptqny'],$_POST['pmabs'],$_POST['pfrs'],$_POST['lstuts'],$_POST['pz'],$_POST['tz'],$_POST['nmslds']);}
}
if(isset($_POST['istk'])&&$_POST['istk']=='edisktre'){
    if(isset($_POST['sd'])&&isset($_POST['pd'])&&isset($_POST['ud'])){
        echo $pdts->updtstck($_POST['sd'],$_POST['pd'],$_POST['ud']);
    }
}
if(isset($_POST['dtpdt'])&&$_POST['dtpdt']=='dtpdtre'){
    if(isset($_POST['s'])&&isset($_POST['p'])&&isset($_POST['pi'])&&isset($_POST['lpc'])){
        echo $pdts->dltprdt($_POST['s'],$_POST['p'],$_POST['pi'],$_POST['lpc']);
    }
}
if(isset($_POST['uppdtnmr'])&&$_POST['uppdtnmr']=='ystreupnmr'&&isset($_POST['p'])&&isset($_POST['s'])){
    echo $pdts->udtpdtbydnmr($_POST['p'],$_POST['s']);
}
if(isset($_POST['udtpdtpcs'])&&$_POST['udtpdtpcs']=="treuppdtpcs"&&isset($_POST['igtp'])&&isset($_POST['pdtid'])&&isset($_POST['srid'])&&isset($_POST['pdpstpc'])){
 echo $pdts->updtpdtigs($_POST['igtp'],$_POST['pdtid'],$_POST['srid'],$_POST['pdpstpc'],$_POST['file']);
}
if(isset($_POST['udtptrmvpcs'])&&$_POST['udtptrmvpcs']=="trervuppdtpcs"&&isset($_POST['pigtp'])&&isset($_POST['pdtid'])&&isset($_POST['srid'])&&isset($_POST['pdpstpc'])){
 echo $pdts->rmvslctdptig($_POST['pigtp'],$_POST['pdpstpc'],$_POST['pdtid'],$_POST['srid']);
}
if(isset($_POST['uptvom'])&&$_POST['uptvom']=="treuptvom"&&isset($_POST['s'])&&isset($_POST['p'])&&isset($_POST['vom'])){
    echo $pdts->uptvom($_POST['s'],$_POST['p'],$_POST['vom']);
}
?>