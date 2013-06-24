<!--<div style="margin-top:9%">
&nbsp;<?php echo $this->Html->image('search.png'); ?>
</div>
-->

<style>
<!--
.sidebar .widget {
	margin-top: 1.5em;
	overflow: hidden;
}
.widget {
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	-moz-background-clip: padding;
	-webkit-background-clip: padding-box;
	background-clip: padding-box;
	border: 1px solid #cfcfd6;
	background:#f7f8f9;
}

.sidebar .widget h2, .widget h2 {
	margin-top: 0em;
	background: #e5e5e9;
	background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #e5e5e9), color-stop(1, #fbfbfc));
	background: -ms-linear-gradient(bottom, #e5e5e9, #fbfbfc);
	background: -moz-linear-gradient(center bottom, #e5e5e9 0%, #fbfbfc 100%);
	background: -o-linear-gradient(bottom, #e5e5e9, #fbfbfc);
	filter: progid:dximagetransform.microsoft.gradient(startColorStr='#dddde2', EndColorStr='#f9f9f9');
	-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorStr='#fbfbfc',EndColorStr='#e5e5e9')";
	border-bottom: 1px solid #b4b4bf;
	color: #707083;
	text-shadow: 1px 1px 0px #ffffff;
	font-size: 1em;
	border-top: 1px solid #fff;
	margin-bottom: 0px;
	padding-left: 1em;
	-webkit-border-top-right-radius: 5px;
	-webkit-border-bottom-right-radius: 0px;
	-webkit-border-bottom-left-radius: 0px;
	-webkit-border-top-left-radius: 5px;
	-moz-border-radius-topright: 5px;
	-moz-border-radius-bottomright: 0px;
	-moz-border-radius-bottomleft: 0px;
	-moz-border-radius-topleft: 5px;
	border-top-right-radius: 5px;
	border-bottom-right-radius: 0px;
	border-bottom-left-radius: 0px;
	border-top-left-radius: 5px;
	-moz-background-clip: padding;
	-webkit-background-clip: padding-box;
	background-clip: padding-box;
}

.sidebar .widget .cards {
	margin: 0em;
}

.cards {
	list-style: none;
	margin-left: 0px;
	margin: 0em 0em 1em 0em;
}

.cards .title {
	text-transform: uppercase;
	text-shadow: 1px 1px 0px #fff;
	line-height: 1.2em;
	margin-bottom: 1em;
	color: #41414c;
}

.cards .img {
	width: 48px;
	height: 48px;
	float: left;
	margin-right: 1em;
	margin-bottom: 1em;
}

.cards .info-text {
	position: relative;
	top: -4px;
}

.cards .stats {
	padding-top: .75em;
	margin-bottom: 0em;
}

.cards li {
	margin-bottom: 2em 0em;
	padding: 1em;
	border-top: 1px solid #dddde2;
}

.cards .title {
	text-transform: uppercase;
	text-shadow: 1px 1px 0px #fff;
	line-height: 1.2em;
	margin-bottom: 1em;
	color: #41414c;
}

.cards .time {
	font-size: .75em;
	float: right;
}

.cards .stats span {
	margin-right: .75em;
}
.advanced-search{
	cursor:pointer;
}

.advanced-search-box form div {
	clear: both;
	margin-bottom: 0;
	padding: 0;
	vertical-align: text-top;
}

-->
</style>


<div class=" sidebar">
    <div class="widget">
        <h2 class="advanced-search">Advanced Search</h2>
        <div class="advanced-search-box">			
			<?php echo $this->Form->create('Destination',array('action'=>'advanced_search')); ?>
				<fieldset>
				<?php
					echo $this->Form->input('price',array('label'=>'Maximum price($)'));
				?>
					<label>Categories</label>
					<select name="data[Destination][category]">
						<?php foreach($available_categories as $category):?>
							<option value="<?php echo $category['Category']['id']?>"><?php echo $category['Category']['name']; ?></option>
						<?php endforeach; ?>
					</select>	
					
					<label>Country</label>
					<select name="data[Destination][country]">
						<?php foreach($available_countries as $country):?>
							<option value="<?php echo $country['Country']['id']?>"><?php echo $country['Country']['name']; ?></option>
						<?php endforeach; ?>
					</select>					
				</fieldset>
			<span style="float:right;margin-top:-15%;margin-bottom:4%;">
				<?php echo $this->Form->end(__('find')); ?>
			</span>
		</div>
    </div>
	<script>
		$(document).ready(function(){
			/*$('.advanced-search-box').toggle('slow');
			$('.advanced-search').click(function(){
				$('.advanced-search-box,.live-feeds').toggle('slow');
			});*/
		});
	</script>
</div>