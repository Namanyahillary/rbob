<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<div class="destinations form">
<?php echo $this->Form->create('Destination',array('type'=>'file','id'=>'destination_edit_form','class'=>'no-ajax')); ?>
	<fieldset>
		<legend><?php echo __('Edit Destination'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('location');
		echo $this->Form->input('latitude',array('type'=>'text'));
		echo $this->Form->input('longitude',array('type'=>'text'));
		echo $this->Form->input('cost',array('type'=>'text'));
		echo $this->Form->input('date_from');
		echo $this->Form->input('date_to');
		echo $this->Form->input('country_id');
		echo $this->Form->input('category_id');
		echo $this->Form->input('fileField',array('type'=>'file','label'=>'Browse to change the image.(png,jpg)','name'=>'fileField'));
		echo $this->Form->input('image_file',array('type'=>'hidden'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Destination.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Destination.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Destinations'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Bookings'), array('controller' => 'bookings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Booking'), array('controller' => 'bookings', 'action' => 'add')); ?> </li>
	</ul>
</div>
