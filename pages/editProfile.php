<?php
	include("../includes/header.php");

  if(!isset($_SESSION['user_id'])) {
    header("Location: ../homepage.html");
  }

	$id = $_SESSION['user_id'];
	$currentInfo = getUserProfile($id);
  $first_name = $currentInfo->first_name;
	$last_name = $currentInfo->last_name;
	$email = $currentInfo->email;
	$semester = $currentInfo->graduation_semester;
	$year = $currentInfo->graduation_year;
	$major = $currentInfo->major;
	$minor = $currentInfo->minor;

	if (isset($_POST["profile"])) {
		$selectedCourses= array();
		if (isset($_POST["course1-id"]) && isset($_POST["course1Priority"])) {
			$course1 = array($_POST["course1-id"],$_POST["course1Priority"]);
			array_push($selectedCourses, $course1);
		}
		if (isset($_POST["course2-id"]) && isset($_POST["course2Priority"])) {
			$course2 = array($_POST["course2-id"],$_POST["course2Priority"]);
			array_push($selectedCourses, $course2);
		}
		if (isset($_POST["course3-id"]) && isset($_POST["course3Priority"])) {
			$course3 = array($_POST["course3-id"],$_POST["course3Priority"]);
			array_push($selectedCourses, $course3);
		}
		if (isset($_POST["course4-id"]) && isset($_POST["course4Priority"])) {
			$course4 = array($_POST["course4-id"],$_POST["course4Priority"]);
			array_push($selectedCourses, $course4);
		}
		updateProfile($id,$_POST["fname"],$_POST["lname"],$_POST["major"],$_POST["minor"],$_POST["semester"],$_POST["year"] );
		updateCourses($id, $selectedCourses);
		echo "<script type='text/javascript'>alert('Saved Changes');</script>";
	}
?>

		<div class="center">
			<form id="profle" method="POST">
				<h1>Student Information</h1>
				<div>
					<p>
						<label for="fname">First Name:</label>
						<input type="text" name="fname" id="fname" value=<?php echo $first_name;?> />

						<label for="lname">Last Name:</label>
						<input type="text" name="lname" id="lname" value=<?php echo $last_name;?> />

						<label for="email">Email:</label>
						<input readonly type="text" name="email" id="email" value=<?php echo $email;?> />

						<label for="major">Major:</label>
						<select id="major" name="major">
						  <option value="Computer Science">Computer Science</option>
							<option value="Information Technology and Web Science">Information Technology and Web Science</option>
							<option value="Mechanical Engineering">Mechanical Engineering</option>
						</select>
						<label for="minor">Minor:</label>
						<select id="minor" name="minor">
							<option value="None">None</option>
							<option value="Computer Science">Computer Science</option>
							<option value="Information Technology and Web Science">Information Technology and Web Science</option>
							<option value="Mechanical Engineering">Mechanical Engineering</option>
						</select>
					</p>
					<p>
						<label for="semester">Graduation</label>
						<select id="semester" name="semester">
						  <option value="Fall">Fall</option>
							<option value="Spring">Spring</option>
						</select>
						<select id="year" name="year">
							<option value=2019>2019</option>
							<option value=2020>2020</option>
							<option value=2021>2021</option>
							<option value=2022>2022</option>
							<option value=2023>2023</option>
						</select>
					</p>
				</div>
				<h1>Course Information</h1>
				<span>
					Add courses and assign them a priority.
				</span>
				<div id="coursePriorities">
				</div>
					<input  class="small-button" type="submit" name="profile" value="Save" />
			</form>
		</div>
	</body>

	<script type="text/javascript">
		var allCourses = <?php echo json_encode(getCourses()) ?>;
		var currentCourses = 	<?php echo json_encode(getUserCourses($id)) ?>;
		var semester = "<?= $semester ?>";
		var year = parseInt("<?= $year ?>");
		var major = "<?= $major ?>";
		var minor = "<?= $minor ?>";
	</script>
	<script type="text/javascript" src="../scripts/editProfile.js"></script>
</html>
