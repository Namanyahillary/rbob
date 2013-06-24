<?php foreach ($groupPostComments as $groupPostComment): ?>
	<p>
		<?php echo $this->Html->image('pic/'.h($groupPostComment['User']['profile_image']),array('style'=>'border-radius:5px;float:left;','width'=>'25px'));?>
		 <div style="margin-left:6%">
			<b><?php echo $name_of_user; ?></b> 
			<?php echo h($groupPostComment['GroupPostComment']['comment']); ?>
		 </div>
		 <span class="time">
			<?php echo $this->Time->timeAgoInWords(h($groupPostComment['GroupPostComment']['date']), array('accuracy' => array('day' => 'day'),'end' => '1 year'));?>
		 </span>
	</p><hr/>
<?php endforeach;?>