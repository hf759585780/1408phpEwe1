<?php
namespace backend\controllers;

use app\models\Menu;
use app\models\Pub;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\helpers\Url;

/**
 * Site controller
 */
class UserController extends Controller
{
    function actionIndex(){
        if(!isset(Yii::$app->session['uid']) || !isset(Yii::$app->session['uname'])){
            $ur=Url::toRoute('site/login',true);
            header("location:$ur");
            //$this->redirect(array('site/login'));
            die;
        }
        $m = new Menu();
        $data=isset($_GET['do'])?$_GET['do']:'global';
        $p_id=isset($_GET['p_id'])?$_GET['p_id']:0;
        Yii::$app->session['p_id']=$p_id;
        $left_menu=$m->sel_all($data);
        $p=new Pub();
        $pub=$p->sel_all();
        $p_name=$p->sel_name($p_id);
        //print_r($left_menu);die;
        return $this->renderPartial('frame',
            ['left_menu'=>$left_menu,'do'=>$data,'pub'=>$pub,'p_id'=>$p_id,'p_name'=>$p_name]
        );
    }
    function actionMain(){
        $do=isset($_GET['do'])?$_GET['do']:'global';
        $p_id=isset($_GET['p_id'])?$_GET['p_id']:0;
        $p=new Pub();
        $pub=$p->sel_one($p_id);
        $ar=$p->sel_all();
        return $this->renderPartial('welcome',
            ['do'=>$do,'p_id'=>$p_id,'pub'=>$pub,'ar'=>$ar]
        );
    }
    function actionNav(){
        $do=isset($_GET['do'])?$_GET['do']:'global';
        $p=new Pub();
        $pub=$p->sel_all();
        $li='';
        foreach($pub as $v){
            $url=Url::toRoute(['user/index','do'=>$do,'p_id'=>$v['p_id']]);
            $li.='<li><a href="'.$url.'" class="p_name" >'.$v['p_name'].'</a></li>';
        }
        echo $li;
    }
}