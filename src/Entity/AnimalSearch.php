<?php


namespace App\Entity;

class AnimalSearch
{
    private $animalSearch;

    /**
     * @return string|null
     */
    public function getAnimalSearch(): ?string
    {
        return $this->animalSearch;
    }

    /**
     * @param string|null $animalSearch
     */
    public function setAnimalSearch(?string $animalSearch): void
    {
        $this->animalSearch = $animalSearch;
    }
}
