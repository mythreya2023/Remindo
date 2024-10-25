<?php
session_start();
include '../db_conn.php';
class strpics {
    public function strpcs($strnum,$newName,$tmp,$uod,$type){
        // $userloginid=$_SESSION['ssndi'];
        // $nm=$this->enc($newName,$this->iky,'mtr');
        $uptyp="";$path="";
        if($type=="bsnstrcvpc"){$uptyp="strcvrpto";$path="../fhstsbsncvpcs/".$newName;;}
        if($type=="bnstrpfpt"){$uptyp="strbprflig";$path="../qrstsbprfpcs/".$newName;}
        if($type=="upptpc"){$uptyp="strbupimg";$path="../fhupuppts/".$newName;}
        // $sql_update_img="UPDATE stsinmtplc SET $uptyp='$nm' WHERE stnmr ='$strid';";
        // $query_update_img=$this->connect()->query($sql_update_img);
        // if($query_update_img){
        //     if($uod=="rmv"){
        //         echo $newName;
        //     }else{
                if(move_uploaded_file($tmp,$path)){echo $newName;}
        //     }
        // }
    }
}
$c=new strpics();
$strid="";$tp="";
if(isset($_POST['prigtcg'])){
$usrprvImg=htmlentities($_POST['prigtcg']);
if($_POST['prigtcg']!=""){unlink("../".$usrprvImg);}
if(isset($_POST['ptp'])){
    if($_POST['ptp']=='bnstrcvpt'){$tp="bsnstrcvpc";}
    elseif($_POST['ptp']=='bnstrpfpt'){$tp="bnstrpfpt";}
    elseif($_POST['ptp']=='bnstrppt'){$tp="upptpc";}
    if($_POST['ptp']=='rmvbncv'){$c->strpcs("","","","rmv","bsnstrcvpc");}
    elseif($_POST['ptp']=='rmvbnpfpc'){$c->strpcs("","","","rmv","bsnstrpc");}
    elseif($_POST['ptp']=='rmvbnuppc'){$c->strpcs("","","","rmv","upptpc");}
}
}
if(isset($_POST['p'])){
   echo $_FILES['file']['name']=$_POST['p'];
// if(isset($_FILES['file']['name'])&&$_FILES['file']['name']!=""){
echo $tp;

    $fileName=$_FILES['file']['name'];
    $extension= pathinfo($fileName,PATHINFO_EXTENSION);
    $file_removed_ext=pathinfo($fileName,PATHINFO_FILENAME);
    $valid_Ext = array("jpg","jpeg","png");
        if(in_array($extension,$valid_Ext)){
            echo $newName=(substr($file_removed_ext,0,rand(0,strlen($file_removed_ext))).rand()."."."jpg");
            //  $c->strpcs($strid,$newName,$_FILES['file']['tmp_name'],"",$tp);
        }
        else{
            echo "e1";
        }
}else{
    echo "e0";  
}
?>