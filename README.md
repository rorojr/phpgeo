# phpgeo

author Marcus Jaschen <mjaschen@gmail.com>
github https://github.com/mjaschen/phpgeo  

develop on this basis, add angle between two points.
Thanks Jaschen. 

phpgeo documentation see https://github.com/mjaschen/phpgeo  


## Angle
```php
<?php

use Location\LatLng;
use Location\Angle;

$A = new LatLng(116.431973, 39.92031);
$B = new LatLng(116.469567,39.921495);

$angle = new Angle();


$angle->getAngle($A, $B); // returns 87.646479487294
```
