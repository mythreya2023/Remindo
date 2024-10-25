<?php
session_start();
include '../db_conn.php';
class stritrxns extends dbconnect{
    public function isthodr($sid,$tim,$odrctnt,$odsts,$pmtsts){
        $conn=$this->connect();
        $decstrid=$this->dec(htmlentities(mysqli_real_escape_string($conn,$sid)),$this->strec);
        $csmrid=$this->enc(htmlentities($_SESSION['ssndi']),$this->iky,'idx');
        $strid=$this->enc($decstrid,$this->strec,'strix');
        $tm=$this->enc(htmlentities(mysqli_real_escape_string($conn,$tim)),$this->strec,'mtr');
        $orcnt=$this->enc(htmlentities(mysqli_real_escape_string($conn,$odrctnt)),$this->strec,'mtr');
        $orsts=$this->enc(htmlentities(mysqli_real_escape_string($conn,$odsts)),$this->strec,'strix');
        $pmtstss=$this->enc(htmlentities(mysqli_real_escape_string($conn,$pmtsts)),$this->strec,'mtr');
        $sql="INSERT INTO pplstsodrmrrs(odrcsmrnmr,odrstnmr,odrcntnt,odrplcdtm,odrsts,odrpmtsts)VALUES('$csmrid','$strid','$orcnt','$tm','$orsts','$pmtstss');";
        $query=$conn->query($sql);
        if($query){
        $lstid=$conn->insert_id;$lsodr=$this->enc($lstid,$this->strec,'mtr');
        $lmodspkd="";$lmodrnonenc="";$opns="";$rvs="";$strd=$decstrid;
        $qurysql=$conn->query("SELECT stropnsts,strsodrrcvngsts,strodrlmts FROM stsinmtplc WHERE stnmr='$strd';");
        if($qurysql){
            if($qurysql->num_rows>0){
                $row=$qurysql->fetch_assoc();
                if($row['strodrlmts']!="OjrINsLDwFxV9lUsEvfOaBhk"&&trim($row['strodrlmts'])!=""){
                $odrchd=explode("||",$this->dec($row['strodrlmts'],$this->strec));
                if($odrchd[1]>0){
                    $lmodrnonenc=$odrchd[1]-1;
                    $lmodspkd=$this->enc($odrchd[0]."||".($odrchd[1]-1),$this->strec,'mtr');
                }else{return json_encode(array("l"=>$lsodr,"d"=>1,"rs"=>0));}
                }
                $opns=$this->dec($row['stropnsts'],$this->strec);
                $rvs=$this->dec($row['strsodrrcvngsts'],$this->strec);
                if($rvs=="1"){
                    if($conn->query("UPDATE pplstsodrmrrs SET odrsts='RlE9PTo6MTIzMjU2NzM5MTA0MTEyMQ==' WHERE odrmrnmr='$lstid' AND odrcsmrnmr='$csmrid' AND odrstnmr='$strid';")){
                    if($lmodspkd!=""){$iskupt="";
                    if($lmodrnonenc!=""&&$lmodrnonenc==0){$iskupt=", strsodrrcvngsts='RkE9PTo6MTIzMjU2NzM5MTA0MTEyMQ=='";}
                    $conn->query("UPDATE stsinmtplc SET strodrlmts='$lmodspkd' $iskupt WHERE stnmr='$decstrid';");}
                    $this->pshnfmsngr("str",$strd,htmlentities($_SESSION['ssndi']),"todrs");
                    }
                }
            }
        }
        return json_encode(array("l"=>$lsodr,"d"=>1,"os"=>$opns,"rs"=>$rvs));}else{return json_encod(array("l"=>$lsodr,"d"=>0));}
    }
    public function chckstrsts($sid){
        $conn=$this->connect();
        $strd=$this->dec(htmlentities(mysqli_real_escape_string($conn,$sid)),$this->strec);
        $qurysql=$conn->query("SELECT stropnsts,strsodrrcvngsts FROM stsinmtplc WHERE stnmr='$strd';");
        if($qurysql){
            if($qurysql->num_rows>0){
                $row=$qurysql->fetch_assoc();
                $opns=$this->dec($row['stropnsts'],$this->strec);
                $rvs=$this->dec($row['strsodrrcvngsts'],$this->strec);
            }
        return json_encode(array("d"=>1,"os"=>$opns,"rs"=>$rvs));
        }else{return json_encod(array("d"=>0));}
    }
    public function utosndsts($od,$sid,$odsts,$odrpts){
        $conn=$this->connect();
        $csmrid=$this->enc(htmlentities($_SESSION['ssndi']),$this->iky,'idx');
        $oid=$this->dec(htmlentities(mysqli_real_escape_string($conn,$od)),$this->strec);
        $stid=$this->dec(htmlentities(mysqli_real_escape_string($conn,$sid)),$this->strec);
        $strid=$this->enc($stid,$this->strec,'strix');
        $orsts=$this->enc(htmlentities(mysqli_real_escape_string($conn,$odsts)),$this->strec,'strix');
        $orpts=$this->enc(htmlentities(mysqli_real_escape_string($conn,$odrpts)),$this->strec,'mtr');
        $sql="UPDATE pplstsodrmrrs SET odrsts='$orsts',odrpmtsts='$orpts' WHERE odrmrnmr='$oid' AND odrcsmrnmr='$csmrid' AND odrstnmr='$strid';";
        $query=$conn->query($sql);
        if($query){if($odrpts=="CAS"){$this->trckodrs("CAS");$this->pshnfmsngr("str",19,htmlentities($_SESSION['ssndi']),"todrs");}return 1;}else{return 0;}
    }
    public function updtodrsts($o,$sid,$cid,$sts,$cg,$gt){
        $conn=$this->connect();
        $oid=$this->dec(htmlentities(mysqli_real_escape_string($conn,$o)),$this->strec);
        $strid=$this->enc($this->dec(htmlentities(mysqli_real_escape_string($conn,$sid)),$this->strec),$this->strec,'strix');
        $cmrid=$this->enc($this->dec(htmlentities(mysqli_real_escape_string($conn,$cid)),$this->iky),$this->iky,'idx');
        $odrsts=$this->enc(mysqli_real_escape_string($conn,$sts),$this->strec,'strix');
        $ccg=$this->enc(mysqli_real_escape_string($conn,$cg),$this->strec,'mtr');
        $gst=$this->enc(mysqli_real_escape_string($conn,$gt),$this->strec,'mtr');
        $sql="UPDATE pplstsodrmrrs SET odrsts='$odrsts',odrcrcg='$ccg',odrgstxpc='$gst' WHERE odrmrnmr='$oid' AND odrcsmrnmr='$cmrid' AND odrstnmr='$strid';";
        $query=$conn->query($sql);
        if($query){if($sts==2){$this->notify($strid,$cmrid,"abtodr","Your order is packing!..");$this->pshnfmsngr("cstm",$this->dec($sid,$this->strec),$this->dec($cmrid,$this->iky),"abodrpkng");}elseif($sts!=2){$this->notify($strid,$cmrid,"abtodr","Your order is packed! You can pay now.");$this->pshnfmsngr("cstm",$this->dec($sid,$this->strec),$this->dec($cmrid,$this->iky),"abodrpkd");
        $this->mailto($this->dec($cmrid,$this->iky),$this->dec($sid,$this->strec),"abodrpkd");return 1;}}else{if($sts!=2){return 0;}}
    }
    public function lvupdt($o,$sid){
        $conn=$this->connect();
        $oid=$this->dec(htmlentities(mysqli_real_escape_string($conn,$o)),$this->strec);
        $strid=$this->enc($this->dec(htmlentities(mysqli_real_escape_string($conn,$sid)),$this->strec),$this->strec,'strix');
        $cmrid=$this->enc(htmlentities(mysqli_real_escape_string($conn,$_SESSION['ssndi'])),$this->iky,'idx');
        $sql="SELECT odrsts FROM pplstsodrmrrs WHERE odrmrnmr='$oid' AND odrcsmrnmr='$cmrid' AND odrstnmr='$strid';";
        $query=$conn->query($sql);
        if($query){
            if($query->num_rows>0){
                $row=$query->fetch_assoc();return $this->dec($row['odrsts'],$this->strec);
            }
        }else{return 0;}
    }
    public function delodr($o,$sid){
        $conn=$this->connect();
        $oid=$this->dec(htmlentities(mysqli_real_escape_string($conn,$o)),$this->strec);
        $strid=$this->enc($this->dec(htmlentities(mysqli_real_escape_string($conn,$sid)),$this->strec),$this->strec,'strix');
        $cmrid=$this->enc(htmlentities(mysqli_real_escape_string($conn,$_SESSION['ssndi'])),$this->iky,'idx');
        $sql="DELETE FROM  pplstsodrmrrs WHERE odrmrnmr='$oid' AND odrstnmr='$strid' AND odrcsmrnmr='$cmrid';";
        $query=$conn->query($sql);
        if($query){return 1;}else{return 0;}
    }
    public function unpnstrcmronn($sid){
        $conn=$this->connect();
        $strid=$this->enc($this->dec(htmlentities(mysqli_real_escape_string($conn,$sid)),$this->strec),$this->strec,'strix');
        $cmrid=$this->enc(htmlentities(mysqli_real_escape_string($conn,$_SESSION['ssndi'])),$this->iky,'idx');
        $sql="DELETE FROM stspdbycstms WHERE stsnm='$strid' AND stscmnm='$cmrid';";
        $query=$conn->query($sql);
        if($query){
            $stid=$this->dec(htmlentities(mysqli_real_escape_string($conn,$sid)),$this->strec);
            $conn->query("UPDATE stsinmtplc SET strstcmspnd=strstcmspnd-1 WHERE stnmr='$stid';");
            $query=$conn->query("DELETE FROM pplstsodrmrrs WHERE odrstnmr='$strid' AND odrcsmrnmr='$cmrid';");
            return 1;
        }else{return 0;}
    }
    public function fhntfy($sid,$tp){
        $conn=$this->connect();
        $strid=$this->enc($this->dec(htmlentities(mysqli_real_escape_string($conn,$sid)),$this->strec),$this->strec,'strix');
        $cmrid=$this->enc(htmlentities(mysqli_real_escape_string($conn,$_SESSION['ssndi'])),$this->iky,'idx');
        $notyp=$this->enc(htmlentities(mysqli_real_escape_string($conn,"spmtak")),$this->strec,"strix");
        $nfond=$this->enc(0,$this->strec,"strix");
        if($tp=='crs'){$sql="SELECT nid,sndr,ntfymg,ntfopnd FROM alntfcns WHERE rcvr='$strid' AND sndr='$cmrid' AND ntftyp='$notyp' ORDER BY 1 DESC LIMIT 1;";}
        elseif($tp=='str'){$sql="SELECT nid,sndr,ntfymg,ntfopnd FROM alntfcns WHERE rcvr='$strid' AND ntftyp='$notyp' AND ntfopnd='$nfond' ORDER BY 1 DESC LIMIT 1;";}
        $query=$conn->query($sql);
        if($query){
            if($query->num_rows>0){
                $row=$query->fetch_assoc();
                $nmg=$this->dec($row['ntfymg'],$this->strec);
                $cd=$row['sndr'];$nd=$this->enc($row['nid'],$this->strec,'mtr');
                if($this->dec($row['ntfopnd'],$this->strec)=="1"){
                    $d="d1";
                    $nidd=$row['nid'];
                    $conn->query("DELETE FROM alntfcns WHERE rcvr='$strid' AND sndr='$cmrid' AND ntftyp='$notyp';");
                }
                elseif($this->dec($row['ntfopnd'],$this->strec)=="0"){
                    $d="d0";
                }
                return json_encode(array(
                    "nmg"=>$nmg,
                    "d"=>$d,
                    "cd"=>$cd,
                    "nd"=>$nd,
                ));
            }
        }else{return 0;}
    }
    public function udtnfspmsn($nid,$tpp,$s,$c){
        $conn=$this->connect();
        $strid=$this->enc($this->dec(htmlentities(mysqli_real_escape_string($conn,$s)),$this->strec),$this->strec,'strix');
        $ndd=$this->dec(htmlentities(mysqli_real_escape_string($conn,$nid)),$this->strec);
        if($tpp=="fspg"){$cmrid=$this->enc($this->dec(htmlentities(mysqli_real_escape_string($conn,$c)),$this->iky),$this->iky,'idx');}
        elseif($tpp=="fhmpg"){$cmrid=$this->dec(htmlentities(mysqli_real_escape_string($conn,$c)),$this->strec);}
        $notyp=$this->enc(htmlentities(mysqli_real_escape_string($conn,"spmtak")),$this->strec,"strix");
        $nfond=$this->enc(1,$this->strec,"strix");
        $sql="UPDATE alntfcns SET ntfopnd='$nfond' WHERE nid='$ndd' AND rcvr='$strid' AND sndr='$cmrid' AND ntftyp='$notyp';";
        if($conn->query($sql)){
            $oodsts=$this->enc(0,$this->strec,'strix');
            $oodstsn1=$this->enc(-1,$this->strec,'strix');
            $odrsts=$this->enc(1,$this->strec,'strix');
            if($conn->query("UPDATE pplstsodrmrrs SET odrsts='$odrsts' WHERE odrstnmr='$strid' AND odrcsmrnmr='$cmrid' AND (odrsts='$oodsts' OR odrsts='$oodstsn1');")){
                $this->trckodrs("ppd");
            $this->notify($strid,$cmrid,"mnyrcvd","Your payment recieved by the store!");
            $this->pshnfmsngr("cstm",$this->dec($s,$this->strec),$this->dec($cmrid,$this->iky),"apmtr");
            $this->mailto($this->dec($cmrid,$this->iky),$this->dec($s,$this->strec),"apmtr");
            }
            return 1;}else{return 0;}
    }
    public function delntfcns($nid,$sdr){
        $conn=$this->connect();
        $ntid=$this->dec(htmlentities($nid),$this->strec);
        $sndr=$this->dec(htmlentities(mysqli_real_escape_string($conn,$sdr)),$this->strec);
        $rcvr=$this->enc(htmlentities($_SESSION['ssndi']),$this->iky,'idx');
        $sql="DELETE FROM alntfcns WHERE nid='$ntid' AND rcvr='$rcvr' AND sndr='$sndr';";
        if($conn->query($sql)){return 1;}else{return 0;}
    }
    public function delntysnonfcns($nid,$sdr,$rvr){
        $conn=$this->connect();
        $ntid=$this->dec(htmlentities($nid),$this->strec);
        $sndr=$this->dec(htmlentities(mysqli_real_escape_string($conn,$sdr)),$this->strec);
        $rcvr=$this->enc($this->dec(htmlentities(mysqli_real_escape_string($conn,$rvr)),$this->strec),$this->strec,'strix');
        $sql="DELETE FROM alntfcns WHERE nid='$ntid' AND rcvr='$rcvr' AND sndr='$sndr';";
        if($conn->query($sql)){return 1;}else{return 0;}
    }
    public function ec($a,$tp){
        if($tp=="iky"){
        return $this->enc($a,$this->iky,'idx');
        }else if($tp=="strec"){
        return $this->enc($a,$this->strec,'strix');}
    }
    public function ntfenc($n){
        return $this->enc($this->dec(htmlentities($n),$this->strec),$this->strec,'strix');
    }
    public function pmtvfcns($s,$c,$o){
    // echo $this->notify($this->ec($_SESSION['ssndi'],'iky'),$this->ntfenc($s),'spmtak',"Did you receive payment of ".$c."?");
    $conn=$this->connect();
    $sid=$this->enc($this->dec(htmlentities($s),$this->strec),$this->strec,'strix');
    $oid=$this->dec(htmlentities($o),$this->strec);
    $cid=$this->enc(htmlentities($_SESSION['ssndi']),$this->iky,'idx');
    $q=$this->enc("Did you receive payment of $c?",$this->strec,'mtr');
    $sql="UPDATE pplstsodrmrrs SET odrpmtsts='$q',odrsts='RUE9PTo6MTIzMjU2NzM5MTA0MTEyMQ==' WHERE odrmrnmr='$oid' AND odrstnmr='$sid' AND odrcsmrnmr='$cid';";
    if($conn->query($sql)){echo 1;}else{echo 0;};
    $this->pshnfmsngr("str",$this->dec(htmlentities($s),$this->strec),htmlentities($_SESSION['ssndi']),"todrs");
    }
    public function vfydpymtinpkdodstb($s,$c,$o,$yon,$dx){
        $pattern = "/\n/i";
        $dx=preg_replace($pattern, "br/br", $dx);
        $conn=$this->connect();$dstr=$this->dec(htmlentities($s),$this->strec);
        $sid=$this->enc($dstr,$this->strec,'strix');
        $oid=$this->dec(htmlentities($o),$this->strec);
        $dcmr=$this->dec(htmlentities($c),$this->strec);
        $cid=$this->enc($dcmr,$this->iky,'idx');
        $yon=htmlentities($yon);
        $q=$this->enc("ppd",$this->strec,'mtr');
        $dtx=$this->enc(htmlentities(mysqli_real_escape_string($conn,$dx)),$this->strec,'mtr');
        //RVE9PTo6MTIzMjU2NzM5MTA0MTEyMQ== | 5
        if($yon=='ys'){
        $sql="UPDATE pplstsodrmrrs SET odrpmtsts='$q',odrsts='RVE9PTo6MTIzMjU2NzM5MTA0MTEyMQ==' WHERE odrmrnmr='$oid' AND odrstnmr='$sid' AND odrcsmrnmr='$cid';";
        if($conn->query($sql)){echo 1;
            $this->notify($strid,$cmrid,"mnyrcvd","Your payment recieved by the store! Your order will be delivered.");
            $this->pshnfmsngr("cstm",$dstr,$dcmr,"apmtr");}else{echo 0;};
        }elseif($yon=="no"){
            $sql="UPDATE pplstsodrmrrs SET odrpmtsts='',odrsts='Rnc9PTo6MTIzMjU2NzM5MTA0MTEyMQ==' WHERE odrmrnmr='$oid' AND odrstnmr='$sid' AND odrcsmrnmr='$cid';";
            if($conn->query($sql)){echo 1;
                $this->notify($strid,$cmrid,"mnyrcvd","Your payment recieved by the store! Please check your payment method name and payment method profile name.");
                $this->pshnfmsngr("cstm",$dstr,$dcmr,"npmtgt");
            }else{echo 0;};}
        elseif($yon=="dx"){
            $sql="UPDATE pplstsodrmrrs SET odrdlvrydls='$dtx',odrsts='RWc9PTo6MTIzMjU2NzM5MTA0MTEyMQ==' WHERE odrmrnmr='$oid' AND odrstnmr='$sid' AND odrcsmrnmr='$cid';";
            if($conn->query($sql)){echo 1;
                $this->notify($strid,$cmrid,"odrstodlv","Your order sent to delevery by the store!".htmlentities(mysqli_real_escape_string($conn,$dx)));
                $this->pshnfmsngr("cstm",$dstr,$dcmr,"odstdlv/r/".htmlentities(mysqli_real_escape_string($conn,$dx)));
            }else{echo 0;};
        }
    }
    public function odrcvdstsupdt($o,$s,$osts){
        $conn=$this->connect();
        $dsid=$this->dec(htmlentities(mysqli_real_escape_string($conn,$s)),$this->strec);
        $sid=$this->enc($dsid,$this->strec,'strix');
        $oid=$this->dec(htmlentities(mysqli_real_escape_string($conn,$o)),$this->strec);
        $cid=$this->enc(htmlentities($_SESSION['ssndi']),$this->iky,'idx');
        $osts=htmlentities(mysqli_real_escape_string($conn,$osts));
        //RXc9PTo6MTIzMjU2NzM5MTA0MTEyMQ== - 7
        $ost="";
        if($osts=="dvrd"){
            $ost="RXc9PTo6MTIzMjU2NzM5MTA0MTEyMQ==";
        }elseif($osts=="podr"){
            $ost="RlE9PTo6MTIzMjU2NzM5MTA0MTEyMQ==";
        }
        $sql="UPDATE pplstsodrmrrs SET odrsts='$ost' WHERE odrmrnmr='$oid' AND odrstnmr='$sid' AND odrcsmrnmr='$cid';";
        if($conn->query($sql)){echo 1;}else{echo 0;};
    }
    public function dlnfcns($nd,$tp){
        $conn=$this->connect();
        $nids=htmlentities(mysqli_real_escape_string($conn,$nd));
        $ntp=htmlentities(mysqli_real_escape_string($conn,$tp));
        $rcvr=$this->enc(htmlentities($_SESSION['ssndi']),$this->iky,'idx');
        if($tp!="onopd"){$nds=explode(",",$nids);$nid="";
        foreach($nds as $nd){
            $nid=$this->dec($nd."==",$this->strec);
            if($ntp=="dlt"){$sql="DELETE FROM alntfcns WHERE nid='$nid' AND rcvr='$rcvr';";}elseif($ntp=="upt"){$opd="RlE9PTo6MTIzMjU2NzM5MTA0MTEyMQ==";$nopd="RkE9PTo6MTIzMjU2NzM5MTA0MTEyMQ==";$sql="UPDATE alntfcns SET ntfopnd='$opd' WHERE nid='$nid' AND rcvr='$rcvr' AND ntfopnd='$nopd';";}
            $conn->query($sql);
        }
        }else{$opd="RlE9PTo6MTIzMjU2NzM5MTA0MTEyMQ==";$nopd="RkE9PTo6MTIzMjU2NzM5MTA0MTEyMQ==";$sql="UPDATE alntfcns SET ntfopnd='$opd' WHERE nid='$nid' AND rcvr='$rcvr' AND ntfopnd='$nopd';";$conn->query($sql);
        }
    }
    public function psnlvupdls(){
        $conn=$this->connect();
        $usr=$this->enc(htmlentities(mysqli_real_escape_string($conn,$_SESSION['ssndi'])),$this->iky,'idx');$nosn="RkE9PTo6MTIzMjU2NzM5MTA0MTEyMQ==";
        $sql="SELECT COUNT(nid) AS tns FROM alntfcns WHERE rcvr='$usr' AND ntfysen='$nosn';";
        $query=$conn->query($sql);
        if($query){
            if($query->num_rows>0){return $query->fetch_assoc()['tns'];}
            else{return 0;}
        }else{return 'q0';}
    }
    public function updtlmodrs($s,$olm){
        $conn=$this->connect();
        $ds=$this->dec(htmlentities(mysqli_real_escape_string($conn,$s)),$this->strec);
        $olm=htmlentities(mysqli_real_escape_string($conn,$olm));
        $lonm=$this->enc($olm."||".$olm,$this->strec,'mtr');
        $sql="UPDATE stsinmtplc SET strodrlmts='$lonm' WHERE stnmr='$ds';";
        $query=$conn->query($sql);
        if($query){return 1;}else{return 0;}
    }
}
$cmrxns=new stritrxns();
if(isset($_POST['plcnwodr'])&&$_POST['plcnwodr']=="ystreplcngodr"&&isset($_POST['sid'])&&isset($_POST['odsts'])&&isset($_POST['tim'])&&isset($_POST['ocnt'])&&isset($_POST['pmsts'])){
    echo $cmrxns->isthodr($_POST['sid'],$_POST['tim'],$_POST['ocnt'],$_POST['odsts'],$_POST['pmsts']);
}
if(isset($_POST['afvuosts'])&&$_POST['afvuosts']=="ystrvfafsts"&&isset($_POST['sd'])&&isset($_POST['od'])&&isset($_POST['ots'])&&isset($_POST['opts'])){
 echo $cmrxns->utosndsts($_POST['od'],$_POST['sd'],$_POST['ots'],$_POST['opts']);
}
if(isset($_POST['udtodrsts'])&&$_POST['udtodrsts']=="ystrudtofodr"&&isset($_POST['o'])&&isset($_POST['sid'])&&isset($_POST['cid'])&&isset($_POST['sts'])&&isset($_POST['cg'])&&isset($_POST['gt'])){
    echo $cmrxns->updtodrsts($_POST['o'],$_POST['sid'],$_POST['cid'],$_POST['sts'],$_POST['cg'],$_POST['gt']);
}
if(isset($_POST['udtodrsts'])&&$_POST['udtodrsts']=="ystrudtofodr"&&isset($_POST['o'])&&isset($_POST['s'])&&$_POST['c']&&isset($_POST['yos'])){
    echo $cmrxns->vfydpymtinpkdodstb($_POST['s'],$_POST['c'],$_POST['o'],$_POST['yos'],isset($_POST['dtx'])?$_POST['dtx']:"");
}
if(isset($_POST['gtlvpds'])&&$_POST['gtlvpds']=="yslvpdts"&&isset($_POST['o'])&&isset($_POST['sid'])){
    echo $cmrxns->lvupdt($_POST['o'],$_POST['sid']);
}
if(isset($_POST['odrcvdupdt'])&&$_POST['odrcvdupdt']=="ysodcvpdts"&&isset($_POST['o'])&&isset($_POST['sid'])&&isset($_POST['sts'])){
    echo $cmrxns->odrcvdstsupdt($_POST['o'],$_POST['sid'],$_POST['sts']);
}
if(isset($_POST['dlorscmr'])&&$_POST['dlorscmr']=="ystrdlor"&&isset($_POST['o'])&&isset($_POST['s'])){
    echo $cmrxns->delodr($_POST['o'],$_POST['s']);
}
if(isset($_POST['unpnstr'])&&$_POST['unpnstr']=="trestrupn"&&isset($_POST['s'])){
    echo $cmrxns->unpnstrcmronn($_POST['s']);
}
if(isset($_POST['ntfisask'])&&$_POST['ntfisask']=="ysaskpttre"&&isset($_POST['c'])&&isset($_POST['s'])&&isset($_POST['o'])){
    $cmrxns->pmtvfcns($_POST['s'],$_POST['c'],$_POST['o']);
}
if(isset($_POST['ntfirply'])&&$_POST['ntfirply']=="ysrplypttre"&&isset($_POST['s'])){
    echo $cmrxns->fhntfy($_POST['s'],'crs');
}
if(isset($_POST['ntfirlysr'])&&$_POST['ntfirlysr']=="ysrlysrptre"&&isset($_POST['s'])){
    echo $cmrxns->fhntfy($_POST['s'],'str');
}
if(isset($_POST['strcvsts'])&&$_POST['strcvsts']=="ystrvforcvgsts"&&isset($_POST['s'])){
    echo $cmrxns->chckstrsts($_POST['s'],'str');
}
if(isset($_POST['nfupd1'])&&$_POST['nfupd1']=="ysnfup1tre"&&isset($_POST['n'])&&isset($_POST['tp'])&&isset($_POST['s'])&&isset($_POST['c'])){
    echo $cmrxns->udtnfspmsn($_POST['n'],$_POST['tp'],$_POST['s'],$_POST['c']);
}
if(isset($_POST['dlntfcn'])&&$_POST['dlntfcn']=="ystrdlntfcn"&&isset($_POST['n'])&&isset($_POST['s'])){
    echo $cmrxns->delntfcns($_POST['n'],$_POST['s']);
}
if(isset($_POST['dlysn'])&&$_POST['dlysn']=="ystrdlnysnotfcn"&&isset($_POST['n'])&&isset($_POST['s'])&&isset($_POST['r'])){
    echo $cmrxns->delntysnonfcns($_POST['n'],$_POST['s'],$_POST['r']);
}
if(isset($_POST['crdnfcs'])&&$_POST['crdnfcs']=="slnfcscrd"&&isset($_POST['nd'])&&isset($_POST['uod'])){
    echo $cmrxns->dlnfcns($_POST['nd'],$_POST['uod']);
}
if(isset($_POST['usrpdtre'])&&isset($_POST['puid'])){
    echo $cmrxns->updtusrpshsrvce($_POST['puid']);
}
if(isset($_GET['lvutnfs'])&&$_GET['lvutnfs']=="trelupdsncs"&&isset($_SESSION['ssndi'])){
    echo $cmrxns->psnlvupdls();
}
if(isset($_POST['odlmt'])&&$_POST['odlmt']=="trelmtodr"&&isset($_POST['s'])&&isset($_POST['olm'])){
    echo $cmrxns->updtlmodrs($_POST['s'],$_POST['olm']);
}
?>