<?php
/**
 * 千帆相关
 *
 * @author andery
 */
namespace Qianfanyunapp\qscmslib;
class qianfanyunapp {
    private static $getUserInfoUrl = "http://{hostname}.qianfanapi.com/api1_2/user/user-info";
    private static $loginUrl = "http://{hostname}.qianfanapi.com/api1_2/cookie/auth-code";
    private static $_error;
    public function is_login(){
        if(!C('qscms_qianfanyunapp_secret')){
            self::$_error = '请配置千帆secret';
            return false;
        }
        if(!C('qscms_qianfanyunapp_hostname')){
            self::$_error = '请配置千帆主机名';
            return false;
        }
        $data = array('wap_token'=>cookie('wap_token'),'secret_key'=>C('qscms_qianfanyunapp_secret'));
        if(false !== $reg = self::https_request(C('qscms_qianfanyunapp_secret'),str_replace('{hostname}',C('qscms_qianfanyunapp_hostname'),self::$loginUrl),array(),$data)){
            $reg = json_decode($reg,true);
            if($reg['uid']){
                return $reg['uid'];
            }
            return false;
        }else{
            self::$_error = '请开启curl服务';
            return false;
        }
    }
    /**
     * [get_user_info 获取千帆用户信息]
     */
    public function get_user_info($uid){
        if(!C('qscms_qianfanyunapp_secret')){
            self::$_error = '请配置千帆secret';
            return false;
        }
        if(!C('qscms_qianfanyunapp_hostname')){
            self::$_error = '请配置千帆主机名';
            return false;
        }
        $data['user_ids'] = $uid;
        if(false !== $reg = self::https_request(C('qscms_qianfanyunapp_secret'),str_replace('{hostname}',C('qscms_qianfanyunapp_hostname'),self::$getUserInfoUrl),$data)){
            $reg = json_decode($reg,true);
            if($user = $reg['data'][$uid]){
                $userInfo = array(
                    'type'=>'qianfanyunapp',
                    'username'=>$user['user_name'],
                    'keyavatar_big'=>$user['user_icon'],
                    'keyid'=>C('qscms_qianfanyunapp_hostname').$user['id']
                );
                $userInfo['bind_info'] = serialize($userInfo);
                cookie('members_bind_info', $userInfo);
                return $userInfo;
            }else{
                return false;
            }
        }else{
            self::$_error = '请开启curl服务';
            return false;
        }
    }
    public function https_request($secret_key, $url, $get_params = array(), $post_data = array()){
        if(function_exists('curl_init')){
            $nonce         = rand(10000, 99999);
            $timestamp  = time();
            $array = array($nonce, $timestamp, $secret_key);
            sort($array, SORT_STRING);
            $token = md5(implode($array));
            $params['nonce'] = $nonce;
            $params['timestamp'] = $timestamp;
            $params['token']     = $token;
            $params = array_merge($params,$get_params);  
            $url .= '?';
            foreach ($params as $k => $v) 
            {
                $url .= $k .'='. $v . '&';
            }
            $url = rtrim($url,'&');   
            $curlHandle = curl_init();
            curl_setopt($curlHandle, CURLOPT_URL, $url);   
            curl_setopt($curlHandle, CURLOPT_HEADER, 0);   
            curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);  
            curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, false);  
            curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, FALSE);   
            curl_setopt($curlHandle, CURLOPT_POST, count($post_data));  
            curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $post_data);  
            $data = curl_exec($curlHandle);    
            $status = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);
            curl_close($curlHandle);    
            return $data;
        }else{
            return false;
        }
    }
    /**
     * 错误
     */
    public function getError(){
        return self::$_error;
    }
}