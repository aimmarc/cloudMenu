<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/1
 * Time: 10:44
 */
require_once("../conn.php");
require_once("../commPHP/makeJson.php");
$action = $_GET["action"];
/*初始化*/
function init(){
    global $action;
    if($action == 'qryFoodList'){
        qryFoodList();
    }
    if($action == 'addFood'){
        addFood();
    }
    if($action == 'removeFood'){
        removeFood();
    }
    if($action == 'modifyFood'){
        modifyFood();
    }
}

/*查询菜品列表*/
function qryFoodList(){
    $query = mysql_query("SELECT T1.*,T2.className FROM FOOD T1,FOODCLASS T2 WHERE T1.STATUS = 1 AND T1.CLASSID = T2.ID ORDER BY T1.id DESC");
    while($row = mysql_fetch_array($query,MYSQL_ASSOC)){
        $arr[] = $row;
    }
    if(empty($arr)){
        $arr = '';
    }
    $res = makeJson(0,$arr);
    echo $res;
}

function addFood(){
    $foodName = stripslashes(trim($_POST["foodName"]));
    $foodCode = stripslashes(trim($_POST["foodCode"]));
    $foodPrice = stripslashes(trim($_POST["foodPrice"]));
    $desc = stripslashes(trim($_POST["desc"]));
    $imgSrc = stripslashes(trim($_POST["imgSrc"]));
    $className = stripslashes(trim($_POST["classId"]));

    $query = mysql_query("INSERT INTO FOOD (foodName,foodCode,foodPrice,foodDesc,imgSrc,classId,status) VALUES ('$foodName','$foodCode','$foodPrice','$desc','$imgSrc','$className',1)");
    if($query){
        $arr[] = [];
        $res = makeJson(1,$arr);
        echo $res;
    }else{
        $res = makeError(1);
        echo $res;
    }
}

function removeFood(){
    $id = stripslashes(trim($_POST["id"]));

    $query = mysql_query("UPDATE FOOD SET status = 3 WHERE id = '$id'");
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
    $foodName = stripslashes(trim($_POST["foodName"]));
    $foodCode = stripslashes(trim($_POST["foodCode"]));
    $foodPrice = stripslashes(trim($_POST["foodPrice"]));
    $desc = stripslashes(trim($_POST["desc"]));
    $imgSrc = stripslashes(trim($_POST["imgSrc"]));
    $className = stripslashes(trim($_POST["classId"]));

    $query = mysql_query("UPDATE FOOD SET foodName = '$foodName',foodCode = '$foodCode',foodPrice = '$foodPrice',foodDesc = '$desc',imgSrc = '$imgSrc',classId = '$className',status = 1 WHERE id='$id'");
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

