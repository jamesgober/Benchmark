<h1 id="top" align="center">
    <picture>
        <source media="(prefers-color-scheme: dark)" srcset="./docs/media/jamesgober-logo-dark.png">
        <img width="72" height="72" alt="Official brand mark and logo of James Gober. Image shows JG stylish initials encased in a hexagon outline." src="./docs/media/jamesgober-logo.png">
    </picture>
    <br>
    <b>BENCHMARK</b>
    <br>
    <sup>
        <small><small><small>
        PHP PERFORMANCE INSIGHTS<br>
        PRECISION TIMING &amp; PERFORMANCE INSIGHTS FOR PHP
        </small></small></small>
    </sup>
    <br>
</h1>



<div align="center">
    <img src="https://img.shields.io/github/stars/jamesgober/Benchmark?style=flat" alt="GitHub Stars"> &nbsp; 
    <img src="https://img.shields.io/github/issues/jamesgober/Benchmark?style=flat" alt="GitHub Issues"> &nbsp;  
    <img src="https://img.shields.io/github/v/release/jamesgober/Benchmark?display_name=tag&style=flat" alt="GitHub Release"> &nbsp; 
    <img src="https://img.shields.io/github/license/jamesgober/Benchmark?style=flat" alt="GitHub License"> &nbsp;
    <img src="https://img.shields.io/badge/PHP-8.2-blue?style=flat" alt="PHP Version"> &nbsp;
    <a href="https://packagist.org/packages/jamesgober/Benchmark" target="_blank">
        <img alt="Packagist Downloads" src="https://img.shields.io/packagist/dt/jamesgober/Benchmark?style=flat&color=%23f26f1a">
    </a>
</div>

&nbsp;

Benchmark is a high-performance PHP library for measuring execution time and memory usage of code. Designed with precision, fault tolerance, and extensibility in mind, it provides advanced features like middleware hooks, configurable options, and detailed reporting to help developers optimize their applications.

&nbsp;

## Key Features
- **High-Resolution Timing**: Nanosecond-level precision using `hrtime`.
- **Memory Tracking**: Track memory usage and peak memory consumption.
- **Middleware Support**: Pre- and post-processing hooks for advanced customization.
- **Grouped Benchmarking**: Run and analyze multiple benchmarks simultaneously.
- **Statistical Analysis**: Generate averages, variances, and detailed reports over multiple iterations.
- **Configurable Options**: Toggle features like verbose output and peak memory tracking.
- **Integration Ready**: Export reports in JSON, array, or human-readable formats.
- **Lightweight and Efficient**: Minimal overhead to keep performance at its peak.

&nbsp;


## Installation

Install via [composer](https://getcomposer.org/download/):

```sh
composer "require jamesgober/benchmark"
```


&nbsp;

## Usage

### Basic Benchmark

```php
use JG\Benchmark\Benchmark;

$benchmark = new Benchmark();

$benchmark->start('example');
// Code to benchmark
usleep(1000); // Simulate a short delay
$benchmark->stop('example');

// Get results
echo $benchmark->getTime('example'); // Outputs elapsed time
echo $benchmark->getMemory('example'); // Outputs memory usage
```

### Grouped Benchmark Report

```php
$benchmark->start('task1');
usleep(2000);
$benchmark->stop('task1');

$benchmark->start('task2');
usleep(1000);
$benchmark->stop('task2');

print_r($benchmark->getReport());
```

#### Example Output

```
Array
(
    [task1] => Array
        (
            [time] => 0.002 ms
            [memory] => 1.23 KB
            [peak_memory] => 1.45 KB
        )

    [task2] => Array
        (
            [time] => 0.001 ms
            [memory] => 1.12 KB
            [peak_memory] => 1.32 KB
        )
)
```

### Middleware Example

```php
$benchmark->addMiddleware('before', function ($name, $data) {
    echo "Starting benchmark: $name\n";
});

$benchmark->addMiddleware('after', function ($name, $data) {
    echo "Finished benchmark: $name\n";
});

$benchmark->start('middleware_example');
usleep(1500);
$benchmark->stop('middleware_example');
```

---

&nbsp;

## Configuration

Customize behavior by passing an array of options to the constructor:

```php
$config = [
    'track_peak_memory' => true,
    'verbose' => false,
];

$benchmark = new Benchmark($config);
```

| Option              | Default | Description                        |
|---------------------|---------|------------------------------------|
| `track_peak_memory` | `true`  | Tracks peak memory usage if true.  |
| `verbose`           | `false` | Enables verbose output if true.    |

---

&nbsp;

## Testing

Run PHPUnit tests:

```bash
composer test
```

Run static analysis with PHPStan:

```bash
composer phpstan
```

Run both tests and static analysis:

```bash
composer check
```
---

&nbsp;

## Reporting Bugs and Feature Requests

For bugs, feature requests, or security issues, please visit our **[Issue Tracker](https://github.com/jamesgober/Benchmark/issues)**.

If you discover a vulnerability, refer to our [Security Policy](.github/SECURITY.md).

---

## Contributing

Contributions are welcome! Please follow our [Contribution Guidelines](.github/CONTRIBUTING.md):

1. Fork the repository.
2. Create a feature branch.
3. Commit your changes with descriptive messages.
4. Open a pull request.

Ensure all tests pass and adhere to the project's coding standards.

&nbsp;

## License
This library is licensed under the [Apache-2.0](LICENSE) License.


&nbsp;

---

&nbsp;

<!--
####################################################
COPYRIGHT
####################################################-->
<div align="center">
    <h2></h2>
    <sup>
        COPYRIGHT <small>&copy;</small> 2025 <strong>JAMES GOBER.</strong>
    </sup>
</div>

&nbsp;


<!--
####################################################
LINKS
####################################################-->
[Contribution Guidelines]: .github/CONTRIBUTING.md
[CONTRIBUTING]:            .github/CONTRIBUTING.md
[CODE OF CONDUCT]:         .github/CODE_OF_CONDUCT.md
[REPORT SECURITY ISSUES]:  .github/SECURITY.md
[SECURITY POLICY]:         .github/SECURITY.md
[SECURITY]:                .github/SECURITY.md