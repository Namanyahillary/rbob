<div class="well">
<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<div id="breadcrumb">
	<?php 
		if(isset($destination[0]['Destination'])){
			echo '<a href="'.$this->params->webroot.'bookings/book/'.$destination[0]['Destination']['id'].'/3333" class="tip-bottom" data-original-title="Go to Destinations"><i class="icon-th"></i>back</a>';
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
<table>
	<tr>
		<td></td>
		<td>Destination</td>
		<td>Cost</td>
		<td>Location</td>
	</tr>
	<tr>
		<td><?php echo $this->Html->image("bg_login1.png", array('alt'=> __('deeloz.ug', true), 'border' => '0','style'=>"max-width:100px"));?></td>
		<td><?php if(isset($destination[0]['Destination'])){ echo h($destination[0]['Destination']['name']); }?></td>
		<td><?php if(isset($destination[0]['Destination'])){ echo h($destination[0]['Destination']['cost']); }?></td>
		<td><?php if(isset($destination[0]['Destination'])){ echo h($destination[0]['Destination']['location']); }?></td>
	</tr>
</table><hr/>
<h6>Confirm payment</h6>
<table>
	<?php foreach($banks as $bank): ?>
		<tr>
			<td><?php echo $this->Html->image("bg_login1.png", array('border' => '0','style'=>"max-width:50px"));?></td>
			<td><?php echo h($bank['Bank']['name']); ?></td>
			<td><?php echo h($bank['Bank']['location']); ?></td>
			<td><span class="btn btn-small"><a href="<?php echo $this->params->webroot;?>bookings/pay_by_bank/<?php if(isset($destination[0]['Destination'])){ echo h($destination[0]['Destination']['id']); }?>/<?php echo h($bank['Bank']['id']); ?>/1/<?php echo h($bank['Bank']['name']); ?>">Confirm</a></span></td>
		</tr>
	<?php endforeach; ?>
	
</table>
</div>