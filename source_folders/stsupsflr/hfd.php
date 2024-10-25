<?php
include '../db_conn.php';
session_start();
class hmfd extends dbconnect{
    private function ftchpndstrs(){
        $conn=$this->connect();
        $usr=$this->enc(htmlentities($_SESSION['ssndi']),$this->iky,'idx');
        $sql="SELECT stsrnum,stsnm FROM stspdbycstms WHERE stscmnm='$usr' ORDER BY strttlitrcns DESC LIMIT 0 , 6;";
        $query=$conn->query($sql);
        if($query){
            if($query->num_rows>0){
                while($row=$query->fetch_assoc()){$data[]=$row;}
                return $data;
            }else{return 0;}
        }else{return 'q0';}
    }
    private function fchpdts($os,$lt){
        $conn=$this->connect();
        $os=htmlentities(mysqli_real_escape_string($conn,$os));
        $lt=htmlentities(mysqli_real_escape_string($conn,$lt));
        $pnstrs=$this->ftchpndstrs();$strs="";
        if($pnstrs!='q0'){
        if($pnstrs!=0){
        foreach ($pnstrs as $idx=>$pnstr) {
            if($idx>0){$strs.="OR strnmr='".$pnstr['stsnm']."'";}
            else{$strs.="strnmr='".$pnstr['stsnm']."'";}
        }
        $sql="SELECT strnmr,strspdtnum,prdtnm,prdtpto,prdtstrtmtp,IF (prdtqnty='Ojo','',prdtqnty) AS prdtqnty,pdtqlty,prdtprc,pdtsts,pdtmrdlsdsrpn,pdtfhrs,pdtlvmdlig,pdtlstupdt,pdtlrgvws FROM prdcsinstr WHERE $strs ORDER BY strspdtnum DESC,pdtlrgvws DESC LIMIT $os,$lt ;";
        $query=$conn->query($sql);
        if($query){
            if($query->num_rows>0){
                while($row=$query->fetch_assoc()){$data[]=$row;}
                return $data;
            }else{return 0;}
        }else{return 'q0';}}
        else{return 0;}}else{return 'q0';}
    }
    private function fhstrdls($s){
        $conn=$this->connect();
        $sql="SELECT strrctgre,strnm,stratmnt,strbprflig FROM stsinmtplc WHERE stnmr='$s' LIMIT 1 ;";;
        $query=$conn->query($sql);
        if($query){if($query->num_rows>0){
            return $row=$query->fetch_assoc();
        }else{return 0;}}else{return 'q0';}
    }
    public function multi_assoc_sort($array,$srtky,$aod){
        if($array!="q0"){if($array!=0){$srtkey=htmlentities($srtky);
        for($i=0;$i<count($array);$i++){
            for($j=0;$j<count($array)-1;$j++){
                if($aod=="d"){if($array[$j][$srtkey]<$array[$j+1][$srtkey]){
                    $temp=$array[$j+1];
                    $array[$j+1]=$array[$j];
                    $array[$j]=$temp;
                }}elseif($aod=="a"){if($array[$j][$srtkey]>$array[$j+1][$srtkey]){
                    $temp=$array[$j+1];
                    $array[$j+1]=$array[$j];
                    $array[$j]=$temp;
                }}else{break;}
            }
        }}else{return 0;}}else{return "q0";}
        return $array;
    }
    public function dphmfd($os,$lt){
        $data=$this->multi_assoc_sort($this->fchpdts($os,$lt),"pdtlrgvws","d");
        if($data!='q0'){
        if($data!=0){
            foreach ($data as $pdt) {
                $strdc=$this->dec($pdt["strnmr"],$this->strec);
                $s=$this->sblen($strdc,$this->strec,'strix');
                $p=$this->sblen($pdt["strspdtnum"],$this->strec,'strix');
                $pto=$this->dec($pdt["prdtpto"],$this->strec);
                $lvpig=$this->dec($pdt["pdtlvmdlig"],$this->strec);
                $pdtnm=$this->sbldc($pdt["prdtnm"],$this->strec);
                $vrnts=$this->sbldc($pdt["prdtqnty"],$this->strec);
                $pdcpn=$this->dec($pdt["pdtmrdlsdsrpn"],$this->strec);
                $pdfrs=($pdt["pdtfhrs"]!="Ojo")?$this->sbldc($pdt["pdtfhrs"],$this->strec):"";
                $pdtsks=$this->dec($pdt["pdtsts"],$this->strec);
                $prc=$this->sbldc($pdt["prdtprc"],$this->strec);
                $pdvws=$pdt["pdtlrgvws"];
                $plsupt=$this->dec($pdt["pdtlstupdt"],$this->strec);
                $puptm=$this->dec($pdt["prdtstrtmtp"],$this->strec);
                $ptos=explode("/,",$pto);
                $str=$this->fhstrdls($strdc);
                $strnm=$this->sbldc($str['strnm'],$this->strec);
                $strunm=$this->sbldc($str['stratmnt'],$this->strec);
                $strpfig=$this->dec($str['strbprflig'],$this->strec);
                $strctgre=$this->dec($str['strrctgre'],$this->strec);
                echo "<div class='rmdo-srptaspst-cntngdvbxorgnl'>
                <div class='rmo-srpdtcntngdvbx-mn'>
                    <div class='srpdtaspsthdr-ctngdvbx'>
                        <a href='http://localhost/remindo/stores/store?s=$strunm' style='color:black;' class='gtstrpgclstrngtr' data-pt='".$this->enc($strdc,$this->strec,'mtr')."' data-unm='$strunm'>
                        <div class='strpstfrmdlspcs-cntgdvbx'>
                            <div class='pdtaspststrdspligdvbx'>";
                                if(file_exists("../fhupuppts/$strpfig")&&$strpfig!=""){echo "<img src='fhupuppts/$strpfig' class='pdtsrdpflig'>";}
                            echo "</div>
                            <div class='pdtaspststrdpnmdlsdvbx'>
                                <div class='pfdlsnms'>$strnm</div>
                                <div class='pfdlsbnm'>@$strunm <span style='color:gray;font-weight:500;font-size:11px;'>.".$this->timefrendly($plsupt,$puptm)."</span></div>
                            </div>
                        </div></a>
                    </div>
                    <div class='nonsrprdtlbxopn prdtditmnmcntnrdvbx' style='display:block;' data-tle='$pdtnm' data-pce='$prc' data-szs='$vrnts' data-pfcrs='$pdfrs' data-dcptn='$pdcpn' data-rpigs='$pto' data-lmig='../srptlvmdlpcs/$lvpig'  data-sid='".$this->enc($this->dec($pdt['strnmr'],$this->strec),$this->strec,'mtr')."' data-pid='".$this->sblen($pdt['strspdtnum'],$this->strec,'strix')."'data-istk='".(($pdtsks=="1")?"In stock":"Out of stock")."' data-luptd='".$this->timefrendly($plsupt,$puptm)."'  data-srcgr='$strctgre' data-srnm='$strnm' data-srunm='@$strunm' data-srpc='";
                    if(file_exists("../fhupuppts/$strpfig")&&$strpfig!=""){echo "fhupuppts/$strpfig";}
                echo "'>
                    <div class='pdtaspst-cntdsplydvbx'>
                        <div class='srpdtpsttxcntcntngdvbx'><span class='bksnts'>$strnm added new product!</span><span class='bksnts'>$pdtnm</span></div>
                        <div class='pstigovdcntngdvbx'>
                            <div class='vdorigclsfr'>
                                <img src='strpdtspcs/$ptos[0]' class='pdtpstig'>
                            </div>
                        </div>
                        <div class='srpdtpsttxcntcntngdvbx'><span class='bksnts'>$pdcpn</span></div>
                    </div>
                    </div>
                    <div class='pdtdvbx-ftrdsplydvbxw'>
                        <div class='ftrlfthlf'>
                            <div class='pstvwsdsplydvbx hstpt' data-tooltip='Views'><span><i class='fas fa-eye remindosymbols'></i></span><span>$pdvws</span></div>";
                            if($lvpig!=""&&file_exists("../srptlvmdlpcs/$lvpig")){echo "<div class='blewhtbns pstmtchmebn mhmebtn coumhebn' data-sid='".$this->enc($this->dec($pdt['strnmr'],$this->strec),$this->strec,'mtr')."' data-pid='".$this->sblen($pdt['strspdtnum'],$this->strec,'strix')."' data-m='http://localhost/remindo/srptlvmdlpcs/$lvpig'>Match me</div>";}
                        echo "</div>
                        <div class='ftrrghthlf'>
                            <div class='shrpstbn' data-ttl='$strnm | Remindo.in' data-txt='$pdtnm' data-pic='http://localhost/remindo/strpdtspcs/$ptos[0]' data-url='http://localhost/remindo/shared?tp=pt&s=".htmlentities($s)."&p=".htmlentities($p)."'><i class='fas fa-share remindosymbols'></i> Share</div>
                        </div>
                    </div>
                </div>
            </div>";
            }
        }else{return 0;}
        }else{return 'q0';}
    }
}
$hfd=new hmfd();
if(isset($_POST['dphfd'])&&$_POST['dphfd']=="tredphf"&&isset($_POST['os'])&&isset($_POST['lt'])){
echo $hfd->dphmfd($_POST['os'],$_POST['lt']);
}
?>