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
		var URL = '/index.php/admin/weixin',
			SELF = '/index.php?m=admin&amp;c=weixin&amp;a=index',
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
    <div class="toptip">
        <div class="toptit">提示：</div>
        <p>网站接入微信公众平台后，用户只需要使用微信扫描二维码就可登录，简化用户登录注册流程，更有效率的提高转化用户流量；</p>
        <p class="link_green_line">设置微信公众平台前，网站需首先进行申请，获得对应的AppToken、AppId、AppSecret，以保证后续流程中可正确对网站与用户进行验证与授权。现在就去<a href="https://mp.weixin.qq.com/" target="_blank">申请</a></p>
        <p>创建自定义菜单后，由于微信客户端缓存，需要24小时微信客户端才会展现出来。建议测试时可以尝试取消关注公众账号后再次关注，则可以看到创建后的效果。</p>
    </div>
    <div class="toptit">微信公众平台设置</div>
  <form action="<?php echo U('weixin/index');?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
        <div class="form_main width200">
            <div class="fl">开启微信公众平台：</div>
            <div class="fr">
                <div data-code="0,1" class="imgchecked_small <?php if(C('qscms_weixin_apiopen') == 1): ?>select<?php endif; ?>"><input name="weixin_apiopen" type="hidden" value="<?php echo C('qscms_weixin_apiopen');?>" /></div>
                <div class="clear"></div>
            </div>
            <div class="fl">AppToken：</div>
            <div class="fr">
                <input name="weixin_apptoken" type="text" class="input_text_default" value="<?php echo C('qscms_weixin_apptoken');?>"/>
            </div>
            <div class="fl">AppId：</div>
            <div class="fr">
                <input name="weixin_appid" type="text" class="input_text_default" value="<?php echo C('qscms_weixin_appid');?>"/>
            </div>
            <div class="fl">AppSecret：</div>
            <div class="fr">
                <input name="weixin_appsecret" type="text" class="input_text_default" value="<?php echo C('qscms_weixin_appsecret');?>"/>
            </div>
            <div class="fl">EncodingAESKey：</div>
            <div class="fr">
                <input name="weixin_encoding_aes_key" type="text" class="input_text_default middle" value="<?php echo C('qscms_weixin_encoding_aes_key');?>"/>
                <label class="no-fl-note">(消息加解密密钥)</label>
            </div>
            <div class="fl">公众号名称：</div>
            <div class="fr">
                <input name="weixin_mpname" type="text" class="input_text_default" value="<?php echo C('qscms_weixin_mpname');?>"/>
            </div>
            <div class="fl">微信号：</div>
            <div class="fr">
                <input name="weixin_mpnumber" type="text" class="input_text_default" value="<?php echo C('qscms_weixin_mpnumber');?>"/>
            </div>
            <div class="fl">微信二维码图片：</div>
            <div class="fr J-file-input-box">
                <?php if(C('qscms_weixin_img')): ?><div class="file-input-src">
                        <div class="img"><img src="<?php echo attach(C('qscms_weixin_img'),'resource');?>?_t=<?php echo time();?>" align=absmiddle></div>
                        <div class="del file-input-del" id="J_upload_weixin_img_btn" name="weixin_img">点击更换</div>
                    </div>
                <?php else: ?>
                    <div class="file-input-src hid">
                        <div class="img"></div>
                        <div class="del file-input-del" id="" name="weixin_img">点击更换</div>
                    </div>
                    <div class="file-input-block" id="J_upload_weixin_img_btn" name="weixin_img"><span class="o-txt">上传</span>微信二维码图片</div><?php endif; ?>
                <input type="hidden" class="file-input-save-name" name="weixin_img" value="<?php echo C('qscms_weixin_img');?>">
            </div>
            <div class="fl">微信头条信息大图：</div>
            <div class="fr J-file-input-box">
                <?php if(C('qscms_weixin_first_pic')): ?><div class="file-input-src">
                        <div class="img"><img src="<?php echo attach(C('qscms_weixin_first_pic'),'resource');?>?_t=<?php echo time();?>" align=absmiddle></div>
                        <div class="del file-input-del" id="J_upload_weixin_first_pic_btn" name="weixin_first_pic">点击更换</div>
                        <div class="r-note">(建议尺寸360 x 200)</div>
                    </div>
                <?php else: ?>
                    <div class="file-input-src hid">
                        <div class="img"></div>
                        <div class="del file-input-del" id="" name="weixin_first_pic">点击更换</div>
                        <div class="r-note">(建议尺寸360 x 200)</div>
                    </div>
                    <div class="file-input-block" id="J_upload_weixin_first_pic_btn" name="weixin_first_pic" ><span class="o-txt">上传</span>微信头条信息大图<span class="re-txt">(建议尺寸360 x 200)</span></div><?php endif; ?>
                <input type="hidden" class="file-input-save-name" name="weixin_first_pic" value="<?php echo C('qscms_weixin_first_pic');?>">
            </div>
            <div class="fl"></div>
            <div class="fr">
                <input type="submit" class="admin_submit" value="保存"/>
            </div>
            <div class="clear"></div>
        </div>
  </form>
</div>
<!-- public:footer 以下内容 -->
<div class="footer link_blue">
    Powered by <a href="http://www.74cms.com" target="_blank"><span style="color:#009900">74</span><span
        style="color: #FF3300">cms</span></a> v<?php echo C('QSCMS_VERSION');?>
</div>
<!-- public:footer 以上内容 -->
<script type="text/javascript">
  var uploadUrl = "<?php echo U('Upload/form_upload');?>";
</script>
<script src="__ADMINPUBLIC__/js/ajaxfileupload.js"></script>
<script src="__ADMINPUBLIC__/js/fileupload.js"></script>
<script>
  // 微信二维码图片
  $.upload('#J_upload_weixin_img_btn',{name:'weixin_img',dir:'resource'},function(result){
    if(result.error == 1){
      var htmlResult = '<img src="'+ result.url.src +'" align=absmiddle>';
      $('#J_upload_weixin_img_btn').closest('.J-file-input-box').find('.file-input-src .img').html(htmlResult);
      $('#J_upload_weixin_img_btn').closest('.J-file-input-box').find('.file-input-save-name').val(result.url.savename);
      if ($('#J_upload_weixin_img_btn').hasClass('file-input-block')) {
        $('#J_upload_weixin_img_btn').closest('.J-file-input-box').find('.file-input-src').removeClass('hid');
        var $delObj = $('#J_upload_weixin_img_btn').closest('.J-file-input-box').find('.file-input-del');
        $('#J_upload_weixin_img_btn').remove();
        $delObj.attr('id', "J_upload_weixin_img_change_btn");
        $.upload('#J_upload_weixin_img_change_btn',{name:'weixin_img',dir:'resource'},function(result){
          if(result.error == 1){
            var htmlResult = '<img src="'+ result.url.src +'" align=absmiddle>';
            $('#J_upload_weixin_img_change_btn').closest('.J-file-input-box').find('.file-input-src .img').html(htmlResult);
            $('#J_upload_weixin_img_change_btn').closest('.J-file-input-box').find('.file-input-save-name').val(result.url.savename);
          } else {
            disapperTooltip("remind", "上传失败："+result.message);
          }
        })
      }
    } else {
      disapperTooltip("remind", "上传失败："+result.message);
    }
  })
  // 微信头条信息大图
  $.upload('#J_upload_weixin_first_pic_btn',{name:'weixin_first_pic',dir:'resource'},function(result){
    if(result.error == 1){
      var htmlResult = '<img src="'+ result.url.src +'" align=absmiddle>';
      $('#J_upload_weixin_first_pic_btn').closest('.J-file-input-box').find('.file-input-src .img').html(htmlResult);
      $('#J_upload_weixin_first_pic_btn').closest('.J-file-input-box').find('.file-input-save-name').val(result.url.savename);
      if ($('#J_upload_weixin_first_pic_btn').hasClass('file-input-block')) {
        $('#J_upload_weixin_first_pic_btn').closest('.J-file-input-box').find('.file-input-src').removeClass('hid');
        var $delObj = $('#J_upload_weixin_first_pic_btn').closest('.J-file-input-box').find('.file-input-del');
        $('#J_upload_weixin_first_pic_btn').remove();
        $delObj.attr('id', "J_upload_weixin_first_pic_change_btn");
        $.upload('#J_upload_weixin_first_pic_change_btn',{name:'weixin_first_pic',dir:'resource'},function(result){
          if(result.error == 1){
            var htmlResult = '<img src="'+ result.url.src +'" align=absmiddle>';
            $('#J_upload_weixin_first_pic_change_btn').closest('.J-file-input-box').find('.file-input-src .img').html(htmlResult);
            $('#J_upload_weixin_first_pic_change_btn').closest('.J-file-input-box').find('.file-input-save-name').val(result.url.savename);
          } else {
            disapperTooltip("remind", "上传失败："+result.message);
          }
        })
      }
    } else {
      disapperTooltip("remind", "上传失败："+result.message);
    }
  })
</script>
</body>
</html>