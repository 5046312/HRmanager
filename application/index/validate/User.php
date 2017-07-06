<?php
namespace app\index\validate;
use think\Validate;
class User extends Validate
{
    protected $rule = [
        'uname'  =>  'require|max:25',
        'upass' =>  'require|min:6|max:30',
    ];
}