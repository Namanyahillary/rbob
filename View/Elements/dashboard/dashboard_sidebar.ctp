<div id="sidebar">
	<a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
	<ul style="display: block;">
	
		<?php if($super_admin): ?>
			<li class="submenu active linc1">
				<a href="#" linc='linc1'><i class="icon icon-edit"></i> <span>Super Administration</span></a>
				<ul>
					<li><?php echo $this->Html->link('Add Users',array('controller'=>'users','action'=>'add'),array('class'=>'use-ajax sub_link','linc'=>'linc1','sub_linc'=>'linc1b')); ?></li>
					<li><?php echo $this->Html->link('Bank Users',array('controller'=>'users','action'=>'index'),array('class'=>'use-ajax sub_link','linc'=>'linc1','sub_linc'=>'linc1b')); ?></li>
				</ul>
			</li>
		<?php endif; ?>
		
		<li class="submenu linc5 <?php if(!$super_admin){echo 'active';} ?>">
			<a href="#" linc='linc5'><i class="icon icon-user"></i> <span>Client Accounts</span></a>
			<ul>
				<li><?php echo $this->Html->link('Top Up Credit',array('controller'=>'users','action'=>'index'),array('class'=>'use-ajax sub_link','linc'=>'linc5','sub_linc'=>'linc5b')); ?></li>
			</ul>
		</li>
		
		<?php if($super_admin): ?>
		<li class="submenu linc2">
			<a href="#" linc='linc2'><i class="icon icon-pencil"></i> <span>Destinations</span></a>
			<ul>
				<li><?php echo $this->Html->link('List',array('controller'=>'destinations','action'=>'index'),array('class'=>'use-ajax sub_link','linc'=>'linc2','sub_linc'=>'linc2a')); ?></li>
				<li><?php echo $this->Html->link('Add',array('controller'=>'destinations','action'=>'bob_admin_add'),array('class'=>'use-ajax sub_link','linc'=>'linc2','sub_linc'=>'linc2b')); ?></li>
			</ul>
		</li>
		<?php endif; ?>
		
		<?php if($super_admin): ?>
		<li class="submenu linc7">
			<a href="#" linc='linc7'><i class="icon icon-file"></i> <span>Directory</span></a>
			<ul>
				<li><?php echo $this->Html->link('Folders',array('controller'=>'my_folders','action'=>'index'),array('class'=>'use-ajax sub_link','linc'=>'linc7','sub_linc'=>'linc2a')); ?></li>
			</ul>
		</li>
		<?php endif; ?>
		
		<li class="submenu linc3">
			<a href="#" linc='linc3'><i class="icon icon-th-list"></i> <span>Bookings</span></span></a>
			<ul>
				<li><?php echo $this->Html->link('List',array('controller'=>'bookings','action'=>'bob_admin_index'),array('class'=>'use-ajax sub_link','linc'=>'linc3','sub_linc'=>'linc3a')); ?></li>
			</ul>
		</li>
		
		<!--
		<li class="submenu linc6">
			<a href="#" linc='linc6'><i class="icon icon-bell"></i> <span>Alerts</span></a>
			<ul>				
				<li></li>
			</ul>
		</li>
		-->
		
		
		<li class="submenu linc4">
			<a href="#" linc='linc4'><i class="icon icon-file"></i> <span>Payment Statements</span></a>
			<ul>				
				<li><?php echo $this->Html->link('List Files',array('controller'=>'payment_statements','action'=>'index'),array('class'=>'use-ajax sub_link','linc'=>'linc4','sub_linc'=>'linc4a')); ?></li>
				<?php if($bank_admin): ?>
					<li><?php echo $this->Html->link('Upload File',array('controller'=>'payment_statements','action'=>'add'),array('class'=>'use-ajax sub_link','linc'=>'linc4','sub_linc'=>'linc4b')); ?></li>
				<?php endif; ?>
			</ul>
		</li>
		
	</ul>		
</div>

<script>
	var current_linc='linc_a';//set the first active link
	$(document).ready(function(){
		$('#sidebar a').click(function(){
			
			$('#sidebar ul li').removeClass('active');
			
			var linc=$(this).attr('linc');
			$('.'+linc).addClass('active');
			$('.display-none').fadeIn('slow');
			
			var _url=$(this).attr('data-taget');
			
			if($(this).hasClass('sub_link')){
				linc=$(this).attr('sub_linc');
			}
			
			if(_url!='' && _url!='#' && current_linc!=linc ){
				current_linc=linc;
				show_loading();
				$.get(_url, function(data) {
					after_fetching_data(data);
					remove_loading();
				});
			}
			
		});
		
	});
</script>