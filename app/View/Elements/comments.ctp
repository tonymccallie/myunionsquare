<div id="post-comments">
	<h4>Comments</h4>
	<?php foreach($comments as $comment): ?>
		<div class="well clearfix">
			<div class="comment-image">
				<?php echo !empty($comment['User']['photo'])?$this->Html->image('thumb/'.$comment['User']['photo'].'/width:200/height:200/crop:true/zoom:auto/'.$comment['User']['photo'],array('class'=>'img-circle')):'' ?>
			</div>
			<?php echo $comment['User']['first_name'].' '.$comment['User']['last_name'] ?> - <?php echo date('M dS, h:ia',strtotime($comment['created'])) ?><br />
			<i><?php echo $comment['body'] ?></i>
		</div>
	<?php endforeach ?>
	<?php
		echo $this->Form->create('Comment',array('url'=>array('controller'=>'comments','action'=>'add')));
			echo $this->Form->input('body',array('class'=>'span12','label'=>false));
			echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$USER['User']['id']));
			echo $this->Form->input('parent_id',array('type'=>'hidden','value'=>$parent_id));
			echo $this->Form->input('model',array('type'=>'hidden','value'=>$model));
			echo $this->Form->input('controller',array('type'=>'hidden','value'=>$this->params['controller']));
			echo $this->Form->input('action',array('type'=>'hidden','value'=>$this->params['action']));
		echo $this->Form->end(array('label'=>'Submit Comment','class'=>'btn'));
	?>
</div>