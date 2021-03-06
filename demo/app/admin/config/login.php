<?php
/**
 *  +----------------------------------------------------------------------
 *  | Created by  hahadu (a low phper and coolephp)
 *  +----------------------------------------------------------------------
 *  | Copyright (c) 2020. [hahadu] All rights reserved.
 *  +----------------------------------------------------------------------
 *  | SiteUrl: https://github.com/hahadu/thik-userlogin
 *  +----------------------------------------------------------------------
 *  | Author: hahadu <582167246@qq.com>
 *  +----------------------------------------------------------------------
 *  | Date: 2020/11/10 下午11:42
 *  +----------------------------------------------------------------------
 *  | Description:   thik-userlogin
 *  +----------------------------------------------------------------------
 **/

return [
    'user_model'=> "\Hahadu\ImAdminThink\model\Users", //用户数据表模型路径
    'JWT_login' =>true, //是否开启JWT鉴权
    'token_name' => 'access_token', //token表单字段名
    'JWT'=>[ //配置jwt
        'nbf'=> 1, //令牌生效开始时间 *距离令牌创建的时间
        'exp'=> 3600, //令牌过期时间 *距离令牌创建的时间
        'iss'=> request()->host(), //iss
        'aud'=> request()->host(), //aud

    ]

];

