-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2020-10-15 15:54:49
-- 服务器版本： 10.3.22-MariaDB-1ubuntu1
-- PHP 版本： 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `authdemo`
--

-- --------------------------------------------------------

--
-- 表的结构 `du_admin_nav`
--

CREATE TABLE `du_admin_nav` (
  `id` int(11) UNSIGNED NOT NULL COMMENT '菜单表',
  `pid` int(11) UNSIGNED DEFAULT 0 COMMENT '所属菜单',
  `name` varchar(15) DEFAULT '' COMMENT '菜单名称',
  `url` varchar(255) DEFAULT '' COMMENT '模块、控制器、方法',
  `icon` varchar(20) DEFAULT '' COMMENT 'font-awesome图标',
  `order_by` int(11) UNSIGNED DEFAULT NULL COMMENT '排序',
  `delete_time` int(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `du_admin_nav`
--

INSERT INTO `du_admin_nav` (`id`, `pid`, `name`, `url`, `icon`, `order_by`, `delete_time`) VALUES
(1, 0, '权限控制', '/admin/nav_rule/rule', '', NULL, NULL),
(2, 1, '权限管理', '/admin/rule/index', '', NULL, NULL),
(3, 1, '用户组管理', '/admin/group/group', '', NULL, NULL),
(4, 1, '管理员列表', '/admin/rule_admin_user/admin_list', '', NULL, NULL),
(5, 0, '系统设置', '/admin/system/index', '', NULL, NULL),
(6, 5, '后台菜单管理', '/admin/admin_nav/index', '', NULL, NULL),
(7, 5, '状态码管理', '/admin/status_code/index', '', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `du_auth_group`
--

CREATE TABLE `du_auth_group` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `rules` text DEFAULT NULL COMMENT '规则id',
  `delete_time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组表';

--
-- 转存表中的数据 `du_auth_group`
--

INSERT INTO `du_auth_group` (`id`, `title`, `status`, `rules`, `delete_time`) VALUES
(1, '超级管理员', 1, '1,2,3,4,28,29,30,5,20,21,22,23,24,6,7,8,9,10,11,12,13,15,19,14,16,17,18,25,26,27', NULL),
(2, '文章管理', 1, '1,2,3,5', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `du_auth_group_access`
--

CREATE TABLE `du_auth_group_access` (
  `uid` int(11) UNSIGNED NOT NULL COMMENT '用户id',
  `group_id` int(11) UNSIGNED NOT NULL COMMENT '用户组id',
  `delete_time` int(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组明细表';

--
-- 转存表中的数据 `du_auth_group_access`
--

INSERT INTO `du_auth_group_access` (`uid`, `group_id`, `delete_time`) VALUES
(1, 1, NULL),
(2, 2, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `du_auth_rule`
--

CREATE TABLE `du_auth_rule` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `pid` int(15) NOT NULL,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `condition` char(100) NOT NULL DEFAULT '',
  `delete_time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `du_auth_rule`
--

INSERT INTO `du_auth_rule` (`id`, `pid`, `name`, `title`, `type`, `status`, `condition`, `delete_time`) VALUES
(1, 0, '/admin/index/index', '后台首页', 1, 1, '', NULL),
(2, 1, '/admin/index/welcome', '后台欢迎页', 1, 1, '', NULL),
(3, 0, '/admin/system/index', '系统设置', 1, 1, '', NULL),
(4, 3, '/admin/admin_nav/index', '后台菜单管理', 1, 1, '', NULL),
(5, 3, '/admin/status_code/index', '状态码管理', 1, 1, '', NULL),
(6, 0, '/admin/nav_rule/rule', '权限控制', 1, 1, '', NULL),
(7, 6, '/admin/rule/index', '权限管理', 1, 1, '', NULL),
(8, 7, '/admin/rule/add', '添加权限', 1, 1, '', NULL),
(9, 7, '/admin/rule/edit', '修改权限', 1, 1, '', NULL),
(10, 7, '/admin/rule/delete', '删除权限', 1, 1, '', NULL),
(11, 7, '/admin/rule/on_delete_rule', '已删除权限', 1, 1, '', NULL),
(12, 7, '/admin/rule/rec_delete_rule', '恢复已删除权限', 1, 1, '', NULL),
(13, 6, '/admin/rule_admin_user/admin_list', '管理员列表', 1, 1, '', NULL),
(14, 6, '/admin/group/group', '用户组管理', 1, 1, '', NULL),
(15, 13, '/admin/rule_admin_user/add_admin', '添加管理员', 1, 1, '', NULL),
(16, 14, '/admin/group/add_group', '添加用户组', 1, 1, '', NULL),
(17, 14, '/admin/group/edit_group', '修改用户组', 1, 1, '', NULL),
(18, 6, '/admin/rule_group/rule_group', '分配权限', 1, 1, '', NULL),
(19, 13, '/admin/rule_admin_user/edit_admin', '修改管理员', 1, 1, '', NULL),
(20, 5, '/admin/status_code/add', '添加状态码', 1, 1, '', NULL),
(21, 5, '/admin/status_code/edit', '修改状态码', 1, 1, '', NULL),
(22, 5, '/admin/status_code/delete', '删除状态码', 1, 1, '', NULL),
(23, 5, '/admin/status_code/on_delete', '已删除的状态码', 1, 1, '', NULL),
(24, 5, '/admin/status_code/rec_delete', '恢复已删除状态码', 1, 1, '', NULL),
(25, 18, '/admin/rule_group/add_user_from_group', '添加成员到组', 1, 1, '', NULL),
(26, 18, '/admin/rule_group/delete_user_from_group', '用户从组中删除', 1, 1, '', NULL),
(27, 18, '/admin/rule_group/check_user', '添加成员', 1, 1, '', NULL),
(28, 4, '/admin/admin_nav/add', '添加菜单', 1, 1, '', NULL),
(29, 4, '/admin/admin_nav/edit', '修改菜单', 1, 1, '', NULL),
(30, 4, '/admin/admin_nav/delete', '删除菜单', 1, 1, '', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `du_home_nav`
--

CREATE TABLE `du_home_nav` (
  `id` int(11) UNSIGNED NOT NULL COMMENT '菜单表',
  `pid` int(11) UNSIGNED DEFAULT 0 COMMENT '所属菜单',
  `name` varchar(15) CHARACTER SET utf8 DEFAULT '' COMMENT '菜单名称',
  `url` varchar(255) CHARACTER SET utf8 DEFAULT '' COMMENT '模块、控制器、方法',
  `icon` varchar(20) CHARACTER SET utf8 DEFAULT '' COMMENT 'font-awesome图标',
  `order_number` int(11) UNSIGNED DEFAULT NULL COMMENT '排序'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `du_home_nav`
--

INSERT INTO `du_home_nav` (`id`, `pid`, `name`, `url`, `icon`, `order_number`) VALUES
(42, 0, '首页', 'Mail/Index/index', 'home', 1),
(43, 0, '邮件模板', '', 'envelope', 5),
(44, 43, '新建模板', 'Mail/Index/mail_tpl_add', '', 2),
(45, 43, '模板列表', 'Mail/Index/mail_tpl_list', '', 1),
(46, 0, '收件人', '', 'user', 2),
(47, 46, '收件人列表', 'Mail/Index/AddressMail', '', NULL),
(48, 46, '发件人列表', 'Mail/Index/smtp_email_list', '', NULL),
(49, 0, '其他工具', '', 'home', 10),
(50, 49, '文字转语音', 'Home/Index/index', '', 1),
(51, 49, '图片转代码', 'Home/Imgtxt/index', '', 2);

-- --------------------------------------------------------

--
-- 表的结构 `du_status_code`
--

CREATE TABLE `du_status_code` (
  `id` int(11) NOT NULL,
  `code` int(32) NOT NULL COMMENT '页面查询状态码',
  `status` int(10) NOT NULL DEFAULT 1 COMMENT '状态1:success,0:error',
  `message` varchar(50) NOT NULL COMMENT '页面状态说明',
  `title` varchar(200) DEFAULT ':(' COMMENT '页面h1内容',
  `response_code` int(10) DEFAULT 301 COMMENT '页面跳转码http_response_code',
  `wait_second` int(20) NOT NULL DEFAULT 3 COMMENT '跳转等待时间',
  `delete_time` int(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='状态码';

--
-- 转存表中的数据 `du_status_code`
--

INSERT INTO `du_status_code` (`id`, `code`, `status`, `message`, `title`, `response_code`, `wait_second`, `delete_time`) VALUES
(1, 100001, 1, '成功', ':)', 301, 1, NULL),
(2, 400001, 0, 'ERROR:失败', ':(', 301, 3, NULL),
(3, 400012, 0, '删除失败：子菜单包含数据，请先删除子菜单数据', ':(', 301, 3, NULL),
(4, 420001, 0, '提交失败', ':(', 301, 3, NULL),
(5, 420002, 0, '提交失败：数据错误', ':(', 301, 3, NULL),
(6, 1, 1, '成功', ':)', 301, 3, NULL),
(7, 0, 0, 'ERROR：失败', ':(', 301, 3, NULL),
(8, 100002, 1, '注册成功', ':)', 301, 3, NULL),
(9, 100011, 1, '修改成功', ':)', 301, 1, NULL),
(10, 100012, 1, '添加成功', ':)', 301, 1, NULL),
(11, 500011, 5, '警告：值不能为空', 'warning', 301, 3, NULL),
(12, 400011, 0, 'ERROR：删除失败!', ':(', 301, 3, NULL),
(13, 100013, 1, '删除成功', ':)', 301, 1, NULL),
(14, 404, 4, '页面不存在', '404', 404, 2, NULL),
(15, 100003, 1, '登录成功，请稍后...', ':)', 301, 3, NULL),
(16, 100021, 1, '数据恢复成功', ':)', 301, 2, NULL),
(17, 420221, 0, '数据恢复失败', ':(', 301, 3, NULL),
(18, 420011, 0, '修改失败.', ':(', 301, 3, NULL),
(19, 100004, 1, '注销登录成功，请稍后...', ':)', 301, 3, NULL),
(20, 420104, 0, '注销登录失败！', ':(', 301, 3, NULL),
(21, 300001, 0, '您没有权限访问', ':(', 301, 3, NULL),
(22, 420101, 0, '登录信息过期，请重新登录', ':(', 301, 3, NULL),
(23, 400013, 0, '删除失败：包含子权限，请先删除子权限', ':(', 301, 3, NULL),
(24, 420103, 0, '账号密码错误', ':(', 301, 3, NULL),
(25, 420102, 0, '尚未登录，请登录后再试', ':(', 301, 3, NULL),
(26, 420105, 0, '验证码错误', ':(', 301, 2, NULL),
(27, 420301, 0, '添加失败，已经存在', ':(', 301, 2, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `du_users`
--

CREATE TABLE `du_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(60) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(64) NOT NULL DEFAULT '' COMMENT '登录密码；mb_password加密',
  `avatar` varchar(255) NOT NULL DEFAULT '' COMMENT '用户头像，相对于upload/avatar目录',
  `email` varchar(100) NOT NULL DEFAULT '' COMMENT '登录邮箱',
  `email_code` varchar(60) DEFAULT NULL COMMENT '激活码',
  `phone` bigint(11) UNSIGNED DEFAULT NULL COMMENT '手机号',
  `status` tinyint(1) NOT NULL DEFAULT 2 COMMENT '用户状态 0：禁用； 1：正常 ；2：未验证',
  `register_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '注册时间',
  `last_login_ip` varchar(16) NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `last_login_time` int(10) UNSIGNED DEFAULT NULL COMMENT '最后登录时间',
  `delete_time` int(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `du_users`
--

INSERT INTO `du_users` (`id`, `username`, `password`, `avatar`, `email`, `email_code`, `phone`, `status`, `register_time`, `last_login_ip`, `last_login_time`, `delete_time`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'a218701519f7.png', '546121260@qq.com', NULL, 1888888888, 1, 0, '192.168.1.1', 99999, NULL),
(2, 'test', '', '', 'mmm', NULL, 15555555555, 1, 0, '', NULL, NULL);

--
-- 转储表的索引
--

--
-- 表的索引 `du_admin_nav`
--
ALTER TABLE `du_admin_nav`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `du_auth_group`
--
ALTER TABLE `du_auth_group`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `du_auth_group_access`
--
ALTER TABLE `du_auth_group_access`
  ADD UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `group_id` (`group_id`);

--
-- 表的索引 `du_auth_rule`
--
ALTER TABLE `du_auth_rule`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- 表的索引 `du_home_nav`
--
ALTER TABLE `du_home_nav`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `du_status_code`
--
ALTER TABLE `du_status_code`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `du_users`
--
ALTER TABLE `du_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_login_key` (`username`) USING BTREE;

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `du_admin_nav`
--
ALTER TABLE `du_admin_nav`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '菜单表', AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `du_auth_group`
--
ALTER TABLE `du_auth_group`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `du_auth_rule`
--
ALTER TABLE `du_auth_rule`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- 使用表AUTO_INCREMENT `du_home_nav`
--
ALTER TABLE `du_home_nav`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '菜单表', AUTO_INCREMENT=52;

--
-- 使用表AUTO_INCREMENT `du_status_code`
--
ALTER TABLE `du_status_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- 使用表AUTO_INCREMENT `du_users`
--
ALTER TABLE `du_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
