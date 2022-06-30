<?php
namespace app\user\validate;
use think\Validate;
class Lettergroup extends Validate{
    protected $rule = [
        'name' => 'unique:user_lettergroup',
    ];
    protected $message = [
        'name.unique' => '分组名称已经存在',
    ];
}