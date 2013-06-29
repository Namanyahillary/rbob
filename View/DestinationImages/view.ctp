<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<div class="destinationImages well">
<h6><?php  echo __('Destination Image'); ?></h6><hr/><br/><br/>
	<dl>
		<dt><?php echo __(''); ?></dt>
		<dd>
			<?php echo $this->Html->image('destination_images/'.(h($destinationImage['DestinationImage']['image_file']))); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Caption'); ?></dt>
		<dd>
			<?php echo h($destinationImage['DestinationImage']['caption']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Destination'); ?></dt>
		<dd>
			<?php echo $this->Html->link($destinationImage['Destination']['name'], array('controller' => 'destinations', 'action' => 'view', $destinationImage['Destination']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($destinationImage['User']['name'], array('controller' => 'users', 'action' => 'view', $destinationImage['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Added by:'); ?></dt>
		<dd>
			<?php echo h($destinationImage['DestinationImage']['date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>