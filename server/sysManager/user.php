<?php
/**
 * Created by PhpStorm.
 * User: 44719
 * Date: 2018/1/19
 * Time: 17:19
 */
require_once("../conn.php");
require_once("../commPHP/makeJson.php");

$action = $_GET["action"];

/*初始化*/
function init(){
    global $action;
    if($action == 'qryUserList'){
        qryUserList();
    }
    if($action == 'addUser'){
        addUser();
    }
    if($action == 'removeUser'){
        removeUser();
    }
    if($action == 'modifyUser'){
        modifyUser();
    }
}
/*获取类别list*/
function qryUserList(){
    $query = mysql_query("SELECT id,username,nikeName,phoneNumber,idCode FROM USER WHERE STATUS = 1 ORDER BY id DESC");
    while($row = mysql_fetch_array($query,MYSQL_ASSOC)){
        $arr[] = $row;
    }
    if(empty($arr)){
        $arr = '';
    }
    $res = makeJson(0,$arr);
    echo $res;
}

function addUser(){
    $UserName = stripslashes(trim($_POST["UserName"]));
    $phoneNumber = stripslashes(trim($_POST["phoneNumber"]));
    $nikeName = stripslashes(trim($_POST["nikeName"]));
    $idCode = stripslashes(trim($_POST["idCode"]));

    $query = mysql_query("INSERT INTO USER (username,nikeName,phoneNumber,idCode,status) VALUES ('$UserName','$nikeName','$phoneNumber','$idCode',1)");
    if($query){
        $arr[] = [];
        $res = makeJson(1,$arr);
        echo $res;
    }else{
        $res = makeError(1);
        echo $res;
    }
}

function removeUser(){
    $id = stripslashes(trim($_POST["id"]));

    $query = mysql_query("UPDATE USER SET status = 3 WHERE id = '$id'");
    if($query){
        $arr[] = [];
        $res = makeJson(1,$arr);
        echo $res;
    }else{
        $res = makeError(1);
        echo $res;
    }
}

function modifyUser(){
    $id = stripslashes(trim($_POST["id"]));
    $UserName = stripslashes(trim($_POST["UserName"]));
    $phoneNumber = stripslashes(trim($_POST["phoneNumber"]));
    $nikeName = stripslashes(trim($_POST["nikeName"]));
    $idCode = stripslashes(trim($_POST["idCode"]));

    $query = mysql_query("UPDATE USER SET username='$UserName',phoneNumber='$phoneNumber',nikeName='$nikeName',idCode='$idCode',status=1 WHERE id='$id'");
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