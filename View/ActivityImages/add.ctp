<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<div class="activityImages form">
<?php echo $this->Form->create('ActivityImage',array('type'=>'file','id'=>'ActivityImage_add_form','class'=>'no-ajax')); ?>
	<fieldset>
		<legend><?php echo __('Add Activity Image'); ?></legend>
	<?php
		echo $this->Form->input('caption',array('type'=>'text'));
		echo $this->Form->input('activity_id',array('type'=>'hidden','value'=>$activity));
		echo $this->Form->input('fileField',array('type'=>'file','label'=>'Image(png,jpg)','name'=>'fileField'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Activity Images'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Activities'), array('controller' => 'activities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Activity'), array('controller' => 'activities', 'action' => 'add')); ?> </li>
	</ul>
</div>
