<?php

class Death
{
    protected string $id;
    protected string $date;
    protected string $reason;
    public function __construct(string $id,string $date,string $reason)
    {
        $this->id = $id;
        $this->date = $date;
        $this->reason = $reason;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }
    public function __toString()
    {
        return "$this->id | date: $this->date | reason: $this->reason";
    }

    /**
     * @return string
     */
    public function getReason(): string
    {
        return $this->reason;
    }


    public function getId(): string
    {
        return $this->id;
    }
}




