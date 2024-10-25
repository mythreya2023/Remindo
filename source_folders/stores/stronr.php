<?php
include "../stsupsflr/fhstdtls.php";
class strbsnenvmt extends fhstdls {
public $person;
public function storewnrs($strdls,$isonr){
    $isonr=strtolower($isonr);
    $bnm=strtoupper(substr($this->sbldc($strdls['strnm'],$this->strec),0,1)).substr($this->sbldc($strdls['strnm'],$this->strec),1);
    $strnmodrs=explode("||",$this->dec($strdls['strodrlmts'],$this->strec));
    $strcmr="<div class='rmdohomepagediv'>
    <div class='rmdohmpghdr'></div>
    <div class='storenvcustmruicntrdvbx'>
        <div class='othstorspndandsgg'></div>
        <div class='csmruiofstoreenvicntrdvbx'>
            <div class='strebsnsprfdtlscntrdvbox'>
                <div class='stronrpgtphdr'>
                <input type='hidden' id='hdnvlsrolpsn' value='$isonr'>
                <input type='hidden' id='hnsnmrvliptbx' value='".$this->enc($strdls['stnmr'],$this->strec,'mtr')."'>
                    <div class='strifoandothrbtnsdvbx'>
                    <div class='strinfottldvbx'>".$this->dec($strdls['strrctgre'],$this->strec)." Info</div>
                    <div style='display:flex;width:fit-content;height:-moz-fit-content;'><div class='blewhtbns'
                    style='height: fit-content;height:-moz-fit-content;margin: 6px;' id='swthstrbtn' role='button'><i class='fas fa-highlighter remindosymbols' style='
                    padding: 0;
                    font-size: 16px;
                    font-weight: 600;
                    background: #f03012;
                    background-image: linear-gradient(
                227deg, #fdf878 45%, #f26060 60%);
                    -webkit-background-clip: text;
                    -moz-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    -moz-text-fill-color: transparent;
                    background-color: #f3ec78;'></i></div>";
                    if($isonr=="onr"||$isonr=="admin"||$isonr=='product manager'){$strcmr.="<div class='strprdtspgnvgtrbtndvbx' style='height:fit-content;height:-moz-fit-content;' id='prdtsnvgtbtn' data-sn='".$this->sbldc($strdls['stratmnt'],$this->strec)."' data-si='".$this->enc($strdls['stnmr'],$this->strec,'mtr')."' role='button'>Products</div>";}
                    $strcmr.="</div></div>
                </div>
                <div class='strebssnsprflpcsdvbx'>
                    <div class='strebscvradmpsdvbx'>
                        <div class='strbsncvrprfpcbx'>
                        <div class='strbsncvrpicdsplybx'>";
                        if($this->dec($strdls['strcvrpto'],$this->strec)!=""&&file_exists("../fhstsbsncvpcs/".$this->dec($strdls['strcvrpto'],$this->strec))){$strcmr.="<img src='../fhstsbsncvpcs/".$this->dec($strdls['strcvrpto'],$this->strec)."' class='strbsnsprfcvrpc' >";}
                        $strcmr.="</div>";
                        if($isonr=="onr"||$isonr=="admin"){$strcmr.="<div class='streownredtacntpicsbtn streownrpgupdtstrscvrpicbtn' role='button' data-o='".$this->dec($strdls['strcvrpto'],$this->strec)."' data-t='bnstrcvpt'><i class='fas fa-camera remindosymbols'></i></div>";}
                        $strcmr.="</div>
                        <div class='strbsnmpsndvbx'>
                            <div class='strepysclgelctincntnrdvbx'>";
                            if($this->dec($strdls['strlgtdlatd'],$this->strec)!=""){$strcmr.="<div id='map'><img src='https://maps.googleapis.com/maps/api/staticmap?center=Brooklyn+Bridge,New+York,NY&zoom=13&size=600x300&maptype=roadmap&markers=color:blue%7Clabel:S%7C40.702147,-74.015794&markers=color:green%7Clabel:G%7C40.711614,-74.012318&markers=color:red%7Clabel:C%7C40.718217,-73.998284&key=AIzaSyCiDZ4Jph0U5l51LnFhY036k1gzAOr44l4'></div>";}
                            $strcmr.="</div>";
                            if($isonr=="onr"||$isonr=="admin"){$strcmr.="<div class='streownredtacntpicsbtn streownrpgupdtstrsphsllocbtn' id='edtlcnmps' role='button'><i class='fas fa-map-marker-alt remindosymbols'></i></div>";}
                        $strcmr.="</div>
                    </div>
                    <div class='strebsprfpcigcntrnrdvbx'>";
                        if($this->dec($strdls['strbprflig'],$this->strec)!=""&&file_exists("../fhupuppts/".$this->dec($strdls['strbprflig'],$this->strec))){$strcmr.="<img src='../fhupuppts/".$this->dec($strdls['strbprflig'],$this->strec)."' class='strbsnsprfpc'>";}
                    $strcmr.="</div>";
                    if($isonr=="onr"||$isonr=="admin"){$strcmr.="<div class='streownredtacntpicsbtn streownrpgupdtstrsprflpicbtn' role='button' id='cngpfrmglrybtn' data-o='".$this->dec($strdls['strbprflig'],$this->strec)."' data-t='bnstrpfpt'><i class='fas fa-camera remindosymbols'></i></div>";}
                $strcmr.="</div>
                <div class='strbsnothprfldtlscntnrdvbx'>
                    <div class='strrtngsdvcntnrdvbx'>
                        <div class='strertnginnumdvbx'></div>
                        <div class='strertnginstrsdvbx'>";
                        //  if($this->dec($strdls['strsprtng'],$this->strec)>0){
                        //     $fr=floor($this->dec($strdls['strsprtng'],$this->strec));
                        //     for($i=1;$i<=$fr;$i++){$strcmr.="&#9733;";}
                        //     if($fr<5){for($i=1;$i<=5-$fr;$i++){$strcmr.="&#9734;";}}
                        // }else{$strcmr.="&#9734;&#9734;&#9734;&#9734;&#9734;";}
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
                            if($isonr=="onr"||$isonr=="admin"||$isonr=="cashier"){$strcmr.="<div class='strqrupipmtavblcntnrdvbx strspywhqrsnupiopnetbnbx' data-t='bnstrppt' data-o='".$this->dec($strdls['strbupimg'],$this->strec)."'>".$this->strspgicns("qr")."<strong> Edit QR UPI</strong></div>";}
                            $strcmr.="<div class='strprsntrcvngordrsorntstsdvbx'>";
                            if($this->dec($strdls['strsodrrcvngsts'],$this->strec)==1){$strcmr.="<div class='strstsdvbxrcvngords'>.Receiving Orders</div>";}else{$strcmr.="<div class='strstsnonrcvngordsdvbx'>.Not Available</div>";}
                            $strcmr.="</div>
                        </div>
                    </div>
                    <div class='strsbsnprfledtbtndvbx'>";
                        if($isonr=="onr"||$isonr=="admin"){$strcmr.="<div class='strsopnrcvngstsdvbx'>
                        <div class='stsstschng strsonstscntnrdvbxbtn' role='button'><div class='strondvbxtxtttldvbx'>Open</div><div class='toggleswitch tglbtn'><label class='switch'>";
                            if($this->dec($strdls['stropnsts'],$this->strec)==1){$strcmr.="<input type='checkbox' id='stropnbtn' data-s='".$this->enc($strdls['stnmr'],$this->strec,'mtr')."' data-ud='fs' checked>";}
                            else{$strcmr.="<input type='checkbox' id='stropnbtn' data-ud='tre' data-s='".$this->enc($strdls['stnmr'],$this->strec,'mtr')."' unchecked>";}
                            $strcmr.="<span class='slider round'></label></div>
                            </div>
                            <div class='stsstschng strsrcvngstscntnrdvbxbtn' role='button'><div class='strrcvngdvbxtxtttldvbx'>Receiving Orders</div><div class='toggleswitch tglbtn'><label class='switch'>";
                            if($this->dec($strdls['strsodrrcvngsts'],$this->strec)==1){$strcmr.="<input type='checkbox' id='strodrrcvngbtn' data-ud='fs' data-s='".$this->enc($strdls['stnmr'],$this->strec,'mtr')."' checked>";}
                            else{$strcmr.="<input type='checkbox' id='strodrrcvngbtn' data-ud='tre' data-s='".$this->enc($strdls['stnmr'],$this->strec,'mtr')."' unchecked>";}
                            $strcmr.="<span class='slider round'></label></div></div></div>";}
                        if($isonr=="onr"){$strcmr.="<div class='strsedtprfdtlsbtn' id='strsedtprfdtlsbtn' role='button' data-sn='".$this->sbldc($strdls['stratmnt'],$this->strec)."' data-si='".$this->enc($strdls['stnmr'],$this->strec,'mtr')."'><i class='fas fa-pen remindosymbols'></i></div>";}
                    $strcmr.="</div>
                    <div class='strebsnstxtdtlscntrdvbx' style='margin: 6px 0;border: 1px solid lightgray;background: white;border-radius: 6px;'>
                    <div class='streprflnmedv'><i class='fas fa-store remindosymbols'></i><span class='strdtlsspgtg'>$bnm</span></div>
                    <div class='streprflatmntndv'><i class='fas fa-at remindosymbols'></i><span class='strdtlsspgtg'>".$this->sbldc($strdls['stratmnt'],$this->strec)."</span></div>
                    <div class='streprflmblnmdvbx'><div calss='strmblicnpnumdvbx'><i class='fas fa-phone-alt remindosymbols'></i> <span class='strdtlsspgtg'><a href='tel:".$this->dec($strdls['stsbsnmblnum'],$this->strec)."' style='color:#22225d;'>".$this->dec($strdls['stsbsnmblnum'],$this->strec)."</a></span> &nbsp;&nbsp;</div>".$this->pmtgtwys($this->dec($strdls['stracptbluipmtmtds'],$this->strec))."</div>";
                    if($this->dec($strdls['strseml'],$this->strec)!=""){$strcmr.="<div class='streprflemldvbx'><i class='fas fa-envelope remindosymbols'></i><span class='strdtlsspgtg'><a href='mailto:".$this->dec($strdls['strseml'],$this->strec)."' style='color:#22225d;'>".$this->dec($strdls['strseml'],$this->strec)."</a></span></div>";}
                    $strcmr.="<div class='streprflctgrenmdvbx'><div calss='strctgreicnpnumdvbx'><img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAABBklEQVRIiWNgGAXDHjCiC5RkZW0VFhRUI8ewd2/f3uqeMcMbqwWJoaGi/Pz89Tra2hFysrLC5Fjw8PHjt9euXVv+4cOHpvmrV79mYGBgYIJJ8vPyRltaWmaTazgDAwODvKyssIWFRQ4/L280TIwJWQErCwu5ZuM0gwmHOqoBnE5+9/49Yc3MzAzMTBA3cvPwkGaBkKAgQQuIAYMjiPj4+Bg+ffqE1yBcPiY6iMgNMpoHEdyCv///f3/18uVXSg189fLl17///3/HsEBYXn72pYsXgy5fvfqQXMMvX7ny8PylS4HC8vKzYWIYhV1RenovNw+PJjkWfP3y5XrfzJnF5DpwFAxRAABsWEtDNkycnQAAAABJRU5ErkJggg=='> <span class='strdtlsspgtg'>".$this->dec($strdls['strrctgre'],$this->strec)."</span></div></div>";
                    $strcmr.="<div class='streprflavablpmtgtwsdvbx'><i class='fas fa-door-open remindosymbols'></i><strong>Store Timings</strong>
                    <div class='streprflonlpmtsdvbx'><div class='sroctmgsinjsn' style='padding:3px;'>";$srtmgs=$this->dec($strdls['stropngclsngtmgs'],$this->strec);if($srtmgs!="nha"&&$srtmgs!=""){$edsus=explode("||",$srtmgs);$ed=explode("//",$edsus[0]);$su=explode("//",$edsus[1]);$strcmr.="<span style='font-weight:600;color:darkslategray;'>Everyday | </span><span style='color:green'>open:</span> ".$ed[0]." - <span style='color:red'>close</span>: ".$ed[1]."<br><span style='font-weight:600;color:red;'>Sunday | </span><span style='color:green'>open</span>: ".$su[0]." - <span style='color:red;'>close:</span> ".$su[1];}else{$strcmr.="<span style='color:darkslategray;font-weight:600'>No Hours Available</span>";}
                    $strcmr.="</div></div></div>
                    <br>
                    </div>";
                    if($isonr=="onr"||$isonr=="admin"){$strcmr.="<div class='lmtodrsedtngdvbx' style='margin:6px 0;'>
                        <div class='tlmtdodrsctndvbx' style='display: flex;flex-direction: row;flex-wrap: nowrap;align-items: center;justify-content: space-between;background: white;border: 1px solid lightgray;border-radius: 6px;padding: 0 10px;'>
                            <div><span style='font-weight: 600;color: darkslategray;font-size: 14px;'>Orders Limited To: </span><strong><span class='lmodrcntspntg'>".(isset($strnmodrs[0])&&$strnmodrs[0]!=""?$strnmodrs[0]:"0")."</span></strong></div><div class='odrlmtschvrons'><i class='fas fa-chevron-down remindosymbols lmodschvrnbtn' style='cursor:pointer;'></i></div>
                        </div>
                        <div class='tlmtodrscngbledvbx' style='display:flex;justify-content: space-around;align-items: center;padding: 5px;background: white;border: 1px solid lightgray;border-radius: 0 0 6px 6px;border-top:none;display:none;'>
                            <div style='display: flex;flex-direction: row;flex-wrap: nowrap;align-items: center;justify-content: flex-start;width:fit-content;height:fit-content;display: flex;align-items: center;justify-content: space-around;padding: 6px;'>
                            <div class='nwlmtrsetrbtn' style='width: fit-content;height: fit-content;padding: 3px 6px;background: #1e88e5;color: white;border-radius: 2px;cursor: pointer;'>LIMIT</div><input  type='number' placeholder='Orders' style='width: 64px;' class='nwlmtnmrrster' value='".(isset($strnmodrs[0])?$strnmodrs[0]:"0")."'></div>
                            <div class='nmofodslftcntngdvbx'>
                                <strong><span class='tlitmslft' style='font-weight:17px;'>".(isset($strnmodrs[1])?$strnmodrs[1]:"0")."</span></strong><span style='color: darkslategray;font-weight: 600;font-size: 14px;'> Left</span>
                            </div>
                        </div>
                    </div>";}
                    // if($isonr=="onr"){$strcmr.="<div class='strscasavblstsstsdvbx'>
                    //     <div class='stsstschng strsonstscntnrdvbxbtn' style='margin-top: 10px;display: flex;justify-content: space-around;' role='button'><div class='strondvbxtxtttldvbx'>Enable <strong>C.A.S(Cash At Store)</strong> To Everyone</div><div class='toggleswitch tglbtn'><label class='switch'>";
                    //         if($this->dec($strdls['stravblcstoevyon'],$this->strec)==1){$strcmr.="<input type='checkbox' id='stravblcasbtn' data-s='".$this->enc($strdls['stnmr'],$this->strec,'mtr')."' data-ud='fs' checked>";}
                    //         else{$strcmr.="<input type='checkbox' id='stravblcasbtn' data-ud='tre' data-s='".$this->enc($strdls['stnmr'],$this->strec,'mtr')."' unchecked>";}
                    //         $strcmr.="<span class='slider round'></label></div>
                    //         </div></div>";}
                    $strcmr.="
                    <div class='strepgmrdtlscntrdvbx' style='margin: 6px 0;border: 1px solid lightgray;background: white;border-radius: 6px;padding: 3px;'>
                    <div class='strmrdtlshedcntrdvbx' role='button'><i class=''></i><strong>More</strong></div>
                        <div class='strepgmrdtlsabtstrbdycntrdvbx'>
                            <div class ='strephcladrescntnrdvbx'>
                                <div class='strdsplyadrsdvasbtn' role='button'><i class='fas fa-map-marker-alt remindosymbols'></i>Store Address</div>
                                <div class='stradrsbdydvbx'><span class='strdtlsspgtg'>".$this->dec($strdls['stradrs'],$this->strec)."</span></div>
                            </div>";
                            if($isonr=="onr"||$isonr=="admin"){$strcmr.="<div class='pndcstmrsnvgtnbtndvbx' role='button'><i class='fas fa-thumbtack remindosymbols'></i> Pinned customers</div>";
                            $strcmr.="<div class='strovrvwisgtsnvgtnbtndvbx' style='cursor:pointer;' role='button'><i class='fas fa-project-diagram remindosymbols'></i> Overview & Insights</div>";}
                            $strcmr.="<div class='strrolspgnvgtbn' data-sn='".$this->sbldc($strdls['stratmnt'],$this->strec)."' style='cursor:pointer;' data-si='".$this->enc($strdls['stnmr'],$this->strec,'mtr')."' role='button'><i class='fas fa-users remindosymbols'></i>Store team</div>";
                        $strcmr.="</div>
                    </div>
                    <div class='bcktostreordruidvbx'>
                        <div class='bckbtntogstrbtn' role='button'><i class='fas fa-arrow-up remindosymbols'></i></div>
                    </div>
                </div>
            </div>
            <div class='strownrepgstordscntnrdivbox'>
                <div class='strownrpghdrstredtlscntnrdvbx' style='height:fit-content;height:-moz-fit-content;box-shadow: 0 1px 13px -7px #605656;'>
                    <div class='strownrpgtphdrcntnrdvbx'>
                        <div class='strownrpgtphdrcntbckgndblkdvbx'>
                            <div class='strownrsdtlsbtncntnrdvbx'>
                                <div class='strsttlordrslftcntnrdvbx'>
                                    <strong><span class='strsodrinnmcntngspntgbx'>0</span></strong><span> Orders Left</span>
                                </div>
                            </div>
                            <div class='strownrpgstkngtoaccntpgbtncntnrdvbx'>
                                <div class='streownrsprfldtlspgbtn' role='button'><i class='fas fa-store remindosymbols'></i></div>
                            </div>
                            <div class='strpghdrstrprfdtlscntrdvbx'>
                                <div class='bcktopndstrspgbtndvbx' role='button'><i class='fas fa-arrow-left remindosymbols'></i></div>
                                <div class='strownrpgcmrsprfldtlsdvbx'>
                                    <div class='vmpstrprfbsndtlscntnrdvbx'>
                                        <div class='strbsnprfpiccntnrdvbox'>";
                                        if($this->dec($strdls['strbprflig'],$this->strec)!=""&&file_exists("../fhupuppts/".$this->dec($strdls['strbprflig'],$this->strec))){$strcmr.="<img src='../fhupuppts/".$this->dec($strdls['strbprflig'],$this->strec)."' class='strbsnprfpicimg'>";}
                                            $strcmr.="
                                        </div>
                                        <div class='strbnnmatmtstrstscntnrdvbx'>
                                            <div class='onetxtelpss strnamecntnrdvbx' style='max-width:250px;'>$bnm</div>
                                            <div class='stratmentioncntnrdvbx'><i class='fas fa-at remindosymbols'></i><span class='strscstmrsatmtncntngspntg'>".$this->sbldc($strdls['stratmnt'],$this->strec)."</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='' style='display: flex;align-items: center;justify-content: space-around;align-content: center;flex-wrap: nowrap;flex-direction: row;background: white;'>
                        <div class='alupcdodrs'><i class='fas fa-box-open remindosymbols stronrtbsicns'></i></div>
                        <div class='shpcdodrs'><i class='fas fa-box remindosymbols stronrtbsicns'></i></div>
                        <div class='shodstoshp'><i class='fas fa-shipping-fast remindosymbols stronrtbsicns'></i></div>
                    </div>
                </div>
                <div class=''>
                <div class='strpgmdbdyofodrlstscntnrdvbx strpgmbdyupcdodscntnrdvbx stronrbdyctnrdvbx'><div class='strpgmdbdyctgsdvx' style='position:relative;'></div></div>
                <div class='strpgmdbdyofodrlstscntnrdvbx strpgmdbdypckdodrscntnrdvbx stronrbdyctnrdvbx' style='display:none;'><div class='strpgmbdytphdrdvbx'>
                <div class='strsrchodrbyid'><span><input id='srchodript' placeholder='Search order by id' style='border: 1px solid lightgray;'><span><i class='fas fa-search remindosymbols srchodrbyicnbtn' style='margin:3px'></i></span></span><span><i class='fas fa-sync-alt remindosymbols rfrshpckdodrs' style='margin:3px'></i></span></div>
                </div><div class='strpgmdbdyctgsdvx' style='position:relative;'></div></div>
                <div class='strpgmdbdyofodrlstscntnrdvbx strpgmdbdyodrsrdytodlvrcntnrdvbx stronrbdyctnrdvbx' style='display:none;'><div class='strpgmdbdyctgsdvx'  style='position:relative;'></div></div>
                </div>
                <div class='strownrpgftrtoshwppupsdvbx'>
                    <div class='strordrmtnrngdvbx' data-op=''>
                        <div class='mtrngnmofitmslftinanordr'><span class='ttlitmslfttopckinodrspntg' style='font-weight:600'>0</span> Items Left</div>
                        <div class='mtrngnmalldnbtnifallitmsarpckddvbx' role='button' data-op=''>Order Packed</div>
                    </div>
                </div>
            </div>
        </div>
        <div class='popupbackground updstrdpsbx'>
        <div class='popupcontainerbox updstrdpsbx'>
            <div class='popupheaderbox'>
                <h2 class='popupheadertitle updstrhdrttle'></h2>
                <button type='button' class='hidepopupbtn'>X</button>
            </div>
            <div class='popupcontentcontainerbox'>
                <center>
                <div class='rmvstrdpcspicbtndvbx' role='button' style='cursor:pointer;color:red;'>Remove</div><hr>
                <label><div class='chngnwrmdoprflpicdvbx' role='button' style='cursor:pointer;color: #1967d2;'>Change<input type='file' data-tp='' data-oi='' id='strprpicchngipt' class='rmdprpicchngiptinprfpg'></div>
                </label>
                </center>
            </div>
        </div>
        </div>
        <div class='popupbackground streqrppupbx'>
        <div class='popupcontainerbox streqrppupbx'>
            <div class='popupheaderbox'>
                <h2 class='popupheadertitle strqrpupttl'>Edit Qr UPI</h2>
                <button type='button' class='hidepopupbtn'>X</button>
            </div>
            <div class='popupcontentcontainerbox'>
                <div class='bhumupiqrcdcntngdvbx'>
                    <div class='stravblupqrsndsplyctnrdvbx'>";
                    if($this->dec($strdls['strbupimg'],$this->strec)!==""&&file_exists("../qrstsbprfpcs/".$this->dec($strdls['strbupimg'],$this->strec))){$strcmr.="<img src='../qrstsbprfpcs/".$this->dec($strdls['strbupimg'],$this->strec)."' class='srupqrig'>";}
                    $strcmr.="</div>
                    <div class='stredtqrscnbtnsctngdvbx'>
                        <div class='blewhtbns rmvqrscnigbtn' style='background:red;' role='button'>Remove</div>
                        <label><div class='blewhtbns cngqrscnigbtn' role='button'>Change<input type='file' data-tp='' data-oi='' id='strqrpiccngipt' class='rmdprpicchngiptinprfpg'></div>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class='popupbackground strhghltspupbx' style='
        background: #442f198c;
        backdrop-filter: blur(5px);'>
        <div class='popupcontainerbox strhghltspupbx' style='max-width:400px;
        background: #FA935B;'>
            <div class='popupheaderbox' style='border-radius:5px;background:linear-gradient( rgb(140 130 130 / 50%), rgb(140 130 130 / 50%) ),url(";
            if($this->dec($strdls['strcvrpto'],$this->strec)!=""&&file_exists("../fhstsbsncvpcs/".$this->dec($strdls['strcvrpto'],$this->strec))){$strcmr.="../fhstsbsncvpcs/".$this->dec($strdls['strcvrpto'],$this->strec);}
            $strcmr.=");
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
                <div class='strhghltscntngdvbx edtbltgs' contenteditable='true' style='
                font-size: 16px;caret-color: #f0ff54;
                font-weight: 600;margin:10px 0;
                padding: 5px;
                background: #f78f36;
                min-height: 80px;
                border-radius: 5px;
                border: 1px solid #877474;
                color: navajowhite;' data-phdr='Store Highlights'>";$hts=$this->dec($strdls['strhlgts'],$this->strec);$strcmr.=str_replace("*/*","<br>",$hts);$strcmr.="</div>
            <div class='updthghlts' style='
                    padding: 1px 4px;
                    background: #cf2929d9;
                    border-radius: 5px;
                    height: fit-content;height:-moz-fit-content;
                    width: 98%;
                    margin-top: 5px;
                    color: wheat;
                    font-size: 14px;
                    font-weight: 600;
                    cursor: pointer;
                    text-align: center;
                    padding: 5px;'>Highlight</div>
            </div>
        </div>
        </div>
        <div class='popupbackground strcsmradrspupbx'>
        <div class='popupcontainerbox strcsmradrspupbx'>
            <div class='popupheaderbox'>
                <h2 class='popupheadertitle strqrpupttl'>Shipping Detalis</h2>
                <button type='button' class='hidepopupbtn'>X</button>
            </div>
            <div class='popupcontentcontainerbox' style='min-width:250px;'>
                <div class='usrshpngdlscntngdvbx'>
                <style>td.fldl {
                    padding: 9px 0;
                    font-size: 15px;
                    color: darkslategray;
                }</style>
                <div class='usadrescntngdvbx'>
                <table>
                    <tr>
                        <td>Order ID</td>
                        <td class='fldl' id='cmoid'>: </td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td class='fldl' id='cmnme'>: </td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td class='fldl' id='cmads'>: </td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td class='fldl' id='cmcty'>: </td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td class='fldl' id='cmstat'>: </td>
                    </tr>
                    <tr>
                        <td>PIN Code</td>
                        <td class='fldl' id='cmpncd'>: </td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td class='fldl' id='cmpnmr'>: </td>
                    </tr>
                </table>
                </div> 
                <div class='usrshpngcrgscntngdvbx'>
                <table>
                    <tr>
                        <td>Courier Charge*</td>
                        <td><input type='number' id='rmdodrcrcg' class='shpdlfrmipt' placeholder='Courier Charge' value=''></td>
                    </tr>
                    <tr>
                        <td>GST*</td>
                        <td><input type='number' id='rmdgstodr' class='shpdlfrmipt' placeholder='GST' value=''></td>
                    </tr>
                </table>
                </div>
                <div class='odrdlvrcntngdvbx'>
                <table>
                    <tr>
                        <td>Delivery details*</td>
                        <td><textarea id='rmdodrdlvtxt' style='min-width: 230px;min-height: 60px;border:1px solid gray;background: #f0ebeb47;border-radius: 6px;' placeholder='Delivery details'></textarea></td>
                    </tr>
                </table>
                </div>
                <div class='procdbtnctngdvbx'>
                    <div class='corerrordsply' style='color:red;'></div>
                    <div class='blewhtbns prcdbtn' style='text-align:center;width:95%;'>Proceed</div>
                    <div class='blewhtbns odrdlvsntbtn' style='text-align:center;width:95%;'>Send</div>
                </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <div id='snackbar'></div>".$this->prdtvwer();
    $strcmr.="
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js'></script>
    <script src='http://localhost/remindo/js/comfle.js'></script>
    <script src='http://localhost/remindo/js/cmnlbxs.js'></script>
    <script src='http://localhost/remindo/stores/srcmspwres.js'></script>
    <script src='http://localhost/remindo/stores/fhdtase.js'></script>
    <div class='dvsrpts'></div>";
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
                    "Get the latest updates of your store! Eg: Total orders you need to pack." /* Optional text appearing before the prompt button */,
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
    $strcmr.="</div>";
    return $strcmr;
}
protected function strspgicns($icn){
    $icon="";
    if($icn='qr'){$icon="<svg xmlns='http://www.w3.org/2000/svg' x='0px' y='0px'
        width='16' height='16'
        viewBox='0 0 172 172'
        style=' fill:#000000;'><g fill='none' fill-rule='nonzero' stroke='none' stroke-width='1' stroke-linecap='butt' stroke-linejoin='miter' stroke-miterlimit='10' stroke-dasharray=' stroke-dashoffset='0' font-family='none' font-weight='none' font-size='none' text-anchor='none' style='mix-blend-mode: normal'><path d='M0,172v-172h172v172z' fill='none'></path><g fill='#333333'><path d='M129,25.8h17.2v17.2h-17.2zM68.8,8.6h8.6v8.6h-8.6zM77.4,17.2h17.2v8.6h-17.2zM94.6,25.8h8.6v8.6h-8.6zM94.6,8.6h8.6v8.6h-8.6zM86,34.4h8.6v8.6h-8.6zM77.4,43h8.6v8.6h-8.6zM94.6,43h8.6v8.6h-8.6zM94.6,60.2h8.6v8.6h-8.6zM86,120.4h8.6v8.6h-8.6zM77.4,129h8.6v8.6h-8.6zM68.8,137.6h8.6v8.6h-8.6zM86,137.6h8.6v8.6h-8.6zM86,154.8h8.6v8.6h-8.6zM86,68.8h8.6v51.6h-8.6zM60.2,68.8h8.6v8.6h-8.6zM43,68.8h8.6v8.6h-8.6zM25.8,68.8h8.6v8.6h-8.6zM17.2,86h8.6v8.6h-8.6zM34.4,86h8.6v8.6h-8.6zM51.6,86h8.6v8.6h-8.6zM60.2,94.6h8.6v8.6h-8.6zM68.8,103.2h8.6v8.6h-8.6zM77.4,111.8h8.6v8.6h-8.6zM68.8,120.4h8.6v8.6h-8.6zM137.6,129h8.6v8.6h-8.6zM129,137.6h8.6v8.6h-8.6zM146.2,137.6h8.6v8.6h-8.6zM146.2,154.8h8.6v8.6h-8.6zM120.4,129h8.6v8.6h-8.6zM137.6,146.2h8.6v8.6h-8.6zM94.6,146.2h34.4v8.6h-34.4zM111.8,120.4h51.6v8.6h-51.6zM25.8,94.6h8.6v8.6h-8.6zM8.6,77.4h51.6v8.6h-51.6zM154.8,68.8h8.6v8.6h-8.6zM137.6,68.8h8.6v8.6h-8.6zM120.4,68.8h8.6v8.6h-8.6zM111.8,86h8.6v8.6h-8.6zM129,86h8.6v8.6h-8.6zM146.2,86h8.6v8.6h-8.6zM154.8,94.6h8.6v8.6h-8.6zM120.4,94.6h8.6v8.6h-8.6zM94.6,103.2h8.6v8.6h-8.6zM111.8,103.2h8.6v8.6h-8.6zM129,103.2h8.6v8.6h-8.6zM137.6,111.8h8.6v8.6h-8.6zM103.2,111.8h8.6v8.6h-8.6z'></path><path d='M77.4,77.4h77.4v8.6h-77.4zM68.8,25.8h8.6v68.8h-8.6zM154.8,17.2v34.4h-34.4v-34.4h34.4M163.4,8.6h-51.6v51.6h51.6v-51.6zM25.8,25.8h17.2v17.2h-17.2z'></path><path d='M51.6,17.2v34.4h-34.4v-34.4h34.4M60.2,8.6h-51.6v51.6h51.6v-51.6zM25.8,129h17.2v17.2h-17.2z'></path><path d='M51.6,120.4v34.4h-34.4v-34.4h34.4M60.2,111.8h-51.6v51.6h51.6v-51.6z'></path></g></g></svg>";}
    return $icon;
}
protected function pmtgtwys($gtwys){
$gtws = explode(",",$gtwys);
$ptgtws="<div class='streprflonlpmtsdvbx'>";
if(in_array("Paytm",$gtws)){$ptgtws.="<svg xmlns='http://www.w3.org/2000/svg' x='0px' y='0px'width='24' height='24' viewBox='0 0 172 172'style=' fill:#000000;'><g fill='none' fill-rule='nonzero' stroke='none' stroke-width='1' stroke-linecap='butt' stroke-linejoin='miter' stroke-miterlimit='10' stroke-dasharray=' stroke-dashoffset='0' font-family='none' font-weight='none' font-size='none' text-anchor='none' style='mix-blend-mode: normal'><path d='M0,172v-172h172v172z' fill='none'></path><g><path d='M150.5,132.58333c0,9.89717 -8.0195,17.91667 -17.91667,17.91667h-93.16667c-9.89358,0 -17.91667,-8.0195 -17.91667,-17.91667v-93.16667c0,-9.89717 8.02308,-17.91667 17.91667,-17.91667h93.16667c9.89717,0 17.91667,8.0195 17.91667,17.91667z' fill='#3252df'></path><path d='M132.58333,21.5h-37.75758l-47.69058,129h85.44817c9.89717,0 17.91667,-8.0195 17.91667,-17.91667v-93.16667c0,-9.89717 -8.0195,-17.91667 -17.91667,-17.91667z' fill='#536dfe'></path><path d='M87.21833,85.53058v12.05792h-3.82342v-29.7775h10.14442c2.44742,-0.05017 4.81242,0.87792 6.56825,2.57642c1.77733,1.60175 2.78067,3.8915 2.74483,6.28517c0.05017,2.40442 -0.94958,4.71567 -2.74483,6.321c-1.77375,1.69133 -3.96317,2.537 -6.56825,2.53342l-6.321,0.00358zM87.21833,71.47675v10.39525h6.41417c1.42258,0.043 2.795,-0.516 3.784,-1.54083c2.01025,-1.95292 2.05325,-5.16717 0.10033,-7.17742c-0.03225,-0.03583 -0.06808,-0.06808 -0.10033,-0.10033c-0.97825,-1.04633 -2.35425,-1.61967 -3.784,-1.58025l-6.41417,0.00358z' fill='#ecf0f1'></path><path d='M111.66742,76.54717c2.82725,0 5.05967,0.75608 6.69367,2.26825c1.634,1.51217 2.45458,3.58333 2.451,6.2135v12.556h-3.65858v-2.82725h-0.16483c-1.58383,2.32917 -3.69083,3.49375 -6.321,3.49375c-2.24317,0 -4.12083,-0.6665 -5.633,-1.99592c-1.46917,-1.23625 -2.3005,-3.07092 -2.26825,-4.988c0,-2.107 0.7955,-3.784 2.39008,-5.031c1.59458,-1.24342 3.7195,-1.8705 6.38192,-1.8705c2.27183,0 4.14233,0.41567 5.6115,1.247v-0.87433c0.00717,-1.30792 -0.56975,-2.55133 -1.58025,-3.38625c-1.0105,-0.91375 -2.32917,-1.41183 -3.69083,-1.39392c-2.13567,0 -3.827,0.903 -5.074,2.70542l-3.36833,-2.12133c1.85617,-2.66242 4.59742,-3.99542 8.23092,-3.99542zM106.71883,91.34992c-0.00358,0.989 0.46583,1.91708 1.2685,2.494c0.84567,0.6665 1.89558,1.01767 2.97058,0.99617c1.6125,-0.00358 3.1605,-0.645 4.30358,-1.78808c1.2685,-1.19325 1.89917,-2.59075 1.89917,-4.19967c-1.19325,-0.94958 -2.85592,-1.42617 -4.988,-1.42617c-1.55517,0 -2.84875,0.37625 -3.88792,1.12517c-1.04633,0.76325 -1.56592,1.68775 -1.56592,2.79858z' fill='#ecf0f1'></path><path d='M141.814,77.21367l-12.771,29.35467h-3.94883l4.74075,-10.26983l-8.39933,-19.08125h4.15667l6.07017,14.63433h0.08242l5.90533,-14.63433h4.16383z' fill='#ecf0f1'></path><path d='M61.85908,82.92908c0,-1.16458 -0.09675,-2.32917 -0.29383,-3.47942h-16.13217v6.58975h9.23783c-0.38342,2.12492 -1.61608,4.00258 -3.41492,5.19942v4.27492h5.51475c3.22858,-2.97775 5.08833,-7.37808 5.08833,-12.58467z' fill='#4285f4'></path><path d='M45.43308,99.64533c4.61533,0 8.50325,-1.51575 11.33767,-4.128l-5.51475,-4.27492c-1.53367,1.03917 -3.51167,1.634 -5.82292,1.634c-4.46125,0 -8.24883,-3.00642 -9.60333,-7.05917h-5.67958v4.4075c2.9025,5.77275 8.81858,9.42058 15.28292,9.42058z' fill='#34a853'></path><path d='M35.82975,85.81367c-0.71667,-2.12492 -0.71667,-4.42542 0,-6.54675v-4.4075h-5.67958c-2.4295,4.83392 -2.4295,10.52783 0,15.36175z' fill='#fbbc04'></path><path d='M45.43308,72.20417c2.44025,-0.03942 4.79808,0.8815 6.56108,2.56567v0l4.8805,-4.8805c-3.096,-2.90608 -7.19892,-4.50425 -11.44517,-4.45408c-6.46792,0 -12.38042,3.64783 -15.28292,9.42417l5.67958,4.4075c1.35808,-4.05275 5.14567,-7.06275 9.60692,-7.06275z' fill='#ea4335'></path></g></g></svg>";}
if(in_array("Phone pe",$gtws)){$ptgtws.=", <img src='https://img.icons8.com/color/24/000000/phone-pe.png'/>";}
if(in_array("Google pay",$gtws)){$ptgtws.=", <img src='https://img.icons8.com/color/24/000000/paytm.png'/>";}
if(in_array("Amazon pay",$gtws)){$ptgtws.=", <svg xmlns='http://www.w3.org/2000/svg' x='0px' y='0px' width='24' height='24'viewBox='0 0 172 172'style=' fill:#000000;'><g fill='none' fill-rule='nonzero' stroke='none' stroke-width='1' stroke-linecap='butt' stroke-linejoin='miter' stroke-miterlimit='10' stroke-dasharray=' stroke-dashoffset='0' font-family='none' font-weight='none' font-size='none' text-anchor='none' style='mix-blend-mode: normal'><path d='M0,172v-172h172v172z' fill='none'></path><g fill='#e67e22'><path d='M47.68213,43l-1.12329,0.18896c-3.51525,0.44075 -6.90469,1.75578 -9.72119,3.88428c-0.62888,0.37625 -1.19266,0.88049 -1.81616,1.38574c-0.0645,-0.12362 -0.12598,-0.2543 -0.12598,-0.37793c-0.129,-0.69337 -0.19132,-1.43773 -0.31494,-2.1311c-0.18813,-1.12875 -0.81339,-1.70068 -1.94214,-1.70068h-2.94995c-1.81675,0 -2.1311,0.38398 -2.1311,2.1416v54.42187c0.0645,0.817 0.56127,1.24776 1.24927,1.31226h5.45898c0.7525,0 1.19014,-0.49526 1.24927,-1.31226c0.0645,-0.25262 0.06299,-0.50323 0.06299,-0.75586v-18.90698c0.25263,0.25262 0.44327,0.38028 0.56689,0.50391c4.5795,3.827 9.84834,5.07602 15.62109,3.94727c5.2675,-1.06425 8.90041,-4.26221 11.22241,-8.96533c1.81675,-3.57437 2.56001,-7.20879 2.62451,-11.15942c0.12363,-4.32688 -0.25136,-8.49191 -2.06811,-12.56616c-2.13388,-5.01487 -5.76679,-8.34049 -11.22241,-9.46924c-0.817,-0.18813 -1.69203,-0.2543 -2.50903,-0.37793c-0.7525,-0.0645 -1.4431,-0.06299 -2.1311,-0.06299zM89.45386,43c-0.25262,0.0645 -0.49274,0.12598 -0.74536,0.12598c-2.51013,0.12362 -4.96087,0.4368 -7.40112,1.0603c-1.5695,0.37625 -3.07215,0.93836 -4.57715,1.43823c-0.94062,0.31175 -1.38574,1.00538 -1.38574,2.00513c0.0645,0.817 0,1.69203 0,2.50903c0.0645,1.25238 0.57042,1.57689 1.76367,1.25977c2.00487,-0.49988 4.01051,-1.06198 6.01538,-1.43823c3.13363,-0.56437 6.3341,-0.81868 9.53222,-0.37793c1.69312,0.31175 3.26095,0.75359 4.3252,2.19409c0.94062,1.19325 1.32124,2.69422 1.38574,4.19922c0.0645,2.13388 0.06299,3.82389 0.06299,5.95239c0,0.12363 0.00151,0.24532 -0.06299,0.30445h-0.31494c-2.69825,-0.688 -5.4521,-1.06114 -8.20947,-1.24927c-2.88638,-0.12362 -5.76704,0.00269 -8.52442,1.00781c-3.32175,1.12875 -6.02596,3.13068 -7.59009,6.39331c-1.19325,2.51013 -1.38406,5.14917 -1.00781,7.84204c0.56437,3.63887 2.32385,6.39423 5.52197,8.14648c3.0745,1.69312 6.33494,1.87512 9.72119,1.37524c3.88612,-0.56437 7.33058,-2.193 10.34058,-4.70312c0.12363,-0.12363 0.25431,-0.18082 0.37793,-0.30445c0.18812,1.00513 0.31578,1.94785 0.50391,2.82398c0.12363,0.817 0.63324,1.31074 1.38574,1.37524h4.19922c0.62887,0 1.19678,-0.56127 1.19678,-1.24927c0.0645,-0.18812 0.06298,-0.44562 0.06298,-0.69287v-26.75952c-0.01612,-1.06963 -0.08482,-2.20064 -0.27295,-3.26489c-0.49988,-3.32175 -1.88209,-6.08442 -4.89209,-7.84204c-1.69313,-1.00513 -3.56959,-1.50441 -5.57446,-1.81616c-0.94063,-0.129 -1.82036,-0.19132 -2.76099,-0.31494zM111.19531,43.0105c-0.62888,0 -0.94247,0.5574 -0.81885,1.18628c0.12363,0.50525 0.31578,1.07483 0.50391,1.57471c5.01488,12.41625 10.0903,24.82418 15.16968,37.29956c0.44075,1.06425 0.49988,1.94869 0,3.01294c-0.81163,1.87588 -1.50693,3.81919 -2.38306,5.70044c-0.75249,1.69313 -2.00303,2.95398 -3.88428,3.45386c-1.25238,0.31713 -2.63039,0.44008 -3.94727,0.25195c-0.62888,-0.0645 -1.26077,-0.18745 -1.88965,-0.25195c-0.8815,-0.0645 -1.31075,0.30864 -1.37525,1.24927v2.51953c0.0645,1.44588 0.50164,2.06744 1.94214,2.32006c1.38137,0.24725 2.82019,0.42891 4.32519,0.49341c4.386,0.05912 7.84162,-1.68447 10.09912,-5.51147c0.94063,-1.505 1.69506,-3.0745 2.38306,-4.70312c6.07913,-15.36175 12.09962,-30.66018 18.11962,-46.08643c0.18813,-0.44075 0.30293,-0.88587 0.36744,-1.38574c0.12363,-0.7525 -0.2517,-1.12354 -0.93433,-1.11279h-5.07056c-0.87613,-0.0645 -1.69338,0.49526 -2.00513,1.31226c-0.12363,0.37625 -0.2543,0.68405 -0.37793,1.0603l-8.96533,25.64673c-0.62887,1.81675 -1.32376,3.69557 -1.95264,5.70044c-0.129,-0.31713 -0.18745,-0.44176 -0.25195,-0.62989c-3.32175,-9.15363 -6.57791,-18.29877 -9.89966,-27.45239c-0.49988,-1.505 -1.06282,-2.95818 -1.6272,-4.39868c-0.24725,-0.69337 -0.8207,-1.18628 -1.6377,-1.18628c-1.94575,-0.0645 -3.88453,-0.06299 -5.8894,-0.06299zM47.61914,49.51929c3.827,0.31175 6.95878,2.19476 8.5874,6.64527c1.00512,2.75737 1.25977,5.41758 1.25977,8.30396c0,2.69825 -0.18569,5.08383 -0.99732,7.65308c-1.75762,5.45562 -5.77409,7.58538 -10.91797,7.33813c-3.63887,-0.18812 -6.70884,-1.57496 -9.59522,-3.57983c-0.31175,-0.18813 -0.50004,-0.49123 -0.44092,-0.80835v-21.29004c-0.05913,-0.37625 0.12917,-0.68321 0.44092,-0.87134c3.50988,-2.44562 7.39558,-3.70262 11.66333,-3.39087zM88.29907,66.45264c1.07366,-0.09406 2.15597,-0.07382 3.2229,0.05249c2.13388,0.18812 4.26993,0.55959 6.40381,0.87134c0.44075,0.0645 0.5564,0.25364 0.5564,0.62989c-0.0645,1.25775 0,2.44806 0,3.70581c0,1.25238 -0.06299,2.38507 -0.06299,3.64282c0.0645,0.31175 -0.12531,0.55724 -0.37793,0.74536c-2.88638,2.06937 -6.02084,3.45554 -9.59521,3.83179c-1.4405,0.12363 -2.88621,0.12345 -4.26221,-0.44092c-1.5695,-0.56437 -2.75066,-1.88436 -3.19141,-3.45386c-0.49988,-1.62862 -0.49836,-3.32108 -0.06298,-4.95508c0.688,-2.13387 2.18897,-3.31687 4.19922,-4.01025c1.03469,-0.31444 2.09675,-0.52533 3.17041,-0.61939zM156.09546,107.5105c-5.01689,0.06987 -10.93863,1.19376 -15.43213,4.34619c-1.38675,0.96213 -1.1437,2.29798 0.39893,2.1206c5.0525,-0.60737 16.29834,-1.97086 18.30859,0.59839c2.01563,2.56925 -2.22886,13.16892 -4.10474,17.90967c-0.5805,1.41362 0.64676,1.99882 1.94214,0.92382c8.4065,-7.04125 10.59085,-21.80192 8.87085,-23.92504c-0.86269,-1.06156 -4.96675,-2.04351 -9.98364,-1.97364zM6.54028,112.8855c-1.17209,0.16125 -1.67692,1.64685 -0.45142,2.82398c21.05388,19.74775 48.87403,29.41553 79.76416,29.41553c22.03213,0 47.60948,-7.18864 65.26636,-20.73364c2.91862,-2.25213 0.43235,-5.6267 -2.56152,-4.2937c-19.79612,8.73438 -41.2973,12.94409 -60.86768,12.94409c-29.0035,0 -57.0809,-6.05519 -79.79565,-19.80982c-0.49719,-0.301 -0.96355,-0.40018 -1.35425,-0.34643z'></path></g></g></svg>";}
if(in_array("Mobikwik",$gtws)){$ptgtws.=", <img src='http://localhost/remindo/includes/fn_img/mbkwk.jpg' style='height:16px;'>";}
$ptgtws.="</div>";
return $ptgtws;
}
protected function prdtvwer(){
    $pdtdsply="<div class='cmn-lbx-bckgrond-cntngdvbx'>
    <div class='cmn-lbx-pdt-dsplyr-cntngdvbx'>
        <div class='lbx-dsplyr-tphdr-ctngdvbx' data-adpdck data-pd>
            <div class='lbx-dsplr-bckbtn-dvbx'><i class='fas fa-chevron-left remindosymbols'></i>Back</div>";
            // $pdtdsply.="<div class='lbx-dsplr-nxpvbtns-dvbx'>
                // <div class='lbxblftsbns lbx-dsplr-pewpdt-vwbtn'><i class='fas fa-chevron-left remindosymbols'></i>prev</div>
                // <div class='lbxblftsbns lbx-dsplr-nxtpdt-vwbtn'>next<i class='fas fa-chevron-right remindosymbols'></i></div>
            // </div>";
        $pdtdsply.="</div>
        <div class='lbx-cmsrsr-dlsdvbx-mrgnr'>
            <div class='lbx-csmrorstr-dtls-dsply-cntngdvbx'>
                <div class='lbx-cmsrsr-pflpc-dsply'></div>
                <div class='lbx-cmrsr-pfldls'>
                    <strong><div class='lbx-srctgredsply'>Customer</div></strong>
                    <div class='srcmrtxtdls'></div>
                    <div class='lbx-srcmr-pfunm'></div>
                </div>
            </div>
        </div>
        <div class='lbx-dsplyr-bdy-cntngdvbx'>
        <div class='lbx-pcs-and-pdtimdls-cntng-dvbx'>
        <div class='lbx-onypcs-dsply-cntng-dvbx'>
        <div class='lbx-dsplr-igvwrdvbx'>
            <div class='lbx-igsld-shw-dsplr-dbx'>
                <div class='lbx-sldshw-fwbw-bns-dvbx'>
                    <div class='lxslshwchvrnbtn lbx-sldshw-pew-chrvn-btn'><i class='fas fa-chevron-left remindosymbols'></i></div>
                    <div class='lxslshwchvrnbtn lbx-sldshw-nt-chrvn-btn'><i class='fas fa-chevron-right remindosymbols'></i></div>
                </div>
                <div class='lbx-sld-shw-dsply-dvbx'>
                    <div class='lbx-lrgdsplyprvig-tg'></div>
                </div>
            </div>
            <div class='lbx-igpcs-mrgn-dvbx'>
            <div class='lbx-igpcs-rltdtosldshw-dsplr-dbx' data-pigs=''>
                <div class='lbx-iothpcs-rltosldsh-pxs lbx-pt-pvigs'></div>
                <div class='lbx-iothpcs-rltosldsh-pxs lbx-pt-pvigs'></div>
                <div class='lbx-iothpcs-rltosldsh-pxs lbx-pt-pvigs'></div>
                <div class='lbx-iothpcs-rltosldsh-pxs lbx-pt-pvigs'></div>
            </div>
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
                <strong class='subsrngfntsz'>Variants</strong>
                <div><div class='lbx-pdt-szedsplydvbx'>
                    <div class='lbx-szes-slctn-dsply' data-aszs='' data-aspce='' data-tslds=''></div>
                </div>
                <div class='lbx-ptszes-cotmnrtngdvbx'><span class='lbx-alszes-mnrtd-spn '></span></div></div>
            </div>
            <div class='lbx-pdt-ftres-dsplydvbx-edtstoo'>
                <strong class='subsrngfntsz'>features</strong>
                <div><div class='lbx-pdt-fchrswrtn-dvbx' data-phdr='Product features'></div></div>
            </div>
        </div>
        </div>
        <div class='lbx-pdt-prcmthme-dvbx-mrgn'>
        <div class='lbx-pdt-prcmchme-dsplybx'>
            <div class='lbxpthlfcmncls lbx-pdt-prccntngbx'><strong>Price: </strong><span class='lbx-pdtprce-dsply'></span>₹</div>
        </div>
        </div>
        <div class='lbx-pdt-dscrptn-mrgn'>
        <div class='lbx-pdt-dscrptn-dsply-bx'>
        <strong>More about this:</strong>
        <div><div class='lbx-pdtmr-dls-dsplybx'></div>
        <div class='lbx-mbtns-cotmnrtngdvbx'><span class='lbx-alwdsmbths-mnrtd-spn lbx-dvedbl-mntrng-spntgs'></span></div></div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
    </div>
    </div>
    </div>";
    return $pdtdsply;
}
}
// if(!isset($_SESSION['usrml'])){
//     header("Location: store.php");
// }
?>
<!-- <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAAD8UlEQVRIiZWVbUyVZRjHf/dznsM5eQ4QiK9NBSJfgoHFTD2KogIpSBR1SsTsQ0a2pVul+aHmmltt1dbcmmv2Io1Fs0nGiKJmbllJ05Q5F4F6REGjZsSAI4fDeXmuPiDMc55zUv/b8+W6rvv/u6/77VHEUH5+jXXKrKHdNpvtMRGZqlBJgoSU0Kc0FRARHSENpRIQGdY0dS0QDB0zRni1paV+6GYvPRYgbebQzmlpaTs2Vz9l13XLeNgGOGKU2wyR1MONzRmXu3scwNOxPCNU4d58/Jvvjsid6FTbGVlfWf13tJcWh5GgW2I2F1e6riMijsLyqrRbAkRIuCP3G1Kactgt4ikpd2f8LwDFjHgm14PxAU6HQ61YtsRh1fXX4wLKyjamiGGkRccBOvphz0k4dS0+JDMjXdd1fXpcQEAL1djtNomOewahrhMWTYOmLjjbZzYXEb5oaPRfH/HXjseid1LZrNaXU1NSTOAeLyxIBXcWLJ8BCZboChj2+cQIS/3R5kMNMTsoLnXnGSIpm6qeYGFeTsTg+SnQ2Q+tf8F0B0y2x+wg5Bvo3XpzLAIgUJybsyC43LWYX1pP8OSmLTzz3Iuc+K2NmQ54NhuOXoFP2iFkmAGAxeqcuiUuYJLDVrF4Uf6kxq9bqD/4Jbte2Y67soK33tlLIBDk3mTY+SD4QvBTr9ndbrNrCVZ975pSd3FMQFZm5vWkRCcff1rPnt27yH8gl8ICFyN+P+29Xho8Y2s/5S4YGDUDrFadgmVLUMpYGRPw0rat/+zbX8v2F7aQvWAe4XCYt997n7zcbObek4pnEF77Ff7oB1eMmyIinDzVZiilnR6PRZyiDz6qfWRhbjYlRYUAHKj7nKt/9rL33TdxWMeWp64D3PeB02oGDPt8Eg5L05HmQ1+ZkmUVG1xlldXS92+/iIhcvHRZ1j1aJR3nLtzWY3fm7O9SWrkxkJ9fE4Ge6GBSovONVSuWMTk1BYCW749SWOBi/tws81TjSIH39OkPIx4TDaDQ7XZ6vd7V60pWTyQudl0mJ3u+yWRwyIuI6aKPSTAlNADLMEsTnU4jfc7sm6ajGBnxm8w3bK5h3/4Dt92VBqA05mVmzImgZ2Wm03WpO6I4KdFJ2doiVha4TEaGYYDCdP3GAEJqcnJSxJEtXVvEsZ9bGRzyAjDi9+O5eImHi1Zht9m44Oma+DrPezjc9G1QU9rxaMCNTZbRYDAUkUifPQvX0ofo7rlCbs79HPnhR2o/OziRHx0dRQS/UhhKaWFds7T6guGId2hCxaWPVz2/bUfgTv7B6yurR9eUVy6KaRjdQRhpvTs5uQcYuNWAcWWkz044337u6q3q/gNz0OaXE3Y2YgAAAABJRU5ErkJggg=='/> -->