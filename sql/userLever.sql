-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2021-04-01 11:44:22
-- 服务器版本： 10.3.25-MariaDB-0ubuntu0.20.04.1-log
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
-- 表的结构 `du_set_user_level`
--

CREATE TABLE `du_set_user_level` (
  `id` int(11) NOT NULL COMMENT 'id',
  `level` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT 'L0' COMMENT '会员等级',
  `level_name` varchar(10) DEFAULT 'L0' COMMENT '等级名称',
  `create_time` int(20) DEFAULT NULL,
  `update_time` int(20) DEFAULT NULL,
  `delete_time` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户等级表';

--
-- 转存表中的数据 `du_set_user_level`
--

INSERT INTO `du_set_user_level` (`id`, `level`, `level_name`, `create_time`, `update_time`, `delete_time`) VALUES
(1, 'Lv0', 'VIP0', 1607332186, 1607332186, NULL),
(2, 'Lv1', 'VIP1', 1607332207, 1607332207, NULL),
(3, 'Lv2', 'VIP2', 1607332213, 1607332213, NULL),
(4, 'Lv3', 'VIP3', 1607332221, 1607332221, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `du_user_level`
--

CREATE TABLE `du_user_level` (
  `uid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `delete_time` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='分配用户等级';

--
-- 转存表中的数据 `du_user_level`
--

INSERT INTO `du_user_level` (`uid`, `lid`, `delete_time`) VALUES
(0, 1, NULL),
(1, 3, NULL),
(2, 2, NULL),
(3, 3, NULL),
(5, 2, NULL),
(6, 4, NULL),
(9, 3, NULL),
(10, 1, NULL),
(11, 1, NULL);

--
-- 转储表的索引
--

--
-- 表的索引 `du_set_user_level`
--
ALTER TABLE `du_set_user_level`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `du_user_level`
--
ALTER TABLE `du_user_level`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `uid` (`uid`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `du_set_user_level`
--
ALTER TABLE `du_set_user_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
