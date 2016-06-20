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
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_name', 'user_pwd'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'user_name' => 'User Name',
            'user_pwd' => 'User Pwd',
        ];
    }
    function sel_all($data){
        $name=$data['name'];
        $pwd=$data['pwd'];
        $code=isset($data['code'])?$data['code']:'';
        if($code!=Yii::$app->session['code'] && isset(Yii::$app->session['error'])){
            return 'a';
        }
        $db=Yii::$app->db;
        $sql = "SELECT * FROM ".$this->tableName()." WHERE user_name='$name' or user_tel='$name' or user_email='$name'";
        $arr=$db->createCommand($sql)->queryOne();
        if(!empty($arr)){
            if($arr['user_time']!=date('Y-m-d',time())){
                $db->createCommand()->update($this->tableName(), ['user_status' => 0,'user_time'=>date('Y-m-d',time())], 'user_id ='.$arr['user_id'])->execute();
                $arr['user_status']=0;
            }
            if($arr['user_status']>=3){
                return 'b';
            }else if($arr['user_pwd']==$pwd){
                Yii::$app->session['uid']=$arr['user_id'];
                Yii::$app->session['uname']=$arr['user_name'];
                if(isset(Yii::$app->session['error'])){
                    unset(Yii::$app->session['error']);
                }
                $db->createCommand()->update($this->tableName(), ['user_status' => 0], 'user_id ='.$arr['user_id'])->execute();
                return 'c';
            }else{
                $db->createCommand()->update($this->tableName(), ['user_status' => $arr['user_status']+1], 'user_id ='.$arr['user_id'])->execute();
                Yii::$app->session['error']=1;
                return $arr['user_status']+1;
            }
        }else{
            return 'd';
        }
    }
}
