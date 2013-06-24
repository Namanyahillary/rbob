<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<div class="bookings well">
	<h2><?php echo __('My Holidays'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th class="actions"><?php echo __(''); ?></th>
			<th class="actions"><?php echo __(''); ?></th>
			<th><?php echo $this->Paginator->sort('transaction'); ?></th>
			<th><?php echo $this->Paginator->sort('destination_id'); ?></th>
			<th><?php echo $this->Paginator->sort('current_status'); ?></th>
			<th><?php echo $this->Paginator->sort('booking_date','Booked on'); ?></th>
			<th><?php echo $this->Paginator->sort('booking_time','at'); ?></th>
			<th>&nbsp;</th>
	</tr>
	<?php foreach ($bookings as $booking): ?>
	<tr>
		<td>
			<div class="btn-group">
				<button class="btn dropdown-toggle" data-toggle="dropdown">
				  <i class="icon icon-certificate"></i>
				  <span class="caret"></span>
				</button>
				<ul class="dropdown-menu">
					<?php if(!$booking['Booking']['user_confirmed'] && $booking['Booking']['book_type']):?>
						<li><?php echo $this->Html->link(__('Accept Group holiday'), array('action' => 'accept_booking', $booking['Booking']['id'])); ?></li>
						<li><?php echo $this->Html->link(__('Not interested'), array('action' => 'not_accept_booking', $booking['Booking']['id'])); ?></li>
						<li class="divider"></li>
					<?php endif;?>
					
					<li><?php echo $this->Html->link(__('View'), array('action' => 'view', $booking['Booking']['id'])); ?></li>
					<?php if(!$booking['Booking']['status'])://if not yet confirmed ?>
						<li><a class="confirm-first" data-confirm-text="Are you sure you want to cancel this reservation?" href="<?php echo $this->webroot;?>bookings/cancel_booking/<?php echo $booking['Booking']['id'];?>">Cancel</a></li>
					<?php endif; ?>
				</ul>
			</div>	
		</td>
		<td style="width: 100px !important;"><?php echo $this->Html->image('imagecache/destinations/'.($booking['Destination']['image_file']),array('style'=>'border-radius: 5px;')); ?>&nbsp;</td>
		<td><?php echo h($booking['Booking']['transaction']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($booking['Destination']['name'], array('controller' => 'destinations', 'action' => 'view', $booking['Destination']['id'])); ?>
		</td>
		<td><?php echo h($booking['Booking']['current_status']); ?>&nbsp;</td>
		<td><?php echo h($booking['Booking']['booking_date']); ?>&nbsp;</td>
		<td><?php echo h($booking['Booking']['booking_time']); ?>&nbsp;</td>
		<?php if(!$booking['Booking']['user_confirmed'] && $booking['Booking']['book_type']):?>
			<td>
				<a class="confirm-first btn btn-primary" data-confirm-text="Are you sure you want to accept this holiday/reservation?" href="<?php echo $this->webroot;?>bookings/accept_booking/<?php echo $booking['Booking']['id'];?>"><i class="icon-white icon-ok"></i> Accept <?php echo h($booking['Group']['name']);?> group holiday</a>
			</td>
		<?php endif;?>
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
