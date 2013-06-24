<div id="search">
	<input type="text" class="search_query_string" placeholder="Search...">
	
	<button type="submit" class="tip-right booking_search_query_btn" data-original-title="Enter transaction reference" search-target="<?php echo $this->webroot; ?>bookings/bob_admin_search"><i class="icon-search icon-white"></i> Booking</button>
	
	<button type="submit" class="tip-right user_search_query_btn" data-original-title="Enter client name" search-target="<?php echo $this->webroot; ?>users/search"><i class="icon-search icon-white"></i> Client</button>
</div>

<style>
<!--
#search{
	position: absolute;
	z-index: 25;
	top: -2%;
	left: 230px;
}
#user-nav {
    position: absolute;
    right: 30px;
    top: -2.1%;
    z-index: 20;
    margin: 0;
}
-->
</style>