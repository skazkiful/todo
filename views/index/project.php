<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?if(!empty($projectinfo['name'])){?>Project: <?=$projectinfo['name']?><?}else{?>Main page<?}?></title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
<link rel="stylesheet" href="http://<?=$site?>/styles/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="http://<?=$site?>/styles/css/style.css">
<style>
.showclass{
	display: inline-block;
}
.showclassproject{
	display: inline-block;
}
</style>
  </head>

<body style="background: #efefef;">

<?require_once(ROOT . '/views/index/head.php');?>

<div class="container" style="padding-top:56px;">
<div class="row">
<?require_once(ROOT . '/views/index/leftmenu.php');?>
<div class="col-md-9" style="background:white;">
<div style="height:100%;">
<?php if(!empty($hightpriorite)){foreach ($hightpriorite as $project):?>
<div class="onhover" id="task<?=$project['id']?>">
<div class="tasktype" style="background:#<?=$project['taskcolor']?>;"></div>
<div class="taskname" style="color:red;"><?=$project['name']?></div>
<div class="taskproject"><?=$project['projectname']?><div class="projectcolor" style="background:#<?=$project['color']?>;"></div>
<div class="showhide" id="showhide<?=$project['id']?>">
<div class="dropdown">
<div id="drop<?=$project['id']?>">
 <a href="#" role="button" onclick="showhide(<?=$project['id']?>);" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  <img style="width:15px;height:15px;" src="http://<?=$site?>/styles/img/menu.png">
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#" onclick="edit(<?=$project['id']?>);">Edit</a>
    <a class="dropdown-item" href="#" onclick="deletet(<?=$project['id']?>);">Delete</a>
    <a class="dropdown-item" href="#" onclick="done(<?=$project['id']?>);">Done</a>
  </div>
</div>
</div>
</div>
</div>
</div>
<?php endforeach;?>
<?}?>
<?php if(!empty($lowpriorite)){foreach ($lowpriorite as $project):?>
<div class="onhover" id="task<?=$project['id']?>"><div class="tasktype" style="background:#<?=$project['taskcolor']?>;"></div>
<div class="taskname" id="taskname<?=$project['id']?>"><?=$project['name']?></div>
<div class="taskproject"><?=$project['projectname']?><div class="projectcolor" style="background:#<?=$project['color']?>;"></div>
<div class="showhide" id="showhide<?=$project['id']?>">
<div class="dropdown">
<div>
 <a href="#" role="button" onclick="showhide(<?=$project['id']?>);" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  <img style="width:15px;height:15px;" src="http://<?=$site?>/styles/img/menu.png">
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#" onclick="edit(<?=$project['id']?>);">Edit</a>
    <a class="dropdown-item" href="#" onclick="deletet(<?=$project['id']?>);">Delete</a>
		<?if($a !== 'arch'){?><a class="dropdown-item" href="#" onclick="done(<?=$project['id']?>);">Done</a><?}?>
  </div>
</div>
</div>
</div>
</div>
</div>
<?php endforeach;?>
<?}?>
				<a id="newtaskbutton" style="color:red;cursor:pointer;<?if($a == 'arch'){echo 'display:none;';}?>" onclick="newtask('show');">+ add task</a>
	<div id="newtask" style="display:none;">
	<form action="http://<?=$site?>/addtask" method="post" novalidate onsubmit="return checkform();">
	<div class="input-group">
      <input type="text" placeholder="Task" name="task" class="form-control">
	  <span class="input-group-btn">
      <input type="text" placeholder="Date" id="datepicker" name="date" class="form-control">
    </span>
    </div>
	<div style="margin-top:10px;margin-bottom: 10px;">
	<button type="submit" class="btn btn-primary">Add</button> <a onclick="newtask('hide');" style="color:#686868;cursor:pointer;">Cancel</a>
	<div style="float:right;">
	<div class="dropdown" style="display: inline-block;margin-right:5px;">
<div>
 <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  <img style="width:20px;height:20px;" src="http://<?=$site?>/styles/img/smile.png">
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
  <?php if(!empty($projects)){foreach ($projects as $project):?>
  <a class="dropdown-item" onclick="choseproject(<?=$project['id']?>)" href="#"><?=$project['name']?></a>
<?php endforeach;?>
<?}?>
  </div>
</div>
</div>
	<div class="dropdown" style="display: inline-block;">
<div>
 <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  <img style="width:20px;height:20px;" src="http://<?=$site?>/styles/img/flash.png">
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" onclick="choseprior(3)" href="#">Low</a>
    <a class="dropdown-item" onclick="choseprior(2)" href="#">Medium</a>
    <a class="dropdown-item" onclick="choseprior(1)" href="#">High</a>
  </div>
</div>
</div>
	</div>
	</div>
		<input type="text" style="display:none;" name="chosenproject" id="chosenproject">
		<input type="text" style="display:none;" name="chosenprior" id="chosenprior">
	</form>
</div>
</div>
</div>
</div>
</div>
<div class="modal fade" id="edittaskmodal" tabindex="-1" role="dialog" aria-labelledby="commentmodal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit task</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
		<input type="text" class="form-control" required id="edittaskinput" >
      </div>
      <div class="modal-footer" style="margin-top: 0px;">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<a href="#" id="newcloselink" class="btn btn-primary" onclick="savetask();">Save</a>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="editprojectmodal" tabindex="-1" role="dialog" aria-labelledby="commentmodal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit project</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
				<input type="text" class="form-control" required id="editprojectinput" >
      </div>
      <div class="modal-footer" style="margin-top: 0px;">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<a href="#" id="newcloselink" class="btn btn-primary" onclick="saveproject();">Save</a>
      </div>
    </div>
  </div>
</div>
<input type="text" id="selectedtask" style="display:none;">
<input type="text" id="selectedproject" style="display:none;">
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script src="http://<?=$site?>/styles/js/bootstrap-datepicker.min.js"></script>
<script>
function showhide(id){
	if ( $("#showhide" + id ).hasClass("showclass") ) {
		$( "#showhide" + id ).removeClass( "showclass" );
	}else{
		$( "#showhide" + id ).addClass( "showclass" );
	}
}
function showhideproject(id){
	if ( $("#showhideproject" + id ).hasClass("showclassproject") ) {
		$( "#showhideproject" + id ).removeClass( "showclassproject" );
	}else{
		$( "#showhideproject" + id ).addClass( "showclassproject" );
	}
}
$(document).ready(function(){
	$(document).click(function(){
		$( ".showclass" ).removeClass( "showclass" );
		$( ".showclassproject" ).removeClass( "showclassproject" );
	});
});
function checkform(){
	if(document.getElementById("chosenproject").value == ''){
		return false;
	}
	if(document.getElementById("chosenprior").value == ''){
		return false;
	}
	if(document.getElementById("task").value == ''){
		return false;
	}
	if(document.getElementById("date").value == ''){
		return false;
	}
}
function newproject(type){
	if(type == 'show'){
		document.getElementById("newproject").style = 'display:block;';
		document.getElementById("newprojectbutton").style = 'display:none;';
	}
	if(type == 'hide'){
		document.getElementById("newproject").style = 'display:none;';
		document.getElementById("newprojectbutton").style = 'display:block;color:red;cursor:pointer;';
	}
}
function newtask(type){
	if(type == 'show'){
		document.getElementById("newtask").style = 'display:block;';
		document.getElementById("newtaskbutton").style = 'display:none;';
	}
	if(type == 'hide'){
		document.getElementById("newtask").style = 'display:none;';
		document.getElementById("newtaskbutton").style = 'display:block;color:red;cursor:pointer;';
	}
}
function choseproject(id){
	document.getElementById("chosenproject").value = id;
}
function choseprior(id){
	document.getElementById("chosenprior").value = id;
}
function done(id){
	$.post('http://<?=$site?>/done',
	{
		id: id
	});
	document.getElementById("task" + id).style = "display:none;";
}
function deletet(id){
	$.post('http://<?=$site?>/delete',
	{
		id: id
	});
	document.getElementById("task" + id).style = "display:none;";
}
function deleteproject(id){
	$.post('http://<?=$site?>/deleteproject',
	{
		id: id
	});
	document.getElementById("project" + id).style = "display:none;";
}
function edit(id){
	document.getElementById("selectedtask").value = id;
	document.getElementById("edittaskinput").value = document.getElementById("taskname" + id).innerHTML;
	$("#edittaskmodal").modal("show");
}
function editproject(id){
	document.getElementById("selectedproject").value = id;
	document.getElementById("editprojectinput").value = document.getElementById("projectname" + id).innerHTML;
	$("#editprojectmodal").modal("show");
}
function saveproject(){
	var name = document.getElementById("editprojectinput").value;
	var id = document.getElementById("selectedproject").value;
	document.getElementById("projectname" + id).innerHTML = name;
	$.post('http://<?=$site?>/editproject',
	{
		id: id,
		name: name
	});
	$("#edittaskmodal").modal("hide");
}
$('#selectedproject').keyup(function(){
	if(event.keyCode==13){
savetask();
}});
function savetask(){
	var name = document.getElementById("edittaskinput").value;
	var id = document.getElementById("selectedtask").value;
	document.getElementById("taskname" + id).innerHTML = name;
	$.post('http://<?=$site?>/edittask',
	{
		id: id,
		name: name
	});
	$("#editprojectmodal").modal("hide");
}
$('#edittaskinput').keyup(function(){
	if(event.keyCode==13){
savetask();
}});
$('#datepicker').datepicker({
	format: "dd.mm.yyyy",
    weekStart: 1
});
</script>
  </body>
</html>