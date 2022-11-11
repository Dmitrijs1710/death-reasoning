<?php

class DeathCollection
{
    private array $deaths;

    public const KILLED="Vardarbīga nāve";

    public const ACCIDENT="Nevardarbīga nāve";

    public const UNKNOWN="Nāves cēlonis nav noteikts";

    public function __construct()
    {
        $this->deaths = [];
    }

    public function add(string $key, Death $element) :void{
        $this->deaths[$key] = $element;
    }

    public function getDeathsByKey(string $key): ?Death
    {
        return $this->deaths[$key]?? null;
    }

    public function getDeathsByDate(string $date): array{
        $result = [];
        foreach ($this->deaths as $key=>$death){
            if(strpos($death->getDate(), $date)!==false)
            {
                $result[$key] = $death;
            }
        }
        return $result;
    }

    public function getDeathsByReason(string $reason): array{
        $result = [];
        foreach ($this->deaths as $key=>$death){
            if(strpos(strtolower($death->getReason()), strtolower($reason))===0)
            {
                $result[$key] = $death;
            }
        }
        return $result;
    }

    public function getAllDeaths(): array
    {
        return $this->deaths;
    }


    public function filterDeaths(?string $date = null, ?string $deathType = null, ?string $condition = null, ?string $type = null): ?array
    {
        if(!empty($deathType))
        {
            $result = $this->getDeathsByReason($deathType);
        } else {
            $result = $this->getAllDeaths();
        }


        if(!empty($date))
        {
            foreach ($result as $key=>$death)
            {
                if($death->getDate()!==$date)
                {
                    unset($result[$key]);
                }
            }
        }


        if(!empty($condition))
        {
            foreach ($result as $key=>$death)
            {
                if (!$death instanceof Accident)
                {
                    unset($result[$key]);
                } else if(strpos(strtolower(implode('', $death->getConditions())), strtolower($condition)) === false)
                {
                    unset($result[$key]);
                }
            }
        }

        if(!empty($type))
        {
            foreach ($result as $key=>$death)
            {
                if (!$death instanceof Killed)
                {
                    unset($result[$key]);
                } else if(strpos(strtolower(implode('', $death->getType())), strtolower($type)) === false)
                {
                    unset($result[$key]);
                }
            }
        }
        return $result;
    }
}