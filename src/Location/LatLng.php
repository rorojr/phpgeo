<?php
declare(strict_types=1);

namespace Location;

/**
 * @author   winky
 */
class LatLng
{
    const RC = 6378137;
    const RJ = 6356725;

    public $lngDeg;
    public $lngMin;
    public $lngSec;

    public $latDeg;
    public $latMin;
    public $latSec;

    public $longitude;
    public $latitude;

    public $radLng;
    public $radLat;

    public $EC;
    public $ED;
    /**
     * @param float $latitude -90.0 .. +90.0
     * @param float $longitude -180.0 .. +180.0
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(float $latitude, float $longitude)
    {
        if (! $this->isValidLatitude($latitude)) {
            throw new \InvalidArgumentException("Latitude value must be numeric -90.0 .. +90.0 (given: {$latitude})");
        }

        if (! $this->isValidLongitude($longitude)) {
            throw new \InvalidArgumentException("Longitude value must be numeric -180.0 .. +180.0 (given: {$longitude})");
        }

        $this->lngDeg = (int)$longitude;
        $this->lngMin = (int)(($longitude - $this->lngDeg) * 60);
        $this->lngSec = ($longitude - $this->lngDeg - $this->lngMin / 60.) * 3600;

        $this->latDeg = (int)$latitude;
        $this->latMin = (int)(($latitude - $this->latDeg) * 60);
        $this->latSec = ($latitude - $this->latDeg - $this->latMin / 60.) * 3600;

        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->radLng = $longitude * M_PI / 180.;
        $this->radLat = $latitude * M_PI / 180.;
        $this->EC = self::RJ + (self::RC - self::RJ) * (90. - $this->latitude) / 90.;
        $this->ED = $this->EC * cos($this->radLat);
    }

    /**
     * @return float
     */
    public function getLat(): float
    {
        return $this->latitude;
    }

    /**
     * @return float
     */
    public function getLng(): float
    {
        return $this->longitude;
    }

    /**
     * Validates latitude
     *
     * @param float $latitude
     *
     * @return bool
     */
    protected function isValidLatitude(float $latitude): bool
    {
        return $this->isNumericInBounds($latitude, -90.0, 90.0);
    }

    /**
     * Validates longitude
     *
     * @param float $longitude
     *
     * @return bool
     */
    protected function isValidLongitude(float $longitude): bool
    {
        return $this->isNumericInBounds($longitude, -180.0, 180.0);
    }

    /**
     * Checks if the given value is (1) numeric, and (2) between lower
     * and upper bounds (including the bounds values).
     *
     * @param float $value
     * @param float $lower
     * @param float $upper
     *
     * @return bool
     */
    protected function isNumericInBounds(float $value, float $lower, float $upper): bool
    {
        if ($value < $lower || $value > $upper) {
            return false;
        }

        return true;
    }
}
