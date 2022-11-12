<?php
class Accident extends Death {
    protected array $circumstances;
    public function __construct(string $id,string $date, string $reason,array $circumstances)
    {
        parent::__construct($id, $date, $reason);
        $this->circumstances = $circumstances;
    }

    public function __toString()
    {
        return parent::__toString() . ' | circumstances: ' . implode('; ', $this->circumstances);
    }

    public function getCircumstances(): array
    {
        return $this->circumstances;
    }

}