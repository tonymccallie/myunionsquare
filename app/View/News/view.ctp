<div class="row-fluid">
	<h3>
		<?php echo $news['News']['title'] ?>
	</h3>
</div>
<div class="row-fluid">
	<div class="span8">
		
		<p><?php echo str_replace("\n","<br />",$news['News']['body']) ?></p>
		<div class="row-fluid">
			<div class="span6">
				<?php echo ($USER['User']['id'] == $news['News']['user_id'])?$this->Html->link('Edit This Post',array('action'=>'edit',$news['News']['id']),array('class'=>'btn btn-block')):'' ?>
			</div>
			<div class="span6">
				<?php
					if(!$news['News']['liked']) {
						echo $this->Html->link('<i class="icon-thumbs-up"></i> Like ('.count($news['Like']).')</a>','/news/like/'.$news['News']['id'].'/'.$USER['User']['id'],array('class'=>'btn btn-block like','escape'=>false));
					} else {
						echo $this->Html->link('<i class="icon-thumbs-up-alt"></i> Unlike ('.count($news['Like']).')</a>','/news/dislike/'.$news['News']['id'].'/'.$USER['User']['id'],array('class'=>'btn btn-block like unlike','escape'=>false));
					}
				?>
			</div>
		</div>
		<?php echo $this->element('comments',array('comments'=>$news['Comment'],'parent_id'=>$news['News']['id'],'model'=>'News')) ?>
	</div>
	<div class="span4">
		<?php echo !empty($news['News']['photo'])?$this->Html->image('thumb/'.$news['News']['photo'].'/width:800/height:600/crop:true/zoom:auto/'.$news['News']['photo']).'<p><br /></p>':'' ?>
	</div>
</div>