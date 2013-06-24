<div class="well">
<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<?php
if(isset($booking_stage)){
	if($booking_stage==2){

?>
<div id="breadcrumb">
	<?php 
		if(isset($destination[0]['Destination'])){
			echo '<a href="'.$this->params->webroot.'bookings/book/'.$destination[0]['Destination']['id'].'/3333" class="tip-bottom" data-original-title="Go to Destinations"><i class="icon-th"></i>back</a>';
		}
	?>
</div><br/><br/>
<h6>Pay Pal</h6>
<table>
	<tr>
		<td></td>
		<td>Name</td>
		<td></td>
		<td>Confirm payment</td>
	</tr>
	<tr>
		<td><?php echo $this->Html->image("bg_login1.png", array('border' => '0','style'=>"max-width:50px"));?></td>
		<td>Pay Pal</td>
		<td>Using actual Pay Pal account</td>
		<td><span class="btn btn-small"><a href="<?php echo $this->params->webroot;?>bookings/pay_by_pay_pal/<?php if(isset($destination[0]['Destination'])){ echo h($destination[0]['Destination']['id']); }?>/11">Confirm</a></span></td>
	</tr>
	<tr>
		<td><?php echo $this->Html->image("bg_login1.png", array('border' => '0','style'=>"max-width:50px"));?></td>
		<td>Visa card</td>
		<td>Using a visa card</td>
		<td><span class="btn btn-small"><a href="<?php echo $this->params->webroot;?>bookings/pay_by_pay_pal/<?php if(isset($destination[0]['Destination'])){ echo h($destination[0]['Destination']['id']); }?>/2">Confirm</a></span></td>
	</tr>
</table>
<?php
	}
}	
?>
</div>