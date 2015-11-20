<div class="admin_header">
	<h3>
		<i class="icon-gallery-open"></i> Galleries
		<div class="btn-group pull-right">
			<?php echo $this->Html->link('<i class="icon-plus"></i> Add Gallery', array('action' => 'add'),array('class'=>'btn','escape'=>false)); ?>
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
					Image Count
				</th>
				<th>
					<?php echo $this->Paginator->sort('created','<i class="icon-sort"></i> Created',array('escape'=>false)); ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($galleries as $gallery): ?>
			<tr>
				<td><?php echo $this->Html->link($gallery['Gallery']['title'],array('action'=>'view',$gallery['Gallery']['id'])) ?></td>
				<td><?php echo $gallery['Gallery']['picture_count'] ?></td>
				<td><?php echo date('m/d/Y',strtotime($gallery['Gallery']['created'])) ?></td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	<?php echo $this->element('paging') ?>
</div>