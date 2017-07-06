<?php

namespace app\admin\controller;
use app\admin\model\Log as Log_model;
class System extends Base
{
    public function log(){
        $res = Log_model::all();
        $this->assign('res', $res);
        return $this->fetch('system-log');
    }
}