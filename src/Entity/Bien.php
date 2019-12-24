<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BienRepository")
 */
class Bien
{

    public function __construct()
    {
        $this->setCreatedAt(new \DateTime());
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero_rue;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rue;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rue_complement;

    /**
     * @ORM\Column(type="integer")
     */
    private $code_postal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="float")
     */
    private $surface;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombre_de_pieces;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombre_chambres;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $surface_terrain;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="boolean")
     */
    private $cheminee;

    /**
     * @ORM\Column(type="boolean")
     */
    private $belle_vue;

    /**
     * @ORM\Column(type="boolean")
     */
    private $balcon;

    /**
     * @ORM\Column(type="boolean")
     */
    private $piscine;

    /**
     * @ORM\Column(type="boolean")
     */
    private $ascenseur;

    /**
     * @ORM\Column(type="boolean")
     */
    private $terrasse;

    /**
     * @ORM\Column(type="boolean")
     */
    private $cave;

    /**
     * @ORM\Column(type="boolean")
     */
    private $parking;

    /**
     * @ORM\Column(type="boolean")
     */
    private $acces_handicape;

    /**
     * @ORM\Column(type="boolean")
     */
    private $baignoire;

    /**
     * @ORM\Column(type="boolean")
     */
    private $cuisine_separee;

    /**
     * @ORM\Column(type="boolean")
     */
    private $meuble;

    /**
     * @ORM\Column(type="boolean")
     */
    private $colocation;

    /**
     * @ORM\Column(type="boolean")
     */
    private $wc_separes;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeDeBien")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type_de_bien;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Chauffage")
     * @ORM\JoinColumn(nullable=false)
     */
    private $chauffage;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="array")
     */
    private $images = [];

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="biens")
     */
    private $author;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

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

    public function getNumeroRue(): ?int
    {
        return $this->numero_rue;
    }

    public function setNumeroRue(int $numero_rue): self
    {
        $this->numero_rue = $numero_rue;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    public function getRueComplement(): ?string
    {
        return $this->rue_complement;
    }

    public function setRueComplement(?string $rue_complement): self
    {
        $this->rue_complement = $rue_complement;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->code_postal;
    }

    public function setCodePostal(int $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getSurface(): ?float
    {
        return $this->surface;
    }

    public function setSurface(float $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getNombreDePieces(): ?int
    {
        return $this->nombre_de_pieces;
    }

    public function setNombreDePieces(int $nombre_de_pieces): self
    {
        $this->nombre_de_pieces = $nombre_de_pieces;

        return $this;
    }

    public function getNombreChambres(): ?int
    {
        return $this->nombre_chambres;
    }

    public function setNombreChambres(int $nombre_chambres): self
    {
        $this->nombre_chambres = $nombre_chambres;

        return $this;
    }

    public function getSurfaceTerrain(): ?float
    {
        return $this->surface_terrain;
    }

    public function setSurfaceTerrain(?float $surface_terrain): self
    {
        $this->surface_terrain = $surface_terrain;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getCheminee(): ?bool
    {
        return $this->cheminee;
    }

    public function setCheminee(bool $cheminee): self
    {
        $this->cheminee = $cheminee;

        return $this;
    }

    public function getBelleVue(): ?bool
    {
        return $this->belle_vue;
    }

    public function setBelleVue(bool $belle_vue): self
    {
        $this->belle_vue = $belle_vue;

        return $this;
    }

    public function getBalcon(): ?bool
    {
        return $this->balcon;
    }

    public function setBalcon(bool $balcon): self
    {
        $this->balcon = $balcon;

        return $this;
    }

    public function getPiscine(): ?bool
    {
        return $this->piscine;
    }

    public function setPiscine(bool $piscine): self
    {
        $this->piscine = $piscine;

        return $this;
    }

    public function getAscenseur(): ?bool
    {
        return $this->ascenseur;
    }

    public function setAscenseur(bool $ascenseur): self
    {
        $this->ascenseur = $ascenseur;

        return $this;
    }

    public function getTerrasse(): ?bool
    {
        return $this->terrasse;
    }

    public function setTerrasse(bool $terrasse): self
    {
        $this->terrasse = $terrasse;

        return $this;
    }

    public function getCave(): ?bool
    {
        return $this->cave;
    }

    public function setCave(bool $cave): self
    {
        $this->cave = $cave;

        return $this;
    }

    public function getParking(): ?bool
    {
        return $this->parking;
    }

    public function setParking(bool $parking): self
    {
        $this->parking = $parking;

        return $this;
    }

    public function getAccesHandicape(): ?bool
    {
        return $this->acces_handicape;
    }

    public function setAccesHandicape(bool $acces_handicape): self
    {
        $this->acces_handicape = $acces_handicape;

        return $this;
    }

    public function getBaignoire(): ?bool
    {
        return $this->baignoire;
    }

    public function setBaignoire(bool $baignoire): self
    {
        $this->baignoire = $baignoire;

        return $this;
    }

    public function getCuisineSeparee(): ?bool
    {
        return $this->cuisine_separee;
    }

    public function setCuisineSeparee(bool $cuisine_separee): self
    {
        $this->cuisine_separee = $cuisine_separee;

        return $this;
    }

    public function getMeuble(): ?bool
    {
        return $this->meuble;
    }

    public function setMeuble(bool $meuble): self
    {
        $this->meuble = $meuble;

        return $this;
    }

    public function getColocation(): ?bool
    {
        return $this->colocation;
    }

    public function setColocation(bool $colocation): self
    {
        $this->colocation = $colocation;

        return $this;
    }

    public function getWcSepares(): ?bool
    {
        return $this->wc_separes;
    }

    public function setWcSepares(bool $wc_separes): self
    {
        $this->wc_separes = $wc_separes;

        return $this;
    }


    public function getTypeDeBien(): ?TypeDeBien
    {
        return $this->type_de_bien;
    }

    public function setTypeDeBien(?TypeDeBien $type_de_bien): self
    {
        $this->type_de_bien = $type_de_bien;

        return $this;
    }

    public function getChauffage(): ?Chauffage
    {
        return $this->chauffage;
    }

    public function setChauffage(?Chauffage $chauffage): self
    {
        $this->chauffage = $chauffage;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getImages(): ?array
    {
        return $this->images;
    }

    public function setImages(array $images): self
    {
        $this->images = $images;
        return $this;
    }

    public function addImages(string $image): self
    {
        $this->images[] = $image;
        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }
}
