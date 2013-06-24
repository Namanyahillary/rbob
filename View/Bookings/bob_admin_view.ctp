<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<div class="bookings view">
<h2><?php  echo __('Booking'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($booking['Booking']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($booking['User']['name'], array('controller' => 'users', 'action' => 'view', $booking['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Destination'); ?></dt>
		<dd>
			<?php echo $this->Html->link($booking['Destination']['name'], array('controller' => 'destinations', 'action' => 'view', $booking['Destination']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Booking Date'); ?></dt>
		<dd>
			<?php echo h($booking['Booking']['booking_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Booking Time'); ?></dt>
		<dd>
			<?php echo h($booking['Booking']['booking_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($booking['Booking']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status History'); ?></dt>
		<dd>
			<?php echo h($booking['Booking']['status_history']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Booking'), array('action' => 'edit', $booking['Booking']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Booking'), array('action' => 'delete', $booking['Booking']['id']), null, __('Are you sure you want to delete # %s?', $booking['Booking']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Bookings'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Booking'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Destinations'), array('controller' => 'destinations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Destination'), array('controller' => 'destinations', 'action' => 'add')); ?> </li>
	</ul>
</div>
