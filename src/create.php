<?php

use Aws\DynamoDb\Exception\DynamoDbException;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/include.php';

$options = parse_cli_options();
$dynamodb = connect_to_dynamo_db($options);

$params = [
    'TableName' => 'dev__fw__team_races_team_race',
    'KeySchema' => [
        [
            'AttributeName' => 'race_id',
            'KeyType' => 'HASH'  //Partition key
        ],
        [
            'AttributeName' => 'config_id',
            'KeyType' => 'RANGE'  //Sort key
        ]
    ],
    'AttributeDefinitions' => [
        [
            'AttributeName' => 'race_id',
            'AttributeType' => 'S'
        ],
        [
            'AttributeName' => 'config_id',
            'AttributeType' => 'N'
        ],

    ],
    'ProvisionedThroughput' => [
        'ReadCapacityUnits' => 10,
        'WriteCapacityUnits' => 10
    ]
];

try {
    $result = $dynamodb->createTable($params);
    echo 'Created table.  Status: ' . $result['TableDescription']['TableStatus'] . "\n";
} catch (DynamoDbException $e) {
    echo "Unable to create table:\n";
    echo $e->getMessage() . "\n";
}