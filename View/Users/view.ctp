<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
	
	<?php
//pr($user);
//echo $this->Element('sql_dump');  
?>
<style>
<!--
table tr td {background:none;border-bottom: none;}
.cards li table tr td {padding: 2px;}
table tr:nth-child(even) {background: none;}
.my_row{border-bottom: 1px solid #ddd;}

.widget {margin-top: 1.5em;overflow: hidden;}
.widget {-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;-moz-background-clip: padding;-webkit-background-clip: padding-box;background-clip: padding-box;border: 1px solid #cfcfd6;background:#f7f8f9;}
.sidebar .widget .cards {margin: 0em;}
.cards {list-style: none;margin-left: 0px;margin: 0em 0em 1em 0em;}
.cards .title {text-transform: uppercase;text-shadow: 1px 1px 0px #fff;line-height: 1.2em;margin-bottom: 1em;color: #41414c;}
.cards .img {width: 48px;height: 48px;float: left;margin-right: 1em;margin-bottom: 1em;}
.cards .info-text {position: relative;top: -4px;}
.cards .stats {padding-top: .75em;margin-bottom: 0em;}
.cards li {margin-bottom: 2em 0em;padding: 1em;border-top: 1px solid #dddde2;}
.cards .title {text-transform: uppercase;text-shadow: 1px 1px 0px #fff;line-height: 1.2em;margin-bottom: 1em;color: #41414c;}
.cards .time {font-size: .75em;float: right;}
.cards .stats span {margin-right: .75em;}

.advanced-search{cursor:pointer;}
.advanced-search-box form div {clear: both;margin-bottom: 0;padding: 0;vertical-align: text-top;}

.simple-post form div, .photo-post form div{margin-bottom: 0;padding: 0;vertical-align: text-top;}
.simple-post fieldset, .photo-post fieldset{margin-bottom: 0;padding: 0;}
.simple-post form .submit, .photo-post form .submit{padding: 0px 0px;float: right;margin-top: -1%;}
.simple-post label, .photo-post label{display:none;}

.my-wish-list ul{max-height:174px;overflow-y:auto;}

-->
</style>


<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<div class="row-fluid">	


	<?php
		if($super_admin || $bank_admin){
			if($this->Session->read("RoundBob['Booking']['admin_client_name']")!=null){
				echo '<h6 class="btn btn-danger">** You are booking for '.($this->Session->read("RoundBob['Booking']['admin_client_name']")).' **</h6>';
			}
		}
	?>
		<table>
			<tr>
				<td style="width:75%;">
					<table border="0" cellspacing="1" cellpadding="1" class="row-fluid">
						<!--<tr>
							<td colspan="2">
								<div>
									<?php echo $this->Html->image('user_covers/'.($user['User']['cover_img']),array(
									'style'=>'width:100%;border-radius:10px;border:2px solid #cfcfcf;'
									)); ?>
								</div>
							</td>
						</tr>-->
						<!--
						<tr>
							<td colspan="2">
								<div class="well">
									<div style="float:left;">
										<?php if($bank_admin): ?>
											<a class="btn btn-info no-ajax" href="<?php echo $this->webroot;?>">** Create destination **</a>
										<?php endif;?>
										<div class="btn-group">											
											<a href="#" class="btn btn-small"><i class="icon icon-pencil"></i> About</a>																				
											<a href="#" class="btn btn-small"><i class="icon icon-film"></i> Photos</a>
										</div>
									</div
									<div class="pull-right">										
										<div class="btn-group">
											<a href="#" data-toggle="dropdown" class="no-ajax btn btn-small dropdown-toggle"><i class="icon-cog"></i>&nbsp;<span class="caret"></span></a>
											<ul class="dropdown-menu">
												<li class="dropdown"><a href="<?php echo $this->webroot;?>users/change_cover_img" class="for-modal">Change Cover</a></li>
											</ul>
										</div>
									</div>
								</div>
							</td>
						</tr>
						-->
							
						<tr>
							<td>
								<div class="widget">
									<h2 class="advanced-search" title="About me"><b>About</b></h2>									
									<ul class="cards">										
										<li>											
											<p class="info-text">
													<?php
														echo $this->Html->image("pic/" . $user['User']['profile_image'], array('width' => '50px', 'height' => '40px', 'alt' => 'Profile Picture','style'=>'border-radius: 7px;border: 1px solid #eee;'));
													?><span style="margin:8px"><b><?php echo $user['User']['name']; ?></b></span>
													<a href="<?php echo $this->webroot.'users/settings/'.$user['User']['id']; ?>"><span style="float:right;" class="btn btn-small" title="Edit"><i class="icon icon-edit"></i></span></a>
													<hr/>
													<table>
														<tr>
															<td><b><i class="icon icon-envelope"></i> Email</b></td>
															<td><?php echo $user['User']['email']; ?></td>
														</tr>
														<tr>
															<td><b><i class="icon icon-pencil"></i> Contact</b></td>
															<td><?php echo $user['User']['phone']; ?></td>
														</tr>
														<tr>
															<td><b><i class="icon icon-share"></i> Facebook</b></td>
															<td><a class="no-ajax" href="http://www.facebook.com/<?php echo $user['User']['facebook_profile']; ?>" target="_blank"><?php echo $user['User']['facebook_profile']; ?></a></td>
														</tr>
													</table>													
											</p>
										</li>
									</ul>
									
														
								</div>
							</td>
							<td>
								<div class="widget my-wish-list">
									<h2 class="advanced-search" title="Places i wish to go."><?php echo $user['User']['name']; ?>'s <b>Wish List</b></h2>									
									<ul class="cards">	
										<?php foreach($user['WishList'] as $wish): ?>											
											<li>											
												<p class="info-text">
													<?php
														echo $this->Html->image("imagecache/destinations/" . ($wish['Destination']['image_file']), array('width' => '50px', 'height' => '40px', 'alt' => 'Profile Picture','style'=>'border-radius: 7px;border: 1px solid #eee;'));
													?><a href="<?php echo $this->webroot.'destinations/view/'.($wish['Destination']['id']);?>"><span style="margin:8px"><b><?php echo ($wish['Destination']['name']);?></b></a></span>
												</p>
											</li>
										<?php endforeach; ?>
										
									</ul>			
								</div>								
							</td>
						</tr>
					  
					</table>	
				</td>
				<td>
					<?php echo $this->Element('others/left_panel1')?>
				</td>
			</tr>
		</table>
</div>

<div class="actions">
</div>