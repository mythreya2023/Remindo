<?php
session_start();
    include '../db_conn.php';
class av extends dbconnect{
    public function du($u){
        return $this->dec($u,$this->iky);
    }
    public function eu($u,$tp){
        return $this->enc($u,$this->iky,$tp);
    }
}
$av=new av();
    if(isset($_GET['u'])&&isset($_GET['token'])){
        $user=$av->du($_GET['u']);
        $checkToken=$av->du($_GET['token']);

        $sqlCheck="SELECT usid,token FROM roupldls WHERE usid='$user';";
        $queryVerify=mysqli_query($conn,$sqlCheck);
        if($queryVerify){
            if(mysqli_num_rows($queryVerify)>0){
                $row=mysqli_fetch_assoc($queryVerify);
                if($row['token']==$checkToken){
                $verified=$av->eu("verified",'mtr');
                $update="UPDATE roupldls SET rusts='$verified' WHERE usid='$user' AND token='$checkToken';";
                $queryupdate=mysqli_query($conn,$update);
                if($queryupdate){
                    if(isset($_SESSION['msg'])){
                        $_SESSION['msg']='Your Account has verified! You can login now.';
                    }
                }
                header("Location: ../signin");
                }else{
                    $_SESSION['msg']= "Please reverify your account!";
                    header("Location: ../signin");
                }
            }else{
                $_SESSION['msg']= "Sorry! You don't have an account";
                header("Location: ../signin");
            }
        }else{
            $_SESSION['msg']= "Error Occured!";
                header("Location: ../signin");
        }

    }


?>