<?php foreach($articles as $article): ?>
<div class="row-fluid article">
	<div class="span4">
		<?php echo !empty($article['News']['photo'])?$this->Html->image('thumb/'.$article['News']['photo'].'/width:800/height:600/crop:true/zoom:auto/'.$article['News']['photo']):'NO PHOTO' ?>
	</div>
	<div class="span8">
		<h4><?php echo $article['News']['title'] ?></h4>
		<p><?php echo str_replace("\n","<br />",$article['News']['body']) ?></p>
		<div><i>By: <?php echo $article['User']['first_name'].' '.$article['User']['last_name'] ?> - <?php echo date('M dS',strtotime($article['News']['created'])) ?> (<?php echo count($article['Like']) ?> likes)</i></div><br>
		<div class="row-fluid">
			<div class="span6">
				<?php
					if(!$article['News']['liked']) {
						echo $this->Html->link('<i class="icon-thumbs-up"></i>Like</a>','/news/like/'.$article['News']['id'].'/'.$USER['User']['id'],array('class'=>'btn btn-block','escape'=>false));
					} else {
						echo $this->Html->link('<i class="icon-thumbs-up-alt"></i>Unlike</a>','/news/dislike/'.$article['News']['id'].'/'.$USER['User']['id'],array('class'=>'btn btn-block','escape'=>false));
					}
				?>
			</div>
			<div class="span6">
				<a href="#" class="btn btn-block"><i class="icon-thumbs-up"></i>Comment</a>
			</div>
		</div>
	</div>
</div>
<?php endforeach ?>