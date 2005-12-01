#!/bin/sh
PATH=/bin:/sbin:/usr/bin:/usr/sbin
echo |awk '{printf "||",$1}'
while sleep 1
do
echo "#" |awk '{printf "%s",$1}'
done
