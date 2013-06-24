<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<?php
	//echo json_encode($users);
	//pr($users);
?>
<?php echo $this->Form->create('GroupMember',array('action'=>'add','class'=>'for-modal remove-modal-after')); ?>
<table>
	<?php 
		if (!empty($users)){
			$i = 0;
			$col=0;
			$rowComplete=false;
			foreach ($users as $user){
				$col++;
				if($user!=null){//if we dont have a null user
					$class = null;
					if($i>=0){										
						if($i%3==0){
							$rowComplete=true;
						}else{
							$rowComplete=false;
						}
							
						if($rowComplete){
							echo '</tr><tr class="my_row">'.'	<td style="width:'.(100/3).'%">';
						}else{
							echo '	'.'<td style="width:'.(100/3).'%">';						
						}
					}
	  ?>
	  <?php
		$is_member=0;
		foreach($user['GroupMember'] as $groupMember){
			if($groupMember['user_id']==$user['User']['id'] and $groupMember['group_id']==$group_id){
				$is_member=1;
			}
		}
	  ?>
	  <?php if(!$is_member): ?>
		<input type="checkbox" class="checkbox" name="data[GroupMember][members][]" value="<?php echo $user['User']['id']; ?>" />
	  <?php endif; ?>
	  <img src="<?php echo $this->webroot;?>img/pic/<?php echo $user['User']['profile_image']; ?>" width="20px" />
	  <?php echo $user['User']['name']; ?>
	  <?php
					if($i%3==0){
						$rowComplete=true;
									
					}
				}
				$i++;
			}
			if(!$rowComplete){
				echo '</td></tr>';
			}
		}
	  ?>
</table>
<?php echo $this->Form->end(__('Submit')); ?>
</form>