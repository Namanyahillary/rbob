<style>
<!--
.messages input,select,textarea{
	width:100% !important;
}
-->
</style>
<?php echo $this->Html->script(array('script_dynamic_content'));?>
<?php echo $this->Form->create('Message',array('class' => 'for-modal'));?>
		<fieldset>
				<legend>
				<?php 
					if(isset($reply)) echo "Reply message";
					else echo __('Compose Message'); 
				?></legend>
		<?php
				
				if(isset($reply) and isset($reply_id)){
					echo $this->Form->input('user_id',array('name'=>'data[Message][user_id]','value'=>$reply_id,'type'=>'hidden'));
				}else{
					echo $this->Form->input('user_id',array('label'=>'to'));
				}
				echo $this->Form->input('message_subject');
				echo $this->Form->input('message_body');
		?>
		</fieldset>
		<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<?php echo $this->Form->end(__('Submit', true));?>

