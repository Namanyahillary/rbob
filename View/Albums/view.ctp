<div class="albums view">
<h2><?php  echo __('Album'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($album['Album']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($album['User']['name'], array('controller' => 'users', 'action' => 'view', $album['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($album['Album']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($album['Album']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($album['Album']['type']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Album'), array('action' => 'edit', $album['Album']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Album'), array('action' => 'delete', $album['Album']['id']), null, __('Are you sure you want to delete # %s?', $album['Album']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Albums'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Album'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Album Photos'), array('controller' => 'album_photos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Album Photo'), array('controller' => 'album_photos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Album Photos'); ?></h3>
	<?php if (!empty($album['AlbumPhoto'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Album Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Image File'); ?></th>
		<th><?php echo __('Caption'); ?></th>
		<th><?php echo __('Date'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($album['AlbumPhoto'] as $albumPhoto): ?>
		<tr>
			<td><?php echo $albumPhoto['id']; ?></td>
			<td><?php echo $albumPhoto['album_id']; ?></td>
			<td><?php echo $albumPhoto['user_id']; ?></td>
			<td><?php echo $albumPhoto['image_file']; ?></td>
			<td><?php echo $albumPhoto['caption']; ?></td>
			<td><?php echo $albumPhoto['date']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'album_photos', 'action' => 'view', $albumPhoto['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'album_photos', 'action' => 'edit', $albumPhoto['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'album_photos', 'action' => 'delete', $albumPhoto['id']), null, __('Are you sure you want to delete # %s?', $albumPhoto['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Album Photo'), array('controller' => 'album_photos', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
