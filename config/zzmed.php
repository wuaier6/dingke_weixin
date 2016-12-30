<?php

return [
    'session' => [
        //zzmed用户id
        'user_id' => 'SESSION_USER_ID',
        //zzmed用户名
        'user_name' => 'SESSION_USER_NAME',
        //通过高级认证获得的微信用户
        'wechat_user' => 'SESSION_WECHAT_USER',
        'wechat_oauth_jump_url' => 'SESSION_WECHAT_OAUTH_JUMP_URL',
        //和正式用户绑定完成后的微信用户
        'bound_wechat_user_openid' => 'SESSION_BOUND_WECHAT_USER_OPENID',
        'intergration_user_id' => 'SESSION_INTERGRATION_USER_ID'
    ],
    'doc_session' => [
        //zzmed医生id
        'doc_user_id' => 'SESSION_DOC_USER_ID',
        //医生科室id
        'doc_dept_id' => 'SESSION_DOC_DEPT_ID',
        //医生医院id
        'doc_hosp_id' => 'SESSION_DOC_HOSP_ID',
        //zzmed用户名
        'doc_user_name' => 'SESSION_DOC_USER_NAME',
        //医生绑定完成后的微信用户
        'doc_wechat_user_openid' => 'SESSION_DOC_WECHAT_USER_OPENID',
        'doc_wechat_oauth_jump_url' => 'SESSION_WECHAT_OAUTH_DOC_JUMP_URL',
    ],
    'rep_session' => [
        //zzmed代表id
        'rep_user_id' => 'SESSION_REP_USER_ID',
        //zzmed用户名
        'rep_user_name' => 'SESSION_REP_USER_NAME',
        //医生绑定完成后的微信用户
        'rep_wechat_user_openid' => 'SESSION_REP_WECHAT_USER_OPENID',
        'rep_wechat_oauth_jump_url' => 'SESSION_WECHAT_OAUTH_REP_JUMP_URL',
    ],
    'site' => [
        'id' => env('SITE_ID', 6),
        'url' => env('SITE_URL'),
        'share_url' => "//" . env('SITE_URL'),
        'protocol' => env('SITE_PROTOCOL', 'https'),
        'baseurl' => env('SITE_PROTOCOL') . "://" . env('SITE_URL'),
    ],
    'sms' => [
        'account' => env('SMS_ACCOUNT', ''),
        'password' => env('SMS_PASSWORD', ''),
        'port' => env('SMS_PORT', ''),
        'ip' => env('SMS_IP', ''),
        'cell_verify_code' => 'cell_verify_code_',
        'cell_verify_code_time_out' => 120,
        'interval' => 120
    ],
    'wechat' => [
        'name'=>'中国高血压患者全面管理工程',
        'template' => [
            //筛查结果通知
            'report' => env('WECHAT_TEMPLATE_REPORT', 'FhWppTIG4dwYUbolpJkL-50XvL6OlSLMWudHJ2URJ_I'),
            //血压测量结果通知
            'bp_message' => env('WECHAT_TEMPLATE_BP_MESSAGE', 'eS2OB-GvYnCrmhGj0i2dqFzVdzDsubjy3gF_ZbE-2os'),
            'bind_message' => env('WECHAT_TEMPLATE_BIND_MESSAGE'),
            'bind_success_message' => env('WECHAT_TEMPLATE_BIND_SUCCESS_MESSAGE')
        ],
        'integration' => [
            'user' => '777',
            'qrcode' => 'INTEGRATION_QRCODE_'
        ],
        'representative'=>[
            'user' => '666'
        ],
        'user_doc_bind'=>[
            'user' => '665'
        ]
    ],
    'login_page' => '/User/Login',
    'doc_bind_page'=>'/Doc/Bind',
    'rep_bind_page'=>'/Rep/Bind',
    'role_type'=>'ROLE_TYPE',
    'user_intergration_page' => '/User/Intergration',
    'user_risk_report'=>'/User/RiskReport'
];