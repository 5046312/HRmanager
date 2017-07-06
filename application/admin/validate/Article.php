<?php

namespace app\admin\validate;
use think\Validate;
class Article extends Validate
{
    protected $rule = [
        'post_title' => 'require|max:80',
        'tags' => 'require',
        'post_content' => 'require',
    ];

    protected $field = [
        'post_title' => '标题',
        'post_content' => '内容',
        'tags' => '标签',
    ];
}