123456
<html>
	<head>
		<meta charset="utf-8">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	</head>
	<body>

		<?php
			require_once('graph.html');
		?>
		
		<div id="firtstPing">
			<p>Ping Google.com </p>
			<button type="button" onclick="firtstPing()">Ping</button>
		</div>
			
		<div id="secondPing">
			<button type="button" onclick="secondPing()">Ping Flood</button>
		</div>
		
		<table border="1">
			<!--Это будет первый ряд таблицы:-->
			<tr>
				<td>
				<p>Количество процессов apache </p>
				</td>
				<td><p>Количество коннектов 80 порт </p>
				</td>
				<td><p>Количество коннектов 443 порт </p>
				</td>
				<td><p>Количество SYN запросов </p>
				</td>
				<td><p>Количество запросов с каждого IP  </p>
				</td>
			</tr>

			<!--Это будет второй ряд таблицы:-->
			<tr>
			<td>
				<div id="CountProcessesApache"></div>
				</td>
			<td>
				<div id="CountConnectEightyPort"></div>
				</td>
			<td>
				<div id="CountConnect443Port"></div>
			</td>
			<td>
				<div id="CountSYNRequest"></div>
			</td>
			<td>
				<div id="CountIpConnect"></div>
			</td>
		</tr>
		</table>
			
		<script>
			
			function firtstPing () {
				$.ajax({
					url: "function.php?f=firtstPing", //the page containing php script
					type: "POST", //request type
					success:
						function(result){
							document.getElementById("firtstPing").innerHTML = result;
						}
				});
			}
				
			function secondPing() {
				$.ajax({
					url: "function.php?f=floodPing", //the page containing php script
					type: "POST", //request type
					success:
						function(result){
							document.getElementById("secondPing").innerHTML = result;
						}
				});
			}
			
			
			function CountProcessesApache() {
					$.ajax({
						url: "function.php?f=CountProcessesApache", //the page containing php script
						type: "POST", //request type
						success:
							function(result){
								document.getElementById("CountProcessesApache").innerHTML = result;
							}
					});
				}
			
			function GetCountProcessesApache(){
				CountProcessesApache();
				setTimeout(GetCountProcessesApache, 1000);
			}
			
			GetCountProcessesApache();
			
			function CountConnectEightyPort() {
					$.ajax({
						url: "function.php?f=CountConnectEightyPort", //the page containing php script
						type: "POST", //request type
						success:
							function(result){
								document.getElementById("CountConnectEightyPort").innerHTML = result;
							}
					});
				}
			
			function GetCountConnectEightyPort(){
				CountConnectEightyPort();
				setTimeout(GetCountConnectEightyPort, 1000);
			}
			
			GetCountConnectEightyPort();
			
			function CountConnect443Port() {
					$.ajax({
						url: "function.php?f=CountConnect443Port", //the page containing php script
						type: "POST", //request type
						success:
							function(result){
								document.getElementById("CountConnect443Port").innerHTML = result;
							}
					});
				}
			
			function GetCountConnect443Port(){
				CountConnect443Port();
				setTimeout(GetCountConnect443Port, 1000);
			}
			
			GetCountConnect443Port();
			
			function CountSYNRequest() {
					$.ajax({
						url: "function.php?f=CountSYNRequest", //the page containing php script
						type: "POST", //request type
						success:
							function(result){
								document.getElementById("CountSYNRequest").innerHTML = result;
							}
					});
				}
			
			function GetCountSYNRequest(){
				CountSYNRequest();
				setTimeout(GetCountSYNRequest, 1000);
			}
			
			GetCountSYNRequest();
			
			function CountIpConnect() {
					$.ajax({
						url: "function.php?f=CountIpConnect", //the page containing php script
						type: "POST", //request type
						success:
							function(result){
								document.getElementById("CountIpConnect").innerHTML = result;
							}
					});
				}
			
			function GetCountIpConnect(){
				CountIpConnect();
				setTimeout(GetCountIpConnect, 1000);
			}
			
			GetCountIpConnect();
			
		</script>
		
	</body>
</html>
