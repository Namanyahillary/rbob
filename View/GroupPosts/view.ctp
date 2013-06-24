<div class="groupPosts view">
<h2><?php  echo __('Group Post'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($groupPost['GroupPost']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group'); ?></dt>
		<dd>
			<?php echo $this->Html->link($groupPost['Group']['name'], array('controller' => 'groups', 'action' => 'view', $groupPost['Group']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($groupPost['User']['name'], array('controller' => 'users', 'action' => 'view', $groupPost['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($groupPost['GroupPost']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Content'); ?></dt>
		<dd>
			<?php echo h($groupPost['GroupPost']['content']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image Url'); ?></dt>
		<dd>
			<?php echo h($groupPost['GroupPost']['image_url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Has Image'); ?></dt>
		<dd>
			<?php echo h($groupPost['GroupPost']['has_image']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Group Post'), array('action' => 'edit', $groupPost['GroupPost']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Group Post'), array('action' => 'delete', $groupPost['GroupPost']['id']), null, __('Are you sure you want to delete # %s?', $groupPost['GroupPost']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Group Posts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group Post'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
