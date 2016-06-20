<?php require(__DIR__ . '/../common/header.php');?>
<ul class="nav nav-tabs">
	<li class="active"><a href="{php echo create_url('index/welcome/' . $do);}">概况</a></li>
	<li><a href="{php echo create_url('index/sysinfo/' . $do);}">系统信息</a></li>
</ul>
<div class="main">
	<div style="padding:15px 15px 0 15px;">
        <?php
            if($do=='global'){
                ?>
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th style="width:100px;">名称</th>
					<th style="width:80px;">类型</th>
					<th style="width:150px;">粉丝</th>
					<th style="width:150px;">规则</th>
					<th style="width:150px;">请求数</th>
					<th style="width:300px;">功能</th>
					<th style="min-width:51px;">操作</th>
				</tr>
			</thead>

			<tr>
				<td>默认公众号</td>
				<!--<td>{if !empty($item['key']) && !empty($item['secret'])}<span class="label label-info">服务号{else}<span class="label label-success">订阅号{/if}</span></td>-->
                <td><span class="label label-info">服务号</span></td>
				<td>
					<p>总粉丝：0<p>
					<p>当日增加：0<p>
					<p>当日流失：0<p>
				</td>
				<td>
					<p>基本文字：0<p>
					<p>图文混合：0<p>
					<p>基本语音：0<p>
					<p>其它：0<p>
				</td>
				<td>
					<p>总请求：0<p>
					<p>当月请求：0<p>
					<p>当日请求：0<p>
				</td>
				<td class="funcmenus" weid="{$item['weid']}">
					<p><a href="{php echo create_url('rule')}">规则管理</a>&nbsp;|&nbsp;<a href="{php echo create_url('setting/category')}">分类管理</a>&nbsp;|&nbsp;<a href="{php echo create_url('member/module')}">模块管理</a></p>
					<p><a href="{php echo create_url('rule/post')}">添加规则</a>&nbsp;|&nbsp;<a href="{php echo create_url('menu')}">自定义菜单设置</a>&nbsp;|&nbsp;<a href="{php echo create_url('rule/system')}">系统回复设置</a></p>
					<p><a href="{php echo create_url('site/style')}">风格管理</a>&nbsp;|&nbsp;<a href="{php echo create_url('site/nav')}">导航管理</a></p>
				</td>
				<td>
					<p><a href="{php echo create_url('account/post', array('id' => $item['weid']))}">编辑</a>&nbsp;|&nbsp;<a href="{php echo create_url('account/switch', array('id' => $item['weid']))}">切换</a></p>
				</td>
			</tr>

		</table>
		<script type="text/javascript">
		<!--
			$('.funcmenus').each(function(){
				var weid = $(this).attr('weid');
				$(this).find('a').each(function(){
					$(this).click(function(){
						var url = $(this).attr('href');
						ajaxopen('account.php?act=switch&id='+weid, function(s){
							location.href = url;
							$('#current-account', window.parent.document).html(s);
							return false;
						});
						return false;
					});
				});
			});
		//-->
		</script>
        <?php
        }else{
            ?>
		<div class="welcome">
			<h4><i class="icon-user"></i> 公众号信息</h4>
			<div class="item">
				<img class="img-polaroid pull-left" style="margin-right:20px" src="{$_W[attachurl]}/headimg_{$_W['weid']}.jpg?weid={$_W['account']['weid']}" width="85" onerror="$(this).remove();" />
				<div class="pull-left">
					<p><b style="font-size:16px;"><?=$pub['p_name']?></b></p>
					<p><span style="width:80px;display:inline-block;">接口地址：</span><?=$pub['address']?></p>
					<p><span style="width:80px;display:inline-block;">Token：</span><?=$pub['token']?></p>
				</div>
			</div>
			<!--<h4><i class="icon-plane"></i> 快捷操作</h4>
			<div class="item fast-set">
				<a href="{php echo create_url('site/module/switch', array('name' => 'userapi'))}"><i class="icon-cogs"></i><span>自定义接口</span></a>

				<a href="{$shortcut['link']}"><img class="gray" src="{$shortcut['image']}" style="width:40px;height:40px;margin-top:10px;" /><span>{$shortcut['title']}</span></a>

			</div>
		</div>
		<table class="table">
			<tr><th colspan="2" class="alert alert-info">可用模块</th></tr>

			<tr>
				<th style="width:250px;">
					<p>{$_W['modules'][$module['name']]['title']}</p>
					{if !empty($_W['modules'][$module['name']]['isrulefields'])}
					<p><a href="{php echo create_url('rule/post', array('module' => $module['name']))}">添加规则</a></p>
					{/if}
				</th>
				<td>
					{if empty($_W['modules'][$module['name']]['isrulefields'])}
					此模块无规则
					{else}
					<p>规则数：{$module['rule']}</p>
					<p>当日触发数：{$module['response']['today']}</p>
					<p>当月触发数：{$module['response']['month']}</p>
					{/if}
				</td>
			</tr>

		</table>-->
        <?php
        }
        ?>

		<table class="table">
			<tr><th colspan="2" class="alert alert-info">OneTeam开发团队</th></tr>
			<tr>
				<th style="width:250px;">版权所有</th>
				<td><a href="http://www.we7.cc/" target="_blank"><b>OneTeam微信开发团队</b></a></td>
			</tr>
			<tr>
				<th>Team 成员</th>
				<td>
					<a href="javascript:;" class="lightlink2 smallfont" target="_blank">贺飞</a>; &nbsp;
					<a href="javascript:;" class="lightlink2 smallfont" target="_blank">栗永春</a>; &nbsp;
					<a href="javascript:;" class="lightlink2 smallfont" target="_blank">王峰</a>; &nbsp;
                    <a href="javascript:;" class="lightlink2 smallfont" target="_blank">王凯峰</a>; &nbsp;
                    <a href="javascript:;" class="lightlink2 smallfont" target="_blank">李佳辉</a>;
				</td>
			</tr>
			<tr>
				<th style="width:250px;">官方交流群</th>
				<td><a target="_blank" href="http://wp.qq.com/wpa/qunwpa?idkey=874aa2f28317557b6f0874692c927974611b0c193c9b36ab17b64f9cbd43e5ad">32385562</a></td>
			</tr>
			<tr>
				<th>相关链接</th>
				<td>
					<a href="http://www.we7.cc/" class="lightlink2" target="_blank">公司网站</a>,
					<a href="http://www.we7.cc/purchase.html" class="lightlink2" target="_blank">购买授权</a>,
					<a href="http://bbs.we7.cc/forum.php?mod=forumdisplay&fid=36" class="lightlink2" target="_blank">更多模块</a>,
					<a href="http://www.we7.cc/docs/" class="lightlink2" target="_blank">文档</a>,
					<a href="http://bbs.we7.cc/" class="lightlink2" target="_blank">讨论区</a>
				</td>
			</tr>
		</table>

	</div>
</div>
<?php require(__DIR__ . '/../common/footer.php');?>
