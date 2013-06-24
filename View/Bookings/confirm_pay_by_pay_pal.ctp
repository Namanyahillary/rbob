<div class="well">
<div id="breadcrumb">
	<?php 
		if(isset($destination[0]['Destination'])){
			echo '<a href="'.$this->params->webroot.'destinations/index" class="tip-bottom" data-original-title="Go to Destinations"><i class="icon-th"></i>destinations</a>';
		}
	?>
</div><br/><br/>
<h6>Confirmation</h6>
<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<br/>
<?php
if(isset($msg)){
	echo $msg;
}
?>
</div>
</div>