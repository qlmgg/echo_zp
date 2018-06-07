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
		<link rel="stylesheet" href="../public/css/index.css">
	</head>
	<body>
        <input type="hidden" id="pageSoType" value="1">
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
  <?php $tag_hotword_class = new \Common\qscmstag\hotwordTag(array('列表名'=>'hotword_list','显示数目'=>'12','cache'=>'0','type'=>'run',));$hotword_list = $tag_hotword_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"网站首页","title"=>"骑士PHP高端人才系统(www.74cms.com)","keywords"=>"骑士人才系统，74cms，骑士cms，人才网站源码，php人才网程序","description"=>"骑士CMS是基于PHP+MYSQL的免费网站管理系统，提供完善的人才招聘网站建设方案","header_title"=>""),$hotword_list);?>
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
		<div class="new-index-top">
			<div class="ni-head <?php if($apply['Subsite']): ?>sub<?php endif; ?>" style="background-color:<?php if(C('qscms_mobile_top_color') == ''): ?>#0180CC<?php else: echo C('qscms_mobile_top_color'); endif; ?>;">
				<?php if(empty($sitegroup)): if($apply['Subsite']): ?><div class="m-sub-txt-group">
							<div class="stg-txt font13"><?php echo C('SUBSITE_VAL.s_sitename');?></div>
							<div class="stg-icon"></div>
							<div class="clear"></div>
						</div>
						<?php if(($subsite_choose_type) == "simple"): ?><div class="m-sub-filter-page">
								<div class="msp-head">
									<div class="msp-input-group">
										<div class="msg-icon-ser"></div>
										<input type="text" class="msg-input-ser" placeholder="输入地区名称进行筛选">
										<div class="suo-close js-suo-close"></div>
										<div class="clear"></div>
									</div>
									<div class="msp-cancel-btn">取消</div>
									<div class="clear"></div>
								</div>
								<div class="m-sub-head-tip font12">请您切换到对应的地区分站，让我们为您提供更准确的信息</div>
								<?php if($subsite_org): ?><div class="m-sub-city-head link_blue">进入 <a href="<?php echo U('subsite/set',array('sid'=>$subsite_org['s_id']));?>"><?php echo ($subsite_org["s_sitename"]); ?></a> 或者切换到以下站点</div>
									<?php else: ?>
									<div class="m-sub-city-head link_blue">切换到以下站点</div><?php endif; ?>
								<div class="m-sub-city-group">
									<?php if(is_array($district)): $i = 0; $__LIST__ = $district;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$district): $mod = ($i % 2 );++$i;?><div class="m-sub-city-box"><a href="<?php echo U('subsite/set',array('sid'=>$district['s_id']));?>" class="m-sub-city-cell" title="<?php echo ($district["s_sitename"]); ?>" alias="<?php echo ($district["s_spell"]); ?>"><?php echo ($district["s_sitename"]); ?></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
									<div class="clear"></div>
								</div>
								<div class="m-sub-city-no-data">
									<div class="sub-no-data-cell link_blue">
										抱歉，没有找到相关的地区立即进入 <a href="<?php echo U('subsite/set',array('sid'=>0));?>">[总站]</a>
									</div>
								</div>
							</div>
							<?php else: ?>
							<div class="m-sub-filter-page-complex">
								<div class="msp-head">
									<div class="msp-input-group">
										<div class="msg-icon-ser"></div>
										<input type="text" class="msg-input-ser" placeholder="输入地区名称进行筛选">
										<div class="suo-close js-suo-close"></div>
										<div class="clear"></div>
									</div>
									<div class="msp-cancel-btn">取消</div>
									<div class="clear"></div>
								</div>
								<div class="search_subsite_ajax"><ul id="search_subsite"></ul></div>
								<div id="choose-box">
									<div class="m-sub-head-tip font12">请您切换到对应的地区分站，让我们为您提供更准确的信息</div>
									<?php if($subsite_org): ?><div class="m-sub-city-head t-center link_blue">定位城市：<a href="<?php echo U('subsite/set',array('sid'=>$subsite_org['s_id']));?>"><?php echo ($subsite_org["s_sitename"]); ?></a><span>进入<a href="<?php echo U('subsite/set',array('sid'=>0));?>">总站</a></span></div>
										<?php else: ?>
										<div class="m-sub-city-head link_blue">切换到以下站点<span>进入<a href="<?php echo U('subsite/set',array('sid'=>0));?>">总站</a></span></div><?php endif; ?>
									<div class="m-sub-split-block"></div>
									<div class="city-box">
										<div class="m-sub-city-group font13">
											<div class="title list_height"><span class="title-img">按字母排序</span></div>
											<div class="word-ul">
												<?php if(is_array($word_arr)): $i = 0; $__LIST__ = $word_arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$word): $mod = ($i % 2 );++$i; if(!empty($district[$word])): ?><a href="#cityblock<?php echo ($word); ?>" class="word-li" data-nm="true"><?php echo ($word); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
												<div class="clear"></div>
											</div>
										</div>
										<?php if(is_array($word_arr)): $i = 0; $__LIST__ = $word_arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$word): $mod = ($i % 2 );++$i; if(!empty($district[$word])): ?><div class="m-sub-split-block"></div>
												<div class="m-sub-city-group font13">
													<a name="cityblock<?php echo ($word); ?>" id="cityblock<?php echo ($word); ?>"> </a>
													<div class="title list_height city-word"><span class="img font10"><?php echo ($word); ?></span> 以 <?php echo ($word); ?> 为开头的城市名</div>
													<?php if(is_array($district[$word])): $i = 0; $__LIST__ = $district[$word];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="m-sub-city-box"><a href="<?php echo U('subsite/set',array('sid'=>$vo['s_id']));?>" class="m-sub-city-cell" title="<?php echo ($vo["s_sitename"]); ?>" alias="<?php echo ($vo["s_spell"]); ?>"><?php echo ($vo["s_sitename"]); ?></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
													<div class="clear"></div>
												</div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
									</div>
									<div class="m-sub-city-no-data">
										<div class="sub-no-data-cell link_blue">
											抱歉，没有找到相关的地区立即进入 <a href="<?php echo U('subsite/set',array('sid'=>0));?>">[总站]</a>
										</div>
									</div>
								</div>
							</div><?php endif; endif; ?>
				<?php else: ?>
	                <div class="m-sub-txt-group">
						<div class="stg-txt font13"><?php echo ($sitegroup_org["name"]); ?></div>
						<div class="stg-icon"></div>
						<div class="clear"></div>
					</div>
					<div class="m-sub-filter-page">
						<div class="msp-head">
							<div class="msp-input-group">
								<div class="msg-icon-ser"></div>
								<input type="text" class="msg-input-ser" placeholder="输入地区名称进行筛选">
								<div class="suo-close js-suo-close"></div>
								<div class="clear"></div>
							</div>
							<div class="msp-cancel-btn">取消</div>
							<div class="clear"></div>
						</div>
						<div class="m-sub-head-tip font12">请您切换到对应的地区分站，让我们为您提供更准确的信息</div>
						<div class="m-sub-city-head link_blue">切换到以下站点</div>
						<div class="m-sub-city-group">
							<?php if(is_array($sitegroup)): $i = 0; $__LIST__ = array_slice($sitegroup,0,10,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dis): $mod = ($i % 2 );++$i;?><div class="m-sub-city-box"><a href="<?php echo ($dis["domain"]); ?>" class="m-sub-city-cell" title="<?php echo ($dis["name"]); ?>" alias="<?php echo ($dis["spell"]); ?>"><?php echo ($dis["name"]); ?></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
							<div class="clear"></div>
						</div>
					</div><?php endif; ?>
                <?php if(C('qscms_logo_mobile') == ''): ?><div class="nih-l font18"><?php if(C('SUBSITE_VAL.s_id') > 0): echo C('SUBSITE_VAL.s_title'); else: echo C('qscms_site_name'); endif; ?></div>
                <?php else: ?>
                <div class="logo"><img src="<?php echo attach(C('qscms_logo_mobile'),'resource');?>"></div><?php endif; ?>
				<div class="ni-user">
					<a href="<?php echo U('Im/user_list');?>"><img src="../public/images/308.png"><span id="J_imStatus"></span></a>
					<a href="<?php echo U('Members/login');?>"><img src="../public/images/249.png"></a>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="index-slider">
			<div id="hwslider" class="hwslider">
				<ul>
				<?php if(!empty($index_focus)): if(is_array($index_focus)): $i = 0; $__LIST__ = $index_focus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li <?php if($vo['url'] != ''): ?>onclick="javascript:location.href='<?php echo ($vo['url']); ?>'"<?php endif; ?>><img class="s-img" src="<?php echo attach($vo['content'],'attach_img');?>" alt="<?php echo ($vo['explain']); ?>"></li><?php endforeach; endif; else: echo "" ;endif; ?>
				<?php else: ?>
					<li><img class="s-img" src="http://www.74cms.com/plus/m_ad.png" alt=""></li><?php endif; ?>
				</ul>
			</div>
		</div>
        <div class="ni-search-g">
            <div class="nis-box font14 js-show-qspageso">请输入职位名/公司名<div class="nis-s-icon"></div></div>
        </div>
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
        <!--图标组合-->
        <div class="ic-group font12">
            <div class="ic-line <?php if(count($nav) == 2): ?>ic2<?php elseif(count($nav) == 3): ?>ic3<?php endif; ?>">
                <?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="ic-cell" data-url="<?php echo ($vo['url']); ?>" data-alias="<?php echo ($vo['alias']); ?>" <?php if($vo['alias'] != 'nearbyjobs'): ?>onclick="javascript:location.href='<?php echo ($vo['url']); ?>'"<?php endif; ?>>
                    <div class="ic-img"><img src="<?php if($vo['nav_img'] == ''): echo attach($vo['alias'].'.png','resource/mobile_nav'); else: echo attach($vo['nav_img'],'images'); endif; ?>" alt=""></div>
                    <div class="ic-text"><?php echo ($vo['show_name']); ?></div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
                <div class="clear"></div>
            </div>
        </div>
        <!--图标组合end-->
		<div class="indexnotice">
		  <div class="leftimg"><img src="../public/images/11.png"></div>
		  <?php $tag_notice_list_class = new \Common\qscmstag\notice_listTag(array('列表名'=>'notice_list','显示数目'=>'10','分类'=>'1','排序'=>'addtime:desc','cache'=>'0','type'=>'run',));$notice_list = $tag_notice_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"网站首页","title"=>"骑士PHP高端人才系统(www.74cms.com)","keywords"=>"骑士人才系统，74cms，骑士cms，人才网站源码，php人才网程序","description"=>"骑士CMS是基于PHP+MYSQL的免费网站管理系统，提供完善的人才招聘网站建设方案","header_title"=>""),$notice_list);?>
			<ul class="txt ul-upscroll">
		  <?php if(is_array($notice_list['list'])): $i = 0; $__LIST__ = $notice_list['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$notice): $mod = ($i % 2 );++$i;?><li class="" onClick="javascript:location.href='<?php echo ($notice["url"]); ?>'"><?php echo ($notice["title"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		  <div class="clear"></div>
		</div>
        <!--红包职位-->
        <?php if(C('apply.Allowance')): $tag_jobs_list_class = new \Common\qscmstag\jobs_listTag(array('列表名'=>'jobslist','搜索内容'=>'allowance','显示数目'=>'4','排序'=>'rtime','cache'=>'0','type'=>'run',));$jobslist = $tag_jobs_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"网站首页","title"=>"骑士PHP高端人才系统(www.74cms.com)","keywords"=>"骑士人才系统，74cms，骑士cms，人才网站源码，php人才网程序","description"=>"骑士CMS是基于PHP+MYSQL的免费网站管理系统，提供完善的人才招聘网站建设方案","header_title"=>""),$jobslist);?>
		<div class="split-block"></div>
        <div class="index-alw">
            <div class="alw-title font14">
                <div class="alw-t">红包职位</div>
                <div class="alw-link link_gray9"><a href="<?php echo url_rewrite('QS_jobslist',array('search_cont'=>'allowance'));?>">共<span class="txt-red"><?php echo ($jobslist['allowance_count']); ?></span>个红包职位 ></a></div>
                <div class="clear"></div>
            </div>
            <div class="alw-group">
            	<?php if(is_array($jobslist['list'])): $k = 0; $__LIST__ = $jobslist['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div class="alw-cell" onclick="javascript:location.href='<?php echo ($vo['jobs_url']); ?>'">
                    <div class="ac-h font13">
                        <div class="ach-l"><?php echo ($vo['allowance_info']['type_cn']); ?></div>
                        <div class="ach-r">￥<?php echo ($vo['allowance_info']['per_amount']); ?></div>
                        <div class="clear"></div>
                    </div>
                    <div class="ac-wave"></div>
                    <div class="ac-ten">
                        <div class="sp-h-25"></div>
                        <div class="act-line substring font14 txt-3"><?php echo ($vo['jobs_name']); ?></div>
                        <div class="sp-h-19"></div>
                        <div class="act-line substring font12 txt-9"><?php echo ($vo['short_name']); ?></div>
                    </div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
                <div class="clear"></div>
            </div>
        </div><?php endif; ?>
        <!--红包职位end-->
        <!--名企专区-->
        <div class="vip-box">
            <div class="vip-head"><div class="con font13"><div class="icon">名企专区</div></div></div>
            <div class="vip-group">
                <?php $tag_company_jobs_list_class = new \Common\qscmstag\company_jobs_listTag(array('列表名'=>'company_list','名企'=>'1','显示数目'=>'6','职位数量'=>'0','企业名长度'=>'6','cache'=>'0','type'=>'run',));$company_list = $tag_company_jobs_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"网站首页","title"=>"骑士PHP高端人才系统(www.74cms.com)","keywords"=>"骑士人才系统，74cms，骑士cms，人才网站源码，php人才网程序","description"=>"骑士CMS是基于PHP+MYSQL的免费网站管理系统，提供完善的人才招聘网站建设方案","header_title"=>""),$company_list);?>
                <?php if(is_array($company_list['list'])): $i = 0; $__LIST__ = $company_list['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$company): $mod = ($i % 2 );++$i;?><div class="vip-cell" onclick="javascript:location.href='<?php echo ($company["company_url"]); ?>'">
                    <div class="img"><img src="<?php if(empty($company['logo'])): echo attach('no_logo.png','resource'); else: echo attach($company['logo'],'company_logo'); endif; ?>" alt="<?php echo ($company["short_name"]); ?>"></div>
                    <div class="v-txt"><?php echo ($company["short_name"]); ?></div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
                <div class="clear"></div>
            </div>
        </div>
        <!--名企专区end-->
        <!--广告位-->
        <?php if(!empty($index_block)): ?><div class="middle-ad">
			<?php if(is_array($index_block)): $i = 0; $__LIST__ = $index_block;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="mad-cell" <?php if($vo['url'] != ''): ?>onclick="javascript:location.href='<?php echo ($vo['url']); ?>'"<?php endif; ?>><img src="<?php echo attach($vo['content'],'attach_img');?>" alt="<?php echo ($vo['explain']); ?>"></div><?php endforeach; endif; else: echo "" ;endif; ?>
            <div class="clear"></div>
        </div><?php endif; ?>
        <!--广告位 end-->
        <!--最新人才-->
        <div class="resume-box">
            <div class="resume-head"><div class="con font13"><div class="icon">最新人才</div></div></div>
            <div class="resume-group">
                <div class="list-box">
                <?php $tag_resume_list_class = new \Common\qscmstag\resume_listTag(array('列表名'=>'recommend_resume','照片'=>'1','显示数目'=>'4','cache'=>'0','type'=>'run',));$recommend_resume = $tag_resume_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"网站首页","title"=>"骑士PHP高端人才系统(www.74cms.com)","keywords"=>"骑士人才系统，74cms，骑士cms，人才网站源码，php人才网程序","description"=>"骑士CMS是基于PHP+MYSQL的免费网站管理系统，提供完善的人才招聘网站建设方案","header_title"=>""),$recommend_resume);?>
                <?php if(is_array($recommend_resume['list'])): $i = 0; $__LIST__ = $recommend_resume['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$resume): $mod = ($i % 2 );++$i;?><div class="list-cell" onclick="javascript:location.href='<?php echo ($resume["resume_url"]); ?>'">
                        <div class="img"><img src="<?php echo ($resume["photosrc"]); ?>" alt="<?php echo ($resume["fullname"]); ?>"></div>
                        <div class="r-name"><?php echo ($resume["fullname"]); ?></div>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                    <div class="clear"></div>
                </div>
                <div class="r-more"><a href="<?php echo url_rewrite('QS_resumelist');?>" class="rm font13">查看更多</a></div>
            </div>
        </div>
        <!--最新人才end-->
        <!--最新职位-->
        <div class="job-box" id="recommend_jobs_box"></div>
        <!--最新职位 end-->
		<div class="qsfooter link_gray6 font10">
    <div class="fo-tel">电话：<?php echo C('qscms_bootom_tel');?></div>
    <div class="fo-icp">ICP：<?php echo C('qscms_icp');?></div>
    <div class="fo-app"><a href="<?php echo C('qscms_site_domain'); echo C('qscms_site_dir');?>index.php?m=Mobile&c=Index&a=app_download">手机APP</a></div>
    <div class="clear"></div>
</div>
        <?php if(C('qscms_footer_nav_status') == 1): ?><div class="bottom-nav-bar-group">
                <div class="bottom-nav-bar">
                    <div class="nav-bar-cell qs-left">
                        <a href="<?php echo url_rewrite('QS_index');?>" class="bar-cell index active">
                            <div class="b-img"></div>
                            <div class="b-txt font10">首页</div>
                        </a>
                        <a href="<?php echo url_rewrite('QS_jobslist');?>" class="bar-cell job">
                            <div class="b-img"></div>
                            <div class="b-txt font10">工作</div>
                        </a>
                        <div class="clear"></div>
                    </div>
                    <div class="nav-bar-more qs-left for-event">
                        <div class="nav-bar-more-cell js-b-nav-bar"></div>
                    </div>
                    <div class="nav-bar-cell qs-left">
                        <a href="<?php echo url_rewrite('QS_resumelist');?>" class="bar-cell resume">
                            <div class="b-img"></div>
                            <div class="b-txt font10">简历</div>
                        </a>
                        <a href="<?php echo url_rewrite('QS_login');?>" class="bar-cell mine">
                            <div class="b-img"></div>
                            <div class="b-txt font10">我的</div>
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
        <div class="left_float_bar font12">
            <?php if(C('qscms_weixin_img')): ?><span class="img-dialog J_sub_us"> 订阅 <i></i> 我们 </span><?php endif; ?>
            <?php if(C('qscms_weixin_service_img')): ?><span class="img-dialog J_con_us"> 联系 <i></i> 客服 </span><?php endif; ?>
        </div>
	</body>
	<script src="../public/js/zepto.hwSlider.js"></script>
	<script src="../public/js/fx.js"></script>
	<script src="../public/js/touch-0.2.14.min.js"></script>
	<script src="../public/js/zepto.textSlider.js"></script>
	<script type="text/javascript" src="https://api.map.baidu.com/api?v=2.0&ak=<?php echo C('qscms_map_ak');?>"></script>
	<script>
        // 订阅我们
        <?php if(C('qscms_weixin_img')): ?>$('.J_sub_us').on('click', function () {
	            var $subPop = new QSpopout();
	            $subPop.setContent('<img class="left_float_img" src="<?php echo attach(C('qscms_weixin_img'),'resource');?>"><p>长按二维码识别关注</p><p></p>');
	            $subPop.setBtn(1, ['确定']);
	            $subPop.show();
	        })<?php endif; ?>
        <?php if(C('qscms_weixin_service_img')): ?>// 联系客服
	        $('.J_con_us').on('click', function () {
	            var $subPop = new QSpopout();
	            $subPop.setContent('<img class="left_float_img" src="<?php echo attach(C('qscms_weixin_service_img'),'resource');?>"><p>长按二维码添加客服微信</p><p></p>');
	            $subPop.setBtn(1, ['确定']);
	            $subPop.show();
	        })<?php endif; ?>
		// 职位、简历数量动态效果
		var jobCount = '<?php echo ($jobs_count); ?>';
		var resumeCount = '<?php echo ($resume_count); ?>';
		window.setTimeout(function() {
			$('.jobs-roll-count').empty();
			peopleRoll(jobCount, '.jobs-roll-count');
		}, 300)
		window.setTimeout(function() {
			$('.resume-roll-count').empty();
			peopleRoll(resumeCount, '.resume-roll-count');
		}, 5600)
		function peopleRoll(a, container) {
			function b(a) {
				for (var b = 0; b < a.length; b++) {
					var e = a.charAt(b);
					d.push(e)
				}
				c()
			}
			function c() {
				var a = 0;
				$(container).append("<span></span>");
				var b = window.setInterval(function() {
					$(container + " span").eq(e).text(a), a == d[e] && (window.clearInterval(b), e++, d[e] && c()), a++
				}, 30)
			}
			var d = [],
					e = 0,
					f = a + "";
			b(f)
		}

		// 职位简历数滚动
		$('#hwslider-count').hwSlider({
			autoPlay: true,
			dotShow: false,
			touch: false,
			interval: 5000,
			arrShow: false
		});

		// 滚动更多
		$("#hwslider").hwSlider({
			autoPlay: false,
			dotShow: true,
			touch: true,
			arrShow: false
		});

		$(".ul-upscroll").textSlider({line:1,speed:500,timer:3000});
		<?php if(!$sitegroup && $apply['Subsite']): ?>// 显示分站
			<?php if(!empty($subsite_org)): ?>showMSubPop();
		        function showMSubPop() {
		            var $mPop = new QSpopout();
		            $mPop.setContent('<div class="link_yellow" style="line-height: 180%;">我们检测到您所在地区为 <?php echo ($district_org); ?>，建议您切换至<a href="<?php echo U('subsite/set',array('sid'=>$subsite_org['s_id']));?>">[<?php echo ($subsite_org['s_sitename']); ?>]</a>，让我们为您提供更准确的职位信息。</div>');
		            $mPop.show();
		            $mPop.getPrimaryBtn().on('click', function () {
		                window.location.href = "<?php echo U('subsite/set',array('sid'=>$subsite_org['s_id']));?>";
		            });
		        }<?php endif; ?>
	        // 分站筛选
	        $('.m-sub-txt-group').on('click', function(){
	            $('.m-sub-filter-page').toggle();
	            $('.m-sub-filter-page-complex').toggle();
	        });
	        $('.msp-cancel-btn').on('click', function () {
	            $('.m-sub-filter-page').toggle();
	            $('.m-sub-filter-page-complex').toggle();
	        });
	        <?php if(($subsite_choose_type) == "simple"): ?>$('.msg-input-ser').on('keyup', function () {
	            var tVal = $(this).val();
	            if (tVal!='') {
                    $(this).closest('.msp-input-group').addClass('has-inp');
				} else {
                    $(this).closest('.msp-input-group').removeClass('has-inp');
				}
				$('.m-sub-filter-page').addClass('no-head');
	            var $subCityArr = $('.m-sub-city-cell');
	            $('.m-sub-city-box').addClass('h');
	            $.each($subCityArr, function () {
	                var eVal = $(this).attr('title');
	                if (eVal.indexOf(tVal) != -1) {
	                    $(this).parent().removeClass('h');
						$('.m-sub-filter-page').removeClass('no-data');
	                }
	            })
				$.each($subCityArr, function () {
	                var eVal = $(this).attr('alias');
	                if (eVal.indexOf(tVal) != -1) {
	                    $(this).parent().removeClass('h');
						$('.m-sub-filter-page').removeClass('no-data');
	                }
	            })
	            if (!tVal.length) {
	                $('.m-sub-city-box').removeClass('h');
					$('.m-sub-filter-page').removeClass('no-head');
					$('.m-sub-filter-page').removeClass('no-data');
	            } else {
					if (!($('.m-sub-city-box').not('.h').length)) {
						$('.m-sub-filter-page').addClass('no-data');
					}
				}
	        });
	        <?php else: ?>
	        // 搜索关联
	          $('.msg-input-ser').on('keyup', function() {
	          	var key = $(this).val();
	          	if(key!=''){
                    $(this).closest('.msp-input-group').addClass('has-inp');
	          		$('#choose-box').hide();
	          		$.getJSON("<?php echo U('ajaxCommon/subsite_by_keyword');?>",{key:key},function(result){
	                  if (result.status==1) {
	                      var reArr = result.data;
	                      if (reArr.length) {
	                          var reHtml = '';
	                          var reUrl = "<?php echo U('subsite/set',array('sid'=>'ooo'));?>";
	                          for (var i = 0; i < reArr.length; i++) {
	                                reHtml += '<li data-key="'+reArr[i].s_id+'"><a href="'+reUrl.replace('ooo',reArr[i].s_id)+'"><span class="searchFont">'+reArr[i].s_sitename+'</span></a></li>';
	                          }
	                          $('#search_subsite').html(reHtml);
	                          $('.search_subsite_ajax').show();
	                      }
	                  }else{
	                  	var reHtml = '<li><a>抱歉，没有找到相关的地区</a></li>';
	                    $('#search_subsite').html(reHtml);
                      	$('.search_subsite_ajax').show();
                      }
	              });
	          	}else{
	          	    $(this).closest('.msp-input-group').removeClass('has-inp');
                  	$('.search_subsite_ajax').hide();
                  	$('#choose-box').show();
	          	}
	          });<?php endif; endif; ?>
	    <?php if(!empty($sitegroup)): ?>// 分站筛选
	        $('.m-sub-txt-group').on('click', function(){
	            $('.m-sub-filter-page').toggle();
	            $('.m-sub-filter-page-complex').toggle();
	        });
	        $('.msp-cancel-btn').on('click', function () {
	            $('.m-sub-filter-page').toggle();
	            $('.m-sub-filter-page-complex').toggle();
	        });
	        // 搜索关联
	        $('.msg-input-ser').on('keyup', function () {
	            var tVal = $(this).val();
	            if (tVal!='') {
                    $(this).closest('.msp-input-group').addClass('has-inp');
				} else {
                    $(this).closest('.msp-input-group').removeClass('has-inp');
				}
				$('.m-sub-filter-page').addClass('no-head');
	            var $subCityArr = $('.m-sub-city-cell');
	            $('.m-sub-city-box').addClass('h');
	            $.each($subCityArr, function () {
	                var eVal = $(this).attr('title');
	                if (eVal.indexOf(tVal) != -1) {
	                    $(this).parent().removeClass('h');
						$('.m-sub-filter-page').removeClass('no-data');
	                }
	            })
				$.each($subCityArr, function () {
	                var eVal = $(this).attr('alias');
	                if (eVal.indexOf(tVal) != -1) {
	                    $(this).parent().removeClass('h');
						$('.m-sub-filter-page').removeClass('no-data');
	                }
	            })
	            if (!tVal.length) {
	                $('.m-sub-city-box').removeClass('h');
					$('.m-sub-filter-page').removeClass('no-head');
					$('.m-sub-filter-page').removeClass('no-data');
	            } else {
					if (!($('.m-sub-city-box').not('.h').length)) {
						$('.m-sub-filter-page').addClass('no-data');
					}
				}
	        });<?php endif; ?>
		$('.js-suo-close').on('click', function () {
            $(this).closest('.msp-input-group').removeClass('has-inp');
        });
        
        function show_recommend_box(type,lng,lat){
        	$.getJSON("<?php echo U('Mobile/Index/recommend_jobs_index');?>",{type:type,lng:lng,lat:lat},function(result){
                if(result.status==1){
                    $('#recommend_jobs_box').html(result.data.html);
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
                }
            });
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
        function showPosition(position)
        {
	        set_geolocation_cookie(position.coords.latitude,position.coords.longitude,30);
        }
        //设置定位cookie
        function set_geolocation_cookie(lat,lng,min){
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
		    if(!cookie_lat && !cookie_lng){
		    	getLocation();
		    }
	        $('.ic-cell').click(function(){
	        	var alias = $(this).data('alias');
	        	var url = $(this).data('url');
	        	if(alias=='nearbyjobs'){
	        		var cookie_lat = $.fn.cookie('cookie_lat');
		        	var cookie_lng = $.fn.cookie('cookie_lng');
		        	if(cookie_lat && cookie_lng){
		        		$.getJSON("<?php echo U('Index/ajax_jump_nearby');?>",{url:url,lat:cookie_lat,lng:cookie_lng},function(result){
			        		if(result.status==1){
			        			location.href=result.data;
			        		}
			        	});
		        	}else{
		        		alert("没有获取到当前位置，请稍等或刷新页面再试");
		        	}
	        	}
	        });
	        if(eval("<?php echo ($recommend_jobs_nearby); ?>")==0){
	            var type = "<?php echo ($recommend_jobs_type); ?>";
	            $.getJSON("<?php echo U('Mobile/Index/recommend_jobs_index');?>",{type:type},function(result){
	                if(result.status==1){
	                    $('#recommend_jobs_box').html(result.data.html);
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
	                }
	            });
	        }else{
	            var cookie_lat = $.fn.cookie('cookie_lat');
		        var cookie_lng = $.fn.cookie('cookie_lng');
	            var type = "<?php echo ($recommend_jobs_type); ?>";
		        if(cookie_lat && cookie_lng){
		            show_recommend_box(type,cookie_lng,cookie_lat);
		        }
	        }
        });
    </script>
</html>