<?php
include '../db_conn.php';
session_start();
class lgout extends dbconnect{
    public function lgotusr(){
        $sts="";$ugdae=htmlentities($_SESSION['usrml']);$urdi=htmlentities($_SESSION['ssndi']);
        if(isset($_COOKIE['_ugdae'])&&isset($_COOKIE['_urdi_'])&&isset($_SESSION['usrml'])&&isset($_SESSION['ssndi'])){
            setcookie('_ugdae',$ugdae,time()-8600,'/');
            setcookie('_urdi_',$urdi,time()-8600,'/');
            session_destroy();
            return "done";
        }elseif(isset($_SESSION['usrml'])&&isset($_SESSION['ssndi'])){
            session_destroy();
            return "done";
        }
        return;
    }
}
$lgt=new lgout();
if(isset($_GET['usrlgoot'])){
    $check=htmlentities($_GET['usrlgoot']);
    if($check=="trelgot"){echo $lgt->lgotusr();}
}
?>