# phpxhprof
php 性能分析
```
<?php

require 'vendor/autoload.php';

//\king192\phpxhprof\xhprof::test();
\king192\phpxhprof\xhprof::enable();
var_dump(true);
for ($i=0; $i < 5; $i++) { 
	echo $i;
}
tttt();
$link = \king192\phpxhprof\xhprof::disable();
echo $link;

function tttt() {
	sleep(3);
	echo '复制链接访问会有惊喜：';
}
```
