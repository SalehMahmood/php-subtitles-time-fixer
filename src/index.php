<?php

/**
 * @author Saleh Mahmood
 * @package SubtitlesTimeFixer
 */
?><!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
	<title>PHP freaking subtitles fixers</title>

	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:400,700,900">

	<style>
		body {
			background-color: #f5f5f5;
		}
		* {
			font-family: 'Roboto', sans-serf;	
		}

		h1 {
			font-weight: 700;
		}

		.container {
			width: 960px;
			margin: 0 auto;
		}

		.form-table {
			border: 1px solid #ccc;
			padding: 10px;
			margin: 20% auto 0;
		}
		tr, td {
			padding: 5px;
		}
		td { padding: 10px 20px; }

		.btnSubmit {
			font-size: 16px;
			padding: 5px 10px;
			background-color: #8892BF;
			border: 1px solid #4F5B93;
			color: #fff;
		}

		.btnSubmit:focus {
			background-color: #4F5B93;
			border: 1px solid #8892BF;
		}
	</style>
</head>
<body>

	<div class="container">

		<header>
			<h1>Freaking subtitles fixers</h1>
		</header>

		<form class="box" method="post" action="action.php" enctype="multipart/form-data">
			<table class="form-table">
				<tr>
					<td>Just give me that freaking subtitles!</td>
					<td><input type="file" name="subtitleFile" id="file" class="fileUploader" id="fileUploader" required /></td>
				</tr>
				<tr>
					<td>How exactly the differnce is (in seconds)?</td>
					<td><input type="number" name="difference" value="1" style="width: 42px;" class="inputNumber" /></td>
				</tr>
				<tr>
					<td>Lemme just take care of it!</td>
					<td><input class="btnSubmit" type="submit" value="Let's do it!" name="submit"></td>
				</tr>
				
				<input type="hidden" name="inputExists">
			</table>
		</form>

	</div>

</body>
</html>