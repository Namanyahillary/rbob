<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php __('Register'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('email');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('password_confirmation',array('type'=>'password'));
		if($super_admin){		
				echo $this->Form->input('role',array('type'=>'select','options'=>array('regular'=>'Regular user','super_admin'=>'Super Admin','bank_admin'=>'bank_admin'),'selected'=>1,'class'=>'role'));
				echo '<div class="banks">'.$this->Form->input('bank_id').'</div>';		
		}
		echo $this->Form->input('date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users', true), array('action' => 'index'));?></li>
	</ul>
</div>

<?php if($super_admin): ?>	
	<script>
		$(document).ready(function(){
			va=$('.role').val();
			if(va!='bank_admin'){
				$('.banks').hide();
			}
		   
		   $('.role').change(function(){
				va=$(this).val();
				if(va!='bank_admin'){
					$('.banks').hide();
				}else{
					$('.banks').show();
				}
			});
			
			$('#user_edit_form').submit(function(){
				va=$('.role').val();
				if(va!='bank_admin'){
					$('.banks').remove();
				}
			});
			
		});
	</script>
<?php endif; ?>