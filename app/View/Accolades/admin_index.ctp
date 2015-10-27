<div class="admin_header">
	<h3>
		<i class="icon-edit"></i> High Fives
	</h3>
</div>
<div class="">
	<?php echo $this->element('search') ?>
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>
					<?php echo $this->Paginator->sort('body','<i class="icon-sort"></i> Message',array('escape'=>false)); ?>
				</th>
				<th>
					<?php echo $this->Paginator->sort('user_id','<i class="icon-sort"></i> User',array('escape'=>false)); ?>
				</th>
				<th>
					<?php echo $this->Paginator->sort('created','<i class="icon-sort"></i> Created',array('escape'=>false)); ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($accolades as $accolade): ?>
			<tr>
				<td><?php echo $this->Html->link(Common::truncate($accolade['Accolade']['body'],100),array('action'=>'edit',$accolade['Accolade']['id'])) ?></td>
				<td><?php echo $accolade['User']['first_name'].' '.$accolade['User']['last_name'] ?></td>
				<td><?php echo date('y/m/d',strtotime($accolade['Accolade']['created'])) ?></td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	<?php echo $this->element('paging') ?>
</div>