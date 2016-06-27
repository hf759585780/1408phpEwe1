<?php

namespace app\models;

use Yii;
use app\models\Des;
use yii\helpers\Url;

class Pub extends \yii\db\ActiveRecord
{
    //创建一个私钥
    public $key='123hefei';
    public $enableCsrfValidation = false;
    public $start='欢迎关注OneTeam微信开发中心';
    public $content='为什么我的眼里含着泪水，因为我爱你爱得深沉！';
    public static function tableName()
    {
        return '{{%pub}}';
    }
    public static function userName()
    {
        return '{{%user}}';
    }
    public static function roleName()
    {
        return '{{%rule}}';
    }
    public static function imgName()
    {
        return '{{%img}}';
    }
    public static function customName()
    {
        return '{{%custom}}';
    }
    public static function uploadName()
    {
        return '{{%upload}}';
    }
    function add_do($array){
        $key = $this->key;//私钥
        $tok=$this->randpw(10,'ALL');
        $p_rand=$this->randpw(8,'ALL');
        $url=Url::toRoute(['account/res','do'=>$p_rand],true);
        $url=str_replace('%2F','/',$url);
        $arr=array(
            'p_name'=>isset($array['name'])?$array['name']:'',
            'appid'=>isset($array['key'])?$array['key']:'',
            'appsecret'=>isset($array['secret'])?$array['secret']:'',
            'w_num'=>isset($array['account'])?$array['account']:'',
            'w_numone'=>isset($array['original'])?$array['original']:'',
            'token'=>$tok,
            'address'=>$url,
            'p_rand'=>$p_rand,
            'u_id'=>Yii::$app->session['uid']
        );
        $db=Yii::$app->db;
        if($db->createCommand()->insert($this->tableName(),$arr)->execute()){
            return 1;
        }else{
            return 2;
        }
    }

    function sel_all(){
        $db=Yii::$app->db;
        $sql = "SELECT * FROM ".$this->tableName()."as p ".
            "inner join".$this->userName()."as u ".
            "on p.u_id=u.user_id ".
            "where u_id=".Yii::$app->session['uid'];
        $arr=$db->createCommand($sql)->queryAll();
        return $arr;
    }
    function sel_name($p_id){
        if($p_id==0){
            return $p_id;
        }else{
            $db=Yii::$app->db;
            $sql = "SELECT * FROM ".$this->tableName().
                "where p_id=".$p_id;
            $arr=$db->createCommand($sql)->queryOne();
            return $arr['p_name'];
        }
    }
    function sel_one($p_id){
        if($p_id==0){
            return $p_id;
        }else{
            $db=Yii::$app->db;
            $sql = "SELECT * FROM ".$this->tableName().
                "where p_id=".$p_id;
            $arr=$db->createCommand($sql)->queryOne();
            return $arr;
        }
    }
    function api($do){
        $db=Yii::$app->db;
        $sql = "SELECT * FROM ".$this->tableName().
            "where p_rand='$do'";
        $arr=$db->createCommand($sql)->queryOne();
        return $arr['token'];
    }
    function randpw($len=8,$format='ALL'){
        $is_abc = $is_numer = 0;
        $password = $tmp ='';
        switch($format){
            case 'ALL':
                $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                break;
            case 'CHAR':
                $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                break;
            case 'NUMBER':
                $chars='0123456789';
                break;
            default :
                $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                break;
        } // www.jb51.net
        mt_srand((double)microtime()*1000000*getmypid());
        while(strlen($password)<$len){
            $tmp =substr($chars,(mt_rand()%strlen($chars)),1);
            if(($is_numer <> 1 && is_numeric($tmp) && $tmp > 0 )|| $format == 'CHAR'){
                $is_numer = 1;
            }
            if(($is_abc <> 1 && preg_match('/[a-zA-Z]/',$tmp)) || $format == 'NUMBER'){
                $is_abc = 1;
            }
            $password.= $tmp;
        }
        if($is_numer <> 1 || $is_abc <> 1 || empty($password) ){
            $password = $this->randpw($len,$format);
        }
        return $password;
    }
    //微信消息
    function sel_msg($w_num,$num){
        $db=Yii::$app->db;
        $sql = "SELECT * FROM ".$this->tableName()."as p".
            " inner join ".$this->roleName()."as r".
            " on p.p_id=r.p_id".
            " where w_num='$w_num' and r.r_mo=".$num;
        $arr=$db->createCommand($sql)->queryOne();
        if(!empty($arr)){
            return $arr;
        }
        else{
            return 0;
        }
    }
    function responseMsg()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)){
            //$this->logger("R ".$postStr);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj->MsgType);

            //消息类型分离
            switch ($RX_TYPE)
            {
                case "event":
                    $result = $this->receiveEvent($postObj);
                    break;
                case "text":
                    $result = $this->receiveText($postObj);
                    break;
                case "image":
                    $result = $this->transmitText($postObj,'已收到您的图片信息，谢谢！');
                    break;
                case "voice":
                    $result = $this->transmitText($postObj,'已收到您的语音信息，谢谢！');
                    break;
                case "video":
                    $result = $this->transmitText($postObj,'已收到您的视频信息，谢谢！');
                    break;
                case "shortvideo":
                    $result = $this->transmitText($postObj,'已收到您的小视频信息，谢谢！');
                    break;
                case "location":
                    $result = $this->transmitText($postObj,'已收到您的地理位置信息，谢谢！');
                    break;
                case "link":
                    $result = $this->transmitText($postObj,'已收到您的链接信息，谢谢！');
                    break;
                default:
                    $result = $this->transmitText($postObj,'已收到您的'.$RX_TYPE.'信息，谢谢！');
                    break;
            }
            //$this->logger("T ".$result);
            echo $result;
        }else {
            echo "";
            exit;
        }
    }
    function sel_click($key,$w_num){
        $db=Yii::$app->db;
        $sql = "SELECT c_id,c_type FROM ".$this->tableName()."as p".
            " inner join ".$this->customName()."as u".
            " on p.p_id=u.pid".
            " where w_num='$w_num' and c_key='$key'";
        $arr=$db->createCommand($sql)->queryOne();
        if(!empty($arr)){
            $sqla = "SELECT * FROM ".$this->uploadName().
                " where cid=".$arr['c_id'];
            $arra=$db->createCommand($sqla)->queryAll();
            if(!empty($arra)){
                $ar['type']=$arr['c_type'];
                $ar['content']=$arra;
                return $ar;
            }
            else{
                return 0;
            }
        }
        else{
            return 0;
        }
    }
    function receiveEvent($object)
    {
        $path=$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].Yii::$app->request->baseUrl.'/../upload/';
        $content = "";
        switch ($object->Event)
        {
            case "subscribe":
                $arr=$this->sel_msg($object->ToUserName,1);
                if($arr==0){
                    $content=$this->start;
                }else{
                    $content = $arr['r_content'];
                }
                $content .= (!empty($object->EventKey))?("\n来自二维码场景 ".str_replace("qrscene_","",$object->EventKey)):"";
                break;
            case "unsubscribe":
                $content = "取消关注";
                break;
            case "SCAN":
                $content = "扫描场景 ".$object->EventKey;
                break;
            case "CLICK":
                $arr=$this->sel_click($object->EventKey,$object->ToUserName);
                if(is_array($arr) && !empty($arr)){
                    if($arr['type']==1){
                        $content=$arr['content'][0]['up_text'];
                    }elseif($arr['type']==2){
                        $content=array();
                        foreach($arr['content'] as $vn){
                            $content[] = array("Title"=>$vn['up_title'],  "Description"=>$vn['up_content'], "PicUrl"=>$path.$vn['up_img'], "Url" =>$vn['up_url']);
                        }
                    }elseif($arr['type']==3){
                        $music=$arr['content'][0];
                        $content =array("Title"=>$music['up_title'], "Description"=>$music['up_content'], "MusicUrl"=>$path.$music['up_img'], "HQMusicUrl"=>$path.$music['up_img']);
                    }
                }else{
                    $content = "点击菜单：".$object->EventKey;
                }
                break;
            case "LOCATION":
                $content = "上传位置：纬度 ".$object->Latitude.";经度 ".$object->Longitude;
                break;
            case "VIEW":
                $content = "跳转链接 ".$object->EventKey;
                break;
            case "MASSSENDJOBFINISH":
                $content = "消息ID：".$object->MsgID."，结果：".$object->Status."，粉丝数：".$object->TotalCount."，过滤：".$object->FilterCount."，发送成功：".$object->SentCount."，发送失败：".$object->ErrorCount;
                break;
            default:
                $content = "receive a new event: ".$object->Event;
                break;
        }
        if(is_array($content)){
            if (isset($content[0]['PicUrl'])){
                $result = $this->transmitNews($object, $content);
            }else if (isset($content['MusicUrl'])){
                $result = $this->transmitMusic($object, $content);
            }
        }else{
            $result = $this->transmitText($object, $content);
        }

        return $result;
    }

    //接收文本消息
    function sel_eve($w_num,$key){
        $db=Yii::$app->db;
        $sql = "SELECT * FROM ".$this->tableName()."as p".
            " inner join ".$this->roleName()."as r".
            " on p.p_id=r.p_id".
            " where w_num='$w_num' and r.r_key='$key'";
        $arr=$db->createCommand($sql)->queryOne();
        if(!empty($arr)){
            if($arr['r_type']==1){
                return $arr;
            }
            else{
                $sql = "SELECT * FROM ".$this->imgName().
                    " where rid=$arr[r_id]";
                $arr['child']=$db->createCommand($sql)->queryAll();
                return $arr;
            }
        }
        else{
            return 0;
        }
    }
    private function receiveText($object)
    {
        $path=$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].Yii::$app->request->baseUrl.'/../upload/';
        $keyword = trim($object->Content);
        $arr=$this->sel_eve($object->ToUserName,$keyword);
        if($arr==0){
            $content=$this->content;
        }
        else{
            if($arr['r_type']==1){
                $content=$arr['r_content'];
            }elseif($arr['r_type']==2){
                $content=array();
                foreach($arr['child'] as $vn){
                    $content[] = array("Title"=>$vn['i_title'],  "Description"=>$vn['i_content'], "PicUrl"=>$path.$vn['i_image'], "Url" =>$vn['i_url']);
                }
            }elseif($arr['r_type']==3){
                $music=$arr['child'][0];
                $content =array("Title"=>$music['i_title'], "Description"=>$music['i_content'], "MusicUrl"=>$path.$music['i_image'], "HQMusicUrl"=>$path.$music['i_image']);
            }else{
                $content = date("Y-m-d H:i:s",time())."\n".$object->FromUserName."\n技术支持 OneTeam微信开发团队";
            }
        }
        if(is_array($content)){
            if (isset($content[0]['PicUrl'])){
                $result = $this->transmitNews($object, $content);
            }else if (isset($content['MusicUrl'])){
                $result = $this->transmitMusic($object, $content);
            }
        }else{
            $result = $this->transmitText($object, $content);
        }
        return $result;
    }

    //回复文本消息
    private function transmitText($object, $content)
    {
        $xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[%s]]></Content>
</xml>";
        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(), $content);
        return $result;
    }

    //回复语音消息
    private function transmitVoice($object, $voiceArray)
    {
        $itemTpl = "<Voice>
    <MediaId><![CDATA[%s]]></MediaId>
</Voice>";

        $item_str = sprintf($itemTpl, $voiceArray['MediaId']);

        $xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[voice]]></MsgType>
$item_str
</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

    //回复图文消息
    private function transmitNews($object, $newsArray)
    {
        if(!is_array($newsArray)){
            return;
        }
        $itemTpl = "    <item>
        <Title><![CDATA[%s]]></Title>
        <Description><![CDATA[%s]]></Description>
        <PicUrl><![CDATA[%s]]></PicUrl>
        <Url><![CDATA[%s]]></Url>
    </item>
";
        $item_str = "";
        foreach ($newsArray as $item){
            $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
        }
        $xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<ArticleCount>%s</ArticleCount>
<Articles>
$item_str</Articles>
</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(), count($newsArray));
        return $result;
    }

    //回复音乐消息
    private function transmitMusic($object, $musicArray)
    {
        $itemTpl = "<Music>
    <Title><![CDATA[%s]]></Title>
    <Description><![CDATA[%s]]></Description>
    <MusicUrl><![CDATA[%s]]></MusicUrl>
    <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
</Music>";

        $item_str = sprintf($itemTpl, $musicArray['Title'], $musicArray['Description'], $musicArray['MusicUrl'], $musicArray['HQMusicUrl']);

        $xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[music]]></MsgType>
$item_str
</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

    //回复多客服消息
    private function transmitService($object)
    {
        $xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[transfer_customer_service]]></MsgType>
</xml>";
        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }


    //日志记录
    /*private function logger($log_content)
    {
        if(isset($_SERVER['HTTP_APPNAME'])){   //SAE
            sae_set_display_errors(false);
            sae_debug($log_content);
            sae_set_display_errors(true);
        }else if($_SERVER['REMOTE_ADDR'] != "127.0.0.1"){ //LOCAL
            $max_size = 10000;
            $log_filename = "log.xml";
            if(file_exists($log_filename) and (abs(filesize($log_filename)) > $max_size)){unlink($log_filename);}
            file_put_contents($log_filename, date('H:i:s')." ".$log_content."\r\n", FILE_APPEND);
        }
    }*/
    function del_one($id){
        $db=Yii::$app->db;
        $db->createCommand()->delete($this->tableName(), 'p_id ='.$id)->execute();
    }
}