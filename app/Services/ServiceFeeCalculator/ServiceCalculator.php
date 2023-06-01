<?php

namespace App\Services\ServiceFeeCalculator;

/**
 * Class ServiceCalculator
 * @package App\Services\ServiceFeeCalculator
 */
class ServiceCalculator
{

    private const SHIPPING_DISTANCE_LIMIT = 16;

    private const BASE_RATE = 45.00;

    private const RATE_PER_KM = 6.00;

    /**
     * @var array
     */
    private $priceRange = [];

    /**
     * @var float
     */
    private $distance = 0.00;

    /**
     * @var string
     */
    private $unitOfMeasurement = '';


    /**
     * @param float $distance
     * @param string $unitOfMeasurement
     */
    public function __construct(float $distance, string $unitOfMeasurement)
    {
        $rate = self::BASE_RATE;
        for ($base = 0; $base < self::SHIPPING_DISTANCE_LIMIT; $base++) {
            $this->priceRange[] = [
                'distance' => [
                    'min' => (float)$base,
                    'max' => (float)$base + 1
                ],
                'fee' => $rate
            ];
            $rate += self::RATE_PER_KM;
        }

        $this->distance = $distance;
        $this->unitOfMeasurement = $unitOfMeasurement;
    }

    /**
     * @return float
     */
    public function serviceFee(): float
    {
        if (strtolower($this->unitOfMeasurement) === 'km') {
            foreach ($this->priceRange as $priceRange) {
                if ($this->distance >= $priceRange['distance']['min'] &&
                    $this->distance < $priceRange['distance']['max']
                ) {
                    return $priceRange['fee'];
                }
            }
        }

        return 0.00;
    }
}
