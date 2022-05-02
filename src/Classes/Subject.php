<?php

namespace Papajik\AresSearch\Classes;

class Subject
{
    private string $ico;
    private string $dic;
    private string $name;
    private string $creation_date;
    private DeliveryAddress $deliveryAddress;
    private string $search_date;


    public function __construct(string $ico, string $dic, string $name, string $creation_date, DeliveryAddress $deliveryAddress, string $search_date)
    {
        $this->ico = $ico;
        $this->dic = $dic;
        $this->name = $name;
        $this->creation_date = $creation_date;
        $this->deliveryAddress = $deliveryAddress;
        $this->search_date = $search_date;
    }


    public function toArray(): array
    {
        $arr = get_object_vars($this);
        $arr['deliveryAddress'] = $this->deliveryAddress->toArray();
        return $arr;
    }

    public function __toString(): string
    {
        return json_encode(get_object_vars($this));
    }

    /**
     * @return string
     */
    public function getIco(): string
    {
        return $this->ico;
    }

    /**
     * @return string
     */
    public function getDic(): string
    {
        return $this->dic;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return DeliveryAddress
     */
    public function getDeliveryAddress(): DeliveryAddress
    {
        return $this->deliveryAddress;
    }

    /**
     * @return string
     */
    public function getCreationDate(): string
    {
        return $this->creation_date;
    }

    /**
     * @return string
     */
    public function getSearchDate(): string
    {
        return $this->search_date;
    }



}