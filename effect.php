<html>
	<head>
		<title></title>
		<style>
			div#red{
				width: 50px;
				height: 50px;
				background-color: red;
			}
		</style>
	</head>
	<body>
	
		<div id="red" onmouseover="over(this)">
		
		</div>
	
		<script>
			function over(id){
				id.style.transition = "1s all";
				id.style.width = "100";
				id.style.height = "100";
			}
		</script>
	</body>
</html>