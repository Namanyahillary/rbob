<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>

<div class="activities form" style="width:70%">
<?php echo $this->Form->create('Activity',array('type'=>'file','id'=>'activity_add_form','class'=>'no-ajax')); ?>
	<fieldset>
		<legend><?php echo __('Add Activity'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('price');
		echo $this->Form->input('destination_id',array('type'=>'hidden','value'=>$destination));
		echo $this->Form->input('description');
		echo $this->Form->input('fileField',array('type'=>'file','label'=>'Main Image(png,jpg)','name'=>'fileField'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<ul>

		<li><?php echo $this->Html->link(__('List Activities'), array('action' => 'index')); ?></li>
	</ul>
</div>
