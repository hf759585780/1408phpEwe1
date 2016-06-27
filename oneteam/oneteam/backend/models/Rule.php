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
    public static function imgName()
    {
        return '{{%img}}';
    }
    function r_add($data){
        $rk=explode(',',$data['keywords']);
        $db=Yii::$app->db;
        foreach($rk as $v){
            if($v!=''){
                $arr=array(
                    'r_name'=>$data['name'],
                    'r_type'=>$data['module'],
                    'r_key'=>$v,
                    'r_content'=>$data['content'],
                    'p_id'=>Yii::$app->session['p_id'],
                    'uid'=>Yii::$app->session['uid'],
                );
                $db->createCommand()->insert($this->tableName(),$arr)->execute();
                $rid= $db->getLastInsertID();
                if(isset($data['file']) && is_array($data['file'])){
                    if(isset($data['module']) && $data['module']==2){
                        foreach($data['file'] as $k=>$vn){
                            $img['i_image']=$vn;
                            $img['rid']=$rid;
                            $img['i_title']=isset($data['tit'][$k])?$data['tit'][$k]:'';
                            $img['i_content']=isset($data['nei'][$k])?$data['nei'][$k]:'';
                            $img['i_url']=isset($data['lian'][$k])?$data['lian'][$k]:'';
                            $db->createCommand()->insert($this->imgName(),$img)->execute();
                        }
                    }
                    if(isset($data['module']) && $data['module']==3){
                        $img['i_image']=$data['file'][0];
                        $img['rid']=$rid;
                        $img['i_title']=isset($data['tit'][0])?$data['tit'][0]:'';
                        $img['i_content']=isset($data['nei'][0])?$data['nei'][0]:'';
                        $db->createCommand()->insert($this->imgName(),$img)->execute();
                    }
                }
            }
        }
    }
    function sel_all($num=1){
        $db=Yii::$app->db;
        $sql = "SELECT * FROM ".$this->tableName()."as r ".
            "inner join ".$this->userName()."as u on r.uid=u.user_id ".
            "inner join ".$this->pubName()."as p on r.p_id=p.p_id ".
            "inner join ".$this->typeName()."as t on r.r_type=t.t_id ".
            "where r.uid=".Yii::$app->session['uid'].
            " and r.p_id=".Yii::$app->session['p_id'].
            " and r.r_type=".$num;
        $arr=$db->createCommand($sql)->queryAll();
        foreach($arr as $k=>$v){
            if($v['r_type']!=1){
                $sql = "SELECT * FROM ".$this->imgName()." as i".
                " where i.rid=".$v['r_id'];
                $arr[$k]['img']=$db->createCommand($sql)->queryAll();
            }
        }
        return $arr;
    }
    function type_all(){
        $db=Yii::$app->db;
        $sql = "SELECT * FROM ".$this->typeName();
        $arr=$db->createCommand($sql)->queryAll();
        return $arr;
    }
    function del_one($id){
        $db=Yii::$app->db;
        $sql = "SELECT * FROM ".$this->tableName()." where r_id=".$id;
        $arr=$db->createCommand($sql)->queryOne();
        $type=$arr['r_type'];
        $db->createCommand()->delete($this->tableName(), 'r_id ='.$id)->execute();
        return $type;
    }
}