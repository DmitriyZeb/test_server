const util = require('util'); // библиотека асинхронного вызова функций
const exec = util.promisify(require('child_process').exec); // асинхронный метод запуска процесса
const command = "netstat -ntu | awk '{print $5}'| cut -d: -f1 | sort | uniq -c | sort -nr | more"; // строковый запрос комманды
const badIpFilePath = "/var/www/test_server/badIP.txt"; // полный путь к файлу результата

async function FindBadIPAsync() // асинхронный метод поиска непослушного айпи
	{ 
		const { stdout, stderr } = await exec(command); // запускаем и ожидаем выполнение комманды netstat
		if (stderr) // Если произошла ошибка, она записана в stderr
			{ 
				console.log("stderr: ${stderr}"); // запись в лог
				return; // завершение работы метода
			} 
			console.log(stdout);
			console.log(stderr);
			
		var ipArr = stdout.split("\n").map(stringline => {
			
			console.log(stringline.trim().split(" "));
			return [ 
				parseInt(stringline.trim().split(" ")[0], 10), 
				stringline.trim().split(" ")[1]
			]
		});
		console.log(ipArr);
		
		var maxQuery = ipArr.sort((a, b) => b[0] - a[0])[0]; // сортировка по убыванию (сверху с самым большим количеством запросов)
		if (!Array.isArray(maxQuery)) // если результат не является массивом (возможное значение: NaN)
			{ 
				console.log("bad request"); // запись в лог
				return; // завершение метода
			} 
			console.log(maxQuery);
		var countQueries = maxQuery[0]; // запись в переменную количества запросов
		var badIP = maxQuery[1]; // запись в переменную ацпишника
		if (countQueries  > 250) // если ацпи плохой
		{
			const commandBlok = "sudo iptables -t filter -A INPUT -s " + badIP + "/24 -j DROP";
			const { stdout, stderr } = await exec(commandBlok);
			if (stderr)
				{
					console.log("stderr: ${stderr}");
					return;
				}
			} 
	}	 

FindBadIPAsync(); // вызов метода












