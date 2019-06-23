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
    /** @var MockObject */
    private $logHandler;

    /** @var SerializableMessageLogger */
    private $loggerMiddleware;

    protected function setUp(): void
    {
        $this->logHandler = $this->createMock(LogHandlerInterface::class);
        $this->loggerMiddleware = new SerializableMessageLogger($this->logHandler);
    }

    /**
     * @test
     */
    public function shouldLogStart(): void
    {
        $this->logHandler->expects($this->once())
            ->method('log');

        $message = $this->createMock(SerializableInterface::class);

        $message->expects($this->once())
            ->method('serialize')
            ->willReturn(['foo' => 'bar']);

        $this->loggerMiddleware->start($message);
    }

    /**
     * @test
     */
    public function shouldNotThrowOnStartLogException(): void
    {
        $this->logHandler->expects($this->once())
            ->method('log')
            ->willThrowException(new Exception());

        $message = $this->createMock(SerializableInterface::class);

        $message->expects($this->once())
            ->method('serialize')
            ->willReturn(['foo' => 'bar']);

        $this->loggerMiddleware->start($message);
    }

    /**
     * @test
     */
    public function shouldLogSuccess(): void
    {
        $this->logHandler->expects($this->once())
            ->method('log');

        $message = $this->createMock(SerializableInterface::class);

        $message->expects($this->once())
            ->method('serialize')
            ->willReturn(['foo' => 'bar']);

        $this->loggerMiddleware->success($message);
    }

    /**
     * @test
     */
    public function shouldNotThrowOnSuccessLogException(): void
    {
        $this->logHandler->expects($this->once())
            ->method('log')
            ->willThrowException(new Exception());

        $message = $this->createMock(SerializableInterface::class);

        $message->expects($this->once())
            ->method('serialize')
            ->willReturn(['foo' => 'bar']);

        $this->loggerMiddleware->success($message);
    }

    /**
     * @test
     */
    public function shouldLogFailed(): void
    {
        $this->logHandler->expects($this->once())
            ->method('log');

        $message = $this->createMock(SerializableInterface::class);

        $message->expects($this->once())
            ->method('serialize')
            ->willReturn(['foo' => 'bar']);

        $this->loggerMiddleware->failed($message, new Exception());
    }

    /**
     * @test
     */
    public function shouldNotThrowOnFailedLogException(): void
    {
        $this->logHandler->expects($this->once())
            ->method('log')
            ->willThrowException(new Exception());

        $message = $this->createMock(SerializableInterface::class);

        $message->expects($this->once())
            ->method('serialize')
            ->willReturn(['foo' => 'bar']);

        $this->loggerMiddleware->failed($message, new Exception());
    }

    /**
     * @test
     */
    public function shouldLogCritical(): void
    {
        $this->logHandler->expects($this->once())
            ->method('log');

        $message = $this->createMock(SerializableInterface::class);

        $message->expects($this->once())
            ->method('serialize')
            ->willReturn(['foo' => 'bar']);

        $this->loggerMiddleware->critical($message, new Exception());
    }

    /**
     * @test
     */
    public function shouldNotThrowOnCriticalLogException(): void
    {
        $this->logHandler->expects($this->once())
            ->method('log')
            ->willThrowException(new Exception());

        $message = $this->createMock(SerializableInterface::class);

        $message->expects($this->once())
            ->method('serialize')
            ->willReturn(['foo' => 'bar']);

        $this->loggerMiddleware->critical($message, new Exception());
    }
}
