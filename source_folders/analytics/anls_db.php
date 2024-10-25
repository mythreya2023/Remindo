<?php
$conn=mysqli_connect("localhost","root","","rmoanlysr");
class anlysrcnct{
    private $svnm; private $svum;
    private $spd; private $svd;
    protected function connectanlysr (){
       $oopconn=new mysqli( $this->svnm="localhost",
        $this->svum="root",$this->spd="",
        $this->svd="rmoanlysr");
        return $oopconn;
    }
    protected function connectUsr(){
        $oopconn=new mysqli( $this->svnm="localhost",
         $this->svum="root",$this->spd="",
         $this->svd="rmdfstvsn");
         return $oopconn;
     }
    protected $anlysr="rmdAnlsr3S0Cquwoow,z;osn%caqqncqdnistraksdnfakjn";
    protected function enc($data,$key,$typ){
        $tp=htmlspecialchars($typ);
        $ciphering="AES-128-CTR";
        if($tp=='idx'){$iv = '1234567891011121';}
        elseif($tp=='mtr'){$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($ciphering));}
        $encryption = openssl_encrypt($data,$ciphering,$key,0, $iv);
        return base64_encode($encryption.'::'.$iv);
    }
    protected function dec($data,$key){
        list($encrypted_data,$iv)=array_pad(explode('::',base64_decode($data),2),2,null);
        $decryption=openssl_decrypt ($encrypted_data, "AES-128-CTR",
                $key, 0, $iv);
        return $decryption;
    }
    protected function sblen($data,$key,$typ){
        $data=str_split($data);
        $s="";
        foreach($data as $l){
            $s.=substr($this->enc($l,$key,$typ),0,4);
        }
        return $s;
    }
    protected function sbldc($data,$key){
        $data=str_split($data,4);
        $s="";$othf="PTo6MTIzNDU2Nzg5MTAxMTEyMQ==";
        foreach($data as $l){
            $d=$l.$othf;
            $s.=$this->dec($d,$key);
        }
        return $s;
    }
}

?>