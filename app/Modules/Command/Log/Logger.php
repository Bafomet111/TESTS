<?php

declare(strict_types=1);

namespace App\Modules\Command\Log;

final class Logger
{
    private static string $file = './storage/logs/queue.log';
    public static function log(string $message): void
    {
        $message = '[' . date('Y-m-d H:m:i') . ']: ' . $message . PHP_EOL;

        file_put_contents(self::$file, $message, FILE_APPEND);
    }
}