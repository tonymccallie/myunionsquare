<div class="admin_header">
	<h3>
		<?php echo $article['News']['title'] ?>
	</h3>
</div>
<div class="row-fluid">
	<div class="span8">
		<?php echo str_replace("\n","<br />",$article['News']['body']) ?>
	</div>
	<div class="span4">
		<div class="well">
			<?php echo ($USER['User']['id'] == $article['News']['user_id'])?$this->Html->link('Edit This Post',array('action'=>'edit',$article['News']['id']),array('class'=>'btn btn-block')):'' ?>
			<?php
				if(!$article['News']['liked']) {
					echo $this->Html->link('<i class="icon-thumbs-up"></i>Like</a>','/news/like/'.$article['News']['id'].'/'.$USER['User']['id'],array('class'=>'btn btn-block like','escape'=>false));
				} else {
					echo $this->Html->link('<i class="icon-thumbs-up-alt"></i>Unlike</a>','/news/dislike/'.$article['News']['id'].'/'.$USER['User']['id'],array('class'=>'btn btn-block like','escape'=>false));
				}
			?>
		</div>
	</div>
</div>