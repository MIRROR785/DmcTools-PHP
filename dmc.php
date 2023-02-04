<?php
mb_internal_encoding('UTF-8');
mb_regex_encoding('UTF-8');


$samples = [
    /*0*/ 4181.71,// c 8
    /*1*/ 4709.93,// d 8
    /*2*/ 5264.04,// e 8
    /*3*/ 5593.04,// f 8
    /*4*/ 6257.95,// g 8
    /*5*/ 7046.35,// a 8
    /*6*/ 7919.35,// b 8
    /*7*/ 8363.42,// c 9
    /*8*/ 9419.86,// d 9
    /*9*/ 11186.1,// f 9
    /*A*/ 12604.0,// g 9
    /*B*/ 13982.6,// a 9
    /*C*/ 16884.6,// c10
    /*D*/ 21306.8,// e10
    /*E*/ 24858.0,// g10
    /*F*/ 33143.9,// c11
    ];

$notes = [
    'c'  => 0,
    'c#' => 1,
    'd'  => 2,
    'd#' => 3,
    'e'  => 4,
    'f'  => 5,
    'f#' => 6,
    'g'  => 7,
    'g#' => 8,
    'a'  => 9,
    'a#' => 10,
    'b'  => 11,
    ];

$periods = [
	/* o1  c  */   32.703,
	/*     c+ */   34.648,
	/*     d  */   36.708,
	/*     d+ */   38.891,
	/*     e  */   41.203,
	/*     f  */   43.654,
	/*     f+ */   46.249,
	/*     g  */   48.999,
	/*     g+ */   51.913,
	/*     a  */   55.000,
	/*     a+ */   58.270,
	/*     b  */   61.735,
	/* o2  c  */   65.406,
	/*(o1) c+ */   69.296,
	/*     d  */   73.416,
	/*     d+ */   77.782,
	/*     e  */   82.407,
	/*     f  */   87.307,
	/*     f+ */   92.499,
	/*     g  */   97.999,
	/*     g+ */  103.826,
	/*     a  */  110.000,
	/*     a+ */  116.541,
	/*     b  */  123.471,
	/* o3  c  */  130.813,
	/*(o2) c+ */  138.591,
	/*     d  */  146.832,
	/*     d+ */  155.563,
	/*     e  */  164.814,
	/*     f  */  174.614,
	/*     f+ */  184.997,
	/*     g  */  195.998,
	/*     g+ */  207.652,
	/*     a  */  220.000,
	/*     a+ */  233.082,
	/*     b  */  246.942,
	/* o4  c  */  261.626,
	/*(o3) c+ */  277.183,
	/*     d  */  293.665,
	/*     d+ */  311.127,
	/*     e  */  329.628,
	/*     f  */  349.228,
	/*     f+ */  369.994,
	/*     g  */  391.995,
	/*     g+ */  415.305,
	/*     a  */  440.000,
	/*     a+ */  466.164,
	/*     b  */  493.883,
	/* o5  c  */  523.251,
	/*(o4) c+ */  554.365,
	/*     d  */  587.330,
	/*     d+ */  622.254,
	/*     e  */  659.255,
	/*     f  */  698.456,
	/*     f+ */  739.989,
	/*     g  */  783.991,
	/*     g+ */  830.609,
	/*     a  */  880.000,
	/*     a+ */  932.328,
	/*     b  */  987.767,
	/* o6  c  */ 1046.502,
	/*(o5) c+ */ 1108.731,
	/*     d  */ 1174.659,
	/*     d+ */ 1244.508,
	/*     e  */ 1318.510,
	/*     f  */ 1396.913,
	/*     f+ */ 1479.978,
	/*     g  */ 1567.982,
	/*     g+ */ 1661.219,
	/*     a  */ 1760.000,
	/*     a+ */ 1864.655,
	/*     b  */ 1975.533,
	/* o7  c  */ 2093.005,
	/*(o6) c+ */ 2217.461,
	/*     d  */ 2349.318,
	/*     d+ */ 2489.016,
	/*     e  */ 2637.020,
	/*     f  */ 2793.826,
	/*     f+ */ 2959.955,
	/*     g  */ 3135.963,
	/*     g+ */ 3322.438,
	/*     a  */ 3520.000,
	/*     a+ */ 3729.310,
	/*     b  */ 3951.066,
	/* o8  c  */ 4186.009,
	/*(o7) c+ */ 4434.922,
	/*     d  */ 4698.636,
	/*     d+ */ 4978.032,
	/*     e  */ 5274.041,
	/*     f  */ 5587.652,
	/*     f+ */ 5919.911,
	/*     g  */ 6271.927,
	/*     g+ */ 6644.875,
	/*     a  */ 7040.000,
	/*     a+ */ 7458.620,
	/*     b  */ 7902.133,
	/* o9  c  */ 8372.018,
	/*(o8) c+ */ 8869.844,
	/*     d  */ 9397.272,
	/*     d+ */ 9956.064,
	/*     e  */10548.082,
	/*     f  */11175.304,
	/*     f+ */11839.822,
	/*     g  */12543.854,
	/*     g+ */13289.750,
	/*     a  */14080.000,
	/*     a+ */14917.240,
	/*     b  */15804.266,
    ];

class Note {
    public $note;
    public $octave;
    public $noteNo;
    public $offset;

    public function __construct($value) {
        global $notes;

        $result = preg_match('/([a-g]#?)?([0-9]+)?([+\-][0-9]+)?/', $value, $matches);
        if ($result) {
            $this->note = $value;
            $this->octave = isset($matches[2]) ? (int)$matches[2] : null;
            $this->noteNo = isset($matches[1]) && isset($notes[$matches[1]]) ? $notes[$matches[1]] : null;
            $this->offset = isset($matches[3]) ? (int)$matches[3] : 0;

        } else {
            $this->note = null;
            $this->octave = null;
            $this->noteNo = null;
            $this->offset = 0;
        }

        //var_dump($this);
    }

    public function getFreq($base_sample) {
        global $periods;

        $result = $this->offset;

        if ($this->noteNo !== null) {
            $noteNo = ($this->octave - 1) * 12 + $this->noteNo;
            $freq = $periods[$noteNo];
            $v = round($base_sample / $freq, 0);
            $v -= $v % 2;
            $result += $v;
        }

        return $result;
    }
}

class Envelope {
    public $note;

    public $freq;
    public $range;
    public $min;
    Public $max;

    public $volume;
    public $attack;
    public $decay;
    public $sustain;
    public $release;

    public $scount;
    public $fcount;

    public function __construct($args, &$start) {
        $this->volume  = (isset($args[$start])) ? (double)$args[$start++] : 0;
        $this->attack  = (isset($args[$start])) ? (double)$args[$start++] : 0;
        $this->decay   = (isset($args[$start])) ? (double)$args[$start++] : 0;
        $this->sustain = (isset($args[$start])) ? (double)$args[$start++] : 0;
        $this->release = (isset($args[$start])) ? (double)$args[$start++] : 0;
        $this->scount  = 0;
        $this->fcount  = 0;
    }

    public function setRate($length) {
        $steps = (int)($length / $this->freq);
        //echo 'setRate.'."\n";
        $this->attack  = (int)($this->attack  * $steps / 100);
        $this->decay   = (int)($this->decay   * $steps / 100);
        $this->release = (int)($this->release * $steps / 100);
        $this->fcount = $this->attack + $this->decay + $this->release + (($this->attack + $this->decay > 0) ? 1 : 0);
    }

    public function setFrame($sampling, $unit) {
        //echo 'setFrame.'."\n";
        $ut = $sampling / $unit;
        //echo 'ut='.$ut."\n";
        $this->attack  = (int)($this->attack  * $ut / $this->freq);
        $this->decay   = (int)($this->decay   * $ut / $this->freq);
        $this->release = (int)($this->release * $ut / $this->freq);
        $this->fcount = $this->attack + $this->decay + $this->release + (($this->attack + $this->decay > 0) ? 1 : 0);
    }

    public function setSustainCount($scount, $range) {
        if ($this->sustain > 0) {
            $this->sustain = $range * $this->sustain / 100;
            $this->scount = (int)($scount / $this->freq);
            $this->fcount += $this->scount;
        } else if ($this->fcount > 0) {
            $this->sustain = $range * $this->release / $this->fcount;
            $this->scount = 0;
        }
    }
}

$options = getopt('vsprla:b:d:u:f:o::');
//var_dump($options);

$verbose = isset($options['v']);
$srcfile = isset($options['f']) ? $options['f']: 'php://stdin';

$default_base_sample = $samples[isset($options['b']) ? (int)$options['b']: 0x0f];
$default_unit = isset($options['u']) ? (int)$options['u']: 60;
$default_phase = isset($options['p']) ? true : false;
$default_duty = (isset($options['d']) || !$default_phase) ? true: false;
$default_duty_rate = isset($options['d']) ? (double)$options['d'] : 50;
$default_rate_params = isset($options['r']) ? true : false;
$default_lost_end = isset($options['l']) ? true : false;
$default_freq_add = isset($options['a']) ? (double)$options['a']: 0;
//echo 'add='.$freq_add."\n";

$base_sample = $default_base_sample;
$unit = $default_unit;
$phase = $default_phase;
$duty = $default_duty;
$duty_rate = $default_duty_rate;
$rate_params = $default_rate_params;
$lost_end = $default_lost_end;
$freq_add = $default_freq_add;

//echo 'base sample='.$base_sample.', unit='.$unit.', phase='.$phase.', rate params='.$rate_params.', lost end='.$lost_end."\n";

if (isset($options['b'])) {
    echo 'base sample='.$base_sample."\n";
}

$lines = preg_split("/\r*\n/", preg_replace('/\/\/.*\r*\n|\/\*[\s\S]*?\*\//', '', file_get_contents($srcfile)));
//var_dump($lines);

foreach ($lines as $args) {
    if (substr($args, 0, 1) === '-') {
        //echo $args."\n";
        $prms = preg_split("/ +/", $args);

        $base_sample = $default_base_sample;
        $unit = $default_unit;
        $phase = $default_phase;
        $duty = $default_duty;
        $duty_rate = $default_duty_rate;
        $rate_params = $default_rate_params;
        $lost_end = $default_lost_end;
        $freq_add = $default_freq_add;

        for($index = 0; $index < count($prms); ++$index) {
            switch ($prms[$index]) {
            case '-b':
                $base_sample = $samples[(int)$prms[++$index]];
                break;

            case '-a':
                $freq_add = (double)$prms[++$index];
                break;

            case '-u':
                $unit = (int)$prms[++$index];
                break;

            case '-p':
                $phase = true;
                $duty = false;
                break;
            case '-p-':
                $phase = false;
                break;

            case '-r':
                $rate_params = true;
                break;
            case '-r-':
                $rate_params = false;
                break;

            case '-l':
                $lost_end = true;
                break;
            case '-l-':
                $lost_end = false;
                break;

            case '-d':
                $duty = true;
                $duty_rate = (double)$prms[++$index];
                $phase = false;
                break;
            case '-d-':
                $duty = false;
                break;

            case '-v':
                $verbose = true;
                break;
            case '-v-':
                $verbose = false;
                break;
            }
        }
        echo 'base sample='.$base_sample.', unit='.$unit.($duty ? ', duty='.$duty_rate: ', phase='.$phase).', rate params='.$rate_params.', lost end='.$lost_end."\n";
        continue;
    }

    $prms = preg_split("/[\s,]+/", $args);
    //var_dump($prms);

    if (count($prms) < 4) continue;

    $begin_level = ($phase) ? 0x3f: 0;
    $end_level = ($phase) ? 0x3f: 0;
    //echo 'level: begin='.$begin_level.', end='.$end_level."\n";

    // name, count, note, octave, offset [, volume, attack, decay, sustain, release]
    $name   = $prms[0];
    $count  = (int)$prms[1];
    $bytes = $count * 16 + 1;
    $length = $bytes * 8;
    $bits = $bytes * 8;
    $sec = $bits / $base_sample;
    $bpf = round($base_sample / $unit, 0);
    $level = $begin_level;
    $bts = '';
    $mod = 0;

    $b = 1;
    $p = 1;
    $c = 0;

    $baseNote = new Note($prms[2]);

    echo $name.": ";
    echo 'base sample='.$base_sample.', octave='.$baseNote->octave.', note='.$baseNote->note.', size='.$count."\n";
    $freq = $baseNote->getFreq($base_sample);

    $range = (int)($freq / 2);
    $steps = (int)($length / $freq);

    echo ' => freq='.$freq.'('.($base_sample/$freq).')'.', range='.$range.', bpf='.$bpf.', sec='.$sec.', bytes='.$bytes.', bits='.$bits;

    if (count($prms) > 4) {
        if ($phase) {
            $d = (int)($range / 2);
            if ($baseNote->octave > 2) $d *= 2;
            $min = 0x40 - $range;
            $max = $min + $range * 2;
            $last = 0x3f;

        } else {
            $d = 0;
            $min = 0;
            $max = $range * 2;
            $last = 0;
        }

        echo ', steps='.$steps.', max='.$max.', min='.$min."\n";

        $action  = 0;
        $step    = 0;
        $volume  = $begin_level;
        $fcount  = $length;

        $start = 3;
        $list = [];
        //$ft = 0;
        $st = 0;
        while (true) {
            if (!isset($prms[$start])) {
                break;
            }

            if(count($list) > 0) {
                $nextNote = new Note($prms[$start++]);
                $env = new Envelope($prms, $start);
                if ($nextNote->note !== null) {
                    $env->freq = $nextNote->getFreq($base_sample);
                } else {
                    $env->freq = $baseNote->getFreq($base_sample) + $nextNote->offset;
                }
                $env->range = (int)($env->freq / 2);

                if ($phase) {
                    $env->min = 0x40 - $env->range;
                } else {
                    $env->min = 0;
                }
                $env->max = $env->min + $env->range * 2;

            } else {
                $env = new Envelope($prms, $start);
                $env->freq = $freq;
                $env->range = $range;
                $env->min = $min;
                $env->max = $max;
            }

            if ($env->volume <= 0) {
                break;
            }
            if ($env->sustain > 0) ++$st;

            $list[] = $env;
        }

        $env_count = count($list);
        foreach ($list as $env) {
            if ($rate_params) {
                $env->setRate($length);
            } else {
                $env->setFrame($base_sample, $unit);
            }
            $fcount -= $env->fcount * $env->freq;
            if ($verbose) echo 'attack='.$env->attack.', decay='.$env->decay.', release='.$env->release.', fcount='.$env->fcount."\n";
        }

        $scount = ($st > 0) ? ($fcount /*- $ft*/) / $st: 0;
        if ($scount < 0) {
            echo '[WARN] scount='.$scount."\n";
            $scount = 0;
        }
        foreach ($list as $env) {
            $env->setSustainCount($scount, ($phase) ? $env->range: $env->range * 2);
        }
        //var_dump($list);

        $env_index = 0;
        $env = $list[$env_index];
        if ($verbose) echo 'loop:'.$env_index.'/'.$env_count."\n";

        $mod_count = 0;

        if ($phase) {
            //echo 'trace: phase.'."\n";

            for ($index = 0; $index < $length; ++$index) {
                $v = $b;
                $s = ($level < 0x40) ? -1 : 1;
                $n = ($level - 0x40) * $s;

                do {
                    $loop = false;

                    switch ($action) {
                    case 0: // attack
                        if ($step < $env->attack) {
                            if ($verbose) echo 'attack: '.$step.':'.'n='.$n.', limit='.(($env->range * ($step + 1) / ($env->attack + 1) - $s) * $env->volume / 100)."\n";
                            if ($n > ($env->range * ($step + 1) / ($env->attack + 1) - $s) * $env->volume / 100) $v = $p ^ 1;
                            break;
                        } else {
                            $step = 0;
                            ++$action;
                        }
                    case 1: // decay
                        if ($step < $env->decay) {
                            if ($verbose) {
                                echo 'decay: '.$step.':'.'n='.$n.', limit='.(($env->sustain + ($env->max - 0x40 - $env->sustain) * ($env->decay - $step) / $env->decay - $s) * $env->volume / 100);
                                echo ' => '.'(('.$env->sustain.' + ('.$env->max.' - 0x40 - '.$env->sustain.') * ('.$env->decay.' - '.$step.') / '.$env->decay.' - '.$s.') * '.$env->volume.' / 100)'."\n";
                            }
                            if ($n > ($env->sustain + ($env->max - 0x40 - $env->sustain) * ($env->decay - $step) / $env->decay - $s) * $env->volume / 100) $v = $p ^ 1;

                            break;
                        } else {
                            $step = 0;
                            ++$action;
                        }
                    case 2: // sustain
                        if ($step < $env->scount) {
                            if ($verbose) {
                                echo 'sustain: '.$step.':'.'n='.$n.', limit='.(($env->sustain - $s) * $env->volume / 100);
                                echo ' => '.'(('.$env->sustain.' - '.$s.') * '.$env->volume.' / 100)'."\n";
                            }
                            if ($n > ($env->sustain - $s) * $env->volume / 100) $v = $p ^ 1;

                            break;
                        } else {
                            $step = 0;
                            ++$action;
                        }
                    case 3: // release
                        if ($step < $env->release) {
                            if ($verbose) {
                                echo 'release: '.$step.':'.'n='.$n.', limit='.((($env->sustain - $s) * ($env->release - $step) / $env->release) * $env->volume / 100); 
                                echo ' => '.'((('.$env->sustain.' - '.$s.') * ('.$env->release.' - '.$step.') / '.$env->release.') * '.$env->volume.' / 100)'."\n"; 
                            }
                            if ($n > (($env->sustain - $s) * ($env->release - $step) / $env->release) * $env->volume / 100) $v = $p ^ 1;
                            break;
                        } else if (++$env_index < $env_count) {
                            if ($verbose) echo 'loop:'.$env_index.'/'.$env_count."\n";
                            $action = 0;
                            $loop = true;
                            $env = $list[$env_index];
                            break;
                        } else {
                            ++$action;
                        }
                    default:
                        $v = ($lost_end) ? 0 : (($volume < $end_level + 2) ? 1: 0);
                        //echo 'volume='.$volume.', end_level='.$end_level."\n";
                        break;
                    }
                } while($loop);

                //echo "action=".$action.", step=".$step.", n=".$n.", b=".$b.", v=".$v."\n";

                $pre = $volume;

                $level  += ($b << 2) - 2;

                $nv = $volume + ($v << 2) - 2;
                if (0 <= $nv && $nv < 128) {
                    $volume = $nv;
                }
                //echo $level."\n";

                $bts .= $v;
                $p    = $v;

                $d += 2;
                if ($d >= $env->freq) {
                    $d -= $env->freq;
                    $b = $c;
                    $c ^= 1;
                    //echo $c." ".$level." ".$index." ".$b."\n";
                }

                if (++$mod_count >= $env->freq) {
                    $mod_count = 0;
                    ++$step;
                    $env->freq += $freq_add;
                }
            }

        } else if ($duty) {

            for ($index = 0; $index < $length; ++$index) {
                $v = $b;
                //$n = $level;
                $n = $volume;

                do {
                    $loop = false;

                    switch ($action) {
                    case 0: // attack
                        if ($step < $env->attack) {
                            if ($verbose) echo 'attack: '.$step.':'.'n='.$n.', limit='.(($env->range * 2 * ($step + 1) / ($env->attack + 1) + $env->min) * $duty_rate * $env->volume / 10000)."\n";
                            if ($n > ($env->range * 2 * ($step + 1) / ($env->attack + 1) + $env->min) * $duty_rate * $env->volume / 10000) $v = $p ^ 1;
                            break;
                        } else {
                            $step = 0;
                            ++$action;
                        }
                    case 1: // decay
                        if ($step < $env->decay) {
                            if ($verbose) echo 'decay: '.$step.':'.'n='.$n.', limit='.(($env->sustain + ($env->max - $env->sustain) * ($env->decay - $step) / $env->decay) * $duty_rate * $env->volume / 10000)."\n";
                            if ($n > ($env->sustain + ($env->max - $env->sustain) * ($env->decay - $step) / $env->decay) * $duty_rate * $env->volume / 10000) $v = $p ^ 1;
                            break;
                        } else {
                            $step = 0;
                            ++$action;
                        }
                    case 2: // sustain
                        if ($step < $env->scount) {
                            if ($verbose) echo 'sustain: '.$step.':'.'n='.$n.', limit='.($env->sustain * $duty_rate * $env->volume / 10000)."\n";
                            if ($n > $env->sustain * $duty_rate * $env->volume / 10000) $v = $p ^ 1;
                            break;
                        } else {
                            $step = 0;
                            ++$action;
                        }
                    case 3: // release
                        if ($step < $env->release) {
                            if ($verbose) echo 'release: '.$step.':'.'n='.$n.', limit='.(($env->sustain * ($env->release - $step) / $env->release) * $duty_rate * $env->volume / 10000)."\n";
                            if ($n > ($env->sustain * ($env->release - $step) / $env->release) * $duty_rate * $env->volume / 10000) $v = $p ^ 1;
                            break;
                        } else if (++$env_index < $env_count) {
                            if ($verbose) echo 'loop:'.$env_index.'/'.$env_count."\n";
                            $action = 0;
                            $loop = true;
                            $env = $list[$env_index];
                            break;
                        } else {
                            ++$action;
                        }
                    default:
                        $v = ($lost_end) ? 0 : (($volume < $end_level + 2) ? 1: 0);
                        break;
                    }
                } while($loop);

                //echo "action=".$action.", step=".$step.", n=".$n.", b=".$b.", v=".$v."\n";

                $pre = $volume;

                $level  += ($b << 2) - 2;

                $nv = $volume + ($v << 2) - 2;
                if (0 <= $nv && $nv < 128) {
                    $volume = $nv;
                }

                $bts .= $v;
                $p    = $v;

                if (++$mod_count >= $env->freq) {
                    $mod_count = 0;
                    $d = 0;
                    $b = $c;
                    $c ^= 1;
                    ++$step;
                    $env->freq += $freq_add;

                } else if ($d == 0) {
                    $duty_edge = round($env->freq * $duty_rate / 200, 0);

                    if ($mod_count >= $duty_edge) {
                        ++$d;
                        $b = $c;
                        $c ^= 1;
                    }
                }
            }

        } else {

            for ($index = 0; $index < $length; ++$index) {
                $v = $b;
                $n = $level;

                do {
                    $loop = false;

                    switch ($action) {
                    case 0: // attack
                        if ($step < $env->attack) {
                            if ($verbose) echo 'attack: '.$step.':'.'n='.$n.', limit='.(($env->range * 2 * ($step + 1) / ($env->attack + 1) + $env->min) * $env->volume / 100)."\n";
                            if ($n > ($env->range * 2 * ($step + 1) / ($env->attack + 1) + $env->min) * $env->volume / 100) $v = $p ^ 1;
                            break;
                        } else {
                            $step = 0;
                            ++$action;
                        }
                    case 1: // decay
                        if ($step < $env->decay) {
                            if ($verbose) echo 'decay: '.$step.':'.'n='.$n.', limit='.(($env->sustain + ($env->max - $env->sustain) * ($env->decay - $step) / $env->decay) * $env->volume / 100)."\n";
                            if ($n > ($env->sustain + ($env->max - $env->sustain) * ($env->decay - $step) / $env->decay) * $env->volume / 100) $v = $p ^ 1;
                            break;
                        } else {
                            $step = 0;
                            ++$action;
                        }
                    case 2: // sustain
                        if ($step < $env->scount) {
                            if ($verbose) echo 'sustain: '.$step.':'.'n='.$n.', limit='.($env->sustain * $env->volume / 100)."\n";
                            if ($n > $env->sustain * $env->volume / 100) $v = $p ^ 1;
                            break;
                        } else {
                            $step = 0;
                            ++$action;
                        }
                    case 3: // release
                        if ($step < $env->release) {
                            if ($verbose) echo 'release: '.$step.':'.'n='.$n.', limit='.(($env->sustain * ($env->release - $step) / $env->release) * $env->volume / 100)."\n";
                            if ($n > ($env->sustain * ($env->release - $step) / $env->release) * $env->volume / 100) $v = $p ^ 1;
                            break;
                        } else if (++$env_index < $env_count) {
                            if ($verbose) echo 'loop:'.$env_index.'/'.$env_count."\n";
                            $action = 0;
                            $loop = true;
                            $env = $list[$env_index];
                            break;
                        } else {
                            ++$action;
                        }
                    default:
                        $v = ($lost_end) ? 0 : (($volume < $end_level + 2) ? 1: 0);
                        break;
                    }
                } while($loop);

                //echo "action=".$action.", step=".$step.", n=".$n.", b=".$b.", v=".$v."\n";

                $pre = $volume;

                $level  += ($b << 2) - 2;

                $nv = $volume + ($v << 2) - 2;
                if (0 <= $nv && $nv < 128) {
                    $volume = $nv;
                }

                $bts .= $v;
                $p    = $v;

                $d += 2;
                if ($d >= $env->freq) {
                    $d -= $freq;
                    $b = $c;
                    $c ^= 1;
                    //echo $c." ".$level." ".$index." ".$b."\n";
                }

                if (++$mod_count >= $env->freq) {
                    $mod_count = 0;
                    ++$step;
                    $env->freq += $freq_add;
                }
            }
        }

    } else {

        $volume = isset($prms[3]) ? (int)$prms[3]: 100;

        if ($phase) {
            $d = (int)($range / 2);
            $min = 0x40 - $range * $volume / 100;
            $max = $min + $range * $volume * 2 / 100;
            $lastTerm = $length + $d - $length % $range;

        } else {
            $d = 0;
            $min = 0;
            $max = $range * $volume * 2 / 100;
            $lastTerm = $length - $length % $freq;
        }

        $last = $end_level;
        $isLast = false;

        echo ', steps='.$steps.', max='.$max.', min='.$min."\n";
        echo 'length='.$length.', last term='.$lastTerm."\n";

        $volume  = $begin_level;
        $step = 0;
        $mod_count = 0;

        for ($index = 0; $index < $length; ++$index) {
            if (!$isLast && $lastTerm < $index) {
                $isLast = true;
                if ($verbose) echo 'last term.'."\n";
            }

            if ($isLast) {
                $v = ($lost_end) ? 0 : (($volume < $last) ? 1: 0);

                $level  += ($b << 2) - 2;
                $volume += ($v << 2) - 2;

                if ($verbose) echo 'L:';

            } else {
                $v = $b;
                $pre = $volume;

                if ($volume < $min) {
                    $v = 1;
                    if ($verbose) echo 'Min:';

                } else if ($volume > $max) {
                    $v = 0;
                    if ($verbose) echo 'Max:';
                }

                $level  += ($b << 2) - 2;
                $volume += ($v << 2) - 2;

                if ($volume < 0) {
                    //$volume = 0;
                    $volume = $pre;
                    if ($verbose) echo 'Low:';

                } else if ($volume > 127) {
                    //$volume = 127;
                    $volume = $pre;
                    if ($verbose) echo 'High:';
                }

                if ($max > 127 && $level < $volume && $b > 0) {
                    $v = 0;
                    $volume = $pre;
                    if ($verbose) echo 'U:';
                } else if ($min < 0 && $volume < $level && $b == 0) {
                    $v = 1;
                    $volume = $pre;
                    if ($verbose) echo 'T:';
                }
            }
            if ($verbose) echo 'level='.$level.',volume='.$volume.',max='.$max.',min='.$min.',last='.$last.',b='.$b.',v='.$v."\n";

            $bts .= $v;
            $p    = $v;

            $d += 2;
            if ($d >= $freq) {
                $d -= $freq;
                $b = $c;
                $c ^= 1;
                if ($verbose) echo $c." ".$level." ".$index." ".$b."\n";
            }

            if (++$mod_count >= $freq) {
                $mod_count = 0;
                ++$step;
                $freq += $freq_add;
            }
        }
    }
    //var_dump($bts);

    if (isset($options['s'])) {
        $outfile = !isset($options['o']) ?
            'php://stdout' : (($options['o']) ? $options['o'] : $name.'.bts');
        $contents = '// 0-------1-------2-------3-------4-------5-------6-------7-------8-------9-------A-------B-------C-------D-------E-------F-------';
        $array = str_split($bts, 16*8);
        foreach ($array as $line) {
            $contents .= "\n   ".$line;
        }

    } else {
        $outfile = !isset($options['o']) ?
            'php://stdout' : (($options['o']) ? $options['o'] : $name.'.dmc');
        $contents = '';
        $array = str_split($bts, 8);
        foreach ($array as $index => $bits) {
            //echo "{$index}: {$bits} => ";
            $byte = str_split($bits, 1);
            $b  = (int)$byte[7]; $b <<= 1;
            $b |= (int)$byte[6]; $b <<= 1;
            $b |= (int)$byte[5]; $b <<= 1;
            $b |= (int)$byte[4]; $b <<= 1;
            $b |= (int)$byte[3]; $b <<= 1;
            $b |= (int)$byte[2]; $b <<= 1;
            $b |= (int)$byte[1]; $b <<= 1;
            $b |= (int)$byte[0];
            //echo "{$b}\n";

            $contents .= pack('C', $b);
        }
    }

    file_put_contents($outfile, $contents);

    echo "\n";
}
