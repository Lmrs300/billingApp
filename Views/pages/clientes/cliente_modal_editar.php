<script type="text/javascript">
    function showModalEdit(e) {

        const reg = e.currentTarget.parentElement.parentElement

        reg.classList.add("reg_select")

        //obtener datos del registro

        const id = reg.getAttribute("id_reg")

        const ced_rif_cli = reg.children[0].innerText

        const nom_cli = reg.children[1].innerText

        const tel_cli = reg.children[2].innerText

        const dir_cli = reg.children[3].innerText

        //rellenar inputs

        $("#ced_rif_cli_edit").val(ced_rif_cli)

        $("#nom_cli_edit").val(nom_cli)

        $("#tel_cli_edit").val(tel_cli)

        $("#dir_cli_edit").val(dir_cli)

        //mostrar modal

        let modal = $("#modal-contenedor-form-edit");

        modal.parent("#modal-fade-form-edit").fadeIn(200);

        modal.parent("#modal-fade-form-edit").css("display", "flex");

        modal.fadeIn(300);
    }

    function hideModalEdit() {
        $(".reg_select").removeClass("reg_select")

        const btnEditar = document.getElementById("btn-edit");

        var modal = $("#modal-contenedor-form-edit");

        modal.fadeOut(200, () => {
            modal.parent("#modal-fade-form-edit").fadeOut(200);

            btnEditar.removeAttribute("disabled");
        });
    }

    $(document).ready(() => {

        $("#form-modal-edit").on("submit", (e) => editCli(e))

    })
</script>

<div class="modal-fade-form" id="modal-fade-form-edit" style="display: none;">

    <div class="modal-contenedor-form" id="modal-contenedor-form-edit">

        <header class="header_edit">
            Editar Cliente
            <button class="btn-cerrar" type="button" onclick="hideModalEdit()"><img src="../../imgs/xmark-white.svg"></button>
        </header>

        <form method="post" class="form-modal" id="form-modal-edit" enctype="multipart/form-data">
            <div class="div_form_grid">

                <label class="form_field" for="nom_cli">
                    <span>Cliente:</span>
                    <input type="text" name="nom_cli" id="nom_cli_edit" maxlength="200" autocomplete="off" required>
                </label>

                <label class="form_field" for="ced_rif_cli">
                    <span>Cédula/RIF:</span>
                    <input type="text" name="ced_rif_cli" id="ced_rif_cli_edit" maxlength="25" autocomplete="off" required>
                </label>

                <label class="form_field" for="tel_cli">
                    <span>Teléfono:</span>
                    <input type="text" pattern="^[0-9]+$" minlength="11" maxlength="11" title="Ingrese un número de teléfono (solo números)" name="tel_cli" id="tel_cli_edit" autocomplete="off" required>
                </label>

                <label class="form_field" for="dir_cli">
                    <span>Dirección:</span>
                    <input type="text" name="dir_cli" id="dir_cli_edit" maxlength="300" autocomplete="off" required>
                </label>
            </div>
        </form>



        <div class="submit_btn">
            <input type="submit" class="btn-edit" id="btn-edit" value="Editar" form="form-modal-edit">
        </div>

    </div>

</div>