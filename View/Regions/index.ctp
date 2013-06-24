<style>
<!--
table tr td {
	background:none;
	border-bottom: none;
}
table tr:nth-child(even) {
	background: none;
}
.my_row{
	border-bottom: 1px solid #ddd;
-->
}
</style>
<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<div class="row-fluid" style="margin-left:10%;">	

	<h2>Which region would you like to go ?</h2><br/>
	<?php
		if($super_admin || $bank_admin){
			if($this->Session->read("RoundBob['Booking']['admin_client_name']")!=null){
				echo '<h6>You are booking for '.($this->Session->read("RoundBob['Booking']['admin_client_name']")).'</h6>';
			}
		}
	?>
		<table border="0" cellspacing="1" cellpadding="1" class="row-fluid">
				
	<tr class="row-fluid"><td colspan="3" class="row-fluid container-fluid"><br /></td></tr>
		
		
  <?php if (!empty($regions) and ($regions!=null)):
				$i = 0;
				$col=0;
				$rowComplete=false;
				foreach ($regions as $region):
					
					$col++;
					if($region['Region']!=null)://if we dont have a null region					
					$class = null;
  ?>
	
	<?php
					
					if($i>=0){
						
						
						if($i%3==0){
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
					
					
					
					echo '<div>';
					
					
					echo $this->Html->link(
									$this->Html->image("bg_login1.png", array('alt'=> __('Destination Region', true), 'border' => '0','style'=>"max-width:200px")),array('action'=>'index',$region['Region']['id']),
									array('target' => '_blank', 'escape' => false)
								);
					
					echo '</div>';
					
					
					echo '<table style="font-size:11px;" ><tr ><td >';
					echo '<p>'.$region['Region']['name'].'</p>';					
					echo '</td></tr></table>';
					
					echo '</td>';
					
					if($i%3==0){
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