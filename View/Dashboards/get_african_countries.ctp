<div class="countries-other-countries well">
<?php foreach($countries as $country):?>
	<select class="other-countries">
		<option selected="selected" value="">select from Africa</option>
		<option value="<?php echo $country['Country']['id'];?>"><?php echo $country['Country']['name'];?></option>
	</select>
	<a href="#" class="other-country-link no-ajax btn btn-small" style="margin-top: -8px;"><i class="icon icon-white"></i> ok</a>
<?php endforeach; ?>
</div>

<script>
$(document).ready(function(){
	$('.countries-other-countries select').change(function(){
		var root_ref=<?php echo $this->webroot; ?>;
		$('.other-country-link').attr('href',(root_ref+'dashboards/set_country/'+($('.countries-other-countries select').val())+'/other_country'));
	});
});
</script>