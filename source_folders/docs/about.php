<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
  <meta name="description" content="Remindo is an interface between businesses and people. Businesses that give quality products or services can attract more customers.">
  <meta name="keywords" content="remindo about,Remindo About, remindoabout, remindo.in about">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php include '../commonfiles/commoncss.php';?>
    <link rel="stylesheet" href="http://localhost/remindo/css/docstmplts.css">
    <title>About | Remindo</title>
  </head>
  <body>
  <div class='rmdo-docs-hdr'>
  <nav class='remindo-mobile-header-nav'>
<div class='remindo-title-box-mobile'>
    <a href='../home' class='remnidoataghomelink'>
    <div id='remindo-icon'>
        <div class='rmdicn'>
            <div class='remindo-icon-box'>
                <div class='cover-clock'></div>
                <div class='remindo-clock-icon'>
                    <div class='clock-ear1'></div>
                    <div class='clock-ear2'></div>
                    <div class='clock-icon'>
                        <div class='clock-icon-min'></div>
                        <div class='clock-icon-hour'></div>
                    </div>
                </div>
            </div>
        </div>
        <h3 class='remindo-title'>REMINDO</h3>
    </div></a>
    <div class='oth-lgo-cntngdvbx'>
        <?php if(!isset($_SESSION['ssndi'])&&!isset($_SESSION['usrml'])){?>
        <div class='docs-lgn-bn-dvbx'><a href='http://localhost/remindo/signin' class='docs-login-a-tg'>Login</a></div><div class='docs-lgn-bn-dvbx'><a href='http://localhost/remindo/signin?s=signup' class='docs-login-a-tg'>Signup</a></div>
        <?php }else{?>
        <div class='docs-lgn-bn-dvbx'><a href='http://localhost/remindo/home' class='docs-login-a-tg'>Home</a></div>
        <?php }?>
    </div>
</div>
</nav>
</div>
<div class="dbydvtg">
    <div class="dcmttmplt">
    <div class="rmdodcshdr">
      <h2>Welcome To Remindo</h2>
    </div>
    <div class="rmdodcsbdy">
      <p>Remindo is an online platform that connects stores, marts, restarunts etc... with people.<br><center>REMINDO &copy <?php echo date("Y")?> by Mythreya Chowla. Remindo 1.0 Launched- June 2021.</center></p><br>
      <div><p><span data-preserver-spaces="true">Remindo is an interface between businesses and people. People can put their business like stores, marts, restaurants, etc.., online to connect with their customers, and people can purchase something they like on Remindo by pinning their desired store. There are many advantages to stores and customers.</span></p>
<h2><span data-preserver-spaces="true">Advantages of businesses</span></h2>
<ul>
<li><span data-preserver-spaces="true">Businesses that give quality products or services can attract more customers.</span></li>
<li><span data-preserver-spaces="true">Remindo monitors a product purchased by a customer so that businesses can know what products to put in stock. It saves lot of money.</span></li>
<li><span data-preserver-spaces="true">Businesses can monitor their orders and items in order more accurately received on Remindo.</span></li>
<li><span data-preserver-spaces="true">Remindo calculates the prices of every order and items in every order accurately.</span></li>
<li><span data-preserver-spaces="true">Store owners get clarity over daily orders, products in the store, and more.</span></li>
<li><span data-preserver-spaces="true">Store owners can enable C.A.S (Cash At Store) option for trusted customers.</span></li>
</ul>
<h2><span data-preserver-spaces="true">Advantages of customers</span></h2>
<ul>
<li><span data-preserver-spaces="true">People can access products of the desired store or other business from anywhere.</span></li>
<li><span data-preserver-spaces="true">Remindo calculates the prices of every order and its items accurately so that people can take enough money to pay the store when C.A.S (Cash At Store) Option is used.</span></li>
<li><span data-preserver-spaces="true">People can know the current status of a store like open or close, available or not available, etc... from anywhere.</span></li>
</ul>
<p><span data-preserver-spaces="true">These are some advantages of Remindo. After placing an order on Remindo for a store you can get updates of your order like packing, packed, etc. After your order is packed you can go to the shop and get your bag.</span></p>
<p><span data-preserver-spaces="true">We suggest businesses to stick or staple a piece of paper that contains the Remindo profile name and username of a customer whose order packed.</span></p>
<h2><span data-preserver-spaces="true">You can use Remindo to:</span></h2>
<ul>
<li><span data-preserver-spaces="true">Order products to a known store or business that available on Remindo.</span></li>
<li><span data-preserver-spaces="true">Search for Businesses such as grocery stores, book stores, marts, and restaurants, etc.</span></li>
<li><span data-preserver-spaces="true">Know the current status of a store or other business available on Remindo such as open or closed, receiving orders, or not available.</span></li>
<li><span data-preserver-spaces="true">Know how many purchases are done of a product on Remindo. It saves lot of money for businesses and gives clarity to have what products in stock (If the store account exists).</span></li>
</ul>
</div>
</div>
</div>
<div class="rgtsidbar">
  <div class="sclmdaacntsflwdsply">
    <div class="sclmdiabtnsdvbx ytbsbscrbtn">
      <h4 class="subscrbliksclmda">Subscribe on Youtube</h4>
      <div class="txttoscrbtoytb">
        <p class="sidbrptgs">Watch remindo tutorials on youtube. Get updates of Remindo from youtube.</p></div>
      <div class="btnytbdsplyscrib">
      <script src="https://apis.google.com/js/platform.js"></script>
      <div class="g-ytsubscribe" data-channelid="UCV0ujWmWR53G6vXOlR1xLLw" data-layout="full" data-count="hidden"></div>
      </div>
    </div><div class="sclmdiabtnsdvbx ytbsbscrbtn">
      <h4 class="subscrbliksclmda">Follow on Facebook</h4>
      <div class="txttoscrbtoytb">
        <p class="sidbrptgs">Get updated by facebook.</p>
      <div class="btnytbdsplyscrib"><div id="fb-root"></div>
      <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v11.0" nonce="X1uaCv4J"></script>
      <div class="fb-page" data-href="https://www.facebook.com/remindo.in/" data-tabs="" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/remindo.in/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/remindo.in/">Remindo</a></blockquote></div>
      </div>
    </div>
  </div>
  <div class="sclmdacntntbx">
  </div>
</div>
</div>
</div>
</body>

<footer>
  <p><a href='privacy'>Privacy policy</a></p>
  <p><a href='about'>About</a></p>
  <p><a href='terms_of_service'>Terms of service</a></p>
  <p>&#169; <?php echo date("Y");?> Remindo</p>
</footer>
</html>
