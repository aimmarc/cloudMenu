<?php
/**
 * Created by PhpStorm.
 * User: 44719
 * Date: 2018/1/19
 * Time: 15:13
 */
require_once("../conn.php");
require_once("../commPHP/makeJson.php");

$action = $_GET["action"];

/*初始化*/
function init(){
    global $action;
    if($action == 'qryShopList'){
        qryShopList();
    }
    if($action == 'addShop'){
        addShop();
    }
    if($action == 'removeShop'){
        removeShop();
    }
    if($action == 'modifyShop'){
        modifyShop();
    }
}
/*获取类别list*/
function qryShopList(){
    $query = mysql_query("SELECT t1.*,(select nikeName from user where user.id = t1.ownerId) username FROM SHOP t1 WHERE STATUS = 1 ORDER BY id DESC");
    while($row = mysql_fetch_array($query,MYSQL_ASSOC)){
        $arr[] = $row;
    }
    if(empty($arr)){
        $arr = '';
    }
    $res = makeJson(0,$arr);
    echo $res;
}

function addShop(){
    $shopName = stripslashes(trim($_POST["shopName"]));
    $phoneNumber = stripslashes(trim($_POST["phoneNumber"]));
    $disc = stripslashes(trim($_POST["disc"]));
    $position = stripslashes(trim($_POST["position"]));
    $imgSrc = stripslashes(trim($_POST["imgSrc"]));
    $userId = stripslashes(trim($_POST["user"]));

    $query = mysql_query("INSERT INTO SHOP (shopName,phoneNumber,disc,positio,imgSrc,ownerId,status) VALUES ('$shopName','$phoneNumber','$disc','$position','$imgSrc','$userId',1)");
    if($query){
        $arr[] = [];
        $res = makeJson(1,$arr);
        echo $res;
    }else{
        $res = makeError(1);
        echo $res;
    }
}

function removeShop(){
    $id = stripslashes(trim($_POST["id"]));

    $query = mysql_query("UPDATE SHOP SET status = 3 WHERE id = '$id'");
    if($query){
        $arr[] = [];
        $res = makeJson(1,$arr);
        echo $res;
    }else{
        $res = makeError(1);
        echo $res;
    }
}

function modifyShop(){
    $id = stripslashes(trim($_POST["id"]));
    $shopName = stripslashes(trim($_POST["shopName"]));
    $phoneNumber = stripslashes(trim($_POST["phoneNumber"]));
    $disc = stripslashes(trim($_POST["disc"]));
    $position = stripslashes(trim($_POST["position"]));
    $imgSrc = stripslashes(trim($_POST["imgSrc"]));
    $userId = stripslashes(trim($_POST["user"]));

    $query = mysql_query("UPDATE SHOP SET shopName='$shopName',phoneNumber='$phoneNumber',disc='$disc',positio='$position',imgSrc='$imgSrc',ownerId='$userId',status=1 WHERE id='$id'");
    if($query){
        $arr[] = [];
        $res = makeJson(1,$arr);
        echo $res;
    }else{
        $res = makeError(1);
        echo $res;
    }
}

init();