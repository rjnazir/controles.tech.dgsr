<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @UniqueEntity(fields="username", message="Le login entré est déjà existant")
 * @UniqueEntity(fields="usermail", message="L'adresse e-mail entré est déjà existant")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $usrnamecomplet;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $userfonction;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $usermail;

    /**
     * @ORM\Column(type="boolean")
     */
    private $actived;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $useradresse;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $userphone;

    /**
     * @ORM\Column(type="boolean")
     */
    private $userpresence;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $user_created_at;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $user_updated_at;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $last_login;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $user_is_connected;

    /**
     * @ORM\ManyToOne(targetEntity=CtCentre::class, inversedBy="users")
     */
    private $ctCentre;

    /**
     * @ORM\OneToMany(targetEntity=CtArretePrix::class, mappedBy="user")
     */
    private $ctArretePrixes;

    public function __construct()
    {
        $this->ctArretePrixes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUsrnamecomplet(): ?string
    {
        return $this->usrnamecomplet;
    }

    public function setUsrnamecomplet(string $usrnamecomplet): self
    {
        $this->usrnamecomplet = $usrnamecomplet;

        return $this;
    }

    public function getUserfonction(): ?string
    {
        return $this->userfonction;
    }

    public function setUserfonction(?string $userfonction): self
    {
        $this->userfonction = $userfonction;

        return $this;
    }

    public function getUsermail(): ?string
    {
        return $this->usermail;
    }

    public function setUsermail(string $usermail): self
    {
        $this->usermail = $usermail;

        return $this;
    }

    public function getActived(): ?bool
    {
        return $this->actived;
    }

    public function setActived(bool $actived): self
    {
        $this->actived = $actived;

        return $this;
    }

    public function getUseradresse(): ?string
    {
        return $this->useradresse;
    }

    public function setUseradresse(?string $useradresse): self
    {
        $this->useradresse = $useradresse;

        return $this;
    }

    public function getUserphone(): ?string
    {
        return $this->userphone;
    }

    public function setUserphone(string $userphone): self
    {
        $this->userphone = $userphone;

        return $this;
    }

    public function getUserpresence(): ?bool
    {
        return $this->userpresence;
    }

    public function setUserpresence(bool $userpresence): self
    {
        $this->userpresence = $userpresence;

        return $this;
    }

    public function getUserCreatedAt(): ?\DateTimeImmutable
    {
        return $this->user_created_at;
    }

    public function setUserCreatedAt(?\DateTimeImmutable $user_created_at): self
    {
        $this->user_created_at = $user_created_at;

        return $this;
    }

    public function getUserUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->user_updated_at;
    }

    public function setUserUpdatedAt(?\DateTimeImmutable $user_updated_at): self
    {
        $this->user_updated_at = $user_updated_at;

        return $this;
    }

    public function getLastLogin(): ?\DateTimeImmutable
    {
        return $this->last_login;
    }

    public function setLastLogin(?\DateTimeImmutable $last_login): self
    {
        $this->last_login = $last_login;

        return $this;
    }

    public function getUserIsConnected(): ?int
    {
        return $this->user_is_connected;
    }

    public function setUserIsConnected(?int $user_is_connected): self
    {
        $this->user_is_connected = $user_is_connected;

        return $this;
    }

    public function getCtCentre(): ?CtCentre
    {
        return $this->ctCentre;
    }

    public function setCtCentre(?CtCentre $ctCentre): self
    {
        $this->ctCentre = $ctCentre;

        return $this;
    }

    /**
     * @return Collection<int, CtArretePrix>
     */
    public function getCtArretePrixes(): Collection
    {
        return $this->ctArretePrixes;
    }

    public function addCtArretePrix(CtArretePrix $ctArretePrix): self
    {
        if (!$this->ctArretePrixes->contains($ctArretePrix)) {
            $this->ctArretePrixes[] = $ctArretePrix;
            $ctArretePrix->setUser($this);
        }

        return $this;
    }

    public function removeCtArretePrix(CtArretePrix $ctArretePrix): self
    {
        if ($this->ctArretePrixes->removeElement($ctArretePrix)) {
            // set the owning side to null (unless already changed)
            if ($ctArretePrix->getUser() === $this) {
                $ctArretePrix->setUser(null);
            }
        }

        return $this;
    }
}
