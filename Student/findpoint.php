<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location:/amcs/Student/homepage.php');
    exit;
}
$con=mysqli_connect("localhost","root","","apoint");

$data=$_SESSION['details'];
// var_dump($data);die;
$query="select * from spoint where sid=".$_SESSION['user_id'];
$r1=mysqli_query($con,$query);
$pointlst=mysqli_fetch_array($r1);
// print_r($pointlst);
foreach ($data as $key => $value) {
    $data[$key] = strtoupper($value);
}

$cat="a";
$level="b";
$flag=0;
$org=array("IEEE","IET","ASME","SAE","NASA");
$inst=array("IIT","NIT");
$lang=array("IELTS","TOFEL","BEC");
$workshop=array("CONFERENCE","SEMINAR","EXHIBITION","WORKSHOP","STTP");
$arts=array("DANCE","FANCY","NAADANPATTU","RAMP","STORY","OPPANA","SONG","BEATBOX","KEYBOARD","GUITAR","PHOTOGRAPHY","MARGAMKALI","STEP","MAAPPILAPAATTU","DUFF","MIMICRY","VATTAPAATTU","MIME","SHORT","SPOT","STAND","THIRUVATHIRA","GENDER","DEBATE","CLAY","POETRY","RECITATION","WRITING","EXTEMPORE","DRAWING","PAINTING","ESSAY","PORTRAIT","JAM","MEHANDI","CARICATURE");
$mooc=array("NPTEL","COURSERA");
$sports=array("POOL","CARROMS","CHESS","BASKETBALL","JUMP","SHOT","CRICKET","FOOTBALL","JAVELIN","RELAY","METER","TENNIS","BADMINTON","VOLLEYBALL","HOCKEY","KABADDI","SWIMMING","HANDBALL","THROWBALL","SHOOTING","CYCLING");
// if($flag!=1){
//     foreach ($workshop as $key => $value) {
//         $c=array_search($value, $data);
//         if($c){
//             $cat="workshop";
//             $flag=1;
//             break;
//         }
//     }
// }
if($flag!=1){   //arts
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
if($flag!=1){   //sports
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
if($flag!=1){   //mooc
    foreach ($mooc as $key => $value){
        $c=array_search($value, $data);
        if($c){
            $cat=15;
            $flag=1;
            break;
        }
    }
}
if($flag!=1){   //ncc
    $c=array_search("NCC", $data);
    if($c){
        $cat=1;
        $flag=1;
    }
}
if($flag!=1){   //nss
    $c=array_search("NSS", $data);
    if($c){
        $cat=2;
        $flag=1;
    }
}
if($flag!=1){   //TECH FEST/QUIZ
    $c=array_search("TECH", $data);
    if($c){
        $cat=14;
        $level=level($data);
        $flag=1;
    }
}
if($flag!=1){   //internship
    if(array_search("INTERNSHIP", $data)){
        $cat=21;
        $flag=1;
    }
}
if($flag!=1){   //competitions- IIT, NIT
    if(array_search("COMPETITIONS", $data)){
        foreach ($org as $key => $value){
            if(array_search($value, $data)){
                $cat=16;
                $level=level($data);
                $flag=1;
                break;
            }
        }
    }
}
if($flag!=1){   //workshop- IEEE, NASA etc
    foreach ($workshop as $key => $value){
        if(array_search($value, $data)){
            foreach ($inst as $key => $values){
                if(array_search($values, $data)){
                    $cat=17;
                    $level="l1";
                    $flag=1;
                    break;
                }
            }
            if($cat=="a"){
                header("Location:/amcs/Student/srequest.php");
                exit();//REDIRECT HERE
            }
        }
    }
}
if($flag!=1){   //IV/Exhibition
    if((array_search("INDUSTRIAL", $data) && array_search("VISIT", $data)) || array_search("IV", $data) || array_search("EXHIBITION", $data)){
        $cat=20;
        $level="l1";
        $flag=1;
    }
}
if($flag!=1){   //Paper Presentation
    if((array_search("PAPER", $data)) && (array_search("PRESENTATION", $data) || array_search("PUBLICATION", $data)) ){
        foreach ($inst as $key => $value){
            if(array_search($value, $data)){
                $cat=18;
                $level="l1";
                $flag=1;
                break;
            }
        }
    }
}
if($flag!=1){   //Poster Presentation
    if((array_search("POSTER", $data)) && (array_search("PRESENTATION", $data) || array_search("PUBLICATION", $data)) ){
        foreach ($inst as $key => $value){
            if(array_search($value, $data)){
                $cat=19;
                $level="l1";
                $flag=1;
                break;
            }
        }
    }
}
if($flag!=1){   //Foreign Language Skills
    foreach ($lang as $key => $value) {
        $c=array_search($value, $data);
        if($c){
            $cat=22;
            $flag=1;
            break;
        }
    }
}
if($flag!=1){   //Patent
    if((array_search("PATENT", $data)) ){
        if(array_search("FILED", $data)){
            $cat=24;
            $level="l1";
            $flag=1;
        }
        elseif(array_search("PUBLISHED",$data)){
            $cat=25;
            $level="l1";
            $flag=1;
        }
        elseif(array_search("APPROVED",$data)){
            $cat=26;
            $level="l1";
            $flag=1;
        }
        elseif(array_search("LICENSED",$data)){
            $cat=27;
            $level="l1";
            $flag=1;
        }
    }
}
if($flag!=1){   //Start-Up
    if((array_search("STARTUP", $data)) || (array_search("START-UP", $data))){
        $cat=23;
        if(array_search("EMPLOYMENT",$data)){
            $cat=32;
            $flag=1;
        }
        $flag=1;
    }
}
if($flag!=1){   //INNOVATIVE TECHNOLOGY/IDEA/PRODUCT
    if(array_search("INNOVATIVE", $data)){
        if(array_search("TECHNOLOGY",$data)){
            $cat=30;
            $flag=1;
        }
        elseif(array_search("IDEA",$data)||array_search("PRODUCT",$data)){
            $cat=31;
            $flag=1;
        }
    }
}
if($flag!=1){   //SOCIETAL INNOVATION
    if(array_search("SOCIETAL", $data)){
        if(array_search("INNOVATION",$data)){
            $cat=33;
            $flag=1;
        }
    }
}
if($flag!=1){   //PROTOTYPE DEVELOPED/ AWARD PRODUCT DEVELOPMENT
    if((array_search("PROTOTYPE", $data)&& array_search("DEVELOPED", $data))||(array_search("AWARD", $data)&& array_search("PRODUCT", $data)&& array_search("DEVELOPMENT", $data))){
        if(array_search("INNOVATION",$data)){
            $cat=28;
            $flag=1;
        }
    }
}
if($flag!=1){   //VOLUNTEER
    if(array_search("VOLUNTEER", $data)){
        $cat=36;
        $level="l1";
        $flag=1;
    }
}
if($flag!=1){   //CHAIRMAN
    if(array_search("CHAIRMAN", $data)){
        $cat=37;
        $flag=1;
    }
}
if($flag!=1){   //SECRETARY
    if(array_search("SECRETARY", $data)){
        $cat=38;
        $flag=1;
    }
}
if($flag!=1){   //COORDINATOR
    if(array_search("COORDINATOR", $data)){
        if(array_search("CORE",$data)){
            $cat=34;
            $level="l1";
            $flag=1;
        }
        elseif(array_search("SUB",$data)){
            $cat=35;
            $level="l1";
            $flag=1;
        }
    }
}


if($cat!="a" && $level=="b"){
    $sql="SELECT events,maxpoint from points where id='$cat'";
    $result = mysqli_query($con,$sql);
    $value=mysqli_fetch_array($result);
    $event=$value[0];
    $point=$value[1];
    $sql2="insert into files(sid,filelink,point,event) values('".$_SESSION['user_id']."','".$_SESSION['file']."','".$point."','".$event."')";
	mysqli_query($con,$sql2);
	header("Location:/amcs/Student/scertificate.php");
	exit();
}


elseif($cat!="a" && $level!="b"){
    $sql="SELECT events,$level,maxpoint from points where id='$cat'";
    $result = mysqli_query($con,$sql);;
    $value=mysqli_fetch_array($result);
    $event=$value[0];
    $point=$value[1];
    $sql2="insert into files(sid,filelink,point,event) values('".$_SESSION['user_id']."','".$_SESSION['file']."','".$point."','".$event."')";
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