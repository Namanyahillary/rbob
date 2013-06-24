<div class="albumPhotos view">
<h2><?php  echo __('Album Photo'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($albumPhoto['AlbumPhoto']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Album'); ?></dt>
		<dd>
			<?php echo $this->Html->link($albumPhoto['Album']['name'], array('controller' => 'albums', 'action' => 'view', $albumPhoto['Album']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($albumPhoto['User']['name'], array('controller' => 'users', 'action' => 'view', $albumPhoto['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image File'); ?></dt>
		<dd>
			<?php echo h($albumPhoto['AlbumPhoto']['image_file']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Caption'); ?></dt>
		<dd>
			<?php echo h($albumPhoto['AlbumPhoto']['caption']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($albumPhoto['AlbumPhoto']['date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Album Photo'), array('action' => 'edit', $albumPhoto['AlbumPhoto']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Album Photo'), array('action' => 'delete', $albumPhoto['AlbumPhoto']['id']), null, __('Are you sure you want to delete # %s?', $albumPhoto['AlbumPhoto']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Album Photos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Album Photo'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Albums'), array('controller' => 'albums', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Album'), array('controller' => 'albums', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
