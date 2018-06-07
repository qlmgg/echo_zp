<?php
/**
 * 千帆APP安装程序
 */
class QianfanyunappSetup{
	/**
	 * [setup_init 安装程序初始化程序]
	 */
	public function setup_init(){
        if(false === $apply = F('apply_info_list')) $apply = D('Apply')->apply_info_cache();
        if($apply['Home']['version']){
            $version =  explode('.', $apply['Home']['version']);
            $v = $version[0] * 1000000 + $version[1] * 10000 + $version[2];
            if($v < 4020111){
                $this->_error = '请将基础版程序升级至4.2.111版本以上（含）！';
                return false;
            }
        }
        if(!$apply['Mobile']){
            $this->_error = '请先安装触屏端应用！';
            return false;
        }else{
            $version =  explode('.', $apply['Mobile']['version']);
            $v = $version[0] * 1000000 + $version[1] * 10000 + $version[2];
            if($v < 4020088){
                $this->_error = '请将触屏版程序升级至4.2.88版本以上（含）！';
                return false;
            }
        }
		return true;
	}
	/**
	 * [setup 安装程序]
	 */
    public function setup(){
        $path = APP_PATH.'Admin/View/default/public/images/menu/';
        if (!is_dir($path)) mkdir($path,0755,true);
        $org = APP_PATH.'Qianfanyunapp/Install/attach/qianfanyunapp.png';
        $path.='qianfanyunapp.png';
        copy($org,$path);
        return true;
    }
    /**
     * [init 安装程序初始化程序]
     */
    public function unload_init(){
        return true;
    }
    /**
     * [unload 卸载程序]
     */
    public function unload(){}
    /**
     * [getError 返回错误]
     */
    public function getError(){
    	return $this->_error;
    }
}
?>