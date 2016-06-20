<?php
require(__DIR__ . '/../common/header.php');
use yii\helpers\Url;
?>
	<script type="text/javascript" src="<?=$ad_src?>/resource/script/jquery.zclip.min.js"></script>
	<ul class="nav nav-tabs">
		<!--ul class="pull-right unstyled">
			<li><a href="{php echo create_url('account/post')}">添加公众号</a></li>
			<li class="active"><a href="{php echo create_url('account/display')}">管理公众号</a></li>
		</ul-->
		<li><a href="<?=Url::toRoute(['account/display','do'=>'add']);?>"><i class="icon-plus"></i> 添加公众号</a></li>
		<li {if empty($_GPC['type']) || $_GPC['type'] == 1}class="active"{/if}><a href="{php echo create_url('account/display', array('type' => 1))}">微信公众号</a></li>
	</ul>
	<div class="main">
		<div class="account">
            <?php
            foreach($arr as $v){
                ?>
			<div class="navbar-inner thead">
				<h4>
					<span class="pull-right"><a onclick="return confirm('删除帐号将同时删除全部规则及回复，确认吗？');return false;" href="{php echo create_url('account/delete', array('id' => $row['weid']))}">删除</a><a href="{php echo create_url('account/post', array('id' => $row['weid']))}">编辑</a><a href="{php echo create_url('account/switch', array('id' => $row['weid']))}">切换</a></span>
					<span class="pull-left"><?=$v['p_name']?> <small>（微信号：<?=$v['w_num']?>）（所属用户：<?php if($v['u_id']==1){echo "<span>创始人</span>";}else{echo "<span>$v[user_name]</span>";}?>）</small></span>
				</h4>
			</div>
			<div class="tbody">
				<div class="con">
					<div class="name pull-left">API地址</div>
					<div class="input-append pull-left" id="api_<?=$v['p_id']?>">
						<input id="" type="text" value="<?=$v['address']?>">
						<button class="btn" type="button">复制</button>
					</div>
				</div>
				<div class="con">
					<div class="name pull-left">Token</div>
					<div class="input-append pull-left" id="token_<?=$v['p_id']?>">
						<input id="" type="text" value="<?=$v['token']?>">
						<button class="btn" type="button">复制</button>
					</div>
				</div>
			</div>
			<script>
				$(function() {
					$("#api_<?=$v['p_id']?> button").zclip({
						path:'<?=$ad_src?>/resource/script/ZeroClipboard.swf',
						copy:$('#api_<?=$v['p_id']?> input').val()
					});
					$("#token_<?=$v['p_id']?> button").zclip({
						path:'<?=$ad_src?>/resource/script/ZeroClipboard.swf',
						copy:$('#token_<?=$v['p_id']?> input').val()
					});
				});
			</script>
            <?php
            }
            ?>
		</div>
	</div>
<?php require(__DIR__ . '/../common/footer.php');?>
