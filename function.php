<?php 

	function str_starts_with($haystack, $needle, $case=true) {
		if ($case){
			return strpos($haystack, $needle, 0) === 0;
		}
		return stripos($haystack, $needle, 0) === 0;
	}





	If ($_REQUEST["f"] === "firtstPing")
	{
		$ping = shell_exec('ping -c 5 8.8.8.8');
		echo "<pre>".$ping."</pre>";
		die;
	}
		
	If ($_REQUEST["f"] === "floodPing")
	{
		$fileName = '/var/www/test_server/bash.sh';
		$resultFile = '/var/www/test_server/ping.txt';
		// echo unlink($resultFile).'<br>';
		// exec('sudo -p zebrov ping -f 8.8.8.8 -c 100 >>'.$fileName);
		exec('sudo -p zebrov '.$fileName);
		// usleep(5000000);
		$h = file_get_contents($resultFile);
		// echo unlink($resultFile).'<br>';
		echo "<pre>".$h."</pre>";
		
		//$handle = popen('sudo -p zebrov ping -f 8.8.8.8 -c 100', 'r');
		
		//$read = fread($handle, 2096);
		//sleep(1);
		//echo $read;
		//pclose($handle);
		// echo "<pre>".shell_exec('sudo -p zebrov ping -f 8.8.8.8 -c 100')."<pre>";
		
		// echo "<pre>".get_current_user()."</pre>";
		die;
	}
	
	If ($_REQUEST["f"] === "speedtest")
	{
		$fileName = '/var/www/test_server/bashSpeed.sh';
		$resultFile = '/var/www/test_server/speed.txt';
		
		exec($fileName);
		
		$h = [];
		if ($file = fopen($resultFile, "r")) {
			
			while(!feof($file)) {
				$line = fgets($file);
				if (str_starts_with($line,  'Download') || str_starts_with($line,  'Upload'))
				{
					$words = explode(" ", $line);
					$h[str_replace(':', '', $words[0])] = (float) $words[1];
				}
			}
			
			fclose($file);
		}
		echo json_encode($h);
		die;
	}
	
	If ($_REQUEST["f"] === "floodPing")
	{
		$fileName = '/var/www/test_server/bash.sh';
		$resultFile = '/var/www/test_server/ping.txt';
		// echo unlink($resultFile).'<br>';
		// exec('sudo -p zebrov ping -f 8.8.8.8 -c 100 >>'.$fileName);
		exec('sudo -p zebrov '.$fileName);
		// usleep(5000000);
		$h = file_get_contents($resultFile);
		// echo unlink($resultFile).'<br>';
		echo "<pre>".$h."</pre>";
		
		//$handle = popen('sudo -p zebrov ping -f 8.8.8.8 -c 100', 'r');
		
		//$read = fread($handle, 2096);
		//sleep(1);
		//echo $read;
		//pclose($handle);
		// echo "<pre>".shell_exec('sudo -p zebrov ping -f 8.8.8.8 -c 100')."<pre>";
		
		// echo "<pre>".get_current_user()."</pre>";
		die;
	}
	
	If ($_REQUEST["f"] === "CountProcessesApache")
	{
		$countApacheProc = shell_exec('ps aux | grep apache | wc -l');
		echo "<pre>".$countApacheProc."</pre>";
		die;
	}
		
		
	If ($_REQUEST["f"] === "CountConnectEightyPort")
	{
		$count80Port = shell_exec('netstat -na | grep :80 | wc -l');
		echo "<pre>".$count80Port ."</pre>";
		die;
	}
	
	If ($_REQUEST["f"] === "CountConnect443Port")
	{
		$count443Port = shell_exec('netstat -na | grep :443 | wc -l');
		echo "<pre>".$count443Port ."</pre>";
		die;
	}
	
	If ($_REQUEST["f"] === "CountSYNRequest")
	{
		$countSYN = shell_exec('netstat -n -t | grep SYN_RECV | wc -l');
		echo "<pre>".$countSYN ."</pre>";
		die;
	}
	
	If ($_REQUEST["f"] === "CountIpConnect")
	{
		$countIP = shell_exec("netstat -ntu | awk '{print $5}'| cut -d: -f1 | sort | uniq -c | sort -nr | more");
		echo "<pre>".$countIP ."</pre>";
		die;
	}
		//$filename = 'pingfile.txt';
		//file_put_contents($filename, $pingf);
?>
