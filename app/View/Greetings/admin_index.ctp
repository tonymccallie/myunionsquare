<div class="admin_header">
	<h3>
		<i class="icon-edit"></i> Greetings
		<div class="btn-group pull-right">
			<?php echo $this->Html->link('Add Greeting', array('action' => 'add'),array('class'=>'btn','escape'=>false)); ?>
		</div>
	</h3>
</div>
<div class="">
	<?php echo $this->element('search') ?>
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>
					<?php echo $this->Paginator->sort('title','<i class="icon-sort"></i> Title',array('escape'=>false)); ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($greetings as $greeting): ?>
			<tr>
				<td><?php echo $this->Html->link($greeting['Greeting']['title'],array('action'=>'edit',$greeting['Greeting']['id'])) ?></td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	<?php echo $this->element('paging') ?>
</div>