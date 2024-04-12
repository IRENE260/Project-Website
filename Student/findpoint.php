<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location:/amcs/Student/homepage.php');
    exit;
}
$con=mysqli_connect("localhost","root","","apoint");

$data=$_SESSION['details'];
// var_dump($data);
$query="select * from spoint where sid=".$_SESSION['user_id'];
$r1=mysqli_query($con,$query);
$pointlst=mysqli_fetch_array($r1);
print_r($pointlst);
foreach ($data as $key => $value) {
    $data[$key] = strtoupper($value);
}
$cat="a";
$level="b";
$flag=0;
$workshop=array("WORKSHOP","BOOTCAMP");
$arts=array("DANCE","FANCY","NAADANPATTU","RAMP","OPPANA","SONG","BEATBOX","KEYBOARD","GUITAR","PHOTOGRAPHY","MARGAMKALI","STEP","MAAPPILAPAATTU","DUFF","MIMICRY","VATTAPAATTU","MIME","SHORT","SPOT","STAND","THIRUVATHIRA","GENDER","DEBATE","CLAY","POETRY","RECITATION","WRITING","EXTEMPORE","DRAWING","PAINTING","ESSAY","PORTRAIT","JAM","MEHANDI","CARICATURE");
$mooc=array("NPTEL","COURSERA");
$sports=array("POOL","CARROMS","CHESS","BASKETBALL","JUMP","SHOT","CRICKET","FOOTBALL","JAVELIN","RELAY","METER","TENNIS","BADMINTON","VOLLEYBALL","HOCKEY","KABADDI","SWIMMING","HANDBALL","THROWBALL","SHOOTING","CYCLING");
if($flag!=1){
    foreach ($workshop as $key => $value) {
        $c=array_search($value, $data);
        if($c){
            $cat="workshop";
            $flag=1;
            break;
        }
    }
}
if($flag!=1){
    foreach ($arts as $key => $value) {
        $c=array_search($value, $data);
        if($c){
            $cat=10;
            $cat=price($data,$cat);
            $level=level($data);
            $flag=1;
            break;
        }
    }
}
if($flag!=1){
    foreach ($sports as $key => $value) {
        $c=array_search($value, $data);
        if($c){
            $cat=4;
            $cat=price($data,$cat);
            $level=level($data);
            $flag=1;
            break;
        }
    }
}
if($flag!=1){
    foreach ($mooc as $key => $value){
        $c=array_search($value, $data);
        if($c){
            $cat=15;
            $flag=1;
            break;
        }
    }
}
if($flag!=1){
    $c=array_search("NCC", $data);
    if($c){
        $cat=1;
        $flag=1;
    }
}
if($flag!=1){
    $c=array_search("NSS", $data);
    if($c){
        $cat=2;
        $flag=1;
    }
}
if($flag!=1){
    $c=array_search("TECH", $data);
    if($c){
        $cat=14;
        $level=level($data);
        $flag=1;
    }
}
if($cat!="a" && $level=="b"){
    // $p=10;
    $sql="SELECT events,maxpoint from points where id='$cat'";
    $result = mysqli_query($con,$sql);
    $value=mysqli_fetch_array($result);
    $event=$value[0];
    $point=$pointlst[$event];
    $newpoint=$value[1];
    if(($point+$newpoint) <= $newpoint){
        $point+=$newpoint;
    }
    else{
        $point=$newpoint;
    }
    $sql1="update spoint set ".$event."=".$point." where sid=".$_SESSION['user_id'];
    $result1=mysqli_query($con,$sql1);
    $sql2="insert into files(sid,filelink,point) values('".$_SESSION['user_id']."','".$_SESSION['file']."','".$point."')";
	mysqli_query($con,$sql2);
	header("Location:/amcs/Student/scertificate.php");
	exit();
}
elseif($cat!="a" && $level!="b"){
    $sql="SELECT events,$level,maxpoint from points where id='$cat'";
    $result = mysqli_query($con,$sql);;
    $value=mysqli_fetch_all($result);
    $event=$value[0];
    $point=$pointlst[$event];
    $levelpoint=$value[1];
    $maxpoint=$value[2];
    if(($point+$levelpoint) <= $maxpoint){
        $point+=$levelpoint;
    }
    else{
        $point=$maxpoint;
    }
    // $sql1="update spoint set ".$event."=".$point." where sid=".$_SESSION['user_id'];
    // $result1=mysqli_query($con,$sql1);
    print_r($point);die;
    $sql2="insert into files(sid,filelink,point) values('".$_SESSION['user_id']."','".$_SESSION['file']."','".$point."')";
	mysqli_query($con,$sql2);
	header("Location:/amcs/Student/scertificate.php");
	exit();
}
else{
    header("Location:/amcs/Student/srequest.php");
    exit();
}


function price(array $data, int $ca){
    if(array_search("FIRST", $data)){
        $ca=$ca+1;
        return $ca;
    }
    elseif(array_search("SECOND", $data)){
        $ca=$ca+2;
        return $ca;
    }
    elseif(array_search("THIRD", $data)){
        $ca=$ca+3;
        return $ca;
    }
    else{
        return $ca;
    }
}
function level(array $data){
    if(array_search("INTERNATIONAL", $data)){
        $ca="l5";
        return $ca;
    }
    elseif(array_search("NATIONAL", $data)){
        $ca="l4";
        return $ca;
    }
    elseif(array_search("STATE", $data)){
        $ca="l3";
        return $ca;
    }
    elseif(array_search("UNIVERSITY", $data)){
        $ca="l3";
        return $ca;
    }
    elseif(array_search("ZONAL", $data)){
        $ca="l2";
        return $ca;
    }
    elseif(array_search("COLLEGE", $data)){
        $ca="l1";
        return $ca;
    }
}
?>