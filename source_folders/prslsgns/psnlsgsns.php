<?php
session_start();
include '../db_conn.php';
class hmpgrmdfed extends dbconnect{
    private function getusrstatus(){
        $conn=$this->connect();
        $stores=$this->suggpinedsorted();
        $data=[];
        if($stores!=0){
        foreach($stores as $u){
            $spn=$this->dec($u['stsnm'],$this->strec);
            $sql="SELECT stnmr,strnm,stratmnt,strbprflig,stropnsts FROM stsinmtplc WHERE stnmr='$spn' LIMIT 1;";
            $querySql=$conn->query($sql);
            if($querySql){
                if($querySql->num_rows>0){
                    while($row=$querySql->fetch_assoc()){$data[]=$row;}
                }else{return "none";}
            }else{return 0;}
        }}
        return $data;
    }
    private function suggpinedsorted(){
        $conn=$this->connect();
        $cstmrid=$this->enc(htmlentities(mysqli_real_escape_string($conn,$_SESSION['ssndi'])),$this->iky,'idx');
        $sql="SELECT stsrnum,stsnm FROM stspdbycstms WHERE stscmnm='$cstmrid' ORDER BY strttlitrcns DESC LIMIT 6;";
        $query=$conn->query($sql);
        if($query){if($query->num_rows>0){
            while($row=$query->fetch_assoc()){$data[]=$row;}
            return $data;
        }else{return 0;}}else{return "q0";}
    }
    public function sugpnusronhmpg(){
        $ustatus=$this->getusrstatus();
        if($ustatus!=0){
        foreach($ustatus as $store){
        echo "<div class='prsnaspplsugtormddvbx gtstrpgclstrngtr' style='text-align:center;' data-pt='".$this->enc($store['stnmr'],$this->strec,'mtr')."' data-unm=".$this->sbldc($store['stratmnt'],$this->strec).">
        <div style='height: 60px;width: 60px;border-radius:50%;margin: auto;background-color:lightgray;overflow:hidden;cursor:pointer;'>";
        if($this->dec($store['strbprflig'],$this->strec)!=""&&file_exists("../fhupuppts/".$this->dec($store['strbprflig'],$this->strec))){echo "<img src='fhupuppts/".$this->dec($store['strbprflig'],$this->strec)."' class='strbsnsprfpc' style='width:100%;height:100%;object-fit:cover;object-position:center;'>";}
        echo "</div><p class='onetxtelpss sugstdprsnnme' style='max-width:100px'>".$this->sbldc($store['strnm'],$this->strec)."</p>
        </div>";
        }
        }
    }
}
$c= new hmpgrmdfed();
if(isset($_POST['gtusrsuggsts'])){
    if($_POST['gtusrsuggsts']=="ftchrqst"){$c->sugpnusronhmpg();}
}
?>