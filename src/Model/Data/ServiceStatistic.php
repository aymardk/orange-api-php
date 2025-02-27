<?php

namespace Aymardk\OrangeApiPhp\Model\Data;

/**
 * @deprecated
 */
class ServiceStatistic
{
    public ?string $country;
    public ?array $countryStatistics = [];

    public function __construct(array $args = [])
    {
        if (array_key_exists('country', $args)) {
            $this->country = $args['country'];
        }
        if (array_key_exists('countryStatistics', $args)) {
            foreach ($args['countryStatistics'] as $countryStatistic) {
                $this->countryStatistics[] = new CountryStatistic($countryStatistic);
            }
        }
    }
}