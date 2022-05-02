<?php

namespace Papajik\AresSearch\Classes;

class DeliveryAddress
{
   private string $street;
   private string $city;

   public function __construct(string $street, string $city)
   {
       $this->street = $street;
       $this->city = $city;
   }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function __toString(): string
    {
        return json_encode(get_object_vars($this));
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }


}