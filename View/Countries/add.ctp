<div class="countries form">
<?php echo $this->Form->create('Country',array('type'=>'file','id'=>'country_add_form','class'=>'no-ajax')); ?>
	<fieldset>
		<legend><?php echo __('Add Country'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('region_id');
		echo $this->Form->input('fileField',array('type'=>'file','label'=>'Image(png,jpg)','name'=>'fileField'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Countries'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Regions'), array('controller' => 'regions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Region'), array('controller' => 'regions', 'action' => 'add')); ?> </li>
	</ul>
</div>
