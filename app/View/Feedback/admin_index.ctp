<div class="admin_header">
	<h3>
		<i class="icon-edit"></i> Feedbacks
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
					<?php echo $this->Paginator->sort('created','<i class="icon-sort"></i> Created',array('escape'=>false)); ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($feedbacks as $feedback): ?>
			<tr>
				<td><?php echo $this->Html->link(Common::truncate($feedback['Feedback']['body'],100),array('action'=>'edit',$feedback['Feedback']['id'])) ?></td>
				<td><?php echo date('m/d/Y',strtotime($feedback['Feedback']['created'])) ?></td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	<?php echo $this->element('paging') ?>
</div>