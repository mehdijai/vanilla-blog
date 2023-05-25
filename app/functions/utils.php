<?php

function dd($value)
{
?>
    <html>

    <head>
        <link rel="stylesheet" href="https://unpkg.com/@highlightjs/cdn-assets@11.7.0/styles/monokai-sublime.min.css">
        <script src="https://unpkg.com/@highlightjs/cdn-assets@11.7.0/highlight.min.js"></script>
        <script src="https://unpkg.com/@highlightjs/cdn-assets@11.7.0/languages/json.min.js"></script>
        <title>Dump & Die</title>
    </head>

    <body style="background-color: #23241F;">
        <pre><code class="language-json"><?= json_encode($value, JSON_PRETTY_PRINT); ?></code></pre>
        <script>
            hljs.highlightAll();
        </script>
    </body>

    </html>
<?php
    die();
}

function abort($code)
{
    http_response_code($code);
    require("views/$code.view.php");
    die();
}

function isUrl($url)
{
    return $_SERVER['REQUEST_URI'] === $url;
}

function formatDate($date)
{
    $formattedDate = date('d/m/Y', strtotime($date));
    return $formattedDate;
}

function between(int | float $value, int | float $min, int | float $max, bool $strictly_greater = false, bool $strictly_less = false)
{
    $isMin = false;
    $isMax = false;

    if ($strictly_greater) {
        $isMin = $value > $min;
    } else {
        $isMin = $value >= $min;
    }

    if ($strictly_less) {
        $isMax = $value < $max;
    } else {
        $isMax = $value <= $max;
    }

    return $isMin && $isMax;
}

function array_find($needle, array $haystack)
{
    $filtered = array_filter($haystack, function ($person) use ($needle) {
        return $person['name'] === $needle;
    });

    if (!empty($filtered)) {
        return reset($filtered);
    } else {
        return null;
    }
}
