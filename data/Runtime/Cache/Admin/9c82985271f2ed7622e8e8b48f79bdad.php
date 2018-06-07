<?php if (!defined('THINK_PATH')) exit();?><!-- public:header 以下内容 -->
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>网站后台管理中心- Powered by 74cms.com</title>
	<link rel="shortcut icon" href="<?php echo C('qscms_site_dir');?>favicon.ico"/>
	<meta name="author" content="骑士CMS" />
	<meta name="copyright" content="74cms.com" />
	<link href="__ADMINPUBLIC__/css/common.css" rel="stylesheet" type="text/css">
	<script src="__ADMINPUBLIC__/js/jquery.min.js"></script>
	<script src="__ADMINPUBLIC__/js/jquery.highlight-3.js"></script>
	<script src="__ADMINPUBLIC__/js/jquery.vtip-min.js"></script>
	<script src="__ADMINPUBLIC__/js/jquery.modal.dialog.js"></script>
	<!--[if lt IE 9]>
	<script type="text/javascript" src="__ADMINPUBLIC__/js/PIE.js"></script>
	<script type="text/javascript">
		(function ($) {
			$.pie = function (name, v) {
				// 如果没有加载 PIE 则直接终止
				if (!PIE) return false;
				// 是否 jQuery 对象或者选择器名称
				var obj = typeof name == 'object' ? name : $(name);
				// 指定运行插件的 IE 浏览器版本
				var version = 9;
				// 未指定则默认使用 ie10 以下全兼容模式
				if (typeof v != 'number' && v < 9) {
					version = v;
				}
				// 可对指定的多个 jQuery 对象进行样式兼容
				if ($.browser.msie && obj.size() > 0) {
					if ($.browser.version * 1 <= version * 1) {
						obj.each(function () {
							PIE.attach(this);
						});
					}
				}
			}
		})(jQuery);
		if ($.browser.msie) {
			$.pie('.pie_about');
		};
	</script>
	<![endif]-->
	<script src="__ADMINPUBLIC__/js/jquery.disappear.tooltip.js"></script>
	<script src="__ADMINPUBLIC__/js/common.js"></script>
	<script>
		var URL = '/index.php/admin/apply',
			SELF = '/index.php?m=admin&amp;c=apply&amp;a=updater&amp;mod=Weixin',
			ROOT_PATH = '/index.php/admin',
			APP	 =	 '/index.php';

		var qscms = {
			is_subsite : <?php if($apply['Subsite'] and C('SUBSITE_VAL.s_id') > 0): ?>1<?php else: ?>0<?php endif; ?>,
			subsite_level : "<?php if($apply['Subsite'] and C('SUBSITE_VAL.s_id') > 0): echo C('SUBSITE_VAL.s_level'); else: echo C('qscms_category_district_level'); endif; ?>",
			default_district : "<?php if($apply['Subsite'] and C('SUBSITE_VAL.s_id') > 0): echo C('qscms_default_district'); else: echo C('SUBSITE_VAL.s_default_district'); endif; ?>"
		};
	</script>
	<?php echo ($synsitegroupunbindmobile); ?>
	<?php echo ($synsitegroupregister); ?>
	<?php echo ($synsitegroupedit); ?>
	<?php echo ($synsitegroup); ?>
</head>
<body>

<!-- public:header 以上内容 -->
<?php if(empty($menu_title)): ?><div class="allpagetop">后台管理中心<strong>/</strong>首页</div>
	<?php else: ?>
	<div class="allpagetop"><?php echo ($menu_title); ?><strong>/</strong><?php echo ($sub_menu_title); ?></div><?php endif; ?>
<div class="mains">
	<div class="h1tit">
		<div class="h1">
            <?php if($sub_menu['pageheader']): echo ($sub_menu["pageheader"]); ?>
                <?php else: ?>
                <!--欢迎登录 <?php echo C('qscms_site_name');?> 管理中心！--><?php endif; ?>
        </div>
        <?php if(!empty($sub_menu['menu'])): ?><div class="topnav">
                <?php if(is_array($sub_menu['menu'])): $i = 0; $__LIST__ = $sub_menu['menu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><a href="<?php echo U($val['module_name'].'/'.$val['controller_name'].'/'.$val['action_name']); echo ($val["data"]); if($isget and $_GET): echo get_first(); endif; if($_GET['_k_v']): ?>&_k_v=<?php echo (_I($_GET['_k_v'])); endif; ?>" class="<?php echo ($val["class"]); ?>"><?php echo ($val["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                <div class="clear"></div>
            </div><?php endif; ?>
		<div class="clear"></div>
	</div>
  <div class="toptip link_g">
    <div class="toptit">提示：</div>
    <p>系统检测 “<strong><?php echo ($module["version"]["module_name"]); ?></strong>” 已经安装，当前版本号为 <strong>[<?php echo ($module["version"]["version"]); ?>]</strong> ，<span class="J_tip">已是最新版本</span></p>
    <p>
      <font color="red">在线升级仅适用于原版程序，二次开发过的程序升级会出现不可预估的错误，请谨慎操作。</font>
    </p>
    <p>
      <font color="red">
      对于非原版程序升级造成的所有问题我们无法提供错误修正服务。
      </font>
    </p>
    <p>
      <font color="red">
      大版本文件升级可能会出现等待时间较长，页面假死现象，请耐心等待，不要关闭页面。中断升级会出现严重错误。</font>
    </p>
    <p>
      <font color="red">
      升级成功后请退出后台重新登录，如遇页面样式错乱请按Ctrl+F5强制刷新页面即可恢复。
      </font>
    </p>
  </div>
  <div class="toptit">应用详情</div>
  <table width="800"  border="0" cellpadding="2" cellspacing="2"  class="apply_show" style="margin-bottom:15px;" >
    <tr>
      <td width="80" align="center">
        <img src="<?php echo ($module["ico"]); ?>" border="0" width="58" height="58">
      </td>
      <td style="line-height:230%;color:#999999" class="J_mod" m="<?php echo ($module["module"]); ?>" v="<?php echo ($module["version"]["version"]); ?>">
      <strong style="color: #0066CC; font-size:14px; padding-right:10px;"><?php echo ($module["version"]["module_name"]); ?></strong>（<?php echo ($module["module"]); ?>）&nbsp;&nbsp;&nbsp;
      <span class="J_v">当前版本：<?php echo ($module["version"]["version"]); ?></span>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<span class="J_t">更新时间：<?php echo ($module['version']['update_time']); ?></span><br />
      <?php echo ($module["version"]["explain"]); ?>
      </td>
    </tr>
</table>
  <form id="J_install_form" action="<?php echo U('apply/updater');?>" method="post">
  <div id="J_install_process" style="display:none">
    <div class="toptit">升级进程</div>
    <div id="J_process" style="padding:20px; padding-top:10px; height:160px;overflow:auto;margin-bottom: 10px;"></div>
    <input name="mod" value="<?php echo ($module["module"]); ?>" type="hidden">
    <input name="type" value="0" type="hidden">
    <iframe src="about:blank" style="width:500px; height:300px;display:none;" name="post_target"></iframe>
  </div>
  <div id="J_form" class="form_main width100" <?php if($need_check_auth == 0): ?>style="display:none;"<?php endif; ?>>
    <div class="fl">授权域名：</div>
    <div class="fr">
      <input name="username" type="text" class="input_text_default middle" maxlength="45" value="" placeholder="请输入手机号或授权域名" />
    </div>
    <div class="fl">密码：</div>
    <div class="fr">
      <input name="password" type="password" class="input_text_default middle" maxlength="100" value="" placeholder="请输入密码（如果忘记密码请联系官方客服获取）" />
    </div>
  </div>
  </form>
  <table width="100%" border="0" cellspacing="10"  class="">
    <tr id="J_run">
      <td>
        <input type="button" class="admin_submit" id="UpdaterBtn" value="开始升级" onclick="getlog();" style="display:none"/>
        <input type="button" class="admin_submit" value="返回"  onclick="window.location='<?php echo U('apply/index');?>'"/>
      </td>
    </tr>
    <tr id="J_end" style="display:none">
      <td>
        <input type="button" class="admin_submit" value="升级完成"  onclick="window.location='<?php echo U('apply/index');?>'"/>
      </td>
    </tr>
  </table>
</div>
<div id="QSdialog" style="display:none">
  <div class="J_logWrap" style="width:500px;height:300px;overflow-y:auto"></div>
  <table width="100%" border="0" cellspacing="10"  class="admin_list_btm">
        <tr>
            <td align="right">
              <input name="ButSave" type="submit" class="admin_submit" id="ButSave" value="确定" onclick="updater();"/>
                <input name="ButADD" type="button" class="DialogClose admin_submit" id="ButADD" value="取消"/>
            </td>
        </tr>
    </table>  
</div>
<!-- public:footer 以下内容 -->
<div class="footer link_blue">
    Powered by <a href="http://www.74cms.com" target="_blank"><span style="color:#009900">74</span><span
        style="color: #FF3300">cms</span></a> v<?php echo C('QSCMS_VERSION');?>
</div>
<!-- public:footer 以上内容 -->
<script>
  function getlog(){
    var s = document.createElement('script');
      s.type = 'text/javascript';
      s.src = "http://www.74cms.com/plus/check_module.php?act=module_log&module=<?php echo ($module["module"]); ?>|<?php echo ($module["version"]["version"]); ?>";
    var tmp = document.getElementsByTagName('script')[0];
    tmp.parentNode.insertBefore(s, tmp);
  }
  function updater(){
    $('#J_process').empty();
    $('#J_install_process').show();
    $('#J_install_form').attr('target','post_target');
      $('#J_install_form').submit();
      $('#J_run').hide();
      $('#J_form').hide();
  }
  function show_process(html){
      $('#J_process').html($('#J_process').html() + html);
      var _t = $('#J_process').get(0);
      _t.scrollTop = _t.scrollHeight;
  }
  function install_failure(){
      $('#J_run').show();
  }
  function install_successed(){
      $('#J_end').show();
  }
  function install_updater_auth(a){
    window.location.href=a;
  }
  function callback(a){
      $.each(a.data,function(k,v){
      var version = $('.J_mod[m="'+k+'"]').attr('v');
      if(v.version && version != v.version){
        v.update_time = v.update_time ? v.update_time : '未发布';
        $('.J_mod[m="'+k+'"] .J_v').after('<a href="http://www.74cms.com/app/lists.html" class="newsv">有新版</a>');
        $('.J_mod[m="'+k+'"] .J_t').html('更新时间：'+v.update_time);
        $('.J_tip').html('最新版本号为 <strong>['+v.version+']</strong>');
        $('#UpdaterBtn').show();
      }
      });
  }
  function calllog(a){
    if(a.status == 1){
      // $('#QSdialog .J_logWrap').html(decodeURIComponent(a.data.replace(/\+/g, '%20'))).click();
      var qsDialog = $(this).dialog({
          title: '升级内容',
          loading: true,
          footer : true,
          //btnNum:3,
          btns: ['逐条升级', '取消'],
          yes: function () {
              $('input[name="type"]').val(1);
              updater();
          }//,
          //other: function () {
          //    updater();
          //}
      });
      var url = "<?php echo U('update_content');?>";
      $.post(url, {content:decodeURIComponent(a.data.replace(/\+/g, '%20'))},function (result) {
          qsDialog.setContent(result.data);
      },'json');
    }else{
      alert(decodeURIComponent(a.msg));
    }
  }

  
</script>
<script src="http://www.74cms.com/plus/check_module.php?module_name=<?php echo ($module["module"]); ?>" language="javascript"></script>
</body>
</html>