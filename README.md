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
        PHP PERFORMANCE TIMING
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
composer require jamesgober/benchmark
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

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository.
2. Create a feature branch.
3. Commit your changes with descriptive messages.
4. Open a pull request.

Ensure all tests pass and adhere to the project's coding standards.
&nbsp;

## Reporting Bugs and Feature Requests

For non-security issues, such as bugs or feature requests, please use our **[Issue Tracker](https://github.com/jamesgober/Config/issues)**. Providing detailed information will help us resolve issues efficiently.

&nbsp;

## Reporting Security Issues
We take security seriously. If you find a vulnerability, please consult our **[SECURITY POLICY](.github/SECURITY.md)** and follow the instructions for reporting. 

Do not use public issue trackers or forums to disclose sensitive information.

&nbsp;

## Design Philosophy

Learn about the principles that guide the development of **JG\Config** in our **[Design Philosophy](docs/DESIGN_PHILOSOPHY.md)**.


&nbsp;

## License

This library is licensed under the [Apache-2.0 License](LICENSE).

&nbsp;

---

&nbsp;

&nbsp;


<!--
<br><br><br>
<div align="center">
    <a href="#top"><b>TOP</b></a>
    <br><br><br><br>
    <div>
        <h2>JAMES GOBER</h2>
        <p>
        <small>
            <a href="https://jamesgober.com" title="James Gober Website" target="_blank">Website</a>
            <span>&nbsp; | &nbsp;</span>
            <a href="https://github.com/jamesgober" title="James Gober Github" target="_blank">GitHub</a>
        </small>
        </p>
    </div>
    <br>
    <br>
    <h3>FOLLOW ME</h3>
    <p>
        <a href="https://x.com/jamesgober/" title="James Gober x/twitter profile">
            <svg width="18" height="18" fill="none" viewBox="0 0 1200 1227" xmlns="http://www.w3.org/2000/svg">
            <path fill="#09F" d="M714.163 519.284L1160.89 0H1055.03L667.137 450.887L357.328 0H0L468.492 681.821L0 1226.37H105.866L515.491 750.218L842.672 1226.37H1200L714.137 519.284H714.163ZM569.165 687.828L521.697 619.934L144.011 79.6944H306.615L611.412 515.685L658.88 583.579L1055.08 1150.3H892.476L569.165 687.854V687.828Z" /></svg></a>
        <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <a href="https://github.com/jamesgober" title="James Gober GitHub profile and repository">
            <svg height="22" width="22" fill="none" aria-hidden="true" viewBox="0 0 24 24" data-view-component="true">
            <path fill="#09F" d="M12.5.75C6.146.75 1 5.896 1 12.25c0 5.089 3.292 9.387 7.863 10.91.575.101.79-.244.79-.546 0-.273-.014-1.178-.014-2.142-2.889.532-3.636-.704-3.866-1.35-.13-.331-.69-1.352-1.18-1.625-.402-.216-.977-.748-.014-.762.906-.014 1.553.834 1.769 1.179 1.035 1.74 2.688 1.25 3.349.948.1-.747.402-1.25.733-1.538-2.559-.287-5.232-1.279-5.232-5.678 0-1.25.445-2.285 1.178-3.09-.115-.288-.517-1.467.115-3.048 0 0 .963-.302 3.163 1.179.92-.259 1.897-.388 2.875-.388.977 0 1.955.13 2.875.388 2.2-1.495 3.162-1.179 3.162-1.179.633 1.581.23 2.76.115 3.048.733.805 1.179 1.825 1.179 3.09 0 4.413-2.688 5.39-5.247 5.678.417.36.776 1.05.776 2.128 0 1.538-.014 2.774-.014 3.162 0 .302.216.662.79.547C20.709 21.637 24 17.324 24 12.25 24 5.896 18.854.75 12.5.75Z"></path></svg></a>
        <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <a href="https://instagram.com/jamesgober" title="James Gober Instagram profile">
            <svg width="21" height="21" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 169.063 169.063" xml:space="preserve">
            <path fill="#09F" d="M122.406,0H46.654C20.929,0,0,20.93,0,46.655v75.752c0,25.726,20.929,46.655,46.654,46.655h75.752 c25.727,0,46.656-20.93,46.656-46.655V46.655C169.063,20.93,148.133,0,122.406,0z M154.063,122.407 c0,17.455-14.201,31.655-31.656,31.655H46.654C29.2,154.063,15,139.862,15,122.407V46.655C15,29.201,29.2,15,46.654,15h75.752 c17.455,0,31.656,14.201,31.656,31.655V122.407z"/>
            <path fill="#09F" d="M84.531,40.97c-24.021,0-43.563,19.542-43.563,43.563c0,24.02,19.542,43.561,43.563,43.561s43.563-19.541,43.563-43.561 C128.094,60.512,108.552,40.97,84.531,40.97z M84.531,113.093c-15.749,0-28.563-12.812-28.563-28.561 c0-15.75,12.813-28.563,28.563-28.563s28.563,12.813,28.563,28.563C113.094,100.281,100.28,113.093,84.531,113.093z"/>
            <path fill="#09F" d="M129.921,28.251c-2.89,0-5.729,1.17-7.77,3.22c-2.051,2.04-3.23,4.88-3.23,7.78c0,2.891,1.18,5.73,3.23,7.78 c2.04,2.04,4.88,3.22,7.77,3.22c2.9,0,5.73-1.18,7.78-3.22c2.05-2.05,3.22-4.89,3.22-7.78c0-2.9-1.17-5.74-3.22-7.78 C135.661,29.421,132.821,28.251,129.921,28.251z"/></svg></a>
        <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <a href="https://www.linkedin.com/in/jamesgober" title="James Gober Agency LinkedIn profile">
            <svg height="21" width="21" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 310 310" xml:space="preserve">
            <path fill="#09F" d="M72.16,99.73H9.927c-2.762,0-5,2.239-5,5v199.928c0,2.762,2.238,5,5,5H72.16c2.762,0,5-2.238,5-5V104.73 C77.16,101.969,74.922,99.73,72.16,99.73z"/>
            <path fill="#09F" d="M41.066,0.341C18.422,0.341,0,18.743,0,41.362C0,63.991,18.422,82.4,41.066,82.4 c22.626,0,41.033-18.41,41.033-41.038C82.1,18.743,63.692,0.341,41.066,0.341z"/>
            <path fill="#09F" d="M230.454,94.761c-24.995,0-43.472,10.745-54.679,22.954V104.73c0-2.761-2.238-5-5-5h-59.599 c-2.762,0-5,2.239-5,5v199.928c0,2.762,2.238,5,5,5h62.097c2.762,0,5-2.238,5-5v-98.918c0-33.333,9.054-46.319,32.29-46.319 c25.306,0,27.317,20.818,27.317,48.034v97.204c0,2.762,2.238,5,5,5H305c2.762,0,5-2.238,5-5V194.995 C310,145.43,300.549,94.761,230.454,94.761z"/></svg></a>
    </p>
</div>-->
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