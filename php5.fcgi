#!/bin/bash
PHPRC=$PWD/../etc/php5
export PHPRC
umask 022
export PHP_FCGI_CHILDREN
SCRIPT_FILENAME=$PATH_TRANSLATED
export SCRIPT_FILENAME
exec /usr/bin/php5-cgi
