# imthink-admin
thinkphp-admin模块

在hahadu/think-auth模块的基础上实现的后台权限管理

实现的功能：
* 用户登录，登录验证方式支持session/cookie、JWT两种方式
* 后台权限管理
* 后台权限配置
* 后台菜单管理
* 管理组设置
* 管理员分配
* 页面跳转（依赖hahadu/think-jump-class）
* 自定义页面跳转信息
* 模块化开发，可无缝实现前后端分离
* 可为每个url节点设置访问权限
* 可为每个权限组设置不同权限
* 每个管理员可加入多个权限组

前置条件：
* 必须先安装 thinkphp6
* 配置数据库连接

安装 composer require hahadu/im-admin-think

将sql内.sql文件导入数据库

使用：
* demo文件夹内为示例文件（已实现大部分功能），覆盖root目录即可，可根据需要自行选择
* 账号:admin 密码：admin
* 密码采用md5加密
