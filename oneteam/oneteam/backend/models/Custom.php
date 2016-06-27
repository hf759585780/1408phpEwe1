<?php

namespace app\models;

use Yii;
use yii\helpers\Url;

class Custom extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%custom}}';
    }
    public static function pubName()
    {
        return '{{%pub}}';
    }
    function sel_wei(){
        $db=Yii::$app->db;
        $sql = "SELECT * FROM ".$this->tableName()."as cu ".
            "where cu.pid=".Yii::$app->session['p_id'];
        $arr=$db->createCommand($sql)->queryAll();
        return $arr;
    }
    function access_token(){
        $cache=Yii::$app->cache;
        $access=$cache->get(Yii::$app->session['p_id']);
        if(!empty($access)){
            $access_token=$access;
        }else{
            $db=Yii::$app->db;
            $sql = "SELECT * FROM ".$this->pubName().
                " where p_id=".Yii::$app->session['p_id'];
            $arr=$db->createCommand($sql)->queryOne();
            $appid=$arr['appid'];
            $appsecret=$arr['appsecret'];
            $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsecret;
            $data='';
            $method="GET";
            $file=$this->curlPost($url,$data,$method);
            $new_file=json_decode($file);
            $cache->set(Yii::$app->session['p_id'],$new_file->access_token,3600);
            $access_token=$new_file->access_token;
        }
        return $access_token;
    }
    function add_menu($data){
        $access_token=$this->access_token();
        $url='https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$access_token;
        $method="POST";
        $file=$this->curlPost($url,$data,$method);
        return $file;
    }
    function sel_menu(){
        $access_token=$this->access_token();
        $url='https://api.weixin.qq.com/cgi-bin/menu/get?access_token='.$access_token;
        $data='';
        $method="GET";
        $file=$this->curlPost($url,$data,$method);
        $new_file=json_decode($file,true);
        //return $new_file;
        if(isset($new_file['errcode'])){
            return '';
        }else{
            if(is_array($new_file['menu']['button'])) {
                foreach($new_file['menu']['button'] as &$m) {
                    if(isset($m['key'])) {
                        $m['forward'] = $m['key'];
                    }else{
                        $m['forward']='';
                    }
                    if(isset($m['sub_button']) && is_array($m['sub_button'])) {
                        foreach($m['sub_button'] as &$s) {
                            if(isset($s['key'])){
                                $s['forward'] = $s['key'];
                            }else{
                                $s['forward']='';
                            }
                        }
                    }
                }
            }
            return $new_file;
        }
    }
    function del_menu(){
        $access_token=$this->access_token();
        $url='https://api.weixin.qq.com/cgi-bin/menu/delete?access_token='.$access_token;
        $data='';
        $method="GET";
        $file=$this->curlPost($url,$data,$method);
        return $file;
    }
    function curlPost($url,$data,$method){
        $ch = curl_init();   //1.初始化
        curl_setopt($ch, CURLOPT_URL, $url); //2.请求地址
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);//3.请求方式
        //4.参数如下
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//https
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');//模拟浏览器
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept-Encoding: gzip, deflate'));//gzip解压内容
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');

        if($method=="POST"){//5.post方式的时候添加数据
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);//6.执行

        if (curl_errno($ch)) {//7.如果出错
            return curl_error($ch);
        }
        curl_close($ch);//8.关闭
        return $tmpInfo;
    }
}