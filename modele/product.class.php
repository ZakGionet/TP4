<?php

// namespace OnlineShop;

class Product
{
    private ?int $id; // Permet à l'ID d'être int ou null
    private string $name;
    private float $price;
    private ?string $image;
    private string $category;
    private string $description;
    private int $quantity;

    private array $features = [];

    public function __construct(
        ?int $id, 
        string $name,
        float $price,
        ?string $image,
        string $category,
        string $description,
        int $quantity = 0
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->image = $image;
        $this->category = $category;
        $this->description = $description;
        $this->quantity = $quantity;
    }

    // Getters and Setters
    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): void {
        $this->id = $id;
    }
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function addFeature(Feature $feature): void
    {
        if(!($feature instanceof Feature)){
            throw new Exception("Le paramètre de addFeature doit être une instance de la classe Feature");
        }
        $this->features[] = $feature;
    }


    public function getFeatures(): array
    {
        return $this->features;
    }

    // get all attribut
    public function getAllAttributes(): array {
        return array(
            array("name", "price", "image", "category", "description", "quantity"),
            array($this->name, $this->price, $this->image, $this-> category, $this->description, $this-> quantity));
    }

    public function __toString(): string
    {
        return sprintf(
            "[#%d] %s - %s @%.2f$ (%d en stock)",
            $this->id,
            $this->name,
            $this->category,
            $this->price,
            $this->quantity
        );
    }
}

?>
