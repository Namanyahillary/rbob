<div class="messageKinds view">
<h2><?php  echo __('Message Kind'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($messageKind['MessageKind']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kind'); ?></dt>
		<dd>
			<?php echo h($messageKind['MessageKind']['kind']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Message Kind'), array('action' => 'edit', $messageKind['MessageKind']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Message Kind'), array('action' => 'delete', $messageKind['MessageKind']['id']), null, __('Are you sure you want to delete # %s?', $messageKind['MessageKind']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Message Kinds'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Message Kind'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Messages'), array('controller' => 'messages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Message'), array('controller' => 'messages', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Messages'); ?></h3>
	<?php if (!empty($messageKind['Message'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('To'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Message Subject'); ?></th>
		<th><?php echo __('Message Body'); ?></th>
		<th><?php echo __('Message Status Id'); ?></th>
		<th><?php echo __('Message Date'); ?></th>
		<th><?php echo __('Message Kind Id'); ?></th>
		<th><?php echo __('Filename'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($messageKind['Message'] as $message): ?>
		<tr>
			<td><?php echo $message['id']; ?></td>
			<td><?php echo $message['to']; ?></td>
			<td><?php echo $message['user_id']; ?></td>
			<td><?php echo $message['message_subject']; ?></td>
			<td><?php echo $message['message_body']; ?></td>
			<td><?php echo $message['message_status_id']; ?></td>
			<td><?php echo $message['message_date']; ?></td>
			<td><?php echo $message['message_kind_id']; ?></td>
			<td><?php echo $message['filename']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'messages', 'action' => 'view', $message['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'messages', 'action' => 'edit', $message['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'messages', 'action' => 'delete', $message['id']), null, __('Are you sure you want to delete # %s?', $message['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Message'), array('controller' => 'messages', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
