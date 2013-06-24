<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<div class="myFolders well">
<?php echo $this->Form->create('MyFolder'); ?>
	<fieldset>
		<legend><image src="<?php echo $this->webroot.'img/icons/folder.png';?>" /> <?php echo __('Edit Folder'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
