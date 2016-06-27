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
class Upload extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%upload}}';
    }
    public static function customName()
    {
        return '{{%custom}}';
    }
    function u_add($data){
        $rk=$data['ipt-forward'];
        $this->u_save($rk);
        $db=Yii::$app->db;
        if($rk!=''){
            $arr=array(
                'c_type'=>$data['module'],
                'c_key'=>$rk,
                'pid'=>Yii::$app->session['p_id'],
            );
            $db->createCommand()->insert($this->customName(),$arr)->execute();
            $cid= $db->getLastInsertID();
            if(isset($data['module']) && $data['module']==1){
                $img['cid']=$cid;
                $img['up_text']=$data['content'];
                $db->createCommand()->insert($this->tableName(),$img)->execute();
            }
            if(isset($data['file']) && is_array($data['file'])){
                if(isset($data['module']) && $data['module']==2){
                    foreach($data['file'] as $k=>$vn){
                        $img['up_img']=$vn;
                        $img['cid']=$cid;
                        $img['up_title']=isset($data['tit'][$k])?$data['tit'][$k]:'';
                        $img['up_content']=isset($data['nei'][$k])?$data['nei'][$k]:'';
                        $img['up_url']=isset($data['lian'][$k])?$data['lian'][$k]:'';
                        $db->createCommand()->insert($this->tableName(),$img)->execute();
                    }
                }
                if(isset($data['module']) && $data['module']==3){
                    $img['up_img']=$data['file'][0];
                    $img['cid']=$cid;
                    $img['up_title']=isset($data['tit'][0])?$data['tit'][0]:'';
                    $img['up_content']=isset($data['nei'][0])?$data['nei'][0]:'';
                    $db->createCommand()->insert($this->tableName(),$img)->execute();
                }
            }
        }
    }
    function u_save($key){
        $path=__DIR__.'/../upload';
        $path=str_replace('\\','/',$path);
        $db=Yii::$app->db;
        $sql="select c_id from ".$this->customName().
            " where c_key='$key' and pid=".Yii::$app->session['p_id'];
        $k=$db->createCommand($sql)->queryOne();
        if(!empty($k)){
            $sql1="select up_img from ".$this->tableName().
                " where cid=".$k['c_id'];
            $img=$db->createCommand($sql1)->queryAll();
            foreach($img as $v){
                if(!empty($v['up_img'])){
                    unlink($path.'/'.$v['up_img']);
                }
            }
            $db->createCommand()->delete($this->tableName(), 'cid ='.$k['c_id'])->execute();
            $db->createCommand()->delete($this->customName(), 'c_id ='.$k['c_id'])->execute();
        }

    }
}