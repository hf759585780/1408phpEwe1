<?php
require(__DIR__ . '/../common/header.php');
use yii\helpers\Url;
?>
<div id="header">
    <div class="logo pull-left">OneTeam微信管理系统</div>
    <!-- 导航 -->
    <div class="hnav clearfix">
        <div class="row-fluid">
            <ul class="hnav-main text-center unstyled pull-left" style="width:55%;">
                <li class="hnav-parent <?php if($do=='profile'){echo 'active';}?>"><a class="hid" href="javascript:void(0)" hid="<?=Url::toRoute(['user/index','do'=>'profile','p_id'=>$p_id]);?>">当前公众号</a></li>
                <li class="hnav-parent <?php if($do=='global'){echo 'active';}?>"><a href="<?=Url::toRoute(['user/index','do'=>'global','p_id'=>$p_id]);?>">全局设置</a></li>
                <li class="hnav-parent"><a href="">更新缓存</a></li>
                <li class="hnav-parent"><a href="http://bbs.we7.cc/" target="_blank">微擎论坛</a></li>
                <li class="hnav-parent"><a href="https://mp.weixin.qq.com/" target="_blank">公众平台</a></li>
                <li class="hnav-parent"><a href="http://bbs.we7.cc/forum.php?mod=forumdisplay&fid=38" target="_blank">帮助</a></li>
            </ul>
            <!-- 右侧管理菜单 -->
            <ul class="hnav-manage text-center unstyled pull-right">
                <li class="hnav-parent" id="hnav-right">
                    <a href="javascript:;"><i class="icon-chevron-down icon-large"></i><span id="current-account"><?php if($p_id==0){echo '请切换公众号';}else{echo $p_name;}?></span></a>
                    <ul class="hnav-child unstyled text-left" id="hnav-ul" style="margin-left: 14px;">
                        <?php
                        foreach($pub as $v){
                            ?>
                            <li><a href="<?=Url::toRoute(['user/index','do'=>$do,'p_id'=>$v['p_id']]);?>" class="p_name" ><?=$v['p_name']?></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>
                <li class="hnav-parent"><a href=""><i class="icon-user icon-large"></i>admin</a></li>
                <li class="hnav-parent"><a href="{php echo create_url('member/logout')}"><i class="icon-signout icon-large"></i>退出</a></li>
            </ul>
            <!-- end -->
            <script type="text/javascript">
                $(function(){
                    $('#hnav-right').mouseover(function(){
                        $(this).css('border','none');
                        $('#hnav-ul').css('display','block');
                    }).mouseout(function(){
                        $('#hnav-ul').css('display','none');
                    });
                    $('.p_name').click(function(){
                        var ur=$(this).attr('href');
                        window.location.href=ur;
                    });
                    $('.hid').click(function(){
                        var pid=<?=$p_id?>;
                        if(pid==0){
                            $('#hnav-right').css('border','2px red solid');
                            alert('请选择公众号');
                        }else{
                            window.location.href=$(this).attr('hid');
                        }
                    })
                })
            </script>
        </div>
    </div>
    <!-- end -->
</div>
<!-- 头部 end -->
<div class="content-main">
    <table width="100%"   cellspacing="0" cellpadding="0" id="frametable">
        <tbody>
        <tr>
            <td valign="top" height="100%" class="content-left">
                <div class="sidebar-nav" style="">
                    <?php
                    foreach($left_menu as $v){
                        echo '<span class="snav-big"><i class="icon-folder-open"></i>'.$v['m_name'].'</span>';
                        if(isset($v['two'])){
                            echo '<ul class="snav unstyled">';
                            foreach($v['two'] as $vn){
                                if(!isset($vn['two'])){
                                    echo '<li class="snav-header-list"><a href="'.Url::toRoute("$vn[m_controller]/$vn[m_action]").'" target="main">'.$vn['m_name'].'<i class="arrow"></i></a></li>';
                                }
                                else{
                                    echo '<li class="snav-header" lid="'.$vn['m_id'].'"><a href="javascript:void(0)">'.$vn['m_name'].'<i class="arrow"></i></a></li>';
                                    foreach($vn['two'] as $val){
                                        echo '<li class="snav-list" name="lt-'.$vn['m_id'].'"><a href="'.Url::toRoute("$val[m_controller]/$val[m_action]").'" target="main">'.$val['m_name'].'<i class="arrow"></i></a></li>';
                                    }
                                }
                            }
                            echo '</ul>';
                        }
                    }
                    ?>
                    <!--<ul class="snav unstyled">
                        <li class="snav-header-list"><a href="{$menu['title'][1]}" target="main">2<i class="arrow"></i></a></li>
                        <li class="snav-header"><a href="">3<i class="arrow"></i></a></li>
                        <li class="snav-list"><a href="{$item[1]}" target="main">4<i class="arrow"></i></a>5<a href="{$item['childItems'][1]}" target="main" class="snav-small">6</a></li>
                        <li class="snav-list"><span style="font-size:16px;color:#999;padding-left:20px;">抱歉，暂无菜单 -_-!!!</span></li>
                    </ul>-->
                </div>
                <!-- 右侧管理菜单上下控制按钮 -->
                <div class="scroll-button">
                    <span class="scroll-button-up"><i class="icon-caret-up"></i></span>
                    <span class="scroll-button-down"><i class="icon-caret-down"></i></span>
                </div>
                <!-- end -->
            </td>
            <td valign="top" height="100%" style=""><iframe width="100%" scrolling="yes" height="100%" frameborder="0" style="min-width:800px; overflow:visible; height:565px;" name="main" id="main" src="<?=Url::toRoute(['user/main','do'=>$do,'p_id'=>$p_id]);?>"></iframe></td>
        </tr>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.snav-header').click(function(){
            var name='lt-'+$(this).attr('lid');
            if($(this).hasClass("open")){
                $(this).removeClass('open');
                $('.snav-list').css('display','none');
            }else{
                $('.snav-header').removeClass('open');
                $('.snav-list').css('display','none');
                $(this).addClass('open');
                $('li[name='+name+']').css('display','block');
            }
        });
    });
</script>
