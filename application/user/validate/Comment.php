<?php
namespace app\user\validate;
use think\Validate;
class Comment extends Validate{
    protected $rule = [
        'content' => 'unique:user_comment',
    ];
    protected $message = [
        'content.unique' => '内容已经存在',
    ];
}