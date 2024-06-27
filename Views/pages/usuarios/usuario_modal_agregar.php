<link rel="stylesheet" href="../../css/agreg_edit_modal.css?v=<?php echo (rand()); ?>">


<style>
    .modal-contenedor-form {
        width: 50%;
    }
</style>

<script type="text/javascript">
    $(document).ready(() => {

        $("#form-modal").on("submit", async (e) => await addUsu(e))

    })
</script>

<div class="modal-fade-form" id="modal-fade-form" style="display: none;">

    <div class="modal-contenedor-form" id="modal-contenedor-form">

        <header>
            Agregar usuario
            <button class="btn-cerrar" type="button" onclick="hideModalAgreg()"><img src="../../imgs/xmark-white.svg"></button>
        </header>

        <form method="post" class="form-modal" id="form-modal" enctype="multipart/form-data">
            <div class="div_form_grid">
                <label class="form_field" for="nom_usu">
                    <span>Nombre:</span>
                    <input type="text" name="nom_usu" id="nom_usu" maxlength="80" autocomplete="off" required>
                </label>

                <label class="form_field" for="ced_usu">
                    <span>Cédula:</span>
                    <input type="number" name="ced_usu" id="ced_usu" maxlength="15" title="Ingrese su número de cédula (solo números)." autocomplete="off" required>
                </label>


                <label class="form_field" for="contra">
                    <span>Contraseña:</span>
                    <input type="password" name="contra" id="contra" maxlength="30" autocomplete="off" required>
                </label>

                <label class="form_field" for="con_contra">
                    <span>Confirmar contraseña:</span>
                    <input type="password" name="con_contra" id="con_contra" maxlength="30" autocomplete="off" required>
                </label>
            </div>
        </form>


        <div class="submit_btn">
            <input type="submit" id="btn_agregar" value="Agregar" form="form-modal">
        </div>

    </div>

</div>