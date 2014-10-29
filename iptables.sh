#!/bin/bash
#
# Whitelist Pingdom probe-servers in iptables.
#
# Create a chain called "PINGDOM" and jump to it somewhere before
# the final REJECT/DROP, e.g.
#
#     # New chain for Pingdom rules
#     :PINGDOM - [0:0]
#
#     # Existing rules
#     # ...
#
#     # Jump to Pingdom chain before rejecting
#     -A INPUT -j PINGDOM
#     -A INPUT -j REJECT
#
# Run this script from cron. It will only modify the firewall when
# the Pingdom feed request succeeds and its response contains at
# least one IP address.
 
 
# Configuration
IPTABLES=/sbin/iptables
CHAIN=PINGDOM
PORT=80
FEED_URL=https://my.pingdom.com/probes/feed
 
 
# Dry-run?
[ "$1" = "-n" ] && IPTABLES="echo $IPTABLES"
 
IPS=$(curl -s $FEED_URL |grep '<pingdom:ip>' |sed 's/[^0-9\.]//g')
if [ "$IPS" != "" ]; then
  $IPTABLES -F $CHAIN
  echo $IPS |xargs -n1 $IPTABLES -A $CHAIN -p tcp --dport $PORT -j ACCEPT -s
fi
