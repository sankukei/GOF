#!/bin/bash

init() {

	percent=$1
	bar_count=0
}

update() {

	bar_count=$(($bar_count + 100))

	if [ $(($bar_count % $percent)) -lt 100 ];then
		bar="$bar#"
	fi

	printf "$bar $(($bar_count / $percent))%%\n"
}

init 500

count=0

while [ $count -lt 500 ]; do
	sleep .5
	count=$((count + 1))
	update
done

