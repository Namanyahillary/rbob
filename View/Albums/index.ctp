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
	border-bottom: none;
}
.categories-img img{
	border-radius:0px 0px 8px 8px;
	border:3px solid #eee;
}
-->
</style>
<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<div class="row-fluid" >	


	<?php
		if($super_admin || $bank_admin){
			if($this->Session->read("RoundBob['Booking']['admin_client_name']")!=null){
				echo '<h6>You are booking for '.($this->Session->read("RoundBob['Booking']['admin_client_name']")).'</h6>';
			}
		}
	?>
		<table>
			<tr>
				<td style="width:75%;">
					<table border="0" cellspacing="1" cellpadding="1" class="row-fluid">
						<tr>
							<td colspan="3">
								<div style="text-align:left;font-weight:bold;"><br/>
									Albums<hr/>
								</div>
							</td>
						</tr>
						<tr class="row-fluid"><td colspan="3" class="row-fluid container-fluid"><br /></td></tr>
							
							
					  <?php if (!empty($albums)):
									$i = 0;
									$col=0;
									$rowComplete=false;
									foreach ($albums as $album):
										$col++;
										if($album!=null)://if we dont have a null album
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
											echo '<a class="change-container" loadable-container=".group-container" href="'.($this->webroot.'album_photos/index/'.($album['Album']['id'])).'">'.$this->Html->image("imagecache/album_photos/".$album['Album']['cover_img'], array('alt'=> __('roundbob.com', true), 'border' => '0','style'=>"width:100px")).'</a>';
											//echo '<a href="'.($this->webroot.'album_photos/index').'">'.$this->Html->image("imagecache/album_photos/".$album['Album']['cover_img'], array('alt'=> __('roundbob.com', true), 'border' => '0','style'=>"width:100px")).'</a>';
											echo '<br/>'.$album['Album']['name'];
										echo '</div>';
										
										
										echo '<table style="font-size:11px;" ><tr><td >';
										
										
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