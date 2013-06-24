<div class="groupPostComments view">
<h2><?php  echo __('Group Post Comment'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($groupPostComment['GroupPostComment']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group Post'); ?></dt>
		<dd>
			<?php echo $this->Html->link($groupPostComment['GroupPost']['id'], array('controller' => 'group_posts', 'action' => 'view', $groupPostComment['GroupPost']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($groupPostComment['User']['name'], array('controller' => 'users', 'action' => 'view', $groupPostComment['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo h($groupPostComment['GroupPostComment']['comment']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($groupPostComment['GroupPostComment']['date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Group Post Comment'), array('action' => 'edit', $groupPostComment['GroupPostComment']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Group Post Comment'), array('action' => 'delete', $groupPostComment['GroupPostComment']['id']), null, __('Are you sure you want to delete # %s?', $groupPostComment['GroupPostComment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Group Post Comments'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group Post Comment'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Group Posts'), array('controller' => 'group_posts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group Post'), array('controller' => 'group_posts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
