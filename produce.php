<?php

require_once('vendor/autoload.php');

$conf = new RdKafka\Conf();
$conf->set('log_level', (string)LOG_DEBUG);
$conf->set('debug', 'all');
$rk = new RdKafka\Producer($conf);
$rk->addBrokers("10.10.9.110:9092");

$topic = $rk->newTopic("TutorialTopic");

$s = rand(1, 1000000);
$si = rand(50, 100);

for ($i = 0; $i <= $si; $i++) {
    $topic->produce(RD_KAFKA_PARTITION_UA, 0, "Message payload: " . $s . ' - ' . $i);
}

$rk->flush(10000);