<?php
/**
 * Author: Jay Annadurai
 * Date: 14 Nov 2024
 * Project: I210 - Fall 2024
 * File: console_php.php
 * Description: Utilizes console.log to log PHP values
 */

/**
 * Logs a PHP value to the JavaScript console in Web Inspector
 * Accepts most PHP Values
 * @param mixed $elements The PHP element to be logged to the Web Console
 * @return void
 */
function console_php(...$elements): void
{
    // Extract the Value
    $value = match (count($elements)) {
        1 => $elements[0],
        0 => "<No Value Provided>",
        default => $elements,
    };

    // Get the backtrace to find the file and line where this function was called
    $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];
    $file = isset($backtrace['file']) ? basename($backtrace['file']) : 'Unknown file';
    $line = isset($backtrace['line']) ? $backtrace['line'] : 'Unknown line';
    $location = "{$file} - Line {$line}:";

    // Encode the PHP value as JSON
    $jsonValue = json_encode($value, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    // If JSON encoding fails, handle the error gracefully
    if ($jsonValue === false) {
        $jsonValue = json_encode(["error" => "Unable to encode value to JSON"]);
    }

    // Escape the location string for JavaScript
    $jsLocation = json_encode($location);

    // Output JavaScript code to log the file and line, and the value
    echo "
    <script>
        // Logging Output from php
        (function() {
            let location = {$jsLocation};
            let value = {$jsonValue};
            console.log(location);
            console.log(value);
        })();
    </script>
    ";
}