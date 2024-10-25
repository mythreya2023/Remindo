<?php
include 'anls_db.php';
class track extends anlysrcnct{
    public function trckusrs(){
        $conn=$this->connectanlysr();
        date_default_timezone_set("Asia/kolkata");
        $uyr=$this->enc(date("Y"),$this->anlysr,"idx");
        $umth=$this->enc(date("m"),$this->anlysr,"idx");
        $udt=$this->enc(date("d"),$this->anlysr,"idx");
        $sql="SELECT * FROM anlurs WHERE uyr='$uyr' AND ujmth='$umth' AND udtimth='$udt' ORDER BY 1 DESC LIMIT 1;";
        $query=$conn->query($sql);
        if($query){
            if($query->num_rows>0){
                $row=$query->fetch_assoc();
                $pstdta=$this->dec($row['ujndondy'],$this->anlysr)+1;
                $trckd=$this->enc($pstdta,$this->anlysr,'idx');
            $sql="UPDATE anlurs SET ujndondy='$trckd' WHERE uyr='$uyr' AND ujmth='$umth' AND udtimth='$udt';";
            $query=$conn->query($sql);
            }else{
                $trckd=$this->enc(1,$this->anlysr,'idx');
                $sql="INSERT INTO anlurs(uyr,ujmth,udtimth,ujndondy) VALUES('$uyr','$umth','$udt','$trckd');";
                $query=$conn->query($sql);
            }
        }
    }
    public function trckstrs($srtp){
        $conn=$this->connectanlysr();
        if($srtp=="Grocery Store"){$srtp="g";}elseif($srtp=="Book Store"){$srtp="bks";}elseif($srtp=="Bakery"){$srtp="bkry";}elseif($srtp=="Super Market"){$srtp="mrt";}elseif($srtp=="Stall"){$srtp="stl";}elseif($srtp=="Restaurant"){$srtp="rsnt";}elseif($srtp=="Meat Center"){$srtp="mctr";}
        date_default_timezone_set("Asia/kolkata");
        $uyr=$this->enc(date("Y"),$this->anlysr,"idx");
        $umth=$this->enc(date("m"),$this->anlysr,"idx");
        $udt=$this->enc(date("d"),$this->anlysr,"idx");
        $srtp=htmlentities(mysqli_real_escape_string($conn,$srtp));
        $sql="SELECT * FROM anlstrs WHERE srstpyr='$uyr' AND srstpmth='$umth' AND srcrtdt='$udt' ORDER BY 1 DESC LIMIT 1;";
        $query=$conn->query($sql);
        if($query){
            if($query->num_rows>0){
                $row=$query->fetch_assoc();
                $tdodypstdta=$this->dec($row['srctdody'],$this->anlysr);
                $gcrypstdta=$this->dec($row['strgcry'],$this->anlysr);
                $bkpstdta=$this->dec($row['strbk'],$this->anlysr);
                $bkrypstdta=$this->dec($row['strbkry'],$this->anlysr);
                $mrtpstdta=$this->dec($row['strsprmrt'],$this->anlysr);
                $stlpstdta=$this->dec($row['strstal'],$this->anlysr);
                $rsntpstdta=$this->dec($row['strrstnt'],$this->anlysr);
                $mcntrpstdta=$this->dec($row['strmcntr'],$this->anlysr);
                $trckd=$this->enc($tdodypstdta+1,$this->anlysr,'idx');
                $gcrytrckd=$this->enc(($srtp=="g")?$gcrypstdta+1:$gcrypstdta,$this->anlysr,'idx');
                $bktrckd=$this->enc(($srtp=="bks")?$bkpstdta+1:$bkpstdta,$this->anlysr,'idx');
                $bkrytrckd=$this->enc(($srtp=="bkry")?$bkrypstdta+1:$bkrypstdta,$this->anlysr,'idx');
                $mrttrckd=$this->enc(($srtp=="mrt")?$mrtpstdta+1:$mrtpstdta,$this->anlysr,'idx');
                $stltrckd=$this->enc(($srtp=="stl")?$stlpstdta+1:$stlpstdta,$this->anlysr,'idx');
                $mcntrtrckd=$this->enc(($srtp=="mctr")?$mcntrpstdta+1:$mcntrpstdta,$this->anlysr,'idx');
                $rsnttrckd=$this->enc(($srtp=="rsnt")?$rsntpstdta+1:$rsntpstdta,$this->anlysr,'idx');
            $sql="UPDATE anlstrs SET srctdody='$trckd',strgcry='$gcrytrckd',strbk='$bktrckd',strbkry='$bkrytrckd',strsprmrt='$mrttrckd',strstal='$stltrckd',strrstnt='$rsnttrckd',strrstnt='$mcntrtrckd' WHERE srstpyr='$uyr' AND srstpmth='$umth' AND srcrtdt='$udt';";
            $query=$conn->query($sql);
            }else{
                $trckd=$this->enc(1,$this->anlysr,'idx');
                $gcrytrckd=($srtp=="g")?$this->enc(1,$this->anlysr,'idx'):$this->enc(0,$this->anlysr,'idx');
                $bktrckd=($srtp=="bks")?$this->enc(1,$this->anlysr,'idx'):$this->enc(0,$this->anlysr,'idx');
                $bkrytrckd=($srtp=="bkry")?$this->enc(1,$this->anlysr,'idx'):$this->enc(0,$this->anlysr,'idx');
                $mrttrckd=($srtp=="mrt")?$this->enc(1,$this->anlysr,'idx'):$this->enc(0,$this->anlysr,'idx');
                $stltrckd=($srtp=="stl")?$this->enc(1,$this->anlysr,'idx'):$this->enc(0,$this->anlysr,'idx');
                $rsnttrckd=($srtp=="rsnt")?$this->enc(1,$this->anlysr,'idx'):$this->enc(0,$this->anlysr,'idx');
                $mcntrtrckd=($srtp=="mctr")?$this->enc(1,$this->anlysr,'idx'):$this->enc(0,$this->anlysr,'idx');
                $sql="INSERT INTO anlstrs(srstpyr,srstpmth,srcrtdt,srctdody,strgcry,strbk,strbkry,strsprmrt,strstal,strrstnt,strmcntr) VALUES('$uyr','$umth','$udt','$trckd','$gcrytrckd','$bktrckd','$bkrytrckd','$mrttrckd','$stltrckd','$rsnttrckd','$mcntrtrckd');";
                $query=$conn->query($sql);
            }
        }
    }
    public function trckodrs($otp){
        $conn=$this->connectanlysr();if($otp=="ppd"){$otp="p";}elseif($otp=="CAS"){$otp="c";}
        date_default_timezone_set("Asia/kolkata");
        $uyr=$this->enc(date("Y"),$this->anlysr,"idx");
        $umth=$this->enc(date("m"),$this->anlysr,"idx");
        $udt=$this->enc(date("d"),$this->anlysr,"idx");
        $otp=htmlentities(mysqli_real_escape_string($conn,$otp));
        $sql="SELECT * FROM anlodrs WHERE oyr='$uyr' AND odrmth='$umth' AND odrdte='$udt' ORDER BY 1 DESC LIMIT 1;";
        $query=$conn->query($sql);
        if($query){
            if($query->num_rows>0){
                $row=$query->fetch_assoc();
                $tdyodrpstdta=$this->dec($row['orprdy'],$this->anlysr);
                $copstdta=$this->dec($row['odrbycas'],$this->anlysr);
                $potdta=$this->dec($row['odrbyppd'],$this->anlysr);
                $trckd=$this->enc($tdyodrpstdta+1,$this->anlysr,'idx');
                $cotrckd=$this->enc(($otp=="c")?$copstdta+1:$copstdta,$this->anlysr,'idx');
                $potrckd=$this->enc(($otp=="p")?$potdta+1:$potdta,$this->anlysr,'idx');
            $sql="UPDATE anlodrs SET orprdy='$trckd',odrbycas='$cotrckd',odrbyppd='$potrckd' WHERE oyr='$uyr' AND odrmth='$umth' AND odrdte='$udt';";
            $query=$conn->query($sql);
            }else{
                $trckd=$this->enc(1,$this->anlysr,'idx');
                $cotrckd=($otp=="c")?$this->enc(1,$this->anlysr,'idx'):$this->enc(0,$this->anlysr,'idx');
                $potrckd=($otp=="p")?$this->enc(1,$this->anlysr,'idx'):$this->enc(0,$this->anlysr,'idx');
                $sql="INSERT INTO anlodrs(oyr,odrmth,odrdte,orprdy,odrbycas,odrbyppd) VALUES('$uyr','$umth','$udt','$trckd','$cotrckd','$potrckd');";
                $query=$conn->query($sql);
            }
        }
    }
}
?>