<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<div class="currencies view">
<h2><?php  echo __('Currency'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($currency['Currency']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($currency['Currency']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Short Code'); ?></dt>
		<dd>
			<?php echo h($currency['Currency']['short_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rate'); ?></dt>
		<dd>
			<?php echo h($currency['Currency']['rate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country'); ?></dt>
		<dd>
			<?php echo $this->Html->link($currency['Country']['name'], array('controller' => 'countries', 'action' => 'view', $currency['Country']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Currency'), array('action' => 'edit', $currency['Currency']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Currency'), array('action' => 'delete', $currency['Currency']['id']), null, __('Are you sure you want to delete # %s?', $currency['Currency']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Currencies'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Currency'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
	</ul>
</div>
