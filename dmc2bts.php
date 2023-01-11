<?php
mb_internal_encoding('UTF-8');
mb_regex_encoding('UTF-8');

$options = getopt('f:o:');
//var_dump($options);

$srcfile = isset($options['f']) ? $options['f']: 'php://stdin';
$outfile = isset($options['o']) ? $options['o']: 'php://stdout';

$bin = unpack("C*", file_get_contents($srcfile));

$contents = '// 0-------1-------2-------3-------4-------5-------6-------7-------8-------9-------A-------B-------C-------D-------E-------F-------';
foreach ($bin as $index => $byte) {
    //echo "{$index}: {$byte} => ";
    $b0 = $byte & 0x01; $byte >>= 1;
    $b1 = $byte & 0x01; $byte >>= 1;
    $b2 = $byte & 0x01; $byte >>= 1;
    $b3 = $byte & 0x01; $byte >>= 1;
    $b4 = $byte & 0x01; $byte >>= 1;
    $b5 = $byte & 0x01; $byte >>= 1;
    $b6 = $byte & 0x01; $byte >>= 1;
    $b7 = $byte & 0x01;
    $b = "{$b0}{$b1}{$b2}{$b3}{$b4}{$b5}{$b6}{$b7}";
    //echo "{$b}\n";

    if (($index - 1) % 16 == 0) {
        $contents .= "\n   ";
    }
    $contents .= $b;
}

file_put_contents($outfile, $contents);
