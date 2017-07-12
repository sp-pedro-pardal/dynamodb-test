<?php

date_default_timezone_set('UTC');

function parse_cli_options()
{
    $options = getopt('h::p::');

    $host = isset($options['h']) ? $options['h'] : '192.168.99.100';
    $port = isset($options['p']) ? $options['p'] : 4567;

    return [
        'host' => $host,
        'port' => $port
    ];
}

function connect_to_dynamo_db($host, $port)
{
    $sdk = new Aws\Sdk([
        'endpoint' => "http://$host:$port",
        'region' => 'us-west-2',
        'version' => 'latest'
    ]);

    $dynamodb = $sdk->createDynamoDb();
    return $dynamodb;
}
