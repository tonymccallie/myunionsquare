<?php foreach($articles as $article): ?>
<div class="row-fluid article">
	<div class="span4">
		<?php echo !empty($article['News']['photo'])?$this->Html->image('thumb/'.$article['News']['photo'].'/width:800/height:600/crop:true/zoom:auto/'.$article['News']['photo']):'NO PHOTO' ?>
	</div>
	<div class="span8">
		<h4><?php echo $this->Html->link($article['News']['title'],array('controller'=>'news','action'=>'view',$article['News']['id'])) ?></h4>
		<p><?php echo str_replace("\n","<br />",$article['News']['body']) ?></p>
		<div><i>By: <?php echo $article['User']['first_name'].' '.$article['User']['last_name'] ?> - <?php echo date('M dS',strtotime($article['News']['created'])) ?> (<span id="article_<?php echo $article['News']['id'] ?>"><?php echo count($article['Like']) ?></span> likes)</i></div><br>
		<div class="row-fluid">
			<div class="span6">
				<?php
					if(!$article['News']['liked']) {
						echo $this->Html->link('<i class="icon-thumbs-up"></i>Like</a>','/news/like/'.$article['News']['id'].'/'.$USER['User']['id'],array('class'=>'btn btn-block like','escape'=>false, 'rel' => 'article_'.$article['News']['id']));
					} else {
						echo $this->Html->link('<i class="icon-thumbs-up-alt"></i>Unlike</a>','/news/dislike/'.$article['News']['id'].'/'.$USER['User']['id'],array('class'=>'btn btn-block like unlike','escape'=>false, 'rel' => 'article_'.$article['News']['id']));
					}
				?>
			</div>
			<div class="span6">
				<?php
					if($comment) {
						echo $this->Html->link('<i class="icon-thumbs-up"></i>Comment',array('controller'=>'news','action'=>'view',$article['News']['id']),array('escape'=>false,'class'=>'btn btn-block'));
					}
				?>
			</div>
		</div>
	</div>
</div>
<?php endforeach ?>