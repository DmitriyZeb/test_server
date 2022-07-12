#!/bin/bash

FILE=/var/www/test_server/blok_ip.txt

if [ -f "$FILE" ]; then
	rm $FILE;
fi

sudo iptables -t filter -A INPUT -s 192.168.4.228/24 -j DROP >>$FILE
