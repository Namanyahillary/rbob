<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<?php
	//pr($response);
?>

<style>
<!--
.results{
}
-->
</style>

<div class="results">
	<h6>TRANSAACTIONS NOT FOUND: The following transaction refrences in EXCEL File were not found.</h6>
	<table class="well">
		<tr>
			<td><b>Transaction ref</b></td>
		</tr>
		<?php foreach($response['TRefsNotFound'] as $r):?>
			<tr>
				<td><?php echo h($r);?></td>
			</tr>
		<?php endforeach; ?>
	</table>

	<h6>AMOUNT NOT MATCHING: The following transactions were not found</h6>
	<table class="well">
		<tr>
			<td><b>Transaction ref</b></td>
			<td><b>Database amount</b></td>
			<td><b>Excel amount</b></td>
			<td>Action</td>
		</tr>
		<?php foreach($response['AmountNotMatching'] as $r):?>
			<tr>
				<td><?php echo h($r['tref']);?></td>
				<td><?php echo h($r['db_amount']);?></td>
				<td><?php echo h($r['excel_amount']);?></td>
				<td>Action</td>
			</tr>
		<?php endforeach; ?>
	</table>


	<h6>TRANSACTIONS ALREADY CONFIRMED: The following transactions are already confirmed.</h6>
	<table class="well">
		<tr>
			<td>
				<b>Transaction refrence</b>
			</td>
		</tr>
		<?php foreach($response['IsAlreadyConfirmed'] as $r):?>
			<tr>
				<td>
					<?php echo h($r); ?>
				</td>
			</tr>		
		<?php endforeach; ?>
	</table>

	<h6>TRANSACTIONS CONFIRMED:The following transactions have been confirmed</h6>
	<table class="well">
		<tr>
			<td>
				<b>Transaction ref</b>
			</td>
		</tr>
		<?php foreach($response['HasBeenConfirmed'] as $r):?>
			<tr>
				<td>
					<?php echo h($r); ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>


	<h6>FAILED TRANSACTION CONFIRMATIONS: The following transactions could not be confirmed.</h6>
	<table class="well">
		<tr>
			<td>
				<b>Transaction ref</b>
			</td>
		</tr>
		<?php foreach($response['HasFailedConfirmation'] as $r):?>
			<tr>
				<td>
					<?php echo h($r); ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>