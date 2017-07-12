# DynamoDB tester

Small script to test DynamoDB client against different backends.

## Usage

First install dependencies:
 
```
$ composer install
```

Then run each provided script against your favorite endpoint and compare results:

```
$ php src/create.php -h127.0.0.1 -p4567 # dynalite local
$ php src/insert.php -h127.0.0.1 -p4567 
$ php src/insert_empty.php -h127.0.0.1 -p4567 
 
$ php src/create.php -h192.168.99.100 -p4567 # dynamo local docker
$ php src/insert.php -h127.0.0.1 -p4567
$ php src/insert_empty.php -h127.0.0.1 -p4567
 
$ php src/create.php -kmyawskey -smyawssecret # dynamo real
$ php src/insert.php -kmyawskey -smyawssecret 
$ php src/insert_empty.php -kmyawskey -smyawssecret 
```
