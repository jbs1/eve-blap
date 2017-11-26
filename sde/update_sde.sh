#!/bin/bash

wget https://www.fuzzwork.co.uk/dump/sqlite-latest.sqlite.bz2
wget https://www.fuzzwork.co.uk/dump/sqlite-latest.sqlite.bz2.md5

if md5sum --status -c sqlite-latest.sqlite.bz2.md5; then
	echo MD5 sum validation SUCCESSFUL:
	rm sqlite-latest.sqlite
	bunzip2 -v sqlite-latest.sqlite.bz2
	rm sqlite-latest.sqlite.bz2.md5
	date > last_update
	echo "UPDATE SUCCESSFUL" >> last_update
else
	echo MD5 sum validation ERROR:
	md5sum sqlite-latest.sqlite.bz2
	cat sqlite-latest.sqlite.bz2.md5
	date > last_update
	echo "UPDATE FAILED" >> last_update
fi