$(document).ready(function(){
	$("#login_pg_hd2").click(function(){ 
		$("#stud_form").fadeOut();
		$("#libr_form").delay(400).fadeIn();
		$("#login_pg_hd2").css({"background-color":"rgba(70,70,70,0.3)"});
		$("#login_pg_hd1").css({"background-color":"rgba(80,80,80)"});
	});
	$("#login_pg_hd1").click(function(){ 
		$("#libr_form").fadeOut();
		$("#stud_form").delay(400).fadeIn();
		$("#login_pg_hd1").css({"background-color":"rgba(70,70,70,0.3)"});
		$("#login_pg_hd2").css({"background-color":"rgba(80,80,80)"});
	});
	$(".prof_menu").click(function(){
		$(".prof_menu").css({"background-color":"rgba(40,40,40)"});
		$(this).css({"background-color":"rgba(70,70,70,0.8)"});
	});
	$("#issue").click(function(){
		$("#remove_con").css({"display":"none"});
		$("#add_con").css({"display":"none"});
		$("#issue_con").css({"display":"block"});
		$("#return_con").css({"display":"none"});
		$("#due_con").css({"display":"none"});
		$("#dueconfirm_con").css({"display":"none"});
	});
	$("#return").click(function(){
		$("#remove_con").css({"display":"none"});
		$("#add_con").css({"display":"none"});
		$("#issue_con").css({"display":"none"});
		$("#return_con").css({"display":"block"});
		$("#due_con").css({"display":"none"});
		$("#dueconfirm_con").css({"display":"none"});
	});
	$("#remove").click(function(){
		$("#remove_con").css({"display":"block"});
		$("#add_con").css({"display":"none"});
		$("#issue_con").css({"display":"none"});
		$("#return_con").css({"display":"none"});
		$("#due_con").css({"display":"none"});
		$("#dueconfirm_con").css({"display":"none"});
	});
	$("#add").click(function(){
		$("#remove_con").css({"display":"none"});
		$("#add_con").css({"display":"block"});
		$("#issue_con").css({"display":"none"});
		$("#return_con").css({"display":"none"});
		$("#due_con").css({"display":"none"});
		$("#dueconfirm_con").css({"display":"none"});
	});
	$("#due").click(function(){
		$("#remove_con").css({"display":"none"});
		$("#add_con").css({"display":"none"});
		$("#issue_con").css({"display":"none"});
		$("#return_con").css({"display":"none"});
		$("#due_con").css({"display":"block"});
		$("#dueconfirm_con").css({"display":"none"});
	});
	$("#final_log2").click(function(){
		$("#dueconfirm_con").css({"display":"none"});
		$("#due_con").css({"display":"block"});
	});
});