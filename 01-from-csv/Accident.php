<?php
class Accident extends Death {
    protected array $conditions;
    public function __construct(string $date, string $reason,array $conditions)
    {
        parent::__construct($date, $reason);
        $this->conditions = $conditions;
    }

    public function __toString()
    {
        return parent::__toString() . ' | conditions: ' . implode('; ', $this->conditions);
    }

    public function getConditions(): array
    {
        return $this->conditions;
    }

}