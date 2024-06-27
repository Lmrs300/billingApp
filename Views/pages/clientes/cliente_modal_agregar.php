<link rel="stylesheet" href="../../css/agreg_edit_modal.css?v=<?php echo (rand()); ?>">


<style>
    .modal-contenedor-form {
        width: 50%;
    }
</style>

<script type="text/javascript">
    $(document).ready(() => {

        $("#form-modal").on("submit", async (e) => await addCli(e))

    })
</script>

<div class="modal-fade-form" id="modal-fade-form" style="display: none;">

    <div class="modal-contenedor-form" id="modal-contenedor-form">

        <header>
            Agregar cliente
            <button class="btn-cerrar" type="button" onclick="hideModalAgreg()"><img src="../../imgs/xmark-white.svg"></button>
        </header>

        <form method="post" class="form-modal" id="form-modal" enctype="multipart/form-data">
            <div class="div_form_grid">

                <label class="form_field" for="nom_cli">
                    <span>Cliente:</span>
                    <input type="text" name="nom_cli" id="nom_cli" maxlength="200" autocomplete="off" required>
                </label>

                <label class="form_field" for="ced_rif_cli">
                    <span>Cédula/RIF:</span>
                    <input type="text" name="ced_rif_cli" id="ced_rif_cli" maxlength="25" autocomplete="off" required>
                </label>

                <label class="form_field" for="tel_cli">
                    <span>Teléfono:</span>
                    <input type="text" pattern="^[0-9]+$" minlength="11" maxlength="11" title="Ingrese un número de teléfono (solo números)" name="tel_cli" id="tel_cli" autocomplete="off" required>
                </label>

                <label class="form_field" for="dir_cli">
                    <span>Dirección:</span>
                    <input type="text" name="dir_cli" id="dir_cli" maxlength="300" autocomplete="off" required>
                </label>
            </div>

        </form>


        <div class="submit_btn">
            <input type="submit" id="btn-agregar" value="Agregar" form="form-modal">
        </div>

    </div>

</div>