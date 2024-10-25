<?php
session_start();
include '../db_conn.php';
class rtvpprds extends dbconnect{
    public function prdtsrchalgo($srhtxt){
        $ntnm=array();$pdtyp="";$pdqty="";$pdtnm="";$pric="";$qydn=false;
        $srhtxt=htmlentities(htmlspecialchars($srhtxt));$srhtxt=rtrim($srhtxt);$srhtxt=ltrim($srhtxt);
        if(!is_numeric($srhtxt)){
        $srch=explode(" ",$srhtxt);
        $kg=["kg","kgs","kilogram","kilograms","kilo","kilos"];
        $gms=["g","gram","grams","gm"];
        $ltr=["l","liter","liters","litres","litre","ltr"];
        $ml=["ml","milliliter","milliliters","millilitres","millilitre","mililiter"];
        $tons=["ton","tons"];
        $xl=["s","xs","l","xl","m","xxl","xxxl"];
        $mony=["rupees","/-","rupes","rups","₹","inr"];
        for($i=0;$i<=count($srch)-1;$i++){
            $sch=strtolower($srch[$i]);
            if($sch=="packed"||$sch=="pkd"||$sch=="pcked"||$sch=="Packd"){array_push($ntnm,$sch);$pdtyp="Packed";}
            elseif($sch=="loose"||$sch=="loos"||$sch=="lose"){$pdtyp="Loose";array_push($ntnm,$sch);}
            if(is_numeric($sch)){
                $cml=["ml","milliliter","milliliters","millilitres","millilitre","milli","mililiter",'mili'];
                $ctons=["ton","tons","tonn"];
                $isbk=false;$isfw=false;$bwrd="";$fwrd="";$gms=["g","gram","grams","gm"];
                if(isset($srch[$i-1])){$isbk=true;$bwrd=$srch[$i-1];}else{$isbk=false;}
                if(isset($srch[$i+1])){$isfw=true;$fwrd=$srch[$i+1];}else{$isfw=false;}
                if($isfw&&(in_array($fwrd,$kg)||in_array($fwrd,$gms)||in_array($fwrd,$ltr)||in_array($fwrd,$cml)||in_array($fwrd,$ctons)||in_array($fwrd,$xl))){
                    if(in_array($fwrd,$kg)){foreach($kg as $kg){$pdqty.=$sch." ".$kg."/,";}}
                    elseif(in_array($fwrd,$gms)){foreach($gms as $gms){$pdqty.=$sch." ".$gms."/,";}}
                    elseif(in_array($fwrd,$ltr)){foreach($ltr as $ltr){$pdqty.=$sch." ".$ltr."/,";}}
                    elseif(in_array($fwrd,$cml)){foreach($ml as $ml){$pdqty.=$sch." ".$ml."/,";}}
                    elseif(in_array($fwrd,$xl)){$pdqty=$sch." ".$fwrd."/,";}
                    elseif(in_array($fwrd,$ctons)){foreach($tons as $ton){$pdqty.=$sch." ".$ton."/,";}}
                    array_push($ntnm,$fwrd,$sch);$qydn=true;
                }elseif($isbk&&(in_array($bwrd,$kg)||in_array($bwrd,$gms)||in_array($bwrd,$ltr)||in_array($bwrd,$cml)||in_array($bwrd,$ctons)||in_array($fwrd,$xl))){
                    if(in_array($bwrd,$kg)){foreach($kg as $kg){$pdqty.=$sch." ".$kg."/,";}}
                    elseif(in_array($bwrd,$gms)){foreach($gms as $gms){$pdqty.=$sch." ".$gms."/,";}}
                    elseif(in_array($bwrd,$ltr)){foreach($ltr as $ltr){$pdqty.=$sch." ".$ltr."/,";}}
                    elseif(in_array($bwrd,$cml)){foreach($ml as $ml){$pdqty.=$sch." ".$ml."/,";}}
                    elseif(in_array($bwrd,$xl)){$pdqty=$sch." ".$bwrd."/,";}
                    elseif(in_array($bwrd,$ctons)){foreach($tons as $ton){$pdqty.=$sch." ".$ton."/,";}}
                    array_push($ntnm,$bwrd,$sch);$qydn=true;
                }elseif(in_array($bwrd,$mony)||in_array($fwrd,$mony)){
                    $pric=$sch;
                    if(in_array($bwrd,$mony)){array_push($ntnm,$bwrd,$sch);}
                    elseif(in_array($fwrd,$mony)){array_push($ntnm,$fwrd,$sch);}
                }
            }elseif(!$qydn){
                $qtnm=0;
                if(substr($sch,-2)=="kg"||substr($sch,-3)=="kgs"||substr($sch,-8)=="kilogram"||substr($sch,-9)=="kilograms"){
                    if(substr($sch,-2)=="kg"){$qtnm=substr($sch,0,-2);}
                    elseif(substr($sch,-8)=="kilogram"){$qtnm=substr($sch,0,-8);}
                    elseif(substr($sch,-3)=="kgs"){$qtnm=substr($sch,0,-3);}
                    elseif(substr($sch,-9)=="kilograms"){$qtnm=substr($sch,0,-9);}
                    foreach($kg as $kg){$pdqty.=$qtnm." ".$kg."/,";}
                    array_push($ntnm,$sch);
                }elseif(substr($sch,-1)=="g"||substr($sch,-2)=="gm"||substr($sch,-4)=="gram"||substr($sch,-5)=="grams"){
                    if(substr($sch,-1)=="g"){$qtnm=substr($sch,0,-1);}
                    elseif(substr($sch,-4)=="gram"){$qtnm=substr($sch,0,-4);}
                    elseif(substr($sch,-5)=="grams"){$qtnm=substr($sch,0,-5);}
                    elseif(substr($sch,-2)=="gm"){$qtnm=substr($sch,0,-2);}
                    foreach($gms as $gms){$pdqty.=$qtnm." ".$gms."/,";}
                    array_push($ntnm,$sch);
                }elseif(substr($sch,-4)=="tons"||substr($sch,-3)=="ton"||substr($sch,-4)=="tonn"){
                    if(substr($sch,-4)=="tons"){$qtnm=substr($sch,0,-4);}
                    elseif(substr($sch,-3)=="ton"){$qtnm=substr($sch,0,-3);}
                    elseif(substr($sch,-4)=="tonn"){$qtnm=substr($sch,0,-4);}
                    foreach($tons as $ton){$pdqty.=$qtnm." ".$ton."/,";}
                    array_push($ntnm,$sch);
                }elseif(substr($sch,-5)=="liter"||substr($sch,-6)=="liters"||substr($sch,-2)=="lt"||(substr($sch,-1)=="l"&&is_numeric(substr($sch,0,-1))&&substr($sch,-2)!="ml")){
                    if(substr($sch,-5)=="liter"){$qtnm=substr($sch,0,-5);}
                    elseif(substr($sch,-6)=="liters"){$qtnm=substr($sch,0,-6);}
                    elseif(substr($sch,-2)=="lt"){$qtnm=substr($sch,0,-2);}
                    elseif(substr($sch,-1)=="l"){$qtnm=substr($sch,0,-1);}
                    foreach($ltr as $ltr){$pdqty.=$qtnm." ".$ltr."/,";}
                    array_push($ntnm,$sch);
                }elseif(substr($sch,-10)=="milliliter"||substr($sch,-11)=="milliliters"||substr($sch,-2)=="ml"||substr($sch,-5)=="milli"){
                    if(substr($sch,-2)=="ml"){$qtnm=substr($sch,0,-2);}
                    elseif(substr($sch,-10)=="milliliter"){$qtnm=substr($sch,0,-10);}
                    elseif(substr($sch,-11)=="milliliters"){$qtnm=substr($sch,0,-11);}
                    elseif(substr($sch,-5)=="milli"){$qtnm=substr($sch,0,-5);}
                    foreach($ml as $ml){$pdqty.=$qtnm." ".$ml."/,";}
                    array_push($ntnm,$sch);
                }elseif(substr($sch,-2)=="/-"||substr($sch,-6)=="rupees"||substr($sch,-5)=="rupes"||substr($sch,-4)=="rups"||substr($sch,-3)=="inr"||substr($sch,-1)=="₹"){
                    if(substr($sch,-2)=="/-"){$qtnm=substr($sch,0,-2);}
                    elseif(substr($sch,-6)=="rupees"){$qtnm=substr($sch,0,-6);}
                    elseif(substr($sch,-5)=="rupes"){$qtnm=substr($sch,0,-5);}
                    elseif(substr($sch,-4)=="rups"){$qtnm=substr($sch,0,-4);}
                    elseif(substr($sch,-3)=="inr"){$qtnm=substr($sch,0,-3);}
                    elseif(substr($sch,-1)=="₹"){$qtnm=substr($sch,0,-1);}
                    $pric=$qtnm;array_push($ntnm,$sch);}
            }
            if(!in_array($sch,$ntnm)){$pdtnm.=$sch." ";}
        }
        $pdtls=[$pdtnm,$pdqty,$pdtyp,$pric];
        return $pdtls;
        }else{
            $pdtls=["","","",$srhtxt];
            return $pdtls;
        }
    }
    protected function fcthprdtls($srctxt,$sid,$ptocms,$os,$lt,$cpid,$relt){
        $conn=$this->connect();
        $os=htmlentities(mysqli_real_escape_string($conn,$os));
        $lt=htmlentities(mysqli_real_escape_string($conn,$lt));
        $sid=$this->dec(htmlentities(mysqli_real_escape_string($conn,$sid)),$this->strec);
        $strid=$this->enc($sid,$this->strec,'strix');
        $spdt="";$tfnd="";
        if($srctxt!=""){$spdt=$this->sblen(strtolower(rtrim(htmlentities(mysqli_real_escape_string($conn,$srctxt)))),$this->strec,'strix');
        $spd=$this->prdtsrchalgo(trim(htmlentities(mysqli_real_escape_string($conn,$srctxt))));
        $pdtnm=$spd[0];$pdqy=$spd[1];$pdtp=$spd[2];$pdpric=$spd[3];
        $pdtyp=$this->enc($pdtp,$this->strec,'strix');
        $pdtprc=$this->sblen($pdpric,$this->strec,'strix');
        $ptqty="";$pdqty=trim($pdqy);
        foreach (explode("/,",$pdqty) as $idx=>$pdqy) {
            if($idx < count(explode("/,",$pdqty))-1){
            $pdtqty=$this->sblen(trim($pdqy),$this->strec,'strix');
            $ptqty.="AND strnmr='$strid' prdtqnty LIKE '%$pdtqty%' OR ";}
        }$ptqty=substr($ptqty,0,-3);
        $pdfrs="";$pdtnm=trim($pdtnm);
        $rcp="";
        if($relt&&$cpid!==""){$cpid=$this->sbldc(trim(htmlentities(htmlspecialchars($cpid))),$this->strec);$rcp="AND strspdtnum!='$cpid'";}
        foreach (explode(" ",$pdtnm) as $idx=>$pfhr) {
            $pfhr=$this->sblen($pfhr,$this->strec,'strix');
            $pdfrs.="AND prdtnm LIKE '%$pfhr%' ";
        }
        foreach (explode(" ",$pdtnm) as $idx=>$pfhr) {
            $pfhr=$this->sblen($pfhr,$this->strec,'strix');
            $pdfrs.="OR pdtfhrs  LIKE '%$pfhr%' AND strnmr='$strid' $rcp ";
        }
        if($pdtnm!=""&&($pdqy!=""&&$pdtp!=""&&$pdpric!="")){$tfnd=$pdfrs.' OR '.$ptqty."AND pdtqlty='$pdtyp' AND prdtprc LIKE '%$pdtprc%'";}
        elseif($pdtnm!=""&&($pdqy==""&&$pdtp==""&&$pdpric=="")){$tfnd=$pdfrs;}
        elseif($pdtnm!=""&&$pdqy!=""){$tfnd=$pdfrs." OR ".$ptqty;}
        // elseif($pdtnm!=""&&$pdqy!=""&&$pdpric!=""){$tfnd=$pdfrs."AND prdtqnty LIKE '%$pdtqty%' AND  prdtprc LIKE '%$pdtprc%'";}
        elseif($pdtnm!=""&&$pdpric!=""){$tfnd=$pdfrs."AND prdtprc LIKE '%$pdtprc%'";}
        elseif($pdtnm!=""&&$pdtp!=""){$tfnd=$pdfrs."AND pdtqlty='$pdtyp'";}
        elseif($pdqy!=""){$tfnd=$ptqty;}
        elseif($pdpric!=""){$tfnd="AND prdtprc LIKE '%$pdtprc%'";}
        elseif($pdtp!=""){$tfnd="AND pdtqlty='$pdtyp'";}
        }
        if($srctxt!=""&&!$ptocms){
            $sql="SELECT strnmr,strspdtnum,prdtnm,prdtpto,prdtstrtmtp,IF (prdtqnty='Ojo','',prdtqnty) AS prdtqnty,pdtqlty,prdtprc,pdtsts,pdtlstupdt,pdttlpchs,pdtlrgvws,pdtmrdlsdsrpn,IF (pdtfhrs='Ojo','',pdtfhrs) AS pdtfhrs,pdtlvmdlig,pdtebdlk,pdtmhmes FROM prdcsinstr WHERE strnmr='$strid' $tfnd AND strnmr='$strid' ORDER BY pdtlrgvws DESC LIMIT $os, $lt ;";
        }
        elseif($srctxt!=""&&$ptocms){
            $sql="SELECT strnmr,strspdtnum,prdtnm,prdtpto,prdtstrtmtp,IF (prdtqnty='Ojo','',prdtqnty) AS prdtqnty,pdtqlty,prdtprc,pdtlstupdt,pdtsts,pdtmrdlsdsrpn,IF (pdtfhrs='Ojo','',pdtfhrs) AS pdtfhrs,pdtlvmdlig,pdtebdlk FROM prdcsinstr WHERE strnmr='$strid' $rcp $tfnd AND strnmr='$strid' ORDER BY pdtlrgvws DESC LIMIT $os,$lt ;";}
        elseif(!$ptocms){$sql="SELECT strnmr,strspdtnum,prdtnm,prdtpto,prdtstrtmtp,IF (prdtqnty='Ojo','',prdtqnty) AS prdtqnty,pdtqlty,prdtprc,pdtsts,pdtlstupdt,pdtlrgvws,pdttlpchs,pdtmrdlsdsrpn,IF (pdtfhrs='Ojo','',pdtfhrs) AS pdtfhrs,pdtmhmes,pdtlvmdlig,pdtebdlk FROM prdcsinstr WHERE strnmr='$strid' ORDER BY pdtlrgvws DESC LIMIT $os, $lt ;";}
        elseif($ptocms){
            $sql="SELECT strnmr,strspdtnum,prdtnm,prdtpto,prdtstrtmtp,IF (prdtqnty='Ojo','',prdtqnty) AS prdtqnty,pdtqlty,prdtprc,pdtsts,pdtlstupdt,pdtmrdlsdsrpn,pdtlvmdlig,pdtebdlk,IF (pdtfhrs='Ojo','',pdtfhrs) AS pdtfhrs FROM prdcsinstr WHERE strnmr='$strid' ORDER BY pdtlrgvws DESC LIMIT $os, $lt ;";
        }
        $query=$conn->query($sql);
        if($query){
            if($query->num_rows>0){
                while($row=$query->fetch_assoc()){$data[]=$row;}return $data;
            }else{return 0;}
        }else{return "f0";}
    }
    public function shprdtstoshtronr($srctxt,$sid,$os,$lt){
        $prdts=$this->fcthprdtls($srctxt,$sid,false,$os,$lt,"",false);
        if($prdts !="ns0"){
        if($prdts !="f0"){
        if($prdts !=0){
            foreach($prdts as $pdt){
                $pdtprce=isset(explode(":",explode(",",$this->sbldc($pdt['pdttlpchs'],$this->strec))[0])[1])?explode(":",explode(",",$this->sbldc($pdt['pdttlpchs'],$this->strec))[0])[1]:(isset(explode(":",$this->sbldc($pdt['pdttlpchs'],$this->strec))[1])?explode(":",$this->sbldc($pdt['pdttlpchs'],$this->strec))[1]:0);
                $tpds=count(explode("/,",$this->sbldc($pdt['prdtqnty'],$this->strec)));
            echo "<div class='strprdtsdtlsadntmstpcntnrdvcntngbx'>
                <div class='strprdtdtlsandupdtbtnscntngdvbx'>
                    <div class='strsprdtupdtddtlsdvbx'>
                        <div class='strsprdtsimgcntnrbx'>";
                        if(explode("/,",$this->dec($pdt['prdtpto'],$this->strec))[0]!=""&&file_exists("../strpdtspcs/".explode("/,",$this->dec($pdt['prdtpto'],$this->strec))[0])){echo "<img src='../strpdtspcs/".explode("/,",$this->dec($pdt['prdtpto'],$this->strec))[0]."' class='prdctsdsplypctre'>";}
                        echo"</div>
                        <div class='strcntngordritmdtlscntngdvbx opnpdtvwronlclc'>
                            <div class='twotxtelpss prdtditmnmcntnrdvbx' data-tle='".strtoupper(substr($this->sbldc($pdt['prdtnm'],$this->strec),0,1)).substr($this->sbldc($pdt['prdtnm'],$this->strec),1)."' data-pce='".$this->sbldc($pdt['prdtprc'],$this->strec)."' data-szs='".$this->sbldc($pdt['prdtqnty'],$this->strec)."' data-pfcrs='".$this->sbldc($pdt['pdtfhrs'],$this->strec)."' data-dcptn='".$this->dec($pdt['pdtmrdlsdsrpn'],$this->strec)."' data-slds='".$this->sbldc($pdt['pdttlpchs'],$this->strec)."' data-rpigs='".$this->dec($pdt['prdtpto'],$this->strec)."' data-vws='".$pdt['pdtlrgvws']."' data-mhe='".$pdt['pdtmhmes']."' data-lmig='../srptlvmdlpcs/".$this->dec($pdt['pdtlvmdlig'],$this->strec)."' data-pid='".$this->enc($pdt['strspdtnum'],$this->strec,'strix')."' data-ebdlk='".$this->dec($pdt['pdtebdlk'],$this->strec)."' data-istk='".(($this->dec($pdt['pdtsts'],$this->strec)=="1")?"In stock":"Out of stock")."' data-luptd='".$this->timefrendly($this->dec($pdt['pdtlstupdt'],$this->strec),$this->dec($pdt['prdtstrtmtp'],$this->strec))."'>".strtoupper(substr($this->sbldc($pdt['prdtnm'],$this->strec),0,1)).substr($this->sbldc($pdt['prdtnm'],$this->strec),1)."</div>
                            <div class='prdtsrditmothdtlscntngdvbx'>
                                <div class='pdtlsmrgn'>.<span class='prdtsrditmqtycntnrdvbx'>".explode("/,",$this->sbldc($pdt['prdtqnty'],$this->strec))[0]."</span></div>
                                <div class='pdtlsmrgn prdtsrditmpcdorlscntnrdvbx'>.<span class='prdtsrditmpcdorlscntnrdvbx'>".$this->dec($pdt['pdtqlty'],$this->strec)."</span></div>
                                <div class='pdtlsmrgn prdtstckstsdvbx'>.".(($this->dec($pdt['pdtsts'],$this->strec)=="1")?"<span class='istksptg'>In stock</span>":"<span class='istksptg' id='otfstkptg'>Out of stock</span>")."</div>
                            </div>
                        </div>
                        <div class='prdtcstcntngdvbx'><span class='prdtprcecstinnm'>".explode(",",$this->sbldc($pdt['prdtprc'],$this->strec))[0]."</span><span>&#8377;</span></div>
                    </div>
                    <div class='strsprdtupdtbtns'>
                        <div class='strsprdtnofbyeddvbx'><span>Sold:</span><span> ".$pdtprce."</span></div>
                        <div class='strtlpdtvrnts' role='button'>";$tps=$tpds-1;echo $tpds > 1?"
                        <span style='
                        width: fit-content;
                        height: fit-content;
                        padding: 1px 3px;
                        border: 1px solid lightgray;
                        border-radius: 4px;'>+$tps More</span>":'';
                        echo "</div>
                        <div class='strprdtedtinstkstsdvbxbtn' role='button'>
                            <span class='intle'>Instock</span>
                            <div class='toggleswitch tglbtn'><label class='switch'>";
                            if($this->dec($pdt['pdtsts'],$this->strec)==1){echo "<input type='checkbox' id='strprdtstksts' data-pd='".$this->enc($pdt['strspdtnum'],$this->strec,'strix')."' data-sd='".$pdt['strnmr']."' data-ud='fs' checked>";}else{echo "<input type='checkbox' id='strprdtstksts' data-pd='".$this->enc($pdt['strspdtnum'],$this->strec,'strix')."' data-sd='".$pdt['strnmr']."' data-ud='tre' unchecked>";}
                        echo "<span class='slider round'></label></div>
                        </div>
                    </div>
                </div>
                <div class='prdtlstupdttmpstbdvbx' style='display:flex;justify-content:space-between;'>
                <span class='pdtstmstp'>".$this->timefrendly($this->dec($pdt['pdtlstupdt'],$this->strec),$this->dec($pdt['prdtstrtmtp'],$this->strec))."</span>
                <span>
                <i class='fas fa-trash remindosymbols blewhtbns' data-pd='".$this->enc($pdt['strspdtnum'],$this->strec,'strix')."' data-lpc='".$pdt['pdtlvmdlig']."' data-pi='".$pdt['prdtpto']."' data-sd='".$pdt['strnmr']."' data-ud='fs' id='stpdtdltprdts' style='background:red;color:white;font-size:14px;'></i></span>
                </div>
                </div>
            </div>";
            }
        }else {return 0;}
        }else{return "f0";}
        }else{return "n0";}
    }
    public function prdssgnsofsrchinstrpg($srctxt,$sid,$os,$lt){
        $prdts=$this->fcthprdtls($srctxt,$sid,true,0,6,"",false);
        if($prdts !="ns0"){
        if($prdts !="f0"){
        if($prdts !=0){
            foreach($prdts as $pdt){
            $tpds=count(explode("/,",$this->sbldc($pdt['prdtqnty'],$this->strec)));
            for($i=0;$i<$tpds;$i++){
            echo "<div class='shprdtsinstrcstmrsspg' data-p='".explode(",",$this->sbldc($pdt['prdtprc'],$this->strec))[$i]."'>";
            if($this->dec($pdt['pdtsts'],$this->strec)==0){echo "<p class='pdtotofstkstsptg'>Product out of stock.</p>";}
            echo "<div class='odrditmartclcntnrdvbx";
            if($this->dec($pdt['pdtsts'],$this->strec)==0){echo " shngotstkprdts";}
            echo "' data-pd='".explode("/,",$this->sbldc($pdt['prdtqnty'],$this->strec))[$i].$this->enc($pdt['strspdtnum'],$this->strec,'strix')."' data-tq='1'><div class='ordditmimgcntngdvbx'>";
            if(explode("/,",$this->dec($pdt['prdtpto'],$this->strec))[0]!=""&&file_exists("../strpdtspcs/".explode("/,",$this->dec($pdt['prdtpto'],$this->strec))[0])){echo "<img class='strcntngitmimg' src='../strpdtspcs/".explode("/,",$this->dec($pdt['prdtpto'],$this->strec))[0]."'>";}
            echo "</div>
            <div class='strcntngordritmdtlscntngdvbx'>
                <div class='onetxtelpss cmrsdsrditmnmcntnrdvbx'>".strtoupper(substr($this->sbldc($pdt['prdtnm'],$this->strec),0,1)).substr($this->sbldc($pdt['prdtnm'],$this->strec),1)."</div>
                <div class='cmrdsrditmothdtlscntngdvbx'>
                    <div class='cmrdsrditmqntycntnrdvbx'>.".explode("/,",$this->sbldc($pdt['prdtqnty'],$this->strec))[$i]."</div>
                    <div class='cmrdsrditmpstkstscntnrdvbx'> .".(($this->dec($pdt['pdtsts'],$this->strec)=="1")?"<span class='istksptg'>In stock</span>":"<span class='istksptg' id='otfstkptg'>Out of stock</span>")."</div>
                    <div class='cmrdsrditmpcdorlscntnrdvbx'> .".$this->dec($pdt['pdtqlty'],$this->strec)."</div>
                </div>
            </div>
            <div class='odrngitmsqntyandprccntngdvbx'>
                <div class='odrditmqntyicordcandiptctnrdvbx hdqtyincdcaditvldvbx'>
                    <div class='icodrditmqtydvbtn' role='button'><i class='fas fa-plus remindosymbols'></i></div>
                    <span class='odrditmqtydsplyiptcntngdvbbx'>
                        <input type='number' class='odrditmnumquntyiptbx' value='1'>
                    </span>
                    <div class='decodrditmqtydvbtn' role='button'><i class='fas fa-minus remindosymbols'></i></div>
                </div>
                <div class='odritmsprcandqtyctngdvbx'>
                <div class='stronrpgitmsqntyctnrdvbx' style='display:none;'>
                    <span class='qntyhdngofitmspntgasbx'><strong>Qty:</strong></span>
                    <span class='qntinnmofthsitmbxnspng'>1</span>
                </div>
                <div class='ordrditmsprceandcrncycntnrdvbx'>
                    <div class='ordrditmprccntnrdvbx odritmcstdtatcnttl' data-qny='".explode("/,",$this->sbldc($pdt['prdtqnty'],$this->strec))[$i]."' data-pd='".$this->sblen($pdt['strspdtnum'],$this->strec,'strix')."' data-cst='".explode(",",$this->sbldc($pdt['prdtprc'],$this->strec))[$i]."'>".explode(",",$this->sbldc($pdt['prdtprc'],$this->strec))[$i]."</div>
                    <div class='ordrditmcrncycntngdvbx'>₹</div>
                </div>
                </div>
            </div>
            </div>
            </div>";
            }
            }
        }else {echo 0;}
        }
        }
    }
    public function pdtanlsr($relpdt,$srctxt,$sid,$os,$lt,$cpid){
        $srctxt=trim(htmlentities(htmlspecialchars($srctxt)));
        $relpdt=htmlentities($relpdt)=="true"?true:false;
        if($relpdt){        
            $srhfcrs="";foreach (explode(",",$srctxt) as $fhr) {$srhfcrs.=trim($fhr)." ";}
            $prdts=$this->fcthprdtls($srhfcrs,$sid,true,0,6,$cpid,true);
        }else{
            if(htmlentities(htmlspecialchars($srctxt))!=""&&htmlentities(htmlspecialchars($srctxt))!=" "){
            $prdts=$this->fcthprdtls($srctxt,$sid,true,$os,$lt,"",false);}else{
            $prdts=$this->fcthprdtls("",$sid,true,$os,$lt,"",false);}
        }
        if($srctxt!=""&&$srctxt!=" "){
        if($prdts!="q0"&&$prdts!="f0"){if($prdts!=0){
        $stopwords=['it','is','in','this','that','for','are',"and",'at','an','a','the',"?"];
        $wrdrnkng=explode(" ",$srctxt);
        foreach ($stopwords as $stop) {if(in_array($stop,$wrdrnkng)){array_splice($wrdrnkng,array_search($stop,$wrdrnkng),1);}}
            foreach($prdts as $pidx=>$pdt) {
                $pdtnm=$this->sbldc($pdt["prdtnm"],$this->strec);
                $ckwrd=explode(" ",$pdtnm);$ttlwrds=[];
                foreach ($stopwords as $stop) {if(in_array($stop,$ckwrd)){array_splice($ckwrd,array_search($stop,$ckwrd),1);}}
                foreach ($wrdrnkng as $srchwrd) {if(in_array($srchwrd,$ckwrd)){array_push($ttlwrds,array_search($srchwrd,$ckwrd));}}
                $rkng=10;
                if(count($ttlwrds)>3){
                $delta = abs($ttlwrds[1] - $ttlwrds[0]);
                foreach($ttlwrds as $idx=>$num){
                    if($idx<count($ttlwrds)-2){
                        if (abs($ttlwrds[$idx + 1] - $num) != $delta){
                        $rkng=abs($ttlwrds[$idx + 1] - $num);break;
                        }else{$rkng=1;}
                    }
                    }
                }elseif(count($ttlwrds)==2){$rkng=abs($ttlwrds[1] - $ttlwrds[0]);
                    // $rkng=$rkng!=1?$rkng:10;
                }
                $prdts[$pidx]=$pdt+["ttlwrds"=>count($ttlwrds)]+["rkng"=>$rkng];
            }
            $srtkey=htmlentities("rkng");$aod="a";
            for($i=0;$i<count($prdts);$i++){
                for($j=0;$j<count($prdts)-1;$j++){
                    if($aod=="d"){if($prdts[$j][$srtkey]<$prdts[$j+1][$srtkey]){
                        $temp=$prdts[$j+1];
                        $prdts[$j+1]=$prdts[$j];
                        $prdts[$j]=$temp;
                    }elseif($prdts[$j][$srtkey]==$prdts[$j+1][$srtkey]){
                        if($prdts[$j]["ttlwrds"]<$prdts[$j+1]["ttlwrds"]){
                        $temp=$prdts[$j+1];
                        $prdts[$j+1]=$prdts[$j];
                        $prdts[$j]=$temp;
                    }}}elseif($aod=="a"){if($prdts[$j][$srtkey]>$prdts[$j+1][$srtkey]){
                        $temp=$prdts[$j+1];
                        $prdts[$j+1]=$prdts[$j];
                        $prdts[$j]=$temp;
                    }elseif($prdts[$j][$srtkey]==$prdts[$j+1][$srtkey]){
                        if($prdts[$j]["ttlwrds"]<$prdts[$j+1]["ttlwrds"]){
                        $temp=$prdts[$j+1];
                        $prdts[$j+1]=$prdts[$j];
                        $prdts[$j]=$temp;
                    }}}else{break;}
                }
            }
        }else{return 0;}}else{return "f0";}
        }
        return $prdts;
    }
    public function rtrvalpdts($relpdt,$srctxt,$sid,$os,$lt,$cpid){
        $prdts=$this->pdtanlsr($relpdt,$srctxt,$sid,$os,$lt,$cpid);
        
        if($prdts !="ns0"){
        if($prdts !="f0"){
        if($prdts !=0){
            foreach($prdts as $pdt){
            $tpds=count(explode("/,",$this->sbldc($pdt['prdtqnty'],$this->strec)));
            // for($i=0;$i<$tpds;$i++){
            echo "
            <div class='lbx-dsply-pdts-nd-dtls-cntngdvbx'>
                <div class='lbx-dsply-shtdls-pdtpcandadbtn'>
                    <div class='lbx-dsply-shdls-ptpc-dvbx'><span class='pdtrlpcspntg'>".explode(",",$this->sbldc($pdt['prdtprc'],$this->strec))[0]."</span><span>/-</span></div>";
                    if(isset($_SESSION['ssndi'])){if($this->dec($pdt['pdtsts'],$this->strec)=="1"){echo "<div class='pdtadtolstbtn lbx-dsply-adbtn'>Add</div>";}
                    else{echo "<div><i class='fas fa-clock remindosymbols' style='color: #ff3737;text-shadow: 1px 0 0 #fff, -1px 0 0 #fff, 0 1px 0 #fff, 0 -1px 0 #fff, 0px 0px #fff, -1px -1px 0 #fff, 0px -1px 0 #fff, -1px 1px 0 #ffe;'></i></div>";}}
                echo "</div>
                <div class='lbx-shtpdtigdsplycntng-dvbx nonsrprdtlbxopn prdtditmnmcntnrdvbx' data-tle='".strtoupper(substr($this->sbldc($pdt['prdtnm'],$this->strec),0,1)).substr($this->sbldc($pdt['prdtnm'],$this->strec),1)."' data-pce='".$this->sbldc($pdt['prdtprc'],$this->strec)."' data-szs='".$this->sbldc($pdt['prdtqnty'],$this->strec)."' data-slds='' data-pfcrs='".$this->sbldc($pdt['pdtfhrs'],$this->strec)."' data-adpdck='".explode("/,",$this->sbldc($pdt['prdtqnty'],$this->strec))[0].$this->enc($pdt['strspdtnum'],$this->strec,'strix')."' data-dcptn='".$this->dec($pdt['pdtmrdlsdsrpn'],$this->strec)."' data-rpigs='".$this->dec($pdt['prdtpto'],$this->strec)."' data-lmig='../srptlvmdlpcs/".$this->dec($pdt['pdtlvmdlig'],$this->strec)."' data-sid='".$this->enc($this->dec($pdt['strnmr'],$this->strec),$this->strec,'mtr')."' data-url='http://localhost/remindo/shared?tp=pt&s=".$this->sblen($this->dec($pdt['strnmr'],$this->strec),$this->strec,'strix')."&p=".$this->sblen($pdt['strspdtnum'],$this->strec,'strix')."' data-pid='".$this->sblen($pdt['strspdtnum'],$this->strec,'strix')."' data-istk='".(($this->dec($pdt['pdtsts'],$this->strec)=="1")?"In stock":"Out of stock")."' data-ebdlk='".$this->dec($pdt['pdtebdlk'],$this->strec)."' data-luptd='".$this->timefrendly($this->dec($pdt['pdtlstupdt'],$this->strec),$this->dec($pdt['prdtstrtmtp'],$this->strec))."'>";
                if(explode("/,",$this->dec($pdt['prdtpto'],$this->strec))[0]!=""&&file_exists("../strpdtspcs/".explode("/,",$this->dec($pdt['prdtpto'],$this->strec))[0])){
                echo "<img src='../strpdtspcs/".explode("/,",$this->dec($pdt['prdtpto'],$this->strec))[0]."' class='lbx-dply-pdtpic-mainig'>";
                }
                echo "<div class='lbx-pdtdsply-whtlghtdmdvbx'></div></div>
                <div class='lbx-dsply-shtdls-pdtpcandadbtn' style='margin-top:-30px;'>
                    <div class='lbx-dsply-shdls-ptpc-dvbx'><span class='onetxtelpss pdtrlsbqtyspntg'>".explode("/,",$this->sbldc($pdt['prdtqnty'],$this->strec))[0]."</span></div>";
                    if($tpds>1){echo "<div class='lbx-dsply-shdls-ptpc-dvbx' style='font-size:10px;'>+".($tpds-1)." More</div>";}
                echo "</div><div class='twotxtelpss lbx-dsply-rltdpdsnm'>".strtoupper(substr($this->sbldc($pdt['prdtnm'],$this->strec),0,1)).substr($this->sbldc($pdt['prdtnm'],$this->strec),1)."</div>
            </div>";
            // }
            }
        }else {echo 0;}
        }
        }
    }
}
$prdts = new rtvpprds();
if(isset($_POST['fhpdts'])&&$_POST['fhpdts']=="trefhspts"){
    if(isset($_POST['sw'])&&isset($_POST['sd'])&&isset($_POST['os'])&&isset($_POST['lt'])){echo $prdts->shprdtstoshtronr($_POST['sw'],$_POST['sd'],$_POST['os'],$_POST['lt']);}
}
if(isset($_POST['shpdts'])&&$_POST['shpdts']=="spdstretre"){
    if(isset($_POST['qp'])&&isset($_POST['s'])){echo $prdts->prdssgnsofsrchinstrpg($_POST['qp'],$_POST['s'],"","");}
}
if(isset($_GET['rvrpds'])&&$_GET['rvrpds']=="yscmrfhsrpds"){
    if(isset($_GET['sp'])&&isset($_GET['sd'])&&isset($_GET['rel'])&&isset($_GET['os'])&&isset($_GET['lt'])){
        $recp=explode("/re,./cs",htmlentities(htmlspecialchars($_GET['rel'])));
        echo $prdts->rtrvalpdts($recp[0],$_GET['sp'],$_GET['sd'],$_GET['os'],$_GET['lt'],$recp[1]);
    }
}
?>