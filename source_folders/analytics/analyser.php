<?php
session_start();
include 'anls_db.php';
class anlysr extends anlysrcnct{
    public function tstrsusrs($as){
        $conn=$this->connectUsr();
        if(!$as){$sqlu="SELECT COUNT(usid) as num_rows FROM roupldls;";
        $query=$conn->query($sqlu);
        if($query){$tot=$query->fetch_object();$RmoUsrs=$tot->num_rows;}else{$RmoUsrs="0";}
        $sqls="SELECT COUNT(stnmr) as num_rows FROM stsinmtplc;";
        $query=$conn->query($sqls);
        if($query){$tot=$query->fetch_object();$Rmostrs=$tot->num_rows;}else{$Rmostrs="0";}}$srps=["Grocery","Book Store","Bakery","Supermarket","Stalls","Restarunt","Meat Center"];$sps=[];
        $strtps=["WThvcUxpT1k5NmtRdzNZalV3PT06OjEyMzI1NjczOTEwNDExMjE=","WnRjcUptYTUrdVl4MGc9PTo6MTIzMjU2NzM5MTA0MTEyMQ==","WnRrdUtEU1Q6OjEyMzI1NjczOTEwNDExMjE=","ZDgwMUtEVEt3K2d4M0h3bDo6MTIzMjU2NzM5MTA0MTEyMQ==","ZDh3a0lTbz06OjEyMzI1NjczOTEwNDExMjE=","ZHQwMk9TZWYvT2d0d3c9PTo6MTIzMjU2NzM5MTA0MTEyMQ==","YWQwa09XYXA2K2MzMG1zPTo6MTIzMjU2NzM5MTA0MTEyMQ=="];
        for($i=0;$i<=count($strtps)-1;$i++){
            $typ=$strtps[$i];
        $sqls="SELECT COUNT(stnmr) as num_rows FROM stsinmtplc WHERE strrctgre='$typ';";
        $query=$conn->query($sqls);
        if($query){$tot=$query->fetch_object();
            // array_push($srps,$tot->num_rows);
            $sps=$sps+[$srps[$i]=>[$tot->num_rows]];}
        }
        if(!$as){
        return json_encode(array(
            "tus"=>$RmoUsrs,
            "tsts"=>$Rmostrs,
            "al"=>$sps
        ));}else{return $sps;}
    }
    public function gtusrdta($uos,$yr,$mth,$dt,$only,$os,$lt){
        $conn=$this->connectanlysr();
        $uos=htmlentities(mysqli_real_escape_string($conn,$uos));
        $yr=htmlentities(mysqli_real_escape_string($conn,$yr));
        $mth=htmlentities(mysqli_real_escape_string($conn,$mth));
        $dt=htmlentities(mysqli_real_escape_string($conn,$dt));
        $os=htmlentities(mysqli_real_escape_string($conn,$os));
        $lt=htmlentities(mysqli_real_escape_string($conn,$lt));
        $show=htmlentities(mysqli_real_escape_string($conn,$only));
        $uyr=$this->enc($yr,$this->anlysr,"idx");
        $umth=$this->enc($mth,$this->anlysr,"idx");
        $udt=$this->enc($dt,$this->anlysr,"idx");
        if($uos=="odr"){
            if($show=="iyr"){
            $sql="SELECT * FROM anlodrs WHERE oyr='$uyr' ORDER BY 1 DESC LIMIT $os, $lt;";
            }else if($show=="imh"){
            $sql="SELECT * FROM anlodrs WHERE oyr='$uyr' AND odrmth='$umth' ORDER BY 1 DESC LIMIT $os, $lt;";
            }else if($show=="idt"){
            $sql="SELECT * FROM anlodrs WHERE oyr='$uyr' AND odrmth='$umth' AND odrdte='$udt' ORDER BY 1 DESC LIMIT $os, $lt;";
            }else{
            $sql="SELECT * FROM anlodrs ORDER BY 1 DESC LIMIT $os, $lt;";
            }
        }else{
        if($show=="iyr"){
        $sql=($uos=="u")?"SELECT * FROM anlurs WHERE uyr='$uyr' ORDER BY 1 DESC LIMIT $os, $lt;":"SELECT * FROM anlstrs WHERE srstpyr='$uyr' ORDER BY 1 DESC LIMIT $os, $lt;";
        }else if($show=="imh"){
        $sql=($uos=="u")?"SELECT * FROM anlurs WHERE uyr='$uyr' AND ujmth='$umth' ORDER BY 1 DESC LIMIT $os, $lt;":"SELECT * FROM anlstrs WHERE srstpyr='$uyr' AND srstpmth='$umth' ORDER BY 1 DESC LIMIT $os, $lt;";
        }else if($show=="idt"){
        $sql=($uos=="u")?"SELECT * FROM anlurs WHERE uyr='$uyr' AND ujmth='$umth' AND udtimth='$udt' ORDER BY 1 DESC LIMIT $os, $lt;":"SELECT * FROM anlstrs WHERE srstpyr='$uyr' AND srstpmth='$umth' AND srcrtdt='$udt' ORDER BY 1 DESC LIMIT $os, $lt;";
        }else{
        $sql=($uos=="u")?"SELECT * FROM anlurs ORDER BY 1 DESC LIMIT $os, $lt;":"SELECT * FROM anlstrs ORDER BY 1 DESC LIMIT $os, $lt;";
        }
        }
        $query=$conn->query($sql);
        if($query){
            if($query->num_rows>0){
                while($row=$query->fetch_assoc()){
                    $data[]=$row;
                }
                return $data;
            }else{return "0";}
        }else{return "q0";}
    }
    public function anlysusr($uos,$yr,$mth,$dt,$only,$os,$lt){
        date_default_timezone_set("Asia/kolkata");
        $usrToanls=$this->gtusrdta($uos,$yr,$mth,$dt,$only,$os,$lt);
        if($usrToanls!="q0"){
            if($usrToanls!=0){$row="";$tdy=0;$vsocs=[];$vsu=[];$vsopd=[];$ttlcas="";$ttlppd="";$ttlgcry="";$ttlbkstr="";$ttlbkry="";$ttlrstnt="";$ttmcntr="";$ttlstal="";$vsg=[];$vsbk=[];$vsbkry=[];$vsstl=[];$vsrstnt=[];$vsuall=[];
                foreach($usrToanls as $data){
                    if($uos=="u"){
                    $date_y=$this->dec($data['uyr'],$this->anlysr);$date_d=$this->dec($data['udtimth'],$this->anlysr);$date_m=$this->dec($data['ujmth'],$this->anlysr);
                    $date=$date_y."-".$date_m."-".$date_d;
                    $total=$this->dec($data['ujndondy'],$this->anlysr);
                    if($date==date("Y-m-d")){
                        $tdy=$this->dec($data['ujndondy'],$this->anlysr);
                    }
                    }
                    if($uos=="s"){
                    $date_y=$this->dec($data['srstpyr'],$this->anlysr);$date_d=$this->dec($data['srcrtdt'],$this->anlysr);$date_m=$this->dec($data['srstpmth'],$this->anlysr);
                    $date=$date_y."-".$date_m."-".$date_d;
                    $total=$this->dec($data['srctdody'],$this->anlysr);
                    $ttlgcry=$this->dec($data['strgcry'],$this->anlysr);$ttlbkstr=$this->dec($data['strbk'],$this->anlysr);
                    $ttlbkry=$this->dec($data['strbkry'],$this->anlysr);
                    $ttlrstnt=$this->dec($data['strrstnt'],$this->anlysr);
                    $ttlsprmrt=$this->dec($data['strsprmrt'],$this->anlysr);
                    $ttlstal=$this->dec($data['strstal'],$this->anlysr);
                    $ttmcntr=$this->dec($data['strmcntr'],$this->anlysr);
                    if($date==date("Y-m-d")){
                        $tdy=$this->dec($data['srctdody'],$this->anlysr);
                    }
                    }
                    if($uos=="odr"){
                    $date_y=$this->dec($data['oyr'],$this->anlysr);$date_d=$this->dec($data['odrdte'],$this->anlysr);$date_m=$this->dec($data['odrmth'],$this->anlysr);
                    $date=$date_y."-".$date_m."-".$date_d;
                    $total=$this->dec($data['orprdy'],$this->anlysr);
                    $ttlcas=$this->dec($data['odrbycas'],$this->anlysr);
                    $ttlppd=$this->dec($data['odrbyppd'],$this->anlysr);
                    if($date==date("Y-m-d")){
                        $tdy=$this->dec($data['orprdy'],$this->anlysr);
                    }
                    }
                    $date=date_create($date);
                    if($date_y!=date("Y")){$date=date_format($date,"d F Y");}
                    else{$date=date_format($date,"d F");}
                    $bcks="th";if($date_d==1){$bcks="st";}elseif($date_d==2){$bcks="nd";}elseif($date_d==3){$bcks="rd";}else{$bcks="th";}
                    $date=substr($date,0,2).$bcks.substr($date,2);
                    $row.="<div class='tbl_rws'><span class='clm_dt'>$date</span><span class='clm_ts'>$total</span>";
                    if($uos=="s"){$row.="<span class='clm_ts'>$ttlgcry</span><span class='clm_ts'>$ttlbkstr</span><span class='clm_ts'>$ttlbkry</span><span class='clm_ts'>$ttlsprmrt</span><span class='clm_ts'>$ttlstal</span><span class='clm_ts'>$ttmcntr</span><span class='clm_ts'>$ttlrstnt</span>";}
                    if($uos=="odr"){$row.="<span class='clm_ts'>$ttlcas</span><span class='clm_ts'>$ttlppd</span>";}
                    $row.="</div>";
                }
                $rtndata["data"]=$row;
                $rtndata["tdy"]=$tdy;
                if($uos=="u"){$rtndata["vsall"]=$this->vsulize("us",$yr,$mth,($only=="iyr")?"yr":(($only=="imh")?"mh":"all"))[0];}
                elseif($uos=="odr"){$rtndata["vsall"]=$this->vsulize("ods",$yr,$mth,($only=="iyr")?"yr":(($only=="imh")?"mh":"all"))[0];
                $rtndata['pmtcpr']=$this->vsulize("ods",$yr,$mth,($only=="iyr")?"yr":(($only=="imh")?"mh":"all"))[1];}
                elseif($uos=="s"){$rtndata["vsall"]=$this->vsulize("sr",$yr,$mth,($only=="iyr")?"yr":(($only=="imh")?"mh":"all"))[0];
                $rtndata['tscpsn']=($only=="all")?$this->tstrsusrs(true):$this->vsulize("sr",$yr,$mth,($only=="iyr")?"yr":(($only=="imh")?"mh":"all"))[1];}
                return json_encode($rtndata);
            }else{return json_encode(array(
                "data"=>0
            ));}
        }else{return json_encode(array(
            "data"=>"q0"
        ));}
    }
    public function vsulize($OoS,$yr,$mth,$vsby){
        date_default_timezone_set("Asia/kolkata");
        $conn=$this->connectanlysr();
        $show=htmlentities(mysqli_real_escape_string($conn,$OoS));
        $vsby=htmlentities(mysqli_real_escape_string($conn,$vsby));
        $vsual=[];$months=[];$mnths=[];$odrpmtcmpr=[];if($vsby=="all"){$yr=date("Y");$mth=date("m");};
        $uyr=$this->enc($yr,$this->anlysr,"idx");
        $umth=$this->enc($mth,$this->anlysr,"idx");
        if($vsby=="yr"){
        $sql=($show=="ods")?"SELECT DISTINCT odrmth AS mnth FROM anlodrs WHERE oyr='$uyr' ORDER BY 1 DESC;":(($show=="sr")?"SELECT DISTINCT srstpmth AS mnth FROM anlstrs WHERE srstpyr='$uyr' ORDER BY 1 DESC;":"SELECT DISTINCT ujmth AS mnth FROM anlurs WHERE uyr='$uyr' ORDER BY 1 DESC;");
        $query=$conn->query($sql);
        if($query){
            if($query->num_rows>0){
                while($row=$query->fetch_assoc()){
                    $data[]=$row;
                }
                $months=$data;
            }else{return "0";}
        }else{return "q0";}
        }else{
            $vsby="mh";
            $months=$months+[["mnth"=>$umth]];
        }
        $p=1;$date=0;$ttsmrt=0;$ttrsnt=0;$ttsr=0;$tcs=0;$tpd=0;$ttods=0;$tusr=0;
        $ttgcry=0;$ttbok=0;$ttbkry=0;$ttstal=0;$ttmcntr=0;$ttosbycs=0;$ttosbyppd=0;
        foreach($months as $month){
            $month=$month['mnth'];
        $sql=($show=="ods")?"SELECT odrdte,orprdy,odrbycas,odrbyppd FROM anlodrs WHERE oyr='$uyr' AND odrmth='$month' ORDER BY 1 DESC;":(($show=="sr")?"SELECT srcrtdt,srctdody,strgcry,strbk,strbkry,strsprmrt,strstal,strrstnt,strmcntr FROM anlstrs WHERE srstpyr='$uyr' AND srstpmth='$month' ORDER BY 1 DESC;":"SELECT udtimth,ujndondy FROM anlurs WHERE uyr='$uyr' AND ujmth='$month' ORDER BY 1 DESC;");
        $query=$conn->query($sql);
        if($query){
            if($query->num_rows>0){
                while($row=$query->fetch_assoc()){
                    if($show=="sr"){$date=$this->dec($row['srcrtdt'],$this->anlysr);
                    $ttsr+=$this->dec($row['srctdody'],$this->anlysr);
                    $ttgcry+=$this->dec($row['strgcry'],$this->anlysr);
                    $ttbok+=$this->dec($row['strbk'],$this->anlysr);
                    $ttbkry+=$this->dec($row['strbkry'],$this->anlysr);
                    $ttsmrt+=$this->dec($row['strsprmrt'],$this->anlysr);
                    $ttstal+=$this->dec($row['strstal'],$this->anlysr);
                    $ttrsnt+=$this->dec($row['strrstnt'],$this->anlysr);
                    $ttmcntr+=$this->dec($row['strmcntr'],$this->anlysr);}
                    if($vsby=="yr"){
                    if($show=="us"){
                    $date=$this->dec($row['udtimth'],$this->anlysr);
                    $tusr+=$this->dec($row['ujndondy'],$this->anlysr);
                    }
                    elseif($show=="ods"){
                    $date=$this->dec($row['odrdte'],$this->anlysr);
                    $ttods+=$this->dec($row['orprdy'],$this->anlysr);
                    $ttosbycs+=$this->dec($row['odrbycas'],$this->anlysr);
                    $ttosbyppd+=$this->dec($row['odrbyppd'],$this->anlysr);}
                    }elseif($vsby=="mh"){
                    if($show=="sr"){$date=$this->dec($row['srcrtdt'],$this->anlysr);
                    $ttdsr=$this->dec($row['srctdody'],$this->anlysr);
                    $ttdgcry=$this->dec($row['strgcry'],$this->anlysr);
                    $ttdbok=$this->dec($row['strbk'],$this->anlysr);
                    $ttdbkry=$this->dec($row['strbkry'],$this->anlysr);
                    $ttdsmrt=$this->dec($row['strsprmrt'],$this->anlysr);
                    $ttdstal=$this->dec($row['strstal'],$this->anlysr);
                    $ttdrsnt=$this->dec($row['strrstnt'],$this->anlysr);
                    $ttmcntr=$this->dec($row['strmcntr'],$this->anlysr);}
                    elseif($show=="ods"){
                    $date=$this->dec($row['odrdte'],$this->anlysr);
                    $ttods=$this->dec($row['orprdy'],$this->anlysr);
                    $ttosbycs=$this->dec($row['odrbycas'],$this->anlysr);
                    $ttosbyppd=$this->dec($row['odrbyppd'],$this->anlysr);}
                    elseif($show=="us"){
                    $date=$this->dec($row['udtimth'],$this->anlysr);
                    $tusr=$this->dec($row['ujndondy'],$this->anlysr);
                    }
                    }if($show=="ods"){
                    $tcs+=$this->dec($row['odrbycas'],$this->anlysr);
                    $tpd+=$this->dec($row['odrbyppd'],$this->anlysr);}
                 if($vsby=="mh"){if($show=="sr"){$vsual=$vsual+[$date=>[$date,$ttdsr,$ttdgcry,$ttdbok,$ttdbkry,$ttdsmrt,$ttdstal,$ttmcntr,$ttdrsnt]];}elseif($show=="ods"){$vsual=$vsual+[$date=>[$date,$ttods,$ttosbycs,$ttosbyppd]];}elseif($show=="us"){$vsual=$vsual+[$date=>[$date,$tusr]];}}
                }$decmth=$this->dec($month,$this->anlysr);
                 if($vsby=="yr"){if($show=="sr"){$vsual=$vsual+[$decmth=>[$decmth,$ttsr,$ttgcry,$ttbok,$ttbkry,$ttsmrt,$ttstal,$ttmcntr,$ttrsnt]];}elseif($show=="ods"){$vsual=$vsual+[$decmth=>[$decmth,$ttods,$ttosbycs,$ttosbyppd]];}elseif($show=="us"){$vsual=$vsual+[$decmth=>[$decmth,$tusr]];}}
            }else{return "0";}
        }else{return "q0";}
        }
        if($show=="ods"){$odrpmtcmpr=["C.A.S"=>[$tcs],"Prepaid"=>[$tpd]];}
        elseif($show=="sr"){$odrpmtcmpr=["Grocery"=>[$ttgcry],"Book Store"=>[$ttbok],"Bakery"=>[$ttbkry],"Supermarket"=>[$ttsmrt],"Stall"=>[$ttstal],"Restarunt"=>[$ttrsnt]];}
        return [$vsual,$odrpmtcmpr];
    }
}
$anlysr=new anlysr();
if(isset($_POST['tstcs'])){
    if($_POST['tstcs']=="treTlests"){
        echo $anlysr->tstrsusrs(false);
    }
}
if(isset($_POST['anlsurs'])){
    if($_POST['anlsurs']=="treursanls"&&isset($_POST['uy'])&&isset($_POST['um'])&&isset($_POST['ud'])&&isset($_POST['utp'])&&isset($_POST['o'])&&isset($_POST['l'])){
        echo $anlysr->anlysusr("u",$_POST['uy'],$_POST['um'],$_POST['ud'],$_POST['utp'],$_POST['o'],$_POST['l']);
    }
}
if(isset($_POST['anlssrs'])){
    if($_POST['anlssrs']=="trsrsanls"&&isset($_POST['sy'])&&isset($_POST['sm'])&&isset($_POST['sd'])&&isset($_POST['utp'])&&isset($_POST['o'])&&isset($_POST['l'])){
        echo $anlysr->anlysusr("s",$_POST['sy'],$_POST['sm'],$_POST['sd'],$_POST['utp'],$_POST['o'],$_POST['l']);
    }
}
if(isset($_POST['anlsors'])){
    if($_POST['anlsors']=="treodsanls"&&isset($_POST['oy'])&&isset($_POST['om'])&&isset($_POST['od'])&&isset($_POST['utp'])&&isset($_POST['o'])&&isset($_POST['l'])){
        echo $anlysr->anlysusr("odr",$_POST['oy'],$_POST['om'],$_POST['od'],$_POST['utp'],$_POST['o'],$_POST['l']);
    }
}
?>