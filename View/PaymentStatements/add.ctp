<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>

<div class="paymentStatements form">
<?php echo $this->Form->create('PaymentStatement',array('type'=>'file','id'=>'user_edit_form','controller'=>'payment_statements','action'=>'add','class'=>'no-ajax')); ?>
	<fieldset>
		<legend><?php echo __('Add Payments file'); ?></legend>
	<?php
		echo $this->Form->input('fileField',array('type'=>'file','label'=>'Browse for file(Excel.xls files only)','name'=>'fileField'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>