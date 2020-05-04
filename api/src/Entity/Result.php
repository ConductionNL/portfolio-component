<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;

use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}}
 *
 * )
 *
 * @ORM\Entity(repositoryClass="App\Repository\ResultsRepository")
 * @Gedmo\Loggable(logEntryClass="App\Entity\ChangeLog")
 *
 * @ApiFilter(BooleanFilter::class)
 * @ApiFilter(OrderFilter::class)
 * @ApiFilter(DateFilter::class, strategy=DateFilter::EXCLUDE_NULL)
 * @ApiFilter(SearchFilter::class)
 */
class Result
{
    /**
     * @var UuidInterface The UUID identifier of this object
     *
     * @example e2984465-190a-4562-829e-a8cca81aa35d
     *
     * @Groups({"read"})
     * @Assert\Uuid
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @var string Name of the Results
     *
     * @example Result name
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *     max = 255
     * )
     * @Assert\NotNull
     */
    private $name;

    /**
     * @var string Description of the results
     *
     * @example description of the results
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=2550)
     * @Assert\Length(
     *     max = 2550
     * )
     * @Assert\NotNull
     */
    private $description;

    /**
     * @Groups({"read","write"})
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="result")
     * @MaxDepth(1)
     */
    private $products;

    /**
     * @Groups({"read","write"})
     * @ORM\OneToMany(targetEntity="App\Entity\Activity", mappedBy="result")
     * @MaxDepth(1)
     */
    private $activities;

    /**
     * @Groups({"read","write"})
     * @ORM\OneToMany(targetEntity="App\Entity\Evaluation", mappedBy="result")
     * @MaxDepth(1)
     */
    private $evaluations;

    /**
     * @Groups({"read","write"})
     * @ORM\OneToMany(targetEntity="App\Entity\FormalRecognition", mappedBy="result")
     * @MaxDepth(1)
     */
    private $formalRecognitions;

    /**
     * @Groups({"read","write"})
     * @ORM\OneToMany(targetEntity="App\Entity\Reflection", mappedBy="result")
     * @MaxDepth(1)
     */
    private $reflections;

    /**
     * @var Datetime $dateCreated The moment this resource was created
     *
     * @Groups({"read"})
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateCreated;

    /**
     * @var Datetime $dateModified  The moment this resource last Modified
     *
     * @Groups({"read"})
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateModified;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->activities = new ArrayCollection();
        $this->evaluations = new ArrayCollection();
        $this->formalRecognitions = new ArrayCollection();
        $this->reflections = new ArrayCollection();
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setResult($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->setResult() === $this) {
                $product->setResult(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Activity[]
     */
    public function getActivities(): Collection
    {
        return $this->activities;
    }

    public function addActivity(Activity $activity): self
    {
        if (!$this->activities->contains($activity)) {
            $this->activities[] = $activity;
            $activity->setResult($this);
        }

        return $this;
    }

    public function removeActivity(Activity $activity): self
    {
        if ($this->activities->contains($activity)) {
            $this->activities->removeElement($activity);
            // set the owning side to null (unless already changed)
            if ($activity->setResult() === $this) {
                $activity->setResult(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Evaluation[]
     */
    public function getEvaluations(): Collection
    {
        return $this->evaluations;
    }

    public function addEvaluation(Evaluation $evaluation): self
    {
        if (!$this->evaluations->contains($evaluation)) {
            $this->evaluations[] = $evaluation;
            $evaluation->setResult($this);
        }

        return $this;
    }

    public function removeEvaluation(Evaluation $evaluation): self
    {
        if ($this->evaluations->contains($evaluation)) {
            $this->evaluations->removeElement($evaluation);
            // set the owning side to null (unless already changed)
            if ($evaluation->setResult() === $this) {
                $evaluation->setResult(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|FormalRecognition[]
     */
    public function getFormalRecognitions(): Collection
    {
        return $this->formalRecognitions;
    }

    public function addFormalRecognition(FormalRecognition $formalRecognition): self
    {
        if (!$this->formalRecognitions->contains($formalRecognition)) {
            $this->formalRecognitions[] = $formalRecognition;
            $formalRecognition->setResult($this);
        }

        return $this;
    }

    public function removeFormalRecognition(FormalRecognition $formalRecognition): self
    {
        if ($this->formalRecognitions->contains($formalRecognition)) {
            $this->formalRecognitions->removeElement($formalRecognition);
            // set the owning side to null (unless already changed)
            if ($formalRecognition->setResult() === $this) {
                $formalRecognition->setResult(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Reflection[]
     */
    public function getReflections(): Collection
    {
        return $this->reflections;
    }

    public function addReflection(Reflection $reflection): self
    {
        if (!$this->reflections->contains($reflection)) {
            $this->reflections[] = $reflection;
            $reflection->setResult($this);
        }

        return $this;
    }

    public function removeReflection(Reflection $reflection): self
    {
        if ($this->reflections->contains($reflection)) {
            $this->reflections->removeElement($reflection);
            // set the owning side to null (unless already changed)
            if ($reflection->setResult() === $this) {
                $reflection->setResult(null);
            }
        }

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated= $dateCreated;

        return $this;
    }

    public function getDateModified(): ?\DateTimeInterface
    {
        return $this->dateModified;
    }

    public function setDateModified(\DateTimeInterface $dateModified): self
    {
        $this->dateModified = $dateModified;

        return $this;
    }
}