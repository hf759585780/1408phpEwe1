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
class Rule extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%rule}}';
    }
    public static function userName()
    {
        return '{{%user}}';
    }
    public static function pubName()
    {
        return '{{%pub}}';
    }
    public static function typeName()
    {
        return '{{%type}}';
    }
    function r_add($data){
        $rk=explode(',',$data['keywords']);
        $db=Yii::$app->db;
        foreach($rk as $v){
            if($v!=''){
                $arr=array(
                    'r_name'=>$data['name'],
                    'r_type'=>$data['id'],
                    'r_key'=>$v,
                    'r_content'=>$data['content'],
                    'p_id'=>Yii::$app->session['p_id'],
                    'uid'=>Yii::$app->session['uid'],
                );
                $db->createCommand()->insert($this->tableName(),$arr)->execute();
            }
        }
    }
    function sel_all(){
        $db=Yii::$app->db;
        $sql = "SELECT * FROM ".$this->tableName()."as r ".
            "inner join".$this->userName()."as u on r.uid=u.user_id ".
            "inner join ".$this->pubName()."as p on r.p_id=p.p_id ".
            "inner join ".$this->typeName()."as t on r.r_type=t.t_id ".
            "where r.uid=".Yii::$app->session['uid'].
            " and r.p_id=".Yii::$app->session['p_id'];
        $arr=$db->createCommand($sql)->queryAll();
        return $arr;
    }
}