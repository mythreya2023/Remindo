<?php
session_start();
include '../db_conn.php';
class c extends dbconnect{
    public function img($newName,$tmp,$path,$typ){
        $userloginid=htmlentities($_SESSION['ssndi']);
        $nm=$this->enc($newName,$this->iky,'mtr');
        $sql_update_img="UPDATE roupldls SET ruspig='$nm' WHERE usid='$userloginid';";
        $query_update_img=$this->connect()->query($sql_update_img);
        if($query_update_img){
            if($typ=="rmv"){
                echo $newName;
            }else{
                if(!file_exists($path)){if(move_uploaded_file($tmp,$path)){echo $newName;}}
            }
        }
    }
}
$c=new c();
$userloginid=$_SESSION['ssndi'];
if(isset($_POST['prigtcg'])&&$_POST['prigtcg'] != "pflmgs/defa.png"){
    $usrprvImg=htmlentities(mysqli_real_escape_string($conn,$_POST['prigtcg']));
    if(file_exists("../".$usrprvImg)){unlink("../".$usrprvImg);}
    if(isset($_POST['rvpfpc'])&&$_POST['rvpfpc']='rmvpctre'){
        $c->img("defa.png","","","rmv");
    }
}
if(isset($_FILES['file']['name'])&&$_FILES['file']['name']!=""){
    $fileName=$_FILES['file']['name'];
    $extension= pathinfo($fileName,PATHINFO_EXTENSION);
    $file_removed_ext=pathinfo($fileName,PATHINFO_FILENAME);
    $valid_Ext = array("jpg","jpeg","png");
        if(in_array($extension,$valid_Ext)){
            $newName=substr($file_removed_ext,0,rand(0,strlen($file_removed_ext))).rand()."."."jpg";
            $path="../pflmgs/".$newName;
            $c->img($newName,$_FILES['file']['tmp_name'],$path,""); 
        }
        else{
            echo "e1";
        }
    }else{
        echo "e0";  
    }
?>