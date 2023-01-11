# DmcTools-PHP

PHP で記述した DMC 用の雑多なツール。

Miscellaneous tools for DMC written in PHP.


## dmc.php

パラメータ指定で DMC ファイルを生成する。

Generate DMC file by specifying parameters.

~~~
php dmc.php [-f config file] [-o]
~~~

パラメータ指定の詳細は、dmc.conf.sample を参照してください。

See dmc.conf.sample for details on specifying parameters.


## dmc2bts.php

DMC ファイルの内容をビット単位でテキストに変換する。

Converts the contents of a DMC file to bitwise text.

~~~
php dmc2bts.php [-f DMC file] [-o BTS file]
~~~


## dmc2grp.php

DMC ファイルの内容をテキストグラフに変換する。

Convert the contents of a DMC file to a text graph.

~~~
php dmc2grp.php [-f DMC file] [-o GRP file]
~~~


## bts2dmc.php

ビット単位のテキストを DMC ファイルに変換する。

Convert bitwise text to a DMC file.

~~~
php bts2dmc.php [-f BTS file] [-o DMC file]
~~~


## bts2grp.php

ビット単位のテキストをテキストグラフに変換する。

Convert bitwise text to a text graph.

~~~
php bts2grp.php [-l Start level (0-127)] [-f BTS file] [-o GRP file]
~~~


## grp2dmc.php

テキストグラフを DMC ファイルに変換する。

Convert a text graph to a DMC file.

~~~
php grp2dmc.php [-f GRP file] [-o DMC file]
~~~


## License
Copyright 2023 @MIRROR_  
Distributed under the [MIT].  

[MIT]: http://www.opensource.org/licenses/mit-license.php "MIT License"
