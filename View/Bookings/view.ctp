<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<div class="bookings view well">
<h2><?php  echo __('My Holiday - Details for '.(h($booking['Destination']['name']))); ?></h2>
	<dl>
		<dt><?php echo __('Transaction'); ?></dt>
		<dd>
			<?php echo h($booking['Booking']['transaction']); ?>
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
		<dt><?php echo __('Amount Required'); ?></dt>
		<dd>
			<?php echo h($booking['Booking']['amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('I booked on'); ?></dt>
		<dd>
			<?php echo h($booking['Booking']['booking_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('I booked at'); ?></dt>
		<dd>
			<?php echo h($booking['Booking']['booking_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($booking['Booking']['current_status']); ?>
			&nbsp;
		</dd>
		<hr/>
		<dt style="color:red;font-size:130%;"><?php echo __('Balance'); ?></dt>
		<dd class="balance">
			&nbsp;
		</dd>
	</dl>
</div>

<div>
<a href="<?php echo $this->webroot;?>destinations/view/<?php echo $booking['Destination']['id']; ?>"><?php echo $this->Html->image("destinations/".$booking['Destination']['image_file'], array('alt'=> __('roundbob.com', true), 'border' => '0','style'=>"width:200px;margin-top:1%;border-radius:10px;border:2px solid #cfcfcf;")); ?></a>
</div>

<div class="actions">

	
	
	<ul>
		<?php if($regular): ?>
			<?php if(!$booking['Booking']['user_confirmed'] && $booking['Booking']['book_type']):?>
				<li><?php echo $this->Html->link(__('Accept'), array('action' => 'accept_booking', $booking['Booking']['id'])); ?></li>
				<li><?php echo $this->Html->link(__('Not interested'), array('action' => 'not_accept_booking', $booking['Booking']['id'])); ?></li>
			<?php endif; ?>
			<li><?php echo $this->Html->link(__('My Reservations'), array('action' => 'index')); ?> </li>
		<?php endif; ?>
	</ul>
</div>

<div class="related">            
	<ul class="nav nav-tabs" id="myTab">
		<li><a href="#a" class='no-ajax'><i class="icon-cog"></i>Payments</a></li>
		<li><a href="#c" class='no-ajax'><i class="icon-refresh"></i>Status History</a></li>
		
		<?php if($bank_admin):?>
			<li><a href="#b" class='no-ajax'><i class="icon-refresh"></i>Add Payment</a></li>
		<?php endif; ?>
	</ul>
		
	<div class="tab-content">      
		<div id="a" class="tab-pane active">
				<table>
				
					<tr>
						<td></td>
						<td>Amount Paid</td>
						<td>Transaction reference</td>
						<td>On</td>
						<td>At</td>	
						<td>Payment Method</td>
						<?php if($super_admin): ?>
							<td>IP Address</td>
							<td>User</td>
						<?php endif; ?>
					</tr>
					<?php $total_paid=0; ?>
					<?php foreach($booking['Payment'] as $payment):?>
						<?php $total_paid+=(double)h($payment['amount_paid']); ?>
						<tr>
							<td>
								<?php if(h($payment['is_confirmed'])):?>
									<i class="icon icon-ok"></i>
								<?php else: ?>
									<i class="icon icon-remove"></i>
								<?php endif;?>
							</td>
							<td><?php echo h($payment['amount_paid']); ?></td>
							<td><?php echo h($payment['transaction_reference']); ?></td>
							<td><?php echo h($payment['date']); ?></td>
							<td><?php echo h($payment['time']); ?></td>						
							<td><?php echo h($paymentMethods[$payment['payment_method_id']]); ?></td>
							<?php if($super_admin): ?>
								<td><?php echo h($payment['ip_address']); ?></td>
								<td><?php echo h($payment['user_name']); ?></td>
							<?php endif; ?>
						</tr>
					<?php endforeach; ?>
					<tr>
						<td colspan="8" class=""well>
							<b>Total amount paid:</b> <?php echo $total_paid; ?>
						</td>
					</tr>
				</table>
		</div>
		
		<div id="c" class="tab-pane">			
				<?php
				$status_history=explode(',',$booking['Booking']['status_history']);
				foreach($status_history as $st){
					echo '<i class="icon icon-ok"></i> '.$st;
				}
				?>
		</div>
		
		<?php if($bank_admin):?>
			<div id="b" class="tab-pane">			
					<div>
						<?php echo $this->Form->create('Payment',array('action'=>'add','controller'=>'payments')); ?>
							<fieldset>
								<legend><?php echo __('Add Payment'); ?></legend>
								<table class="well">
									<tr>
										<td><?php echo $this->Form->input('amount_paid'); ?></td>
										<td><?php echo $this->Form->input('transaction_reference'); ?></td>
									</tr>
									<tr>									
										<td><?php echo $this->Form->input('payment_method_id'); ?></td>
										<td>
											<?php echo $this->Form->input('b',array('type'=>'hidden','value'=>h($booking['Booking']['id']))); ?>
											<?php echo $this->Form->input('t',array('type'=>'hidden','value'=>h($booking['Booking']['transaction'])));?>
											<?php echo $this->Form->input('u',array('type'=>'hidden','value'=>h($booking['User']['name'])));?>
											<?php echo $this->Form->input('d',array('type'=>'hidden','value'=>h($booking['Destination']['name'])));?>
										</td>
									</tr>
								</table>
							</fieldset>
						<?php echo $this->Form->end(__('Submit')); ?>
					</div>
			</div>
		<?php endif; ?>
		
		<script>
			var amount_paid=<?php echo $total_paid;?>;
			var amount_to_be_paid=<?php echo h($booking['Booking']['amount']); ?>;
			
			balance = amount_to_be_paid-amount_paid;
			$(document).ready(function(){
				$('.balance').html(balance);
			});
			$('#myTab a').click(function (e){
				e.preventDefault();
				$(this).tab('show');
			});
		</script>
			
	</div>
</div>
