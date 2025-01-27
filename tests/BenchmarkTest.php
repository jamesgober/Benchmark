<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use JG\Benchmark\Benchmark;

class BenchmarkTest extends TestCase
{
    public function testStartStopBenchmark(): void
    {
        $benchmark = new Benchmark();

        $benchmark->start('test');
        usleep(1000); // Simulate a short delay
        $benchmark->stop('test');

        $time = $benchmark->getTime('test');
        $this->assertNotEmpty($time, 'Time should not be empty');
    }

    public function testMemoryTracking(): void
    {
        $benchmark = new Benchmark();

        $benchmark->start('memory_test');
        $array = range(1, 1000); // Simulate memory usage
        $benchmark->stop('memory_test');

        $memory = $benchmark->getMemory('memory_test');
        $this->assertNotEmpty($memory, 'Memory usage should not be empty');
    }

    public function testMiddlewareExecution(): void
    {
        $benchmark = new Benchmark();

        $called = false;
        $benchmark->addMiddleware('before', function () use (&$called) {
            $called = true;
        });

        $benchmark->start('middleware_test');
        $this->assertTrue($called, 'Middleware should have been called');
    }

    public function testGetReport(): void
    {
        $benchmark = new Benchmark();

        $benchmark->start('test1');
        usleep(1000);
        $benchmark->stop('test1');

        $benchmark->start('test2');
        usleep(500);
        $benchmark->stop('test2');

        $report = $benchmark->getReport();
        $this->assertCount(2, $report, 'Report should contain two benchmarks');
    }
}