<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $user_id
 * @property string $user_name
 * @property string $user_pwd
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }
    //递归菜单栏
    function sel_all($data){
        if($data=='profile'){
            $n=0;
        }
        if($data=='global'){
            $n=1;
        }
        $db=Yii::$app->db;
        $sql="SELECT * FROM ".$this->tableName()." WHERE p_id=$n and f_id=0";
        $arr=$db->createCommand($sql)->queryAll();
        foreach($arr as $k=>$v){
            $sq="SELECT * FROM ".$this->tableName()." WHERE p_id=$n and f_id=$v[m_id]";
            $ar=$db->createCommand($sq)->queryAll();
            if(!empty($ar)){
                $arr[$k]['two']=$ar;
                foreach($ar as $key=>$val){
                    $sqll="SELECT * FROM ".$this->tableName()." WHERE p_id=$n and f_id=$val[m_id]";
                    $arll=$db->createCommand($sqll)->queryAll();
                    if(!empty($arll)){
                        $arr[$k]['two'][$key]['two']=$arll;
                    }
                }
            }
        }
        return $arr;
    }

    function res($data,$f_id=0,$level=0){
        static $arr=array();
        foreach($data as $k=>$v){
            if($v['f_id']==$f_id){
                $v['level']=$level;
                $arr[]=$v;
                $this->res($data,$v['m_id'],$level+1);
            }
        }
        return $arr;

    }
}