<?php

namespace App\Entity;

use App\Repository\FaqRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FaqRepository::class)]
class Faq
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message:"La question initiale doit être mentionnée")]
    private ?string $question = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message:"La question initiale en anglais doit être mentionnée")]
    private ?string $questionEn = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message:"La réponse à la question doit être mentionnée")]
    private ?string $response = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message:"La réponse (en anglais) à la question doit être mentionnée")]
    private ?string $responseEn = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): static
    {
        $this->question = $question;

        return $this;
    }

    public function getQuestionEn(): ?string
    {
        return $this->questionEn;
    }

    public function setQuestionEn(string $questionEn): static
    {
        $this->questionEn = $questionEn;

        return $this;
    }

    public function getResponse(): ?string
    {
        return $this->response;
    }

    public function setResponse(string $response): static
    {
        $this->response = $response;

        return $this;
    }

    public function getResponseEn(): ?string
    {
        return $this->responseEn;
    }

    public function setResponseEn(string $responseEn): static
    {
        $this->responseEn = $responseEn;

        return $this;
    }
}
