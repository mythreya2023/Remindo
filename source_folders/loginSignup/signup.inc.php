<?php    
session_start();
include '../db_conn.php';
class sgnupp extends dbconnect{
public function sgnupfun($nme,$mail,$ucntry,$ugndr,$pwd,$cpwd,$tmzn,$bdt,$bmth,$byr){
    $conn=$this->connect();
    $f_name=strtolower(mysqli_real_escape_string($conn,$nme));
    $Email=strtolower(mysqli_real_escape_string($conn,$mail));
    $country=strtolower(mysqli_real_escape_string($conn,$ucntry));
    $gender=strtolower(mysqli_real_escape_string($conn,$ugndr));
    $pass=mysqli_real_escape_string($conn,$pwd);
    $cpass=mysqli_real_escape_string($conn,$cpwd);
    $country_time=strtolower(mysqli_real_escape_string($conn,$tmzn));
    $dateofbirth=strtolower(mysqli_real_escape_string($conn,$bdt));
    $monthofbirth=strtolower(mysqli_real_escape_string($conn,$bmth));
    $yearofbirth=strtolower(mysqli_real_escape_string($conn,$byr));
    $status="nonverified";
    $nwegid=sprintf('%05d',rand(0,999999));
    $username= substr(strtolower($f_name.".".$nwegid),0,20);
    $user_date_of_birth=$dateofbirth."-".$monthofbirth."-".$yearofbirth;
    $token=bin2hex(random_bytes(15));
    $emal=$Email;
    
    if(empty($f_name)||empty($Email)||empty($pass)||empty($cpass)){
        echo "Please fill all the details!";
     }
     elseif(strlen($f_name)>20){
         echo "Your full name exceeded the limit 20 characters.";
     }
     elseif($country=="--Select Country--"){
         echo "Please select your Country!";    
    }
    else if($gender=="--Select Gender--"){
        echo "Please select your Gender!";    
    }else if(date("Y")-$yearofbirth<13){
        echo "You are ineligible to use remindo.";
    }
     else if(!filter_var($Email,FILTER_VALIDATE_EMAIL)){
         echo "Invalid Email Adderss";
     }
     else if(strlen($pass)<8||strlen($pass)>32){
         echo "Password should contain between 8-32 chraracters long!";
      }
     else if($pass=="password"||$pass=="Password"){
    echo "Password cannot be used as password";
    }
     else if($pass!=$cpass){
        echo "Password Missmatched!";
     }
     else{
            $vrfEmaill=$this->enc($Email,$this->iky,'idx');
            $sqle="SELECT usml FROM roupldls WHERE usml='$vrfEmaill'";
            $eresult=$conn->query($sqle);
            if($eresult->num_rows>0){
                echo "You have an account already! Login to remindo.";
            }
            else{
            $profileimg='defa.png';
            $first_name=$this->sblen(strtolower($f_name),$this->iky,'idx');
            $username=$this->sblen(strtolower($username),$this->iky,'idx');
            $Email=$this->enc($Email,$this->iky,'idx');
            $country=$this->enc($country,$this->iky,'mtr');
            $country_time=$this->enc($country_time,$this->iky,'mtr');
            $gender=$this->enc($gender,$this->iky,'mtr');
            $user_date_of_birth=$this->enc($user_date_of_birth,$this->iky,'mtr');
            $profileimg=$this->enc($profileimg,$this->iky,'mtr');
            $aleml=$this->enc("1",$this->iky,"mtr");
            $status=$this->enc($status,$this->iky,"mtr");
            $hpass=password_hash($pass,PASSWORD_DEFAULT);
            $ulty=$this->enc("",$this->iky,"mtr");
            $ubo=$this->enc("",$this->iky,"mtr");
            $sql="INSERT INTO roupldls (rmuflm, runm, rusacpd, usml, rusctry, ructmnzn,rugdr,rusdob, ruspig, rusts, token,usrlocty, rualmlsnfy,bio) VALUES ('$first_name', '$username', '$hpass', '$Email', '$country','$country_time', '$gender','$user_date_of_birth', '$profileimg', '$status', '$token','$ulty', '$aleml','$ubo');";
            if($conn->query($sql)){
                $this->trckusrs();
                //--------------- sending Email to user ----------------------
                
                    $userID=$this->enc($conn->insert_id,$this->iky,'mtr');
                    $token=$this->enc($token,$this->iky,'mtr');
                    $to_email="$emal";
                    $subject="Account Verification.";

                    $header ="From: Remindo <mythreya.fn@gmail.com>\r\n";
                    $header .="MIME-Version: 1.0\r\n";
                    $header .="Content-Type: text/html; charset=ISO-8859-1\r\n";

                    $body="<html>
                        <body>
                        <center>
                        <h1>Hi! $f_name Welcome to Remindo.</h1>
                        <h3>Click here to verify your account.</h3></br>
                        <h4>https://remindo.in/Accounts/activateaccount.php?u=$userID&token=$token</h4>
                        </center>
                        </body>
                        </html>";

                    if(mail($to_email,$subject,$body,$header)){
                        $_SESSION['msg']="Check your mail to activate your  account $emal";
                        return 1;
                    }else{
                        echo "Email sending failed.";
                    }

                //------------- End of email sending ----------------------
            }else{
                echo "<script>alert('Sorry! Signup Failed.')</script>";
            }

        }
    }  
}
}
$snup=new sgnupp();
if(isset($_POST['signup_submit'])){
    echo $snup->sgnupfun($_POST['name'],$_POST['mail'],$_POST['u_country'],$_POST['u_gender'],$_POST['pwd'],$_POST['cpwd'],$_POST['TimeZone'],$_POST['birthdate'],$_POST['birthmonth'],$_POST['birthyear']);
}