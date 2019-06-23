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
        try {
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
        } catch (Throwable $exception) {
        }
    }

    /**
     * @inheritDoc
     */
    public function success(SerializableInterface $message): void
    {
        try {
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
        } catch (Throwable $exception) {
        }
    }

    /**
     * @inheritDoc
     */
    public function failed(SerializableInterface $message, Throwable $exception): void
    {
        try {
            $context = [
                'type' => 'failed',
                'object' => get_class($message),
                'message' => $message->serialize(),
            ];

            $this->logHandler->log(
                new Channel(self::CHANNEL),
                Level::createError(),
                'Failed message '.$message->getName(),
                $context
            );
        } catch (Throwable $exception) {
        }
    }

    /**
     * @inheritDoc
     */
    public function critical(SerializableInterface $message, Throwable $exception): void
    {
        try {
            $context = [
                'type' => 'critical',
                'object' => get_class($message),
                'message' => $message->serialize(),
            ];

            $this->logHandler->log(
                new Channel(self::CHANNEL),
                Level::createCritical(),
                'Critically failed message '.$message->getName(),
                $context
            );
        } catch (Throwable $exception) {
        }
    }
}
