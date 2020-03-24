<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PatientRepository")
 */
class Patient
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Admission", mappedBy="patient")
     */
    private $admissions;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $avsNum;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $birthdate;

    public function __toString(){
        return $this->getNom() . $this->getPrenom();

        
       
    }
    public function __construct()
    {
        $this->admissions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $admission->setPatient($this);
        }

        return $this;
    }

    public function removeAdmission(Admission $admission): self
    {
        if ($this->admissions->contains($admission)) {
            $this->admissions->removeElement($admission);
            // set the owning side to null (unless already changed)
            if ($admission->getPatient() === $this) {
                $admission->setPatient(null);
            }
        }

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAvsNum(): ?string
    {
        return $this->avsNum;
    }

    public function setAvsNum(string $avsNum): self
    {
        $this->avsNum = $avsNum;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(?\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }
}
