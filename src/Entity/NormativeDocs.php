<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Entity;

/**
 * Сведения о нормативном документе, являющемся основанием присвоения адресному элементу наименования.
 */
class NormativeDocs
{
    /**
     * Уникальный идентификатор документа.
     */
    protected int $id = 0;

    /**
     * Наименование документа.
     */
    protected string $name = '';

    /**
     * Дата документа.
     */
    protected ?\DateTimeInterface $date = null;

    /**
     * Номер документа.
     */
    protected string $number = '';

    /**
     * Тип документа.
     */
    protected int $type = 0;

    /**
     * Вид документа.
     */
    protected int $kind = 0;

    /**
     * Дата обновления.
     */
    protected ?\DateTimeInterface $updatedate = null;

    /**
     * Наименование органа создвшего нормативный документ.
     */
    protected ?string $orgname = null;

    /**
     * Номер государственной регистрации.
     */
    protected ?string $regnum = null;

    /**
     * Дата государственной регистрации.
     */
    protected ?\DateTimeInterface $regdate = null;

    /**
     * Дата вступления в силу нормативного документа.
     */
    protected ?\DateTimeInterface $accdate = null;

    /**
     * Комментарий.
     */
    protected ?string $comment = null;

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function setKind(int $kind): self
    {
        $this->kind = $kind;

        return $this;
    }

    public function getKind(): int
    {
        return $this->kind;
    }

    public function setUpdatedate(\DateTimeInterface $updatedate): self
    {
        $this->updatedate = $updatedate;

        return $this;
    }

    public function getUpdatedate(): ?\DateTimeInterface
    {
        return $this->updatedate;
    }

    public function setOrgname(?string $orgname): self
    {
        $this->orgname = $orgname;

        return $this;
    }

    public function getOrgname(): ?string
    {
        return $this->orgname;
    }

    public function setRegnum(?string $regnum): self
    {
        $this->regnum = $regnum;

        return $this;
    }

    public function getRegnum(): ?string
    {
        return $this->regnum;
    }

    public function setRegdate(?\DateTimeInterface $regdate): self
    {
        $this->regdate = $regdate;

        return $this;
    }

    public function getRegdate(): ?\DateTimeInterface
    {
        return $this->regdate;
    }

    public function setAccdate(?\DateTimeInterface $accdate): self
    {
        $this->accdate = $accdate;

        return $this;
    }

    public function getAccdate(): ?\DateTimeInterface
    {
        return $this->accdate;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }
}
