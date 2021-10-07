<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=ProjetRepository::class)
 */
class Projet
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_publication;
  

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titre_1;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $text_1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titre_2;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $text_2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $maitreouvrage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type_marche;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $budget;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $architecte;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $delais;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fin_travaux;
      /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="projet")
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getTitre1(): ?string
    {
        return $this->titre_1;
    }

    public function setTitre1(?string $titre_1): self
    {
        $this->titre_1 = $titre_1;

        return $this;
    }

    public function getText1(): ?string
    {
        return $this->text_1;
    }

    public function setText1(?string $text_1): self
    {
        $this->text_1 = $text_1;

        return $this;
    }

    public function getTitre2(): ?string
    {
        return $this->titre_2;
    }

    public function setTitre2(?string $titre_2): self
    {
        $this->titre_2 = $titre_2;

        return $this;
    }

    public function getText2(): ?string
    {
        return $this->text_2;
    }

    public function setText2(?string $text_2): self
    {
        $this->text_2 = $text_2;

        return $this;
    }

    public function getMaitreouvrage(): ?string
    {
        return $this->maitreouvrage;
    }

    public function setMaitreouvrage(?string $maitreouvrage): self
    {
        $this->maitreouvrage = $maitreouvrage;

        return $this;
    }

    public function getTypeMarche(): ?string
    {
        return $this->type_marche;
    }

    public function setTypeMarche(?string $type_marche): self
    {
        $this->type_marche = $type_marche;

        return $this;
    }

    public function getBudget(): ?string
    {
        return $this->budget;
    }

    public function setBudget(?string $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    public function getArchitecte(): ?string
    {
        return $this->architecte;
    }

    public function setArchitecte(?string $architecte): self
    {
        $this->architecte = $architecte;

        return $this;
    }

    public function getDelais(): ?string
    {
        return $this->delais;
    }

    public function setDelais(?string $delais): self
    {
        $this->delais = $delais;

        return $this;
    }

    public function getFinTravaux(): ?string
    {
        return $this->fin_travaux;
    }

    public function setFinTravaux(?string $fin_travaux): self
    {
        $this->fin_travaux = $fin_travaux;

        return $this;
    }

/**
     * @return Collection|Test[]
     */
    public function getImages(): ?Collection
    {
        return $this->images;
    }

    public function addImages(Image $image): self
    {
            $this->images[] = $image;   
            $image->setProjet($this);
        

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
        $newTbl =get_class_vars(get_class($this));
        $newTbl =array_keys($newTbl);
      

        return $newTbl;


    }
    public function typeVars() :array
    {
     $tbl = [];
     $tbl[0]= "int";
     $tbl[1]= "string";
     $tbl[2]= "date";
     $tbl[3]= "img";
     $tbl[4]= "textarea";
     $tbl[5]= "string";
     $tbl[6]= "textarea";
     $tbl[7]= "string";
     $tbl[8]= "string";
     $tbl[9]= "string";
     $tbl[10]= "string";
     $tbl[11]= "string";
     $tbl[12]= "string";
     $tbl[13]= "string";
     return $tbl;
    }
    public function val() :array
    {
    
       $tbl = [];
        $tbl[0]=$this->getId();
        $tbl[1]=$this->getTitre();
        $tbl[2]=$this->getImage();
        $tbl[3]=$this->getDatePublication()->format('Y-m-d');
        $tbl[4]=$this->getTitre1();
        $tbl[5]=$this->getText1();
        $tbl[6]=$this->getTitre2();
        $tbl[7]=$this->getText2();
        $tbl[8]=$this->getMaitreouvrage();
        $tbl[9]=$this->getTypeMarche();
        $tbl[10]=$this->getBudget();
        $tbl[11]=$this->getArchitecte();
        $tbl[12]=$this->getDelais();
        $tbl[13]=$this->getFinTravaux();
       
        return $tbl;


    }
    public function __toString()
    {
        // TODO: Implement __toString() method.

       /* $tbl=$this->getEmail()."-".$this->getFullName().'-'.$this->getPassword().'-'.$this->getUsername();
        */return "";
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

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setProjet($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getProjet() === $this) {
                $image->setProjet(null);
            }
        }

        return $this;
    }
}
