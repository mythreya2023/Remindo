<?php
session_start();
include 'includes/cmnfuns.php';
class usrslfdtls extends cmnfns { 
    private $svnm; private $svum;
    private $spd; private $svd;
    protected function connect (){
       $oopconn=new mysqli( $this->svnm="localhost",
        $this->svum="root",$this->spd="",
        $this->svd="rmdfstvsn");
        return $oopconn;
    }
    public function usrs(){
        $user=$_SESSION['ssndi'];
        $get_user="SELECT usid,ruspig,runm,usml,rmuflm,rusdob,rusctry,usrlocty,rugdr,ructmnzn,bio FROM roupldls WHERE usid='$user'";
        $run_user=$this->connect()->query($get_user);
        $scmr=$this->enc($user,$this->strec,'strix');
        $sqltpns="SELECT stsrnum FROM stspdbycstms WHERE stscmnm='$scmr';";
        $tsrpns=$this->connect()->query($sqltpns)->num_rows;
        $row=$run_user->fetch_assoc();
        
        $usid=$row['usid'];
         $user_name=$this->sbldc($row['runm'],$this->iky);
         $real_user_name=$this->sbldc($row['runm'],$this->iky);
        $rmuflm=$this->sbldc($row['rmuflm'],$this->iky);
        $usml=$this->dec($row['usml'],$this->iky);
         $rusdob=$this->dec($row['rusdob'],$this->iky);
         $rusctry=$this->dec($row['rusctry'],$this->iky);
        $user_locality=$this->dec($row['usrlocty'],$this->iky);
         $rugdr=$this->dec($row['rugdr'],$this->iky);
         $user_img=$this->dec($row['ruspig'],$this->iky);
         $user_timezone=$this->dec($row['ructmnzn'],$this->iky);
         $bio=$this->dec($row['bio'],$this->iky);
         $user_timezone_enc=$row['ructmnzn'];
        //  echo $this->enc("0",$this->iky,"mtr");
        date_default_timezone_set("$user_timezone");
        $month=substr($rusdob,3);
        return json_encode(array(
        'usidnm'=>$usid,
        'usrnm'=>$user_name,
        'usrflnm'=>$rmuflm,
        'mal'=>$usml,
        'urprfig'=>$user_img,
        'uscontnt'=>$rusctry,
        'usrtimzn'=>$user_timezone,
        'ustmzn'=>$user_timezone_enc,
        'usrmlc'=>$user_locality,
        'uspnsts'=>$tsrpns,
        'gndr'=>$rugdr,
        'usrbio'=>$bio,
        'usrdbth'=>$rusdob,
        'bdt'=>substr($rusdob,0,2),
        'bmnth'=>substr($month,0,2),
        'byr'=>substr($rusdob,6),
        ));
        
    }
}

?>