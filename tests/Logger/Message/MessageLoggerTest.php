<?php declare(strict_types=1);

namespace Qlimix\Tests\Logging\Logger\Message;

use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Qlimix\Log\Handler\LogHandlerInterface;
use Qlimix\Logging\Logger\Message\SerializableMessageLogger;
use Qlimix\Serializable\SerializableInterface;

final class MessageLoggerTest extends TestCase
{
    private MockObject $logHandler;

    private SerializableMessageLogger $loggerMiddleware;

    protected function setUp(): void
    {
        $this->logHandler = $this->createMock(LogHandlerInterface::class);
        $this->loggerMiddleware = new SerializableMessageLogger($this->logHandler);
    }

    public function testShouldLogStart(): void
    {
        $this->logHandler->expects($this->once())
            ->method('log');

        $message = $this->createMock(SerializableInterface::class);

        $message->expects($this->once())
            ->method('serialize')
            ->willReturn(['foo' => 'bar']);

        $this->loggerMiddleware->start($message);
    }

    public function testShouldLogSuccess(): void
    {
        $this->logHandler->expects($this->once())
            ->method('log');

        $message = $this->createMock(SerializableInterface::class);

        $message->expects($this->once())
            ->method('serialize')
            ->willReturn(['foo' => 'bar']);

        $this->loggerMiddleware->success($message);
    }

    public function testShouldLogFailed(): void
    {
        $this->logHandler->expects($this->once())
            ->method('log');

        $message = $this->createMock(SerializableInterface::class);

        $message->expects($this->once())
            ->method('serialize')
            ->willReturn(['foo' => 'bar']);

        $this->loggerMiddleware->failed($message, new Exception());
    }

    public function testShouldLogCritical(): void
    {
        $this->logHandler->expects($this->once())
            ->method('log');

        $message = $this->createMock(SerializableInterface::class);

        $message->expects($this->once())
            ->method('serialize')
            ->willReturn(['foo' => 'bar']);

        $this->loggerMiddleware->critical($message, new Exception());
    }
}
