<?php

use Aws\DynamoDb\Exception\DynamoDbException;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/include.php';

$options = parse_cli_options();
$dynamodb = connect_to_dynamo_db($options);

$tableName = 'dev__fw__team_races_team_race';

$raceId = "1234567890abcdef";
$configId = 123;

$item = [
    'race_id' => ['S' => $raceId],
    'config_id' => ['N' => "$configId"],
    'info' => ['S' => ''],
];

$params = [
    'TableName' => $tableName,
    'Item' => $item
];

try {
    $result = $dynamodb->putItem($params);
    echo "Added item: $raceId - $configId\n";

} catch (DynamoDbException $e) {
    echo "Unable to add item:\n";
    echo $e->getMessage() . "\n";
}