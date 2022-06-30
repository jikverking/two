<?php
namespace app\user\validate;
use think\Validate;
class Letter extends Validate{
    protected $rule = [
        'content' => 'unique:user_letter',
    ];
    protected $message = [
        'content.unique' => '内容已经存在',
    ];
}