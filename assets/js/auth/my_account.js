var base_url;
if (page == 'dashboard') {
	checkUserStatus();
	getUserDashboardOverview();
}

else if (page == 'admin_dashboard') {
	getHerbalHouseOverview();
}

$(".close-jq-toast-single").on('click', function() {
	$("#_alert_web_message").fadeOut(500)
})
function checkUserStatus(){
	$.ajax({
		url: base_url+'my-account/getUserStatus', type: 'GET', dataType: 'JSON',
	})
	.done(function(res) {
		if (res.data.status == 'inactive') {
			$("#_alert_title").text('Welcome!');
			$("#_alert_message").text('This is your Herbal House account!');
			$("#_alert_web_message").show()
			updateUserStatus();	
		}
	})
	.fail(function() {
		console.log("error");
	})
}

function updateUserStatus(){
	$.ajax({
		url: base_url+'my-account/updateUserStatus', type: 'GET', dataType: 'JSON',
	})
}

function getUserDashboardOverview () {
	$("#loader").removeAttr('hidden');
	$.ajax({
		url: base_url+'api/v1/member/_get_user_overview', type: 'GET', dataType: 'JSON',
	})
	.done(function(res) {
		$("#_cash_wallet").text(res.data.wallet)
		$("#_left_side_monitor").text(res.data.left_side_monitor.pos_left)
		$("#_right_side_monitor").text(res.data.right_side_monitor.pos_right)
		$("#_total_pair").text(res.data.total_pair)
		$("#_fifth_pair").text(res.data.fifth_pair)
		$("#loader").attr('hidden','hidden');
	})
	.fail(function() {
		console.log("error");
	})
}
function getHerbalHouseOverview() {
	$("#loader").removeAttr('hidden');
	$.ajax({
		url: base_url+'api/v1/website/_get_overview', type: 'GET', dataType: 'JSON',
	})
	.done(function(res) {
		$("#_members_count").text(res.data.member_count)
		$("#_orders_count").text(res.data.order_count)
		$("#_total_sales").text(res.data.total_sales)

		$("#loader").attr('hidden','hidden');
	})
	.fail(function() {
		console.log("error");
	})
}