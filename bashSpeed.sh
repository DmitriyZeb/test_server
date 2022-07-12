#!/bin/bash

FILE=/var/www/test_server/speed.txt

if [ -f "$FILE" ]; then
	rm $FILE;
fi

speedtest-cli >>$FILE
