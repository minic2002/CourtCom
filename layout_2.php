<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="chrome=1.0, ie-edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>CourtCom <?php echo $title; ?> </title>
		<link rel="icon" type="image/x-icon" href="static/images/favicon.ico">
		<link rel="stylesheet" type="text/css" href="static/bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $css?>">
	</head>
	<body>
		
		<div>
			<?php echo $content; ?>
		</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="static/js/courtcom.js"></script>
	</body>
	<!--<footer>
		&copy; <?php //echo date('Y'); ?> - CourtCom
	</footer>-->
</html>
