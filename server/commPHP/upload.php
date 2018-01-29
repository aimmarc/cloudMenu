<?php
/**
 * Created by PhpStorm.
 * User: 44719
 * Date: 2018/1/17
 * Time: 17:16
 */
require_once("../conn.php");
$req[] = [];
if ($_FILES["avatar"]["error"] > 0) {
    $req['code'] = 0;
    $req['msg'] = '上传错误';
    echo json_encode($req);
} else {
    if (file_exists("upload/" . $_FILES["avatar"]["name"])) {
        $req['code'] = 10;
        $req['msg'] = '文件已存在';
        echo json_encode($req);
    } else {
        $date=date('Ymdhis');//得到当前时间,如;20070705163148
        $fileName=$_FILES['avatar']['name'];//得到上传文件的名字
        $name=explode('.',$fileName);//将文件名以'.'分割得到后缀名,得到一个数组
        $newPath="upload/".$date.'.'.$name[1];//得到一个新的文件为'20070705163148.jpg',即新的路径
        $oldPath=$_FILES['avatar']['tmp_name'];//临时文件夹,即以前的路径

        rename($oldPath,$newPath);
        /*move_uploaded_file($_FILES["avatar"]["tmp_name"],
            "upload/" . $_FILES["avatar"]["name"]);*/

        $req['code'] = 1;
        $req['msg'] = '上传成功';
        $req['src'] = $newPath;
        echo json_encode($req);
    }
}