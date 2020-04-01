<?php
namespace app\controller;
use app\BaseController;

class Test extends BaseController
{
    public function index(){
        //返回实际路径
        echo '当前方法名为：'.$this->request->action().'<br />';
        echo '当前实际路径：'.$this->app->getBasePath();
    }

    public function rearray(){
        $arr = array('a'=>'a', 'b'=>'b');
        halt("中断输出");
        return json($arr);
    }
}