<?php
namespace app\user\validate;
use think\Validate;
class Commentgroup extends Validate{
    protected $rule = [
        'name' => 'unique:user_commentgroup',
    ];
    protected $message = [
        'name.unique' => '分组名称已经存在',
    ];
}