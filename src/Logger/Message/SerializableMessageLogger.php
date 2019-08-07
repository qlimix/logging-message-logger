<?php declare(strict_types=1);

namespace Qlimix\Logging\Logger\Message;

use Qlimix\Log\Handler\Channel;
use Qlimix\Log\Handler\Level;
use Qlimix\Log\Handler\LogHandlerInterface;
use Qlimix\Serializable\SerializableInterface;
use Throwable;
use function get_class;

final class SerializableMessageLogger implements MessageLoggerInterface
{
    private const CHANNEL = 'messagebus';

    /** @var LogHandlerInterface */
    private $logHandler;

    public function __construct(LogHandlerInterface $logHandler)
    {
        $this->logHandler = $logHandler;
    }

    /**
     * @inheritDoc
     */
    public function start(SerializableInterface $message): void
    {
        $context = [
            'type' => 'start',
            'object' => get_class($message),
            'message' => $message->serialize(),
        ];

        $this->logHandler->log(
            new Channel(self::CHANNEL),
            Level::createInfo(),
            'Triggered message '.$message->getName(),
            $context
        );
    }

    /**
     * @inheritDoc
     */
    public function success(SerializableInterface $message): void
    {
        $context = [
            'type' => 'success',
            'object' => get_class($message),
            'message' => $message->serialize(),
        ];

        $this->logHandler->log(
            new Channel(self::CHANNEL),
            Level::createInfo(),
            'Successfully processed message '.$message->getName(),
            $context
        );
    }

    /**
     * @inheritDoc
     */
    public function failed(SerializableInterface $message, Throwable $exception): void
    {
        $context = [
            'type' => 'failed',
            'object' => get_class($message),
            'message' => $message->serialize(),
            'exception' => [
                'message' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => (string) $exception,
            ],
        ];

        $this->logHandler->log(
            new Channel(self::CHANNEL),
            Level::createError(),
            'Failed message '.$message->getName(),
            $context
        );
    }

    /**
     * @inheritDoc
     */
    public function critical(SerializableInterface $message, Throwable $exception): void
    {
        $context = [
            'type' => 'critical',
            'object' => get_class($message),
            'message' => $message->serialize(),
            'exception' => [
                'message' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => (string) $exception,
            ],
        ];

        $this->logHandler->log(
            new Channel(self::CHANNEL),
            Level::createCritical(),
            'Critically failed message '.$message->getName(),
            $context
        );
    }
}
