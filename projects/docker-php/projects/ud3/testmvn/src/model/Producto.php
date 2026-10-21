<?php
declare(strict_types=1);

namespace model;

class Producto
{
    function __construct(
        private int $id,
        private string $name,
        private string $description,
        private int $price,
        private int $quantity
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->quantity = $quantity;
    }



	public function getId() : int {
		return $this->id;
	}

	public function setId(int $value) {
		$this->id = $value;
	}

	public function getName() : string {
		return $this->name;
	}

	public function setName(string $value) {
		$this->name = $value;
	}

	public function getDescription() : string {
		return $this->description;
	}

	public function setDescription(string $value) {
		$this->description = $value;
	}

	public function getPrice() : int {
		return $this->price;
	}

	public function setPrice(int $value) {
		$this->price = $value;
	}

	public function getQuantity() : int {
		return $this->quantity;
	}

	public function setQuantity(int $value) {
		$this->quantity = $value;
	}

    public function calculatePriceProducto() : float {
        return $this->getPrice() * $this->getQuantity();
    }


	public function imprimirProducto(){
		return $this->name ."<br>". $this->description;
	}
}
?>