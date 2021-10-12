<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PupilClass
 *
 * @ORM\Table(name="pupil_class", uniqueConstraints={@ORM\UniqueConstraint(name="pupil_class", columns={"pupil_id", "class_id"})})
 * @ORM\Entity
 */
class PupilClass
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="pupil_id", type="integer", nullable=false)
     */
    private $pupil;

    /**
     * @var int
     *
     * @ORM\Column(name="class_id", type="integer", nullable=false)
     */
    private $class;

    /**
     * @var string
     *
     * @ORM\Column(name="language_group", type="string", length=1, nullable=false, options={"fixed"=true,"comment"="1 or 2"})
     */
    private $languageGroup;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPupil(): ?int
    {
        return $this->pupil;
    }

    public function setPupil(int $pupil): self
    {
        $this->pupil = $pupil;

        return $this;
    }

    public function getClass(): ?int
    {
        return $this->class;
    }

    public function setClass(int $class): self
    {
        $this->class = $class;

        return $this;
    }

    public function getLanguageGroup(): ?string
    {
        return $this->languageGroup;
    }

    public function setLanguageGroup(string $languageGroup): self
    {
        $this->languageGroup = $languageGroup;

        return $this;
    }


}
