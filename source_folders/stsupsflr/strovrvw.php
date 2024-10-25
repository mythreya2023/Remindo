<?php
include '../db_conn.php';
session_start();
class anlysovrcw extends dbconnect{
    private function fthstrovrwrslts($str){
        $conn=$this->connect();
        $str=$this->dec(htmlentities(mysqli_real_escape_string($conn,$str)),$this->strec);
        $sql="SELECT stnmr,strigtdt1,strigtdt2,strodrs1,strodrs2,strtrvnu1,strtrvnu2,strtpdsld1,strtpdsld2 FROM stsinmtplc WHERE stnmr='$str' LIMIT 1;";
        $query=$conn->query($sql);
        if($query){if($query->num_rows>0){return $query->fetch_assoc();}else{return 0;}}else{return 'q0';}
    }
    private function ttlcmrspds($str){
        $conn=$this->connect();$tpds=0;$tcmrs=0;$todrs=0;
        $str=$this->enc($this->dec(htmlentities(mysqli_real_escape_string($conn,$str)),$this->strec),$this->strec,'strix');
        $sql="SELECT COUNT(strspdtnum) AS tpds FROM prdcsinstr WHERE strnmr='$str';";
        $query=$conn->query($sql);
        if($query){if($query->num_rows>0){$tpds=$query->fetch_assoc()["tpds"];}else{$tpds=0;}}else{$tpds='q0';}
        $sql="SELECT COUNT(stsrnum) AS tcmrs FROM stspdbycstms WHERE stsnm='$str';";
        $query=$conn->query($sql);
        if($query){if($query->num_rows>0){$tcmrs=$query->fetch_assoc()["tcmrs"];}else{$tcmrs=0;}}else{$tcmrs='q0';}
        $pcrs2="Rmc9PTo6MTIzMjU2NzM5MTA0MTEyMQ==";
        $pckodr1="RlE9PTo6MTIzMjU2NzM5MTA0MTEyMQ==";
        $sql="SELECT COUNT(odrmrnmr) AS todrs FROM pplstsodrmrrs WHERE odrstnmr='$str' AND (odrsts='$pckodr1' OR odrsts='$pcrs2') ;";
        $query=$conn->query($sql);
        if($query){if($query->num_rows>0){$todrs=$query->fetch_assoc()["todrs"];}else{$todrs=0;}}else{$tcmrs='q0';}
        return [$tpds,$tcmrs,$todrs];
    }
    public function strovwr($str){
    $pnspds=$this->ttlcmrspds($str);
    echo "<div class='rmoalcmrsovrvwcntngdvbx'>";
    if($pnspds[0]!="q0"){echo "<div class='rmotovrognldvbx'>
            <h3 class='rmoovervwtph3'><i class='fas fa-thumbtack remindosymbols' style='transform: rotate(45deg);'></i> Customers</h3>
            <div class='rmotlovrigtsnmrdvbx'>$pnspds[1]</div>
        </div>";}
    if($pnspds[1]!="q0"){echo "<div class='rmotovrognldvbx'>
            <h3 class='rmoovervwtph3'><i class='fas fa-box remindosymbols'></i> Products</h3>
            <div class='rmotlovrigtsnmrdvbx'>$pnspds[0]</div>
        </div>";}
    if($pnspds[2]!="q0"){echo "<div class='rmotovrognldvbx'>
            <h3 class='rmoovervwtph3'><i class='fas fa-shopping-basket remindosymbols'></i> Orders to pack</h3>
            <div class='rmotlovrigtsnmrdvbx'>$pnspds[2]</div>
        </div>";}
    echo "</div>";
    $strovrw=$this->fthstrovrwrslts($str);
    if($strovrw!="q0"){if($strovrw!="0"){
        $d1=$this->dec($strovrw['strigtdt1'],$this->strec);
        $d2=$this->dec($strovrw['strigtdt2'],$this->strec);
        $o1=$this->dec($strovrw['strodrs1'],$this->strec);$o1=$o1!=""?$o1:0;
        $o2=$this->dec($strovrw['strodrs2'],$this->strec);$o2=$o2!=""?$o2:0;
        $r1=$this->dec($strovrw['strtrvnu1'],$this->strec);$r1=$r1!=""?$r1:0;
        $r2=$this->dec($strovrw['strtrvnu2'],$this->strec);$r2=$r2!=""?$r2:0;
        $p1=$this->dec($strovrw['strtpdsld1'],$this->strec);$p1=$p1!=""?$p1:0;
        $p2=$this->dec($strovrw['strtpdsld2'],$this->strec);$p2=$p2!=""?$p2:0;
        date_default_timezone_set("Asia/kolkata");
        $ydt=date("d-m-Y",strtotime("-1 days"));
        $date=date("d-m-Y");$tdo=0;$rdo=0;$pdo=0;$tdy="Today's";$lstdy="Yesterday's";
        if($date==$d1){$tdo=$o1;$rdo=$r1;$pdo=$p1;$o2=$o2;$r2=$r2;$p2=$p2;$tdy="Today's";
            $lstdy=$ydt==$d2?"Yesterday's":$this->timefrendly($d2,"");}
        elseif($date==$d2){$tdo=$o2;$rdo=$r2;$pdo=$p2;$o2=$o1;$r2=$r1;$p2=$p1;$tdy="Today's";
        $lstdy=$ydt==$d1?"Yesterday's":$this->timefrendly($d1,"");
        }
        elseif($ydt==$d1&&$date!=$d1&&$date!=$d2){
            $tdo=$o1;$rdo=$r1;$pdo=$p1;$o2=$o2;$r2=$r2;$p2=$p2;$tdy="Yesterday's";
            $lstdy=$this->timefrendly($d1,"");
        }
        elseif($ydt==$d2&&$date!=$d1&&$date!=$d2){
            $tdo=$o2;$rdo=$r2;$pdo=$p2;$o2=$o1;$r2=$r1;$p2=$p1;$tdy="Yesterday's";
            $lstdy=$this->timefrendly($d1,"");
        }elseif($ydt!=$d1&&$ydt!=$d2&&$date!=$d1&&$date!=$d2){
            $tdo=$o1;$rdo=$r1;$pdo=$p1;$o2=$o2;$r2=$r2;$p2=$p2;$tdy=$this->timefrendly($d1,"");;
            $lstdy=$this->timefrendly($d2,"");}
    if($date!=$d1&&$date!=$d2){echo "<h2>Today's</h2>
    <div class='rmoalcmrsovrvwcntngdvbx'>
        <div class='rmotovrognldvbx'>
            <h3 class='rmoovervwtph3'><i class='fas fa-shopping-basket remindosymbols'></i> Orders</h3>
            <div class='rmotlovrigtsnmrdvbx'>0</div>
        </div>
        <div class='rmotovrognldvbx'>
            <h3 class='rmoovervwtph3'><i class='fas fa-rupee-sign remindosymbols'></i> Revenue</h3>
            <div class='rmotlovrigtsnmrdvbx'>0 /-</div>
        </div>
        <div class='rmotovrognldvbx'>
            <h3 class='rmoovervwtph3'><i class='fas fa-box remindosymbols'></i> Products Sold</h3>
            <div class='rmotlovrigtsnmrdvbx'>0</div>
        </div>
    </div>";}
    if($d1!=""||$d2!=""){
    echo "<h2>$tdy</h2>
    <div class='rmoalcmrsovrvwcntngdvbx'>
        <div class='rmotovrognldvbx'>
            <h3 class='rmoovervwtph3'><i class='fas fa-shopping-basket remindosymbols'></i> Orders</h3>
            <div class='rmotlovrigtsnmrdvbx'>$tdo</div>
        </div>
        <div class='rmotovrognldvbx'>
            <h3 class='rmoovervwtph3'><i class='fas fa-rupee-sign remindosymbols'></i> Revenue</h3>
            <div class='rmotlovrigtsnmrdvbx'>$rdo /-</div>
        </div>
        <div class='rmotovrognldvbx'>
            <h3 class='rmoovervwtph3'><i class='fas fa-box remindosymbols'></i> Products Sold</h3>
            <div class='rmotlovrigtsnmrdvbx'>$pdo</div>
        </div>
    </div>";    
    if(($o2!=0&&$r2!=0&&$p2!=0)){
    echo "<h2>$lstdy</h2>
    <div class='rmoalcmrsovrvwcntngdvbx'>
        <div class='rmotovrognldvbx'>
            <h3 class='rmoovervwtph3'><i class='fas fa-shopping-basket remindosymbols'></i> Orders</h3>
            <div class='rmotlovrigtsnmrdvbx'>$o2</div>
        </div>
        <div class='rmotovrognldvbx'>
            <h3 class='rmoovervwtph3'><i class='fas fa-rupee-sign remindosymbols'></i> Revenue</h3>
            <div class='rmotlovrigtsnmrdvbx'>$r2 /-</div>
        </div>
        <div class='rmotovrognldvbx'>
            <h3 class='rmoovervwtph3'>Products</h3>
            <div class='rmotlovrigtsnmrdvbx'>$p2</div>
        </div>
    </div>";
    }}
    }}
    else{echo "<center style='margin-top:100px;'><h3 style='color:gray; margin-bottom:5px;'>Oops! Something went wrong.</h3><div style='color:darkslategray;'>Sorry! Failed to load data. Try again later.</div></center>";}
    }
}
// sleep(0);
$ovw=new anlysovrcw();
if(isset($_GET['fchstrovrew'])&&$_GET['fchstrovrew']=="trefhsrovrw"&&isset($_GET['s'])){echo $ovw->strovwr($_GET['s']);}
?>