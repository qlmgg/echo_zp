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
			SELF = '/index.php?m=admin&amp;c=apply&amp;a=details&amp;mod=Qianfanyunapp',
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
<div class="toptit">应用详情</div>
<table width="800" border="0" cellpadding="2" cellspacing="2" class="apply_show"
       style="margin-bottom:15px;padding-left: 10px;">
    <tr>
        <td width="80" align="center">
            <img src="<?php echo ($module["ico"]); ?>" border="0" width="58" height="58">
        </td>
        <td width="400" style="line-height:230%;color:#999999" class="J_mod" m="<?php echo ($module["module"]); ?>"
            v="<?php echo ($module["version"]["version"]); ?>">
            <strong style="color: #0066CC; font-size:14px; padding-right:10px;"><?php echo ($module["version"]["module_name"]); ?></strong>（<?php echo ($module["module"]); ?>）
            <br/>
            <span class="J_v">版本：<?php echo ($module["version"]["version"]); ?></span>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<span class="J_t">更新时间：<?php echo ($module["version"]["update_time"]); ?></span>
        </td>
        <td>
            <?php if($module['module'] != 'Home'): if($module['is_setup']): ?><input type="button" class="apply_btn uninstall" value="卸载"
                           onclick="window.location='<?php echo U('apply/unload',array('mod'=>$module['module']));?>'"/>
                    <?php else: ?>
                    <input type="button" class="apply_btn" value="安装"
                           onclick="window.location='<?php echo U('apply/setup',array('mod'=>$module['module']));?>'"/><?php endif; endif; ?>
        </td>
    </tr>
</table>
<div class="toptit">详细介绍</div>
<table width="850" border="0" cellpadding="10" cellspacing="2" style="margin-bottom:15px;padding-left: 30px;">
    <tr>
        <td><?php echo ($module["version"]["explain"]); ?></td>
    </tr>
</table>
<div class="toptit">更新日志</div>
<table width="850" border="0" cellpadding="10" cellspacing="2" style="margin-bottom:15px;padding-left: 30px;">
    <tr>
        <td><?php echo ($module["versioning"]); ?></td>
    </tr>
</table>
<div class="list_foot">
    <div class="btnbox">
        <input type="button" class="admin_submit" value="返回" onclick="window.location='<?php echo U('apply/index');?>'"/>
    </div>
</div>
</div>
<!-- public:footer 以下内容 -->
<div class="footer link_blue">
    Powered by <a href="http://www.74cms.com" target="_blank"><span style="color:#009900">74</span><span
        style="color: #FF3300">cms</span></a> v<?php echo C('QSCMS_VERSION');?>
</div>
<!-- public:footer 以上内容 -->
<script type="text/javascript">
    function callback(a) {
        $.each(a.data, function (k, v) {
            var version = $('.J_mod[m="' + k + '"]').attr('v');
            if (v.version && version != v.version) {
                v.update_time = v.update_time ? v.update_time : '未发布';
                $('.J_mod[m="' + k + '"] .J_v').after('<a href="http://www.74cms.com/app/lists.html" class="newsv">有新版</a>');
                $('.J_mod[m="' + k + '"] .J_t').html('更新时间：' + v.update_time);
            }
        });
    }
</script>
<script src="http://www.74cms.com/plus/check_module.php?module_name=<?php echo ($module["module"]); ?>" language="javascript"></script>
</body>
</html>