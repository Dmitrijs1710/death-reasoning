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

    public function add(Death $element) :void{
        $this->deaths[] = $element;
    }

    public function getDeathsByKey(string $key): ?Death
    {
        foreach($this->deaths as $death){
            if ($death->getId()===$key){
                return $death;
            }
        }
        return null;
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
                $result[] = $death;
            }
        }
        return $result;
    }

    public function getAllDeaths(): array
    {
        return $this->deaths;
    }


    public function filterDeaths(?string $date = null, ?string $reason = null, ?string $circumstance = null, ?string $type = null): ?array
    {
        if(!empty($reason))
        {
            $result = $this->getDeathsByReason($reason);
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


        if(!empty($circumstance))
        {
            foreach ($result as $key=>$death)
            {
                if (!$death instanceof Accident)
                {
                    unset($result[$key]);
                } else if(strpos(strtolower(implode('', $death->getCircumstances())), strtolower($circumstance)) === false)
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