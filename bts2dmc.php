<?php
mb_internal_encoding('UTF-8');
mb_regex_encoding('UTF-8');

$options = getopt('f:o:');
//var_dump($options);

$srcfile = isset($options['f']) ? $options['f']: 'php://stdin';
$outfile = isset($options['o']) ? $options['o']: 'php://stdout';

$bts = str_split(preg_replace('/\/\*.*\*\/|\/\/.*\r*\n|[ \t\r\n]/', '', file_get_contents($srcfile)), 8);
//var_dump($bts);

$contents = '';
foreach ($bts as $index => $bits) {
//    echo "{$index}: {$bits} => ";
    $byte = str_split($bits, 1);
    $b  = (int)$byte[7]; $b <<= 1;
    $b |= (int)$byte[6]; $b <<= 1;
    $b |= (int)$byte[5]; $b <<= 1;
    $b |= (int)$byte[4]; $b <<= 1;
    $b |= (int)$byte[3]; $b <<= 1;
    $b |= (int)$byte[2]; $b <<= 1;
    $b |= (int)$byte[1]; $b <<= 1;
    $b |= (int)$byte[0];
//    echo "{$b}\n";

    $contents .= pack('C', $b);
}

file_put_contents($outfile, $contents);
