		<?php
		/*
			ini_set('display_errors', '1');
			ini_set('display_startup_errors', '1');
			error_reporting(E_ALL);
		*/
		/* 
		   $output = shell_exec('less /proc/cpuinfo');
			$output = shell_exec('top');
			$filename = "/proc/loading";
			$handle = fopen($filename, "r");
			$output = fread($handle, 10); //filesize($filename));
			fclose($handle);
			* // echo "<pre>$output</pre>";
		*/
			
			// текущая директория
			// echo getcwd();
		/*
			echo "start";
			$fname = "/proc/stat";
			// echo (strstr($fname, "cpu", true));
			// echo (str_starts_with($fname, 'cpu'));
			
			function not_ampty_filter ($str){
				
				return (strstr($str, "cpu") !== true) &  $str !== "";
			}
			
			function map_to_int ($str){
				
				return (int)$str;
			}
			
			function split_to_needed($str)
			{
				$tmp = explode(" ", $str);
				
				
				$tmp = array_filter($tmp, 'not_ampty_filter');
				//echo $tmp + "\n";
				
				$tmp = array_map('map_to_int', $tmp);
				
				return $tmp;
				// return array_map($map_to_int, array_filter(explode(" ", $str), $not_ampty_filter));
			}
			
			$object = [];
			
			$handle = fopen($fname, "r");
			if ($handle)
			{
				// echo "find";
				$lineIndex = 0;
				while (($line = fgets($handle)) !== false)
				{
					$lineIndex+=1;
					if (strstr($line, "cpu") !== false)
					{
						$object[$lineIndex] = split_to_needed($line);
					}
					else
					{
						break;
					}
				}
				
				fclose($handle);
			} 
			else
			{
				echo "file not found";
				die();
			} 
			
			echo json_encode($object);
		*/

			function ProcStats()
			{
				$fp=fopen("/proc/stat","r");
				
				if(false === $fp)
				{
					return false;
				}
				
				$result = [];
				$str = fgets($fp);
				
				while(($str = fgets($fp)) !== false)
				{
					if(strstr($str, "cpu") !== false)
					{
						$a=explode(' ', $str);
						$name = $a[0];
						array_shift($a); //get rid of 'cpu'
						
						while(!$a[0])
						{
							array_shift($a); //get rid of ' '
						}
						
						$result[$name] = $a;
					}
					else
					{
						break;
					}
				}
				
				fclose($fp);
				
				return $result;
			}
			
			$first = ProcStats();
			sleep(1);
			$b = ProcStats();
			
			$res = [];
			
			foreach ($first as $key => $value) 
			{
				$second = $b[$key];
				
				$total=array_sum($second)-array_sum($value);
				$loadavg = round(100* (($second[0]+$second[1]+$second[2]) - ($value[0]+$value[1]+$value[2])) / $total, 2); // user+nice+system
				$iowait= round(100* ($second[4] - $value[4])/$total,2);
				
				$res[$key] = (object)[
					"loadavg" => $loadavg,
					"iowait" => $iowait,
				];
				
			}
			
			echo json_encode($res);
		?>
