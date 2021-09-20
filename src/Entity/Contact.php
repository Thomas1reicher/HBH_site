<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 */
class Contact
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $objet;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $societe;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $telephone;

    /**
     * @ORM\Column(type="boolean", length=10)
     */
    private $rgpd;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $message;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObjet(): ?string
    {
        return $this->objet;
    }

    public function setObjet(string $objet): self
    {
        $this->objet = $objet;
        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function setSociete(string $societe): self
    {
        $this->societe = $societe;
        return $this;
    }

    public function getSociete(): ?string
    {
        return $this->societe;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;
        return $this;
    }

    public function getRgpd(): ?bool
    {
        return $this->rgpd;
    }

    public function setRgpd(bool $rgpd): self
    {
        $this->rgpd = $rgpd;
        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

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
        $r = new \ReflectionClass(static::class); 
        $newTbl =get_class_vars(get_class($this));
        $newTbl1 =array_keys($newTbl);
        /*foreach ($newTbl as $key => $value) {
            $prop = $r->getProperty($key);
            $type = $prop->getType();
            var_dump($prop); 
        }*/
        foreach ($newTbl1 as $key => $value) {
            var_dump(gettype($this->{$value}));

        }
 
        return $tbl;


    }
    public function val() :array
    {
    
       $tbl = [];
        $tbl[0]=$this->getPrenom();
        $tbl[1]=$this->getNom();
        $tbl[2]=$this->getMail();
        $tbl[3]=$this->getSociete();
        $tbl[4]=$this->getTel();
        $tbl[5]=$this->getInfoComp();
        $tbl[6]=$this->getToken();

        
        return $tbl;


    }
}
