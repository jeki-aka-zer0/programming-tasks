<?php

$num = isset($argv[1]) ? (int)$argv[1] : rand(2, 100);
$names = isset($argv[2]) ? explode(',', $argv[2]) : ['Linus Torvalds', 'Steve Wozniak', 'Bill Gates', 'Steve Jobs', 'Barbara Liskov', 'Donald Knuth', 'Tim Berners-Lee'];

function hotPotato(array $names, int $num): string
{
    $queue = new SplQueue;
    foreach ($names as $name) {
        $queue->enqueue($name);
    }

    while ($queue->count() > 1) {
        for ($i = 0; $i < $num; $i++) {
            $queue->enqueue($queue->dequeue());
        }

        $queue->dequeue();
    }

    return $queue->dequeue();
}

echo hotPotato($names, $num), PHP_EOL;
