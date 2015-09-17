<div class="admin_header">
	<h3>
		<i class="icon-edit"></i> Announcements
		<div class="btn-group pull-right">
			<?php echo $this->Html->link('Add Announcement', array('action' => 'add'),array('class'=>'btn','escape'=>false)); ?>
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
					<?php echo $this->Paginator->sort('user_id','<i class="icon-sort"></i> User',array('escape'=>false)); ?>
				</th>
				<th>
					<?php echo $this->Paginator->sort('created','<i class="icon-sort"></i> Created',array('escape'=>false)); ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($articles as $article): ?>
			<tr>
				<td><?php echo $this->Html->link($article['News']['title'],array('action'=>'edit',$article['News']['id'])) ?></td>
				<td><?php echo $article['User']['first_name'].' '.$article['User']['last_name'] ?></td>
				<td><?php echo date('M dS h:ia',strtotime($article['News']['created'])) ?></td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	<?php echo $this->element('paging') ?>
</div>