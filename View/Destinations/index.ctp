<?php
$_currency=($this->Session->read("RoundBob['Destination']['Currency']"));
?>
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
.destinations-img{
	border:3px solid green;
	border-radius:15px;
	
}
.destinations-img img{
	border-top:3px solid green;
	<!--border-radius:0px 0px 8px 8px;-->
}

.destinations-imgs{
	background:#2c2c2c;
	border-radius: 7px;
	border: 3px solid #ddd;
}
.destinations-imgs img{
	border-radius: 5px 5px 0px 0px;
}
.destinations-imgs h6{
	color: #fff;font-size: 14px;line-height: 20px;margin-bottom: 3px;
}
.destinations-imgs h2{
	margin: 0px 0px 40px;color: #909090;font-size: 11px;line-height: 15px;text-transform: lowercase;font-family: "arial rounded mt bold", helvetica, arial, sans-serif;font-weight: normal;border-bottom: none;
}

.extra-content{
	text-align: right;font-family: "arial rounded mt bold",helvetica,arial,sans-serif;float:right;margin:-32px -13px 0px 0;
}

.sidebar{
	margin-top: 50px;
}

-->
</style>
<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>

<div class="well">
<div>
	<a href="<?php echo $this->params->webroot; ?>categories" class="tip-bottom" data-original-title="Go to categories"><span class="btn btn-small btn-inverse" style="position:absolute;margin: 9px 0px 0px 6px"><i class="icon-white icon-chevron-left"></i>back</span></a>
	
	</a>

</div><br/><br/>
<div class="row-fluid">	
	<?php
		if($super_admin || $bank_admin){
			if($this->Session->read("RoundBob['Booking']['admin_client_name']")!=null){
				echo '<h6>You are booking for '.($this->Session->read("RoundBob['Booking']['admin_client_name']")).'</h6>';
			}
		}
	?>
		<table width="100%">
			<tr>
				<td colspan="4">
					<?php echo $this->Element('others/country_header'); ?>
				</td>
			</tr>
			<tr>
				<td style="width:75%;">
					<table border="0" cellspacing="1" cellpadding="1" class="row-fluid" width="100%">
						<tr class="row-fluid"><td colspan="3" class="row-fluid container-fluid"><br /></td></tr>
							
							
					  <?php if (!empty($destinations)):
									$i = 0;
									$col=0;
									$rowComplete=false;
									if(!$super_admin and!$collector1)
										shuffle($destinations);
									foreach ($destinations as $destination):
										$col++;
										if($destination!=null)://if we dont have a null destination
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
										
										
										
										echo '<div class="destinations-imgs">';
										
											
											
											echo $this->Html->link(
															$this->Html->image("destinations/".$destination['Destination']['image_file'], array('alt'=> __('roundbob.com', true), 'border' => '0','style'=>"width:100%;height:220px")),
															array('controller' => 'destinations', 'action' => 'view', $destination['Destination']['id']),
															array('target' => '_blank', 'escape' => false)
														);
											echo '<div>';
												echo '<div style="margin:10px;">';
													echo '<h6>'.$destination['Destination']['name'].'</h6>';
													echo '<h2>Located in <b style="color:#999;">'.$destination['Destination']['location'].'</b></h2>';
													echo '<span class="extra-content">';
														echo '<span><span class="price" style="text-align:right;color: #f0812b;font-size: 20px;margin-right: 5px;vertical-align: bottom;"><sup>'.($_currency['Currency']['short_code']).'</sup>'.h($destination['Destination']['cost'])*($_currency['Currency']['rate']).'</span></span>';
														echo '<div class="btn-group">';
														if($super_admin){
															echo '<a href="'.($this->webroot).'destinations/bob_admin_edit/'.($destination['Destination']['id']).'"><span class="btn btn-small btn-primary"><i class="icon-white icon-edit"></i></span></a>';
															if(!$destination['Destination']['is_approved']){
																echo '<a class="confirm-first" data-confirm-text="Approve destination? Confirm action." href="'.($this->webroot).'destinations/approve/'.($destination['Destination']['id']).'"><span class="btn btn-small btn-success"><i class="icon-white icon-ok"></i></span></a>';
															}else{
																echo '<a class="confirm-first" data-confirm-text="Dis-Approve destination? Confirm action." href="'.($this->webroot).'destinations/dis_approve/'.($destination['Destination']['id']).'"><span class="btn btn-small btn-danger"><i class="icon-white icon-trash"></i></span></a>';
															}
														}
														echo '</div>';
													echo '</span>';
												echo '</div>';
											echo '</div>';
										
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
			'format' => __('Page {:page} of {:pages}, showing {:current} destinations out of {:count}, starting on destinations {:start}, ending on {:end}')
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

<div id="breadcrumb">
	<a href="<?php echo $this->params->webroot; ?>categories" class="tip-bottom" data-original-title="Go to categories"><span class="btn btn-large btn-inverse"><i class="icon-white icon-chevron-left"></i>back</span></a>
	<?php
		if($super_admin || $bank_admin){
			if($this->Session->read("RoundBob['Booking']['admin_client_name']")!=null){
				echo ' > <span style="color:red">You are booking for '.($this->Session->read("RoundBob['Booking']['admin_client_name']")).'</span>';
			}
		}
	?>
	</a>

</div><br/><br/>

</div>