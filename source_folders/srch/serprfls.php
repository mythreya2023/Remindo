<?php
session_start();
include '../db_conn.php';
class searchprofiles extends dbconnect{
    private function searchuser($u){
        $conn=$this->connect();
        if(isset($_SESSION['ssndi'])){
        $stronr=$this->enc(htmlentities($_SESSION['ssndi']),$this->iky,'idx');}
        else{$stronr="";}
        $us=$this->sblen(strtolower(htmlentities(mysqli_real_escape_string($conn,$u))),$this->strec,"strix");
        $sqluser="SELECT stnmr,strbprflig,strrctgre,stropnsts,strnm,stratmnt,IF(strbsnonr='$stronr',1,0) AS srwhm  FROM stsinmtplc WHERE (stratmnt LIKE '%$us%' OR strnm LIKE '%$us%') ORDER BY strstcmspnd LIMIT 9 ";
            $queryuser=$this->connect()->query($sqluser);
            if($queryuser){
                if($queryuser->num_rows>0){
                    while ($row=$queryuser->fetch_assoc()){
                        $udata[]=$row;
                    }
                    return $udata;
                }else{return 0;}
            }else{return "fq";}
    }
    private function verfypndconn($us){
        $conn=$this->connect();
        $cmrid=$this->enc(htmlentities($_SESSION['ssndi']),$this->iky,'idx');
        $us=$this->enc($us,$this->strec,'strix');
        $sqlPinned="SELECT stsrnum,stsnm FROM stspdbycstms WHERE stsnm='$us' AND 	stscmnm='$cmrid';";
        $queryPinned=$conn->query($sqlPinned);
        if($queryPinned){
            if($queryPinned->num_rows>0){
                while($rowusr=$queryPinned->fetch_assoc()){$data=$rowusr;}
                return $data;
            }else{return 0;}
        }
    }
    public function showprofiles($u){
        echo "<div class='pinnedcontinerbox'>";
        $usid=$this->searchuser($u);
        if($usid!="fq"){
        if($usid !=0){
            foreach($usid as $data){
                if(isset($_SESSION['ssndi'])){$cckuserpinned=$this->verfypndconn($data['stnmr']);}
                echo"<div class='rmdosrchacntsdsplaydvbx' style='display:flex;justify-content:space-between;margin:6px 0px;'>
                    <div class='rmdosrchdacntdtsldvbx' style='display:flex;justify-content:flex-start;'>";
                    if($this->dec($data['strbprflig'],$this->strec)!=""&&file_exists("../fhupuppts/".$this->dec($data['strbprflig'],$this->strec))){echo "<div class='rmdosrcdacntigpcdtls'><img src='http://localhost/remindo/fhupuppts/".$this->dec($data['strbprflig'],$this->strec)."' style='border-radius:50%;height:40px;width:40px;paddig:3px;'></div>";}
                    echo "
                    <div class='rmosrchdacntstxtdtlsdvbx' style='margin-left:3px;overflow:hidden;'>
                        <div class='onetxtelpss rmdosrchdacntsnm' data-u='".$this->sbldc($data['stratmnt'],$this->strec)."' data-s='".$this->enc($data['stnmr'],$this->strec,'mtr')."' style='max-width:230px;cursor:pointer; font-size:16px;font-weight:bold;'>".$this->sbldc($data['strnm'],$this->strec)."</div>
                        <div calss='rmdosrchdanctswhm onetxtelpss' style='max-width:230px; color:gray;font-size:12px;'>";
                        if($data['srwhm']==1){echo "Your store.";}else{echo ".".$this->dec($data['strrctgre'],$this->strec);
                        if($this->dec($data['stropnsts'],$this->strec)==1){echo "<span style='color:green'>.open</span>";}else{echo "<span style='color:red'>.close</span>";}}
                        echo "</div>
                    </div>
                    </div>
                    <div class='rmdosrchdacntsunpdpnbx'>";
                        if(isset($_SESSION['ssndi'])){if(!$cckuserpinned&&$data['srwhm']==0){echo "<div class='pnacntbtn' data-p='".$this->enc($data['stnmr'],$this->strec,'mtr')."' role='button'><i class='fas fa-thumbtack remindosymbols' style='transform:rotate(45deg);cursor:pointer;'></i></div>";}}
                   echo" </div>
                </div>";
            }
        }else{
            echo "<center><p style='color:gray;'>No business found!. Try to search with full business name or it's username</p><br></center>";
        }
        }else{
            echo "<center><p style='color:gray;'>Failed to search. Try again later.</p><br></center>";
        }
        echo "</div>";
    }
}
$search=new searchprofiles();
if(isset($_POST['srchqury'])){
    $searchquery=htmlentities(mysqli_real_escape_string($conn,$_POST['srchqury']));
    if($searchquery !=""){
        echo $search->showprofiles($searchquery);
    }
}
?>