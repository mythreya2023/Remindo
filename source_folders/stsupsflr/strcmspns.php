<?php
session_start();
include '../db_conn.php';
class strdtlscurd extends dbconnect{
    protected function strsdtls($spn,$isrh,$srh,$os,$l){
        $conn=$this->connect();
        $os=htmlentities($os);
        $lt=htmlentities($l);
        $spn=htmlentities(mysqli_real_escape_string($conn,$spn));
        if(isset($_SESSION['ssndi'])){
        $stronr=$this->enc(htmlentities(mysqli_real_escape_string($conn,$_SESSION['ssndi'])),$this->iky,'idx');}else{$stronr="";}
        $srh=$this->sblen(strtolower(htmlentities(mysqli_real_escape_string($conn,$srh))),$this->strec,'strix');
        if($isrh&&$srh!=""){
            $sql="SELECT stnmr,strnm,strrctgre,stratmnt,strsprtng,strstcmspnd,strbprflig,stropnsts,	strsodrrcvngsts,stradrs,IF(strbsnonr='$stronr',1,0)AS srwhm FROM stsinmtplc WHERE (stratmnt LIKE '%$srh%' OR strnm LIKE '%$srh%') ORDER BY strstcmspnd LIMIT $os, $lt;";
            $query=$conn->query($sql);
            if($query){
                if($query->num_rows>0){
                    while($row=$query->fetch_assoc()){$data[]=$row;}
                    return $data;
                }else{return 0;}
            }else{return "q0";}
        }elseif($spn!=""&&$spn!=0){
        $sql="SELECT stnmr,strnm,strrctgre,stratmnt,strsprtng,strstcmspnd,strbprflig,stropnsts,	strsodrrcvngsts,stradrs,IF(strbsnonr='$stronr',1,0)AS srwhm FROM stsinmtplc WHERE stnmr='$spn' ORDER BY strstcmspnd LIMIT $os, $lt;";
        $query=$conn->query($sql);
        if($query){
            if($query->num_rows>0){
                return $row=$query->fetch_assoc();
            }else{return 0;}
        }else{return "q0";}
        }else{
        $sql="SELECT stnmr,strnm,strrctgre,stratmnt,strsprtng,strstcmspnd,strbprflig,stropnsts,	strsodrrcvngsts,stradrs,IF(strbsnonr='$stronr',1,0)AS srwhm FROM stsinmtplc WHERE strbsnonr!='$stronr' ORDER BY strstcmspnd LIMIT $os, $lt";
        $query=$conn->query($sql);
        if($query){
            if($query->num_rows>0){
                while($row=$query->fetch_assoc()){$data[]=$row;}
                return $data;
            }else{return 0;}
        }else{return "q0";}
        }
    }
    protected function fthusrsascmrs($usr){
        $conn=$this->connect();
        $u=htmlentities(mysqli_real_escape_string($conn,$usr));
        $sql="SELECT usid,rmuflm,runm,ruspig FROM roupldls WHERE usid='$u';";
        $query=$conn->query($sql);
        if($query){
            if($query->num_rows>0){
                return $row=$query->fetch_assoc();
            }else{return 0;}
        }else{return "q0";}
    }
    protected function gtalstrpd($os,$l){
        if(isset($_SESSION['ssndi'])){
        $conn=$this->connect();
        $os=htmlentities($os);
        $lt=htmlentities($l);
        $cstmrid=$this->enc(htmlentities(mysqli_real_escape_string($conn,$_SESSION['ssndi'])),$this->iky,'idx');
        $sql="SELECT stsrnum,stsnm FROM stspdbycstms WHERE stscmnm='$cstmrid' ORDER BY strttlitrcns LIMIT $os, $lt;";
        $query=$conn->query($sql);
        if($query){if($query->num_rows>0){
            while($row=$query->fetch_assoc()){$data[]=$row;}
            return $data;
        }else{return 0;}}else{return "q0";}
        }
    }
    protected function strcmrsshw($sid,$cas,$os,$l){
        $conn=$this->connect();
        $os=htmlentities($os);
        $lt=htmlentities($l);
        $sd=$this->dec(htmlentities(mysqli_real_escape_string($conn,$sid)),$this->strec);
        $strid=$this->enc($sd,$this->strec,'strix');
        $csavl=$this->enc("1",$this->strec,'strix');
        if($cas){$sql="SELECT stsrnum,stscmnm,strcstmrcsonavbl FROM stspdbycstms WHERE stsnm='$strid' AND strcstmrcsonavbl='$csavl' ORDER BY strttlitrcns LIMIT $os, $lt;";}else{$sql="SELECT stsrnum,stscmnm,strcstmrcsonavbl FROM stspdbycstms WHERE stsnm='$strid' ORDER BY strttlitrcns LIMIT $os, $lt;";}
        $query=$conn->query($sql);
        if($query){if($query->num_rows>0){
            while($row=$query->fetch_assoc()){$data[]=$row;}
            return $data;
        }else{return 0;}}else{return "q0";}
    }
    protected function vrfifpnd($sid){
        $conn=$this->connect();
        $cstmrid=$this->enc(htmlentities($_SESSION['ssndi']),$this->iky,'idx');
        $sd=$this->enc(htmlentities(mysqli_real_escape_string($conn,$sid)),$this->strec,'strix');
        $sql="SELECT stsrnum FROM stspdbycstms WHERE stsnm='$sd' AND stscmnm='$cstmrid';";
        $query=$conn->query($sql);
        if($query){
            if($query->num_rows>0){return 1;}else{return 0;}
        }
    }
    public function dspstrs($spn,$isrh,$srh,$os,$l){
        if($isrh){$sts=$this->strsdtls("",true,$srh,$os,$l);}
        else{if($spn){$sts=$this->gtalstrpd($os,$l);}
        else{$sts=$this->strsdtls("",false,"",$os,$l);}}
        if($sts!="q0"){
        if($sts!=0){
            $ispnd=false;$ispninsrh=false;$tstrs=0;
            echo "<div class='rmostrsgnsdvbx'>";
            foreach ($sts as $str) {
                if($spn){$str=$this->strsdtls($this->dec($str['stsnm'],$this->strec),false,"",$os,$l);}
                if(!$spn&&isset($_SESSION['ssndi'])){$cpnd=$this->vrfifpnd($str['stnmr']);if($cpnd==1&&$isrh){$ispninsrh=true;}else{$ispninsrh=false;}if($cpnd==1&&!$isrh){$ispnd=true;}else{$ispnd=false;}}
                if(!$ispnd){
                echo "<div class='strathmbnldtlscntngdvbx'>";
                    if(!$spn){echo "<div class='rmracontprewvttlsetctngdvbx actprevwbox'>
                    <div class='rmracntprewarrow'></div>
                    <div class='rmracontprewvctngdvbx '>
                        <div class='rmracntprfigprvcntngdvbx'>";
                        if($this->dec($str['strbprflig'],$this->strec)!=""&&file_exists("../fhupuppts/".$this->dec($str['strbprflig'],$this->strec))){echo "<img src='fhupuppts/".$this->dec($str['strbprflig'],$this->strec)."' class='rmractimgprew'>";}
                        echo"</div>
                        <div class='rmracntdtlsprvctngdvbx'>
                            <div class='twotxtelpss strnmcngdvbx' style='max-width:300px;'>".strtoupper(substr($this->sbldc($str['strnm'],$this->strec),0,1)).substr($this->sbldc($str['strnm'],$this->strec),1)."</div>
                            <div class='strprfusnmatmntctngdvbx'><i class='fas fa-at remindosymbols'></i>".$this->sbldc($str['stratmnt'],$this->strec)."</div>
                            <div class='stronrcvadathrdtlscntngdvbx'>
                                <div class='stropnstsstrspgdvbx'>";
                                if($this->dec($str['stropnsts'],$this->strec)==1){echo ".<span style='color:green;font-size:12px;'>Open</span>";}else{echo ".<span style='color:red;font-size:12px'>Close</span>";}
                                if($this->dec($str['strsodrrcvngsts'],$this->strec)==1){echo ".<span style='margin-left:6px;color:green;font-size:12px;'>Receving Orders</span>";}else{echo ".<span style='color:red;font-size:12px'>Not available</span>";}
                                echo"</div>
                                <div class='strrcvnpfpggsts'></div>
                            </div>
                            <div class='rmrstracntothdlsprvw'><strong>Category : </strong>".$this->dec($str['strrctgre'],$this->strec)."</div>
                            <div class='rmrstracntothdlsprvw'><strong>Address : </strong>".$this->dec($str['stradrs'],$this->strec)."</div>";
                        if(!$spn&&!$ispninsrh&&$str['srwhm']==0&&isset($_SESSION['ssndi'])){echo "<div class='remindo-pin-button pnstrbtndvbx' data-c='".$this->dec($str['strrctgre'],$this->strec)."' data-p='".$this->enc($str['stnmr'],$this->strec,'mtr')."' role='button'><i class='fas fa-thumbtack'></i>Pin</div>";}
                        echo "</div>
                        </div>
                    </div>";}
                    echo "<div class='strpcsodothrdtlsctngdvbx'>
                        <div class='strprfpcctngdvbx'>";
                        if($this->dec($str['strbprflig'],$this->strec)!=""&&file_exists("../fhupuppts/".$this->dec($str['strbprflig'],$this->strec))){echo "<img src='fhupuppts/".$this->dec($str['strbprflig'],$this->strec)."' class='rmdusrprofilepic strprfpcctngdvbx'>";}
                        echo"</div>
                        <div class='strprfdtlsctngctnrdvbx'>
                            <div class='onetxtelpss strprfnmcntngdvbx gtstrpgclstrngtr' data-u='".$this->sbldc($str['stratmnt'],$this->strec)."'>".strtoupper(substr($this->sbldc($str['strnm'],$this->strec),0,1)).substr($this->sbldc($str['strnm'],$this->strec),1)."</div>
                            <div class='strprfusnmatmntctngdvbx'>";
                            if(isset($str['srwhm'])&&$str['srwhm']==1){echo "Your store";}
                            else{echo "<i class='fas fa-at remindosymbols'></i>".$this->sbldc($str['stratmnt'],$this->strec);}
                            echo "</div>
                            <div class='stronrcvadathrdtlscntngdvbx'>
                                <div class='stropnstsstrspgdvbx'>";
                                if($this->dec($str['stropnsts'],$this->strec)==1){echo ".<span style='color:green;font-size:12px;'>Open</span>";}else{echo ".<span style='color:red;font-size:12px'>Close</span>";}
                                if($this->dec($str['strsodrrcvngsts'],$this->strec)==1){echo ".<span style='margin-left:6px;color:green;font-size:12px;'>Receving Orders</span>";}else{echo ".<span style='color:red;font-size:12px'>Not available</span>";}
                                echo"</div>
                                <div class='strrcvnpfpggsts'></div>
                            </div>
                        </div>
                    </div>
                    <div class='strpnunpnspnbtndvbx'>";
                        if(!$spn&&!$ispninsrh&&$str['srwhm']==0&&isset($_SESSION['ssndi'])){echo "<div class='pnstrbtndvbx' data-c='".$this->dec($str['strrctgre'],$this->strec)."' data-p='".$this->enc($str['stnmr'],$this->strec,'mtr')."' role='button'><i class='fas fa-thumbtack remindosymbols'></i></div>";}
                    echo "</div>
                </div>";
                $tstrs++;
                }
            }
            echo "</div>";
        }else{return 0;}
        }else{echo "q0";}
    }
    public function pndcmrsinstronr($sid,$cas,$os,$l){
        $sts=$this->strcmrsshw($sid,$cas,$os,$l);
        if($sts!="q0"){
        if($sts!=0){
            echo "<div class='rmostrsgnsdvbx'>";
            foreach ($sts as $csmr) {
                $csr=$this->fthusrsascmrs($this->dec($csmr['stscmnm'],$this->iky));
                $str=($csmr+$csr);
                 echo "<div class='strprdtsdtlsadntmstpcntnrdvcntngbx'>
                <div class='strprdtdtlsandupdtbtnscntngdvbx'>
                    <div class='strsprdtupdtddtlsdvbx'>
                        <div class='strsprdtsimgcntnrbx'>";
                        if($this->dec($str['ruspig'],$this->iky)!=""&&file_exists("../pflmgs/".$this->dec($str['ruspig'],$this->iky))){echo "<img src='../pflmgs/".$this->dec($str['ruspig'],$this->iky)."' class='prdctsdsplypctre'>";}
                        echo"</div>
                        <div class='strcntngordritmdtlscntngdvbx'>
                            <div class='twotxtelpss prdtditmnmcntnrdvbx'>".strtoupper(substr($this->sbldc($str['rmuflm'],$this->iky),0,1)).substr($this->sbldc($str['rmuflm'],$this->iky),1)."</div>
                            <div class='prdtsrditmothdtlscntngdvbx'>@".$this->sbldc($str['runm'],$this->iky)."</div>
                        </div>
                    </div>
                    <div class='strsprdtupdtbtns'>
                        <div class='strprdtedtinstkstsdvbxbtn' role='button'>
                            <span class='intle'>Enable C.A.S</span>
                            <div class='toggleswitch tglbtn'><label class='switch'>";
                            if($this->dec($str['strcstmrcsonavbl'],$this->strec)==1){echo "<input type='checkbox' id='iscasavblipt' data-pu='".$this->enc($str['usid'],$this->iky,'idx')."' data-c='".$this->enc($str['stsrnum'],$this->strec,'mtr')."' data-ud='fs' checked>";}else{echo "<input type='checkbox' id='iscasavblipt' data-pu='".$this->enc($str['usid'],$this->iky,'idx')."' data-c='".$this->enc($str['stsrnum'],$this->strec,'mtr')."' data-ud='tre' unchecked>";}
                        echo "<span class='slider round'></label></div>
                        </div>
                    </div>
                </div>
                </div>";
            }
            echo "</div>";
        }else{echo 0;}
        }else{echo "q0";}
    }
    private function ftchstrrols($sd,$os,$lt){
        $conn=$this->connect();
        $sid=$this->enc($this->dec(htmlentities(mysqli_real_escape_string($conn,$sd)),$this->strec),$this->strec,'strix');
        $os=htmlentities(mysqli_real_escape_string($conn,$os));
        $lt=htmlentities(mysqli_real_escape_string($conn,$lt));
        $sql="SELECT rlid,sridtoasngrl,psnidassrol,strolofpsn,stortmbrsts FROM strtemrls WHERE sridtoasngrl='$sid' LIMIT $os,$lt;";
        $query=$conn->query($sql);
        if($query){
            if($query->num_rows>0){
                while($row=$query->fetch_assoc()){$data[]=$row;}return $data;
            }else{return 0;}
        }else{return 'q0';}
    }
    public function storols($wau,$sid,$os,$l){
        $sts=$this->ftchstrrols($sid,$os,$l);
        $srls=[];
        if($sts!="q0"){
            $w=strtolower($this->dec(htmlentities($wau),$this->iky));
            $w=$w=="admin"?"amn":"amr";$tmrs=1;
            if(htmlentities($os)==0){
                $strd=$this->dec(htmlentities($sid),$this->strec);$std=$this->enc($strd,$this->strec,'strix');
                $query=$this->connect()->query("SELECT COUNT(rlid) AS tsrols FROM strtemrls WHERE sridtoasngrl='$std';");
                if($query){if($query->num_rows>0){$tmrs=$query->fetch_assoc()["tsrols"];}else{$tmrs=1;}}
                $query=$this->connect()->query("SELECT strbsnonr FROM stsinmtplc WHERE stnmr='$strd';");
                if($query){
                    if($query->num_rows>0){$row=$query->fetch_assoc();
                        if($this->dec($row["strbsnonr"],$this->iky)==htmlentities($_SESSION['ssndi'])){$w="amn";}
                        $sonr=[
                            'rlid' => "",
                            'sridtoasngrl' => "",
                            'psnidassrol' => $row["strbsnonr"],
                            'strolofpsn' =>"RDE1LzVTdU8waWhRWWNnPTo6MTIzNDU2Nzg5MTAxMTEyMQ==",
                            'stortmbrsts' => "YmcU3cVFEU2cUVEUUE",
                        ];array_push($srls,$sonr);
                    }
                }
            }
        if($sts!=0){$srls=$srls+$sts;$tmpfls="";
            foreach ($srls as $strrols) {
                $csr=$this->fthusrsascmrs($this->dec($strrols['psnidassrol'],$this->iky));
                $tmbr=($strrols+$csr);
                $tmpfls.= "<div class='strprdtsdtlsadntmstpcntnrdvcntngbx'>
                <div class='strtemmbrupdtbtnscntngdvbx'>
                    <div class='strsprdtupdtddtlsdvbx'>
                    <div class='strsprdtsimgcntnrbx'>";
                    if($this->dec($tmbr['ruspig'],$this->iky)!=""&&file_exists("../pflmgs/".$this->dec($tmbr['ruspig'],$this->iky))){$tmpfls.= "<img src='../pflmgs/".$this->dec($tmbr['ruspig'],$this->iky)."' class='prdctsdsplypctre'>";}
                    $tmpfls.="</div>
                    <div class='strcntngordritmdtlscntngdvbx'>
                        <div class='twotxtelpss prdtditmnmcntnrdvbx'>".strtoupper(substr($this->sbldc($tmbr['rmuflm'],$this->iky),0,1)).substr($this->sbldc($tmbr['rmuflm'],$this->iky),1)."</div>
                        <div class='prdtsrditmothdtlscntngdvbx'>".$this->dec($tmbr['strolofpsn'],$this->iky)."</div>
                    </div>
                    </div>
                    <div class='strstemrolupdtbtns'>";
                    if($this->dec($tmbr['strolofpsn'],$this->iky)!="Store Owner"){
                        if($tmbr['stortmbrsts']=="TlETWcS2cTlES0ET1ET0"){
                            $tmpfls.= "<div class='blewhtbns ivtdsts' style='margin:6px;'>Invited</div>";
                            if($w=="amn"){$tmpfls.="<div class='blewhtbns admrnpgrlbns rmvrolbtn' data-srl='".$this->enc($tmbr['rlid'],$this->strec,'mtr')."' data-ps='".$this->enc($tmbr['usid'],$this->iky,'mtr')."' style='background-color: #e1e1e1d6;color: darkslategray;box-shadow: 0 0 0 black;'>Cancle</div>";}
                        }
                        if($tmbr['stortmbrsts']=="YmcU3cVFEU2cUVEUUE"&&$w=="amn"){$tmpfls.= "<div class='blewhtbns admrnpgrlbns chngrolebtn' data-spn='".strtoupper(substr($this->sbldc($tmbr['rmuflm'],$this->iky),0,1)).substr($this->sbldc($tmbr['rmuflm'],$this->iky),1)."' data-stml='".$this->dec($tmbr['strolofpsn'],$this->iky)."' data-sl='".$this->enc($tmbr['rlid'],$this->strec,'mtr')."' data-p='".$this->enc($tmbr['usid'],$this->iky,'mtr')."'><i class='fas fa-pen remindosymbols'  style='color: white;font-size: 12px;padding: 0px 4px 0px 0;'></i>Change role</div>
                        <div class='blewhtbns admrnpgrlbns rmvrolbtn' data-srl='".$this->enc($tmbr['rlid'],$this->strec,'mtr')."' data-ps='".$this->enc($tmbr['usid'],$this->iky,'mtr')."' style='background-color: #e1e1e1d6;color: darkslategray;box-shadow: 0 0 0 black;'>Remove</div>";}
                        elseif($this->dec($strrols['psnidassrol'],$this->iky)==htmlentities($_SESSION['ssndi'])){
                            $tmpfls.= "<div class='blewhtbns admrnpgrlbns rmvrolbtn' data-srl='".$this->enc($tmbr['rlid'],$this->strec,'mtr')."' data-ps='".$this->enc($tmbr['usid'],$this->iky,'mtr')."' style='background-color: #e1e1e1d6;color: darkslategray;box-shadow: 0 0 0 black;'>Remove</div>";
                        }}
                    $tmpfls.= "</div>
                </div>
                </div>";
            }
            return json_encode(["s"=>$tmpfls,'tmrs'=>$tmrs]);
        }else{
            $strrols=$srls[0];
            $csr=$this->fthusrsascmrs($this->dec($strrols['psnidassrol'],$this->iky));
                $tmbr=($strrols+$csr);
                $tmpfl = "<div class='strprdtsdtlsadntmstpcntnrdvcntngbx'>
                <div class='strtemmbrupdtbtnscntngdvbx'>
                    <div class='strsprdtupdtddtlsdvbx'>
                    <div class='strsprdtsimgcntnrbx'>";
                    if($this->dec($tmbr['ruspig'],$this->iky)!=""&&file_exists("../pflmgs/".$this->dec($tmbr['ruspig'],$this->iky))){$tmpfl.= "<img src='../pflmgs/".$this->dec($tmbr['ruspig'],$this->iky)."' class='prdctsdsplypctre'>";}
                    $tmpfl.="</div>
                    <div class='strcntngordritmdtlscntngdvbx'>
                        <div class='twotxtelpss prdtditmnmcntnrdvbx'>".strtoupper(substr($this->sbldc($tmbr['rmuflm'],$this->iky),0,1)).substr($this->sbldc($tmbr['rmuflm'],$this->iky),1)."</div>
                        <div class='prdtsrditmothdtlscntngdvbx'>".$this->dec($tmbr['strolofpsn'],$this->iky)."</div>
                    </div>
                    </div>
                    <div class='strstemrolupdtbtns'></div>
                </div>
                </div>";
            return json_encode(["s"=>$tmpfl,'tmrs'=>1]);}
        }else{return json_encode(["s"=>"q0"]);}
    }
    public function adstrols($sid,$psnid,$rol,$psd,$srld,$aou){
        $conn=$this->connect();
        $psw=htmlentities(mysqli_real_escape_string($conn,$psd));
        $usid=htmlentities(mysqli_real_escape_string($conn,$_SESSION['ssndi']));$nmbr="";
        $sql="SELECT rusacpd FROM roupldls WHERE usid ='$usid';";
        $query=$conn->query($sql);
        if($query){
        if($query->num_rows>0){
        if(password_verify($psw,$query->fetch_assoc()['rusacpd'])){
        $pid=$this->dec(htmlentities(mysqli_real_escape_string($conn,$psnid)),$this->iky);
        $role=$this->enc(htmlentities(mysqli_real_escape_string($conn,$rol)),$this->iky,'mtr');
        $psn=$this->enc($pid,$this->iky,'idx');
        $strid=$this->dec(htmlentities(mysqli_real_escape_string($conn,$sid)),$this->strec);
        $str=$this->enc($strid,$this->strec,'strix');
        $au=htmlentities(mysqli_real_escape_string($conn,$aou));
        if($au=="a"){
        $sql="SELECT COUNT(rlid) AS tsrols FROM strtemrls WHERE sridtoasngrl='$str';";
        $query=$conn->query($sql);
        if($query){if($query->num_rows>0){
        if($query->fetch_assoc()['tsrols']>15){return json_encode(["s"=>'rexd']);}
        else{
        $sql="SELECT rlid FROM strtemrls WHERE sridtoasngrl='$str' AND psnidassrol='$psn' LIMIT 1;";
        $query=$conn->query($sql);
        if($query){
            if($query->num_rows>0){return json_encode(["s"=>'pext']);}
            else{
                if($conn->query("INSERT INTO strtemrls(sridtoasngrl,psnidassrol,strolofpsn,stortmbrsts) VALUES ('$str','$psn','$role','TlETWcS2cTlES0ET1ET0E');")){
                    $lstid=$conn->insert_id;
                    $roltyp=htmlentities(mysqli_real_escape_string($conn,$rol));
                    $roltp=($roltyp!="A Member"?($roltyp=="Admin"?"an Admin":"a $roltyp"):"a Member");
                    $this->notify($str,$psn,"srtmivtn","has invited you as $roltp of the team.");
                    $this->pshnfmsngr("cstm",$strid,$pid,"srols/r/$roltp");$nmbr="";
                    $sql="SELECT ruspig,rmuflm FROM roupldls WHERE usid='$pid';";
                    $query=$conn->query($sql);
                    if($query){if($query->num_rows>0){
                    $row=$query->fetch_assoc();
                    $nmbr.="<div class='strprdtsdtlsadntmstpcntnrdvcntngbx'>
                    <div class='strtemmbrupdtbtnscntngdvbx'>
                        <div class='strsprdtupdtddtlsdvbx'>
                        <div class='strsprdtsimgcntnrbx'>";
                        if($this->dec($row['ruspig'],$this->iky)!=""&&file_exists("../pflmgs/".$this->dec($row['ruspig'],$this->iky))){$nmbr.= "<img src='../pflmgs/".$this->dec($row['ruspig'],$this->iky)."' class='prdctsdsplypctre'>";}
                        $nmbr.="</div>
                        <div class='strcntngordritmdtlscntngdvbx'>
                            <div class='twotxtelpss prdtditmnmcntnrdvbx'>".strtoupper(substr($this->sbldc($row['rmuflm'],$this->iky),0,1)).substr($this->sbldc($row['rmuflm'],$this->iky),1)."</div>
                            <div class='prdtsrditmothdtlscntngdvbx'>$roltyp</div>
                        </div>
                        </div>
                        <div class='strstemrolupdtbtns'>
                                <div class='blewhtbns ivtdsts' style='margin:6px;'>Invited</div>
                                <div class='blewhtbns admrnpgrlbns rmvrolbtn' data-srl='".$this->enc($lstid,$this->strec,'mtr')."' data-ps='".$this->enc($pid,$this->iky,'mtr')."' style='background-color: #e1e1e1d6;color: darkslategray;box-shadow: 0 0 0 black;'>Cancle</div>
                         </div>
                    </div>
                    </div>";}}
                    return json_encode(["s"=>"iq1","nmbr"=>$nmbr]);}else{return json_encode(["s"=>'iq0']);}
            }
        }else{return json_encode(["s"=>"q0"]);}
        }
        }}else{return json_encode(["s"=>'q0']);}
        }elseif($au=="u"){
            $rlid=$this->dec(htmlentities(mysqli_real_escape_string($conn,$srld)),$this->strec);
            if($conn->query("UPDATE strtemrls SET strolofpsn='$role' WHERE rlid='$rlid' AND sridtoasngrl='$str' AND psnidassrol='$psn';")){
                $roltyp=htmlentities(mysqli_real_escape_string($conn,$rol));$roltp=$roltyp!="A Member"?($roltyp=="Admin"?"an Admin":"a $roltyp"):"a Member";
                $this->notify($str,$psn,"srtmrlchng","has updated your role as $roltp of the team.");$this->pshnfmsngr("cstm",$strid,$pid,"srols/r/$roltp");
                return json_encode(["s"=>"u1"]);}else{return json_encode(["s"=>"u0"]);}
        }
        }else{return json_encode(["s"=>"p0"]);}
        }else{return json_encode(["s"=>"nac0"]);}
        }else{return json_encode(["s"=>"qpv0"]);}
    }
    public function shpplinrmdo($nm){
        $conn=$this->connect();
        $nme=$this->sblen(trim(htmlentities(mysqli_real_escape_string($conn,$nm))),$this->iky,'idx');$myuid=htmlentities(mysqli_real_escape_string($conn,$_SESSION['ssndi']));
        $sql="SELECT usid,rmuflm,ruspig FROM roupldls WHERE runm LIKE '%$nme%' AND usid!='$myuid' OR rmuflm LIKE '%$nme%' AND usid!='$myuid' LIMIT 6;";
        $query=$conn->query($sql);
        if($query){
            if($query->num_rows>0){
                while($row=$query->fetch_assoc()){
                    echo "<div class='fchdusrdlscntngdvbx'>
                        <div class='usrpigcntngdvbx'>";
                        if($this->dec($row['ruspig'],$this->iky)!=""&&file_exists("../pflmgs/".$this->dec($row['ruspig'],$this->iky))){echo "<img src='../pflmgs/".$this->dec($row['ruspig'],$this->iky)."' style='object-fit:cover;height:100%;width:100%;border-radius:46px;'>";}
                        echo"</div>
                        <div class='usrrlnmcntngdvbx' data-p='".$this->enc($row['usid'],$this->iky,'mtr')."'>".strtoupper(substr($this->sbldc($row["rmuflm"],$this->iky),0,1)).substr($this->sbldc($row["rmuflm"],$this->iky),1)."</div>
                    </div>";
                }
            }else{return 0;}
        }else{return 'q0';}
    }
    public function rmvprsnfrmtm($s,$p,$did,$ps){
        $conn=$this->connect();
        $psw=htmlentities(mysqli_real_escape_string($conn,$ps));
        $usid=htmlentities(mysqli_real_escape_string($conn,$_SESSION['ssndi']));
        $sql="SELECT rusacpd FROM roupldls WHERE usid ='$usid';";
        $query=$conn->query($sql);
        if($query){
        if($query->num_rows>0){
        if(password_verify($psw,$query->fetch_assoc()['rusacpd'])){
            $sid=$this->enc($this->dec(htmlentities(mysqli_real_escape_string($conn,$s)),$this->strec),$this->strec,'strix');
            $psn=$this->enc($this->dec(htmlentities(mysqli_real_escape_string($conn,$p)),$this->iky),$this->iky,'idx');
            $dlid=$this->dec(htmlentities(mysqli_real_escape_string($conn,$did)),$this->strec);
            $who=$this->dec(htmlentities(mysqli_real_escape_string($conn,$p)),$this->iky)==$_SESSION['ssndi']?"me":"nme";
            if($conn->query("DELETE FROM strtemrls WHERE rlid='$dlid' AND sridtoasngrl='$sid' AND psnidassrol='$psn';")){return json_encode(["s"=>1,"w"=>$who]);}else{return json_encode(["s"=>0,"w"=>$who]);}
        }else{return json_encode(["s"=>"p0"]);}
        }else{return json_encode(["s"=>"nac0"]);}
        }else{return json_encode(["s"=>"qpv0"]);}
    }
    public function acptoignrtojnstm($s,$aoj){
        $conn=$this->connect();
        $sid=$this->enc($this->dec(htmlentities(mysqli_real_escape_string($conn,$s)),$this->strec),$this->strec,'strix');
        $psn=$this->enc(htmlentities(mysqli_real_escape_string($conn,$_SESSION['ssndi'])),$this->iky,'idx');
        if($aoj=="a"){
        if($conn->query("UPDATE strtemrls SET stortmbrsts='YmcU3cVFEU2cUVEUUE' WHERE sridtoasngrl='$sid' AND psnidassrol='$psn';")){
            $onft=$this->enc("srtmivtn",$this->strec,'strix');
            $jonft=$this->enc("srtmjnd",$this->strec,'strix');
            if($conn->query("UPDATE alntfcns SET ntftyp='$jonft',ntfopnd='RlE9PTo6MTIzMjU2NzM5MTA0MTEyMQ==' WHERE sndr='$sid' AND rcvr='$psn' AND ntftyp='$onft';"))return 1;}else{return 0;}
        }elseif($aoj=="i"){
        if($conn->query("DELETE FROM strtemrls WHERE sridtoasngrl='$sid' AND psnidassrol='$psn';")){
            $onft=$this->enc("srtmivtn",$this->strec,'strix');
            $jonft=$this->enc("srtmrjctd",$this->strec,'strix');if($conn->query("UPDATE alntfcns SET ntftyp='$jonft',ntfopnd='RlE9PTo6MTIzMjU2NzM5MTA0MTEyMQ==' WHERE sndr='$sid' AND rcvr='$psn' AND ntftyp='$onft';"))return 1;}else{return 0;}
        }
    }
}
$s=new strdtlscurd();
if(isset($_POST['strsgns'])&&$_POST['strsgns']=="tresgnssrs"&&isset($_POST['os'])&&isset($_POST['lt'])){
    echo $s->dspstrs(false,false,"",$_POST['os'],$_POST['lt']);
}
if(isset($_POST['strpnds'])&&$_POST['strpnds']=="trepnssrs"&&isset($_POST['os'])&&isset($_POST['lt'])){
    echo $s->dspstrs(true,false,"",$_POST['os'],$_POST['lt']);
}
if(isset($_POST['srchsrs'])&&$_POST['srchsrs']=="srchtres"&&isset($_POST['srh'])&&isset($_POST['os'])&&isset($_POST['lt'])){
    echo $s->dspstrs(false,true,$_POST['srh'],$_POST['os'],$_POST['lt']);
}
if(isset($_POST['stpdcmrs'])&&$_POST['stpdcmrs']=="trepncms"&&isset($_POST['s'])&&isset($_POST['os'])&&isset($_POST['lt'])){
    echo $s->pndcmrsinstronr($_POST['s'],false,$_POST['os'],$_POST['lt']);
}
if(isset($_POST['stpdcmrs'])&&$_POST['stpdcmrs']=="trepncascms"&&isset($_POST['s'])&&isset($_POST['os'])&&isset($_POST['lt'])){
    echo $s->pndcmrsinstronr($_POST['s'],true,$_POST['os'],$_POST['lt']);
}
if(isset($_POST['adstrol'])&&$_POST['adstrol']=="adstroltreys"&&isset($_POST['sd'])&&isset($_POST['pd'])&&isset($_POST['rl'])&&isset($_POST['ps'])&&isset($_POST['srd'])&&isset($_POST['aou'])){
    echo $s->adstrols($_POST['sd'],$_POST['pd'],$_POST['rl'],$_POST['ps'],$_POST['srd'],$_POST['aou']);
}
if(isset($_POST['rmvstrol'])&&$_POST['rmvstrol']=="rmvstroltreys"&&isset($_POST['s'])&&isset($_POST['psn'])&&isset($_POST['d'])&&isset($_POST['ps'])){
    echo $s->rmvprsnfrmtm($_POST['s'],$_POST['psn'],$_POST['d'],$_POST['ps']);
}
if(isset($_POST['acptstrtmbr'])&&$_POST['acptstrtmbr']=="treysacpt"&&isset($_POST['s'])){
    echo $s->acptoignrtojnstm($_POST['s'],"a");
}
if(isset($_POST['igrstrtmbr'])&&$_POST['igrstrtmbr']=="treysigr"&&isset($_POST['s'])){
    echo $s->acptoignrtojnstm($_POST['s'],"i");
}
if(isset($_GET['shurs'])&&$_GET['shurs']=="shsurstre"&&isset($_GET['n'])){
    echo $s->shpplinrmdo($_GET['n']);
}
if(isset($_GET['fhsrls'])&&$_GET['fhsrls']=="fhrlsofstrtre"&&isset($_GET['s'])&&isset($_GET['o'])&&isset($_GET['w'])&&isset($_GET['l'])){
    echo $s->storols($_GET['w'],$_GET['s'],$_GET['o'],$_GET['l']);
}
?>