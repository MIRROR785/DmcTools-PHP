<?php
mb_internal_encoding('UTF-8');
mb_regex_encoding('UTF-8');

$options = getopt('f:o:');
//var_dump($options);

$srcfile = isset($options['f']) ? $options['f']: 'php://stdin';
$outfile = isset($options['o']) ? $options['o']: 'php://stdout';

$bin = unpack("C*", file_get_contents($srcfile));
//var_dump($bts);

$values = [];
$level = 0;
$min   = 0;
$max   = 0;
foreach ($bin as $index => $byte) {
    $b = $byte & 0x01;   $byte >>= 1;   $level += ($b << 1) - 1; $values[] = $level; if ($level < $min) $min = $level; if ($max < $level) $max = $level;
    $b = $byte & 0x01;   $byte >>= 1;   $level += ($b << 1) - 1; $values[] = $level; if ($level < $min) $min = $level; if ($max < $level) $max = $level;
    $b = $byte & 0x01;   $byte >>= 1;   $level += ($b << 1) - 1; $values[] = $level; if ($level < $min) $min = $level; if ($max < $level) $max = $level;
    $b = $byte & 0x01;   $byte >>= 1;   $level += ($b << 1) - 1; $values[] = $level; if ($level < $min) $min = $level; if ($max < $level) $max = $level;
    $b = $byte & 0x01;   $byte >>= 1;   $level += ($b << 1) - 1; $values[] = $level; if ($level < $min) $min = $level; if ($max < $level) $max = $level;
    $b = $byte & 0x01;   $byte >>= 1;   $level += ($b << 1) - 1; $values[] = $level; if ($level < $min) $min = $level; if ($max < $level) $max = $level;
    $b = $byte & 0x01;   $byte >>= 1;   $level += ($b << 1) - 1; $values[] = $level; if ($level < $min) $min = $level; if ($max < $level) $max = $level;
    $b = $byte & 0x01; /*$byte >>= 1;*/ $level += ($b << 1) - 1; $values[] = $level; if ($level < $min) $min = $level; if ($max < $level) $max = $level;
}

$count = count($values);

$contents = '';

for ($level = $max; $level > 0; --$level) {
    foreach ($values as $v) {
        $contents .= ($level === $v) ? '*' : ' ';
    }
    $contents .= "\n";
}
$level = 0;
$index = 0;
foreach ($values as $v) {
    if ($level === $v) {
        $contents .= '*';
    } else if (($index & 7) == 0) {
        $i = ($index >> 3) & 0x0f;
        $contents .= sprintf("%X", $i);
    } else {
        $contents .= '-';
    }
    ++$index;
}
$contents .= "\n";

for ($level = -1; $level >= $min; --$level) {
    foreach ($values as $v) {
        $contents .= ($level === $v) ? '*' : ' ';
    }
    $contents .= "\n";
}

file_put_contents($outfile, $contents);
