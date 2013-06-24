<div id="sidebar" style="height:100% ">
	<a href="#" class="visible-phone"><i class="icon icon-home"></i> Categories</a>
	<ul style="display: block;">
		
		<li class="submenu linc5 active">
			<a href="#" linc='linc5'><i class="icon icon-user"></i> <span>My Account</span></a>
			<ul>
				<?php if($logged_in):?>
					<li><?php echo $this->Html->link('Profile',array('controller'=>'users','action'=>'view/'.$users_Id),array('class'=>'use-ajax sub_link','linc'=>'linc5','sub_linc'=>'linc5a')); ?></li>
					<li><?php echo $this->Html->link('Settings',array('controller'=>'users','action'=>'settings/'.$users_Id),array('class'=>'use-ajax sub_link','linc'=>'linc5','sub_linc'=>'linc5b')); ?></li>
				<?php else:?>
					<li><?php echo $this->Html->link('Login',array('controller'=>'users','action'=>'login'),array('class'=>'no-ajax sub_link','linc'=>'linc5','sub_linc'=>'linc5d')); ?></li>
				<?php endif; ?>
				
			</ul>
		</li>
		<?php if($logged_in):?>
		<li class="submenu linc8">
			<a href="#" linc='linc8'><i class="icon icon-th"></i> <span>My Wish List</span></a>
			<ul>
				<li><?php echo $this->Html->link('View wish list',array('controller'=>'wish_lists','action'=>'index'),array('class'=>'use-ajax sub_link','linc'=>'linc8','sub_linc'=>'linc1a')); ?></li>
			</ul>
		</li>
		
		<li class="submenu linc3">
			<a href="#" linc='linc3'><i class="icon icon-briefcase"></i> <span>Holidays</span></a>
			<ul>
				<li><?php echo $this->Html->link('My holidays',array('controller'=>'bookings','action'=>'index'),array('class'=>'use-ajax sub_link','linc'=>'linc3','sub_linc'=>'linc3a')); ?></li>
				<li><?php echo $this->Html->link('My group holidays',array('controller'=>'bookings','action'=>'index','group'),array('class'=>'use-ajax sub_link','linc'=>'linc3','sub_linc'=>'linc3b')); ?></li>
			</ul>
		</li>
		<li class="submenu linc6">
			<a href="#" linc='linc6'><i class="icon icon-globe"></i> <span>Groups</span></a>
			<ul>
				<li><?php echo $this->Html->link('Create group',array('controller'=>'groups','action'=>'add'),array('class'=>'for-modal use-ajax sub_link','linc'=>'linc6','sub_linc'=>'linc6c')); ?></li>
				<?php foreach($my_groups as $group):?>
					<li><?php echo $this->Html->link(h($group['Group']['name']),array('controller'=>'groups','action'=>'view',$group['Group']['id']),array('class'=>'use-ajax sub_link','linc'=>'linc6')); ?></li>
				<?php endforeach; ?>
			</ul>
		</li>
		<?php endif; ?>
		
		<!--
		<li class="submenu linc4">
			<a href="#" linc='linc4'><i class="icon icon-signal"></i> <span>Connections</span></a>
			<ul>
				<li><?php echo $this->Html->link('View connects',array('controller'=>'wish_lists','action'=>'index'),array('class'=>'use-ajax sub_link','linc'=>'linc4','sub_linc'=>'linc1a')); ?></li>
				<li><?php echo $this->Html->link('Invite connect',array('controller'=>'wish_lists','action'=>'index'),array('class'=>'use-ajax sub_link','linc'=>'linc4','sub_linc'=>'linc1b')); ?></li>
				<li><?php echo $this->Html->link('Search connects',array('controller'=>'wish_lists','action'=>'index'),array('class'=>'use-ajax sub_link','linc'=>'linc4','sub_linc'=>'linc1c')); ?></li>
			</ul>
		</li>
		-->
		
		<li class="submenu linc2">
			<a href="#" linc='linc2'><i class="icon icon-pencil"></i> <span>Categories</span></a>
			<ul>
				<li><?php echo $this->Html->link('List categories',array('controller'=>'categories','action'=>'index'),array('class'=>'use-ajax sub_link','linc'=>'linc2','sub_linc'=>'linc1a')); ?></li>
			</ul>
		</li>		
	</ul>
		<div>
			<?php echo $this->Html->image('bob_inv.png',array(
								'style'=>'top:400px;position:absolute;width:50%;'
							)); ?>
		</div>
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