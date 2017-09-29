<?php
if(isset($_POST['submit'])){
	if(empty($_POST['name'])){
		?>
		<script type="text/javascript">
			window.alert("Fill your name");
		</script>
		<?php
	}elseif (empty($_POST['phone'])) {
		?>
		<script type="text/javascript">
			window.alert("Fill your phone number");
		</script>
		<?php
	}elseif (empty($_POST['email'])) {
		?>
		<script type="text/javascript">
			window.alert("Fill your email address");
		</script>
		<?php
	}else{
		$name = $_POST['name'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$event = $_POST['event'];
		$guest = $_POST['guest'];
		$location = $_POST['location'];
	}

	$email_exp = '/^[A-Za-z0-9._%]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
	if(!preg_match($email_exp, $email)){
		?>
		<script type="text/javascript">
			window.alert("The email address you entered does not seem to be valid");
		</script>
		<?php
	}
	$string_exp = "/^[A-Za-z .'-]+$/";
	if(!preg_match($string_exp, $name)){
		?>
		<script type="text/javascript">
			window.alert("The name you entered does not seem to be valid");
		</script>
		<?php
	}
	/*
	if(strlen($comment) < 1){
		?>
		<script type="text/javascript">
			window.alert("The feedback comment you entered is too short.");
		</script>
		<?php
	}
	*/

	$email_to = "brianokinyi.bo@gmail.com";

	$subject = "My feedback on your services";

	$email_message = "<h2>You received a feedback with the following information</h2>";

	function clean_string($string){
		$bad = array("content-type", "bcc:", "to:", "cc:", "href:");
		return str_replace($bad, "", $string);
	}

	$email_message .= "<table>
							<tr>
								<th>Name</th>
								<td>".clean_string($name)."</td>
							</tr>
							<tr>
								<th>Phone</th>
								<td>".clean_string($phone)."</td>
							</tr>
							<tr>
								<th>Email</th>
								<td>".clean_string($email)."</td>
							</tr>
							<tr>
								<th>Event</th>
								<td>".clean_string($event)."</td>
							</tr>
							<tr>
								<th>Guest</th>
								<td>".clean_string($guest)."</td>
							</tr>
							<tr>
								<th>Location</th>
								<td>".clean_string($location)."</td>
							</tr>
						</table>
				";
	$headers = "MIME-Version: 1.0" . "\r\n".
				"Content-type:text/html;charset=UTF-8"."\r\n".
				"From: ".$email."\r\n".
				"Reply-To: ".$email."\r\n".
				"X-Mailer: PHP/".phpversion()
			;
	$retval = mail($email_to, $subject, $email_message, $headers);

	if($retval == TRUE){
				?>
		<script type="text/javascript">
			window.alert("Thank you for submitting your feedback");
		</script>
		<?php
	}else{
		?>
		<script type="text/javascript">
			window.alert("Ooops! We encountered an error while fetching your statements. <br>Kindly contact the administrator.");
		</script>
		<?php
	}
}
?>