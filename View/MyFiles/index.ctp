<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<div class="myFiles well">
	<h6><?php echo __('My Files'); ?></h6>
	<div class="well">
		<div class="btn-group">
			<span class="btn btn-small"><i class="icon icon-plus-sign"></i> <?php echo $this->Html->link(__('New My File'), array('action' => 'add',$my_folder_id)); ?></span>
			<span class="btn btn-small"><i class="icon icon-th"></i><?php echo $this->Html->link(__('List My Folders'), array('controller' => 'my_folders', 'action' => 'index')); ?></span>
			<span class="btn btn-small"><i class="icon icon-plus"></i> <?php echo $this->Html->link(__('New My Folder'), array('controller' => 'my_folders', 'action' => 'add')); ?></span>
		</div>
	</div>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<th class="actions"><?php echo __(''); ?></th>
	</tr>
	<?php foreach ($myFiles as $myFile): ?>
	<tr title="<?php echo h($myFile['MyFile']['description']); ?>">		
		<td>
		<?php
			$fe=strtolower($myFile['MyFile']['file_extension']);
			$file_icon='unknown.png';
			if($fe=='png' or $fe=='jpg' or $fe=='bmp' or $fe=='tif' or $fe=='gif'){$file_icon='picture.png';}
			else if($fe=='zip'){$file_icon='zip.png';}
			else if($fe=='doc'){$file_icon='doc.png';}
			else if($fe=='pdf'){$file_icon='pdf.png';}
			else if($fe=='xls'){$file_icon='xls.png';}
			else if($fe=='pptx'){$file_icon='pptx.png';}
			else if($fe=='exe'){$file_icon='exe.png';}
		?>
		<?php if($file_icon=='unknown.png'): ?>
			<i class="icon icon-file"></i>&nbsp;
		<?php else:?>
			<?php echo $this->Html->image('icons/'.$file_icon,array('alt'=> __($myFile['MyFile']['name'], true), 'border' => '0','title'=>$myFile['MyFile']['name'],'width'=>'30px'));?>
		<?php endif; ?>
		</td>
		<td><?php echo h($myFile['MyFile']['name']); ?>&nbsp;</td>
		<td><?php echo h($myFile['MyFile']['date']); ?>&nbsp;</td>
		<td class="actions">
			<a class="no-ajax" target="_blank" href="<?php echo $this->webroot.'files/my_files_library/'.(h($myFile['MyFile']['filename']));?>"><i class="icon icon-download"></i></a>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $myFile['MyFile']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $myFile['MyFile']['id']), array('class'=>'confirm-first','data-confirm-text'=>'Are you sure you want to delete this file?')); ?>
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
