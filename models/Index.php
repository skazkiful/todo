<?php


class Index
{
	public static function projects($a = 0){
		$mysqli = Bd::GetConnection();
		$x = 0;
			if ($resulttt = $mysqli->query("
			SELECT projects.id, projects.name, color, COUNT(tasks.id) as count
			FROM projects
			LEFT OUTER JOIN tasks on tasks.project = projects.id
			WHERE projects.user = '".$_SESSION['id']."'
			GROUP BY projects.id")) {
				while( $project = $resulttt->fetch_assoc() ){
					$retproject[$x]['id'] = $project['id'];
					$retproject[$x]['name'] = $project['name'];
					$retproject[$x]['color'] = $project['color'];
					$retproject[$x]['count'] = $project['count'];
						if($a == $project['id']){
							$retproject[$x]['select'] = 'selectedproject';
						}else{
							$retproject[$x]['select'] = '';
						}
					$x++;
				}
			}
		return $retproject;
	}
	public static function projectinfo($a = 0){
		$mysqli = Bd::GetConnection();
		$x = 0;
		$query = $mysqli->query("SELECT * FROM projects WHERE id = '".$a."'");
		$retproject = mysqli_fetch_assoc($query);
		return $retproject;
	}
	public static function today(){
		$mysqli = Bd::GetConnection();
		$from = mktime(0,0,0,date('m'),date('d'),date('Y'));
		$to = $from+86400;
		$query = $mysqli->query("SELECT COUNT(tasks.id) as tasks FROM tasks
INNER JOIN projects ON projects.id = tasks.project
WHERE projects.user = '1' AND tasks.done = '0' AND tasks.date > ". $from ." AND tasks.date < ". $to);
		$retproject = mysqli_fetch_assoc($query);
		return $retproject['tasks'];
	}
	public static function done($a = 0){
		$mysqli = Bd::GetConnection();
		$id = $mysqli->real_escape_string($a);
		$mysqli->query("UPDATE tasks SET done = '1' WHERE id = '".$id."'");
	}
	public static function deletetask($a = 0){
		$mysqli = Bd::GetConnection();
		$id = $mysqli->real_escape_string($a);
		$mysqli->query("DELETE FROM tasks WHERE id = '".$id."'");
	}
	public static function deleteproject($a = 0){
		$mysqli = Bd::GetConnection();
		$id = $mysqli->real_escape_string($a);
		$mysqli->query("DELETE FROM projects WHERE id = '".$id."'");
		$mysqli->query("DELETE FROM tasks WHERE project = '".$id."'");
	}
	public static function projectslist(){
		$mysqli = Bd::GetConnection();
		$x = 0;
		if ($resulttt = $mysqli->query("
			SELECT projects.id as id, projects.name as name
			FROM projects
			WHERE user = '".$_SESSION['id']."'")) {
				while( $project = $resulttt->fetch_assoc() ){
					$retproject[$x]['id'] = $project['id'];
					$retproject[$x]['name'] = $project['name'];
					$x++;
				}
			}
		return $retproject;
	}
	public static function addproject($name, $color){
		$mysqli = Bd::GetConnection();
		$name = $mysqli->real_escape_string($name);
		$color = $mysqli->real_escape_string($color);
		$mysqli->query("INSERT INTO projects (name, color, user) VALUES ('".$name."', '".$color."', '".$_SESSION['id']."')");
		return $mysqli->insert_id;
	}
	public static function edittask($id, $name){
		$mysqli = Bd::GetConnection();
		$id = $mysqli->real_escape_string($id);
		$name = $mysqli->real_escape_string($name);
		$mysqli->query("UPDATE tasks SET name = '".$name."' WHERE id = '".$id."'");
		return $mysqli->insert_id;
	}
	public static function editproject($id, $name){
		$mysqli = Bd::GetConnection();
		$id = $mysqli->real_escape_string($id);
		$name = $mysqli->real_escape_string($name);
		$mysqli->query("UPDATE projects SET name = '".$name."' WHERE id = '".$id."'");
		return $mysqli->insert_id;
	}
	public static function addtask($task, $chosenproject, $chosenprior, $date){
		$mysqli = Bd::GetConnection();
		$task = $mysqli->real_escape_string($task);
		$chosenproject = $mysqli->real_escape_string($chosenproject);
		$chosenprior = $mysqli->real_escape_string($chosenprior);
		$date = $mysqli->real_escape_string($date);
		$mysqli->query("INSERT INTO tasks (name, project, priorite, date) VALUES ('".$task."', '".$chosenproject."', '".$chosenprior."', '".$date."')");
		return $chosenproject;
	}
	public static function hightpriorite($id = 0){
		$mysqli = Bd::GetConnection();
		$x = 0;
		$from = mktime(0,0,0,date('m'),date('d'),date('Y'));
		if($id == '7days'){
			$to = $from+604800;
			$query = "SELECT tasks.id as id, tasks.priorite as priorite, tasks.name as name, projects.name as projectname, projects.color as color FROM tasks
			INNER JOIN projects ON tasks.project = projects.id
			WHERE tasks.date > ". $from ." AND tasks.date < ". $to ." AND tasks.done = '0'
			GROUP BY tasks.id
			ORDER BY tasks.date ASC, tasks.priorite ASC";
		}elseif($id == 'today'){
			$to = $from+86400;
			$query = "SELECT tasks.id as id, tasks.priorite as priorite, tasks.name as name, projects.name as projectname, projects.color as color FROM tasks
			INNER JOIN projects ON tasks.project = projects.id
			WHERE tasks.date > ". $from ." AND tasks.date < ". $to ." AND tasks.done = '0'
			GROUP BY tasks.id
			ORDER BY tasks.date ASC, tasks.priorite ASC";
		}elseif($id == 'arch'){
			$to = $from+86400;
			$query = "SELECT tasks.id as id, tasks.priorite as priorite, tasks.name as name, projects.name as projectname, projects.color as color FROM tasks
			INNER JOIN projects ON tasks.project = projects.id
			WHERE projects.id = '".$id."' AND tasks.done = '1'
			GROUP BY tasks.id
			ORDER BY tasks.date ASC, tasks.priorite ASC";
		}else{
			$query = "SELECT tasks.id as id, tasks.priorite as priorite, tasks.name as name, projects.name as projectname, projects.color as color FROM tasks
			INNER JOIN projects ON tasks.project = projects.id
			WHERE projects.id = '".$id."' AND tasks.date < ". time() ." AND tasks.done = '0'
			GROUP BY tasks.id
			ORDER BY tasks.date ASC, tasks.priorite ASC";
		}
			if ($resulttt = $mysqli->query($query)) {
				while( $project = $resulttt->fetch_assoc() ){
					$retproject[$x]['id'] = $project['id'];
					$retproject[$x]['name'] = $project['name'];
					$retproject[$x]['projectname'] = $project['projectname'];
					$retproject[$x]['color'] = $project['color'];
					if($project['priorite'] == '1'){
						$retproject[$x]['taskcolor'] = 'ff0000';
					}elseif($project['priorite'] == '2'){
						$retproject[$x]['taskcolor'] = 'f90';
					}elseif($project['priorite'] == '3'){
						$retproject[$x]['taskcolor'] = 'fff';
					}else{
						$retproject[$x]['taskcolor'] = 'fff';
					}
					$x++;
				}
			}
		if(!empty($retproject)){
			return $retproject;
		}
	}
	public static function lowpriorite($id = 0){
		$mysqli = Bd::GetConnection();
		$x = 0;
		$from = mktime(0,0,0,date('m'),date('d'),date('Y'));
		if($id == 'arch'){
			$to = $from+86400;
			$query = "SELECT tasks.id as id, tasks.priorite as priorite, tasks.name as name, projects.name as projectname, projects.color as color FROM tasks
			INNER JOIN projects ON tasks.project = projects.id
			WHERE projects.id = '".$id."' AND tasks.done = '1'
			GROUP BY tasks.id
			ORDER BY tasks.date ASC, tasks.priorite ASC";
		}else{
			$query = "SELECT tasks.id as id, tasks.priorite as priorite, tasks.name as name, projects.name as projectname, projects.color as color FROM tasks
			INNER JOIN projects ON tasks.project = projects.id
			WHERE projects.id = '".$id."' AND tasks.date > ". time() ." AND tasks.done = '0'
			GROUP BY tasks.id
			ORDER BY tasks.date ASC, tasks.priorite ASC";
		}	
			if ($resulttt = $mysqli->query($query)) {
				while( $project = $resulttt->fetch_assoc() ){
					$retproject[$x]['id'] = $project['id'];
					$retproject[$x]['name'] = $project['name'];
					$retproject[$x]['projectname'] = $project['projectname'];
					$retproject[$x]['color'] = $project['color'];
					if($project['priorite'] == '1'){
						$retproject[$x]['taskcolor'] = 'ff0000';
					}elseif($project['priorite'] == '2'){
						$retproject[$x]['taskcolor'] = 'f90';
					}elseif($project['priorite'] == '3'){
						$retproject[$x]['taskcolor'] = 'fff';
					}else{
						$retproject[$x]['taskcolor'] = 'fff';
					}
					$x++;
				}
			}
		if(!empty($retproject)){
			return $retproject;
		}
	}
}