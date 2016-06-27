OneTeam微信管理系统安装文档

本项目github地址：https://github.com/hf759585780/1408phpEwe1.git

如果使用git克隆，请使用以下代码：
	git clone https://github.com/hf759585780/1408phpEwe1.git

为了方便您的安装，请仔细阅读本文档。

本项目oneteam文件的子目录下有：oneteam安装程序，安装文档，伪静态文件，如果缺少，请重新下载或克隆

如果您不需要配置伪静态，那么您现在可以把伪静态文件删掉了

本项目安装路径：oneteam/backend/web/index.php

本项目权限要求：
	全项目权限755
	oneteam/backend/install安装目录权限777（只给目录就可以）
	oneteam/backend/config/db.php权限777

首先：输入安装路径，进入以下页面。


请同意此协议，继续：




如果出现图中标红的，请认真阅读权限要求，是否权限未给到

如果提示某一扩展未开，请先开启此扩展再执行安装
解决之后：



我们继续：


上半部分为数据库配置，请认真检测您数据库主机地址，用户名，密码的正确性及是否有权限操作该数据库的权限

以下为几个错误提示：

连接该数据库的用户名或密码错误：



未知的数据库地址：



该数据库地址连不上：



下半部分为您项目的初始账号，密码

一切通过之后



点击访问网站首页进入登录页面：

以上几步完成，那么恭喜您，成功安装本项目，希望本项目可以给您带来便利

本项目入口：oneteam/backend/web/index.php

--------------------------------------------------安装完成------------------------------------------------------

如果您希望开启伪静态，很简单，请继续往下读

请把伪静态目录下的.htaccess文件移动到oneteam/backend/web/下与index.php同级

请将oneteam/backend/config/main.php中的51-58行注释打开

如果您服务器没有开启url重写，请按照以下步骤配置一下：

    windows系统下：
	请打开您apache服务器的主配置文件httpd.conf：
	请将您RewriteEngine模块注释打开并配置on
	如果找不到 RewriteEngine 模块 
	请在配置文件的末尾添加RewriteEngine on 

    linux系统下：
	请打开您apache服务器的主配置文件httpd.conf：
	1、请将LoadModule rewrite_module modules/mod_rewrite.so注释关掉
	如果没有请添加这句话
	2、请将
	<Directory "/var/www/html">模块下与<Directory "/var/www/">模块下的：
	AllowOverride none改为
	AllowOverride All
	
    如果您配置了虚拟域名，请修改您虚拟域名的配置，配置规则同上

--------------------------------------------恭喜您，配置完成--------------------------------------------