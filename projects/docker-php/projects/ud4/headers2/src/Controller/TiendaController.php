<?php
declare(strict_types=1);

namespace Controller;

use Models\Tienda;
use Lib\Pages;
use Requests\FormRequest;

class TiendaController
{


    private Pages $pages;
    private Tienda $tienda;


    public function __construct()
    {

        $this->pages = new Pages();
        $this->tienda = new Tienda();
    }

    public function getPages(): Pages
    {
        return $this->pages;
    }

    public function setPages(Pages $value)
    {
        $this->pages = $value;
    }

    public function getTienda(): Tienda
    {
        return $this->tienda;
    }

    public function setTienda(Tienda $value)
    {
        $this->tienda = $value;
    }

    public function showform(): void
    {

        $this->pages->render('form/form');

    }

    public function process()
    {
        
        if(empty($_GET['idProducto']))
            ErrorController::show_error400();
        
        else if (isset($_GET['idProducto'])) {

            $cleanId = FormRequest::sanitize($_GET['idProducto']);
            $cleanId = FormRequest::validate($cleanId);

            if(isset($cleanId))
                $producto = $this->tienda->getProductoById($cleanId);

            if (!empty($producto)) {

                $this->pages->render('form/formResponse', $producto );
                return;
            } else {

            }

        }
    }

}