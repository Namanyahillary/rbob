<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<div class="activityImages index well">
	<h2><?php echo __('Activity Images'); ?></h2>
	
	
		<table border="0" cellspacing="1" cellpadding="1" class="row-fluid">
				
	<tr class="row-fluid"><td colspan="5" class="row-fluid container-fluid"><br /></td></tr>
		
		
  <?php if (!empty($activityImages) and ($activityImages!=null)):
				$i = 0;
				$col=0;
				$rowComplete=false;
				foreach ($activityImages as $activityImage):
					
					$col++;
					if($activityImage!=null)://if we dont have a null destination
					$class = null;
  ?>
	
	<?php
					
					if($i>=0){
						
						
						if($i%5==0){
							$rowComplete=true;
						}else{
							$rowComplete=false;
						}
						
						if($rowComplete){
							echo '</tr><tr class="my_row">'.'	<td style="width:20%">';
						}else{
							echo '	'.'<td style="width:20%">';						
						}
					}
					
					
					
					echo '<div class="well">';
					?>
						<div>
							<?php echo $activityImage['ActivityImage']['caption'];?>(
							<?php echo $activityImage['ActivityImage']['date'];?>)<br/>
						</div>
						<div>
							<?php echo $this->Html->image('imagecache/activity_images/'.h($activityImage['ActivityImage']['image_file']),array('style'=>'width:100px;height:100px')); ?>
						</div>
						<div><br/>
							<b>Activity:</b><?php echo $activityImage['Activity']['name'];?>
						</div>
						<div><br/>
							<span class="btn btn-danger"><i class="icon-white icon-remove"></i> <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $activityImage['ActivityImage']['id']), array('style'=>'color:#fff;'), __('Are you sure you want to delete # %s?', $activityImage['ActivityImage']['id'])); ?></span>
						</div>
					<?php
					echo '</div>';
					
					echo '</td>';
					
					if($i%5==0){
						$rowComplete=true;
						
					}
					
					
						endif;
						$i++;
					endforeach;
					
					if(!$rowComplete){
						echo '</tr>';
					}
			endif;
	?>
</table>	
	
	

	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __(''); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Activities'), array('controller' => 'activities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Activity'), array('controller' => 'activities', 'action' => 'add')); ?> </li>
	</ul>
</div>
