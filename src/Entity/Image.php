<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 */
class Image
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom_img;
        /**
         * @ORM\ManyToOne(targetEntity=Actualite::class, inversedBy="images")
         */
        private $actualite;

             /**
         * @ORM\ManyToOne(targetEntity=Projet::class, inversedBy="images")
         */
        private $projet;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomImg(): ?string
    {
        return $this->nom_img;
    }

    public function setNomImg(?string $nom_img): self
    {
        $this->nom_img = $nom_img;

        return $this;
    }
    public function getActualite(): ?object
    {
        return $this->actualite;
    }

    public function setActualite(Actualite $actualite): self
    {
        $this->actualite = $actualite;

        return $this;
    }
    public function getProjet(): ?object
    {
        return $this->projet;
    }

    public function setProjet(Projet $projet): self
    {
        $this->projet = $projet;

        return $this;
    }
    public function vars() :array
    {
        $newTbl =[];
        $newTbl[0]="nom_img"; 
      

        return $newTbl;


    }
    public function typeVars() :array
    {
     $tbl = [];
     $tbl[0]="img";

     return $tbl;
    }
    public function val() :array
    {
    
       $tbl = [];
        $tbl[0]=$this->getNomImg();
       
        return $tbl;


    }
    public function __toString()
    {
        // TODO: Implement __toString() method.

       /* $tbl=$this->getEmail()."-".$this->getFullName().'-'.$this->getPassword().'-'.$this->getUsername();
        */return "";
    }
}
