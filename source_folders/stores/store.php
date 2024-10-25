<?php
include "stronr.php";
class storenvironment extends strbsnenvmt {
public $strname;
private function strupds($s){
    $conn=$this->connect();
    $usr=$this->enc(htmlentities($_SESSION['ssndi']),$this->iky,'idx');
    $str=$this->enc(htmlentities($s),$this->strec,'strix');
    $conn->query("UPDATE stspdbycstms SET strttlitrcns=strttlitrcns+1 WHERE stscmnm='$usr' AND stsnm='$str';");
}
public function vfycmrol($str){
    $conn=$this->connect();
    $strid=$this->enc(htmlentities(mysqli_real_escape_string($conn,$str)),$this->strec,'strix');
    $unm=$this->enc(htmlentities(mysqli_real_escape_string($conn,$_SESSION['ssndi'])),$this->iky,'idx');
    $sql="SELECT rlid,strolofpsn FROM strtemrls WHERE sridtoasngrl='$strid' AND psnidassrol='$unm' AND stortmbrsts='YmcU3cVFEU2cUVEUUE';";
    $query=$conn->query($sql);
    if($query){if($query->num_rows>0){return $row=$query->fetch_assoc();}else{return 0;}}else{return "e0";}
}
private function gtusradrs(){
    $conn=$this->connect();
    $s=htmlentities(htmlspecialchars(mysqli_real_escape_string($conn,$_SESSION['ssndi'])));
    $sql="SELECT rmuflm,usrcty,usrstat,usrpncd,usrpnmr,usrlocty FROM roupldls WHERE usid='$s';";
    $query=$conn->query($sql);
    if($query){if($query->num_rows>0){return $query->fetch_assoc();}else{return "";}}else{return "";}
}
public function storecustmr($strdls,$hspn,$norl){
    if(isset($_SESSION['usrml'])){
        $this->strupds($strdls['stnmr']);
    $vfdpndusr=$this->chckifpnd($this->enc($strdls['stnmr'],$this->strec,'mtr'));}else{$hspn=false;}
    $bnm=strtoupper(substr($this->sbldc($strdls['strnm'],$this->strec),0,1)).substr($this->sbldc($strdls['strnm'],$this->strec),1);
    $hts=$this->dec($strdls['strhlgts'],$this->strec);
    $srtmgs=$this->dec($strdls['stropngclsngtmgs'],$this->strec);
    if($srtmgs!="nha"&&$srtmgs!=""){$edsus=explode("||",$srtmgs);$ed=explode("//",$edsus[0]);$su=explode("//",$edsus[1]);}
    $strcmr="<div class='rmdohomepagediv'>
    <div class='rmdohmpghdr'></div>
    <div class='storenvcustmruicntrdvbx'>
        <div class='othstorspndandsgg'></div>
        <div class='csmruiofstoreenvicntrdvbx'>
            <div class='strebsnsprfdtlscntrdvbox'>
                <div class='stronrpgtphdr'>
                    <div class='strifoandothrbtnsdvbx'>
                    <div class='strinfottldvbx'>".$this->dec($strdls['strrctgre'],$this->strec)." Info</div>";
                    if(!isset($_SESSION['usrml'])){$strcmr.="<a href='http://localhost/remindo/signin'><div class='remindo-pin-button' style='height:fit-content;height:-moz-fit-content;padding: 3px 6px;
                        position: relative;
                        right: 16%;background:#ff8f26;
                        top: 6px;' role='button'>Login</div></a>";}else{
                    if($norl=="Embedder"){$strcmr.="<div class='strprdtspgnvgtrbtndvbx' style='height:fit-content;height:-moz-fit-content;' id='prdtsnvgtbtn' data-sn='".$this->sbldc($strdls['stratmnt'],$this->strec)."' data-si='".$this->enc($strdls['stnmr'],$this->strec,'mtr')."' role='button'>Embed</div>";}
                    if(!$hspn){$strcmr.="<div class='remindo-pin-button pinstrtbtn' style='height:fit-content;height:-moz-fit-content;padding: 3px 6px;
                        position: relative;
                        right: -17%;
                        top: 6px;' role='button'><i class='fas fa-thumbtack remindosymbols'></i>Pin</div>";}
                    }
                    $strcmr.="</div>
                </div>
                <div class='strebssnsprflpcsdvbx'>
                    <div class='strebscvradmpsdvbx'>
                        <div class='strbsncvrprfpcbx'>";
                        if($this->dec($strdls['strcvrpto'],$this->strec)!=""&&file_exists("../fhstsbsncvpcs/".$this->dec($strdls['strcvrpto'],$this->strec))){$strcmr.="<img src='../fhstsbsncvpcs/".$this->dec($strdls['strcvrpto'],$this->strec)."' id='posts-img' class='strbsnsprfcvrpc' >";}
                        $strcmr.="</div>
                        <div class='strbsnmpsndvbx'>
                        <div class='strepysclgelctincntnrdvbx'>";
                        // if($this->dec($strdls['strlgtdlatd'],$this->strec)!=""){$strcmr.="<div id='map'><img src='https://maps.googleapis.com/maps/api/staticmap?center=Brooklyn+Bridge,New+York,NY&zoom=13&size=600x300&maptype=roadmap&markers=color:blue%7Clabel:S%7C40.702147,-74.015794&markers=color:green%7Clabel:G%7C40.711614,-74.012318&markers=color:red%7Clabel:C%7C40.718217,-73.998284&key=AIzaSyCiDZ4Jph0U5l51LnFhY036k1gzAOr44l4'></div>";}
                        $strcmr.="</div></div>
                    </div>
                    <div class='strebsprfpcigcntrnrdvbx'>";
                    if($this->dec($strdls['strbprflig'],$this->strec)!=""&&file_exists("../fhupuppts/".$this->dec($strdls['strbprflig'],$this->strec))){$strcmr.="<img src='../fhupuppts/".$this->dec($strdls['strbprflig'],$this->strec)."' id='posts-img' class='strbsnsprfpc'>";}
                    $strcmr.="</div>
                </div>
                <div class='strbsnothprfldtlscntnrdvbx'>
                    <div class='strrtngsdvcntnrdvbx'>
                        <div class='strertnginnumdvbx'></div>
                        <div class='strertnginstrsdvbx'>";
                    //     if($this->dec($strdls['strsprtng'],$this->strec)>0){
                    //        $fr=floor($this->dec($strdls['strsprtng'],$this->strec));
                    //        for($i=1;$i<=$fr;$i++){$strcmr.="&#9733;";}
                    //        if($fr<5){for($i=1;$i<=5-$fr;$i++){$strcmr.="&#9734;";}}
                    //    }else{$strcmr.="&#9734;&#9734;&#9734;&#9734;&#9734;";}
                        $strcmr.="</div>
                    </div>
                    <div class='strbsnttpndinnmcntnrdvbx'>
                        <div class='strttpnddvbx'>
                            <i class='fas fa-thumbtack remindosymbols strspndcsmrssmbl'></i>
                            <h3 class='ttlcmrspndthestre'>".$this->tpnd($strdls['stnmr'])."</h3>
                        </div>
                        <div class='strprsntcncnstscntnrdvbx'>
                            <div class='strprsntopnorclsstsdvbx'>";
                            if($this->dec($strdls['stropnsts'],$this->strec)==1){$strcmr.="<div class='strstsdvbxopn'>.Open</div>";}
                            else{$strcmr.="<div class='strstsdvbxcls'>.Close</div>";}
                        $strcmr.="</div>";
                        if($hspn){if($this->dec($strdls['strbupimg'],$this->strec)!=""&&file_exists("../qrstsbprfpcs/".$this->dec($strdls['strbupimg'],$this->strec))){$strcmr.="<div class='strqrupipmtavblcntnrdvbx pywhqrsnupioptnbtnbx' data-ignm='../qrstsbprfpcs/".$this->dec($strdls['strbupimg'],$this->strec)."'>".$this->strspgicns("qr")."<strong> Pay With QR UPI</strong></div>";}}
                            $strcmr.="<div class='strprsntrcvngordrsorntstsdvbx'>";
                            if($this->dec($strdls['strsodrrcvngsts'],$this->strec)==1){$strcmr.="<div class='strstsdvbxrcvngords'>.Receiving Orders</div>";}else{$strcmr.="<div class='strstsnonrcvngordsdvbx'>.Not Available</div>";}
                            $strcmr.="</div>
                        </div>
                    </div>
                    <div class='strebsnstxtdtlscntrdvbx'>
                    <div class='streprflnmedv'><i class='fas fa-store remindosymbols'></i>$bnm</div>
                    <div class='streprflatmntndv'><i class='fas fa-at remindosymbols'></i>".$this->sbldc($strdls['stratmnt'],$this->strec)."</div>
                    <div class='streprflmblnmdvbx'><div calss='strmblicnpnumdvbx'><i class='fas fa-phone-alt remindosymbols'></i> <span class='strdtlsspgtg'><a href='tel:".$this->dec($strdls['stsbsnmblnum'],$this->strec)."' style='color:#22225d;'>".$this->dec($strdls['stsbsnmblnum'],$this->strec)."</a></span> &nbsp;&nbsp;</div>";
                    if($hspn){$strcmr.=$this->pmtgtwys($this->dec($strdls['stracptbluipmtmtds'],$this->strec));}
                    $strcmr.="</div>";
                    if($this->dec($strdls['strseml'],$this->strec)!=""){$strcmr.="<div class='streprflemldvbx'><i class='fas fa-envelope remindosymbols'></i><span class='strdtlsspgtg'><a href='mailto:".$this->dec($strdls['strseml'],$this->strec)."' style='color:#22225d;'>".$this->dec($strdls['strseml'],$this->strec)."</a></span></div>";}
                    $strcmr.="<div class='streprflctgrenmdvbx'><div calss='strctgreicnpnumdvbx'><img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAABBklEQVRIiWNgGAXDHjCiC5RkZW0VFhRUI8ewd2/f3uqeMcMbqwWJoaGi/Pz89Tra2hFysrLC5Fjw8PHjt9euXVv+4cOHpvmrV79mYGBgYIJJ8vPyRltaWmaTazgDAwODvKyssIWFRQ4/L280TIwJWQErCwu5ZuM0gwmHOqoBnE5+9/49Yc3MzAzMTBA3cvPwkGaBkKAgQQuIAYMjiPj4+Bg+ffqE1yBcPiY6iMgNMpoHEdyCv///f3/18uVXSg189fLl17///3/HsEBYXn72pYsXgy5fvfqQXMMvX7ny8PylS4HC8vKzYWIYhV1RenovNw+PJjkWfP3y5XrfzJnF5DpwFAxRAABsWEtDNkycnQAAAABJRU5ErkJggg=='> <span class='strdtlsspgtg'>".$this->dec($strdls['strrctgre'],$this->strec)."</span></div></div>";
                    if($srtmgs!="nha"&&$srtmgs!=""){$strcmr.="<div class='streprflavablpmtgtwsdvbx'><i class='fas fa-door-open remindosymbols'></i><strong>Store Timings</strong>
                    <div class='streprflonlpmtsdvbx'><div class='sroctmgsinjsn' style='padding:3px;'><span style='font-weight:600;color:darkslategray;'>Everyday | </span><span style='color:green'>open:</span> ".$ed[0]." - <span style='color:red'>close</span>: ".$ed[1]."<br><span style='font-weight:600;color:red;'>Sunday | </span><span style='color:green'>open</span>: ".$su[0]." - <span style='color:red;'>close:</span> ".$su[1]."</div></div></div>";}
                    $strcmr.="<br><div class='strcasoptnstscntnrdvbx'>";
                    if($hspn){if($this->dec($vfdpndusr['strcstmrcsonavbl'],$this->strec)==1||$this->dec($strdls['stravblcstoevyon'],$this->strec)==1){$strcmr.="<div class='strcasoptnbxttlcntnrdvbx'> Cash At Store (CAS) </div><div class='strcshavbltstsdvbx'>(Available)</div>";}}
                    $strcmr.="</div>
                    </div>
                    <div class='strepgmrdtlscntrdvbx'>
                    <div class='strmrdtlshedcntrdvbx' role='button'><i class=''></i><strong>More</strong></div>
                        <div class='strepgmrdtlsabtstrbdycntrdvbx'>
                        <div class ='strephcladrescntnrdvbx'>
                            <div class='strdsplyadrsdvasbtn' role='button'><i class='fas fa-map-marker-alt remindosymbols'></i>Store Address</div>
                            <div class='stradrsbdydvbx'>".$this->dec($strdls['stradrs'],$this->strec)."</div>
                        </div>";
                        if($hspn){$strcmr.="<div class ='strecstmrprvcstngsdvbx'>
                            <div class='strdsplypvtdvasbtn' role='button'><i class='fas fa-lock remindosymbols'></i>Privacy Options</div>
                            <div class='strpvtcntrbdydvbx'>
                                <div class='usrcstmrunpnshpbtn' data-s='".$this->enc($strdls['stnmr'],$this->strec,"mtr")."' id='usrcstmrunpnshpbtn' role='button'><i class='fas fa-thumbtack remindosymbols unpnthestricn'></i>Unpin</div>
                            </div>
                        </div>";}
                        $strcmr.="</div>
                        <input type='hidden' id='ithnthssmrcls' value='".$this->enc($strdls['stnmr'],$this->strec,'mtr')."'>
                    </div>
                    <div class='bcktostreordruidvbx'>
                        <div class='bckbtntogstrbtn' role='button'><i class='fas fa-arrow-up remindosymbols'></i></div>
                    </div>
                </div>
            </div>
            <div class='strepgstordscntnrdivbox'>
                <div class='strpghdrstredtlscntnrdvbx'>
                    <div class='strpgtphdrcntnrdvbx' data-big='../fhstsbsncvpcs/".$this->dec($strdls['strcvrpto'],$this->strec)."' style='background-position:center;'>
                        <div class='strpgtphdrcntbckgndblkdvbx'>
                            <div class='shpsdtlsbtncntnrdvbx'><div class='shwstrdtlsbtn' role='button'></div></div>
                            <div class='strpghdrstrprfdtlscntrdvbx'>
                                <div class='bcktopndstrspgbtndvbx' role='button'><i class='fas fa-arrow-left remindosymbols'></i></div>
                                <div style='display:flex;justify-content:space-between;align-content:center;align-items:center;width:100%;'>
                                <div class='vmpstrprfbsndtlscntnrdvbx streownrsprfldtlspgbtn'>
                                    <div class='strbsnprfpiccntnrdvbox'>";
                                    if($this->dec($strdls['strbprflig'],$this->strec)!=""&&file_exists("../fhupuppts/".$this->dec($strdls['strbprflig'],$this->strec))){$strcmr.="<img src='../fhupuppts/".$this->dec($strdls['strbprflig'],$this->strec)."' class='strbsnprfpicimg'>";}
                                        $strcmr.="
                                    </div>
                                    <div class='strbnnmatmtstrstscntnrdvbx'>
                                        <div class='onetxtelpss strnamecntnrdvbx' style='max-width:250px;'>$bnm</div>
                                        <div class='stratmentioncntnrdvbx'><i class='fas fa-at remindosymbols'></i>".$this->sbldc($strdls['stratmnt'],$this->strec)."</div>
                                        <div class='stropnandrcvngstscntnrdvbx'>
                                            <span class='stropnspntgbx'>";
                                            if($this->dec($strdls['stropnsts'],$this->strec)==1){$strcmr.="<div class='strstsdvbxopn'>.Open</div>";}
                                            else{$strcmr.="<div class='strstsdvbxcls'>.Close</div>";}
                                        $strcmr.="</span>
                                            <span class='strrcvngodrsspntgbx'>";
                                            if($this->dec($strdls['strsodrrcvngsts'],$this->strec)==1){$strcmr.="<div class='strstsdvbxrcvngords'>.Receiving Orders</div>";}else{$strcmr.="<div class='strstsnonrcvngordsdvbx'>.Not Available</div>";}
                                            $strcmr.="</span>
                                        </div>
                                    </div>
                                </div>";
                                if($hts!=""){$strcmr.="<div class='shwstrhlgts'><i class='fas fa-highlighter hlgtricnbtn' style='
                                background-image: linear-gradient( 
                            227deg, #fdf878 45%, #f26060 60%);
                                -webkit-background-clip: text;
                                -moz-background-clip: text;
                                -webkit-text-fill-color: transparent;
                                -moz-text-fill-color: transparent;
                                font-weight: 600;    margin: 10px;
                                cursor:pointer;
                                text-decoration: underline #ff62a4;
                            }
                            '></i><style>.hlgtricnbtn:active{transform:scale(0.96);}</style></div>";}
                            $strcmr.="</div>
                            </div>
                        </div>
                    </div>
                    <div class='strpgbtmhdrcntnrdvbx'>
                        <div class='strnwordrbtncntnrdvbx'>";
                            if($hspn){$strcmr.="<div class='stnwodrtostrbtn' role='button'><i class='fas fa-plus remindosymbols'></i>Create New List</div>";}
                            $strcmr.="<div class='shwalpdtsinstrbtn' role='button'><i class='fas fa-boxes remindosymbols'></i>Products</div>
                        </div>
                    </div>
                </div>
                <div class='strodrspdsdsplybdymandvbx' data-mnbuy='".$this->dec($strdls['strpdtmnprchs'],$this->strec)."'><span class='ctrnwlstbnivsbl' style='display:none;'></span>";
                if($hspn){$strcmr.="<div class='strpgmdbdyofodrlstscntnrdvbx' style='width:100%; position:relative;'>
                        <center><h3 style='color:gray;'>Create a new list.</h3></center>
                    </div>";}
                    $strcmr.="<div class='stralpdtsdsplydvbxctnrdvbx'";
                    if(!$hspn){$strcmr.="style='display:block';";}
                    $strcmr.=">
                        <div class='stralpdtsplcetphdr'>
                            <div class='srchbxto-srch-alpdts-inshp'>
                            <div class='srchalpdtspwrdsrchbtn'><i class='fas fa-search remindosymbols'></i></div>
                            <input type='text' class='srchalpdtsinstrmandsplyiptsrch' placeholder='Search'>
                            </div>
                        </div>
                        <div class='pdtsinstrhgedsplydvbx str-alpdts-dspl-dvbx prdtsdsplngwall'></div>
                    </div>
                </div>
                <div class='strpgftrtoshwppupsdvbx'>
                    <div class='optnsfraprticlurodrofstrecntnrdvbx'>
                        <div class='optnsdvbxlsdvbx'></div>
                        <div class='optnscntngbxandmdlbx'>
                            <input type='hidden' id='hndlbnornmridpt'>
                            <div class='dlodrfrmstreoptnbtndvbx' role='button'><i class='fas fa-trash remindosymbols dltodroptnicnasbtn'></i><div class='dltbtntxtdvbx'>Delete Order</div></div>
                            <div class='rmvitmfrmodrinstrbtndvbx' role='button'><i class='fas fa-times remindosymbols rmvtmsodroptnicnasbtn'></i><div class='rmvbtntxtdvbx'>Remove Items</div></div>
                        </div>
                        <div class='optnsdvbxrghtdvbx'></div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class='popupbackground strshwodrdls'>
        <div class='popupcontainerbox strshwodrdls' style='min-width:230px'>
            <div class='popupheaderbox'>
                <h2 class='popupheadertitle'>Order Details</h2>
                <button type='button' class='hidepopupbtn odlsclsbtn'>X</button>
            </div>
            <div class='popupcontentcontainerbox'>
                <div class='odridsplyctngdvbx' style='font-size: 15px;
                margin: 6px 0;'><strong>Order ID: </strong><span class='odridsplyrspntg'></span></div>
                <div class='odrdtxdsplyctngdvbx' syle='font-size: 15px;margin: 6px 0;'></div>
                <div class='igtmyodrvfcnctngdvbx' data-o=''>
                    <div class='ircvdmyodrtxt' style='min-width: 250px;font-weight: 600;margin: 10px 0 0 0;'>I have received my order <span><input type='checkbox' id='icvdodrcbx' style='width:fit-content;width:-moz-fit-content;height:fit-content;height:-moz-fit-content;' val='ircvd'></span></div>
                </div>
            </div>
        </div>
    </div>";
    if($hspn){$strcmr.="<div class='popupbackground streupippupbx'>
        <div class='popupcontainerbox streupippupbx'>
            <div class='popupheaderbox'>
                <h2 class='popupheadertitle' style='marign:2px;'>Scan to pay</h2>
                <button type='button' class='hidepopupbtn'>X</button>
            </div>
            <div class='popupcontentcontainerbox'>";
            if($this->dec($strdls['strbupimg'],$this->strec)!=""&&file_exists("../qrstsbprfpcs/".$this->dec($strdls['strbupimg'],$this->strec))){$strcmr.="<div class='upimgdsplyppupbx'><img width='300px' height='300px' src='../qrstsbprfpcs/".$this->dec($strdls['strbupimg'],$this->strec)."' style='border-radius:5px;'></div>";}
            $strcmr.="</div>
        </div>
    </div>";}
    if($hspn){$strcmr.="<div class='popupbackground streppupbx'>
        <div class='popupcontainerbox streppupbx'>
            <div class='popupheaderbox'>
                <h2 class='popupheadertitle' style='marign:2px;'>Payments</h2>
                <button type='button' class='hidepopupbtn'>X</button>
            </div>
            <div class='popupcontentcontainerbox'>
            <div style='display:flex;'>";
            if($this->dec($strdls['strbupimg'],$this->strec)!=""&&file_exists("../qrstsbprfpcs/".$this->dec($strdls['strbupimg'],$this->strec))){$strcmr.="
                <div class='upimgdsplyppupbx'><h4 style='margin:2px;'>Scan Qr to pay</h4><img width='200px' height='200px' src='../qrstsbprfpcs/".$this->dec($strdls['strbupimg'],$this->strec)."' style='border-radius:5px;'></div><hr>";}
            $strcmr.= "
            <div class='ppupmblnmrdsplydvbx'><h5>Pay via mobile number : </h5>".$this->dec($strdls['stsbsnmblnum'],$this->strec).$this->pmtgtwys($this->dec($strdls['stracptbluipmtmtds'],$this->strec))."</div></div>
            <p style='color:gray;text-align:center;font-size:13px;'><strong>Note:</strong>Verify payment' button below to ask the store about your payment and don't forget to enter your payment method profile name and payment method name, Eg: Ravi via Paytm.";if($this->dec($vfdpndusr['strcstmrcsonavbl'],$this->strec)!=1||$this->dec($strdls['stravblcstoevyon'],$this->strec)==1){$strcmr.="If you are a trusted customer of the store you can ask to enable the C.A.S option";}$strcmr.="</p>
            <center><span id='ttlodritmplcdbycmr'></span><input type='text' id='treptnmitbxval' placeholder='Eg: Ravi via Paytm'></center>
            <div class='blewhtbns vrfypmtsbtninppup' data-vop='-1' data-vo='' style='background:green;margin:auto;'>Verify payment</div>";
            if($this->dec($vfdpndusr['strcstmrcsonavbl'],$this->strec)==1||$this->dec($strdls['stravblcstoevyon'],$this->strec)==1){$strcmr.="<hr><div class='blewhtbns usecasoptionbtn' role='button' style='margin:auto;'>Use C.A.S(Cash At Store) option</div>";}
        $strcmr.= "
            </div>
        </div>
        </div>";}
    $strcmr.="
    ".$this->prdtlrgdsply("",$strdls)."
    <div id='snackbar'></div>
    <div class='popupbackground strhghltspupbx' style='
    background: #442f198c;
    backdrop-filter: blur(5px);'>
    <div class='popupcontainerbox strhghltspupbx' style='
    max-width:400px;
    background: #FA935B;'>
        <div class='popupheaderbox' style='border-radius:5px;
        background: linear-gradient( rgb(90 82 82 / 50%), rgb(98 94 94 / 50%) ),url(";
        if($this->dec($strdls['strcvrpto'],$this->strec)!=""&&file_exists("../fhstsbsncvpcs/".$this->dec($strdls['strcvrpto'],$this->strec))){$strcmr.="../fhstsbsncvpcs/".$this->dec($strdls['strcvrpto'],$this->strec);}
        $strcmr.=");background-size: 100% 100%;'>
            <h2 class='popupheadertitle strqrpupttl' style='
            color: #141946;
            text-shadow: 0 0 22px #ddcece;
            color: #53354A;'><i class='fas fa-highlighter' style='
            background-image: linear-gradient( 
        227deg, #fdf878 45%, #f26060 60%);
            -webkit-background-clip: text;
            -moz-background-clip: text;
            -webkit-text-fill-color: transparent;
            -moz-text-fill-color: transparent;
            font-weight: 600;
        '></i><span style='
        text-shadow: 0 0 10px white;'>Highlights</span></h2>
            <button type='button' class='hidepopupbtn'>X</button>
        </div>
        <div class='popupcontentcontainerbox' style='min-width:250px;'>
            <div class='strhghltscntngdvbx' style='
            font-size: 16px;
            font-weight: 600;margin:10px 0;
            padding: 5px;
            border-radius: 5px;
            color: navajowhite;'>";$strcmr.=str_replace("*/*","<br>",$hts);$strcmr.="</div>
        </div>
    </div>
    </div>
    <div class='popupbackground strcsmradrspupbx'>
    <div class='popupcontainerbox strcsmradrspupbx'>
        <div class='popupheaderbox'>
            <h2 class='popupheadertitle strqrpupttl'>Shipping Details</h2>
            <button type='button' class='hidepopupbtn'>X</button>
        </div>
        <div class='popupcontentcontainerbox' style='min-width:250px;'>";
        if(isset($_SESSION['usrml'])&&isset($_SESSION['ssndi'])){$psn=$this->gtusradrs();
        $strcmr.="<div class=''>
                <div class='fmerdsply' style='color:red'></div>
                <table>
                    <tr>
                        <td>Name*</td>
                        <td><input type='text' id='rmdadrsonme' class='shpdlfrmipt' placeholder='Name' value='".$this->sbldc($psn['rmuflm'],$this->iky)."'></td>
                    </tr>
                    <tr>
                        <td>Address*</td>
                        <td><input type='text' id='rmdadrstr' class='shpdlfrmipt' placeholder='Street address' value='".$this->dec($psn['usrlocty'],$this->iky)."'></td>
                    </tr>
                    <tr>
                        <td>City*</td>
                        <td><input type='text' id='rmdadrcty' class='shpdlfrmipt' placeholder='City' value='".$this->dec($psn['usrcty'],$this->iky)."'></td>
                    </tr>
                    <tr>
                        <td>State*</td>
                        <td><input type='text' id='rmdadrstat' class='shpdlfrmipt' placeholder='State' value='".$this->dec($psn['usrstat'],$this->iky)."'></td>
                    </tr>
                    <tr>
                        <td>PIN Code*</td>
                        <td><input type='text' id='rmdadrpnstlcd' class='shpdlfrmipt' placeholder='PIN/Postal Code' value='".$this->dec($psn['usrpncd'],$this->iky)."'></td>
                    </tr>
                    <tr>
                        <td>Phone*</td>
                        <td><input type='number' id='rmdadrphnmbr' placeholder='Phone number' value='".$this->dec($psn['usrpnmr'],$this->iky)."'></td>
                    </tr>
                </table>
            </div>
            <div class='ctnuoupdtbnscntngdvbx' style='display: flex;align-items: center;justify-content: space-between;align-content: center;margin-top: 20px;'>
                <div class='blewhtbns cntnuecradrstodlvry' style='width: 100%;text-align: center;'>Continue</div>
            </div>
        </div>
    </div>
    </div>";}
    $strcmr.="
    <div class='popupbackground strwchvdoytb' style='z-index:300'>
    <div class='popupcontainerbox strwchvdoytb'>
        <div class='popupheaderbox'>
            <h2 class='popupheadertitle' style='marign:2px;'>Watch Video</h2>
            <button type='button' class='hidepopupbtn stpvdocncl'>X</button>
        </div>
        <div class='popupcontentcontainerbox'></div>
    </div>
    </div>";
    if(isset($_SESSION['usrml'])&&isset($_SESSION['ssndi'])){
    $strcmr.='<script
    src="https://cdn.onesignal.com/sdks/OneSignalSDK.js"
    async=""
    ></script>
    <script>
    window.OneSignal = window.OneSignal || [];
    OneSignal.push(function () {
      OneSignal.init({
        appId: "ba568c8a-1a3b-4e7a-b12e-e49d5c12fd63",
        safari_web_id:
          "web.onesignal.auto.487bfeae-71a3-407e-85d8-1b40bd783a80",
        notifyButton: {
          enable: false,
        },
        subdomainName: "remindo", // Your other init options here
        promptOptions: {
          customlink: {
            enabled: true /* Required to use the Custom Link */,
            style: "button" /* Has value of "button" or "link" */,
            size: "small" /* One of "small", "medium", or "large" */,
            color: {
              button:
                "#1e88e5" /* Color of the button background if style = "button" */,
              text: "#FFFFFF" /* Color of the prompt"s text */,
            },
            text: {
              subscribe: "Allow" /* Prompt"s text when not subscribed */,
              unsubscribe: "Dont allow" /* Prompt"s text when subscribed */,
              explanation:
                "Get updates of order you placed from the store your pin!" /* Optional text appearing before the prompt button */,
            },
            unsubscribeEnabled: true /* Controls whether the prompt is visible after subscription */,
          },
        },
      });
    });
    </script>';
    $strcmr.="<style>
    .allowpushprompt {
      border: 1px solid lightgray;
      border-radius: 3px;
      padding: 8px;
      position: fixed;
      top: 0;
      /* left: 50%; */
      /* transform: translateX(-50%); */
      box-shadow: 0 0 22px -19px black;
      text-align: center;
      z-index: 1;
      background: white;
      display: none;
    }
    .nothnks {
      color: #1e88e5;
      font-family: sans-serif;
      float: right;
      padding: 3px;
      cursor: pointer;
      border-radius: 3px;
    }
    .ntfcnbdy {
      padding: 6px;
    }
    .nothnks:hover {
      background: aliceblue;
    }
    </style>
    <div class='allowpushprompt'>
    <div class='push-img'>
      <img
        src='http://localhost/remindo/includes/fn_img/alaram96.png'
        style='border-radius: 6px'
      />
    </div>
    <div class='ntfcnbdy'>
      <div class='onesignal-customlink-container'></div>
      <div class='nothnks'>No thanks</div>
    </div>
    </div>
    <script src='http://localhost/remindo/stores/push.js'></script>
    ";
    }
    $strcmr.="
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js'></script>
    <script src='http://localhost/remindo/js/comfle.js'></script>
    <script src='http://localhost/remindo/stores/srcmspwres.js'></script>
    <script src='http://localhost/remindo/js/cmnlbxs.js'></script>
    <script src='http://localhost/remindo/stores/fhdtacse.js'></script>
    ";
    $strcmr.="
    <div class='dvsrpts'></div>
    </div>";
    return $strcmr;
}
protected function prdtlrgdsply($isstr,$str){
    $pdtdsply="<div class='cmn-lbx-bckgrond-cntngdvbx'>
    <div class='cmn-lbx-pdt-dsplyr-cntngdvbx'>
        <div class='lbx-dsplyr-tphdr-ctngdvbx' data-adpdck data-pd>
            <div class='lbx-dsplr-bckbtn-dvbx'><i class='fas fa-chevron-left remindosymbols'></i>Back</div>
            <div class='lbx-dsplr-nxpvbtns-dvbx'>
                <div class='lbxblftsbns lbx-dsplr-pewpdt-vwbtn'><i class='fas fa-chevron-left remindosymbols'></i>prev</div>
                <div class='lbxblftsbns lbx-dsplr-nxtpdt-vwbtn'>next<i class='fas fa-chevron-right remindosymbols'></i></div>
            </div>
        </div>
        <div class='lbx-dsplyr-bdy-cntngdvbx'>
        <div class='lbx-pcs-and-pdtimdls-cntng-dvbx'>
        <div class='lbx-onypcs-dsply-cntng-dvbx'>
        <div class='lbx-dsplr-igvwrdvbx'>
            <div class='lbx-igsld-shw-dsplr-dbx'>";
                if($this->dec($str['strrctgre'],$this->strec)!="Grocery Store"){$pdtdsply.="<div class='lbx-sldshw-fwbw-bns-dvbx'>
                    <div class='lxslshwchvrnbtn lbx-sldshw-pew-chrvn-btn'><i class='fas fa-chevron-left remindosymbols'></i></div>
                    <div class='lxslshwchvrnbtn lbx-sldshw-nt-chrvn-btn'><i class='fas fa-chevron-right remindosymbols'></i></div>
                </div>";}
                $pdtdsply.="<div class='lbx-sld-shw-dsply-dvbx'";
                if($this->dec($str['strrctgre'],$this->strec)=="Grocery Store"){$pdtdsply.="style='margin-top:0;'";}
                $pdtdsply.=">
                    <div class='lbx-lrgdsplyprvig-tg'></div>
                </div>
            </div>
            <div class='lbx-igpcs-mrgn-dvbx'>
            <div class='lbx-igpcs-rltdtosldshw-dsplr-dbx' data-pigs=''>
                <div class='lbx-iothpcs-rltosldsh-pxs lbx-pt-pvigs'></div>";
                if($this->dec($str['strrctgre'],$this->strec)!="Grocery Store"){$pdtdsply.="<div class='lbx-iothpcs-rltosldsh-pxs lbx-pt-pvigs'></div>
                <div class='lbx-iothpcs-rltosldsh-pxs lbx-pt-pvigs'></div>
                <div class='lbx-iothpcs-rltosldsh-pxs lbx-pt-pvigs'></div>";}
            $pdtdsply.="</div>
            </div>
        </div>
        </div>
        <div class='lbx-txtims-dls-cntngdvbx'>
        <div class='lbx-pdt-edtbx-mrgn'>
        <div class='lbx-pdstks-lstupdtmstp-dvbx'>
            <div class='lbx-pdsts-updtyp-stks' style='color:green;'>Instock</div>
            <div class='lbx-pdtlst-updt-tmshwn'></div>
        </div>
        </div>
        <div class='lbx-pdt-dls-mrgndvbx'>
        <div class='lbx-pdt-dls-dsplr-dvbx'>
        <strong>Details:</strong>
            <div><div class='lbx-pdt-nmdsplydvbx' data-phdr='Product name'></div>
            <div class='lbx-ptnme-cotmnrtngdvbx'><span class='lbx-alnmctrs-mnrtd-spn '></span></div></div>
            <div class='lbx-pdt-szevrnts-dsplycntngdvbx'>
                <strong class='subsrngfntsz'>";
                $vrtls=["Variants","Quantity","Sizes"];
                $sctgs=["Electronics","Grocery Store","Clothing & Textile"];
                if(in_array($this->dec($str['strrctgre'],$this->strec),$sctgs)){$pdtdsply.=$vrtls[array_search($this->dec($str['strrctgre'],$this->strec),$sctgs)];}else{$pdtdsply.="Variants";}
                $pdtdsply.="</strong>
                <div><div class='lbx-pdt-szedsplydvbx'>
                    <div class='lbx-szes-9slctn-dsply' data-aszs='' data-aspce='' data-tslds=''></div>
                </div>
                <div class='lbx-ptszes-cotmnrtngdvbx'><span class='lbx-alszes-mnrtd-spn '></span></div></div>
            </div>
            <div class='lbx-pdt-ftres-dsplydvbx-edtstoo'>
                <strong class='subsrngfntsz'>features</strong>
                <div><div class='lbx-pdt-fchrswrtn-dvbx' data-phdr='Product features'></div></div>
            </div>
        </div>
        </div>
        <div class='lbx-pdt-prcmthme-dvbx-mrgn wchvdobnctngdvbx'>
        <div class='lbx-pdt-prcmchme-dsplybx wchvdobnctngdvbx'>
            <div class='wchebdytvdo' data-vul='' style='padding: 6px;border: 1px solid #e4e4e4;box-shadow: 0 0 12px -7px #6b5b5b;border-radius: 4px;cursor:pointer;'><strong>Watch video</strong></div>
        </div>
        </div>
        <div class='lbx-pdt-prcmthme-dvbx-mrgn'>
        <div class='lbx-pdt-prcmchme-dsplybx'>
            <div class='lbxpthlfcmncls lbx-pdt-prccntngbx'><strong>Price: </strong><span class='lbx-pdtprce-dsply'></span>₹</div>
            <div class='lbxpthlfcmncls lbx-pdt-mtchmebtn mhmebtn coumhebn' data-sid='' data-pid='' data-m=''>Match me</div>
        </div>
        </div>";
        if(isset($_SESSION['ssndi'])){$pdtdsply.="<div class='lbx-pdt-adrmqty-mrgn'>
        <div class='lbx-pdt-adqty-dsply-bx'>
            <div class='lbxpthlfcmncls lbx-adpdt-qty-dvbx'>
                <div class='lbx-pqty-icnbtns-dsply-cntngdvbx'>
                <div class='lbxqtybtns lbx-adpdt-qty-dec-btn'><i class='fas fa-minus remindosymbols'></i></div>
                <div class='lbxqtybtns lbx-adpdt-qty-inc-btn'><i class='fas fa-plus remindosymbols'></i></div>
                </div>
                <div class='lbx-pqty-iptqty-dvbx'><input type='number' class='lbx-nedqty-bx' value='1'></div>
            </div>
            <div class='lbxpthlfcmncls pdtadtolstbtn'>Quantity</div>
        </div>
        </div>";}
        $pdtdsply.="<div class='lbx-pdt-adrmqty-mrgn'>
        <div class='lbx-pdt-adqty-dsply-bx'>
            <div class='lbxpthlfcmncls pdtadtolstbtn lbx-pdtshr-btn shrpstbn' data-ttl='Remindo.in' data-txt='' data-pic='' data-url='http://localhost/remindo/' style='cursor:pointer;'><i class='fas fa-share remindosymbols' style='font-weight:500;'></i>Share</div>";
            if(isset($_SESSION['ssndi'])){$pdtdsply.="<div class='lbxpthlfcmncls pdtadtolstbtn lbx-adto-lst-btn'>Add</div>";}
        $pdtdsply.="</div>
        </div>
        <div class='lbx-pdt-dscrptn-mrgn'>
        <div class='lbx-pdt-dscrptn-dsply-bx'>
        <strong>More about this:</strong>
        <div><div class='lbx-pdtmr-dls-dsplybx' data-phdr='More details about this product.'></div>
        <div class='lbx-mbtns-cotmnrtngdvbx'><span class='lbx-alwdsmbths-mnrtd-spn lbx-dvedbl-mntrng-spntgs'></span></div></div>
        </div>
        </div>
        </div>
        </div>
        </div>
        <div class='lbx-rltd-pdts-dsply-cntngbx'>
            <div class='lbx-rltd-pdts-hdng'>Related</div>
            <div class='lbx-rltd-pdts-bdy'>
            <div class='lbx-rld-rltdpds-dvbx str-alpdts-dspl-dvbx prdtsdsplngwall'>
            </div>
            </div>
        </div>
        <div class='lbx-ftrdsply-shld-ctngbx' style='display:none;'>
        <div class='lbx-dsply-ftr-ctngdvbx'>
            <div class='lbx-dply-ftrbdy-cntgdvbx'>
                <div class='lbxdspd-imaded-igs-dsplyr'>
                    <div class='lbxftr-thshws-pdtigs-dsplrbx'>
                    </div>
                    <div class='lbxftr-thsshws-ttlims-inlst'></div>
                </div>
                <div class='lbxdspd-shwme-odrbtn-dvbx'>
                    <div class='blewhtbns lbxdspd-shwmy-odr-btn' role='button'>show</div>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
        </div>
    </div>
    <div class='lbx-main-mchme-cntngdvbx'>
    </div>
    </div>
    </div>";
    return $pdtdsply;
}
public function vfyusr($usr){
    if(isset($_SESSION['ssndi'])){
    $s=$this->strdtls($usr);
    if($s!=0){
        if($this->dec($s['strbsnonr'],$this->iky)==htmlentities($_SESSION['ssndi'])){return "o";}else{
            if($this->vfycmrol($s["stnmr"])!=0){return [$this->dec($this->vfycmrol($s["stnmr"])['strolofpsn'],$this->iky)=="Embedder"?"ebd":"ot",$this->dec($this->vfycmrol($s["stnmr"])['strolofpsn'],$this->iky)];}
            else{if($this->chckifpnd($this->enc($s['stnmr'],$this->strec,'strix'))!=0){return "c1";}else{return "c0";}}
        }
    }else {return 0;}
    }
}
public function dc($txt){return $this->dec($txt,$this->iky);}
}
$prsclss = new storenvironment();
function bdyjsn($st,$s){
    echo json_encode(array(
    'title'=> "$st | Remindo",
    'body'=> $s,
));}
if(isset($_POST['s'])){
    $str=htmlspecialchars($_POST['s']);
if(isset($_SESSION['ssndi'])){
if($prsclss->vfyusr($str)=="o"){$s= $prsclss->storewnrs($prsclss->strdtls($str),"onr");
    bdyjsn("Store Owner",$s);}
elseif($prsclss->vfyusr($str)[0]=="ot"){$s= $prsclss->storewnrs($prsclss->strdtls($str),$prsclss->vfyusr($str)[1]);
    bdyjsn("Store Owner",$s);}
elseif($prsclss->vfyusr($str)[0]=="ebd"){$s= $prsclss->storecustmr($prsclss->strdtls($str),true,$prsclss->vfyusr($str)[1]);
    bdyjsn("Store",$s);}
elseif($prsclss->vfyusr($str)=="c1"){$s= $prsclss->storecustmr($prsclss->strdtls($str),true,"");
 bdyjsn("Store",$s);}
else{echo $prsclss->storecustmr($prsclss->strdtls($str),false,"");}
}
else{echo $prsclss->storecustmr($prsclss->strdtls($str),false,"");}
}
elseif(isset($_POST['ppsttevt'])){
    if($_POST['ppsttevt']=="frdppstt"&&isset($_GET['s'])){
    $str=htmlspecialchars($_GET['s']);
    if(isset($_SESSION['ssndi'])){
    if($prsclss->vfyusr($str)=="o"){$s= $prsclss->storewnrs($prsclss->strdtls($str),"onr");
    bdyjsn($str,$s);}
    elseif($prsclss->vfyusr($str)[0]=="ot"){$s= $prsclss->storewnrs($prsclss->strdtls($str),$prsclss->vfyusr($str)[1]);
        bdyjsn("Store Owner",$s);}
    elseif($prsclss->vfyusr($str)[0]=="ebd"){$s= $prsclss->storecustmr($prsclss->strdtls($str),true,$prsclss->vfyusr($str)[1]);}
    elseif($prsclss->vfyusr($str)=="c1"){$s= $prsclss->storecustmr($prsclss->strdtls($str),true,"");
    bdyjsn($str,$s);}}
    else{echo $prsclss->storecustmr($prsclss->strdtls($str),false,"");}}
}else{
if(!isset($_SESSION['ssndi'])){
if((isset($_COOKIE['_ugdae'])&&isset($_COOKIE['_urdi_']))||(isset($_SESSION['ssndi'])&&isset($_SESSION['usrml']))){
    $ugdae=htmlentities(htmlspecialchars($_COOKIE['_ugdae']));
    $urdi=htmlentities(htmlspecialchars($_COOKIE['_urdi_']));
    if(!isset($_SESSION['ssndi'])){
    $_SESSION['ssndi']=$prsclss->dc($urdi);
    $_SESSION['usrml']=$prsclss->dc($ugdae);}
}
}
if(isset($_GET['s'])){
    $str=htmlspecialchars($_GET['s']);
    if($str!=""&&$prsclss->vfyusr($str)!="0"){
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>';echo $str; echo ' | Remindo</title>';
    include '../commonfiles/commoncss.php';
    echo '<meta name="theme-color" content="#0EA792">
    </head>
    <body class="storecustmrpgbdy">
    <div class="pageloader" style="display:none;"><div class="remindopageloaderdivbox"></div></div>
    <div class="remindomainheaderlptpvsn strpghdrcntnrdvbx"></div>
    <div class="remindochildboxycontainer rmdchldbxstrecustmruidvbx">';
    if(isset($_SESSION['usrml'])&&isset($_SESSION['ssndi'])){
    if($prsclss->vfyusr($str)=="o"){echo $prsclss->storewnrs($prsclss->strdtls($str),"onr");}
    elseif($prsclss->vfyusr($str)[0]=="ot"){echo $prsclss->storewnrs($prsclss->strdtls($str),$prsclss->vfyusr($str)[1]);}
    elseif($prsclss->vfyusr($str)[0]=="ebd"){echo $prsclss->storecustmr($prsclss->strdtls($str),true,$prsclss->vfyusr($str)[1]);}
    elseif($prsclss->vfyusr($str)=="c1"){echo $prsclss->storecustmr($prsclss->strdtls($str),true,"");}else{echo $prsclss->storecustmr($prsclss->strdtls($str),false,"");}
    }else{echo $prsclss->storecustmr($prsclss->strdtls($str),false,"");}
    echo "
    </div>
    </body>
    </html>";
    }
    else{echo "<center><h2 style='color:gray;'>This store is no longer available.</h2><br><a href='https://remindo.in'><div class='pgnavblbtn blewhtbns'><i class='fas fa-arrow-left remindosymbols' style='color:white; font-size:14px;'></i>Back to home</div></a><br></center>";}
    }
}
?>