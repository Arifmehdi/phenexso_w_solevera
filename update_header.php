<?php
$file = 'resources/views/website/layouts/solevera_header.blade.php';
$content = file_get_contents($file);

// Find the <style> block
$style_start = strpos($content, '<style>');
$style_end = strpos($content, '</style>');

if ($style_start === false || $style_end === false) {
    echo "ERROR: Could not find <style> block\n";
    exit(1);
}

$style_content = substr($content, $style_start + 7, $style_end - $style_start - 7);

// List of selectors to prefix with #solevera-new-header
$selectors = [
    '.top-banner',
    'header',
    '.header-inner',
    '.logo',
    '.header-right',
    '.search-box',
    '.search-box input',
    '.header-icons',
    '.header-icon',
    '.cart-count',
    'nav',
    '.nav-inner',
    '.nav-eid',
    '.nav-item',
    '.nav-link',
    '.nav-link:hover, .nav-link.active',
    '.mega-menu',
    '.nav-item:hover .mega-menu',
    '.mega-col h4',
    '.mega-col ul',
    '.mega-col ul li',
    '.mega-col ul li a',
    '.mega-col ul li a:hover',
];

// Also handle @media blocks
// We need to prefix selectors inside @media blocks too

// Simple approach: prefix each selector
foreach ($selectors as $selector) {
    // Handle comma-separated selectors
    $parts = explode(', ', $selector);
    $prefixed_parts = array_map(function($part) {
        return '#solevera-new-header ' . trim($part);
    }, $parts);
    $prefixed = implode(', ', $prefixed_parts);

    // Replace in style content
    $style_content = str_replace($selector . ' {', $prefixed . ' {', $style_content);
}

// Handle @media blocks - need to add prefix to selectors inside them
// Match @media blocks and add prefix to selectors inside
$pattern = '/@media[^{]+\{([^}]+)\}/';
preg_match_all($pattern, $style_content, $matches, PREG_SET_ORDER);

foreach ($matches as $match) {
    $media_block = $match[0];
    $inner = $match[1];

    // Add prefix to each line that looks like a CSS selector
    $lines = explode("\n", $inner);
    $new_lines = [];
    foreach ($lines as $line) {
        $trimmed = trim($line);
        // Check if line looks like a CSS selector (ends with {)
        if (strpos($trimmed, '{') !== false && strpos($trimmed, '#solevera-new-header') === false) {
            // Add prefix
            $line = str_replace($trimmed, '#solevera-new-header ' . $trimmed, $line);
        }
        $new_lines[] = $line;
    }
    $new_inner = implode("\n", $new_lines);
    $new_media_block = str_replace($inner, $new_inner, $media_block);
    $style_content = str_replace($media_block, $new_media_block, $style_content);
}

// Replace the style content
$new_content = substr($content, 0, $style_start + 7)
            . $style_content
            . substr($content, $style_end);

// Add closing </div> if not already present
if (strpos($new_content, '</div><!-- /#solevera-new-header -->') === false) {
    $new_content = str_replace('</style>', "</style>\n\n\t\t\t</div><!-- /#solevera-new-header -->", $new_content);
}

file_put_contents($file, $new_content);
echo "SUCCESS: Updated header with namespaced CSS selectors\n";
