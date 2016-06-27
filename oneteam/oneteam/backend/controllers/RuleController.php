<?php
namespace backend\controllers;

use app\models\Rule;
use app\models\FileUpload;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\helpers\Url;

/**
 * Site controller
 */
class RuleController extends Controller
{
    public $enableCsrfValidation = false;
    function actionDisplay(){
        $p=new Rule();
        $arr=$p->sel_all(1);
        return $this->renderPartial('display', ['arr'=>$arr,'module'=>1]);
    }
    function actionImg(){
        $p=new Rule();
        $arr=$p->sel_all(2);
        return $this->renderPartial('display', ['arr'=>$arr,'module'=>2]);
    }
    function actionMusic(){
        $p=new Rule();
        $arr=$p->sel_all(3);
        return $this->renderPartial('display', ['arr'=>$arr,'module'=>3]);
    }
    function actionIns(){
        $p=new Rule();
        $module=isset($_GET['module'])?$_GET['module']:1;
        if(!Yii::$app->request->getIsPost()){
            $list=$p->type_all();
            return $this->renderPartial('ins',['list'=>$list,'module'=>$module]);
        }
        else{
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
                    $ur=Url::toRoute(['rule/ins','module'=>$module],true);
                    echo "<script>alert('$str');location.href='".$ur."';</script>";
                    die;
                }
            }
            else if(isset($_POST['module']) && $_POST['module']==3){
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
                    $ur=Url::toRoute('rule/ins',true);
                    echo "<script>alert('$str');location.href='".$ur."';</script>";
                    die;
                }
            }
            $p->r_add($_POST);
            //print_r($_FILES);die;
            $url=Url::toRoute('rule/display');
            $this->redirect($url);
        }
    }
    function actionDel(){
        $do=$_GET['do'];
        $p=new Rule();
        $num=$p->del_one($do);
        if($num==1){
            $ur=Url::toRoute('rule/display',true);
            header("location:$ur");
        }elseif($num==2){
            $ur=Url::toRoute('rule/img',true);
            header("location:$ur");
        }else{
            $ur=Url::toRoute('rule/music',true);
            header("location:$ur");
        }
    }
}