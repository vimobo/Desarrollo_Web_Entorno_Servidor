<form method="GET" action="index.php">

    <input type="hidden" name="controller" value="Tienda">
    <input type="hidden" name="action" value="process">

    <p>
        <label for="idProducto">Id a buscar</label>
        <input  type="" placeholder="Id Producto" name="idProducto" id="idProducto"
            value="<?= ($idProducto ?? '') ?>" />

            <input type="submit" value="Buscar">

    </p>



</form>