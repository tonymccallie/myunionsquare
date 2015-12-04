<?php
	$articles = array_chunk($articles, 2);
	foreach($articles as $chunk):
?>
<div class="row-fluid article">
	<?php foreach($chunk as $article): ?>
	<div class="span6">
		<h4><?php echo $this->Html->link($article['News']['title'],array('action'=>'view',$article['News']['id'])) ?></h4>
		<p><?php echo Common::truncate($article['News']['body'], 400) ?> <?php echo $this->Html->link('read more',array('action'=>'view',$article['News']['id'])) ?></p>
		<div><i>By: <?php echo $article['User']['first_name'].' '.$article['User']['last_name'] ?> - <?php echo date('M dS',strtotime($article['News']['created'])) ?> (<?php echo count($article['Like']) ?> likes)</i></div><br>
		<div class="row-fluid">
			<div class="span6">
				<?php
					if(!$article['News']['liked']) {
						echo $this->Html->link('<i class="icon-thumbs-up"></i> Like ('.count($article['Like']).')</a>','/news/like/'.$article['News']['id'].'/'.$USER['User']['id'],array('class'=>'btn btn-block like','escape'=>false));
					} else {
						echo $this->Html->link('<i class="icon-thumbs-up-alt"></i> Unlike ('.count($article['Like']).')</a>','/news/dislike/'.$article['News']['id'].'/'.$USER['User']['id'],array('class'=>'btn btn-block like','escape'=>false));
					}
				?>
			</div>
			<div class="span6">
				<?php echo $this->Html->link('<i class="icon-thumbs-up"></i>Comment',array('controller'=>'news','action'=>'view',$article['News']['id']),array('escape'=>false,'class'=>'btn btn-block')); ?>
			</div>
		</div>
	</div>
	<?php endforeach ?>
</div>
<?php endforeach ?>