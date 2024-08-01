<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 16)]
    private ?string $first_name = null;

    #[ORM\Column(length: 16)]
    private ?string $last_name = null;

    #[ORM\Column(length: 32)]
    private ?string $company = null;

    #[ORM\Column(length: 128)]
    private ?string $address = null;

    #[ORM\Column(length: 32)]
    private ?string $city = null;

    #[ORM\Column(length: 5)]
    private ?string $zip_code = null;

    #[ORM\Column(length: 128)]
    private ?string $email = null;

    #[ORM\Column(length: 10)]
    private ?string $phone = null;

    /**
     * @var Collection<int, Ticket>
     */
    #[ORM\OneToMany(targetEntity: Ticket::class, mappedBy: 'customer')]
    private Collection $relation_customer_ticket;

    #[ORM\Column]
    private array $roles = [];


    public function __construct()
    {
        $this->relation_customer_ticket = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): static
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): static
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zip_code;
    }

    public function setZipCode(string $zip_code): static
    {
        $this->zip_code = $zip_code;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return Collection<int, Ticket>
     */
    public function getRelationCustomerTicket(): Collection
    {
        return $this->relation_customer_ticket;
    }

    public function addRelationCustomerTicket(Ticket $relationCustomerTicket): static
    {
        if (!$this->relation_customer_ticket->contains($relationCustomerTicket)) {
            $this->relation_customer_ticket->add($relationCustomerTicket);
            $relationCustomerTicket->setCustomer($this);
        }

        return $this;
    }

    public function removeRelationCustomerTicket(Ticket $relationCustomerTicket): static
    {
        if ($this->relation_customer_ticket->removeElement($relationCustomerTicket)) {
            // set the owning side to null (unless already changed)
            if ($relationCustomerTicket->getCustomer() === $this) {
                $relationCustomerTicket->setCustomer(null);
            }
        }

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

}
