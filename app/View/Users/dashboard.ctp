<div class="row-fluid">
	<div class="span8">
		<?php foreach($articles as $article): ?>
		<div class="row-fluid article">
			<div class="span4">
				<?php echo !empty($article['News']['photo'])?$this->Html->image('/images/thumb/'.$article['News']['photo'].'/width:800/height:600/crop:true/zoom:auto'):'NO PHOTO' ?>
			</div>
			<div class="span8">
				<h4><?php echo $article['News']['title'] ?></h4>
				<p><?php echo str_replace("\n","<br />",$article['News']['body']) ?></p>
				<div><i>By: <?php echo $article['User']['first_name'].' '.$article['User']['last_name'] ?> - <?php echo date('M dS',strtotime($article['News']['created'])) ?></i></div><br>
			<a href="#" class="btn"><i class="icon-thumbs-up"></i>Like</a>
			<a href="#" class="btn"><i class="icon-thumbs-up"></i>Comment</a>
			</div>
		</div>
		<?php endforeach ?>
	</div>
	<div class="span4">
		<div class="well">
			<h5>Birthdays this week</h5>
			<div class="birthday-container">
				<?php foreach($birthdays as $birthday): ?>
					<div class="birthday">
						<div class="birthday-image">
							<?php echo !empty($birthday['User']['photo'])?$this->Html->image('/images/thumb/'.$birthday['User']['photo'].'/width:200/height:200/crop:true/zoom:auto',array('class'=>'img-circle')):'' ?>
						</div>
						<div class="birthday-details">
						<div class="birthday-name">
								<?php echo $birthday['User']['first_name'].' '.$birthday['User']['last_name'] ?>
							</div>
							<div class="birthday-date">
								<?php echo date('l - n/j',strtotime($birthday['User']['birthday'])) ?>
							</div>
						</div>
						<div class="birthday-like"><i class="icon-thumbs-up"></i><br>3 likes</div>
					</div>
				<?php endforeach ?>
			</div>
			<div class="clearfix">
			<h5>Staff anniversaries</h5>
			<div class="birthday-container">
				<?php foreach($hires as $hire): ?>
					<div class="birthday">
						<div class="birthday-image">
							<?php echo !empty($hire['User']['photo'])?$this->Html->image('/images/thumb/'.$hire['User']['photo'].'/width:200/height:200/crop:true/zoom:auto',array('class'=>'img-circle')):'' ?>
						</div>
						<div class="birthday-details">
							<div class="birthday-name">
								<?php echo $hire['User']['first_name'].' '.$hire['User']['last_name'] ?>
							</div>
							<div class="birthday-date">
								<?php echo date('l - n/j',strtotime($hire['User']['hire_date'])) ?>
							</div>
						</div>
						<div class="birthday-like"><i class="icon-thumbs-up-alt"></i><br>22 likes</div>
					</div>
				<?php endforeach ?>
			</div>
			</div>
		</div>
		<div class="well clearfix">
			<h5>High Fives</h5>
			<ul class="core_conversion">
				<li>
					<div class="core_date">09.02</div>
					<div class="core_text">Sample update text for ...</div>
				</li>
				<li>
				<div class="core_date">09.02</div>
					<div class="core_text">Sample update text for ...</div>
				</li>
				<li>
				<div class="core_date">09.02</div>
					<div class="core_text">Sample update text for ...</div>
				</li>
				<li>
				<div class="core_date">09.02</div>
					<div class="core_text">Sample update text for ...</div>
				</li>
				<li>
				<div class="core_date">09.02</div>
					<div class="core_text">Sample update text for ...</div>
				</li>
				<li>
				<div class="core_date">09.02</div>
					<div class="core_text">Sample update text for ...</div>
				</li>
				<li>
				<div class="core_date">09.02</div>
					<div class="core_text">Sample update text for ...</div>
				</li>
				<li>
				<div class="core_date">09.02</div>
					<div class="core_text">Sample update text for ...</div>
				</li>
				<li>
				<div class="core_date">09.02</div>
					<div class="core_text">Sample update text for ...</div>
				</li>
				<li>
				<div class="core_date">09.02</div>
					<div class="core_text">Sample update text for ...</div>
				</li>
			<ul>
		</div>
	</div>
</div>
