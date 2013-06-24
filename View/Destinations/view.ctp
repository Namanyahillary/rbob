<?php
	$_currency=($this->Session->read("RoundBob['Destination']['Currency']"));
	$_activities_selected=$this->Session->read("RoundBob['Booking']['activities']");
	//pr($_activities_selected);
	$activity_total_price=0;
	if(isset($_activities_selected['RoundBob']['Booking']['Destination_'.($destination['Destination']['id'])])){
			foreach($_activities_selected['RoundBob']['Booking']['Destination_'.($destination['Destination']['id'])] as $activ){
				foreach($activ as $a){	
					$activity_total_price+=$a['Activity']['price'];
				}
			}
	}	
?>

<style>
	<!--
	div.form, div.index, div.view {
		width: 45%;
		border-left: 1px solid #ddd;
	}
	
	.my-activities table tr:nth-child(even) {
	background: none;
	}
	.my-activities table tr td {padding: 3px;text-align: left;border-bottom: none;}
	-->
</style>
<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<div class="well">
<div id="breadcrumb">
	<a href="<?php echo $this->params->webroot; ?>destinations" class="tip-bottom" data-original-title="Go to Destinations"><span class="btn btn-small btn-inverse"><i class="icon-white icon-chevron-left"></i>back</span></a>
	<a class="current" href="#"><?php  echo h($destination['Destination']['name']); ?>
	<?php
		if($super_admin || $bank_admin){
			if($this->Session->read("RoundBob['Booking']['admin_client_name']")!=null){
				echo ' > <span style="color:red">You are booking for '.($this->Session->read("RoundBob['Booking']['admin_client_name']")).'</span>';
			}
		}
	?>
	</a>

</div><br/><br/>
<div class="destinations view">

	<dl>
		<dt>&nbsp;</dt>
		<dd>
			<span class="wish-list-resp"></span>	
			&nbsp;
		</dd>
	</dl><br/>
	<div>
		<sup class="price-currency" style="color: #f0812b;font-size: 40px;"><?php echo ($_currency['Currency']['short_code']); ?></sup>
		<span class="net-price" style="color: #f0812b;font-size: 70px;font-weight: normal;font-style: normal;line-height: 1;"><?php echo h($destination['Destination']['cost'])*($_currency['Currency']['rate']); ?></span>
	</div><br/>
	<div style="color:red;font-weight:bold;float:right;margin-top: 15px; margin-left:25px;">
			<div class="book-as-group">
				<?php if($logged_in && $regular):?>
					<?php if($this->Session->read("RoundBob['Booking']['book_as_Group']")):?>
						<span class="part1">You are booking as a Group</span><br/><b><a class="no-ajax" onclick="return false;" href="#" ><i class="icon icon-briefcase"></i> <span class="part2">Change to <?php echo h($name_of_user);?></span></a>	</b>
						&nbsp;
					<?php else: ?>
						<span class="part1">You are booking as <?php echo h($name_of_user);?></span><br/><b><a class="no-ajax" onclick="return false;" href="#" ><i class="icon icon-briefcase"></i> <span class="part2">Change to a group</span></a>	</b>
						&nbsp;						
					<?php endif; ?>
				<?php endif; ?>
			</div>
	</div><br/>
	<div class="btn-group" style="float:right;">
		<?php if($logged_in):?>
			<?php if($regular):?>
				<span class="btn btn-primary add-to-wish-list">Add to wish list</span>
			<?php endif; ?>
			<span class="btn btn-danger">
					<?php
						echo $this->Html->link('Book',array('controller'=>'bookings','action'=>'book',$destination['Destination']['id']),array('style'=>'color:#fff'));
					?>
			</span>
			<?php if($super_admin || $collector1): ?>
			<span class="btn btn-primary">
					<?php 
						echo $this->Html->link('Add Activity',array('controller'=>'activities','action'=>'add',$destination['Destination']['id']),array('style'=>'color:#fff'));
					?>
			</span>
			<?php endif; ?>
		<?php else:?>
			<span class="btn btn-primary"><i class="icon-off icon-white"></i><a style="color:#fff" href="<?php echo $this->webroot;?>users/login"> Login to book</a></span>
		<?php endif; ?>
	</div>
	<h6>Activities</h6><hr/>
	<div class="my-activities" style="min-height: 85px;max-height: 210px;over-flow:scroll;overflow-x: auto;">
		<table>
			<?php $counter=3;?>
			<?php foreach($destination['Activity'] as $activity):$counter++;?>
				<?php
					if(isset($_activities_selected['RoundBob']['Booking']['Destination_'.($destination['Destination']['id'])]['activities'][''.($activity['id'])])){
						continue;
					}
				?>
				<tr style="margin-left:0px;">
					<td style="vertical-align: middle;">
						<?php echo $this->Html->image('imagecache/activities/'.$activity['cover_img'],array('title'=>$activity['name'],'style'=>'height:70px'));?>
					</td>
					<td style="vertical-align: middle;">
						<?php echo $activity['name'];?>
					</td>
					<td style="vertical-align: middle;">
						<?php echo ($_currency['Currency']['short_code']).''.h($activity['price'])*($_currency['Currency']['rate']); ?>
					</td>
					<?php if($logged_in):?>
					<td style="vertical-align: middle;">
						<a title="add" href="<?php echo $this->webroot.'bookings/add_activity/'.$destination['Destination']['id'].'/'.$activity['id'];?>" style="color:#fff"><span class="btn btn-info"><i class="icon-white icon-plus-sign"></i></span></a>
					</td>
					<?php endif;?>
				</tr>				
			<?php endforeach;?>
		</table>
	</div>
	
	
	<?php if(count($_activities_selected['RoundBob']['Booking']['Destination_'.($destination['Destination']['id'])])):?>	
	<h6>Activities added</h6><hr/>
	<div class="my-activities" style="min-height: 85px;max-height: 210px;over-flow:scroll;overflow-x: auto;">
		<table class="">
			<?php $counter=3;?>
			<?php if(isset($_activities_selected['RoundBob']['Booking']['Destination_'.($destination['Destination']['id'])])):?>
				<?php foreach($_activities_selected['RoundBob']['Booking']['Destination_'.($destination['Destination']['id'])] as $activ):?>
				
					<?php foreach($activ as $a):$counter++;?>
						
						<tr style="margin-left:0px;">
							<td style="vertical-align: middle;">
								<?php echo $this->Html->image('imagecache/activities/'.$a['Activity']['cover_img'],array('title'=>$a['Activity']['name'],'style'=>'height:70px'));?>
							</td>
							<td style="vertical-align: middle;">
								<?php echo $a['Activity']['name'];?>
							</td>
							<td style="vertical-align: middle;">
								<?php echo ($_currency['Currency']['short_code']).''.h($a['Activity']['price'])*($_currency['Currency']['rate']); ?>
							</td>
							<?php if($logged_in):?>
							<td style="vertical-align: middle;">
								<a title="remove" href="<?php echo $this->webroot.'bookings/remove_activity/'.$destination['Destination']['id'].'/'.$a['Activity']['id'];?>" style="color:#fff"><span class="btn btn-info"><i class="icon-white icon-remove"></i></span></a>
							</td>
							<?php endif;?>
						</tr>				
					<?php endforeach;?>
				<?php endforeach;?>
			<?php endif; ?>
		</table>
	</div>
	<?php endif; ?>
	<!--
	<img style="float:right;margin-top:5%;border:2px solid #2c2c2c;border-radius: 5px;" class="framed" src="<?php echo $this->webroot; ?>assets/map.png" alt="" style="width:300px">
	
	-->
</div>
<div class="actions" style="width:40%;">
	<?php echo $this->Html->image("destinations/".($destination['Destination']['image_file']), array('alt'=> __('deeloz.ug', true), 'border' => '0','style'=>"width:100%;border-radius:10px;border:2px solid #cfcfcf;")); ?>
	
	<dl style="margin-top:2%;">
		<dt><?php echo __('Location'); ?></dt>
		<dd>
			<?php echo h($destination['Destination']['location']); ?>
		</dd>
		<dt><?php echo __('Destination costs'); ?></dt>
		<dd>
			<?php echo ($_currency['Currency']['short_code']).''.h($destination['Destination']['cost'])*($_currency['Currency']['rate']); ?>
		</dd>
		<dt><?php echo __('Activities cost'); ?></dt>
		<dd>
			<?php echo ($_currency['Currency']['short_code']).''.h($activity_total_price)*($_currency['Currency']['rate']); ?>
		</dd>
		<dt><br/><?php echo __('Total cost'); ?></dt>
		<dd>
			<?php echo ($_currency['Currency']['short_code']).''.h($activity_total_price+$destination['Destination']['cost'])*($_currency['Currency']['rate']); ?>
		</dd>
	</dl><br/>
	<div style="width: 40%;float: right;">
		<div class="span4"><?php echo $this->Html->image('icons/fb_share.png'); ?></div>
		<div class="span4"><?php echo $this->Html->image('icons/twitter_share.png'); ?></div>
		<div class="span4"><?php echo $this->Html->image('icons/rss_share.png'); ?></div>
	</div>
</div>

<div class="related">
            
	<ul class="nav nav-tabs" id="myTab">
		<li><a href="#a" class='no-ajax'><i class="icon-th-list"></i> Related Places</a></li>
		<li><a href="#b" class='no-ajax'><i class="icon-edit"></i> Reviews</a></li>
		<li><a href="#c" class='no-ajax'><i class="icon-trash"></i> History</a></li>
	</ul>
		
	<div class="tab-content">
		<div id="a" class="tab-pane active">
			People who visit <?php  echo h($destination['Destination']['name']); ?> also visit Uganda
		</div>
		<div id="b" class="tab-pane">
			I love this place
			
		</div>
		<div id="c" class="tab-pane">
			Two people have gone to this place.
		</div>		
		<hr/>
		<script>
			var user_name=''+'<?php echo h($name_of_user);?>';
			$(document).ready(function(){
				$('.add-to-wish-list').click(function(){
					$.get('<?php echo $this->webroot; ?>wish_lists/add/<?php echo $destination['Destination']['id']; ?>',function(resp){
						$('.wish-list-resp').html(resp);
					});
				});
				
				$('.book-as-group a').click(function(){
					$.get('<?php echo $this->webroot; ?>bookings/book_as',function(resp){
						res=Number(resp);
						if(res==0){
							$('.book-as-group .part1').html("You are booking as "+user_name);
							$('.book-as-group .part2').html("Change to a group");
						}else{
							$('.book-as-group .part1').html("You are booking a group");
							$('.book-as-group .part2').html("Change to "+user_name);
						}
						
					});
				});
			
				$('#myTab a').click(function (e){
					e.preventDefault();
					$(this).tab('show');
				});
			});			
		</script>
			
	</div>
</div>
</div>