<?php
/**
 * 采集安装程序
 */
class ResumeimportSetup{
	/**
     * [init 安装程序初始化程序]
     */
    public function setup_init(){
        if(false === $apply = F('apply_info_list')) $apply = D('Apply')->apply_info_cache();
        if($apply['Home']['version']){
            $version =  explode('.', $apply['Home']['version']);
            $v = $version[0] * 1000000 + $version[1] * 10000 + $version[2];
            if($v >= 4020111) return true;
            $this->_error = '请将基础版程序升级至4.2.111版本以上（含）！';
            return false;
        }
        return true;
    }
    /**
	 * [setup 安装程序]
	 */
    public function setup(){
        //初始化附件添加
        $org = APP_PATH.'Resumeimport/Install/attach/';
		
        $xls = 'excelmodel.xls';
        $path = C('qscms_attach_path').'resumeimport/';
		if (!is_dir($path)) mkdir($path,0755,true);
		copy($org.$xls,$path.$xls);
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
    public function unload(){
    	//D('Navigation')->where(array('pagealias'=>'QS_locoyspider'))->delete();
		return true;
    }
    /**
     * [getError 返回错误]
     */
    public function getError(){
        return $this->_error;
    }
}
?>