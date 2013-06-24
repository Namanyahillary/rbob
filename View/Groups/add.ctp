<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<div class="groups">
<?php echo $this->Form->create('Group',array('class'=>'no-ajax')); ?>
	<fieldset>
		<legend><?php echo __('Create a Group'); ?></legend>
	<?php
		echo $this->Form->input('name',array('label'=>'Group name'));
	?>
	</fieldset><hr/>
	<table>
	<tbody>
		<tr class="dataRow">
			<th class="label">Privacy:</th>
				<td class="data">
							<div>
								<input type="radio" id="privacy_1" name="data[Group][privacy]" value="open">
									<label for="privacy_1">
										<span class="fwb">
											<span style="padding-left: 17px;">
												<i class="icon icon-globe" style="top: 1px;"></i> Open
											</span>
										</span>
										<div>Anyone can see the group, who's in it, and what members post.</div>
									</label>
							</div>
							<div >
								<input type="radio" id="privacy_2" name="data[Group][privacy]" value="closed" checked="1">
									<label for="privacy_2">
										<span>
											<span style="padding-left: 17px;">
												<i class="icon icon-lock" style="top: 1px;"></i> Closed
											</span>
										</span>
										<div>Anyone can see the group and who's in it. Only members see posts.</div>
									</label>
							</div>
							<div >
								<input type="radio" id="privacy_3" name="data[Group][privacy]" value="secret">
									<label for="privacy_3">
										<span>
											<span style="padding-left: 17px;">
												<i class="icon icon-eye-close" style="top: 1px;"></i> Secret
											</span>
										</span>
										<div>Only members see the group, who's in it, and what members post.</div>
									</label>
							</div>
					<div>
						<a  target="_blank" href="#">Learn more about groups privacy</a>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
<?php echo $this->Form->end(__('Submit')); ?>
</div>