<?php
namespace app\admin\controller;
use think\Controller;

class Error extends Controller {

    //空模块操作
    public function index() {
        return $this->fetch('public/404');
    }

}
