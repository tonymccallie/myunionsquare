<div class="row-fluid">
	<div class="span9">
		<?php foreach($articles as $article): ?>
		<div class="row-fluid article">
			<div class="span4">
				<?php echo !empty($article['News']['photo'])?$this->Html->image('thumb/'.$article['News']['photo'].'/width:800/height:600/crop:true/zoom:auto'):'NO PHOTO' ?>
			</div>
			<div class="span8">
				<h4><?php echo $article['News']['title'] ?></h4>
				<p><?php echo str_replace("\n","<br />",$article['News']['body']) ?></p>
				<div><i><?php echo $article['User']['first_name'].' '.$article['User']['last_name'] ?> - <?php echo date('M dS',strtotime($article['News']['created'])) ?></i></div>
			</div>
		</div>
		<?php endforeach ?>
	</div>
	<div class="span3">
		<div class="well">
			<h5>Birthdays this week</h5>
			<div class="birthday-container">
				<div class="birthday">
					<div class="birthday-image">
						<img src="../img/teea-pic.png" alt="teea-pic" width="100" height="100" class="img-circle"/>
					</div>
					<div class="birthday-name">
						Teea Reed
					</div>
					<div class="birthday-date">
						Friday - 9/25
					</div>
					<div class="birthday-like"><i class="icon-thumbs-up-alt"></i></div>
				</div>
				<div class="birthday">
					<div class="birthday-image">
						<img src="../img/teea-pic.png" alt="teea-pic" width="100" height="100" class="img-circle"/>
					</div>
					<div class="birthday-name">
						Teea Reed
					</div>
					<div class="birthday-date">
						Friday - 9/25
					</div>
					<div class="birthday-like"><i class="icon-thumbs-up-alt"></i></div>
				</div>
				<div class="birthday birthday-last">
					<div class="birthday-image">
						<img src="../img/teea-pic.png" alt="teea-pic" width="100" height="100" class="img-circle"/>
					</div>
					<div class="birthday-name">
						Teea Reed
					</div>
					<div class="birthday-date">
						Friday - 9/25
					</div>
					<div class="birthday-like"><i class="icon-thumbs-up-alt"></i></div>
				</div>
			</div>
			<h5>Staff anniversaries</h5>
		</div>
		<div class="well">
			<h5>Core Conversion</h5>
		</div>
	</div>
</div>
