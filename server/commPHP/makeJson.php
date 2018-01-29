<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/1
 * Time: 11:33
 */
//组装json格式数据
function makeJson ($type,$arr){
    if($type == 0){ //type=0 easyui
        $res['code'] = 0;
        if(empty($arr)){
            $res['total'] = 0;
            $res['rows'] = [];
        }else{
            $res['total'] = count($arr);
            $res['rows'] = $arr;
        }
        return json_encode($res);
    }
    if($type == 1){
        $res['code'] = 0;
        $res['data'] = $arr;
        return json_encode($res);
    }
}

function makeError ($type) {
    if($type==1){
        $res['code'] = 2;
        $res['msg'] = '数据库错误';
        return json_encode($res);
    }
}