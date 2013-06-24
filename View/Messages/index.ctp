<style>
<!--
	.my-list-items td{background:#fff !important;}
	.unread td{background:#EAFFFF !important;}
	table
-->
</style>

<?php echo $this->Html->script(array

('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash

(); ?></div>

<div class="messages">
	<h6><i class="icon-envelope"></i> <?php echo __('Inbox');?></h6><br/>
	
	<div>
		<table>
			<tr>				
				<td width="50%" class="well">					
					<div>
						<div class="btn-group">
							<a class="btn dropdown-toggle no-ajax" style="color:#000;" data-toggle="dropdown" href="#"><i class="icon-fire"></i> <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li class="dropdown"><a class="delete-msgs" style="color:#000 !important;"><i class="icon-trash"></i> delete</a></li>
							</ul>
							<a href="<?php echo $this->params->webroot.'messages'; ?>" class="btn tip-bottom" data-original-title="refresh"><i class="icon icon-refresh"></i></a>
						</div>
						<a href="<?php echo $this->params->webroot.'messages/add'; ?>" class="btn btn-danger tip-bottom add-msg for-modal" data-original-title="Compose Message" style="float:right;"><i class="icon-plus-sign icon-white"></i> compose</a>						
					</div>
				</td>	
			</tr>
			<tr >
				<td>
					<div class="action-response"></div>
				</td>
			</tr>
		</table>
	</div>
	
	
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th></th>
			<th><?php echo $this->Paginator->sort('From'); ?></th>
			<th><?php echo $this->Paginator->sort('message_subject'); ?></th>
			<th><?php echo $this->Paginator->sort('message_date'); ?></th>
			<th style="display:none;"><?php echo $this->Paginator->sort('message_status_id');?></th>
			<th class="actions"><?php echo __(''); ?></th>
			
	</tr>
	<?php foreach ($messages as $message): ?>
	<div class="msg msg-block_<?php echo $message['Message']['id']; ?>" >
		<tr class="<?php if($message['MessageStatus']['id']==1) echo "unread".' '.$message['Message']['id']; ?>">
			<td><input type="checkbox" msg_id="<?php echo $message['Message']['id']; ?>" />
				<?php 
						if($message['Message']['message_kind_id']==3) 
							echo $this->Html->Image("pdf.png",array('width'=>'25px','height'=>'25px'));//in case a file attachment is sent
				?>
			</td>
			<td>
				<?php if($users_Id==$message['User']['id']) 
							echo $this->Html->link('me', array('controller' => 'users', 'action' => 'view', $message['User']['id'])); 
						  else
							echo $this->Html->link($message['User']['name'], array('controller' => 'users', 'action' => 'view', $message['User']['id'])); 
					?>
			</td>
			<td><?php echo h($message['Message']['message_subject']); ?>&nbsp;</td>
			
			<td><?php echo h($message['Message']['message_date']); ?>&nbsp;</td>
			
			<td class="msg-status" style="display:none;">
					<?php echo $this->Html->link($message['MessageStatus']['id'], array('controller' => 'message_statuses', 'action' => 'view', $message['MessageStatus']['id'])); ?>
				</td>
			
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('action' => 'view', $message['Message']['id']),array('class'=>'view-msg for-modal','msg_id'=>$message['Message']['id'])); ?>
			</td>
		</tr>
	</div>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>