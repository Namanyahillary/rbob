<div class="myFiles view">
<h2><?php  echo __('My File'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($myFile['MyFile']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($myFile['MyFile']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Filename'); ?></dt>
		<dd>
			<?php echo h($myFile['MyFile']['filename']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($myFile['MyFile']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('My Folder'); ?></dt>
		<dd>
			<?php echo $this->Html->link($myFile['MyFolder']['name'], array('controller' => 'my_folders', 'action' => 'view', $myFile['MyFolder']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($myFile['MyFile']['date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit My File'), array('action' => 'edit', $myFile['MyFile']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete My File'), array('action' => 'delete', $myFile['MyFile']['id']), null, __('Are you sure you want to delete # %s?', $myFile['MyFile']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List My Files'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New My File'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List My Folders'), array('controller' => 'my_folders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New My Folder'), array('controller' => 'my_folders', 'action' => 'add')); ?> </li>
	</ul>
</div>
