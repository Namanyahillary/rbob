<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<div class="destinationImages well" style="width: 36%;margin-left: 32%;">
<?php echo $this->Form->create('DestinationImage',array('type'=>'file','class'=>'no-ajax')); ?>
	<fieldset>
		<legend><?php echo __('Add Destination Image'); ?></legend>
	<?php
		echo $this->Form->input('caption');
		echo $this->Form->input('destination_id');
		echo $this->Form->input('fileField',array('type'=>'file','label'=>'Image(png,jpg)','name'=>'fileField'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>