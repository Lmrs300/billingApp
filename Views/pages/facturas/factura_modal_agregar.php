<link rel="stylesheet" href="../../css/agreg_edit_modal.css?v=<?php echo (rand()); ?>">


<style>
    .modal-contenedor-form {
        width: 50%;
    }
</style>

<script type="text/javascript">
    $(document).ready(() => {

        $("#form-modal").on("submit", async (e) => await addFac(e))

    })
</script>

<div class="modal-fade-form" id="modal-fade-form" style="display: none;">

    <div class="modal-contenedor-form" id="modal-contenedor-form">

        <header>
            Agregar factura
            <button class="btn-cerrar" type="button" onclick="hideModalAgreg()"><img src="../../imgs/xmark-white.svg"></button>
        </header>

        <form method="post" class="form-modal" id="form-modal" enctype="multipart/form-data">
            <div class="div_form_grid">

                <label class="form_field" for="serial_fac">
                    <span>Serial:</span>
                    <input type="text" name="serial_fac" id="serial_fac" maxlength="50" autocomplete="off" required>
                </label>

                <label class="form_field" for="fec_fac">
                    <span>Fecha:</span>
                    <input type="datetime-local" name="fec_fac" id="fec_fac" autocomplete="off" required>
                </label>

                <label class="form_field" for="nom_cli">
                    <span>Cliente:</span>
                    <div class="content-select">
                        <select name="nom_cli" id="nom_cli" required>
                        </select>
                        <i></i>
                    </div>
                </label>

                <label class="form_field" for="nom_usu">
                    <span>Vendedor:</span>
                    <div class="content-select">
                        <select name="nom_usu" id="nom_usu" required>
                        </select>
                        <i></i>
                    </div>
                </label>

                <label class="form_field" for="met_pago">
                    <span>Método de pago:</span>
                    <div class="content-select">
                        <select name="met_pago" id="met_pago" required>
                            <option value="Efectivo">Efectivo</option>
                            <option value="Tarj. débito">Tarj. débito</option>
                            <option value="Tarj crédito">Tarj. crédito</option>
                        </select>
                        <i></i>
                    </div>
                </label>

                <label class="form_field" for="iva_fac">
                    <span>IVA:</span>
                    <input type="number" name="iva_fac" id="iva_fac" step="0.000000000000001" autocomplete="off" maxlength="20" required>
                </label>
            </div>



        </form>


        <div class="submit_btn">
            <input type="submit" id="btn-agregar" value="Agregar" form="form-modal">
        </div>

    </div>

</div>