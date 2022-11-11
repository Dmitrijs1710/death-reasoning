<?php
class Killed extends Accident
{
    private array $type;
    public function __construct(string $date, string $reason, array $conditions, array $type)
    {
        parent::__construct($date, $reason,$conditions);
        $this->type = $type;
    }


    public function getType(): array
    {
        return $this->type;
    }


    public function __toString()
    {
        return parent::__toString() . ' | types: ' . (implode('; ', $this->type));
    }

}