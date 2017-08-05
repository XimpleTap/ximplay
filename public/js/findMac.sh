#!/bin/bash

macAddress=($(arp -a -n|grep $1|awk '{print $4}'))
echo $macAddress
