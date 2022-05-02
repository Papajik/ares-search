<?php

namespace Papajik\AresSearch\Classes;

use DateTime;

class RssItem
{
    private string $title;
    private DateTime $pubDate;
    private int $id;

    /**
     * @param int $id
     * @param string $title
     * @param DateTime $pubDate
     */
    public function __construct(int $id, string $title, DateTime $pubDate)
    {
        $this->title = $title;
        $this->pubDate = $pubDate;
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return DateTime
     */
    public function getPubDate(): DateTime
    {
        return $this->pubDate;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


}