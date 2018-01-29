<?php
/**
 * Created by PhpStorm.
 * User: 44719
 * Date: 2018/1/18
 * Time: 14:49
 */
require_once("../conn.php");
require_once("../commPHP/makeJson.php");

$action = $_GET["action"];

/*初始化*/
function init(){
    global $action;
    if($action == 'qryClassList'){
        qryClassList();
    }
    if($action == 'addClass'){
        addClass();
    }
    if($action == 'removeClass'){
        removeClass();
    }
    if($action == 'modifyFood'){
        modifyFood();
    }
}
/*获取类别list*/
function qryClassList(){
    $query = mysql_query("SELECT t.*,(SELECT shopName from shop where shop.id = t.shopId) shopName FROM FOODCLASS t WHERE STATUS = 1 ORDER BY id DESC");
    while($row = mysql_fetch_array($query,MYSQL_ASSOC)){
        $arr[] = $row;
    }
    if(empty($arr)){
        $arr = '';
    }
    $res = makeJson(0,$arr);
    echo $res;
}

function addClass(){
    $className = stripslashes(trim($_POST["className"]));
    $classCode = stripslashes(trim($_POST["classCode"]));
    $shopId = stripslashes(trim($_POST["shopId"]));

    $query = mysql_query("INSERT INTO FOODCLASS (className,classCode,shopId,status) VALUES ('$className','$classCode','$shopId',1)");
    if($query){
        $arr[] = [];
        $res = makeJson(1,$arr);
        echo $res;
    }else{
        $res = makeError(1);
        echo $res;
    }
}

function removeClass(){
    $id = stripslashes(trim($_POST["id"]));

    $query = mysql_query("UPDATE FOODCLASS SET status = 3 WHERE id = '$id'");
    if($query){
        $arr[] = [];
        $res = makeJson(1,$arr);
        echo $res;
    }else{
        $res = makeError(1);
        echo $res;
    }
}

function modifyFood(){
    $id = stripslashes(trim($_POST["id"]));
    $className = stripslashes(trim($_POST["className"]));
    $classCode = stripslashes(trim($_POST["classCode"]));
    $shopId = stripslashes(trim($_POST["shopId"]));

    $query = mysql_query("UPDATE FOODCLASS SET className = '$className',classCode = '$classCode',shopId='$shopId',status = 1 WHERE id='$id'");
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
