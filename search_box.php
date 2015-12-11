<html lang="en-US">
<head>

	<meta charset="utf-8">

	<title>Search</title>

	<link href="http://fonts.googleapis.com/css?family=Kadwa" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="mystyle.css">

	
</head>


<body>
<p class="one">Search Actor for Movie on IMDb</p>

	<div class="container">
		
		<div id="search">

			<form action="test.php" method="GET">

				<fieldset class="clearfix">

					<input type="search" name="search" value="Type actor name" onBlur="if(this.value=='')this.value='Type actor name'" onFocus="if(this.value=='Type actor name')this.value='' "> <!-- JS because of IE support; better: placeholder="What are you looking for?" -->
					<input type="submit" value="Search" class="button">

				</fieldset>

			</form>

		</div> <!-- end search -->

	</div> <!-- end container -->

</body>	
</html>