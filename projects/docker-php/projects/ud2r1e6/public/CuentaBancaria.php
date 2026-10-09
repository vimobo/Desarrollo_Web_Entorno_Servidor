<?php
class CuentaBancaria
{


    public function __construct(
        protected string $nombre,
        private float $saldo = 0
    ) {}
    

    function getSaldo()
    {
        return $this->saldo;
    }

    function retirar(int $cantidad)
    {
        if($this->saldo - $cantidad < 0)
            throw new Exception("No hay saldo suficiente");

        $this->saldo = $this->saldo - $cantidad;
    }

    function ingresar(int $cantidad)
    {
        if($cantidad < 0)
            throw new Exception("No se puede cantidad negativa");

        $this->saldo = $this->saldo + $cantidad;
    }


}
?>