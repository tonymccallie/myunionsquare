<div class="well clearfix highfives">
	<h5>High Fives</h5>
	<ul>
		<?php foreach($accolades as $accolade): ?>
		<li>
			<div class="row-fluid">
				<div class="span2">
					<?php echo date('m.d',strtotime($accolade['Accolade']['created'])) ?>
				</div>
				<div class="span8">
					<?php echo $accolade['Accolade']['body'] ?><br /><i>By: <?php echo $accolade['User']['first_name'].' '.$accolade['User']['last_name'] ?></i>
				</div>
				<div class="span2">
					<i class="icon-thumbs-up-alt"></i><br>22 likes
				</div>
			</div>
		</li>
		<?php endforeach ?>
	</ul>
	<div class="clearfix">
		<?php echo $this->Html->link('Give a High Five','/accolades/add',array('class'=>'btn btn-block')) ?>	
	</div>
</div>