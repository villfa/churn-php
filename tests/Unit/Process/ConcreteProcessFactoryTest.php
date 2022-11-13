<?php

declare(strict_types=1);

namespace Churn\Tests\Unit\Process;

use Churn\Configuration\ReadOnlyConfig;
use Churn\File\File;
use Churn\Process\ChangesCountInterface;
use Churn\Process\CyclomaticComplexityInterface;
use Churn\Process\ConcreteProcessFactory;
use Churn\Tests\BaseTestCase;
use InvalidArgumentException;
use RuntimeException;

class ConcreteProcessFactoryTest extends BaseTestCase
{
    /**
     * @var ConcreteProcessFactory
     */
    private $processFactory;

    public function setUp()
    {
        $config = new ReadOnlyConfig();
        $this->processFactory = new ConcreteProcessFactory($config->getVCS(), $config->getCommitsSince());
    }

    /** @test */
    public function it_can_be_created()
    {
        self::assertInstanceOf(ConcreteProcessFactory::class, $this->processFactory);
    }

    /**
     * @param iterable<object> $processes
     */
    private function extractChangesCountProcess(iterable $processes): ChangesCountInterface
    {
        foreach ($processes as $process) {
            if ($process instanceof ChangesCountInterface) {
                return $process;
            }
        }

        throw new RuntimeException('Changes Count process not found');
    }

    /**
     * @param iterable<object> $processes
     */
    private function extractCyclomaticComplexityProcess(iterable $processes): CyclomaticComplexityInterface
    {
        foreach ($processes as $process) {
            if ($process instanceof CyclomaticComplexityInterface) {
                return $process;
            }
        }

        throw new RuntimeException('Cyclomatic Complexity process not found');
    }

    /** @test */
    public function it_can_create_a_git_commit_count_process()
    {
        $file = new File('foo/bar/baz.php', 'bar/baz.php');
        $process = $this->extractChangesCountProcess($this->processFactory->createProcesses($file));
        self::assertInstanceOf(ChangesCountInterface::class, $process);
        self::assertSame($file, $process->getFile());
    }

    /** @test */
    public function it_can_create_a_cyclomatic_complexity_process()
    {
        $file = new File('foo/bar/baz.php', 'bar/baz.php');
        $process = $this->extractCyclomaticComplexityProcess($this->processFactory->createProcesses($file));
        self::assertInstanceOf(CyclomaticComplexityInterface::class, $process);
        self::assertSame($file, $process->getFile());
    }

    /** @test */
    public function it_throws_exception_if_VCS_is_not_supported()
    {
        $config = new ReadOnlyConfig();
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Unsupported VCS: not a valid VCS');
        new ConcreteProcessFactory('not a valid VCS', $config->getCommitsSince());
    }

    /** @test */
    public function it_always_counts_one_when_there_is_no_VCS()
    {
        $file = new File('foo/bar/baz.php', 'bar/baz.php');
        $this->processFactory = new ConcreteProcessFactory('none', '');
        $process = $this->extractChangesCountProcess($this->processFactory->createProcesses($file));
        self::assertSame($file, $process->getFile());
        self::assertSame(1, $process->countChanges());
    }
}
