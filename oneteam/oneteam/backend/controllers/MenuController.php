<?php
namespace backend\controllers;

use Yii;
use app\models\Custom;
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
        return $this->renderPartial('designer',['menu'=>$menu]);
    }
    function actionAdmenu(){
        $mDat=$_POST['do'];
        $mDat = htmlspecialchars_decode($mDat);
        $menus = json_decode($mDat, true);
        if(!is_array($menus)) {
            message('操作非法.');
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
        $c=new Custom();
        $menu=$c->add_menu($dat);
        if($menu){
            $url=Url::toRoute('menu/designer',true);
            //header("location:$url");
            echo "<script>alert('成了');location.href='".$url."';</script>";
        }
    }
}