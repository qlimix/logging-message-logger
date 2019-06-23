<?php declare(strict_types=1);

namespace Qlimix\Logging\Logger\Message;

use Qlimix\Serializable\SerializableInterface;
use Throwable;

interface MessageLoggerInterface
{
    public function start(SerializableInterface $message): void;

    public function success(SerializableInterface $message): void;

    public function failed(SerializableInterface $message, Throwable $exception): void;

    public function critical(SerializableInterface $message, Throwable $exception): void;
}
