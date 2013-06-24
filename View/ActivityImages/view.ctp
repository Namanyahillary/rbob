<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<div class="activityImages view">
<h2><?php  echo __('Activity Image'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($activityImage['ActivityImage']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Caption'); ?></dt>
		<dd>
			<?php echo h($activityImage['ActivityImage']['caption']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Activity'); ?></dt>
		<dd>
			<?php echo $this->Html->link($activityImage['Activity']['name'], array('controller' => 'activities', 'action' => 'view', $activityImage['Activity']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($activityImage['User']['name'], array('controller' => 'users', 'action' => 'view', $activityImage['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image File'); ?></dt>
		<dd>
			<?php echo h($activityImage['ActivityImage']['image_file']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($activityImage['ActivityImage']['date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Activity Image'), array('action' => 'edit', $activityImage['ActivityImage']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Activity Image'), array('action' => 'delete', $activityImage['ActivityImage']['id']), null, __('Are you sure you want to delete # %s?', $activityImage['ActivityImage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Activity Images'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Activity Image'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Activities'), array('controller' => 'activities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Activity'), array('controller' => 'activities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
