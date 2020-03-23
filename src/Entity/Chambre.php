<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChambreRepository")
 */
class Chambre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Hospital", inversedBy="chambre")
     * @ORM\JoinColumn(nullable=false)
     */
    private $hospital;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Admission", mappedBy="chambre")
     */
    private $admissions;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $capacite;

    public function __toString(){
        return $this->getNom();
       
    }
    public function __construct()
    {
        $this->admissions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

   

    public function getHospital(): ?Hospital
    {
        return $this->hospital;
    }

    public function setHospital(?Hospital $hospital): self
    {
        $this->hospital = $hospital;

        return $this;
    }

    /**
     * @return Collection|Admission[]
     */
    public function getAdmissions(): Collection
    {
        return $this->admissions;
    }

    public function addAdmission(Admission $admission): self
    {
        if (!$this->admissions->contains($admission)) {
            $this->admissions[] = $admission;
            $admission->setChambre($this);
        }

        return $this;
    }

    public function removeAdmission(Admission $admission): self
    {
        if ($this->admissions->contains($admission)) {
            $this->admissions->removeElement($admission);
            // set the owning side to null (unless already changed)
            if ($admission->getChambre() === $this) {
                $admission->setChambre(null);
            }
        }

        return $this;
    }

    public function getCapacite(): ?int
    {
        return $this->capacite;
    }

    public function setCapacite(?int $capacite): self
    {
        $this->capacite = $capacite;

        return $this;
    }
}
