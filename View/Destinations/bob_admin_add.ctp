<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<div class="destinations form">
<?php echo $this->Form->create('Destination',array('type'=>'file','id'=>'destination_add_form','class'=>'no-ajax')); ?>
	<fieldset>
		<legend><?php echo __('Add Destination'); ?></legend>
	<?php
		echo $this->Form->input('unique_id');
		echo $this->Form->input('name');
		echo $this->Form->input('location');
		echo $this->Form->input('latitude',array('type'=>'text'));
		echo $this->Form->input('longitude',array('type'=>'text'));
		echo $this->Form->input('cost',array('type'=>'text'));
		echo $this->Form->input('date_from');
		echo $this->Form->input('date_to');
		echo $this->Form->input('country_id');
		echo $this->Form->input('category_id');
		echo $this->Form->input('fileField',array('type'=>'file','label'=>'Image(png,jpg)','name'=>'fileField'));
		//echo $this->Form->input('Region');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
