<?php

use Aws\DynamoDb\Exception\DynamoDbException;
use Aws\DynamoDb\Marshaler;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/include.php';

$options = parse_cli_options();
$dynamodb = connect_to_dynamo_db($options['host'], $options['port']);

$marshaler = new Marshaler();

$tableName = 'Movies';

$year = 2015;
$title = 'The Big New Movie';

$item = $marshaler->marshalJson('
    {
        "year": ' . $year . ',
        "title": "' . $title . '",
        "info": {
            "plot": "Nothing happens at all.",
            "rating": 0
        }
    }
');

$item = [
    'year' => ['N' => (string)123456789],
    'title' => ['S' => $title],
    'info' => ['M' => ['plot' => ['N' => 321]]]
];

$params = [
    'TableName' => 'Movies',
    'Item' => $item
];


try {
    $result = $dynamodb->putItem($params);
    echo "Added item: $year - $title\n";

} catch (DynamoDbException $e) {
    echo "Unable to add item:\n";
    echo $e->getMessage() . "\n";
}