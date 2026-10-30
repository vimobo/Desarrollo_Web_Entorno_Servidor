<?php

declare(strict_types=1);
namespace Models;

class Triangulo {

    private float $height;
    private float $width;
    private float $area;

    


	public function __construct(float $height, float $width) {

		$this->height = $height;
		$this->width = $width;
        $this->area  = 0;

	}

    public function calculateArea () {
        $area =  ($this->height * $this->width) / 2;
        $this->area = $area;
        return $area;
    }

    /**
     * Get the value of height
     */
    public function getHeigth(): float
    {
        return $this->height;
    }

    /**
     * Set the value of height
     */
    public function setHeigth(float $height): self
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get the value of width
     */
    public function getWidth(): float
    {
        return $this->width;
    }

       public function getArea(): float
    {
        return $this->area;
    }

    /**
     * Set the value of width
     */
    public function setWidth(float $width): self
    {
        $this->width = $width;

        return $this;
    }
}