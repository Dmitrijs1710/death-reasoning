<?php
class Killed extends Accident
{
    private array $type;
    public function __construct(string $id, string $date, string $reason, array $circumstances, array $type)
    {
        parent::__construct($id, $date, $reason,$circumstances);
        $this->type = $type;
    }


    public function getType(): array
    {
        return $this->type;
    }


    public function __toString()
    {
        return parent::__toString() . ' | type of death: ' . (implode('; ', $this->type));
    }

}