<?php 
include "loginSignup/logIn.php";
class sgninpg extends lgn{
  public function signin(){
    $verified=true;
    $conn=$this->connect();
    // $bcknd=$this->login("","",false);
    // $newmsg=$bcknd['nwmsg'];
    // $verified=$bcknd['vrf'];
    if(isset($_POST['submitLogin'])||isset($_POST['verifyAccount'])){
      $Email=mysqli_real_escape_string($conn,$_POST['lmail']);
      if(isset($_POST['submitLogin'])){
          $pass=mysqli_real_escape_string($conn,$_POST['lpwd']);
              if(empty($Email)||empty($pass)){
                  $newmsg="Please Fill All The Fields!";
              }else{
                if(isset($_POST['remindme'])){$rmbrme=$_POST['remindme'];}else{$rmbrme="";}
                  $bcknd=$this->login($Email,$pass,false,$rmbrme);
                  $newmsg=$bcknd['nwmsg'];
                  $verified=$bcknd['vrf'];
              }
      }
      if(isset($_POST['verifyAccount'])){
        if(empty($Email)){
            $newmsg="Please Fill All The Fields!";
        }else{
            $bcknd=$this->login($Email,"",true,'');
            $newmsg=$bcknd['nwmsg'];
            $verified=$bcknd['vrf'];
        }
      }
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
  <meta name="description" content="Log into Remindo and set up a business or buy products from businesses you know and near you.">
  <meta name="keywords" content="remindo,Remindo,reminder,reminders">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name='theme-color' content='#FF8F26'>
    <link rel="shortcut icon" href="http://localhost/remindo/includes/fn_img/maskfavicon.png" type="image/x-icon">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="http://localhost/remindo/css/login1.css" />
    <link rel="stylesheet" href="http://localhost/remindo/css/signup.css" />
    <link rel="stylesheet" href="http://localhost/remindo/models/remindoIcon.css">
    <title>Login-Remindo</title>
    <style>
    body{
      /* background:#ff8f26;
      overflow:hidden; */
    background: #e6e4e2;
    }
    .bckgrnd-fil-dimr-insgnpg{
      height: 100%;
      width: 100%;
      position: fixed;
      top: 0;
      left: 0;
      /* background: #00000040; */
    }
    .bckgrnd-fil-pcs-insgnpg1{
      height: 100%;
      width: 100%;
      position: fixed;
      top: 0;
      left: 0;
      overflow: hidden;
      /* background-image: url(http://localhost/remindo/includes/fn_img/dsktop-sginbckig.jpg); */
      background-position: center;
      background-repeat: repeat;
      background:#F6B431;
      background-attachment: fixed;
      background-size: contain;
    }
    .srt_on_rmdo {
    position: fixed;
    bottom: 50px;
    text-align: center;
    width: 96%;
    font-size: 16px;
    color: #f9f9f9;
    z-index: 0;
    text-shadow: 0 0 2px #736868;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }footer{
        display: flex;
    position: fixed;
    bottom:15px;
    font-family: sans-serif;
    color:white;
    flex-wrap: wrap;
    justify-content: space-around;
    text-align: center;
    width: 100%;
    }footer a{
    color:white;
    text-shadow: 0 0 2px #1d1919b3;
    }footer p{
        margin:0;
    }
    .typs-of-sls-ppl-cn-snd {
        color: #ffe2a5;
        font-size: 18px;
    }
    .al-bsntyp-altr-spntg{
      text-decoration:2px underline dashed;
    }
    div#getin,div#signUP{
    box-shadow: 10px 10px 15px rgb(70 70 70 / 12%);
    background: #EDECED;
    }
    input{
      background: #EDECED;
    box-shadow: -10px -10px 15px rgb(255 255 255 / 50%), 10px 10px 15px rgb(70 70 70 / 12%), inset -10px -10px 15px rgb(255 255 255 / 50%), inset 10px 10px 15px rgb(70 70 70 / 12%);
    }
    input:focus{
    box-shadow: -10px -10px 15px rgb(255 255 255 / 50%), 10px 10px 15px rgb(70 70 70 / 12%), inset -10px -10px 15px rgb(255 255 255 / 50%), inset 10px 10px 15px rgb(70 70 70 / 12%);
    }
    button.signin-submit-btn {
    background: #fbb926;
    box-shadow: -10px -10px 15px rgb(255 255 255 / 50%), 10px 10px 15px rgb(70 70 70 / 12%);
    border-radius: 50px;
}
    </style>
  </head>
  <body>
  <div class='bckgrnd-fil-pcs-insgnpg1'></div>
  <div class='bckgrnd-fil-dimr-insgnpg'></div>
  <div class='responsive-remindo-login-box'>
    <div class="remindo-label">
      <div id='remindo-icon'><?php include 'models/remindoIcon.php';?></div>
      <h3 class="remindo-title" style='position:absolute;z-index:1;'>REMINDO</h3>
    </div>
    <div class="getin" id="getin">
      <form class="login" id="Login" action="signin" method="POST" require>
        <h1 class='login-h1' style='color:#ff8f26;'>LOGIN</h1>
          <?php
          session_start();
          if(isset($_SESSION['msg'])){
            echo "
            <div id='session_msg' style='color:black;background:#E8F0FE;padding:3px;border-radius:3px;border:none;'>";
          echo $_SESSION['msg'];
          echo "
          </div>";
          }
          ?>
         <?php if(!empty($newmsg)): ?>
        <div id="errors">
        <?php echo $newmsg; ?>
        </div>
        <?php endif; ?>
        <input type="email" name="lmail" id="mail" placeholder="E-mail" require/><br />
        <?php if($verified){?>
        <input type="password" name="lpwd" id="lpwd" placeholder="Password" /><br />
        <?php }?>
        <?php if($verified){?>
        <button type="submit" name="submitLogin" class='signin-submit-btn'><span class='lgin-submit-btn-spantag'>Log In</span></button><br />
        <input type="checkbox" name="remindme" id="remindme" value='rmbrcke' checked style='
            cursor: context-menu;
            width:10px;
            '><label for='remindme'><strong style='
            cursor: context-menu;
            display: left;
            text-decoration: none;
            color: black;
            font-weight: 600;'>Remember me</strong></label>
        <?php }else{?>
          <button type="submit" name="verifyAccount" id='send-email-button' class='signin-submit-btn'>Send Email</button><br />
        <?php }?> 
        <!-- <a
          href="forgotPassword/emailOTP.php"
          style="
            cursor: context-menu;
            display: left;
            /* margin-left: 50px; */
            text-decoration: none;
            color: black;
            font-weight: 600;
          "
          >
          <span class="forget-pwd">forget password?</span></a> -->
        <hr style="margin: 15px" />
        <span class="sign-but">
          Create New Account
        </span>
      </form>
    </div>
    </div>
    <div class="signup-popup-container">
    <button type='button' id='cancle-signup-popup'>X</button>
    <?php include 'loginSignup/signup.php'; ?>
    </div>
    <?php if(isset($_GET['s'])){if($_GET['s']=="signup"){?>
    <script>$(".signup-popup-container").show();</script>
    <?php }}?>
    <script>
         $(".signin-submit-btn").click(()=>{
          $(".lgin-submit-btn-spantag").text("Loging in...");});
    </script>
    <div class='srt_on_rmdo'><span class='typs-of-sls-ppl-cn-snd'><strong>Enjoy</strong></span> the new <span class='typs-of-sls-ppl-cn-snd'><strong>Shopping experience</strong></span>  <strong>,<span class='typs-of-sls-ppl-cn-snd'>Interact virtually</span></strong> with things you like to buy nearby you with <span class='typs-of-sls-ppl-cn-snd'><strong>Remindo</strong></span>! Try Remindo! It's free!</div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js'></script>
    <script src='http://localhost/remindo/loginSignup/sgn.js'></script>
  </body>
<footer>
  <a href='docs/privacy'>Privacy policy</a>
  <a href='docs/about'>About</a>
  <a href='docs/terms_of_service'>Terms of service</a>
  <p>&#169; <?php echo date("Y");?></p>
</footer>
</html>
<?php
}
  public function dc($txt){return $this->dec($txt,$this->iky);}
}
$signin=new sgninpg();
if((isset($_COOKIE['_ugdae'])&&isset($_COOKIE['_urdi_']))||(isset($_SESSION['ssndi'])&&isset($_SESSION['usrml']))){
  $ugdae=htmlentities(htmlspecialchars($_COOKIE['_ugdae']));
  $urdi=htmlentities(htmlspecialchars($_COOKIE['_urdi_']));
  session_start();
  $_SESSION['ssndi']=$signin->dc($urdi);
  $_SESSION['usrml']=$signin->dc($ugdae);
  header("Location:home");
}else{
$signin->signin();
}
?>