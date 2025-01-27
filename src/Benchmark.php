<?php 
declare(strict_types=1);
#,-------------------,
#|   ¸_____¸_____¸   |
#|    ╲__¸ ┊ ¸__╱    |
#|   ¸_  ┊ ┊ ┊ ___   |
#|   ┊ [_┊ ┊ ┊_] ┊   |
#|   ┊_____A_____┊   | 
#|   JAMES ☆ GOBER   |
#|___________________|
namespace JG\Benchmark;

use \hrtime;

/**
 * Benchmark
 *
 * A high-performance library for benchmarking code execution and 
 * memory usage. This library is designed with fault tolerance, energy 
 * efficiency, and extensibility in mind. It supports advanced features 
 * like middleware, grouped reporting, and configurable options.
 *
 * @package    JG\Benchmark
 * @version    1.0.0
 * @link       https://github.com/jamesgober/Benchmark Project Website
 * @license    Apache License 2.0
 * @copyright  2025 James Gober.
 */
class Benchmark
{
    /**
     * Stores benchmarks with their start, end times, and memory usage.
     *
     * @var array<string, array<string, mixed>>
     */
    private array $benchmarks = [];

    /**
     * Configuration options for the benchmarking library.
     *
     * @var array<string, mixed>
     */
    private array $config = [
        'track_peak_memory' => true,
        'verbose' => false,
    ];

    /**
     * Middleware hooks for pre- and post-processing.
     *
     * @var array<string, array<callable>>
     */
    private array $middleware = [
        'before' => [],
        'after' => [],
    ];

    /**
     * Constructor
     *
     * Initializes the benchmarking library with optional configuration settings.
     *
     * @param array<string, mixed> $config Configuration options.
     */
    public function __construct(array $config = [])
    {
        $this->config = array_merge($this->config, $config);
    }

    /**
     * Start a new benchmark.
     *
     * @param string   $name   Unique name for the benchmark.
     * @param int|null $preset Optional preset start time in nanoseconds.
     * @return void
     * @throws \LogicException If the benchmark has already started.
     */
    public function start(string $name, ?int $preset = null): void
    {
        $this->runMiddleware('before', $name);

        if (isset($this->benchmarks[$name])) {
            throw new \LogicException("Benchmark '{$name}' already started.");
        }

        $this->benchmarks[$name] = [
            'start' => $preset ?? hrtime(true),
            'memory_start' => memory_get_usage(),
        ];

        if ($this->config['track_peak_memory']) {
            $this->benchmarks[$name]['memory_peak_start'] = memory_get_peak_usage();
        }
    }

    /**
     * Stop a benchmark.
     *
     * @param string $name Name of the benchmark to stop.
     * @return void
     * @throws \LogicException If the benchmark was not started.
     */
    public function stop(string $name): void
    {
        if (!isset($this->benchmarks[$name])) {
            throw new \LogicException("Benchmark '{$name}' was not started.");
        }

        $this->benchmarks[$name]['end'] = hrtime(true);
        $this->benchmarks[$name]['memory_end'] = memory_get_usage();

        if ($this->config['track_peak_memory']) {
            $this->benchmarks[$name]['memory_peak_end'] = memory_get_peak_usage();
        }

        $this->runMiddleware('after', $name);
    }

    /**
     * Get the elapsed time of a benchmark in a human-readable format.
     *
     * @param string $name     Name of the benchmark.
     * @param int    $accuracy Decimal precision for time formatting.
     * @return string Human-readable elapsed time.
     * @throws \LogicException If the benchmark has not been stopped.
     */
    public function getTime(string $name, int $accuracy = 2): string
    {
        $benchmark = $this->getBenchmark($name);
        $elapsed = $benchmark['end'] - $benchmark['start'];

        return $this->formatTime($elapsed, $accuracy);
    }

    /**
     * Get memory usage of a benchmark in a human-readable format.
     *
     * @param string $name     Name of the benchmark.
     * @param int    $accuracy Decimal precision for memory formatting.
     * @return string Human-readable memory usage.
     * @throws \LogicException If the benchmark has not been stopped.
     */
    public function getMemory(string $name, int $accuracy = 2): string
    {
        $benchmark = $this->getBenchmark($name);
        $used = $benchmark['memory_end'] - $benchmark['memory_start'];

        return $this->formatMemory($used, $accuracy);
    }

    /**
     * Get peak memory usage in human-readable format.
     *
     * @param string $name     Name of the benchmark.
     * @param int    $accuracy Decimal precision for memory formatting.
     * @return string Human-readable memory usage.
     * @throws \LogicException If the benchmark has not been stopped.
     */
    public function getPeakMemory(string $name, int $accuracy = 2): string
    {
        if (!$this->config['track_peak_memory']) {
            throw new \LogicException("Peak memory tracking is disabled in the configuration.");
        }

        $benchmark = $this->getBenchmark($name);
        $peak = $benchmark['memory_peak_end'] - $benchmark['memory_peak_start'];

        return $this->formatMemory($peak, $accuracy);
    }

    /**
     * Get a report of all benchmarks.
     *
     * @param int $accuracy Decimal precision for time and memory formatting.
     * @return array<string, array<string, string>> Summary of all benchmarks.
     */
    public function getReport(int $accuracy = 2): array
    {
        $report = [];

        foreach ($this->benchmarks as $name => $data) {
            if (!isset($data['end'])) {
                continue; // Skip incomplete benchmarks.
            }

            $report[$name] = [
                'time' => $this->getTime($name, $accuracy),
                'memory' => $this->getMemory($name, $accuracy),
            ];

            if ($this->config['track_peak_memory']) {
                $report[$name]['peak_memory'] = $this->getPeakMemory($name, $accuracy);
            }
        }

        return $report;
    }

    /**
     * Test a callback function over multiple iterations.
     */
    public function test(callable $callback, int $iterations = 1000, ?string $name = null): void
    {
        $name ??= 'default_test';
        $this->start($name);

        for ($i = 0; $i < $iterations; $i++) {
            $callback();
        }

        $this->stop($name);
    }

    /**
     * Add middleware for pre- or post-processing of benchmarks.
     *
     * @param string   $type     Type of middleware ('before' or 'after').
     * @param callable $callback Callback function to execute.
     * @return void
     * @throws \InvalidArgumentException If the middleware type is invalid.
     */
    public function addMiddleware(string $type, callable $callback): void
    {
        if (!in_array($type, ['before', 'after'], true)) {
            throw new \InvalidArgumentException("Middleware type must be 'before' or 'after'.");
        }

        $this->middleware[$type][] = $callback;
    }

    /**
     * Reset all benchmarks or a specific one.
     */
    public function reset(?string $name = null): void
    {
        if ($name === null) {
            $this->benchmarks = [];
        } elseif (isset($this->benchmarks[$name])) {
            unset($this->benchmarks[$name]);
        } else {
            throw new \LogicException("Benchmark '{$name}' does not exist.");
        }
    }

    /**
     * Run middleware callbacks for a specific stage.
     */
    private function runMiddleware(string $type, string $name): void
    {
        foreach ($this->middleware[$type] as $callback) {
            $callback($name, $this->benchmarks[$name] ?? null);
        }
    }

    /**
     * Retrieve benchmark data.
     */
    private function getBenchmark(string $name): array
    {
        if (!isset($this->benchmarks[$name]['end'])) {
            throw new \LogicException("Benchmark '{$name}' has not been stopped.");
        }

        return $this->benchmarks[$name];
    }

    /**
     * Format elapsed time in a readable format.
     */
    private function formatTime(int $nanoseconds, int $accuracy): string
    {
        $milliseconds = $nanoseconds / 1e6;
        $units = ['ms', 'secs', 'mins', 'hours', 'days'];
        $scales = [1000, 60, 60, 24];

        foreach ($scales as $i => $scale) {
            if ($milliseconds < $scale) {
                return number_format($milliseconds, $accuracy) . ' ' . $units[$i];
            }
            $milliseconds /= $scale;
        }

        return number_format($milliseconds, $accuracy) . ' ' . $units[count($units) - 1];
    }

    /**
     * Format memory usage in a readable format.
     */
    private function formatMemory(int $bytes, int $accuracy): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        foreach ($units as $unit) {
            if ($bytes < 1024) {
                return number_format($bytes, $accuracy) . ' ' . $unit;
            }
            $bytes /= 1024;
        }

        return number_format($bytes, $accuracy) . ' TB';
    }
}