<div class="well">
	<h5>Birthdays this week</h5>
	<div class="birthday-container">
		<?php foreach($birthdays as $birthday): ?>
			<div class="birthday">
				<div class="birthday-image">
					<?php echo !empty($birthday['User']['photo'])?$this->Html->image('thumb/'.$birthday['User']['photo'].'/width:200/height:200/crop:true/zoom:auto/'.$birthday['User']['photo'],array('class'=>'img-circle')):'' ?>
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
					<?php echo !empty($hire['User']['photo'])?$this->Html->image('thumb/'.$hire['User']['photo'].'/width:200/height:200/crop:true/zoom:auto/'.$hire['User']['photo'],array('class'=>'img-circle')):'' ?>
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