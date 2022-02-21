<?php
namespace App\Entity;

 class DestinationSearch{
     /**
      * @var int|null
      */
     private $maxPopulation;
     /**
      * @var int|null
      */
     private $minSurface;
     /**
      * @var string|null
      */
     private $nom;

     /**
      * @return int|null
      */
     public function getMaxPopulation(): ?int
     {
         return $this->maxPopulation;
     }

     /**
      * @param int|null $maxPopulation
      * @return DestinationSearch
      */
     public function setMaxPopulation(int $maxPopulation): DestinationSearch
     {
         $this->maxPopulation = $maxPopulation;
         return $this;
     }

     /**
      * @return int|null
      */
     public function getMinSurface(): ?int
     {
         return $this->minSurface;
     }

     /**
      * @param int|null $minSurface
      * @return DestinationSearch
      */
     public function setMinSurface(int $minSurface): DestinationSearch
     {
         $this->minSurface = $minSurface;
         return $this;
     }

     /**
      * @return string|null
      */
     public function getNom(): ?string
     {
         return $this->nom;
     }

     /**
      * @param string|null $nom
      * @return DestinationSearch
      */
     public function setNom(string $nom): DestinationSearch
     {
         $this->nom = $nom;
         return $this;
     }

 }