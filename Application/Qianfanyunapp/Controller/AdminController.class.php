<?php
namespace Qianfanyunapp\Controller;
use Common\Controller\ConfigbaseController;
class AdminController extends ConfigbaseController{
	public function _initialize() {
        parent::_initialize();
    }
    public function index(){
        $this->_edit();
        $this->display();
    }
}
?>