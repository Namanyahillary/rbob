<div class="regions view">
<h2><?php  echo __('Region'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($region['Region']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($region['Region']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image File'); ?></dt>
		<dd>
			<?php echo h($region['Region']['image_file']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Region'), array('action' => 'edit', $region['Region']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Region'), array('action' => 'delete', $region['Region']['id']), null, __('Are you sure you want to delete # %s?', $region['Region']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Regions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Region'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Destinations'), array('controller' => 'destinations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Destination'), array('controller' => 'destinations', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Destinations'); ?></h3>
	<?php if (!empty($region['Destination'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Location'); ?></th>
		<th><?php echo __('Latitude'); ?></th>
		<th><?php echo __('Longitude'); ?></th>
		<th><?php echo __('Cost'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($region['Destination'] as $destination): ?>
		<tr>
			<td><?php echo $destination['id']; ?></td>
			<td><?php echo $destination['name']; ?></td>
			<td><?php echo $destination['location']; ?></td>
			<td><?php echo $destination['latitude']; ?></td>
			<td><?php echo $destination['longitude']; ?></td>
			<td><?php echo $destination['cost']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'destinations', 'action' => 'view', $destination['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'destinations', 'action' => 'edit', $destination['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'destinations', 'action' => 'delete', $destination['id']), null, __('Are you sure you want to delete # %s?', $destination['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Destination'), array('controller' => 'destinations', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
