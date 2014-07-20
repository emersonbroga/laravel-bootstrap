<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Admin new User</h2>

		<div>
			Create your admin account, complete this form: {{ URL::to('password/reset', array($token)) }}.
		</div>
	</body>
</html>