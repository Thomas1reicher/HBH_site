<?php

namespace App\Entity;

use App\Repository\BddCmsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BddCmsRepository::class)
 */
class BddCms
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
    private $name;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $icon;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color;
  /**
     * @ORM\Column(type="integer")
     */
    private $div_num;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param mixed $icon
     */
    public function setIcon($icon): void
    {
        $this->icon = $icon;
    }
    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }
    public function getDivNum(): ?int
    {
        return $this->div_num;
    }
    public function setDivNum(int $num): self
    {
        $this->div_num = $num;

        return $this;
    }
    
}
