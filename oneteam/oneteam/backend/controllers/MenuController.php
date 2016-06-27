<?php
namespace backend\controllers;

use Yii;
use app\models\Custom;
use app\models\Rule;
use app\models\FileUpload;
use app\models\Upload;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\helpers\Url;
/**
 * Site controller
 */
class MenuController extends Controller
{
    public $enableCsrfValidation = false;
    function actionDesigner(){
        header("content-type:text/html;charset=utf-8");
        $c=new Custom();
        $menu=$c->sel_menu();
        $p=new Rule();
        $list=$p->type_all();
        return $this->renderPartial('designer',['menu'=>$menu,'lis'=>$list]);
    }
    function actionAdmenu(){
        $mDat=$_POST['do'];
        $c=new Custom();
        $url=Url::toRoute('menu/designer',true);
        if($mDat=='remove'){
            $a=$c->del_menu();
            if(empty($a)) {
                echo "<script>alert('接口调用失败，请重试!');location.href='".$url."';</script>";
            }
            $a=@json_decode($a, true);
            $dat = $a;
            $result = $dat;
            if($result['errcode'] == '0') {
                echo "<script>alert('已经成功删除菜单，请重新创建。');location.href='".$url."';</script>";
            } else {
                echo "<script>alert('发生未知错误，请重新提交');location.href='".$url."';</script>";
            }
        }else{
            $mDat = htmlspecialchars_decode($mDat);
            $menus = json_decode($mDat, true);
            if(!is_array($menus)) {
                echo "<script>alert('操作非法.');location.href='".$url."';</script>";
            }
            foreach($menus as &$m) {
                $m['name'] = urlencode($m['name']);
                if(isset($m['sub_button']) && is_array($m['sub_button'])) {
                    foreach($m['sub_button'] as &$s) {
                        $s['name'] = urlencode($s['name']);
                    }
                }
            }
            $ms = array();
            $ms['button'] = $menus;
            $dat = json_encode($ms);
            $dat = urldecode($dat);
            $menu=$c->add_menu($dat);
            if($menu){
                //header("location:$url");
                echo "<script>alert('成了');location.href='".$url."';</script>";
            }
        }
    }
    function actionAdup(){
        $path=__DIR__.'/../upload';
        $path=str_replace('\\','/',$path);
        if(isset($_POST['module']) && $_POST['module']==2){
            $up=new FileUpload();
            $up -> set("path", $path);
            $up -> set("maxsize", 2097152);
            if($up -> upload("pic")) {
                //获取上传后文件名子
                $_POST['file']=$up->getFileName();
            } else {
                $msg=$up->getErrorMsg();
                $str='';
                if(is_array($msg)){
                    foreach($msg as $v){
                        $str.=$v.',';
                    }
                }else{
                    $str=$msg;
                }
                $str=trim($str,',');
                //$ur=Url::toRoute('rule/ins',true);
                echo "<script>alert($str);</script>";
                die;
            }
        }
        if(isset($_POST['module']) && $_POST['module']==3){
            $up=new FileUpload();
            $up -> set("path", $path);
            $up -> set("maxsize", 10485760);
            $up -> set("allowtype", array('mp3'));
            if($up -> upload("pic")) {
                //获取上传后文件名子
                $_POST['file']=$up->getFileName();
            } else {
                $msg=$up->getErrorMsg();
                $str='';
                if(is_array($msg)){
                    foreach($msg as $v){
                        $str.=$v.',';
                    }
                }else{
                    $str=$msg;
                }
                $str=trim($str,',');
                echo "<script>alert($str);</script>";
                die;
            }
        }
        $p=new Upload();
        $p->u_add($_POST);
        //print_r($_FILES);die;
        echo "<script>alert('操作成功');</script>";
        //echo $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].Yii::$app->request->baseUrl.'/../upload/';
    }
    function actionDel(){
        $p=new Upload();
        $p->u_save($_POST['key']);
    }
}