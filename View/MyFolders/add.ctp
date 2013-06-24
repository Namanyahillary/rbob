<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<div class="myFolders form">
<?php echo $this->Form->create('MyFolder'); ?>
	<fieldset>
		<legend><image src="<?php echo $this->webroot.'img/icons/folder.png';?>" /> <?php echo __('Create New Folder'); ?></legend>
	<?php
		echo $this->Form->input('name',array('label'=>'Folder Name'));
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List My Folders'), array('action' => 'index')); ?></li>
	</ul>
</div>
