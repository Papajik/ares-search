<?php

namespace Papajik\AresSearch\Classes;

use DateTime;

class RssDetailItem
{
    private string $address;
    private string $district;
    private string $postal_code;
    private string $phone;
    private string $city;
    private string $country;

    private DateTime $address_update;
    private DateTime $city_update;
    private DateTime $country_update;

    /**
     * @param string $address
     * @param string $district
     * @param string $postal_code
     * @param string $phone
     * @param string $city
     * @param string $country
     * @param DateTime $address_update
     * @param DateTime $city_update
     * @param DateTime $country_update
     */
    public function __construct(string   $address,
                                string   $district,
                                string   $postal_code,
                                string   $phone,
                                string   $city,
                                string   $country,
                                DateTime $address_update,
                                DateTime $city_update,
                                DateTime $country_update)
    {
        $this->address = $address;
        $this->district = $district;
        $this->postal_code = $postal_code;
        $this->phone = $phone;
        $this->city = $city;
        $this->country = $country;
        $this->address_update = $address_update;
        $this->city_update = $city_update;
        $this->country_update = $country_update;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getDistrict(): string
    {
        return $this->district;
    }

    /**
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->postal_code;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @return DateTime
     */
    public function getAddressUpdate(): DateTime
    {
        return $this->address_update;
    }

    /**
     * @return DateTime
     */
    public function getCityUpdate(): DateTime
    {
        return $this->city_update;
    }

    /**
     * @return DateTime
     */
    public function getCountryUpdate(): DateTime
    {
        return $this->country_update;
    }


}