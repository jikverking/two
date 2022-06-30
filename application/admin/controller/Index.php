<?php
namespace app\admin\controller;
use think\Db;
class Index extends Common 
{

    public function index()
    {
        $admin = db('admin')->field('loginnum')->where('adminid',session('adminid'))->find();
        //系统信息
        $version = Db::query('SELECT VERSION() AS ver');

        $config = [
            'url'             => $_SERVER['HTTP_HOST'],
            'document_root'   => $_SERVER['DOCUMENT_ROOT'],
            'server_os'       => PHP_OS,
            'server_port'     => $_SERVER['SERVER_PORT'],
            'server_ip'       => $_SERVER['SERVER_ADDR'],
            'server_soft'     => $_SERVER['SERVER_SOFTWARE'],
            'php_version'     => PHP_VERSION,
            'mysql_version'   => $version[0]['ver'],
            'logintime'       => date('Y-m-d H:i:s',session('logintime')),
            'loginnum'        => $admin['loginnum'],
        ];

        /**
         * 全部设备 -1全部1在线0离线
         */
        //$device['all'] = $this->device(-1);
        $device['all'] = 0;

        /**
         * 在线设备
         */
       // $device['online'] = $this->device(1);
        $device['online'] = 0;

        /**
         * 离线设备
         */
        //$device['offline'] = $this->device(0);
        $device['offline'] = 0;


        //账号管理
        $list = counts('trill_account','addtime');

        /**
         * 平台数据统计
         */


        /**
         * 订单列表
         */


        if(request() -> isPost()){
            $map = [];
            $key = trim(input('post.key'));

            
            $map['tel'] = ['like','%'.$key.'%'];
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):10;
            //使用状态
            // $statu = input('post.statu');
            // if(is_numeric($statu)){
            //     $map['statu'] = $statu;
            // }
            // $starttime = trim(input('post.starttime'));
            // $endtime = trim(input('post.endtime'));
            // if(!empty($starttime)){
            //     $map['addtime'] = array('elt', strtotime($starttime));
            // }
            // if(!empty($endtime)){
            //     $map['addtime'] = array('elt',strtotime($endtime));
            // }
            // if(!empty($starttime) && !empty($endtime)){
            //     $starttime = strtotime($starttime);
            //     $endtime = strtotime($endtime);
            //     $map['addtime'] = array('between', [$starttime, $endtime]);
            // }




            if ($key) {

               // dump();
                 $list = db('order')
                -> where($map)
                -> order('order_id desc')
                -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                -> toArray();
            }else{
                          $list = db('order')
               // -> where($map)
                -> order('order_id desc')
                -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                -> toArray();
            }




            // if($list['data']){
            //     foreach ($list['data'] as $key => $value) {
            //         $list['data'][$key]['addtime'] = date('Y-m-d H:i:s',$value['addtime']);
            //     }
            // }
            return json(['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1,'datas'=>Db::getLastSql()]);
        }




        $infos['usercount'] = db('user')->count();
        $infos['usertoday'] = db('user') ->whereTime('addtime', 'today')->count();


         $infos['ordermonth'] = db('order')->whereTime('add_time_sjc', 'month')->count(); 
         $infos['orderweek'] = db('order')->whereTime('add_time_sjc', 'week')->count(); 

         $infos['vipmonth'] = db('vip')->whereTime('date_sjc', 'month')->count(); 
        // dump($infos['ordermonth']);die;
         $infos['viprweek'] = db('vip')->whereTime('date_sjc', 'week')->count(); 
    //   dump($dd);die;
         $infos['orderzl'] = db('order')->count();
         $infos['vipzl'] = db('vip')->count();
$infos['vip_orderlis'] = db('order')->where('tel','neq','')->count();
$infos['no_vip_orderlis'] = db('order')->where('tel','null')->count();

 //dump($infos);die;
        $this->assign('infos',$infos);
        $this->assign('list',$list);
        $this->assign('device',$device);
        $this->assign('config',$config);
        return $this->fetch();
    }

    public function viplist()
    {

        if(request() -> isPost()){
            $map = [];
            $key = trim(input('post.keys'));
            $map['tel'] = ['like','%'.$key.'%'];
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):10;
   
            // }
            $list = db('vip')
                -> where($map)
                -> order('hyid desc')
                -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                -> toArray();

            return json(['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1,'datas'=>Db::getLastSql()]);
        }
    }

    /**
     * 图表主页
     */
    public function chart()
    {
        //账号管理
        $list = counts('trill_account','addtime');
        $this->assign('list',$list);
        return $this->fetch();
    }

    /**
     * 设备列表
     */
    public function device($type)
    {
        $config = configs('api');
        $url = $config['apiurl'].'/openapi/equipment/list';
        $array = [
            'appkey' => $config['apiappkey'],
            'limit' => 10,
            'page' => 1,
            'type' => $type,
        ];
        //$model = model('Common')->curl_post($url,$array);
        $model = model('Common')->curl_post($url,$array);
        $data = json_decode($model,true);
        if($data['code'] != 200){
            $data['count'] = 0;
        }else{
            $data['count'] = $data['count'];
        }
        return $data['count'];
    }

    public function indexs()
    {
    	$str = "/layuiadmin/public/index.php/admin/wechat/menu.html";
    	echo substr($str,strpos($str, '/admin/')+7);
    	
        return $this->fetch();
    }
    
    //清除缓存
    public function clear()
    {
        $dir = '../runtime';   
        deleteDir($dir);
        adminlog();
        return json(['code' => 1, 'msg' => '清除成功']);
        /*$this->success('清除成功','admin/index/index',0,1);*/
    }

    public function no()
    {
        return $this->fetch('public/no');
    }
}
