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
    <link rel="stylesheet" href="../public/css/jobs.css">
    <?php $tag_load_class = new \Common\qscmstag\loadTag(array('type'=>'category','search'=>'1','cache'=>'0','列表名'=>'list',));$list = $tag_load_class->category();?>
    
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
  <?php $tag_hotword_class = new \Common\qscmstag\hotwordTag(array('列表名'=>'hotword_list','显示数目'=>'12','cache'=>'0','type'=>'run',));$hotword_list = $tag_hotword_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"职位列表页","title"=>"职位列表页-{site_name}","keywords"=>"","description"=>"","header_title"=>""),$hotword_list);?>
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
<input type="hidden" id="pageSoType" value="1">
<div class="split-block-title">
    <div class="sbox js-show-qspageso">
	    <?php echo (urldecode(urldecode((_I($_GET['key']) != "")?(_I($_GET['key'])):"请输入职位名/公司名关键字"))); ?>
	    <script>
		    // 显示搜索层
		    $('.js-show-qspageso').on('click', function(){
			  $('.qspageso').toggle();
              $('#J_soinput').focus();
              if($('#J_soinput').val()!=''){
                $('#J_soinput').val($('#J_soinput').val());
                $('#J_soinput').closest('.topbg').addClass('has-inp');
              }
		    });
	    </script>
    </div>
</div>
<?php $tag_classify_class = new \Common\qscmstag\classifyTag(array('列表名'=>'jobs_cate_info','类型'=>'QS_jobs_info','cache'=>'0','type'=>'run',));$jobs_cate_info = $tag_classify_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"职位列表页","title"=>"职位列表页-{site_name}","keywords"=>"","description"=>"","header_title"=>""),$jobs_cate_info);?>
<?php $tag_classify_class = new \Common\qscmstag\classifyTag(array('列表名'=>'wage_list','类型'=>'QS_wage','显示数目'=>'100','cache'=>'0','type'=>'run',));$wage_list = $tag_classify_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"职位列表页","title"=>"职位列表页-{site_name}","keywords"=>"","description"=>"","header_title"=>""),$wage_list);?>
<?php $tag_classify_class = new \Common\qscmstag\classifyTag(array('列表名'=>'experience_list','类型'=>'QS_experience','显示数目'=>'100','cache'=>'0','type'=>'run',));$experience_list = $tag_classify_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"职位列表页","title"=>"职位列表页-{site_name}","keywords"=>"","description"=>"","header_title"=>""),$experience_list);?>
<?php $tag_classify_class = new \Common\qscmstag\classifyTag(array('列表名'=>'nature_list','类型'=>'QS_jobs_nature','显示数目'=>'100','cache'=>'0','type'=>'run',));$nature_list = $tag_classify_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"职位列表页","title"=>"职位列表页-{site_name}","keywords"=>"","description"=>"","header_title"=>""),$nature_list);?>
<?php $tag_classify_class = new \Common\qscmstag\classifyTag(array('列表名'=>'education_list','类型'=>'QS_education','显示数目'=>'100','cache'=>'0','type'=>'run',));$education_list = $tag_classify_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"职位列表页","title"=>"职位列表页-{site_name}","keywords"=>"","description"=>"","header_title"=>""),$education_list);?>
<?php $tag_classify_class = new \Common\qscmstag\classifyTag(array('列表名'=>'tag_list','类型'=>'QS_jobtag','显示数目'=>'100','cache'=>'0','type'=>'run',));$tag_list = $tag_classify_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"职位列表页","title"=>"职位列表页-{site_name}","keywords"=>"","description"=>"","header_title"=>""),$tag_list);?>
<?php $tag_classify_class = new \Common\qscmstag\classifyTag(array('列表名'=>'trade_list','类型'=>'QS_trade','显示数目'=>'100','cache'=>'0','type'=>'run',));$trade_list = $tag_classify_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"职位列表页","title"=>"职位列表页-{site_name}","keywords"=>"","description"=>"","header_title"=>""),$trade_list);?>
<?php $tag_classify_class = new \Common\qscmstag\classifyTag(array('列表名'=>'city','类型'=>'QS_citycategory','地区分类'=>_I($_GET['citycategory']),'显示数目'=>'100','cache'=>'0','type'=>'run',));$city = $tag_classify_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"职位列表页","title"=>"职位列表页-{site_name}","keywords"=>"","description"=>"","header_title"=>""),$city);?>
<div class="filter-group x4 filter-outer">
    <div id="f-mask"></div>
    <div class="filter-outer">
      <div class="filter-list js-filter qs-temp-new-city" data-tag="0" data-type="city"><div class="filter-cell"><div class="filter-cell-txt qs-temp-txt-city"><?php if($_GET['citycategory']!= ''): echo (($city['select']['categoryname'] != "")?($city['select']['categoryname']):"地区"); else: ?>地区<?php endif; ?></div></div></div>
      <div class="filter-list js-filter" data-tag="1"><div class="filter-cell"><div class="filter-cell-txt f-normal-txt-wage"><?php echo (($wage_list[$_GET['wage']] != "")?($wage_list[$_GET['wage']]):"薪资"); ?></div></div></div>
      <div class="filter-list js-filter" data-tag="2"><div class="filter-cell"><div class="filter-cell-txt f-normal-txt-exp"><?php echo (($experience_list[$_GET['experience']] != "")?($experience_list[$_GET['experience']]):"经验"); ?></div></div></div>
      <div class="filter-list js-filter" data-tag="3"><div class="filter-cell"><div class="filter-cell-txt j-change-color">更多</div></div></div>
      <div class="clear"></div>
      <div class="qs-actionmore"></div>
	    <form id="searchForm">
		    <input type="hidden" class="" name="search_type" value="jobs_commpany">
		    <input type="hidden" class="" name="key" value="<?php echo (urldecode(urldecode(_I($_GET['key'])))); ?>">
		    <input type="hidden" class="qs-recover-code-job" name="jobcategory" value="<?php echo (_I($_GET['jobcategory'])); ?>">
		    <input type="hidden" class="qs-temp-code-city" name="citycategory" value="<?php echo (_I($_GET['citycategory'])); ?>">
		    <input type="hidden" class="f-normal-code-wage" name="wage" value="<?php echo (_I($_GET['wage'])); ?>">
		    <input type="hidden" class="f-normal-code-exp" name="experience" value="<?php echo (_I($_GET['experience'])); ?>">
		    <input type="hidden" class="f-more-l-code-nature" name="nature" value="<?php echo (_I($_GET['nature'])); ?>">
		    <input type="hidden" class="f-more-l-code-edu" name="education" value="<?php echo (_I($_GET['education'])); ?>">
		    <input type="hidden" class="f-more-l-code-tag" name="jobtag" value="<?php echo (_I($_GET['jobtag'])); ?>">
		    <input type="hidden" class="f-more-l-code-trade" name="trade" value="<?php echo (_I($_GET['trade'])); ?>">
		    <input type="hidden" class="f-more-l-code-settr" name="settr" value="<?php echo (_I($_GET['settr'])); ?>">
		    <input type="hidden" class="f-deliver" name="deliver" value="<?php echo (_I($_GET['deliver'])); ?>">
		    <input type="hidden" class="qs-temp-code-range" name="range" value="<?php echo (_I($_GET['range'])); ?>">
            <input type="hidden" name="lat" id="lat" value="<?php echo (_I($_GET['lat'])); ?>">
            <input type="hidden" name="lng" id="lng" value="<?php echo (_I($_GET['lng'])); ?>">
	    </form>
	    <input type="hidden" class="f-seach-page" value="?m=Mobile&c=Jobs&a=index&">
    </div>
    <div class="con-filter">
        <div class="f-box f-box-city"></div>
		    <div class="f-box f-box-wage">
			    <div class="f-box-inner">
            <?php if(is_array($wage_list)): $i = 0; $__LIST__ = $wage_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$wage): $mod = ($i % 2 );++$i;?><li><a class="f-item f-item-normal <?php if($_GET['wage']== $key): ?>select<?php endif; ?>" href="javascript:;" data-type="wage" data-code="<?php echo ($key); ?>" data-title="<?php echo ($wage); ?>"><?php echo ($wage); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
			    </div>
                <div class="f-btn-submit qs-center"><div onclick="window.location='<?php echo P(array('wage'=>''));?>';" class="qs-btn qs-btn-inline qs-btn-medium qs-btn-orange">不限</div></div>
		    </div>
		    <div class="f-box f-box-exp">
			    <div class="f-box-inner">
            <?php if(is_array($experience_list)): $i = 0; $__LIST__ = $experience_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$experience): $mod = ($i % 2 );++$i;?><li><a class="f-item f-item-normal <?php if($_GET['experience']== $key): ?>select<?php endif; ?>" href="javascript:;" data-type="exp" data-code="<?php echo ($key); ?>" data-title="<?php echo ($experience); ?>"><?php echo ($experience); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
			    </div>
                <div class="f-btn-submit qs-center"><div onclick="window.location='<?php echo P(array('experience'=>''));?>';" class="qs-btn qs-btn-inline qs-btn-medium qs-btn-orange">不限</div></div>
		    </div>
		    <div class="f-box f-box-more">
			    <div class="f-box-inner">
				    <ul class="arrow">
					    <li class="clicked">过滤已投递<span><span class="clickedbox js-clickedbox"></span></span></li>
					    <li><a href="javascript:;" data-id="filter-nature" class="js-more-l">工作性质<span class="choice f-more-l-txt-nature"><?php echo (($nature_list[$_GET['nature']] != "")?($nature_list[$_GET['nature']]):"不限"); ?></span></a></li>
					    <li><a href="javascript:;" data-id="filter-edu" class="js-more-l">学历要求<span class="choice f-more-l-txt-edu"><?php echo (($education_list[$_GET['education']] != "")?($education_list[$_GET['education']]):"不限"); ?></span></a></li>
					    <li><a href="javascript:;" data-id="filter-tag" class="js-more-l">福利待遇<span class="choice f-more-l-txt-tag"><?php echo (($tag_list[$_GET['jobtag']] != "")?($tag_list[$_GET['jobtag']]):"不限"); ?></span></a></li>
					    <li><a href="javascript:;" data-id="filter-trade" class="js-more-l">行业<span class="choice f-more-l-txt-trade"><?php echo (($trade_list[$_GET['trade']] != "")?($trade_list[$_GET['trade']]):"不限"); ?></span></a></li>
					    <li><a href="javascript:;" data-id="filter-settr" class="js-more-l">更新时间<span class="choice f-more-l-txt-settr">
					    	<?php switch($_GET['settr']): case "": ?>不限<?php break;?>
					    		<?php case "0": ?>不限<?php break;?>
								<?php case "3": ?>3天内<?php break;?>
								<?php case "7": ?>7天内<?php break;?>
								<?php case "15": ?>15天内<?php break;?>
								<?php case "30": ?>30天内<?php break; endswitch;?>
					    </span></a></li>
				    </ul>
			    </div>
			    <div class="f-btn-submit qs-center">
                    <div href="javascript:;" class="qs-btn qs-btn-inline qs-btn-medium qs-btn-orange" id="f-do-filter"> 确 定 </div>
                    &nbsp;&nbsp;&nbsp;
                    <div onclick="window.location='<?php echo url_rewrite('QS_jobslist');?>';" class="qs-btn qs-btn-inline qs-btn-medium qs-btn-border-gray"> 清空所选 </div>
                </div>
			    <div class="f-btn-back qs-center"><div href="javascript:;" class="qs-btn qs-btn-inline qs-btn-medium qs-btn-orange f-more-back-btn"> 返 回 </div></div>
		    </div>
	      <div class="f-box f-more-content" id="filter-nature">
		      <div class="f-box-inner">
			      <ul>
				      <li class="selected"><a href="javascript:;" class="f-more-back-a <?php if($_GET['nature']== 0): ?>select<?php endif; ?>" data-type="nature" data-title="不限" data-code="0">不限</a></li>
              <?php if(is_array($nature_list)): $i = 0; $__LIST__ = $nature_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nature): $mod = ($i % 2 );++$i;?><li class="selected"><a href="javascript:;" class="f-more-back-a <?php if($_GET['nature']== $key): ?>select<?php endif; ?>" data-type="nature" data-title="<?php echo ($nature); ?>" data-code="<?php echo ($key); ?>"><?php echo ($nature); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
			      </ul>
		      </div>
	      </div>
		    <div class="f-box f-more-content" id="filter-edu">
			    <div class="f-box-inner">
				    <ul>
              <li class="selected"><a href="javascript:;" class="f-more-back-a <?php if($_GET['education']== 0): ?>select<?php endif; ?>" data-type="edu" data-title="不限" data-code="0">不限</a></li>
              <?php if(is_array($education_list)): $i = 0; $__LIST__ = $education_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$education): $mod = ($i % 2 );++$i;?><li class="selected"><a href="javascript:;" class="f-more-back-a <?php if($_GET['education']== $key): ?>select<?php endif; ?>" data-type="edu" data-title="<?php echo ($education); ?>" data-code="<?php echo ($key); ?>"><?php echo ($education); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
				    </ul>
			    </div>
		    </div>
		    <div class="f-box f-more-content" id="filter-tag">
			    <div class="f-box-inner">
				    <ul>
              <li class="selected"><a href="javascript:;" class="f-more-back-a <?php if($_GET['jobtag']== 0): ?>select<?php endif; ?>" data-type="tag" data-title="不限" data-code="0">不限</a></li>
              <?php if(is_array($tag_list)): $i = 0; $__LIST__ = $tag_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i;?><li class="selected"><a href="javascript:;" class="f-more-back-a <?php if($_GET['jobtag']== $key): ?>select<?php endif; ?>" data-type="tag" data-title="<?php echo ($tag); ?>" data-code="<?php echo ($key); ?>"><?php echo ($tag); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
				    </ul>
			    </div>
		    </div>
		    <div class="f-box f-more-content" id="filter-trade">
			    <div class="f-box-inner">
				    <ul>
              <li class="selected"><a href="javascript:;" class="f-more-back-a <?php if($_GET['trade']== 0): ?>select<?php endif; ?>" data-type="trade" data-title="不限" data-code="0">不限</a></li>
              <?php if(is_array($trade_list)): $i = 0; $__LIST__ = $trade_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$trade): $mod = ($i % 2 );++$i;?><li class="selected"><a href="javascript:;" class="f-more-back-a <?php if($_GET['trade']== $key): ?>select<?php endif; ?>" data-type="trade" data-title="<?php echo ($trade); ?>" data-code="<?php echo ($key); ?>"><?php echo ($trade); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
				    </ul>
			    </div>
		    </div>
		    <div class="f-box f-more-content" id="filter-settr">
			    <div class="f-box-inner">
				    <ul>
              <li class="selected"><a href="javascript:;" class="f-more-back-a <?php if($_GET['settr']== 0): ?>select<?php endif; ?>" data-type="settr" data-title="不限" data-code="0">不限</a></li>
              <li class="selected"><a href="javascript:;" class="f-more-back-a <?php if($_GET['settr']== 3): ?>select<?php endif; ?>" data-type="settr" data-title="3天内" data-code="3">3天内</a></li>
              <li class="selected"><a href="javascript:;" class="f-more-back-a <?php if($_GET['settr']== 7): ?>select<?php endif; ?>" data-type="settr" data-title="7天内" data-code="7">7天内</a></li>
              <li class="selected"><a href="javascript:;" class="f-more-back-a <?php if($_GET['settr']== 15): ?>select<?php endif; ?>" data-type="settr" data-title="15天内" data-code="15">15天内</a></li>
              <li class="selected"><a href="javascript:;" class="f-more-back-a <?php if($_GET['settr']== 30): ?>select<?php endif; ?>" data-type="settr" data-title="30天内" data-code="30">30天内</a></li>
				    </ul>
			    </div>
		    </div>
    </div>
</div>
<?php if($_GET['jobcategory']!= ''): ?><div class="list-jobcategory-block font13">
		<div class="l-recover-job-txt">当前在  <span class="l-cetgory"><?php echo ($jobs_cate_info['spell'][$_GET['jobcategory']]['categoryname']); ?></span> 分类下</div>
		<div class="l-recover-close js-clearjob-jobcategory">清空分类</div>
	</div><?php endif; ?>
<?php $tag_jobs_list_class = new \Common\qscmstag\jobs_listTag(array('列表名'=>'jobslist','搜索类型'=>_I($_GET['search_type']),'搜索内容'=>_I($_GET['search_cont']),'显示数目'=>'20','分页显示'=>'1','关键字'=>_I($_GET['key']),'职位分类'=>_I($_GET['jobcategory']),'地区分类'=>_I($_GET['citycategory']),'行业'=>_I($_GET['trade']),'日期范围'=>_I($_GET['settr']),'学历'=>_I($_GET['education']),'工作经验'=>_I($_GET['experience']),'工资'=>_I($_GET['wage']),'职位性质'=>_I($_GET['nature']),'标签'=>_I($_GET['jobtag']),'公司规模'=>_I($_GET['scale']),'营业执照'=>_I($_GET['license']),'过滤已投递'=>_I($_GET['deliver']),'排序'=>_I($_GET['sort']),'合并'=>_I($_COOKIE['com_list']),'描述长度'=>'100','搜索范围'=>_I($_GET['range']),'经度'=>_I($_GET['lng']),'纬度'=>_I($_GET['lat']),'cache'=>'0','type'=>'run',));$jobslist = $tag_jobs_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"职位列表页","title"=>"职位列表页-{site_name}","keywords"=>"","description"=>"","header_title"=>""),$jobslist);?>
<?php if(!empty($jobslist['list'])): if(is_array($jobslist['list'])): $i = 0; $__LIST__ = $jobslist['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jobs): $mod = ($i % 2 );++$i;?><div class="job-list-item for-event" onclick="javascript:location.href='<?php echo ($jobs["jobs_url"]); ?>'">
    <div class="info">
        <div class="line-one">
            <div class="job-name substring font16"><?php echo ($jobs["jobs_name"]); ?>
            <?php if($jobs['emergency'] == 1): ?><img src="../public/images/231.png"/><?php endif; ?>
            </div>
            <?php if(C('apply.Allowance') && $jobs['allowance_id'] > 0): ?><div class="j-n-money">
                <div class="j-m-l jm<?php if(($jobs['allowance_info']['type_alias']) == "apply"): ?>2<?php endif; if(($jobs['allowance_info']['type_alias']) == "interview"): ?>3<?php endif; if(($jobs['allowance_info']['type_alias']) == "entry"): ?>1<?php endif; ?>"></div>
                <div class="j-m-r"><span class="font9">￥</span><span class="font12"><?php echo ($jobs['allowance_info']['per_amount']); ?></span></div>
                <div class="clear"></div>
            </div><?php endif; ?>
            <?php if($jobs['stick'] == 1 && (($_GET['search_type'] == 'jobs' or $_GET['search_type'] == 'company' or $_GET['jobs_commpany'] == 'jobs_commpany' or $_GET['key'] == '') && !$_GET['sort'])): ?><div class="refresh-time font12 font_red_light">置顶</div>
            <?php else: ?>
            <div class="refresh-time font12"><?php echo ($jobs['refreshtime_cn']); ?></div><?php endif; ?>
            <div class="clear"></div>
        </div>
        <div class="line-two font14">
            <div class="salary"><?php echo ($jobs["wage_cn"]); ?></div>
            <div class="category substring"><?php echo ($jobs["category_cn"]); ?></div>
            <div class="clear"></div>
        </div>
        <?php if(empty($jobs['tag_cn'])): ?><div class="line-four font13">
            <?php echo ($jobs["education_cn"]); ?> / <?php echo ($jobs["experience_cn"]); ?> / 年龄<?php echo ($jobs['age_cn']); ?>
        </div>
        <?php else: ?>
        <div class="line-three fontag">
            <?php if(is_array($jobs['tag_cn'])): $i = 0; $__LIST__ = array_slice($jobs['tag_cn'],0,4,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i;?><div class="job-tag"><?php echo ($tag); ?></div><?php endforeach; endif; else: echo "" ;endif; ?>
            <div class="clear"></div>
        </div><?php endif; ?>
        <?php if(($jobs['allowance_id']) == "0"): ?><div class="apply-btn apply_jobs" data-jid="<?php echo ($jobs['id']); ?>" onClick="event.cancelBubble = true">申请</div>
        <?php else: ?>
        <div class="apply-btn J_applyForJobAllowance" data-jid="<?php echo ($jobs['id']); ?>" onClick="event.cancelBubble = true">申请</div><?php endif; ?>
    </div>
    <div class="company font13">
        <div class="company-name substring"><?php echo ($jobs["companyname"]); ?></div>
        <div class="district <?php if($_GET['range']!= ''): ?>range<?php endif; ?> substring"><?php if($_GET['range']!= ''): echo ($jobs["map_range"]); else: echo ($jobs["district_cn"]); endif; ?></div>
        <div class="clear"></div>
    </div>
</div>
<div class="list-split-block"></div><?php endforeach; endif; else: echo "" ;endif; ?>
<div class="qspage"><?php echo ($jobslist['page']); ?></div>
<?php else: ?>
    <div class="list-split-block"></div>
    <div class="list-empty link_blue">
        抱歉，没有找到符合您条件的职位！<br />
        放宽搜索条件也许有更多合适您的职位哦~
    </div><?php endif; ?>
<?php if(C('qscms_footer_nav_status') == 1): ?><div class="bottom-nav-bar-group">
        <div class="bottom-nav-bar">
            <div class="nav-bar-cell qs-left">
                <a href="<?php echo url_rewrite('QS_index');?>" class="bar-cell index">
                    <div class="b-img"></div>
                    <div class="b-txt font12">首页</div>
                </a>
                <a href="<?php echo url_rewrite('QS_jobslist');?>" class="bar-cell job active">
                    <div class="b-img"></div>
                    <div class="b-txt font12">工作</div>
                </a>
                <div class="clear"></div>
            </div>
            <div class="nav-bar-more qs-left for-event">
                <div class="nav-bar-more-cell js-b-nav-bar"></div>
            </div>
            <div class="nav-bar-cell qs-left">
                <a href="<?php echo url_rewrite('QS_resumelist');?>" class="bar-cell resume">
                    <div class="b-img"></div>
                    <div class="b-txt font12">简历</div>
                </a>
                <a href="<?php echo url_rewrite('QS_login');?>" class="bar-cell mine">
                    <div class="b-img"></div>
                    <div class="b-txt font12">我的</div>
                </a>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="bottom-bar-more-group">
            <div class="bn-mask js-b-nav-bar-active"></div>
            <div class="bar-more-cell">
                <div id="hwslider-bottom" class="hwslider">
                    <ul>
                        <li>
                            <a href="<?php echo url_rewrite('QS_jobslist');?>"><dl class="l1"><dt class="job for-event"></dt><dd class="font12">找工作</dd></dl></a>
                            <a href="<?php echo url_rewrite('QS_resumelist');?>"><dl class="l1"><dt class="resume for-event"></dt><dd class="font12">找人才</dd></dl></a>
                            <a href="<?php echo url_rewrite('QS_login');?>"><dl class="l1"><dt class="fabu for-event"></dt><dd class="font12">发布</dd></dl></a>
                            <div class="clear"></div>
                        </li>
                        <li>
                            <a href="<?php echo url_rewrite('QS_newslist');?>"><dl class="l1"><dt class="news for-event"></dt><dd class="font12">资讯</dd></dl></a>
                            <?php if(!empty($apply['Mall'])): ?><a href="<?php echo url_rewrite('QS_mall_index');?>"><dl class="l1"><dt class="shop for-event"></dt><dd class="font12">商城</dd></dl></a><?php endif; ?>
                            <?php if(!empty($apply['Jobfair'])): ?><a href="<?php echo url_rewrite('QS_jobfairlist');?>"><dl class="l1"><dt class="zhaoph for-event"></dt><dd class="font12">招聘会</dd></dl></a><?php endif; ?>
                            <?php if(!empty($apply['Seniorjobfair'])): ?><a href="<?php echo url_rewrite('QS_seniorjobfairlist');?>"><dl class="l1"><dt class="zhaoph for-event"></dt><dd class="font12">招聘会</dd></dl></a><?php endif; ?>
                            <div class="clear"></div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="bar-more-closecell js-b-nav-bar-active for-event"></div>
        </div>
    </div><?php endif; ?>

<div class="alw-yes-meet-dia">
    <div><div class="alw-close"></div><div class="clear"></div></div>
    <div class="sp-line-10"></div>
    <div class="alw-ym-con">
        <div class="ayc-head txt-red font16">投递红包领取成功</div>
        <div class="sp-line-80"></div>
        <div class="ayc-cash-num txt-red font24"><span class="amount">0</span>&nbsp;<span class="font16">元</span></div>
        <div class="ayc-title font18">投递红包</div>
        <div class="sp-line-20"></div>
        <div class="ayc-remind font12">提示：请勿使用虚假简历投递，一经查实即加入黑名单，永久失去本平台领取红包特权！</div>
        <div class="sp-line-20"></div>
        <div class="alw-yes-share-btn font12">分享给好友 >></div>
        <div class="sp-line-20"></div>
        <div class="alw-txt-line txt-fff font9">红包到账可能有延迟，请在微信中查询</div>
        <div class="sp-line-15"></div>
        <div class="alw-txt-line txt-dark-red font9">本活动最终解释权归<?php echo C('qscms_site_name');?>所有</div>
    </div>
</div>
<div class="alw-layer"></div>
<div class="alw-wx-layer"></div>
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
<script src="../public/js/zepto.cookie.min.js"></script>
<!--<script src="../public/js/inobounce.js"></script>-->
<script src="../public/js/QSfilter.js"></script>
<script src="../public/js/qsCategory.js"></script>
<script src="../public/js/qsCitySearch.js"></script>
<script type="text/javascript" charset="utf-8" src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript" src="https://api.map.baidu.com/api?v=2.0&ak=<?php echo C('qscms_map_ak');?>"></script>
</body>
<script>
    /* 显示分享 覆盖层 */
  function share() {
      $(".alw-wx-layer").show();
  }
  function share_() {
      $(".alw-layer").show();
  }
  //分享按钮
  $('.alw-yes-share-btn').on('click', function() {
      var agent = navigator.userAgent.toLowerCase();
      if (agent.indexOf('micromessenger') < 0) {
          share_();
      } else {
          share();
      }
  });
  $(".alw-layer, .alw-wx-layer").on("click", function() {
      $(this).hide();
  });
	// 过滤已投递恢复
	var recoverDeliver = '<?php echo (_I($_GET['deliver'])); ?>';
	if (eval(recoverDeliver)) {
		$('.js-clickedbox').addClass('clickedchoice');
	}
    var recoverNature = '<?php echo (_I($_GET['nature'])); ?>';
    var recoverEducation = '<?php echo (_I($_GET['education'])); ?>';
    var recoverJobtag = '<?php echo (_I($_GET['jobtag'])); ?>';
    var recoverTrade = '<?php echo (_I($_GET['trade'])); ?>';
    var recoverSettr = '<?php echo (_I($_GET['settr'])); ?>';
    var isChangeColor = false;
    if (eval(recoverDeliver) > 0 || eval(recoverNature) > 0 || eval(recoverEducation) > 0 || eval(recoverJobtag) > 0 || eval(recoverTrade) > 0 || eval(recoverSettr) > 0) {
        isChangeColor = true;
    }
    if (isChangeColor) {
        $('.j-change-color').addClass('red-txt');
    }
    setTimeout(function() {
        var noLimitCityHtml = '<div class="f-btn-submit qs-center"><div class="qs-btn qs-btn-inline qs-btn-medium qs-btn-border-orange" id="j-cate-city" style="margin-right:.25rem;">按地区</div><div class="qs-btn qs-btn-inline qs-btn-medium qs-btn-orange" id="j-cate-range" style="margin-right:.25rem;">附近职位</div><div class="qs-btn qs-btn-inline qs-btn-medium qs-btn-orange" id="j-no-limit-city">不限</div></div>';
        $('.f-box-city').append(noLimitCityHtml);
    }, 100)
    $('#j-no-limit-city').die().live('click', function() {
        window.location = "<?php echo P(array('citycategory'=>'','range'=>''));?>";
    })
    // 职位亮点随机背景色
    function randomsort(a, b) {  
        return Math.random()>.5 ? -1 : 1;
    }
    var bgArrBefore = [1,2,3,4];
    $('.job-list-item').each(function () {
        var $jobTagDom = $(this).find('.job-tag');
        if ($jobTagDom.length) {
            var bgArray = bgArrBefore.sort(randomsort);
            $($jobTagDom).each(function (index, value) {
                $(this).addClass('tg' + bgArray[index]);
            })
        }
    })
    
	// 更多列表左右切换
	 $('.js-more-l').on('click', function () {
		 var targetId = $(this).data('id');
		 $('.f-box-more').toggleClass('qs-actionsheet-toggle-left');
		 $('#' + targetId).toggleClass('qs-actionsheet-toggle');
	 })
	 $('.f-more-back-btn').on('click', function () { // 更多列表切换返回
		 $('.f-box-more').toggleClass('qs-actionsheet-toggle-left');
		 $('.f-more-content').removeClass('qs-actionsheet-toggle');
	 })
	 $('.f-more-back-a').on('click', function () { // 更多列表项点击
	 	 var thisType = $(this).data('type');
		 var thisTitle = $(this).data('title');
		 var thisCode = $(this).data('code');
		 $('.f-more-l-code-' + thisType).val(thisCode);
		 $('.f-more-l-txt-' + thisType).text(thisTitle);
		 $('.f-box-more').toggleClass('qs-actionsheet-toggle-left');
		 $('.f-more-content').removeClass('qs-actionsheet-toggle');
	 })
		// 除更多和读取缓存之外的下拉列表
	 $('.f-item-normal').on('click', function () {
		 var thisType = $(this).data('type');
		 var thisTitle = $(this).data('title');
		 var thisCode = $(this).data('code');
		 $('.f-normal-code-' + thisType).val(thisCode);
		 $('.f-normal-txt-' + thisType).text(thisTitle);
		 $('body').removeClass('filter-fixed');
		 $('.f-box-' + thisType).addClass('qs-hidden');
		 $('.js-filter').removeClass('active');
		 $('#f-mask').hide();
		 goPage();
	 })
	 // 过滤已投递
	 $('.js-clickedbox').on('click', function () {
		 if ($(this).hasClass('clickedchoice')) {
		 	 $(this).removeClass('clickedchoice');
			 $('.f-deliver').val('0');
		 } else {
			 $(this).addClass('clickedchoice');
			 $('.f-deliver').val('1');
		 }
	 })
	// 清空已选分类
	$('.js-clearjob-jobcategory').on('click', function () {
		$('.qs-recover-code-job').val('');
		goPage();
	})
	 // 跳转方法
	 function goPage() {
		 var toSearchPage = $('.f-seach-page').val();
		 window.location.href = qscms.root + toSearchPage + $('#searchForm').serialize();
	 }
		// 点击筛选
		$('#f-do-filter').on('click', function () {
			goPage();
		});
    var isVisitor = "<?php echo C('visitor.uid');?>";
    var utype = "<?php echo C('visitor.utype');?>";
    $('.js-filter').on('click', function () {
      var filter = new QSfilter($(this));
	    document.getElementById('f-mask').ontouchstart = function(e){ e.preventDefault(); }
    });
    // 申请职位点击事件绑定
    $(".apply_jobs").on('click',function(){
      var url = "<?php echo U('ajaxPersonal/resume_apply');?>";
      var jid = $(this).data('jid');
      if ((isVisitor > 0)) {
        $.getJSON(url,{jid:jid},function(result){
          if(result.status==1){
            qsToast({type:1,context: result.msg});
          } else if(eval(result.dialog)) {
              var data = result.data;
              if (data.id){
                  var $mPop = new QSpopout();
                  var url = "<?php echo U('Personal/resume_edit',array('pid'=>Placeholder));?>";
                  url = url.replace('Placeholder',data.id);
                  $mPop.setContent('<div class="link_yellow" style="line-height: 180%;">您的简历完整度只有 <strong>'+data.percent+'%</strong>，该公司要求达到 <strong><?php echo C("qscms_apply_job_min_percent");?>%</strong> 才可以申请，请<a href="'+url+'">继续完善</a>吧</div>');
                  $mPop.show();
                  $mPop.getPrimaryBtn().on('click', function () {
                      window.location.href = url;
                  });
              }else{
                  qsToast({type:2,context: result.msg});
                  return false;
              }
          }else {
            qsToast({type:2,context: result.msg});
            return false;
          }
        });
      } else {
           var regResume = "<?php echo C('qscms_rapid_registration_resume');?>";
          if(regResume == 1){
            window.location.href = qscms.root + '?m=Mobile&c=AjaxPersonal&a=resume_add_dig&jid=' + jid;
          }else{
            window.location.href = "<?php echo url_rewrite('QS_login');?>";
          }
      }
    });
    // 领取红包点击事件绑定
    $(".J_applyForJobAllowance").on('click',function(){
      var url = qscms.root+"?m=Mobile&c=AjaxAllowance&a=apply_allowance";
      var jid = $(this).data('jid');
      if ((isVisitor > 0)) {
        if(utype != 2){
          qsToast({type:2,context: '请登录个人会员'});
          return false;
        }
        $.getJSON(url,{jid:jid},function(data){
          if(data.status==1){
            $('body').append(data.data.html);
          } 
          else
            {
                qsToast({type:2,context: data.msg});
                if(data.status==2){
                    setTimeout(function() {
                        location.href=qscms.root+"?m=Mobile&c=Personal&a=resume_add";
                    },2000);
                }
            }
        });
      } else {
          window.location.href="<?php echo url_rewrite('QS_login');?>";
      }
    });
    wx.config({
    // debug: true,
    appId: '<?php echo ($signPackage["appId"]); ?>',
    timestamp: '<?php echo ($signPackage["timestamp"]); ?>',
    nonceStr: '<?php echo ($signPackage["nonceStr"]); ?>',
    signature: '<?php echo ($signPackage["signature"]); ?>',
    jsApiList: [
      // 所有要调用的 API 都要加到这个列表中
      "onMenuShareTimeline",
      "onMenuShareAppMessage",
      "onMenuShareQQ",
      "onMenuShareWeibo"
    ]
  });
  wx.ready(function () 
  {
      var linkUrl = "<?php echo build_mobile_url(array('c'=>'Jobs','a'=>'index'));?>";//放链接
       if(<?php echo C('qscms_perfected_resume_allowance_open');?> ==1){
          var title = "在<?php echo C('qscms_site_name');?>找工作可以领红包，小伙伴们快来围观！";
          var desc = "在<?php echo C('qscms_site_name');?>不仅可以找到好的工作，还可以领红包赚外快，还等什么，快来领取红包！"; 
      }else{
           var title = "找工作就来<?php echo C('qscms_site_name');?>，钱多活少离家近，海量职位等你选！";
           var desc = "在<?php echo C('qscms_site_name');?>这里有海量的公司，海量的职位，可以帮你尽快找到一份合适满意的工作！小伙伴们快来围观！"; 
      }
      var imgUrl="<?php if(C('qscms_logo_other')): echo attach(C('qscms_logo_other'),'resource'); else: ?>__HOMEPUBLIC__/images/logo_other.png<?php endif; ?>";//图片链接
      wx.onMenuShareTimeline({
          title: title, // 分享标题
          desc: desc, // 分享描述
          link: linkUrl, // 分享链接
          imgUrl: imgUrl, // 分享图标
          success: function () { 
          // 用户确认分享后执行的回调函数
          },
          cancel: function () { 
              // 用户取消分享后执行的回调函数
          }
      });
      wx.onMenuShareAppMessage({
          title: title, // 分享标题
          desc: desc, // 分享描述
          link: linkUrl, // 分享链接
          imgUrl: imgUrl, // 分享图标
          type: '', // 分享类型,music、video或link，不填默认为link
          dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                    success: function () { 
          // 用户确认分享后执行的回调函数
          },
          cancel: function () { 
              // 用户取消分享后执行的回调函数
          }
      });
      wx.onMenuShareQQ({
          title: title, // 分享标题
          desc: desc, // 分享描述
          link: linkUrl, // 分享链接
          imgUrl: imgUrl, // 分享图标
                    success: function () { 
          // 用户确认分享后执行的回调函数
          },
          cancel: function () { 
              // 用户取消分享后执行的回调函数
          }
      });
      wx.onMenuShareWeibo({
          title: title, // 分享标题
          desc: desc, // 分享描述
          link: linkUrl, // 分享链接
          imgUrl: imgUrl, // 分享图标
                    success: function () { 
          // 用户确认分享后执行的回调函数
          },
          cancel: function () { 
              // 用户取消分享后执行的回调函数
          }
      });
  });
    function getLocation()
    {
        if (navigator.geolocation)
        {
            navigator.geolocation.getCurrentPosition(showPosition, showError,{
                // 指示浏览器获取高精度的位置，默认为false
                enableHighAccuracy: true,
                // 指定获取地理位置的超时时间，默认不限时，单位为毫秒
                timeout: 5000,
                // 最长有效期，在重复获取地理位置时，此参数指定多久再次获取位置。
                maximumAge: 3000
            });
        }
        else
        {
            baiduapi_geolocation();
        }
    }
    function showError(error)
    {
        switch(error.code)
        {
        case error.PERMISSION_DENIED:
        case error.POSITION_UNAVAILABLE:
        case error.TIMEOUT:
        case error.UNKNOWN_ERROR:
            baiduapi_geolocation();
            break;
        }
    }
    function showPosition(position)
    {
        set_geolocation_cookie(position.coords.latitude,position.coords.longitude,30);
    }
    //设置定位cookie
    function set_geolocation_cookie(lat,lng,min){
        $("#lat").val(lat);
        $("#lng").val(lng);
        var expiresDate= new Date();
        expiresDate.setTime(expiresDate.getTime() + (min * 60 * 1000));
        $.fn.cookie('cookie_lat', lat,{path : '<?php echo C("qscms_site_dir");?>',expires:expiresDate});
        $.fn.cookie('cookie_lng', lng,{path : '<?php echo C("qscms_site_dir");?>',expires:expiresDate});
    }
    //百度地图定位
    function baiduapi_geolocation(){
        var geolocation = new BMap.Geolocation();
        geolocation.getCurrentPosition(function(r){
            if(this.getStatus() == BMAP_STATUS_SUCCESS)
            {
                set_geolocation_cookie(r.point.lat,r.point.lng,30);
            }
            else 
            {
                set_geolocation_cookie("<?php echo C('qscms_map_center_y');?>","<?php echo C('qscms_map_center_x');?>",5);
            }        
        },{enableHighAccuracy: true})
    }
    $(document).ready(function(){
        var cookie_lat = $.fn.cookie('cookie_lat');
        var cookie_lng = $.fn.cookie('cookie_lng');
        if(cookie_lat && cookie_lng){
            $("#lat").val(cookie_lat);
            $("#lng").val(cookie_lng);
        }else{
            getLocation();
        }
    });
</script>
</html>