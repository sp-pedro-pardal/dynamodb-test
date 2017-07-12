<?php

date_default_timezone_set('UTC');

function parse_cli_options()
{
    $options = getopt('h::p::k::s::');

    $host = isset($options['h']) ? $options['h'] : '';
    $port = isset($options['p']) ? $options['p'] : '';
    $key = isset($options['k']) ? $options['k'] : '';
    $secret = isset($options['s']) ? $options['s'] : '';

    return [
        'host' => $host,
        'port' => $port,
        'credentials' => [
            'key' => $key,
            'secret' => $secret
        ]
    ];
}

function connect_to_dynamo_db($userOptions)
{
    $sdkOptions = [
        'region' => 'us-east-1',
        'version' => 'latest'
    ];

    if (!empty($userOptions['host']) || !empty($userOptions['port'])) {
        $host = isset($userOptions['host']) ? $userOptions['host'] : '127.0.0.1';
        $port = isset($userOptions['port']) ? $userOptions['port'] : 8000;
        $sdkOptions['endpoint'] = "http://$host:$port";
    }

    if (isset($userOptions['credentials'])) {
        $sdkOptions['credentials'] = $userOptions['credentials'];
    }

    $sdk = new Aws\Sdk($sdkOptions);

    $dynamodb = $sdk->createDynamoDb();
    return $dynamodb;
}
