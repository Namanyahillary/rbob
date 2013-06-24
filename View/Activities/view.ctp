<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<div class="activities view">
<h2><?php  echo __('Activity'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($activity['Activity']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($activity['Activity']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Destination'); ?></dt>
		<dd>
			<?php echo $this->Html->link($activity['Destination']['name'], array('controller' => 'destinations', 'action' => 'view', $activity['Destination']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cover Img'); ?></dt>
		<dd>
			<?php echo h($activity['Activity']['cover_img']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($activity['User']['name'], array('controller' => 'users', 'action' => 'view', $activity['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($activity['Activity']['date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Activity'), array('action' => 'edit', $activity['Activity']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Activity'), array('action' => 'delete', $activity['Activity']['id']), null, __('Are you sure you want to delete # %s?', $activity['Activity']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Activities'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Activity'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Destinations'), array('controller' => 'destinations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Destination'), array('controller' => 'destinations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Activity Images'), array('controller' => 'activity_images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Activity Image'), array('controller' => 'activity_images', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Activity Images'); ?></h3>
	<?php if (!empty($activity['ActivityImage'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Caption'); ?></th>
		<th><?php echo __('Activity Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Image File'); ?></th>
		<th><?php echo __('Date'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($activity['ActivityImage'] as $activityImage): ?>
		<tr>
			<td><?php echo $activityImage['id']; ?></td>
			<td><?php echo $activityImage['caption']; ?></td>
			<td><?php echo $activityImage['activity_id']; ?></td>
			<td><?php echo $activityImage['user_id']; ?></td>
			<td><?php echo $activityImage['image_file']; ?></td>
			<td><?php echo $activityImage['date']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'activity_images', 'action' => 'view', $activityImage['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'activity_images', 'action' => 'edit', $activityImage['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'activity_images', 'action' => 'delete', $activityImage['id']), null, __('Are you sure you want to delete # %s?', $activityImage['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Activity Image'), array('controller' => 'activity_images', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
