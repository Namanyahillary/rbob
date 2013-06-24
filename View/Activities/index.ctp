<style>
<!--
.activities table tr td {
	vertical-align: middle;
}
-->
</style>
<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<div class="activities index well">
	<h2><?php echo __('Activities'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('destination_id'); ?></th>
			<th>Added by</th>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<th class="actions"><?php echo __(''); ?></th>
	</tr>
	<?php foreach ($activities as $activity): ?>
	<tr>
		<td><a onclick="window.open('<?php echo $this->webroot.'img/imagecache/activities/'.(h($activity['Activity']['cover_img']));?>','','height=300,width=300')" href="#" ><?php echo $this->Html->image('imagecache/activities/'.h($activity['Activity']['cover_img']),array('style'=>'height:50px'));?></a>&nbsp;</td>
		<td><?php echo h($activity['Activity']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($activity['Destination']['name'], array('controller' => 'destinations', 'action' => 'view', $activity['Destination']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($activity['User']['name'], array('controller' => 'users', 'action' => 'view', $activity['User']['id'])); ?>
		</td>
		<td><?php echo h($activity['Activity']['date']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Add images'), array('action' => 'add', $activity['Activity']['id'],'controller'=>'activity_images')); ?>
			<?php echo $this->Html->link(__('View images'), array('action' => 'index', $activity['Activity']['id'],'controller'=>'activity_images')); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $activity['Activity']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $activity['Activity']['id']), null, __('Are you sure you want to delete # %s?', $activity['Activity']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>