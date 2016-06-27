<?php
namespace backend\controllers;

use Yii;
use app\models\Pub;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\helpers\Url;
/**
 * Site controller
 */
class AccountController extends Controller
{
    public $enableCsrfValidation = false;
    function actionDisplay(){
        $do=isset($_GET['do'])?$_GET['do']:'do';
        $m=new Pub();
        if($do=='do'){
            $arr=$m->sel_all();
            return $this->renderPartial('display',['arr'=>$arr]);
        }
        elseif($do=='add'){
            return $this->renderPartial('post');
        }
        elseif($do=='ad_do'){
            $res=$m->add_do($_POST);
            if($res==1){
                $url=Url::toRoute('account/display');
                $this->redirect($url);
            }else{
                echo 'error';
            }
        }
    }
    function actionRes(){
        $m=new Pub();
        $do=$_GET['do'];
        if(isset($_GET["echostr"])){
            $echoStr = $_GET["echostr"];
            $signature = $_GET["signature"];
            $timestamp = $_GET["timestamp"];
            $nonce = $_GET["nonce"];
            $token = $m->api($do);
            $tmpArr = array($token, $timestamp, $nonce);
            sort($tmpArr);
            $tmpStr = implode($tmpArr);
            $tmpStr = sha1($tmpStr);
            if($tmpStr == $signature){
                header('content-type:text');
                echo $echoStr;
                exit;
            }
        }
        else{
            $m->responseMsg();
        }
    }
    function actionDel(){
        $do=$_GET['do'];
        $m=new Pub();
        $m->del_one($do);
        $ur=Url::toRoute('account/display',true);
        header("location:$ur");
    }
}