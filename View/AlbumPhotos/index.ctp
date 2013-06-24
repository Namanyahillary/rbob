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
									Photos<hr/>
								</div>
							</td>
						</tr>
						<tr class="row-fluid"><td colspan="3" class="row-fluid container-fluid"><br /></td></tr>
							
							
					  <?php if (!empty($albumPhotos)):
									$i = 0;
									$col=0;
									$rowComplete=false;
									foreach ($albumPhotos as $albumPhoto):
										$col++;
										if($albumPhoto!=null)://if we dont have a null album
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
										
										
										/*echo '<div class="categories-img">';	
											echo $this->Html->image("imagecache/album_photos/".$albumPhoto['AlbumPhoto']['image_file'], array('alt'=> __('roundbob.com', true), 'border' => '0','style'=>"width:100px"));
										echo '</div>';*/
										
										echo '<div class="deals_index_image categories-img">';					
										echo '<a href="'.($this->webroot).'img/album_photos/'.$albumPhoto['AlbumPhoto']['image_file'].'" class="boxer no-ajax" title="'.h($albumPhoto['AlbumPhoto']['caption']).'" rel="gallery">
												<img class="pirobox_gal1" src="'.($this->webroot).'img/imagecache/album_photos/'.$albumPhoto['AlbumPhoto']['image_file'].'" alt="Thumbnail One" />
											</a>';
										echo '</div>';
										
										?>
										
										<div class="col3">
											<a href="images/image1.jpg" class="pirobox_gall no-ajax" data-pirobox="gallery" title="test 1">
												<img src="<?php echo $this->webroot;?>images/image1.jpg"  />
											</a>

											<a href="images/image2.jpg" class="pirobox_gall no-ajax" data-pirobox="gallery" title="test 3">
												<img src="<?php echo $this->webroot;?>images/image2.jpg"  />
											</a>

											<a href="images/image3.jpg" class="pirobox_gall no-ajax" data-pirobox="gallery" title="test 4">
												<img src="<?php echo $this->webroot;?>images/image3.jpg"  />
											</a>

											<a href="images/slide4.jpg" class="pirobox_gall no-ajax" data-pirobox="gallery" title="test 5">
												<img src="<?php echo $this->webroot;?>images/image4.jpg"  />
											</a>
										</div>
										
										<?php
										
										
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

<script>
$(document).ready(function(){	
	//$(".boxer").boxer();
});
</script>

<script type="text/javascript">
$(document).ready(function() {
	/*$().piroBox({
			my_speed: 400, //animation speed
			bg_alpha: 0.1, //background opacity
			slideShow : false, // true == slideshow on, false == slideshow off
			slideSpeed : 4, //slideshow duration in seconds(3 to 6 Recommended)
			close_all : '.piro_close,.piro_overlay'// add class .piro_overlay(with comma)if you want overlay click close piroBox

	});*/
	
	$.pirobox_ext({
		attribute: 'data-pirobox',
		piro_speed : 800,
		bg_alpha : .3,
		resize : true,
		zoom_mode : true,
		move_mode : 'drag',
		piro_scroll : true,
		share: true
	});
	
});
</script>