<?php
namespace app\admin\validate;
use think\Validate;
class Configtag extends Validate{
    protected $rule = [
        'name' => 'unique:tag',
        'tagname' => 'unique:tag',
    ];
    protected $message = [
        'name.unique' => '应用名称已经存在',
        'tagname.unique' => '应用标识已经存在',
    ];
}