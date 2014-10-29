<?
preg_match_all(
    '/((\d+\.){3}\d+).*?Active/',
    file_get_contents('https://www.pingdom.com/rss/probe_servers.xml'),
    $ips
);
 
echo implode("\n", $ips[1]);

