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
}
.categories-img{
	border:3px solid green;
	border-radius:15px;
	
}
.categories-img img{
	border-top:3px solid green;
	border-radius:0px 0px 8px 8px;
}
.sidebar{
	margin-top: 90px;
}
-->
</style>
<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<div class="row-fluid">	


	<?php
		if($super_admin || $bank_admin){
			if($this->Session->read("RoundBob['Booking']['admin_client_name']")!=null){
				echo '<h6>You are booking for '.($this->Session->read("RoundBob['Booking']['admin_client_name']")).'</h6>';
			}
		}
	?>
		<table>
			<tr>
				<td colspan="4">
					<?php echo $this->Element('others/country_header'); ?>
				</td>
			</tr>
			<tr>
				<td style="width:75%;">
					<table border="0" cellspacing="1" cellpadding="1" class="row-fluid">
						<tr>
							<td colspan="3">
								<div style="text-align:center;font-size:200%;color:green;font-weight:bold;">
									<?php echo date('F').' '.date('Y');?> Travel Offers
								</div>
							</td>
						</tr>
						<tr class="row-fluid"><td colspan="3" class="row-fluid container-fluid"><br /></td></tr>
							
							
					  <?php if (!empty($categories)):
									$i = 0;
									$col=0;
									$rowComplete=false;
									shuffle($categories);
									foreach ($categories as $category):
										$col++;
										if($category!=null)://if we dont have a null category
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
												echo '</tr><tr class="my_row">'.'	<td style="width:'.(100/3).'%">';
											}else{
												echo '	'.'<td style="width:'.(100/3).'%">';						
											}
										}
										
										
										
										echo '<div class="categories-img">';
										
										echo '<h6 style="text-align:center;width:100%">'.$category['Category']['name'].'</h6>';
										
										echo $this->Html->link(
														$this->Html->image("categories/".$category['Category']['image_file'], array('alt'=> __('roundbob.com', true), 'border' => '0','style'=>"width:100%")),
														array('controller' => 'categories', 'action' => 'view', $category['Category']['id']),
														array('target' => '_blank', 'escape' => false)
													);
										
										echo '</div>';
										
										
										echo '<table style="font-size:11px;" ><tr ><td >';
										
										
										echo '</td></tr></table>';
										
										echo '</td>';
										
										if($i%3==0){
											$rowComplete=true;
											
										}
										
										
											endif;
											$i++;
										endforeach;
										
										if(!$rowComplete){
											echo '</td></tr>';
										}
										
										
								endif;
						?>
					</table>	
				</td>
				<td>
					<?php echo $this->Element('others/left_panel1')?>
				</td>
			</tr>
		</table>
		<center>
			<p>
			<?php
			echo $this->Paginator->counter(array(
			'format' => __('Page {:page} of {:pages}, showing {:current} categories out of {:count}, starting on category {:start}, ending on {:end}')
			));
			?>	</p>
			<div class="paging">
			<?php
				echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
				echo $this->Paginator->numbers(array('separator' => ''));
				echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
			?>
			</div>
		</center>
</div>