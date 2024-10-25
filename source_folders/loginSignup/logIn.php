<?php
include 'db_conn.php';
class lgn extends dbconnect{
    public function login($email,$passw,$sndmail,$adcke){
    $conn=$this->connect();
    $newmsg="";$verified=true;
    $adcke=mysqli_real_escape_string($conn,$adcke);
    $Email=mysqli_real_escape_string($conn,$email);
    if(!empty($passw)){
        $pass=mysqli_real_escape_string($conn,$passw);
        if(empty($Email)||empty($pass)){
            $newmsg="Please Fill All The Fields!";
        }
    }
    if(empty($Email)){
        $newmsg="Please Fill All The Fields!";
    }
    else{
        $currenttime=time();
        $email=$this->enc($Email,$this->iky,'idx');
        $sql="SELECT rusacpd,usid,ructmnzn,rusts,rujtm FROM roupldls WHERE usml='$email';";
        $result=$conn->query($sql);
        if($result){
        if($result->num_rows>0){
            $row=$result->fetch_assoc();
            $userID=$row['usid'];
                 $status=$this->dec($row['rusts'],$this->iky);
            if($status=="verified"){
                $online=$row['rujtm'];
                if($online<$currenttime){
                    $hpwd=$row['rusacpd'];
                    $id=$row['usid'];
                    $tmz=$row['ructmnzn'];
                    if(password_verify($pass,$hpwd)){
                        if($adcke=='rmbrcke'){
                        $idtz=$this->enc($userID,$this->iky,'mtr');
                        if(!isset($_COOKIE['_urdi_'])&&!isset($_COOKIE['_ugdae'])){
                        setcookie("_urdi_", $idtz, time() + (3600 * 24 * 365 ), "/"); 
                        setcookie("_ugdae", $email, time() + (3600 * 24 * 365 ), "/"); }
                        }
                        if(!isset($_COOKIE['_utg_'])){
                        setcookie("_utg_", $tmz, time() + (2*3600 * 24 * 365 ), "/");
                        }
                        session_start();
                        $_SESSION['ssndi']=$id;
                        $_SESSION['usrml']=$Email;
                        header("Location: home");
                    }
                    else{
                    $newmsg="Invalid email or password!";
                    }
                }
            }else{
                $newmsg="Account not verified!";
                $verified=false;
                if($sndmail){
                    $token=bin2hex(random_bytes(15));
                    $updatesql="UPDATE roupldls SET token='$token' WHERE usid='$userID';";
                    $queryUpdate=$conn->query($updatesql);
                    if($queryUpdate){
                    //--------------- sending email------------------
                    $token=$this->enc($token,$this->iky,'mtr');
                    $userID=$this->enc($userID,$this->iky,'mtr');
                    $to_email="$Email";
                    $subject="Account Verification.";

                    $header ="From: Remindo <notify@remindo.in>\r\n";
                    $header .="MIME-Version: 1.0\r\n";
                    $header .="Content-Type: text/html; charset=ISO-8859-1\r\n";

                    $body="<html>
                    <body>
                    <center>
                    <h1>Hi! $first_name Welcome to Remindo.</h1>
                    <h3>Click here to verify your account.</h3></br>
                    <h4>https://remindo.in/Accounts/activateaccount.php?u=$userID&token=$token</h4>
                    </center>
                    </body>
                    </html>";
                    
                    if(mail($to_email,$subject,$body,$header)){
                        echo "Email successfully sent to $to_email";
                        session_start();
                        $_SESSION['msg']="Email sent successfully!";
                        header("Location: signin");
                    }else{
                        $newmsg= "Email sending failed.";
                    }

                    }
                    //--------------- end of sending email----------------
                }
            }
        
        }
        else{
            $newmsg="Invalid email or password!";
        }
        }
        else{
            $newmsg="Failed to login.";
        }
        }
        return array("nwmsg"=>$newmsg,"vrf"=>$verified);
    }
}
?>