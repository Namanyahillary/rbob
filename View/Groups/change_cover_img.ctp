<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<div class="Group well">
<h6><?php __('Change Group Cover'); ?></h6>
<?php echo $this->Form->create('Group',array('type'=>'file','id'=>'cover_image_edit_form','class'=>'no-ajax'));?>
	<fieldset>
		
	<?php
		echo $this->Form->input('fileField',array('type'=>'file','label'=>'Photo(png,jpg)','name'=>'fileField'));
		echo $this->Form->input('gid',array('type'=>'hidden','value'=>$id));
	?>
	</fieldset>
	
	
<?php echo $this->Form->end(__('Submit', true));?>
</div>