<div class="wishLists view">
<h2><?php  echo __('Wish List'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($wishList['WishList']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($wishList['User']['name'], array('controller' => 'users', 'action' => 'view', $wishList['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Destination'); ?></dt>
		<dd>
			<?php echo $this->Html->link($wishList['Destination']['name'], array('controller' => 'destinations', 'action' => 'view', $wishList['Destination']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Wish List'), array('action' => 'edit', $wishList['WishList']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Wish List'), array('action' => 'delete', $wishList['WishList']['id']), null, __('Are you sure you want to delete # %s?', $wishList['WishList']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Wish Lists'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Wish List'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Destinations'), array('controller' => 'destinations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Destination'), array('controller' => 'destinations', 'action' => 'add')); ?> </li>
	</ul>
</div>
