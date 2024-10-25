<?php
session_start();
include '../db_conn.php';
class fhstdls extends dbconnect{
    public function strdtls($strng){
        $conn=$this->connect();
        $strid=$this->dec(htmlentities(mysqli_real_escape_string($conn,$strng)),$this->strec);
        $unm=$this->sblen(htmlentities(mysqli_real_escape_string($conn,$strng)),$this->strec,'strix');
        $sql="SELECT stnmr,strbsnonr,strrctgre,strnm,stratmnt,strseml,strsprtng,stsbsnmblnum,stracptbluipmtmtds,strbprflig,strcvrpto,stradrs,strbupimg,stravblcstoevyon,strsodrrcvngsts,stropnsts,strhlgts,stropngclsngtmgs,strcrtdtmstp,strlgtdlatd,strpdtmnprchs,strodrlmts FROM stsinmtplc WHERE stnmr='$strid' OR stratmnt='$unm';";
        $query=$conn->query($sql);
        if($query){
            if($query->num_rows>0){
                return $row=$query->fetch_assoc();
            }else{return 0;}
        }else{return "e0";}
        return;
    }
    public function chckifpnd($sid){
        $conn=$this->connect();
        $sd=$this->dec(htmlentities(mysqli_real_escape_string($conn,$sid)),$this->strec);
        $strid=$this->enc($sd,$this->strec,'strix');
        $csmrid=$this->enc(htmlentities(mysqli_real_escape_string($conn,$_SESSION['ssndi'])),$this->iky,'idx');
        $sql="SELECT stsrnum,strcstmrcsonavbl FROM stspdbycstms WHERE stsnm='$strid' AND stscmnm='$csmrid' LIMIT 1;";
        $query=$conn->query($sql);
        if($query){if($query->num_rows>0){
            return $row=$query->fetch_assoc();
        }else{return 0;}}else{return "q0";}
    }
    public function tpnd($sid){
        $conn=$this->connect();
        $strid=$this->enc(htmlentities(mysqli_real_escape_string($conn,$sid)),$this->strec,'strix');
        $sql="SELECT stsrnum FROM stspdbycstms WHERE stsnm='$strid';";
        $query=$conn->query($sql);
        if($query){return $query->num_rows;}
    }
}
?>