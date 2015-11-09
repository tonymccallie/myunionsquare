<div class="admin_header">
	<h3>
		<i class="icon-edit"></i> Marketing
		<div class="btn-group pull-right">
			<?php echo $this->Html->link('Add Post', array('action' => 'marketing_add'),array('class'=>'btn','escape'=>false)); ?>
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
				<th>
					<?php echo $this->Paginator->sort('created','<i class="icon-sort"></i> Created',array('escape'=>false)); ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($articles as $article): ?>
			<tr>
				<td><?php echo $this->Html->link($article['News']['title'],array('action'=>'marketing_edit',$article['News']['id'])) ?></td>
				<td><?php echo date('M dS h:ia',strtotime($article['News']['created'])) ?></td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	<?php echo $this->element('paging') ?>
</div>