<?php
namespace app\admin\validate;
use think\Validate;
class Configtype extends Validate{
    protected $rule = [
        'name' => 'unique:tag_type',
    ];
    protected $message = [
        'name.unique' => '类型名称已经存在',
    ];
}