<?php

// namespace OnlineShop;

class Feature
{
    private ?int $id;
    private int $productId;
    private string $feature;

    public function __construct(?int $id, int $productId, string $feature)
    {
        $this->id = $id;
        $this->productId = $productId;
        $this->feature = $feature;
    }

    // Getters and Setters
    public function getId(): int
    {
        return $this->id;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    public function getFeature(): string
    {
        return $this->feature;
    }

    public function setFeature(string $feature): void
    {
        $this->feature = $feature;
    }

    public function __toString(): string
    {
        return sprintf(
            "Feature ID: #%d - %s",
            $this->id,
            $this->feature
        );
    }
}

?>
