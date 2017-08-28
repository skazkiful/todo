<div class="col-md-3">
	<a class="projectlinks<?if($a == 'today'){echo ' selectedproject';}?>" href="http://<?=$site?>/today">Today <span class="badge badge-secondary"><?=$today?></span></a><br>
	<a class="projectlinks<?if($a == '7days'){echo ' selectedproject';}?>" href="http://<?=$site?>/7days">Next 7 days</a><br>
	<p style="text-decoration:underline;    margin-top: 1rem;margin-bottom:0px;">Projects</p>
	<?php foreach ($retproject as $project):?>
		<div class="onhoverproject" id="project<?=$project['id']?>"><a class="projectlinks <?=$project['select']?>" href="http://<?=$site?>/project/<?=$project['id']?>">
			<div class="projectleftcolor" style="background: #<?=$project['color']?>;"></div>
			<div class="projectname <?=$project['select']?>" id="projectname<?=$project['id']?>"><?=$project['name']?></div> <span class="badge badge-secondary"><?=$project['count']?></span></a>
			<div class="showproject" id="showhideproject<?=$project['id']?>">
			<div class="dropdown">
			<div>
			 <a href="#" role="button" onclick="showhideproject(<?=$project['id']?>);" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  <img style="width:15px;height:15px;" src="http://<?=$site?>/styles/img/menu.png">
			  </a>
			  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<a class="dropdown-item" href="#" onclick="editproject(<?=$project['id']?>)">Edit</a>
				<a class="dropdown-item" href="#" onclick="deleteproject(<?=$project['id']?>)">Delete</a>
			  </div>
			</div>
			</div>
			</div>
		</div>
	<?php endforeach;?>
	<a onclick="newproject('show');" id="newprojectbutton" style="cursor:pointer;color:red;">+ Add project</a>
	<form action="http://<?=$site?>/addproject" method="post">
    <div style="display:none;" id="newproject">
      <div class="input-group">
        <input name="color" required type="color" style="height:38px;width: 50px !important;" class="form-control">
        <input name="name" required placeholder="Project name" type="text" class="form-control" style="width: 100% !important;">
      </div>
      <div style="margin-top:10px;"><button type="submit" class="btn btn-primary">Add</button> <a style="color:#686868;cursor:pointer;" onclick="newproject('hide');">Cancel</a></div>
    </div>
	</form>
</div>