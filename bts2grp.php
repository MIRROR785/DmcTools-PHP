<?php
mb_internal_encoding('UTF-8');
mb_regex_encoding('UTF-8');

$options = getopt('l:f:o:');
//var_dump($options);

$level = isset($options['l']) ? (int)$options['l']: 31;
$srcfile = isset($options['f']) ? $options['f']: 'php://stdin';
$outfile = isset($options['o']) ? $options['o']: 'php://stdout';

$bts = str_split(preg_replace('/\/\*.*\*\/|\/\/.*\r*\n|[ \t\r\n]/', '', file_get_contents($srcfile)), 8);
//var_dump($bts);

$values = [];
foreach ($bts as $index => $bits) {
//    echo "{$index}: {$bits} => ";
    $byte = str_split($bits, 1);
    $b = (int)$byte[0];
    $level += ($b << 1) - 1; $level = ($level < 0) ? 0 : (($level > 63) ? 63 : $level); $values[] = $level;
    $b = (int)$byte[1];
    $level += ($b << 1) - 1; $level = ($level < 0) ? 0 : (($level > 63) ? 63 : $level); $values[] = $level;
    $b = (int)$byte[2];
    $level += ($b << 1) - 1; $level = ($level < 0) ? 0 : (($level > 63) ? 63 : $level); $values[] = $level;
    $b = (int)$byte[3];
    $level += ($b << 1) - 1; $level = ($level < 0) ? 0 : (($level > 63) ? 63 : $level); $values[] = $level;
    $b = (int)$byte[4];
    $level += ($b << 1) - 1; $level = ($level < 0) ? 0 : (($level > 63) ? 63 : $level); $values[] = $level;
    $b = (int)$byte[5];
    $level += ($b << 1) - 1; $level = ($level < 0) ? 0 : (($level > 63) ? 63 : $level); $values[] = $level;
    $b = (int)$byte[6];
    $level += ($b << 1) - 1; $level = ($level < 0) ? 0 : (($level > 63) ? 63 : $level); $values[] = $level;
    $b = (int)$byte[7];
    $level += ($b << 1) - 1; $level = ($level < 0) ? 0 : (($level > 63) ? 63 : $level); $values[] = $level;
}

$count = count($values);

$contents = '';
/*
for ($index = 0; $index < $count; ++$index) {
    if (($index & 7) == 0) {
        $i = ($index >> 3) & 0x0f;
        $contents .= sprintf("%X", $i);
    } else {
        $contents .= '-';
    }
}
$contents .= "\n";

for ($level = 63; $level >= 0; --$level) {
    foreach ($values as $v) {
        $contents .= ($level === $v) ? '*' : ' ';
    }
    $contents .= "\n";
}
*/

for ($level = 0x3f; $level >= 0x20; --$level) {
    foreach ($values as $v) {
        $contents .= ($level === $v) ? '*' : ' ';
    }
    $contents .= "\n";
}
    $level = 0x1f;
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

for ($level = 0x1e; $level >= 0; --$level) {
    foreach ($values as $v) {
        $contents .= ($level === $v) ? '*' : ' ';
    }
    $contents .= "\n";
}

file_put_contents($outfile, $contents);
