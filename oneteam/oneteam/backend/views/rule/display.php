<?php
require(__DIR__ . '/../common/header.php');
use yii\helpers\Url;
?>
<ul class="nav nav-tabs">
	<li class="active"><a href="<?=Url::toRoute('rule/display');?>">管理规则</a></li>
	<li><a href="<?=Url::toRoute('rule/ins');?>"><i class="icon-plus"></i> 添加规则</a></li>
</ul>
<div class="main">
	<div class="search">
		<form action="rule.php" method="get">
		<input type="hidden" name="act" value="display" />
		<table class="table table-bordered tb">
			<tbody>
				<!--tr>
					<th>规则类型</th>
					<td>
					<ul class="nav nav-pills">
						<li {if 'all' == $module}class='active'{/if}><a href="{php echo create_url('rule/display', array('module' => 'all', 'keyword' => $_GPC['keyword']))}">全部</a></li>
						{loop $modules $row}
						{if $row['issystem']}<li {if $row['name'] == $module}class='active'{/if}><a href="{php echo create_url('rule/display', array('module' => $row['name'], 'keyword' => $_GPC['keyword']))}">{$row['title']}</a></li>{/if}
						{/loop}
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">更多 <b class="caret"></b></a>
							<ul class="dropdown-menu">
								{loop $modules $row}
								{if !$row['issystem']}<li {if $row['name'] == $_GPC['module']}class='active'{/if}><a href="{php echo create_url('rule/display', array('module' => $row['name'], 'keyword' => $_GPC['keyword']))}">{$row['title']}</a></li>{/if}
								{/loop}
							</ul>
						</li>
					</ul>
					</td>
				</tr-->
				<tr>
					<th>状态</th>
					<td>
						<select name="status">
							<option value="1">启用</option>
							<option value="0">禁用</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>关键字</th>
					<td>
							<input class="span6" name="keyword" id="" type="text" value="">
					</td>
				</tr>
				 <tr class="search-submit">
					<td colspan="2"><button class="btn pull-right span2"><i class="icon-search icon-large"></i> 搜索</button></td>
				 </tr>
			</tbody>
		</table>
		</form>
	</div>
	<div class="rule">
		<?php foreach($arr as $v){
            ?>
		<table class="tb table table-bordered">
			<tr class="control-group">
				<td class="rule-content">
					<h4>
						<span class="pull-right"><a onclick="return confirm('删除规则将同时删除关键字与回复，确认吗？');return false;" href="{php echo create_url('rule/delete', array('id' => $row['id'], 'type' => 'rule'))}">删除</a><a href="{php echo create_url('rule/post', array('id' => $row['id']))}">编辑</a></span>
						<?=$v['r_name']?> <small>（<?=$v['t_name']?>）</small>
					</h4>
				</td>
			</tr>
			<tr class="control-group">
				<td class="rule-kw">
					<div>
						<span><?=$v['r_key']?></span>
					</div>
				</td>
			</tr>
			<tr class="control-group">
				<td class="rule-manage">
					<span class="rule-type pull-right">
					<!--{if $row['cate'][0]}<a href="#">{$row['cate'][0]['name']}</a>{/if}
					{if $row['cate'][1]}<a href="#">{$row['cate'][1]['name']}</a>{/if}-->
					</span>
					<div>
						<a href="" onclick="ajaxopen(this.href, message);return false;" switch="0">设为欢迎信息</a>
						<a href="" onclick="ajaxopen(this.href, message);return false;" switch="0">设为默认回复</a>
						<a target="main" href="">使用率走势</a>
						<!--<a href="{$opt['link']}" target="_blank">{$opt['title']}</a>-->
					</div>
				</td>
			</tr>
		</table>
        <?php
        }
        ?>
	</div>
</div>
<script type="text/javascript">
<!--
	var category = {php echo json_encode($children)};

//-->
</script>
<?php require(__DIR__ . '/../common/footer.php');?>
