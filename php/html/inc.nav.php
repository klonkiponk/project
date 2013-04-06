<nav id="globalNav">
	<div class="projectPersonNav">
		<a class="icon-group" href="projects.php">Projekte</a>
		<a class="icon-user" href="persons.php">Personen</a>		
	</div>
	
	
	<?php
	if($_SESSION['role']==99){
	
		echo '<div class="newProjectNav">
				<a class="icon-edit" href="editProjects.php">Projekte</a>
				<a class="icon-edit" href="editPersons.php">Personen</a>
				<a class="icon-edit" href="editTaskroles.php">Aufgaben</a>		
			  </div>';
	}
	?>
	
	<hr>
</nav>