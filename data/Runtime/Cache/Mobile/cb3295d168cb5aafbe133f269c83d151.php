<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
<title><?php echo ($page_seo["title"]); ?></title>
<meta name="keywords" content="<?php echo ($page_seo["keywords"]); ?>"/>
<meta name="description" content="<?php echo ($page_seo["description"]); ?>"/>
<meta content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,shrink-to-fit=no,user-scalable=no,minimal-ui" name="viewport"/>
<meta name ="format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
<?php if(C('qscms_page_full_screen') == 1): ?><!-- UC默认竖屏` UC强制全屏 -->
    <meta name="screen-orientation" content="portrait">
    <meta name="full-screen" content="yes"/>
    <meta name="browsermode" content="application"/>
    <!-- QQ强制竖屏` QQ强制全屏 -->
    <meta name="x5-orientation" content="portrait"/>
    <meta name="x5-fullscreen" content="true"/>
    <meta name="x5-page-mode" content="app"/><?php endif; ?>
<?php if($apply['Subsite']): ?><base href="<?php echo C('SUBSITE_DOMAIN');?>"/><?php endif; ?>
<script src="../public/js/rem.js"></script>
<script src="../public/js/zepto.min.js"></script>
<script src="../public/js/htmlspecialchars.js"></script>
<script>
	var qscms = {
		base : "<?php echo C('SUBSITE_DOMAIN');?>",
		domain : "<?php echo C('HTTP_TYPE'); echo ($_SERVER['HTTP_HOST']); ?>",
		root : "/index.php",
		companyRepeat:"<?php echo C('qscms_company_repeat');?>",
		regularMobile: /^13[0-9]{9}$|14[0-9]{9}$|15[0-9]{9}$|18[0-9]{9}$|17[0-9]{9}$|16[0-9]{9}$|19[0-9]{9}$/,
		is_subsite : <?php if($apply['Subsite'] and C('SUBSITE_VAL.s_id') > 0): ?>1<?php else: ?>0<?php endif; ?>,
        smsTatus: "<?php echo C('qscms_sms_open');?>",
        subsite_level : "<?php if($apply['Subsite'] and C('SUBSITE_VAL.s_id') > 0): echo C('SUBSITE_VAL.s_level'); else: echo C('qscms_category_district_level'); endif; ?>",
        default_district : "<?php if($apply['Subsite'] and C('SUBSITE_VAL.s_id') > 0): echo C('SUBSITE_VAL.s_default_district'); else: echo C('qscms_default_district'); endif; ?>",
        default_district_spell : "<?php if($apply['Subsite'] and C('SUBSITE_VAL.s_id') > 0): echo C('SUBSITE_VAL.s_default_district_spell'); else: echo C('qscms_default_district_spell'); endif; ?>"
	};
	<?php if($rong_state == 1): ?>var rongConfig = {
			messageReadUrl:"<?php echo U('Im/read_message');?>",
			messageUrl:"<?php echo U('Im/add_message');?>",
			messageUnreadUrl:"<?php echo U('Im/unread_message');?>",
			messageInfoUrl:"<?php echo U('Im/message',array('uid'=>_touid));?>",
			delDialog : "<?php echo U('Im/del_dialog');?>",
	        Key:"<?php echo ($ronguser['rong_key']); ?>",
	        Token:"<?php echo ($ronguser['rong_token']); ?>",
	        userInfo : {
	            id: "<?php echo ($ronguser['uid']); ?>",
	            name: "<?php echo ($ronguser['username']); ?>",
	            avatars: "<?php echo ($ronguser['avatars']); ?>"
	        }
		};
		var rongUser = {
			isDialogue:'',
			sendUser:{
	        	id:'',
	        	name: '',
	            avatars: ''
	        },
	        newTime:''
		};<?php endif; ?>
	if (!!window.ActiveXObject || "ActiveXObject" in window) {
		window.location.href = '<?php echo U('Index/compatibility');?>';
	}
</script>
<?php echo ($synlogin); ?>
<?php echo ($synsitegroupregister); ?>
<?php echo ($synsitegroupunbindmobile); ?>
<?php echo ($synsitegroupedit); ?>
<?php echo ($synsitegroup); ?>
<link rel="stylesheet" href="../public/css/common.css">
<?php if($apply['Magappx'] and $magappx and !$magappx['token']): ?><script type="text/javascript" src="/<?php echo (APP_NAME); ?>/Magappx/View/default/public/magjs-x.js"></script>
	<script type="text/javascript">
	  $(function(){
	    var url = "<?php echo U('',array('magappx_token'=>'MAGAPPX'));?>";
	    mag.ready(function(a){
	      mag.toLogin(function(rs){
	      	window.location.href=url.replace('MAGAPPX',rs.token);
	      });
	    })
	  });
	</script><?php endif; ?>
<?php if($apply['Qianfanyunapp'] && $qianfanyunapp_is_login): ?><script type="text/javascript">
		QFH5.jumpLogin(function(state,data){})
	</script><?php endif; ?>
		<link rel="stylesheet" href="../public/css/members.css">
	</head>
	<body>
		<div class="headernavfixed">
  <div class="headernav font18" style="background-color:<?php if(C('qscms_mobile_top_color') != ''): echo C('qscms_mobile_top_color'); endif; ?>;">
    <div class="title">
		<div class="n-tit-box">
			<?php if($page_seo['header_title']): echo ($page_seo['header_title']); ?>
			<?php else: ?>
                <?php echo (($page_seo["pname"] != "")?($page_seo["pname"]):$page_seo['title']); endif; ?>
		</div>
      <div class="return js-back for-event"></div>
    <div class="rbtn for-event"></div>
    <?php if($rong_state == 1): ?><div class="im for-event" onclick="javascript:location.href='<?php echo U('Im/user_list');?>'"><span id="J_imStatus"></span></div><?php endif; ?>
    </div>
  </div>
	<div class="qspageso link_gray6">
  <div class="topbg">
	  	<div class="c-return"></div>
		 <input value="<?php echo (urldecode(urldecode(_I($_GET['key'])))); ?>" type="text" class="soimput" id="J_soinput" oninput="onInput(event)" placeholder="请输入关键字"/>
    	<div class="soselect qs-relative for-event">
		    <span class="for-type-txt"> <?php if($search_type == 'resume' or strtolower(CONTROLLER_NAME) == 'resume'): ?>搜简历<?php else: ?>搜职位<?php endif; ?></span>
		    <input type="hidden" class="for-type-code" id="search_type" name="search_type" value="<?php if(!empty($search_type)): echo ($search_type); else: if(strtolower(CONTROLLER_NAME) == 'resume'): ?>resume<?php else: ?>jobs_commpany<?php endif; endif; ?>">
	    </div>
	    <div class="so-close js-so-close"></div>
		<div class="rightbtn-so for-event" id="J_submit">搜索</div>
	  <div class="choose-s-type-group">
		  <div class="choose-s-type-cell qs-relative">
			  <div class="qs-center <?php if($search_type == 'jobs'): ?>qs-relative<?php endif; ?>"><div class="choose-s-type-list font14" data-code="jobs_commpany" data-title="职位">职位</div></div>
			  <div class="qs-center <?php if($search_type == 'resume'): ?>qs-relative<?php endif; ?>"><div class="choose-s-type-list sl2 font14" data-code="resume" data-title="简历">简历</div></div>
		  </div>
	  </div>
<div class="search_ajax"><ul id="search_mes"></ul></div>
  </div>
  <div class="history"></div>
  
  <div class="clearkey  for-event" id="J_cleanhistory" style="display:none;">清空关键字</div>

<input type="hidden" id="searchUrlCode" value="<?php echo C('qscms_key_urlencode');?>">
  <div class="split-block"></div>
  
  <div class="sohot font12 link_gray6">
  <div class="hottitle font14 ">热门职位</div>
  <?php $tag_hotword_class = new \Common\qscmstag\hotwordTag(array('列表名'=>'hotword_list','显示数目'=>'12','cache'=>'0','type'=>'run',));$hotword_list = $tag_hotword_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"会员登录","title"=>"会员登录","keywords"=>"","description"=>"","header_title"=>""),$hotword_list);?>
		<?php if(is_array($hotword_list)): $i = 0; $__LIST__ = $hotword_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hotword): $mod = ($i % 2 );++$i; if(C('qscms_key_urlencode') == 1): ?><a href="<?php echo url_rewrite('QS_jobslist',array('key'=>urlencode($hotword['w_word_code'])));?>" class="hotword substring for-event"><?php echo ($hotword["w_word"]); ?></a>
    <?php else: ?>
    <a href="<?php echo url_rewrite('QS_jobslist',array('key'=>$hotword['w_word_code']));?>" class="hotword substring for-event"><?php echo ($hotword["w_word"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
  <div class="clear"></div>
  <script src="../public/js/zepto.cookie.min.js"></script>
	  <script>
          $('.topbg .c-return').click(function() {
              $('.qspageso').toggle();
		  })
		  $('.js-so-close').on('click', function () {
			  $(this).closest('.topbg').find('.soimput').val('');
              $('.search_ajax').hide();
              $(this).closest('.topbg').removeClass('has-inp');
		  })
    get_history($('.history'));
    function get_history(d){
      var b = "", hlength = 0;
      var searchHistoryArr = new Array();
      if ($.fn.cookie("searchHistory")) {
        searchHistoryArr = $.fn.cookie("searchHistory").split(",");
      };
      if (searchHistoryArr.length == 0) {
        d.hide();
        return false
      }
      $.each(searchHistoryArr.reverse(), function(index, val) {
        hlength += 1;
        val = decodeURI(val);
        b += '<div class="record"><div class="keyimg history_go" data-self="'+val+'">'+val+'</div><div class="delimg close for-event"></div><div class="clear"></div></div>';
      });
      if (hlength > 0) {
        d.empty().html(b);
        $("#J_cleanhistory").show();
        $(".history_go").on("click", function() {
          searchGo($(this).data("self"));
        });
        $(".record .close").on("click", function() {
          var searchHistoryArr = $.fn.cookie("searchHistory").split(","),
            val = $(this).prev().data("self"),
            index = $.inArray(val,searchHistoryArr);
          if (index >= 0) {
            searchHistoryArr.splice(index,1);
          };
          $.fn.cookie("searchHistory",searchHistoryArr,{ path: '/' });
          $(this).parent().remove();
        });
      } else {
        d.empty();
        $("#J_cleanhistory").hide()
      }
    }
    function add_history(key){
      key = encodeURI(htmlspecialchars(key));
      if (key.length > 0) {
        var searchHistoryArr = new Array();
        if ($.fn.cookie("searchHistory")) {
          searchHistoryArr = $.fn.cookie("searchHistory").split(",");
          var isOnly = true;
          $.each(searchHistoryArr, function(index, val) {
            if (val == key) {
              isOnly = false;
            };
          });
          if (isOnly) {
            if (searchHistoryArr.length >= 5) {
              searchHistoryArr.splice(0,1);
            }
            searchHistoryArr.push(key);
          };
        } else {
          searchHistoryArr.push(key);
        };
        $.fn.cookie("searchHistory",searchHistoryArr,{ path: '/' });
      }
    }
    function searchGo(key) {
      add_history(key);
      var search_type = $('#search_type').val();
      if(search_type=='resume'){
        var url = qscms.root+"?m=Mobile&c=Resume&a=index&key="+encodeURI(encodeURI(htmlspecialchars(key)));
      }else{
        var url = qscms.root+"?m=Mobile&c=Jobs&a=index&search_type=jobs_commpany&key="+encodeURI(encodeURI(htmlspecialchars(key)));
      }
      window.location.href=url;
    }
		  $('.topbg .soselect').on('click', function () {
			  $('.topbg').toggleClass('for-type');
		  })
		  $('.choose-s-type-cell .qs-center').on('click', function () {
			  var stypeCode = $(this).find('.choose-s-type-list').data('code');
		  	var stypeTitle = $(this).find('.choose-s-type-list').data('title');
			  $('.for-type-code').val(stypeCode);
			  if (stypeCode == 'resume') {
                  $('#pageSoType').val(0);
              } else {
                  $('#pageSoType').val(1);
              }
		  	$('.for-type-txt').text('搜' + stypeTitle);
			  $('.topbg').toggleClass('for-type');
		  });
      $('#J_submit').on('click',function(){
        if($(this).hasClass('cancel')){
          searchGo('');
        }else{
          searchGo($('#J_soinput').val());
        }
      });
      $("#J_cleanhistory").on("click", function() {
        $(this).hide();
        $(".history").hide();
        $.fn.cookie('searchHistory', null,{ path: '/' });
      });
      $('#J_soinput').on('keyup',function(){
        if($(this).val()!=''){
          $(this).closest('.topbg').addClass('has-inp');
        }else{
          $(this).closest('.topbg').removeClass('has-inp');
        }
      });
      $('.hotword').on('click',function(){
        add_history($(this).text());
        window.location.href=$(this).attr('href');
        return false;
      });
      // 关键字搜索关联
          function onInput(event) {
              var keyValue = event.target.value;
              if (!keyValue.length) {
                  $('.search_ajax').hide();
                  return false;
              }
              $.getJSON("<?php echo U('ajaxCommon/hotword');?>",{key:keyValue},function(result){
                  if (result.status==1) {
                      var reArr = result.data.list;
                      if (reArr.length) {
                          var reHtml = '';
                          var reUrl = "<?php echo url_rewrite('QS_jobslist',array('key'=>urlencode('ooo')));?>";
                          var reUrl1 = "<?php echo url_rewrite('QS_jobslist',array('key'=>'ooo'));?>";
                          var reUrls = "<?php echo url_rewrite('QS_resumelist',array('key'=>urlencode('ooo')));?>";
                          var reUrl1s = "<?php echo url_rewrite('QS_resumelist',array('key'=>'ooo'));?>";
                          for (var i = 0; i < reArr.length; i++) {
                              if (eval($('#searchUrlCode').val())) {
                                  if (eval($('#pageSoType').val())) {
                                      reHtml += '<li data-key="'+reArr[i].w_word+'"><a href="'+reUrl.replace('ooo',reArr[i].w_word)+'"><span class="search_wd">'+reArr[i].w_word+'</span></a></li>';
                                  } else {
                                      reHtml += '<li data-key="'+reArr[i].w_word+'"><a href="'+reUrls.replace('ooo',reArr[i].w_word)+'"><span class="search_wd">'+reArr[i].w_word+'</span></a></li>';
                                  }
                              } else {
                                  if (eval($('#pageSoType').val())) {
                                      reHtml += '<li data-key="'+reArr[i].w_word+'"><a href="'+reUrl1.replace('ooo',reArr[i].w_word)+'"><span class="search_wd">'+reArr[i].w_word+'</span></a></li>';
                                  } else {
                                      reHtml += '<li data-key="'+reArr[i].w_word+'"><a href="'+reUrl1s.replace('ooo',reArr[i].w_word)+'"><span class="search_wd">'+reArr[i].w_word+'</span></a></li>';
                                  }
                              }
                          }
                          $('#search_mes').html(reHtml);
                          $('.search_ajax').show();
                      }
                  }
              });
          }
	  </script>
</div>
</div>
<!--未登录显示以下 -->
<?php if(!C('visitor')): ?><div class="t-mask"></div>
    <div class="topnavshow">
	    
	  <div class="navlis">
	  	<div class="topnav" onclick="javascript:location.href='<?php echo url_rewrite('QS_index');?>'">
		  <div class="imgbox"><img src="../public/images/198.png" /></div>
		  <div class="tit">返回首页</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo U('Members/login');?>'">
		  <div class="imgbox"><img src="../public/images/192.png" /></div>
		  <div class="tit">登录/注册</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo url_rewrite('QS_jobslist');?>'">
		  <div class="imgbox"><img src="../public/images/197.png" /></div>
		  <div class="tit">找工作</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo url_rewrite('QS_resumelist');?>'">
		  <div class="imgbox"><img src="../public/images/196.png" /></div>
		  <div class="tit">招人才</div>
		</div>
		<?php if(!empty($apply['Jobfair'])): ?><div class="topnav" onclick="javascript:location.href='<?php echo url_rewrite('QS_jobfairlist');?>'">
			<div class="imgbox"><img src="../public/images/199.png" /></div>
			<div class="tit">招聘会</div>
		</div><?php endif; ?>
		<?php if(!empty($apply['Seniorjobfair'])): ?><div class="topnav" onclick="javascript:location.href='<?php echo url_rewrite('QS_seniorjobfairlist');?>'">
			<div class="imgbox"><img src="../public/images/199.png" /></div>
			<div class="tit">招聘会</div>
		</div><?php endif; ?>
		<div class="topnav" onclick="javascript:location.href='<?php echo url_rewrite('QS_newslist');?>'">
		  <div class="imgbox"><img src="../public/images/202.png" /></div>
		  <div class="tit">职场资讯</div>
		</div>
		<div class="clear"></div>
	  </div>
	  
      <div class="h-navclose qs-center"><div class="navclose"></div></div>
    </div>
<?php elseif(C('visitor.utype') == 1): ?>	
<!--企业已登录显示 -->
	<div class="t-mask"></div>
    <div class="topnavshow">
	   
	  <div class="navlis">
	  	<div class="topnav" onclick="javascript:location.href='<?php echo url_rewrite('QS_index');?>'">
		  <div class="imgbox"><img src="../public/images/198.png" /></div>
		  <div class="tit">返回首页</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo U('Company/index',array('uid'=>$visitor['uid']));?>'">
		  <div class="imgbox"><img src="../public/images/192.png" /></div>
		  <div class="tit">企业中心</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo url_rewrite('QS_resumelist');?>'">
			<div class="imgbox"><img src="../public/images/196.png" /></div>
			<div class="tit">搜索简历</div>
		</div>
		<div class="topnav" id='J_jobs_add_top'>
		  <div class="imgbox"><img src="../public/images/191.png" /></div>
		  <div class="tit">发布职位</div>
		</div>
		<div class="topnav" id="refresh_jobs_all_top">
		  <div class="imgbox"><img src="../public/images/195.png" /></div>
		  <div class="tit">一键刷新</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo U('Company/jobs_apply');?>'">
		  <div class="imgbox"><img src="../public/images/194.png" /></div>
		  <div class="tit">收到的简历</div>
		</div>
		<div class="clear"></div>
	  </div>
	  
      <div class="logout">
	    <div class="outbtn for-event">退出登录</div>
	  </div>
	    <div class="h-navclose qs-center"><div class="navclose"></div></div>
    </div>	
	

<?php else: ?>
<!--个人已登录显示 -->
	<div class="t-mask"></div>
   <div class="topnavshow">
	  <div class="navlis">
	  	<div class="topnav" onclick="javascript:location.href='<?php echo url_rewrite('QS_index');?>'">
		  <div class="imgbox"><img src="../public/images/198.png" /></div>
		  <div class="tit">返回首页</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo U('Personal/index',array('uid'=>$visitor['uid']));?>'">
		  <div class="imgbox"><img src="../public/images/192.png" /></div>
		  <div class="tit">个人中心</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo url_rewrite('QS_jobslist');?>'">
		  <div class="imgbox"><img src="../public/images/197.png" /></div>
		  <div class="tit">搜索职位</div>
		</div>
		<div class="topnav" id="preview_resume_top" pid="<?php echo ($resume['id']); ?>">
		  <div class="imgbox"><img src="../public/images/200.png" /></div>
		  <div class="tit">预览简历</div>
		</div>
		<div class="topnav" id="refresh_resume_top" pid="<?php echo ($resume['id']); ?>">
		  <div class="imgbox"><img src="../public/images/195.png" /></div>
		  <div class="tit">一键刷新</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo U('Personal/jobs_interview');?>'">
		  <div class="imgbox"><img src="../public/images/193.png" /></div>
		  <div class="tit">面试通知</div>
		</div>
		<div class="clear"></div>
	  </div>
	  
      <div class="logout">
	    <div class="outbtn for-event">退出登录</div>
	  </div>
	   <div class="h-navclose qs-center"><div class="navclose"></div></div>
    </div><?php endif; ?>
	<!--搜搜层 -->
</div>
		<?php if(C('qscms_sms_open') == 1): ?><div class="qs-top-nav x2 list_height">
				<div class="n-cell active">账号密码登录<div class="b-line"></div></div>
				<div class="n-cell" onclick="javascript:location.href='<?php echo U('Members/login_mobile');?>'">手机动态码登录<div class="b-line"></div></div>
				<div class="clear"></div>
			</div><?php endif; ?>
		<div class="split-block"></div>
		<form action="post" id="logingForm">
			<div class="loging-input-group">
				<div class="group-list">
					<div class="g-close"></div>
					<input id="username" name="username" type="text" class="l-input j-l-input font14" placeholder="请输入账户名/手机号/邮箱" autocomplete="off">
				</div>
                <div class="group-list had-remind-box qs-center link_blue" onclick="javascript:location.href='<?php echo U('members/register');?>'"><a href="javascript:;"><span class="mal"></span><span class="txt-o-red">点击立即注册</span></a></div>
				<div class="group-list pwd">
					<div class="g-close"></div>
					<input id="password" name="password" type="text" onfocus="this.type='password'" class="l-input j-l-input font14" placeholder="请输入密码" autocomplete="off">
				</div>
                <div class="group-list had-remind-box-pw qs-center link_blue" onclick="javascript:location.href='<?php echo U('Members/login_mobile');?>'"><a href="javascript:;"><span class="mal"></span><span class="txt-o-red">通过动态码登录</span></a></div>
			</div>
			<div class="l-tool-bar list_height">
				<div class="auto-loging">
					<div class="for-checkbox active" id="for-checkbox">下次自动登录</div>
				</div>
				<div class="for-pwd link_gray6"><a href="<?php if(C('qscms_sms_open') == 1): echo U('members/user_getpass'); else: echo U('members/user_getpass', array('type'=>2)); endif; ?>">忘记密码</a></div>
				<div class="clear"></div>
			</div>
			<div id="pop" style="display:none"></div>
            <input type="hidden" id="btnCheck">
			<input type="hidden" name="expire" id="expire" value="1" >
		</form>
		<div class="btn-spacing"><a id="loginBtn" href="javascript:;" class="qs-btn qs-btn-blue font18">登录</a></div>
		<div class="qs-center"><a href="<?php echo U('members/register');?>" class="qs-btn qs-btn-inline qs-btn-medium qs-btn-border-orange font14">立即注册</a></div>
		<?php if(!empty($oauth_list)): if(!(count($oauth_list) == 1 AND array_key_exists('weixin',$oauth_list))): ?><div class="qs-center coop-title">使用合作账号登录/注册</div><?php endif; endif; ?>
		<div class="coop-group g3 qs-center">
			<?php if(is_array($oauth_list)): $i = 0; $__LIST__ = $oauth_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$oauth): $mod = ($i % 2 );++$i; if($key != 'weixin'): ?><a href="<?php echo U('callback/index',array('mod'=>$key,'type'=>'login'));?>" class="coop-cell">
					<div class="img <?php echo ($key); ?>"></div>
					<p><?php echo ($oauth["name"]); ?></p>
				</a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			<div class="clear"></div>
		</div>
        <input type="hidden" id="J_captcha_open" value="<?php echo C('qscms_mobile_captcha_open');?>" />
		<input type="hidden" id="verifyLogin" value="<?php echo ($verify_userlogin); ?>">
		<div class="qsfooter link_gray6 font10">
    <div class="fo-tel">电话：<?php echo C('qscms_bootom_tel');?></div>
    <div class="fo-icp">ICP：<?php echo C('qscms_icp');?></div>
    <div class="fo-app"><a href="<?php echo C('qscms_site_domain'); echo C('qscms_site_dir');?>index.php?m=Mobile&c=Index&a=app_download">手机APP</a></div>
    <div class="clear"></div>
</div>
		<!--<div class="bottom-fixed" id="backtop">
	<a href="javascript:;" class="gotop"></a>
</div>-->
<script src="../public/js/fastclick.js"></script>
<script>
    window.addEventListener( "load", function() {
        FastClick.attach(document.body);
    }, false );
</script>
<script src="../public/js/qsToast.js"></script>
<script src="../public/js/QSpopout.js"></script>
<script src="../public/js/QSfilter.js"></script>
<script src="../public/js/zepto.hwSlider.js"></script>
<script src="../public/js/scrollTo.js"></script>
<script src="../public/js/RongIMLib-2.2.8.min.js"></script>
<?php if($rong_state == 1): ?><script src="../public/js/rong_main.js"></script><?php endif; ?>
<script>
  $('a[href]').click(function(){
      var f = $(this).attr('href');
      var reg = /\#(\w+)/;
      if(reg.test(f)) {
        if (!$(this).data('nm')) {
            return !1;
        }
      }
  });
  $('.js-back').on('click', function () {
      publicGoBack();
  });
  function publicGoBack(){
    if ((navigator.userAgent.indexOf('MSIE') >= 0) && (navigator.userAgent.indexOf('Opera') < 0)){
        if(history.length > 0){
            window.history.go( -1 );
        }else{
            window.location.href = "/";
        }
    }else{
        if (navigator.userAgent.indexOf('Firefox') >= 0 ||
            navigator.userAgent.indexOf('Opera') >= 0 ||
            navigator.userAgent.indexOf('Safari') >= 0 ||
            navigator.userAgent.indexOf('Chrome') >= 0 ||
            navigator.userAgent.indexOf('WebKit') >= 0){
            if(window.history.length > 1){
                window.history.go( -1 );
            }else{
                window.location.href = "/";
            }
        }else{
            window.history.go( -1 );
        }
    }
}
  $('.rbtn').on('click', function() {
	  forCloseNav();
  })
  $('.t-mask').on('click', function () {
	  forCloseNav();
  })
  $('.h-navclose').on('click', function () {
	  forCloseNav();
  })
  function forCloseNav() {
	  if ($('.topnavshow').hasClass('qs-actionsheet-toggle')) {
		  $('.t-mask').hide();
		  $('.topnavshow').removeClass('qs-actionsheet-toggle');
	  } else {
		  $('.t-mask').show();
		  $('.topnavshow').addClass('qs-actionsheet-toggle');
	  }
  }
  /**
   * 监听鼠标
   */
  if ('ontouchstart' in window) {
      $.EVENT_START = 'touchstart';
      $.EVENT_END = 'touchend';
  } else {
      $.EVENT_START = 'mousedown';
      $.EVENT_END = 'mouseup';
  }
  $('.plist-txt, .qs-btn, .for-event').on($.EVENT_START, function() {
      $(this).addClass('eventactive');
  })
  $('.plist-txt, .qs-btn, .for-event').on($.EVENT_END, function() {
      $(this).removeClass('eventactive');
  })
  $('.plist-txt, .qs-btn, .for-event').on('touchcancel', function() {
      $(this).removeClass('eventactive');
  })
  //顶部刷新职位
  $('#refresh_jobs_all_top').on('click',function(){
      $.getJSON("<?php echo U('Company/jobs_refresh_all');?>",function(result){
        forCloseNav();
        if(result.status==1){
          qsToast({type:1,context: result.msg});
        }
        else if(result.status==2){
          var dialog = new QSpopout('批量刷新职位');
              dialog.setContent(result.msg);
              dialog.setBtn(2, ['取消', '单条刷新']);
              dialog.show();
              dialog.getPrimaryBtn().on('click', function () {
                  window.location.href = "<?php echo U('company/jobs_list');?>";
              });
        }else{
          qsToast({type:2,context: result.msg});
          return false;
        }
      });
  });
  //顶部刷新简历
  $('#refresh_resume_top').on('click',function(){
    var pid = $(this).attr('pid');
      $.post("<?php echo U('Personal/refresh_resume');?>",{pid:pid},function(result){
        forCloseNav();
      if(result.status == 1){
        if(result.data){
          qsToast({type:1,context: '刷新简历增加'+result.data+'<?php echo C('qscms_points_byname');?>'});
        }else{
          qsToast({type:2,context: result.msg});
          return false;
        }
      }else{
        qsToast({type:2,context: result.msg});
        return false;
      }
    },'json');
  });
  //顶部预览简历
  $('#preview_resume_top').on('click',function(){
    $.getJSON("<?php echo U('Personal/resume_preview');?>",function(result){
      if(result.status == 1){
        window.location.href=result.data;
      }else{
        forCloseNav();
        qsToast({type:2,context:result.msg});
      }
    });
  });
  $('.logout').on('click', function () {
        var dialog = new QSpopout();
        dialog.setContent('确定退出吗？');
        forCloseNav();
        dialog.show();
        dialog.getPrimaryBtn().on('click', function () {
            window.location.href = "<?php echo U('Members/logout');?>";
        });
    });
   //顶部发布职位
   $('#J_jobs_add_top').on('click',function(){
    $.getJSON("<?php echo U('Company/check_jobs_num');?>",function(result){
      if(result.status==1){
        var dialog = new QSpopout();
        var free = result.data;
        if(free==1){
            dialog.setContent('<div class="dialog_notice nospace">您当前是免费会员，发布中的职位数已超过最大限制，升级VIP会员后可继续发布职位，建议您立即升级VIP会员！</div>');
        }else{
            dialog.setContent('<div class="dialog_notice nospace">当前显示的职位已超过最大限制，建议您立即升级服务套餐或将暂时不招聘的职位设为关闭！</div>');
        }
        forCloseNav();
        dialog.show();
        dialog.setBtn(2, ['取消', '升级套餐']);
        dialog.getPrimaryBtn().on('click', function () {
            window.location.href = "<?php echo U('CompanyService/setmeal_add');?>";
        });
      }else{
        window.location.href="<?php echo U('Company/jobs_add');?>";
      }
    });
   });
	// 处理select
  $('select').on('change', function () {
	  $(this).prev().text($(this).find('option').not(function(){ return !this.selected }).text());
  })
  $('select').each(function () {
	  $(this).prev().text($(this).find('option').not(function(){ return !this.selected }).text());
  })
	// 底部导航栏
	$('.js-b-nav-bar').on('click', function () {
		$(this).closest('.bottom-nav-bar-group').find('.bottom-bar-more-group').fadeIn(200);
	})
  $('.js-b-nav-bar-active').on('click', function () {
	  $(this).closest('.bottom-nav-bar-group').find('.bottom-bar-more-group').fadeOut(200);
  })
  $("#hwslider-bottom").hwSlider({
	  autoPlay: false,
	  dotShow: true,
	  touch: true,
	  arrShow: false
  });

  /**
   * 返回顶部
   */
  var global = {
	  h:$(window).height(),
	  st: $(window).scrollTop(),
	  backTop:function(){
		  global.st > (global.h*0.5) ? $("#backtop").show() : $("#backtop").hide();
	  }
  }
  global.backTop();
  $(window).scroll(function(){
	  global.h = $(window).height();
	  global.st = $(window).scrollTop();
	  global.backTop();
  });
  $(window).resize(function(){
	  global.h = $(window).height();
	  global.st = $(window).scrollTop();
	  global.backTop();
  })
  $("#backtop").on('click', function () {
	  $("body").scrollTo({toT: 0});
  })
</script>
<div class="qs-hidden"><?php echo htmlspecialchars_decode(C('qscms_statistics'));?></div>
	</body>
	<script src="https://static.geetest.com/static/tools/gt.js"></script>
	<script>
        // 图片验证码
        var verifyPhoto = false;
		// 自动登录
		$('#for-checkbox').on('click', function() {
			$(this).toggleClass('active');
			if ($(this).hasClass('active')) {
				$('#expire').val('1');
			} else {
				$('#expire').val('0');
			}
		})

        var regularMobile = qscms.regularMobile;
        var noUrl = "<?php echo U('members/register', array('mobile'=>_mobile));?>";
        $('input[name=username]').keyup(function () {
          var currentValue = $(this).val();
          if (currentValue.length >= 11) {
            if(regularMobile.test(currentValue) && remoteValid('mobile',currentValue)) {
              $('.had-remind-box .mal').text('手机号 ' + currentValue + ' 未注册，');
              $('.had-remind-box').show();
              noUrl = noUrl.replace('_mobile',currentValue);
              $('.had-remind-box').on('click', function () {
                window.location.href = noUrl;
              })
            } else {
              $('.had-remind-box').hide();
            }
          } else {
            $('.had-remind-box').hide();
          }
        })

        function remoteValid(validType, validValue){
          var result = false;
          $.ajax({
            url: "<?php echo U('members/ajax_check');?>",
            cache: false,
            async: false,
            type: 'post',
            dataType: 'json',
            data: { type: validType, param: validValue },
            success: function(json) {
              if (json && json.status) {
                result = true;
              } else {
                result = false;
              }
            }
          });
          return result;
        }

		/**
		 * ajax 登录
		 */
		function doAjax() {
            var usernameValue = $('input[name="username"]').val();
            var passwordValue = $('input[name="password"]').val();
            var expireValue = $('input[name="expire"]').val();
			$.ajax({
				url: "<?php echo U('Members/login');?>",
				type: 'POST',
				dataType: 'json',
				data: {
                    username: usernameValue,
                    password: passwordValue,
                    expire: expireValue
                },
				success: function(result) {
					if (result.status) {
						window.location.href = result.data;
					} else {
            			$('#pop').hide();
						if (result.data) {
							$("#verifyLogin").val(result.data);
						}
						qsToast({type:2,context: result.msg});
						if (result.msg == '密码错误!') {
                          $('.had-remind-box').hide();
                          $('.had-remind-box-pw .mal').text('密码错误，请重新输入或');
                          $('.had-remind-box-pw').show();
                        } else if (result.msg == '帐号未激活') {
                            $('.had-remind-box').hide();
                        } else {
                          $('.had-remind-box-pw').hide();
                          $('.had-remind-box').show();
                        }
					}
				},
				error: function(result) {
					$('#pop').hide();
					qsToast({type:2,context: result.msg});
				}
			})
		}

        // 图片验证码
		function verifyPhotoDialog() {
            var verifyCodePop = new QSpopout('请输入下图中的文字或字母');
            verifyCodePop.setContent([
                '<div class="dia-captcha-item">',
                '<img src="' + qscms.root + '?m=Home&c=captcha&a=captcha&t=' + (new Date()).getTime() + '" class="dia-captcha-img">',
                '<input type="text" name="captcha-solution" class="dia-captcha-solution font16" maxlength="10">',
                '</div>'
            ].join(''));
            verifyCodePop.setBtn(1);
            verifyCodePop.show();
            verifyCodePop.setClose(false);
            $('.dia-captcha-img').on('click', function() {
                $(this).attr('src', qscms.root + '?m=Home&c=captcha&a=captcha&t=' + (new Date()).getTime());
            })
            // 确定按钮事件
            verifyCodePop.getPrimaryBtn().on('click', function () {
                var currentPhotoVal = $.trim($('.dia-captcha-solution').val());
                if (currentPhotoVal.length) {
                    $.ajax({
                        url: qscms.root + '?m=Home&c=captcha&a=captchaCode',
                        cache: false,
                        async: false,
                        type: 'post',
                        dataType: 'json',
                        data: { postcaptcha: currentPhotoVal },
                        success: function(result) {
                            if (result.status) {
                                verifyCodePop.hide();
                                doAjax();
                            } else {
                                qsToast({type:2,context: '验证码输入错误'});
                                $('.dia-captcha-img').attr('src', qscms.root + '?m=Home&c=captcha&a=captcha&t=' + (new Date()).getTime());
                            }
                        }
                    });
                } else {
                    $('.dia-captcha-solution').focus();
                    qsToast({type:2,context: '请输入文字或字母'});
                }
            });
        }

        var captcha_open = $('#J_captcha_open').val();
		/**
		 * 登录验证
		 */
		$('#loginBtn').on('click', function(e) {
			var usernameValue = $.trim($('input[name=username]').val());
			var passwordValue = $.trim($('input[name=password]').val());
			if (usernameValue == '') {
				qsToast({type:2,context: '请输入账户名/手机号/邮箱'});
				return false;
			}
			if (passwordValue == '') {
				qsToast({type:2,context: '请输入密码'});
				return false;
			}
			if (captcha_open) {
                if (eval($('#verifyLogin').val())) {
                    // 登录错误次数达到最大值
                    if (verifyPhoto) {
                        // 图片验证码
                        verifyPhotoDialog();
                    } else {
                        // 极验
                        $('.geetest_panel').remove();
                        $.ajax({
                            url: qscms.root+'?m=Mobile&c=Captcha&type=mobile&t=' + (new Date()).getTime(),
                            type: 'get',
                            dataType: 'json',
                            success: function(config) {
                                initGeetest({
                                    gt: config.gt,
                                    challenge: config.challenge,
                                    offline: !config.success,
                                    new_captcha: config.new_captcha,
                                    product: 'bind'
                                }, function(captchaObj) {
                                    captchaObj.appendTo("#pop");
                                    captchaObj.onSuccess(function() {
                                        var captChaResult = captchaObj.getValidate();
                                        var usernameValue = $('input[name="username"]').val();
                                        var passwordValue = $('input[name="password"]').val();
                                        var expireValue = $('input[name="expire"]').val();
                                        $.ajax({
                                            url: "<?php echo U('Members/login');?>",
                                            type: 'POST',
                                            dataType: 'json',
                                            data: {
                                                username: usernameValue,
                                                password: passwordValue,
                                                expire: expireValue,
                                                geetest_challenge: captChaResult.geetest_challenge,
                                                geetest_validate: captChaResult.geetest_validate,
                                                geetest_seccode: captChaResult.geetest_seccode
                                            },
                                            success: function(result) {
                                                if (result.status) {
                                                    window.location.href = result.data;
                                                } else {
                                                    $('#pop').hide();
                                                    if (result.data) {
                                                        $("#verifyLogin").val(result.data);
                                                    }
                                                    qsToast({type:2,context: result.msg});
                                                    if (result.msg == '密码错误!') {
                                                        $('.had-remind-box').hide();
                                                        $('.had-remind-box-pw .mal').text('密码错误，请重新输入或');
                                                        $('.had-remind-box-pw').show();
                                                    } else if (result.msg == '帐号未激活') {
                                                        $('.had-remind-box').hide();
                                                    } else {
                                                        $('.had-remind-box-pw').hide();
                                                        $('.had-remind-box').show();
                                                    }
                                                }
                                            },
                                            error: function(result) {
                                                $('#pop').hide();
                                                qsToast({type:2,context: result.msg});
                                            }
                                        })
                                    })
                                    captchaObj.onReady(function () {
                                        captchaObj.verify();
                                    });
                                    $('#btnCheck').on('click', function () {
                                        captchaObj.verify();
                                    })
                                    window.captchaObj = captchaObj;
                                });
                            }
                        })
                    }
                } else {
                    doAjax();
                }
            } else {
                doAjax();
            }
		});

		/**
         * 清空所填项
         */
        $('.j-l-input').on('keyup',function(){
          if($(this).val()!=''){
            $(this).closest('.group-list').addClass('has-inp');
          }else{
            $(this).closest('.group-list').removeClass('has-inp');
          }
        });
        $('.g-close').on('click', function() {
          $(this).next().val('');
          $(this).closest('.group-list').removeClass('has-inp');
          $('.had-remind-box').hide();
        })
	</script>
</html>