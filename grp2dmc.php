<?php
mb_internal_encoding('UTF-8');
mb_regex_encoding('UTF-8');

$options = getopt('sf:o:');
//var_dump($options);

$srcfile = isset($options['f']) ? $options['f']: 'php://stdin';
$outfile = isset($options['o']) ? $options['o']: 'php://stdout';

$lines = preg_split("/\r*\n/", preg_replace('/\/\/.*\r*\n|\/\*[\s\S]*?\*\//', '', file_get_contents($srcfile)));
//var_dump($lines);

$values = [];
$counts = [];

$index = 0;
$row = 0;
foreach ($lines as $line) {
    //$v = str_split(rtrim(preg_replace('/[\r\n]/', '', $line)));
    $v = str_split(rtrim($line));
    $values[] = $v;
    $counts[] = count($v);

    if ($v[0] === '*') {
        $index = $row;
    }
    ++$row;
}

//var_dump($index);
//var_dump($counts);

$low = count($values);
$bts = '1';
for ($column = 1; ; ++$column) {
    $row = $index - 1;
    if ($row >= 0 && $column < $counts[$row] && $values[$row][$column] === '*') {
        $bts .= '1';
    } else {
        $row = $index + 1;
        if ($row < $low && $column < $counts[$row] && $values[$row][$column] === '*') {
            $bts .= '0';
        } else {
            $m = $column % 8;
            if ($m > 0) {
                for ($rest = 8 - $m; $rest > 0; --$rest) {
                    $bts .= '0';
                }
            }
            break;
        }
    }
    $index = $row;
}

//var_dump($bts);

if (isset($options['s'])) {
    $contents = '// 0-------1-------2-------3-------4-------5-------6-------7-------8-------9-------A-------B-------C-------D-------E-------F-------';
    $array = str_split($bts, 16*8);
    foreach ($array as $line) {
        $contents .= "\n   ".$line;
    }

} else {
    $contents = '';
    $array = str_split($bts, 8);
    foreach ($array as $index => $bits) {
//      echo "{$index}: {$bits} => ";
        $byte = str_split($bits, 1);
        $b  = (int)$byte[7]; $b <<= 1;
        $b |= (int)$byte[6]; $b <<= 1;
        $b |= (int)$byte[5]; $b <<= 1;
        $b |= (int)$byte[4]; $b <<= 1;
        $b |= (int)$byte[3]; $b <<= 1;
        $b |= (int)$byte[2]; $b <<= 1;
        $b |= (int)$byte[1]; $b <<= 1;
        $b |= (int)$byte[0];
//      echo "{$b}\n";

        $contents .= pack('C', $b);
    }
}

file_put_contents($outfile, $contents);
