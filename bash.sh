#!/bin/bash

FILE=/var/www/test_server/ping.txt

if [ -f "$FILE" ]; then
	rm $FILE;
fi

sudo -p zebrov ping -f 8.8.8.8 -c 100 >>$FILE
