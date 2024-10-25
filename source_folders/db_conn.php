<?php
include 'includes/cmnfuns.php';
$conn=mysqli_connect("localhost","root","","rmdfstvsn");
class dbconnect extends cmnfns{
    private $svnm; private $svum;
    private $spd; private $svd;
    protected function connect (){
       $oopconn=new mysqli( $this->svnm="localhost",
        $this->svum="root",$this->spd="",
        $this->svd="rmdfstvsn");
        if(isset($_COOKIE['_urdi_'])){$_SESSION['ssndi']=$this->dec(htmlentities($_COOKIE['_urdi_']),$this->iky);}
        return $oopconn;
    }
}

?>