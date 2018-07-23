<?php
declare(strict_types=1);

/**
 * Angle
 *
 * @author    winky <winky616@gmail.com>
 */

namespace Location;

class Angle
{

    /**
     * @param LatLng $pointA
     * @param LatLng $pointB
     * @return float|int
     */
    public function getAngle(LatLng $pointA, LatLng $pointB)
    {
        $dx = (float)($pointB->radLng - $pointA->radLng) * $pointA->ED;
        $dy = (float)($pointB->radLat - $pointA->radLat) * $pointA->EC;
        $angle = (float)0.0;
        $angle = atan(abs($dx / $dy)) * 180. / M_PI;

        $dLo = (float)$pointB->longitude - $pointA->longitude;
        $dLa = (float)$pointB->latitude - $pointA->latitude;

        if ($dLo > 0 && $dLa <= 0) {
            $angle = (90. - $angle) + 90;
        } else if ($dLo <= 0 && $dLa < 0) {
            $angle = $angle + 180.;
        } else if ($dLo < 0 && $dLa >= 0) {
            $angle = (90. - $angle) + 270;
        }
        return $angle;
    }


}

