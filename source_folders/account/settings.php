<?php 
include 'acntstgsprvc.php';
class settingspage extends acntstngs{
public function settingsbox(){
  $acdetails=$this->getaccdtls();
  $settings= '<div class="rmdoaccsettingscontainerdivbox">
  <div id="pageloader" style="display:none"><div class="remindopageloaderdivbox"></div></div>
    <div class="topnavigationandsearch">
      <div class="nonsearchboxcontainerdiv">
        <div class="backbtnandtitle">
          <button type="button" class="remindosettingsbacknavigationbtn">
            <i class="fas fa-arrow-left remindosettingsbackicon"></i>
          </button>
          <div class="remindosettingstitlebox">Settings</div>
        </div>
      </div>
    </div>
    <div class="remindoaccountsettingsoptioncontainerdivbox">
      <div class="privacysettingsdvbx">
        <div class="settingsprivacyoptioncontainerdivbox rmdasoptcontdivboxChild">
          <button type="button" class="privacysettingsbtn">
            <i class="fas fa-lock"></i>
          </button>
          <h2 class="rmdasoptcontdivboxChildtitle">Privacy & Security</h2>
        </div>
        <div class="childsmlbox prcysrctyctnrbx">
          <div class="privacysecuritychangepwdcontainerdivbox rmd2ndchlddvbx">
            <div role="button" class="securitychngpwdsettingsbtn">
            <i class="fas fa-key remindosymbolsTn"></i>
            </div>
            <h2 class="rmd2ndchldttle">Change Password</h2>
          </div>
        </div>
      </div>
      <div class="notificationsdivbox">
        <div class="settingsnotifioptioncontainerdivbox rmdasoptcontdivboxChild">
          <button type="button" class="notificationsettingsbtn">
            <i class="far fa-bell"></i>
          </button>
          <h2 class="rmdasoptcontdivboxChildtitle">Notifications</h2>
        </div>
        <div class="childsmlbox notifysmldvbx">
        <div class="privacysecurityoptioncontainerdivbox rmd2ndchlddvbx">
          <div role="button" class="privacysecuritysettingsbtn">
          <i class="fas fa-bell remindosymbolsTn"></i>
          </div>
          <div class="switchandname">
            <h2 class="rmd2ndchldttle">Push</h2>
            <div class="toggleswitch"><label class="switch">
            <input type="checkbox" class="disalwtsndpshntfcnsasntfies"><span class="slider round"></span></label></div>
          </div>
        </div>
          <div class="privacysecurityoptioncontainerdivbox rmd2ndchlddvbx">
            <div role="button" class="privacysecuritysettingsbtn">
            <i class="fas fa-envelope remindosymbolsTn"></i>
            </div>
            <div class="switchandname">
              <h2 class="rmd2ndchldttle">Email</h2>
              <div class="toggleswitch"><label class="switch">';
              if($this->dec($acdetails["rualmlsnfy"],$this->iky)==0){$settings.='<input type="checkbox" class="disalwtsndemlsasntfies" data-ud="tre" unchecked><span class="slider round">';}
              elseif($this->dec($acdetails["rualmlsnfy"],$this->iky)==1){$settings.='<input type="checkbox" class="disalwtsndemlsasntfies" data-ud="fls" checked><span class="slider round">';}
              $settings.='</span></label></div>
            </div>
          </div>
        </div>
      </div>  
      <div class="settinglgotoptioncontainerdivbox rmdasoptcontdivboxChild">
        <button type="button" class="helpsettingsbtn">
          <i class="fas fa-sign-out-alt"></i>
        </button>
        <h2 class="rmdasoptcontdivboxChildtitle">Logout</h2>
      </div>
    </div>
    <div class="popupbackground stngscngpwdppbg">
      <div class="popupcontainerbox settingspopupcontainerbox stngscngpwdppcntrbx">
        <div class="settingspopupheaderbox">
          <h2 class="popupheadertitle">Change Password</h2>
          <button type="button" class="hidepopupbtn">X</button>
        </div>
        <div class="popupcontentcontainerbox">
          <div class="ppcntrbdydvbx">
            <center>
              <input type="password" class="odpasiptbx" placeholder="Old Password">
              <input type="password" class="nwpasiptbx" placeholder="New Password">
              <input type="password" class="cnwpasiptbx" placeholder="Confirm New Password">
              <div class="buttonbox"><span class="pderrcs"></span><br><button class="chngacpwdbtn">Change Password</button></div>
            </center>
          </div>
        </div>
      </div>
    </div>  <style>
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
  <div class="allowpushpromp" style="display:none">
      <div class="onesignal-customlink-container"></div>
  </div>
  <script
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
  </script>
  <script src="http://localhost/remindo/stores/push.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="http://localhost/remindo/account/accountjs/stngsss.js"></script>
    <script src="http://localhost/remindo/js/comfle.js"></script>
  </div>';
  return $settings;
  }
}
$set=new settingspage();
if(isset($_GET['opensettings'])){
  echo json_encode(array(
    'title'=>"Settings | Remindo",
    'body'=>  $set->settingsbox(),
  ));
  }else{
 echo "<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='UTF-8' />
    <meta http-equiv='X-UA-Compatible' content='IE=edge' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    <title>Settings | Remindo</title>";
    include '../commonfiles/commoncss.php';
  echo '
  </head>
  <body>
  <div class="pageloader" style="display:none;"><div class="remindopageloaderdivbox"></div></div>
  <div class="remindochildboxycontainer">';
    echo $set->settingsbox();
  echo "
  </div>
  </body>
</html>";
  }
?>
