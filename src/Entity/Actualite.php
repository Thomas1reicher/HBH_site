<?php

namespace App\Entity;

use App\Repository\ActualiteRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=ActualiteRepository::class)
 */
class Actualite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_publication;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $text;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pdf;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;
        /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="actualite")
     */
    private $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->date_publication;
    }

    public function setDatePublication(?\DateTimeInterface $date_publication): self
    {
        $this->date_publication = $date_publication;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getPdf(): ?string
    {
        return $this->pdf;
    }

    public function setPdf(?string $pdf): self
    {
        $this->pdf = $pdf;

        return $this;
    }

      /**
     * @return Collection|Test[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImages(Image $images): self
    {
        if (!$this->taux->contains($images)) {
           
        }

        return $this;
    }

    public function removeImages(Image $images): self
    {
        if ($this->tests->removeElement($images)) {
            // set the owning side to null (unless already changed)
            
        }

        return $this;
    }
    public function vars() :array
    {
        $tbl = [];
        $tbl[0]= "id";
        $tbl[1]= "titre";
        $tbl[2]= "date_publication";
        $tbl[3]= "text";
        $tbl[4]= "pdf";
        $tbl[5]= "images";

        return $tbl;


    }
    public function typeVars() :array
    {
     $tbl = [];
     $tbl[0]= "int";
     $tbl[1]= "String";
     $tbl[2]= "date";
     $tbl[3]= "textarea";
     $tbl[4]= "string";
     $tbl[5]= "image";
     return $tbl;
    }
    public function val() :array
    {
    
       $tbl = [];
        $tbl[0]=$this->getId();
        $tbl[1]=$this->getTitre();
        $tbl[2]=$this->getDatePublication()->format('Y-m-d');
        $tbl[3]=$this->getText();
        $tbl[4]=$this->getPdf();
    
        
        return $tbl;


    }
    public function __toString()
    {
        // TODO: Implement __toString() method.

       /* $tbl=$this->getEmail()."-".$this->getFullName().'-'.$this->getPassword().'-'.$this->getUsername();
        */return "";
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setActualite($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getActualite() === $this) {
                $image->setActualite(null);
            }
        }

        return $this;
    }

}
