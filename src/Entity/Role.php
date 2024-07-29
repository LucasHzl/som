<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
class Role
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 16)]
    private ?string $name = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'relation_user_role')]
    private Collection $user;

    /**
     * @var Collection<int, Customer>
     */
    #[ORM\OneToMany(targetEntity: Customer::class, mappedBy: 'role')]
    private Collection $relation_role_customer;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->relation_role_customer = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): static
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
            $user->addRelationUserRole($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->user->removeElement($user)) {
            $user->removeRelationUserRole($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Customer>
     */
    public function getRelationRoleCustomer(): Collection
    {
        return $this->relation_role_customer;
    }

    public function addRelationRoleCustomer(Customer $relationRoleCustomer): static
    {
        if (!$this->relation_role_customer->contains($relationRoleCustomer)) {
            $this->relation_role_customer->add($relationRoleCustomer);
            $relationRoleCustomer->setRole($this);
        }

        return $this;
    }

    public function removeRelationRoleCustomer(Customer $relationRoleCustomer): static
    {
        if ($this->relation_role_customer->removeElement($relationRoleCustomer)) {
            // set the owning side to null (unless already changed)
            if ($relationRoleCustomer->getRole() === $this) {
                $relationRoleCustomer->setRole(null);
            }
        }

        return $this;
    }
}
