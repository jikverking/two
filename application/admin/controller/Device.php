<?php
namespace app\admin\controller;

class Device extends Common
{


    /**
     * 设备管理
     */


    /**
     * 获取硬件列表
     */
    public function devicelist()
    {
        ignore_user_abort(true); // 后台运行
        set_time_limit(0); // 取消脚本运行时间的超时上限
        $config = configs('api');
        if(request() -> isPost()){
            $infomsg = input('post.infomsg');
            $key = input('post.key');
            if(isset($key)){
                //设备imei 搜索
                if($infomsg == "IMEI"){
                    $url = $config['apiurl'].'/openapi/equipment/es';
                    $array = [
                        'appkey' => $config['apiappkey'],
                        'key' => $key
                    ];
                    $model = model('Common')->curl_post($url,$array);
                    $data = json_decode($model,true);
                    if($data['code'] != 200){
                        $data['data'] = '';
                        $data['count'] = 0;
                    }
                    if($data['data']){
                        foreach ($data['data'] as $key => $value) {
                            $data['data'][$key]['time'] = date('Y-m-d H:i:s',$value['time']);
                            if($value['task_state'] == 1){
                                $data['data'][$key]['task_state'] = '忙';
                            }else{
                                $data['data'][$key]['task_state'] = '闲';
                            }
                        }
                    }
                    $data['count'] = count($data['data']);
                    return json(['code'=>0,'data'=>$data['data'],'count'=>$data['count'],'rel'=>1,'msg'=>'获取成功!']);
                }else{
                    return json(['code'=>0,'data'=>'','count'=>0,'rel'=>1,'msg'=>'获取成功!']);
                }


            }else{
                $page = input('page')?input('page'):1;
                $limit =input('limit')?input('limit'):10;
                $url = $config['apiurl'].'/openapi/equipment/list';
                $array = [
                    'appkey' => $config['apiappkey'],
                    'limit' => $limit,
                    'page' => $page,
                    'type' => -1,
                ];
                $model = model('Common')->curl_post($url,$array);
                $data = json_decode($model,true);
                if($data['code'] != 200){
                    $data['list'] = '';
                    $data['count'] = 0;
                }
                if($data['list']){
                    foreach ($data['list'] as $key => $value) {
                        $data['list'][$key]['time'] = date('Y-m-d H:i:s',$value['time']);
                        if($value['task_state'] == 1){
                            $data['list'][$key]['task_state'] = '忙';
                        }else{
                            $data['list'][$key]['task_state'] = '闲';
                        }
                    }
                }
                return json(['code'=>0,'data'=>$data['list'],'count'=>$data['count'],'rel'=>1,'msg'=>'获取成功!']);
            }
        }else{
            $url = $config['apiurl'].'/openapi/equipment/getgroup?appkey='.$config['apiappkey'];
            $model = model('Common')->curl_get($url);
            $data = json_decode($model,true);
            if($data['code'] != 200){
                $data['data'] = '';
            }
            $this->assign('group',$data['data']);
            return $this->fetch();
        }
    }

    /**
     * 单条增加设备
     */
    public function deviceadd()
    {
        if(request() -> isPost()){
            $data = input('post.');
            $data['uid'] = trim($data['uid']);
            $data['imei'] = trim($data['imei']);
            $config = configs('api');
            $url = $config['apiurl'].'/openapi/equipment/addall';
            $array = [
                'appkey' => $config['apiappkey'],
                'list' => json_encode([$data])
            ];
            $model = model('Common')->curl_post($url,$array);
            $data = json_decode($model,true);
            if($data['code'] == 200){
                adminlog();
                return json(['code'=>1,'msg'=>$data['msg']]);
            }else{
                return json(['code'=>0,'msg'=>$data['msg']]);
            }
        }else{
            return $this->fetch();
        }
    }


    /**
     * 批量增加设备
     */
    public function devicealladd()
    {
        if(request() -> isPost()){
            ignore_user_abort(true); // 后台运行
            set_time_limit(0); // 取消脚本运行时间的超时上限
            $files = trim(input('param.files'));
            $fileKey = array_keys(request()->file());
            // 获取表单上传文件
            $file = request()->file($fileKey['0']);
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'. DS . $files);
            if($info){
                $path=str_replace('\\','/',$info->getSaveName());
                $src = '/uploads/'. $files.'/'. $path;
                $fileName = ROOT_PATH. 'public' . $src;
                $str = file_get_contents($fileName);
                if(!$str){
                    if(file_exists($fileName)){
                        unset($info);
                        unlink($fileName);
                    }
                    $result['code'] = 0;
                    $result['msg'] = '文件内容格式不符合要求!';
                    return $result;
                }
                $str_encoding = mb_convert_encoding($str, 'UTF-8', 'UTF-8,GBK,GB2312,BIG5');
                $str = str_replace("\r\n",">_<",$str_encoding);
                $strs = explode('>_<', $str);
                if(is_array($strs)){
                    $string = "";
                    $list = [];
                    foreach ($strs as $key => $value){
                        $exs = explode('|',$value);
                        if(count($strs) == 1){
                            if(count($exs) != 2){
                                if(file_exists($fileName)){
                                    unset($info);
                                    unlink($fileName);
                                }
                                $result['code'] = 0;
                                $result['msg'] = '文件内容格式不符合要求!';
                                return $result;
                            }
                        }
                        if(count($exs) == 2 && is_numeric($exs[0]) && is_numeric($exs[1])){
                            $string.= $value.',';
                            $list[$key]['uid'] = $exs[0];
                            $list[$key]['imei'] = $exs[1];
                        }

                    }
                    $string = substr($string,0,-1);
                    $stringsex = count(explode(',',$string));
                    $ave =  ceil($stringsex/100);
                    $rand = array_chunk($list,$ave);
                    foreach ($rand as $ks => $vs){
                        $config = configs('api');
                        $url = $config['apiurl'].'/openapi/equipment/addall';
                        $array = [
                            'appkey' => $config['apiappkey'],
                            'list' => json_encode($vs)
                        ];
                        //try catch捕获异常
                        try{
                            $model = model('Common')->curl_post($url,$array);
                            $datas = json_decode($model,true);
                        }catch (Exception $e){
                            if(file_exists($fileName)){
                                unset($info);
                                unlink($fileName);
                            }
                            $result['code'] = 0;
                            $result['msg'] = '出现异常!';
                            return $result;
                        }
                    }

                    if($datas['code'] == 200){
                        adminlog();
                        $result['code'] = 1;
                        $result['msg'] = '上传成功!';
                        return $result;
                    }else{
                        if(file_exists($fileName)){
                            unset($info);
                            unlink($fileName);
                        }
                        $result['code'] = 0;
                        $result['msg'] = '出现异常!';
                        return $result;
                    }
                }

            }else{
                // 上传失败获取错误信息
                $result['code'] = 0;
                $result['msg'] = '上传失败!';
                return $result;
            }
        }else{
            return $this->fetch();
        }
    }

    /**
     * 下载模板文件
     */
    public function down()
    {
        if(request() -> isGet()){
            $filename = ROOT_PATH . 'public/static/file/file.txt';
            Header("Content-type: application/octet-stream");
            Header("Accept-Ranges: bytes");
            Header("Content-Length: ".filesize($filename));
            Header("Content-Disposition: attachment; filename=\"".basename($filename)."\"");
            readfile($filename);
        }
    }

    /**
     * 删除设备
     */
    public function devicedel()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $config = configs('api');
            $url = $config['apiurl'].'/openapi/equipment/delete';
            $array = [
                'appkey' => $config['apiappkey'],
                'list' => $id
            ];
            $model = model('Common')->curl_post($url,$array);
            $data = json_decode($model,true);
            if($data['code'] == 200){
                adminlog();
                return json(['code'=>1,'msg'=>$data['msg']]);
            }else{
                return json(['code'=>0,'msg'=>$data['msg']]);
            }
        }
    }

    /**
     * 获取硬件组列表
     */
    public function grouplist()
    {
        if(request() -> isPost()){
            ignore_user_abort(true); // 后台运行
            set_time_limit(0); // 取消脚本运行时间的超时上限
            $config = configs('api');
            $url = $config['apiurl'].'/openapi/equipment/getgroup?appkey='.$config['apiappkey'];
            $model = model('Common')->curl_get($url);
            $data = json_decode($model,true);
            if($data['code'] != 200){
                $data['data'] = '';
                $data['count'] = 0;
            }
            if($data['data']){
                foreach ($data['data'] as $key => $value) {
                    $data['data'][$key]['time'] = date('Y-m-d H:i:s',$value['time']);
                }
                $data['count'] = count($data['data']);
            }
            return json(['code'=>0,'data'=>$data['data'],'count'=>$data['count'],'rel'=>1,'msg'=>'获取成功!']);
        }else{
            return $this->fetch();
        }
    }

    /**
     * 增加分组
     */
    public function groupadd()
    {
        if(request() -> isPost()){
            $data = input('post.');
            $name = trim($data['name']);
            $comment = trim($data['comment']);
            $config = configs('api');
            $url = $config['apiurl'].'/openapi/equipment/group';
            $array = [
                'appkey' => $config['apiappkey'],
                'name' => $name,
                'comment' => $comment,
                'id' => 0,
            ];
            $model = model('Common')->curl_post($url,$array);
            $data = json_decode($model,true);
            if($data['code'] == 200){
                adminlog();
                return json(['code'=>1,'msg'=>'增加成功']);
            }else{
                return json(['code'=>0,'msg'=>$data['msg']]);
            }
        }else{
            return $this->fetch();
        }
    }

    /**
     * 编辑分组
     */
    public function groupedit()
    {
        if(request() -> isPost()){
            $data = input('post.');
            $id = trim($data['id']);
            $name = trim($data['name']);
            $comment = trim($data['comment']);
            $config = configs('api');
            $url = $config['apiurl'].'/openapi/equipment/group';
            $array = [
                'appkey' => $config['apiappkey'],
                'name' => $name,
                'comment' => $comment,
                'id' => $id,
            ];
            $model = model('Common')->curl_post($url,$array);
            $data = json_decode($model,true);
            if($data['code'] == 200){
                adminlog();
                return json(['code'=>1,'msg'=>'编辑成功']);
            }else{
                return json(['code'=>0,'msg'=>$data['msg']]);
            }
        }else{
            $info['id'] = input('get.id');
            $info['name'] = input('get.name');
            $info['comment'] = input('get.comment');
            $this->assign('info',$info);
            return $this->fetch();
        }
    }

    /**
     * 硬件加入分组
     */
    public function addgroups()
    {
        if(request() -> isPost()){
            $data = input('post.');
            $list = trim($data['list']);
            $group_id = trim($data['group_id']);
            $config = configs('api');
            $url = $config['apiurl'].'/openapi/equipment/joinhardware';
            $array = [
                'appkey' => $config['apiappkey'],
                'list' => $list,
                'group_id' => $group_id,
            ];
            $model = model('Common')->curl_post($url,$array);
            $data = json_decode($model,true);
            if($data['code'] == 200){
                adminlog();
                return json(['code'=>1,'msg'=>'分组成功']);
            }else{
                return json(['code'=>0,'msg'=>$data['msg']]);
            }
        }
    }

    /**
     * 设备重启
     */
    public function restart()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $data = $this->pushtask($id,2,2);
            if($data['code'] == 200){
                adminlog();
                return json(['code'=>1,'msg'=>$data['msg']]);
            }else{
                return json(['code'=>0,'msg'=>$data['msg']]);
            }
        }
    }

    /**
     * 软件升级
     */
    public function upgrade()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $datas = input('post.datas');
            ignore_user_abort(true); // 后台运行
            set_time_limit(0); // 取消脚本运行时间的超时上限
            $data = $this->pushtask($id,3,2,$datas);
            if($data['code'] == 200){
                adminlog();
                return json(['code'=>1,'msg'=>$data['msg']]);
            }else{
                return json(['code'=>0,'msg'=>$data['msg']]);
            }
        }
    }

    /**
     * 任务清空
     */
    public function emptys()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $data = $this->pushtask($id,1,2);
            ignore_user_abort(true); // 后台运行
            set_time_limit(0); // 取消脚本运行时间的超时上限
            if($data['code'] == 200){
                adminlog();
                return json(['code'=>1,'msg'=>$data['msg']]);
            }else{
                return json(['code'=>0,'msg'=>$data['msg']]);
            }
        }
    }

    /**
     * 组设备重启
     */
    public function restarts()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $data = $this->pushtask($id,2,1);
            ignore_user_abort(true); // 后台运行
            set_time_limit(0); // 取消脚本运行时间的超时上限
            if($data['code'] == 200){
                adminlog();
                return json(['code'=>1,'msg'=>$data['msg']]);
            }else{
                return json(['code'=>0,'msg'=>$data['msg']]);
            }
        }
    }

    /**
     * 组软件升级
     */
    public function upgrades()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $datas = input('post.datas');
            ignore_user_abort(true); // 后台运行
            set_time_limit(0); // 取消脚本运行时间的超时上限
            $data = $this->pushtask($id,3,1,$datas);
            if($data['code'] == 200){
                adminlog();
                return json(['code'=>1,'msg'=>$data['msg']]);
            }else{
                return json(['code'=>0,'msg'=>$data['msg']]);
            }
        }else{
            $info['id'] = input('get.id');
            $this->assign('info',$info);
            return $this->fetch();
        }
    }

    /**
     * 组任务清空
     */
    public function cleanemptys()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $data = $this->pushtask($id,1,1);
            ignore_user_abort(true); // 后台运行
            set_time_limit(0); // 取消脚本运行时间的超时上限
            if($data['code'] == 200){
                adminlog();
                return json(['code'=>1,'msg'=>$data['msg']]);
            }else{
                return json(['code'=>0,'msg'=>$data['msg']]);
            }
        }
    }

    /**
     * 硬件批量重启/软件更新/任务清空
     * type:1组2指定硬件
     * data:
     * id:type等于1    数据格式:1;type等于2    数据格式:1,3,6,5,47
     * data字段内容:{
                    "platform": "all",
                    "module": "task",
                    "type": 1, //1清空,2重启,3下载安装
                    "state": 1,
                    "datas": [
                    "http://www.baidu.com"//type为3时才会有本数据
                    ]
                }
     * $id:      type等于1    数据格式:1;type等于2    数据格式:1,3,6,5,47
     * $types:   1清空,2重启,3下载安装
     * $type:    1组2指定硬件
     * $datas    type为3时才会有本数据
     */

    public function pushtask($id,$types,$type,$datas="")
    {
        $config = configs('api');
        $url = $config['apiurl'].'/openapi/equipment/pushtask';
        $arr['platform'] = 'all';
        $arr['module'] = 'task';
        $arr['type'] = $types;
        $arr['state'] = 1;
        $arr['datas'] = [$datas];
        $arr = json_encode($arr);
        $array = [
            'appkey' => $config['apiappkey'],
            'type' => $type,
            'data' => $arr,
            'id' => $id
        ];
        try{
            $model = model('Common')->curl_post($url,$array);
            $data = json_decode($model,true);
            return $data;
        }catch (Exception $e){
            $result['code'] = 0;
            $result['msg'] = '出现异常!';
            return $result;
        }
    }

    public function index()
    {
        $file = "3b6493d44e3649ed4465877043bfb83a.png";
        $a = explode('.',$file);
       $a = array_pop($a);

        dump($a);


    }






}