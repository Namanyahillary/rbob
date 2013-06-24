<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<div class="myFiles form">
<?php echo $this->Form->create('MyFile',array('type'=>'file','class'=>'no-ajax')); ?>
	<fieldset>
		<legend><span><i class="icon icon-file"></i> Add File</span></legend>
	<?php
		echo $this->Form->input('name',array('label'=>'Name your file'));
		echo $this->Form->input('description');
		echo $this->Form->input('fileField',array('type'=>'file','label'=>'Image(png,jpg)','name'=>'fileField'));
		echo $this->Form->input('my_folder_id',array('value'=>$my_folder_id,'type'=>'hidden'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __(''); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List My Files'), array('action' => 'index',$my_folder_id)); ?></li>
	</ul>
</div>
