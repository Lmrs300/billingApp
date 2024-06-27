<script type="text/javascript">
    function showModalEdit(e) {

        const reg = e.currentTarget.parentElement.parentElement

        reg.classList.add("reg_select")

        //obtener datos del registro

        const id = reg.getAttribute("id_reg")

        const serial_fac = reg.children[0].innerText

        const fec_fac = reg.children[1].innerText

        const newFecha = convertFec_hor_eng(fec_fac)

        const nom_cli = reg.children[2].innerText

        const nom_usu = reg.children[3].innerText

        const met_pago = reg.children[5].innerText

        const iva_fac = reg.children[7].innerText

        //rellenar inputs

        $("#serial_fac_edit").val(serial_fac)

        $("#fec_fac_edit").val(newFecha)

        $("#nom_cli_edit").val(nom_cli)

        $("#nom_usu_edit").val(nom_usu)


        $("#met_pago_edit").val(met_pago)

        $("#iva_fac_edit").val(iva_fac.replace("%", ""))

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

        $("#form-modal-edit").on("submit", (e) => editFac(e))

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

                <label class="form_field" for="serial_fac">
                    <span>Serial:</span>
                    <input type="text" name="serial_fac" id="serial_fac_edit" maxlength="50" autocomplete="off" required>
                </label>

                <label class="form_field" for="fec_fac">
                    <span>Fecha:</span>
                    <input type="datetime-local" name="fec_fac" id="fec_fac_edit" autocomplete="off" required>
                </label>

                <label class="form_field" for="nom_cli">
                    <span>Cliente:</span>
                    <div class="content-select">
                        <select name="nom_cli" id="nom_cli_edit" required>
                        </select>
                        <i></i>
                    </div>
                </label>

                <label class="form_field" for="nom_usu">
                    <span>Vendedor:</span>
                    <div class="content-select">
                        <select name="nom_usu" id="nom_usu_edit" required>
                        </select>
                        <i></i>
                    </div>
                </label>

                <label class="form_field" for="met_pago">
                    <span>Método de pago:</span>
                    <div class="content-select">
                        <select name="met_pago" id="met_pago_edit" required>
                            <option value="Efectivo">Efectivo</option>
                            <option value="Tarj. débito">Tarj. débito</option>
                            <option value="Tarj crédito">Tarj. crédito</option>
                        </select>
                        <i></i>
                    </div>
                </label>

                <label class="form_field" for="iva_fac">
                    <span>IVA:</span>
                    <input type="number" name="iva_fac" id="iva_fac_edit" step="0.000000000000001" autocomplete="off" maxlength="20" required>
                </label>
            </div>


        </form>



        <div class="submit_btn">
            <input type="submit" class="btn-edit" id="btn-edit" value="Editar" form="form-modal-edit">
        </div>

    </div>

</div>