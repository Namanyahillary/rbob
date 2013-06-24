<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<div class="myFolders well">
	<div class="well">
		<h6><?php echo __('My Folders'); ?></h6>
		<a href="<?php echo $this->webroot.'my_folders/add';?>"><span class="btn btn-small"><i class="icon icon-plus-sign"></i> New folder</span></a>
	</div>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<th><?php echo $this->Paginator->sort('last_modified'); ?></th>
			<th class="actions"><?php echo __(''); ?></th>
	</tr>
	<?php foreach ($myFolders as $myFolder): ?>
	<tr title="<?php echo h($myFolder['MyFolder']['description']); ?>">
		<td>
			<a href="<?php echo $this->webroot.'my_files/index/'.(h($myFolder['MyFolder']['id']));?>"><image src="<?php echo $this->webroot.'img/icons/folder.png';?>" /></a>
		</td>
		<td><?php echo h($myFolder['MyFolder']['name']); ?>&nbsp;</td>
		<td><?php echo h($myFolder['MyFolder']['date']); ?>&nbsp;</td>
		<td><?php echo h($myFolder['MyFolder']['last_modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $myFolder['MyFolder']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $myFolder['MyFolder']['id']), null, __('Are you sure you want to delete # %s?', $myFolder['MyFolder']['id'])); ?>
		</td>
	</tr>
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