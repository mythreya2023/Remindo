<?php
session_start();
include '../db_conn.php';
class ortvrcls extends dbconnect{
    private function fhodrs($sid,$typ,$ostp,$os,$lt){
        $conn=$this->connect();
        $o=htmlentities($os);$l=htmlentities($lt);
        $strid=$this->enc($this->dec(htmlentities(mysqli_real_escape_string($conn,$sid)),$this->strec),$this->strec,'strix');
        $cmrid=$this->enc(htmlentities(mysqli_real_escape_string($conn,$_SESSION['ssndi'])),$this->iky,'idx');
        $ostyp=htmlentities(mysqli_real_escape_string($conn,$ostp));
        $pcrs2="Rmc9PTo6MTIzMjU2NzM5MTA0MTEyMQ==";
        $pcrs0="RkE9PTo6MTIzMjU2NzM5MTA0MTEyMQ==";
        $pcrs_1="Q1lrPTo6MTIzMjU2NzM5MTA0MTEyMQ==";
        $pckodr1=$this->enc(1,$this->strec,'strix');
        $pcrs3="Rnc9PTo6MTIzMjU2NzM5MTA0MTEyMQ==";
        $pcrs4="RUE9PTo6MTIzMjU2NzM5MTA0MTEyMQ==";
        $pcrs5="RVE9PTo6MTIzMjU2NzM5MTA0MTEyMQ==";
        if($typ=='tcmr'){$sql="SELECT * FROM pplstsodrmrrs WHERE odrcsmrnmr='$cmrid' AND odrstnmr='$strid' ORDER BY odrmrnmr DESC LIMIT $o, $l;";}
        elseif($typ=='tstr'){
            if($l=="sch"){
                $oid=$this->sbldc(htmlentities(mysqli_real_escape_string($conn,$o)),$this->strec);
                $sql="SELECT * FROM pplstsodrmrrs WHERE odrmrnmr='$oid' AND odrstnmr='$strid' AND (odrsts!='$pckodr1' AND odrsts!='$pcrs0' AND odrsts!='$pcrs_1' AND odrsts!='$pcrs2') ORDER BY odrmrnmr ASC LIMIT 1;";
            }else{
            $osts="AND (odrsts='$pckodr1' OR odrsts='$pcrs2')";
            if($ostyp=="upk"){$osts="AND (odrsts='$pckodr1' OR odrsts='$pcrs2')";}
            elseif($ostyp=="apk"){$osts="AND (odrsts='$pcrs3' OR odrsts='$pcrs4')";}elseif($ostyp=="rtd"){$osts="AND odrsts='$pcrs5'";}
            $sql="SELECT * FROM pplstsodrmrrs WHERE odrstnmr='$strid' $osts ORDER BY odrmrnmr ASC LIMIT $o, $l;";}
        }
        $query=$conn->query($sql);
        if($query){
            if($query->num_rows>0){
                while($row=$query->fetch_assoc()){$data[]=$row;}
                return $data;
            }else{return 0;}
        }else{return 'q0';}
    }
    public function ttnmofodrs($sid){
        $conn=$this->connect();
        $pcrs2=$this->enc(2,$this->strec,'strix');
        $pckodr1=$this->enc(1,$this->strec,'strix');
        $strid=$this->enc($this->dec(htmlentities(mysqli_real_escape_string($conn,$sid)),$this->strec),$this->strec,'strix');
        $sql="SELECT odrmrnmr FROM pplstsodrmrrs WHERE odrstnmr='$strid' AND (odrsts='$pckodr1' OR odrsts='$pcrs2');";
        $query=$conn->query($sql);
        if($query){
            return $query->num_rows;
        }else{return 'q0';}
    }
    private function fhusdls($usr){
        $conn=$this->connect();
        $u=htmlentities(mysqli_real_escape_string($conn,$usr));
        $sql="SELECT usid,rmuflm,runm,ruspig,usrlocty,usrpnmr,usrpncd,usrstat,usrcty FROM roupldls WHERE usid='$usr';";
        $query=$conn->query($sql);
        if($query){
            if($query->num_rows>0){
                return $row=$query->fetch_assoc();
            }else{return 0;}
        }else{return 'q0';}
    }
    private function pdtls($pid,$sid){
        $conn=$this->connect();
        $p=htmlentities(mysqli_real_escape_string($conn,$pid));
        $s=$this->enc(htmlentities(mysqli_real_escape_string($conn,$sid)),$this->strec,'strix');
        $sql="SELECT strspdtnum,prdtpto,prdtnm,prdtqnty,pdtqlty,pdtfhrs,pdtmrdlsdsrpn,pdtsts,pdtlstupdt,prdtstrtmtp FROM prdcsinstr WHERE strspdtnum='$p' AND strnmr='$s';";
        $query=$conn->query($sql);
        if($query){
            if($query->num_rows>0){
                return $row=$query->fetch_assoc();
            }else{return 0;}
        }else{return 'q0';}
    }
    public function stronrodrs($strg,$sid,$ostp,$os,$lt){
        if($strg){$odrs=$this->fhodrs($sid,"tstr",$ostp,$os,$lt);}
        else{$odrs=$this->fhodrs($sid,"tcmr","",$os,$lt);}
        if($odrs!="q0"){
            if($odrs!=0){
                foreach($odrs as $odr){
                    $odsts=$this->dec($odr['odrsts'],$this->strec);
                    $cdls=$this->fhusdls($this->dec($odr['odrcsmrnmr'],$this->iky));
                    $uadls=$this->sbldc($cdls['rmuflm'],$this->iky)."/||/".$this->dec($cdls['usrlocty'],$this->iky)."/||/".$this->dec($cdls['usrcty'],$this->iky)."/||/".$this->dec($cdls['usrstat'],$this->iky)."/||/".$this->dec($cdls['usrpncd'],$this->iky)."/||/".$this->dec($cdls['usrpnmr'],$this->iky);
                    echo "<div class='odrdlsttostrcntnrdvbx strecstmrmnodrlstdvtgbx'";
                    if($strg){echo "data-nm='".$this->sbldc($cdls['rmuflm'],$this->iky)."' data-at='".$this->sbldc($cdls['runm'],$this->iky)."' data-adrs='$uadls' data-oi='".$this->sblen($odr['odrmrnmr'],$this->strec,'strix')."' data-i='../pflmgs/".$this->dec($cdls['ruspig'],$this->iky)."'";}
                    echo ">
                    <article class='ordrdlstartletgcntnrdvbox' data-or='".$this->enc($odr['odrmrnmr'],$this->strec,'mtr')."' data-pd='0' data-cd='".$this->enc($cdls['usid'],$this->iky,'mtr')."'>
                        <div class='relordlstdvbx'>
                            <div class='ordrlsthdrcntnrdvbx'>
                                <div class='odrdtmeothoptnstphdrcntnrdvbx'>
                                    <div class='odrddtmecntnrdvbx'><strong>Orderd On :</strong>".$this->dec($odr['odrplcdtm'],$this->strec)."</div>
                                    <div class='mroptstothsodrcntnrdvbx'>";
                                    if($strg){echo "<div class='strscmstrsprflimgcntnrdvbx' >
                                        <img src='../pflmgs/".$this->dec($cdls['ruspig'],$this->iky)."' class='stescstmrsprflimgonevryodr'>
                                    </div>";}
                                    else{
                                        if($this->dec($odr['odrsts'],$this->strec)<=4){
                                        echo "<div class='mroptsdvbxbtn' data-or='".$this->enc($odr['odrmrnmr'],$this->strec,'mtr')."' role='button'><i class='fas fa-ellipsis-h'></i></div>";
                                        }
                                    }
                                    echo "</div>
                                </div>
                                <div class='noitmsinlstbtmhrctnrdvbx'> Items</div>
                            </div>
                            <div class='ordrlstbdycntnrdvbx'>
                                <div class='lstditmsinodrlstcntnrdvbx'>";
                                $str=$this->dec($odr['odrcntnt'],$this->strec);
                                $exstr=explode("/,",$str);
                                $pdts=[];
                                foreach($exstr as $e){
                                    $exs=explode(",",$e);
                                    $nar=[];
                                foreach($exs as $ex){
                                    $ext=explode(':',$ex);
                                    $nar = $nar+[$ext[0]=>$ext[1]];
                                }
                                array_push($pdts,$nar);
                                }
                                foreach($pdts as $pdt){
                                    $prdt=$this->pdtls($this->sbldc($pdt['pid'],$this->strec),$this->dec($odr['odrstnmr'],$this->strec));
                                    echo "<div class='odrditmartclcntnrdvbx ";
                                    if($prdt==0){echo "shngotstkprdts";}
                                    echo"'>";
                                    if($prdt!=0){
                                        if($strg){echo "<div class='ordditmimgcntngdvbx prdtditmnmcntnrdvbx' data-tle='".strtoupper(substr($this->sbldc($prdt['prdtnm'],$this->strec),0,1)).substr($this->sbldc($prdt['prdtnm'],$this->strec),1)."'  data-szs='".$pdt['qnty']."' data-pce='".$pdt['pprc']."' data-pfcrs='".$this->sbldc($prdt['pdtfhrs'],$this->strec)."' data-dcptn='".$this->dec($prdt['pdtmrdlsdsrpn'],$this->strec)."' data-rpigs='".$this->dec($prdt['prdtpto'],$this->strec)."' data-pid='".$this->sblen($prdt['strspdtnum'],$this->strec,'strix')."' data-istk='".(($this->dec($prdt['pdtsts'],$this->strec)=="1")?"In stock":"Out of stock")."' data-luptd='".$this->timefrendly($this->dec($prdt['pdtlstupdt'],$this->strec),$this->dec($prdt['prdtstrtmtp'],$this->strec))."'>";}
                                        else{echo "<div class='ordditmimgcntngdvbx' >";}
                                        if(explode("/,",$this->dec($prdt['prdtpto'],$this->strec))[0]!=""&&file_exists("../strpdtspcs/".explode("/,",$this->dec($prdt['prdtpto'],$this->strec))[0])){echo "<img     class='strcntngitmimg' src='../strpdtspcs/".explode("/,",$this->dec($prdt['prdtpto'],$this->strec))[0]."'>";}
                                        echo "</div>
                                        <div class='strcntngordritmdtlscntngdvbx'>
                                            <div class='cmrsdsrditmnmcntnrdvbx hstpt' data-tooltip='".strtoupper(substr($this->sbldc($prdt['prdtnm'],$this->strec),0,1)).substr($this->sbldc($prdt['prdtnm'],$this->strec),1)."'>".strtoupper(substr($this->sbldc($prdt['prdtnm'],$this->strec),0,1)).substr($this->sbldc($prdt['prdtnm'],$this->strec),1)."</div>
                                            <div class='cmrdsrditmothdtlscntngdvbx'>
                                            <div class='cmrdsrditmqntycntnrdvbx'>.".$pdt['qnty']."</div>
                                            <div class='cmrdsrditmpcdorlscntnrdvbx'>.".$this->dec($prdt['pdtqlty'],$this->strec)."</div>
                                            </div>
                                        </div>
                                        <div class='stronrchckbxandprcngadnqntydtlscntngdvbx'>
                                            <div class='strownrpgodrngitmsqntyandprccntngdvbx'>
                                                <div class='stronrpgitmsqntyctnrdvbx'>
                                                    <span class='qntyhdngofitmspntgasbx'><strong>Qty:</strong></span>
                                                    <span class='qntinnmofthsitmbxnspng'>".$pdt['qty']."</span>
                                                </div>
                                                <div class='strownrpgordrditmsprceandcrncycntnrdvbx' style='margin: 3px 0;'>
                                                    <div class='strownrordrditmprccntnrdvbx odritmcstdtatcnttl' data-cst='".$pdt['pprc']."'></div>
                                                    <div class='strownrordrditmcrncycntngdvbx'>₹</div>
                                                </div>
                                                <div class='strownrpgordrditmsprceandcrncycntnrdvbx' style='font-size:14px;border-top:1px solid gray'>
                                                    <div class='strownrordrditmprccntnrdvbx'>".$pdt['pprc']."</div>
                                                    <div class='strownrordrditmcrncycntngdvbx'>₹</div>
                                                </div>
                                            </div>";
                                           if($strg){echo "<div class='chckbxbtncntnrdvbx'>
                                                <input type='checkbox' data-p='".$this->enc($prdt['strspdtnum'],$this->strec,'mtr')."' class='chckbxtochcktheitmthatpackd'";
                                                if($odsts >="3"){echo "checked style='display:none;'";}echo">
                                            </div>";}
                                        echo "</div>";
                                    }else{echo "<p class='pdtotofstkstsptg' style='    margin: revert;top: 0;'>Product deleted</p>";}
                                    echo "</div>";
                                }
                                echo "</div>
                                <div class='ttlamtofalllsttopycntnrdvbx' style='font-size:16px;padding-bottom:0;'>
                                    <div class='ttlamtttlecntnrdvbx'><strong>Total Ammount :</strong></div>
                                    <div class='amtcnrcycntnrdvbx'><span class='ttlamntwthcrncyspntg'>0</span><span class='crcysmblspntg'>₹</span></div>
                                </div>
                                <div class='odrgstccgpcdlscntnrdvbx' style='text-align: center;padding: 5px;padding-top:0;cursor: context-menu;font-size: 16px;'>";
                                    if($this->dec($odr['odrcrcg'],$this->strec)!=""){echo "<div class='ttlamtccgecntnrdvbx' style='display: flex;justify-content: space-between;align-items: center;margin-top:5px;'><strong>Courier Charge :</strong>
                                    <span class='crcgamntcrncyspntg'>".$this->dec($odr['odrcrcg'],$this->strec)."₹</span></div>";}
                                    if($this->dec($odr['odrgstxpc'],$this->strec)!=""){echo "<div class='tamtgstcntnrdvbx' style='display: flex;justify-content: space-between;align-items: center;margin-top:5px;'><strong>GST :</strong>
                                    <span class='ttlamntgstcrncyspntg'>".$this->dec($odr['odrgstxpc'],$this->strec)."₹</span></div>";}
                                    echo "<div class='tamtcnrcycntnrdvbx' style='display: flex;justify-content: space-between;align-items: center;font-size:20px;margin-top:5px;'><strong>Total Ammount :</strong>
                                    <span class='ttlamntwthccgstspntg'>0₹</span></div>
                                </div>
                            </div>
                            <div class='ordrlstftrcntnrdvbox'>";
                                if($strg){
                                    $opts=$this->dec($odr['odrpmtsts'],$this->strec);
                                    if($odsts<5){
                                    if($opts=="CAS"){
                                    echo "<div class='sdordrtostrbtn'>C.A.S(Cash At Store)</div>";}
                                    elseif($opts=="ppd"){
                                    echo "<div class='sdordrtostrbtn'>Prepaid</div>";}
                                    elseif($opts!=""){
                                    echo "<div class='odrvrfycninodr' style='padding: 5px;border: 1px solid lightgray;border-radius: 6px;background: #d2e3fc;color: #2c74d6;'>
                                        <div class=''>$opts</div>
                                        <div style='display: flex;justify-content: space-around;align-items: center;
                                        margin: 10px 0 2px 0;'><div class='noodrpidfls' data-o='".$this->enc($odr['odrmrnmr'],$this->strec,'mtr')."' data-c='".$this->enc($this->dec($odr['odrcsmrnmr'],$this->iky),$this->strec,'mtr')."' style='width: 50%;background: lightcyan;border-radius: 5px;text-align: center;margin: 0 6px;'>No</div><div class='ysodrpidtre' data-o='".$this->enc($odr['odrmrnmr'],$this->strec,'mtr')."' data-c='".$this->enc($this->dec($odr['odrcsmrnmr'],$this->iky),$this->strec,'mtr')."' style='width: 50%;background: lightcyan;border-radius: 5px;text-align: center;margin: 0 6px;'>Yes</div></div>
                                    </div>";
                                    }
                                    }else{
                                        if($odsts=="5"){
                                        echo "<div class='sntrmrodraspndng sndtodlvryodrbtn' data-o='".$this->enc($odr['odrmrnmr'],$this->strec,'mtr')."' data-c='".$this->enc($this->dec($odr['odrcsmrnmr'],$this->iky),$this->strec,'mtr')."' id='dne' style='background: #f99500b5;color:white'><i class='fas fa-shipping-fast remindosymbols'style='color:white'></i> Send to delivery(";
                                        if($opts=="ppd"){echo "Prepaid";}else{echo $opts;} echo")</div>";}
                                        elseif($odsts=="6"){
                                        echo "<div class='sntrmrodraspndng 'id='dne' style='background: #f99500b5;color:white'><i class='fas fa-shipping-fast remindosymbols'style='color:white'></i> Delivering...(";
                                        if($opts=="ppd"){echo "Prepaid";}else{echo $opts;} echo")</div>";}
                                        elseif($odsts=="7"){
                                        echo "<div class='sntrmrodraspndng 'id='dne' style='background: #f99500b5;color:white'><i class='fas fa-shipping-fast remindosymbols'style='color:white'></i> Delivered(";
                                        if($opts=="ppd"){echo "Prepaid";}else{echo $opts;} echo")</div>";}
                                    }
                                }
                                else{
                                    if($odsts==0){
                                        // echo "<div class='sdordrtostrbtn' id='strodrsdtosrbn' data-onm='".$this->enc($odr['odrmrnmr'],$this->strec,'mtr')."' data-p='vfyptmsidtre'>Order</div>";
                                        echo "<div class='sdordrtostrbtn' id='strodrnsdtosrbn' data-onm='".$this->enc($odr['odrmrnmr'],$this->strec,'mtr')."' data-p='vfyptmsidtre'>Order</div>";
                                    }elseif($odsts==-1){
                                        // echo "<div class='sdordrtostrbtn' id='strodrsdtosrbn' data-onm='".$this->enc($odr['odrmrnmr'],$this->strec,'mtr')."' data-p='vfyntptmsidfs'>Order</div>";
                                        
                                        echo "<div class='sdordrtostrbtn' id='strodrnsdtosrbn' data-onm='".$this->enc($odr['odrmrnmr'],$this->strec,'mtr')."' data-p='vfyptmsidtre'>Order</div>";
                                    }elseif($odsts==1){
                                        echo "<div class='sntrmrodraspndng odrstsdsplyr' data-oi='".$this->sblen($odr['odrmrnmr'],$this->strec,'strix')."' data-od='".$this->enc($odr['odrmrnmr'],$this->strec,'mtr')."' id='undne'><i class='fas fa-clock remindosymbols'></i>Pending</div>";
                                    }elseif($odsts==2){
                                        echo "<div class='sntrmrodraspndng odrstsdsplyr' data-oi='".$this->sblen($odr['odrmrnmr'],$this->strec,'strix')."' data-od='".$this->enc($odr['odrmrnmr'],$this->strec,'mtr')."' id='undne'><i class='fas fa-box remindosymbols'></i>Packing...</div>";
                                    }elseif($odsts==3){
                                        echo "<div class='sntrmrodraspndng odrpcdtopy' data-oi='".$this->sblen($odr['odrmrnmr'],$this->strec,'strix')."' data-onm='".$this->enc($odr['odrmrnmr'],$this->strec,'mtr')."' id='dne'><i class='fas fa-box remindosymbols'></i>Packed | Pay >></div>";
                                    }elseif($odsts==4){
                                        echo "<div class='sntrmrodraspndng odrstsdsplyr' data-oi='".$this->sblen($odr['odrmrnmr'],$this->strec,'strix')."' data-onm='".$this->enc($odr['odrmrnmr'],$this->strec,'mtr')."' >Verifying payment from store...</div>";
                                    }elseif($odsts==5){
                                        echo "<div class='sntrmrodraspndng odrstsdsplyr' data-oi='".$this->sblen($odr['odrmrnmr'],$this->strec,'strix')."' data-onm='".$this->enc($odr['odrmrnmr'],$this->strec,'mtr')."' id='dne'><i class='fas fa-truck-loading remindosymbols'></i> will be delivered</div>";
                                    }elseif($odsts==6){
                                        echo "<div class='sntrmrodraspndng odrstsdsplyr odrdlvrngnfyr' data-oi='".$this->sblen($odr['odrmrnmr'],$this->strec,'strix')."' data-onm='".$this->enc($odr['odrmrnmr'],$this->strec,'mtr')."' data-dx='".$this->dec($odr['odrdlvrydls'],$this->strec)."' id='dne'><i class='fas fa-shipping-fast remindosymbols'></i> Delivering...</div>";
                                    }elseif($odsts==7){
                                        echo "<div class='sntrmrodraspndng odrstsdsplyr' data-oi='".$this->sblen($odr['odrmrnmr'],$this->strec,'strix')."' data-onm='".$this->enc($odr['odrmrnmr'],$this->strec,'mtr')."' data-dx='".$this->dec($odr['odrdlvrydls'],$this->strec)."' id='dne'><i class='fas fa-shipping-fast remindosymbols'></i> Delivered</div>";
                                    }
                                }
                            echo "</div>
                        </div>
                    </article>
                </div>";
                }
            }else{return 0;}
        }else{return "q0";}
    }
    protected function stracntavblvrfy($sid,$typ){
        $conn=$this->connect();
        if($typ=="ths"){$strid=htmlentities($sid);
            $sql="SELECT stnmr,strnm,stratmnt,strbprflig FROM stsinmtplc WHERE stnmr='$strid';";
            $query=$conn->query($sql);
            if($query){
                if($query->num_rows>0){
                    $row=$query->fetch_assoc();
                    return $row;
                }else{return 0;}
            }else{return "q0";}
        }
        elseif($typ=="my"){$cmrid=$this->enc(htmlentities($_SESSION['ssndi']),$this->iky,'idx');
        $sql="SELECT stnmr,strnm,stratmnt,strbprflig FROM stsinmtplc WHERE strbsnonr='$cmrid' ORDER BY strstcmspnd LIMIT 5;";
        $query=$conn->query($sql);
        if($query){
            if($query->num_rows>0){
                while($row=$query->fetch_assoc()){
                    $data[]=$row;
                }return $data;
            }else{return 0;}
        }else{return "q0";}
        }
    }
    public function ntfcns($sid,$typ,$o,$lt){
        $conn=$this->connect();
        $strid=$this->enc(htmlentities($sid),$this->strec,'strix');
        $ntfysen=$this->enc(0,$this->strec,'strix');
        $cmrid=$this->enc(htmlentities($_SESSION['ssndi']),$this->iky,'idx');
        $ntfysen=$this->enc(0,$this->strec,'strix');
        $nfond=$this->enc(0,$this->strec,"strix");
        $notyp=$this->enc(htmlentities(mysqli_real_escape_string($conn,"spmtak")),$this->strec,"strix");
        if($typ=="strmvfy"){
        $sql="SELECT nid,sndr,ntfymg,ntfopnd,ntfysnddt FROM alntfcns WHERE rcvr='$strid' AND ntftyp='$notyp' AND ntfopnd='$nfond' ORDER BY 1 DESC LIMIT 10;";}
        elseif($typ=='nstr'){
        $sql="SELECT nid,sndr,ntfymg,ntftyp,ntfopnd,ntfysnddt FROM alntfcns WHERE rcvr='$cmrid' ORDER BY 1 DESC LIMIT $o,$lt;";
        }
        $query=$conn->query($sql);
        if($query){
            if($query->num_rows>0){
                while($row=$query->fetch_assoc()){
                    $data[]=$row;
                }return $data;
            }else{return 0;}
        }else{return "q0";}
    }
    public function hmpgdashbrd($gstr,$os,$lt){
        if($gstr=="strdls"){
        $ckstravbl=$this->stracntavblvrfy("",'my');
        if($ckstravbl!=0&&$ckstravbl!="q0"){
            foreach($ckstravbl as $strdls){
                $ntfns=$this->ntfcns($strdls['stnmr'],"strmvfy",$os,$lt);
                if($ntfns!=0){
                echo "<section class='rmosrsptsvfcnssctnbx'>
                <div class='sctnbdyctngdvbx'>";
                foreach($ntfns as $ntfn){
                echo "<div class='artclpmtstrvfcndvbx'><div class='pmtsmtrcntngdvbx'>
                <div class='strupdttmgscntntdvbx'><p class='ntfcamtmptg'>".$this->timefrendly($this->dec($ntfn['ntfysnddt'],$this->strec),"")."</p></div>
                <div class='pmtsdvbxcntngdvbx'>".$this->dec($ntfn['ntfymg'],$this->strec)."</div>
                <div class='pmtsvrfybtnsdvbx'><div class='pmtsvfybtns pmtsnovfybtn' data-n='".$this->enc($ntfn['nid'],$this->strec,'mtr')."' data-r='".$this->enc($strdls['stnmr'],$this->strec,'mtr')."' data-s='".$this->enc($ntfn['sndr'],$this->strec,'mtr')."' >No</div><div class='pmtsvfybtns pmtsystrevfybtns' data-n='".$this->enc($ntfn['nid'],$this->strec,'mtr')."' data-s='".$this->enc($ntfn['sndr'],$this->strec,'mtr')."' data-r='".$this->enc($strdls['stnmr'],$this->strec,'mtr')."'>Yes</div></div>
                </div></div>";
                }
                echo "</div>
                </section>";
                }
            }
            echo "<section class='rmosrsptsvfcnssctnbx'>
            <div class='sctnttlecntngdvbx'>Updates for your Businesses</div>
            <div class='sctnbdyctngdvbx sctnbdyudsfrstrbdy'>";
            foreach($ckstravbl as $strdls){
                echo "<div class='updtforyorstrcntngdvbx'>
                        <div class='uptfmstrstrnmdvbxadndelbtnbx'>
                            <div class='strntfnmdvbx'>
                                <div class='uptfmstrsstrpfimgdvbx'>";
                                if($this->dec($strdls['strbprflig'],$this->strec)!=""&&file_exists("../fhupuppts/".$this->dec($strdls['strbprflig'],$this->strec))){echo "<img src='fhupuppts/".$this->dec($strdls['strbprflig'],$this->strec)."' class='ntfstrpfig' >";}
                                echo "</div>
                                <div class='strtxtdtlslknmunmdvbx'>
                                <div class='onetxtelpss strnmntfcn gtstrpgclstrngtr' style='max-width:200px;' data-unm='".$this->sbldc($strdls['stratmnt'],$this->strec)."' data-pt='".$this->enc($strdls['stnmr'],$this->strec,'mtr')."'>".$this->sbldc($strdls['strnm'],$this->strec)."</div>
                                <div class='onetxtelpss strnmntfcn' style='max-width:200px;'>@".$this->sbldc($strdls['stratmnt'],$this->strec)."</div></div>
                            </div>
                        </div>
                        <div class='uptfmstrstrnmdvbx'>
                            <div class='strupdtodrscntngdvbx'>".$this->ttnmofodrs($this->enc($strdls['stnmr'],$this->strec,'mtr'))." Orders.</div>
                        </div>
                    </div>";
            }
            echo "</div>
            </section>";
        }else{echo "0";}
        }
    }
    public function rmoalntfcns($os,$lt){
        $ntfcns=$this->ntfcns("","nstr",$os,$lt);
        if($ntfcns!=0&&$ntfcns!="q0"){
            foreach($ntfcns as $ntf){
                $strdls=$this->stracntavblvrfy($this->dec($ntf['sndr'],$this->strec),'ths');
                echo "<div class='rmdusr-orgnl-ntfcndvbx'><a style='color:black;text-decoration:none;' class='nfatgtonvgt'";
                if($this->dec($ntf['ntftyp'],$this->strec)=="srtmjnd"||$this->dec($ntf['ntftyp'],$this->strec)=="srtmrlchng"){echo"href='http://localhost/remindo/stores/storeroles?s=".$this->sbldc($strdls['stratmnt'],$this->strec);}else{echo"href='http://localhost/remindo/stores/store?s=".$this->sbldc($strdls['stratmnt'],$this->strec);}
                    echo "'><div class='ntfcn-dtlsandotropns-cntngdvbx'>
                    <div class='ntfcn-snsts-dvbx'>";
                        if($this->dec($ntf['ntfopnd'],$this->strec)==0){
                            echo "<i class='fas fa-circle remindosymbols' style='color:#ffb74d;font-size:6px;'></i>";
                        }
                    echo "</div>
                    <div class='ntfcn-prfl-ptodvbx'>";
                    if($this->dec($strdls['strbprflig'],$this->strec)!=""&&file_exists("../fhupuppts/".$this->dec($strdls['strbprflig'],$this->strec))){echo "<img src='fhupuppts/".$this->dec($strdls['strbprflig'],$this->strec)."' class='ntfcn-dpig' >";}
                    echo "</div>
                    <div class='ntfcn-cntnt-txtcntdvbx' data-opd='".$this->dec($ntf['ntfopnd'],$this->strec)."' data-n='".substr($this->enc($ntf['nid'],$this->strec,'mtr'),0,-2)."'>
                        <div class='ntfcn-dpcntxtdvbx' data-unm='".$this->sbldc($strdls['stratmnt'],$this->strec)."'><span style='color:gray;'>".$this->sbldc($strdls['strnm'],$this->strec).". </span>".$this->dec($ntf['ntfymg'],$this->strec)."</div>
                        <div class='ntfcns-ftr-othdls'>
                            <div class='ntfcn-camtmedsply'>".$this->timefrendly($this->dec($ntf['ntfysnddt'],$this->strec),"")."</div>
                            <div class='ntfcn-insrttp' style='width:fit-content;'>";
                                if($this->dec($ntf['ntftyp'],$this->strec)=="srtmivtn"){
                                    echo"<div class='acptordclnbtnscntngdvbx' style='display:flex;align-items:center;justify-content:felx-end;width:fit-content;'>
                                        <div class='ignrinvtnbtn' style='padding: 3px 6px;color: gray;cursor: pointer;' data-s='".$this->enc($this->dec($ntf['sndr'],$this->strec),$this->strec,'mtr')."'>Ignore</div>
                                        <div class='jininvtnbtn' style='padding: 3px 6px;border: 1px solid;background: #66bb6a;color: white;border-radius: 5px;' data-s='".$this->enc($this->dec($ntf['sndr'],$this->strec),$this->strec,'mtr')."'>Join</div>
                                    </div>";
                                }elseif($this->dec($ntf['ntftyp'],$this->strec)=="srtmrjctd"){
                                    echo"<div style='padding: 3px 6px;color: gray;cursor: pointer;'>Ignored!</div>";
                                }elseif($this->dec($ntf['ntftyp'],$this->strec)=="srtmjnd"){
                                    echo"<div style='padding: 3px 6px;color: green;cursor: pointer;'>Joined!</div>";
                                }elseif($this->dec($ntf['ntftyp'],$this->strec)=="srtmrlchng"){
                                    echo"<div style='padding: 3px 6px;color: orange;cursor: pointer;'>New Role!</div>";
                                }
                            echo "</div>
                        </div>
                    </div>
                    </div></a>
                </div>";
            }
            }else{return 0;}
    }

}
$odrtrv=new ortvrcls();
if(isset($_POST['fhodrsstr'])&&$_POST['fhodrsstr']=="ysstrefhstr"&&isset($_POST['s'])&&isset($_POST['o'])&&isset($_POST['l'])&&isset($_POST['t'])){
echo $odrtrv->stronrodrs(true,$_POST['s'],$_POST['t'],$_POST['o'],$_POST['l']);
}
if(isset($_POST['fhodrscr'])&&$_POST['fhodrscr']=="yscmrefhstr"&&isset($_POST['s'])&&isset($_POST['o'])&&isset($_POST['l'])){
echo $odrtrv->stronrodrs(false,$_POST['s'],"",$_POST['o'],$_POST['l']);
}
if(isset($_POST['gtalkdodrs'])&&$_POST['gtalkdodrs']=='ysgtaladrsupkdtre'&&$_POST['s']){
echo $odrtrv->ttnmofodrs($_POST['s']);
}
if(isset($_POST['gthmdshbrd'])&&$_POST['gthmdshbrd']=='ystrehmpgdshbrdshw'&&isset($_POST['os'])&&isset($_POST['lt'])){
echo $odrtrv->hmpgdashbrd("strdls",$_POST['os'],$_POST['lt']);
}
if(isset($_POST['usrupdts'])&&$_POST['usrupdts']=='ystreupdtsshw'&&isset($_POST['os'])&&isset($_POST['lt'])){
echo $odrtrv->hmpgdashbrd("upds",$_POST['os'],$_POST['lt']);
}
if(isset($_POST['alnfcns'])&&$_POST['alnfcns']=='alnfcstredsply'&&isset($_POST['os'])&&isset($_POST['lt'])){
echo $odrtrv->rmoalntfcns($_POST['os'],$_POST['lt']);
}
?>