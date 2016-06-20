<?php
namespace backend\controllers;

use app\models\Rule;
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
        $arr=$p->sel_all();
        return $this->renderPartial('display', ['arr'=>$arr]);
    }
    function actionIns(){
        if(!Yii::$app->request->getIsPost()){

            return $this->renderPartial('ins');
        }
        else{
            $p=new Rule();
            $p->r_add($_POST);
            $url=Url::toRoute('rule/display');
            $this->redirect($url);
        }
    }
}