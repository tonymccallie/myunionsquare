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
					<?php
					if(!$accolade['Accolade']['liked']) {
						echo $this->Html->link('<i class="icon-thumbs-up"></i><br />'.count($accolade['Like']).' likes</a>','/accolades/like/'.$accolade['Accolade']['id'].'/'.$USER['User']['id'],array('class'=>'highfive_like','escape'=>false));
					} else {
						echo $this->Html->link('<i class="icon-thumbs-up-alt"></i><br />'.count($accolade['Like']).' likes</a>','/accolades/dislike/'.$accolade['Accolade']['id'].'/'.$USER['User']['id'],array('class'=>'highfive_like','escape'=>false));
					}
				?>
				</div>
			</div>
		</li>
		<?php endforeach ?>
	</ul>
	<div class="clearfix">
		<?php echo $this->Html->link('Give a High Five','/accolades/add',array('class'=>'btn btn-block')) ?>	
	</div>
</div>