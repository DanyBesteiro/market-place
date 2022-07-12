<?php

namespace App\Entity;

use App\Repository\PeopleInFilmsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PeopleInFilmsRepository::class)]
class PeopleInFilms
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $FilmId;

    #[ORM\Column(type: 'integer')]
    private $PersonId;

    #[ORM\Column(type: 'integer')]
    private $ParticipationTypeId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilmId(): ?int
    {
        return $this->FilmId;
    }

    public function setFilmId(int $FilmId): self
    {
        $this->FilmId = $FilmId;

        return $this;
    }

    public function getPersonId(): ?int
    {
        return $this->PersonId;
    }

    public function setPersonId(int $PersonId): self
    {
        $this->PersonId = $PersonId;

        return $this;
    }

    public function getParticipationTypeId(): ?int
    {
        return $this->ParticipationTypeId;
    }

    public function setParticipationTypeId(int $ParticipationTypeId): self
    {
        $this->ParticipationTypeId = $ParticipationTypeId;

        return $this;
    }
}
