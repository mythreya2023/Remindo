<?php
session_start();
include '../db_conn.php';
class c extends dbconnect{
    public function img($sid,$pimg,$newName,$type){
        $userloginid=$this->enc(htmlentities($_SESSION['ssndi']),$this->iky,'idx');
        $nm=$this->enc($newName,$this->strec,'mtr');
        $str=$this->dec(htmlentities($sid),$this->strec);
        $uptyp="";$path="";
        if($type=="bsnstrcvpc"||$type=="rmvbncv"){$uptyp="strcvrpto";$path="../fhstsbsncvpcs/";if(file_exists($path.$pimg)){unlink("../fhstsbsncvpcs/".$pimg);}}
        elseif($type=="bnstrpfpt"||$type=="rmvbnpfpc"){$uptyp="strbprflig";$path="../fhupuppts/";if(file_exists($path.$pimg)){unlink("../fhupuppts/".$pimg);}}
        elseif($type=="upptpc"||$type=="rmvbnuppc"){$uptyp="strbupimg";$path="../qrstsbprfpcs/";if(file_exists($path.$pimg)){unlink("../qrstsbprfpcs/".$pimg);}}
        $sql_update_img="UPDATE stsinmtplc SET $uptyp='$nm' WHERE stnmr='$str' AND strbsnonr='$userloginid';";
        $query_update_img=$this->connect()->query($sql_update_img);
        if($query_update_img){echo $path.$newName;}
        else{if(file_exists($path.$newName)){unlink($path.$newName);}return "n0";}
    }
}
$c=new c();
$userloginid=$_SESSION['ssndi'];
if(isset($_POST['s'])&&isset($_POST['prigtcg'])&&isset($_POST['nwignm'])&&isset($_POST['ptp'])){
    $usrprvImg=htmlentities(mysqli_real_escape_string($conn,$_POST['prigtcg']));
    $usrprvImg=$usrprvImg==""?"-":$usrprvImg;
    $nm=htmlentities(mysqli_real_escape_string($conn,$_POST['nwignm']));
    $sid=htmlentities(mysqli_real_escape_string($conn,$_POST['s']));
    if($_POST['ptp']=='bnstrcvpt'){$tp="bsnstrcvpc";echo $c->img($sid,$usrprvImg,$nm,$tp);}
    elseif($_POST['ptp']=='bnstrpfpt'){$tp="bnstrpfpt";echo $c->img($sid,$usrprvImg,$nm,$tp);}
    elseif($_POST['ptp']=='bnstrppt'){$tp="upptpc";echo $c->img($sid,$usrprvImg,$nm,$tp);}
    elseif($_POST['ptp']=='rmvbncv'){$c->img($sid,$usrprvImg,"","rmvbncv");}
    elseif($_POST['ptp']=='rmvbnpfpc'){$c->img($sid,$usrprvImg,"","rmvbnpfpc");}
    elseif($_POST['ptp']=='rmvbnuppc'){$c->img($sid,$usrprvImg,"","rmvbnuppc");}

}
if(isset($_POST['dlppto'])&&$_POST['dlppto']=='tredlprpto'&&isset($_POST['ppto'])&&isset($_POST['tp'])){
    $pto=htmlentities(mysqli_real_escape_string($conn,$_POST['ppto']));
    $tp=htmlentities(mysqli_real_escape_string($conn,$_POST['tp']));
    if($tp=="bnstrcvpt"){$path="../fhstsbsncvpcs/".$pto;
        if(file_exists($path)){unlink($path);}
    }
    if($tp=="bnstrpfpt"){$path="../fhupuppts/".$pto;
        if(file_exists($path)){unlink($path);}
    }
    if($tp=="bnstrppt"){$path="../qrstsbprfpcs/".$pto;
        if(file_exists($path)){unlink($path);}
    }
}
?>