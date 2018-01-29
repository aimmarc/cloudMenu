<?php
/**
 * Created by PhpStorm.
 * User: 44719
 * Date: 2018/1/21
 * Time: 15:15
 */
require_once("../conn.php");
require_once("../commPHP/makeJson.php");

$action = $_GET["action"];

function init()
{
    global $action;
    if ($action == 'login') {
        logIn();
    }
}

function logIn()
{
    $username = stripslashes(trim($_POST["username"]));
    $password = stripslashes(trim($_POST["password"]));

    $query = mysql_query("SELECT PASSWORD FROM USER WHERE USERNAME='$username'");
    if ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
        if (empty($row)) {
            $arr['code'] = -1;
            $arr['msg'] = '未找到用户';
            $res = json_encode($arr);
        } else {
            if ($row["PASSWORD"] == $password) {
                $arr['code'] = 0;
                $arr['msg'] = '登陆成功';
                $query = mysql_query("INSERT INTO ");
                $res = json_encode($arr);
            } else {
                $arr['code'] = 6;
                $arr['msg'] = '密码错误';
                $res = json_encode($arr);
            }
        }
    } else {
        $res = makeError(2);
    }
    if($res == ''){
        $arr['code'] = -1;
        $arr['msg'] = '未找到用户';
        $res = json_encode($arr);
    }
    echo $res;
}

init();