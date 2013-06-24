<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<div class="paymentStatements view">
<h2><?php  echo __('Payment Statement'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($paymentStatement['PaymentStatement']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($paymentStatement['User']['name'], array('controller' => 'users', 'action' => 'view', $paymentStatement['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('File Name'); ?></dt>
		<dd>
			<?php echo h($paymentStatement['PaymentStatement']['file_name']); ?>
			&nbsp;
		</dd>
	</dl>
	<hr/>
	<?php if($super_admin): ?>
		<div class="well">
			<?php echo $this->Html->link(__('Process'), array('action' => 'confirm_transactions', $paymentStatement['PaymentStatement']['id'])); ?>
		</div>
	<?php endif;?>
</div>