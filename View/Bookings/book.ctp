<div class="well">
<?php
	$_currency=($this->Session->read("RoundBob['Destination']['Currency']"));
	$_activities_selected=$this->Session->read("RoundBob['Booking']['activities']");
?>

<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>

<div id="breadcrumb">
	<?php 
		if(isset($destination[0]['Destination'])){
			echo '<a href="'.$this->params->webroot.'destinations/view/'.$destination[0]['Destination']['id'].'" class="tip-bottom" data-original-title="Go to Destinations"><i class="icon-th"></i>back</a>';
		}
	?>
	<?php
		if($super_admin || $bank_admin){
			if($this->Session->read("RoundBob['Booking']['admin_client_name']")!=null){
				echo '<span style="color:red"> You are booking for '.($this->Session->read("RoundBob['Booking']['admin_client_name']")).'</span>';
			}
		}
	?>
</div><br/><br/>

<h6>Summary</h6>
<table class="well">
	<tr>
		<td></td>
		<td>Destination</td>
		<td>Cost</td>
		<td>Location</td>
	</tr>
	<tr>
		<td><?php echo $this->Html->image("bg_login1.png", array('alt'=> __('deeloz.ug', true), 'border' => '0','style'=>"max-width:100px"));?></td>
		<td><?php if(isset($destination[0]['Destination'])){ echo h($destination[0]['Destination']['name']); }?></td>
		<td><?php if(isset($destination[0]['Destination'])){
			echo ($_currency['Currency']['short_code']).' '.h($destination[0]['Destination']['cost'])*($_currency['Currency']['rate']);
		}?>
		</td>
		<td><?php if(isset($destination[0]['Destination'])){ echo h($destination[0]['Destination']['location']); }?></td>
	</tr>
</table>
<br/><br/>

<?php if($this->Session->read("RoundBob['Booking']['book_as_Group']")):?>
	<h6>Choose your group</h6>
	<div class="well">
		<div class="group-selection">
			<select title="Select group you are booking for.">
				<option selected="selected" value="0">--select group--</option>
				<?php foreach($groups as $group): ?>				
					<option value="<?php echo h($group['Group']['id']); ?>"><?php echo h($group['Group']['name']); ?></option>
				<?php endforeach; ?>
			</select>
			<span class="btn btn-small" style="float:right;" onclick="alert($('.group-selection select').val());"><i class="icon icon-plus-sign"></i> Create travel group</span>
		</div>
		
	</div>
<?php endif;?>

<h6>Activities added</h6><hr/>
<div class="my-activities" style="min-height: 85px;max-height: 210px;over-flow:scroll;overflow-x: auto;">
	<table class="well">
		<?php $activity_total_price=0; ?>
		<?php if(isset($_activities_selected['RoundBob']['Booking']['Destination_'.($destination[0]['Destination']['id'])])):?>
			<?php foreach($_activities_selected['RoundBob']['Booking']['Destination_'.($destination[0]['Destination']['id'])] as $activ):?>
			
				<?php foreach($activ as $a):?>
					
					<tr style="margin-left:0px;">
						<td style="vertical-align: middle;">
							<?php echo $this->Html->image('imagecache/activities/'.$a['Activity']['cover_img'],array('title'=>$a['Activity']['name'],'style'=>'height:70px'));?>
						</td>
						<td style="vertical-align: middle;">
							<?php echo $a['Activity']['name'];?>
						</td>
						<td style="vertical-align: middle;">
							<?php echo 
							($_currency['Currency']['short_code']).' '.h($a['Activity']['price'])*($_currency['Currency']['rate']);
							$activity_total_price+=$a['Activity']['price'];?>
						</td>
						<td style="vertical-align: middle;">
							<a href="<?php echo $this->webroot.'bookings/remove_activity/'.$destination[0]['Destination']['id'].'/'.$a['Activity']['id'];?>" style="color:#fff"><span class="btn btn-info"><i class="icon-white icon-remove"></i> remove</span></a>
						</td>
					</tr>				
				<?php endforeach;?>
			<?php endforeach;?>
		<?php endif; ?>
		<tr>
			<td><b>Total:</b><td>
			<td><b>
				<?php 
					echo 
					($_currency['Currency']['short_code']).' '.h($activity_total_price)*($_currency['Currency']['rate']);
				?></b></td>
			<td>&nbsp;</td>
		</tr>
	</table>
</div>

<br/><br/>

<div class="well">
<b>
	<p class="btn btn-inverse" style="float:right;">
	Overall cost: 
		<?php echo ($_currency['Currency']['short_code']).' '.h($activity_total_price+$destination[0]['Destination']['cost'])*($_currency['Currency']['rate']); ?>
	</p>
</b>
</div>

<br/><br/>

<h6>Select Payment mode</h6>
<table class="well">
	<tr>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>Bank</td>
		<td>
			<div class="bank-selection">
				<select title="Select where the bank you will pay from is located.">
					<option selected="selected" value="0">--select your payment bank country--</option>
					<?php foreach($countries as $country): ?>				
						<option value="<?php echo h($country['Country']['id']); ?>"><?php echo h($country['Country']['name']); ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</td>
		<td valign="center"><span class="btn btn-success xyz" bk_type="1" dest="<?php if(isset($destination[0]['Destination'])){ echo h($destination[0]['Destination']['id']); }?>"><i class="icon-white icon-ok"></i> Ok</span></td>
	</tr>
	<?php if(!$bank_admin): ?>
		<tr>
			<td><a href="<?php echo $this->params->webroot; ?>bookings/book/<?php if(isset($destination[0]['Destination'])){ echo h($destination[0]['Destination']['id']); }?>/2">Pay pal</a></td>
			<td>Deposit to our pay pal account.</td>
			<td></td>
		</tr>
	<?php endif; ?>
</table>

<script>
	$('.xyz').click(function(){
		var c=$(".bank-selection select").val();//selected country
		<?php if($this->Session->read("RoundBob['Booking']['book_as_Group']")):?>
			var g=$(".group-selection select").val();//select group
		<?php endif; ?>
		var bt=$(this).attr('bk_type');//book type
		var d=$(this).attr('dest');//destination
		
		if(c==0){
			alert("Please select country of the bank you are going to pay from. Thanks");return false;		
		}
		
		<?php if($this->Session->read("RoundBob['Booking']['book_as_Group']")):?>
		if(g==0){
			alert("Please select one of your Groups. Thanks");return false;		
		}
		<?php endif;?>
		showLoading();
		_url='<?php echo $this->webroot;?>bookings/book/'+d+'/'+bt+'/'+c;
		<?php if($this->Session->read("RoundBob['Booking']['book_as_Group']")):?>
			if(g!=0){
				_url='<?php echo $this->webroot;?>bookings/book/'+d+'/'+bt+'/'+c+'/'+g;	
			}
		<?php endif; ?>
		$.ajax({
			url: _url,
			success: function(data) {removeLoading();$('.dynamic-content').html(data);},
			error: function() {removeLoading();}
		});
		
	});
</script>
</div>