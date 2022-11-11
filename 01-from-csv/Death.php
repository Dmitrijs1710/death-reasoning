<?php

class Death
{
    protected string $date;
    protected string $reason;
    public function __construct(string $date,string $reason)
    {
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
        return "date: $this->date | reason: $this->reason";
    }

    /**
     * @return string
     */
    public function getReason(): string
    {
        return $this->reason;
    }
}




