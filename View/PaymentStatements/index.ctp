<style>
<!--
	.my-list-items td{background:#fff !important;}
	.unprocessed td{background:#EAFFFF !important;}
	table
-->
</style>
<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<div class="paymentStatements my-list-items">
	<h2><?php echo __('Payment Statements'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('bank_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<th><?php echo $this->Paginator->sort('time'); ?></th>
			<th class="actions"><?php echo __(''); ?></th>
	</tr>
	<?php foreach ($paymentStatements as $paymentStatement): ?>
	<tr class="<?php if(!$paymentStatement['PaymentStatement']['is_processed']) echo "unprocessed".' '.$paymentStatement['PaymentStatement']['id']; ?>">
		<td><?php echo h($paymentStatement['Bank']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($paymentStatement['User']['name'], array('controller' => 'users', 'action' => 'view', $paymentStatement['User']['id'])); ?>
		</td>
		<td><?php echo h($paymentStatement['PaymentStatement']['date']); ?>&nbsp;</td>
		<td><?php echo h($paymentStatement['PaymentStatement']['time']); ?>&nbsp;</td>
		<td class="actions">
			
			<a title="Download Excel File" class="no-ajax" href="<?php echo $this->webroot.'/statements/bank_'.$paymentStatement['PaymentStatement']['bank_id'].'/'.($paymentStatement['PaymentStatement']['year']).'/'.($paymentStatement['PaymentStatement']['file_name']);?>" target="_blank" title="download"><i class="icon icon-download"></i></a>
			
			<?php if($super_admin): ?>
				<a title="Process Excel File" href="<?php echo $this->webroot.'/payment_statements/confirm_transactions/'.($paymentStatement['PaymentStatement']['id']); ?>"><i class="icon icon-refresh"></i></a>
			
				<?php echo $this->Form->postLink(__('X'), array('action' => 'delete', $paymentStatement['PaymentStatement']['id']), array('title'=>'Delete this record'), __('Are you sure you want to delete # %s?', $paymentStatement['PaymentStatement']['id'])); ?>
			<?php endif;?>
		</td>
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