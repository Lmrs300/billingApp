<link rel="stylesheet" href="../../css/agreg_edit_modal.css?v=<?php echo (rand()); ?>">


<style>
    .modal-contenedor-form {
        width: 50%;

    }
</style>

<script type="text/javascript">
    $(document).ready(() => {

        $("#form-modal").on("submit", async (e) => await addProd(e))

    })
</script>

<div class="modal-fade-form" id="modal-fade-form" style="display: none;">

    <div class="modal-contenedor-form" id="modal-contenedor-form">

        <header>
            Agregar producto
            <button class="btn-cerrar" type="button" onclick="hideModalAgreg()"><img src="../../imgs/xmark-white.svg"></button>
        </header>

        <form method="post" class="form-modal" id="form-modal" enctype="multipart/form-data">
            <div class="div_form_grid">

                <label class="form_field" for="cod_prod">
                    <span>Código:</span>
                    <input type="text" name="cod_prod" id="cod_prod" maxlength="50" autocomplete="off" required>
                </label>

                <label class="form_field" for="nom_prod">
                    <span>Producto:</span>
                    <input type="text" name="nom_prod" id="nom_prod" maxlength="200" autocomplete="off" required>
                </label>

                <label class="form_field" for="prec_comp_prod">
                    <span>Precio compra:</span>
                    <input type="number" name="prec_comp_prod" id="prec_comp_prod" step="0.000000000000001" maxlength="80" autocomplete="off" required>
                </label>

                <label class="form_field" for="prec_ven_prod">
                    <span>Precio venta:</span>
                    <input type="number" name="prec_ven_prod" id="prec_ven_prod" step="0.000000000000001" maxlength="80" autocomplete="off" required>
                </label>
            </div>

        </form>


        <div class="submit_btn">
            <input type="submit" id="btn-agregar" value="Agregar" form="form-modal">
        </div>

    </div>

</div>