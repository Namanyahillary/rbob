<?php
//pr($group_posts);
?>
<style>
<!--
table tr td {background:none;border-bottom: none;}
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
				<td style="width:75%;">
					<table border="0" cellspacing="1" cellpadding="1" class="row-fluid">
						<tr>
							<td colspan="2">
								<div>
									<?php echo $this->Html->image('group_covers/'.($group['Group']['cover_img']),array(
									'style'=>'width:100%;border-radius:10px;border:2px solid #cfcfcf;'
									)); ?>
								</div>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<div class="well">
									<div style="float:left;">
										<a href="#" class="btn btn-small"><i class="icon icon-pencil"></i> About</a>																				
										<!--<a href="<?php echo $this->webroot.'albums/index/'.($group['Group']['id']);?>" class="btn btn-small change-container" loadable-container=".group-container"><i class="icon icon-film"></i> Photos</a>-->
										<a href="<?php echo $this->webroot.'albums';?>" class="btn btn-small change-container" loadable-container=".group-container"><i class="icon icon-film"></i> Photos</a>
										
									</div>
									<div class="pull-right">
										<div class="btn-group">
											<?php if($is_member): ?>
												<?php if(!$has_confirmed): ?>												
													<a data-toggle="dropdown" class="no-ajax btn btn-small dropdown-toggle"><i class="icon icon-plus-sign"></i>You were Invited <span class="caret"></span></a>
													<ul class="dropdown-menu">   
														<li class="dropdown"><a href="<?php echo $this->webroot;?>groups/approve_request/<?php echo $group['Group']['id']; ?>"><i class="icon icon-ok"></i> Approve request</a></li>
														<li class="dropdown"><a href="<?php echo $this->webroot;?>groups/disapprove_request/<?php echo $group['Group']['id']; ?>"><i class="icon icon-remove"></i> Disapprove request</a></li>
													</ul>
												<?php endif; ?>
											<?php else: ?>
												<a href="<?php echo $this->webroot;?>groups/join_group/<?php echo $group['Group']['id']; ?>" class="btn btn-small confirm-first" data-confirm-text="Are you sure you want to join this group?"><i class="icon icon-plus-sign"></i> Join</a>
											<?php endif; ?>
										</div>
										
										<div class="btn-group">
											<a href="#" data-toggle="dropdown" class="no-ajax btn btn-small dropdown-toggle"><i class="icon-cog"></i>&nbsp;<span class="caret"></span></a>
											<ul class="dropdown-menu">
												<li class="dropdown"><a href="#">Members</a></li>
												<?php if($is_member): ?>
													<li class="divider"></li>
													<li class="dropdown"><a href="<?php echo $this->webroot;?>groups/change_cover_img/<?php echo $group['Group']['id']; ?>" class="for-modal">Change Cover</a></li>
													<li class="dropdown"><a href="<?php echo $this->webroot;?>group_members/add" class="for-modal">Add Members</a></li>
													<li class="dropdown"><a href="<?php echo $this->webroot;?>groups/leave_group/<?php echo $group['Group']['id']; ?>" class="confirm-first" data-confirm-text="Are you sure you want to leave this group?">Leave group</a></li>
													<li class="dropdown"><a href="#">Privacy settings</a></li>
												<?php endif;?>
												<li class="dropdown"><a href="<?php echo $this->webroot;?>groups/add" class="for-modal">Create New group</a></li>
												
											</ul>
										</div>
									</div>
								</div>
							</td>
						</tr>
							
						<tr>
							<td style="width:75%" class="group-container">
								<span class="btn btn-small add-simple-post">Post</span>
								<span class="btn btn-small add-photo-post">Post Photo</span>
								
								<div class="well simple-post">									
									<?php echo $this->Form->create('GroupPost',array('action'=>'add')); ?>
										<fieldset>
										<?php
											echo $this->Form->input('group_id',array('type'=>'hidden','value'=>$group['Group']['id']));
											echo $this->Form->input('content',array('label'=>'','rows'=>'3','placeholder'=>'type your post here ...'));
										?>
										</fieldset>
									<?php echo $this->Form->end(__('post'),array('style'=>'')); ?>
								</div>
								
								<div class="well photo-post">
									<?php echo $this->Form->create('GroupPost',array('type'=>'file','id'=>'post_photo','class'=>'no-ajax','action'=>'add')); ?>
										<fieldset>
										<?php
											echo $this->Form->input('group_id',array('type'=>'hidden','value'=>$group['Group']['id']));
											//echo $this->Form->input('image_url');
											echo $this->Form->input('fileField',array('type'=>'file','label'=>'Photo(png,jpg)','name'=>'fileField'));
											echo $this->Form->input('content',array('label'=>'','rows'=>'2','placeholder'=>'write about this photo ...'));
										?>
										</fieldset>
									<?php echo $this->Form->end(__('post')); ?>
								</div>
								
								
								<div class="widget">
									<ul class="cards">
										<?php foreach($group_posts as $group_post):?>										
											<li>
												<b><p class="title"><?php echo h($group_post['User']['name']);?></p></b>
												
												<div class="img">
													<?php echo $this->Html->image('pic/'.h($group_post['User']['profile_image']),array('style'=>'border-radius:5px','width'=>'100px'));?>
												</div>
												
												<?php if($group_post['GroupPost']['has_image']==1): ?>
													<p class="info-text" style="min-height:200px;">														
														<?php echo $this->Html->image('group_posts/'.h($group_post['GroupPost']['image_url']),array('style'=>'border-radius:5px;float:left;margin:2%;'));?>
														<?php echo h($group_post['GroupPost']['content']); ?>
													</p>
												<?php else: ?>
													<p class="info-text"><?php echo h($group_post['GroupPost']['content']); ?></p>
												<?php endif; ?>
												
												<div class="stats">
													<span class="btn btn-small view-comments" pid="<?php echo h($group_post['GroupPost']['id']); ?>">comments</span>
													<p class="time"><?php echo $this->Time->timeAgoInWords(h($group_post['GroupPost']['date']), array('accuracy' => array('day' => 'day'),'end' => '1 year'));?></p>
												</div>
												<div class="well comments-block comments-block_<?php echo $group_post['GroupPost']['id']; ?>">												
													<div class="comments-box comments-box_<?php echo h($group_post['GroupPost']['id']); ?>">
														
													</div>
													<p>
														<?php echo $this->Html->image('pic/'.$profile_image,array('style'=>'border-radius:5px;float:left;','width'=>'25px'));?>
														<form action="<?php echo $this->webroot;?>group_post_comments/add" method="POST" style="clear:none" class="post-comment no-ajax" pid=<?php echo h($group_post['GroupPost']['id']); ?>>
															<input type="text" name="data[GroupPostComment][comment]" style="width: 60%;margin-left: 2%;" placeholder="Write a comment here..." required=''/>
															<input type="hidden" name="data[GroupPostComment][group_post]" value="<?php echo $group_post['GroupPost']['id']; ?>" />
														</form>
													</p>													
												</div>
											</li>
										<?php endforeach;?>
										
										<li class="more">
											<a href="#">load more</a>
										</li>
									</ul>
								</div>
								
							</td>
							<td >
								<br/><br/>
								<div class="">
									<h6><i class="icon icon-user"></i> Members <sup class="notifications" style="color:#fff;background:green;border: 2px solid greenyellow;border-radius: 10px;"><?php echo (count($members['GroupMember'])); ?></sup></h6><hr/>
									<p>
									<?php foreach ($members['GroupMember'] as $groupMember): ?>
											<a href="<?php echo $this->webroot;?>users/view/<?php echo $groupMember['User']['id']; ?>"><?php echo $this->Html->image("pic/".$groupMember['User']['profile_image'], array('alt'=> __('roundbob.com', true), 'border' => '0','style'=>"width:30px")); ?></a>
									<?php endforeach; ?>

									</p>
									
									<h6><i class="icon icon-map-marker"></i> Places we've gone to</h6><hr/>
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
<!--
<form action="<?php echo $this->webroot;?>/group_post_comments/add" method="POST" style="clear:none" class="post-comment no-ajax">
	<input type="text" name="data[GroupPostComment][comment]" style="width: 60%;margin-left: 2%;" placeholder="Write a comment here..." required=''/>
	<input type="hidden" name="data[GroupPostComment][group]" value="<?php echo $group['Group']['id']; ?> />
</form>
-->
<script>
	$(document).ready(function(){
		$('.comments-block,.simple-post,.photo-post').hide();
		$('.view-comments').click(function(){			
			$('.comments-block_'+($(this).attr('pid'))).toggle('slow');
		});
		
		$('.add-simple-post').click(function(){
			$('.simple-post').toggle('slow');
			$('.photo-post').hide();
		});
		
		$('.add-photo-post').click(function(){
			$('.photo-post').toggle('slow');
			$('.simple-post').hide();
		});
		
		//submit Form data
		$(".post-comment").submit(function(e){
			var $form = $( this ),
			my_url = $form.attr( 'action' );
			e.preventDefault();
			dataString = $( this ).serialize();		
			_obj=$(this);
			$.ajax({type: "POST",url: my_url,data: dataString,dataType: "html",
				success: function(data) {					
					$('.comments-box_'+(_obj.attr('pid'))).html(data);
				} ,
				error: function() {}
			});			
		});
		
		$('.view-comments').click(function(){
			var pid=$(this).attr('pid');
			$.get('<?php echo $this->webroot;?>group_post_comments/index/'+(pid),function(data){
				$('.comments-box_'+(pid)).html(data);
			});
		});
	});
</script>