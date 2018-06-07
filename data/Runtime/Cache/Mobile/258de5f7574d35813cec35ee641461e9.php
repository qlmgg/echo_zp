<?php if (!defined('THINK_PATH')) exit(); if(!empty($jobs_list)): ?><div class="job-head"><div class="con font13"><div class="icon"><?php echo ($title); ?></div></div></div>
<div class="job-group">
	<?php if(is_array($jobs_list)): $i = 0; $__LIST__ = $jobs_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jobs): $mod = ($i % 2 );++$i;?><div class="job-list-item for-event" onclick="javascript:location.href='<?php echo ($jobs["jobs_url"]); ?>'">
        <div class="line-one"><div class="job-name substring font16"><?php echo ($jobs["jobs_name"]); ?><span class="adr font12">（<?php echo ($jobs["district_cn"]); ?>）</span></div></div>
        <div class="line-two font14"><?php echo ($jobs["education_cn"]); ?>/<?php echo ($jobs["experience_cn"]); ?></div>
        <div class="line-two font14"><?php echo ($jobs["companyname"]); ?></div>
        <?php if(!empty($jobs['tag_cn'])): ?><div class="line-three fontag">
        	<?php if(is_array($jobs['tag_cn'])): $i = 0; $__LIST__ = array_slice($jobs['tag_cn'],1,4,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i;?><div class="job-tag"><?php echo ($tag); ?></div><?php endforeach; endif; else: echo "" ;endif; ?>
            <div class="clear"></div>
        </div><?php endif; ?>
        <div class="wage font16"><?php echo ($jobs["wage_cn"]); ?></div>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<div class="job-more"><a href="<?php echo ($more_url); ?>" class="rm">查看更多</a></div><?php endif; ?>