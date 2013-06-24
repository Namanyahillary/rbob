<div id="sub-view-port">
    
</div>
<div class="messages">
<h5><?php echo $message['Message']['message_subject']; ?></h5>
<div style="font-size:10px;">
sent on <?php echo $message['Message']['message_date']; ?>
</div>
<hr>
<?php echo $message['Message']['message_body']; ?><br/><br/>
<div class="well">
    <?php echo $this->Html->link('delete', array('controller' => 'messages', 'action' => 'delete', $message['Message']['id']),array('class'=>'delete-msg btn get-sub-view btn-small')); ?>
    <?php if($message['Message']['message_kind_id']==3)://message has an attachment; ?>
        <?php echo $this->Html->link(__('preview pdf', true), "http://localhost:8081/umeme/pdf/".$message['Message']['filename'],array('class'=>'btn btn-small','target'=>'_blank')); ?>
    <?php endif; ?>
    <!--<?php echo $this->Html->link(__('download pdf', true), array('action' => 'items_in_store','pdf_download','controller'=>'reports'),array('class'=>'btn btn-small','onClick'=>'return false;','target'=>'_blank')); ?>-->
    <?php echo $this->Html->link('reply', array('controller' => 'messages', 'action' => 'add', $message['Message']['user_id']),array('class'=>'reply-msg get-sub-view btn btn-small','style'=>'float:right')); ?>
</div>
</div>
<br/>