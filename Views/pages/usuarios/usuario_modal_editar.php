<script type="text/javascript">
    function showModalEdit(e) {

        const reg = e.currentTarget.parentElement.parentElement

        reg.classList.add("reg_select")

        //obtener datos del registro

        const id = reg.getAttribute("id_reg")

        const ced_usu = reg.children[0].innerText

        const nom_usu = reg.children[1].innerText

        const contra_usu = reg.children[2].innerText

        //rellenar inputs

        $("#nom_usu_edit").val(nom_usu)

        $("#ced_usu_edit").val(ced_usu)

        $("#contra_edit").val(contra_usu)

        $("#con_contra_edit").val(contra_usu)


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

        $("#form-modal-edit").on("submit", (e) => editUsu(e))

    })
</script>

<div class="modal-fade-form" id="modal-fade-form-edit" style="display: none;">

    <div class="modal-contenedor-form" id="modal-contenedor-form-edit">

        <header class="header_edit">
            Editar usuario
            <button class="btn-cerrar" type="button" onclick="hideModalEdit()"><img src="../../imgs/xmark-white.svg"></button>
        </header>

        <form method="post" class="form-modal" id="form-modal-edit" enctype="multipart/form-data">
            <div class="div_form_grid">
                <label class="form_field" for="nom_usu">
                    <span>Nombre:</span>
                    <input type="text" name="nom_usu" id="nom_usu_edit" maxlength="80" autocomplete="off" required>
                </label>

                <label class="form_field" for="ced_usu">
                    <span>Cédula:</span>
                    <input type="number" name="ced_usu" id="ced_usu_edit" maxlength="15" title="Ingrese su número de cédula (solo números)." autocomplete="off" required>
                </label>


                <label class="form_field" for="contra">
                    <span>Contraseña:</span>
                    <input type="password" name="contra" id="contra_edit" maxlength="30" autocomplete="off" required>
                </label>

                <label class="form_field" for="con_contra">
                    <span>Confirmar contraseña:</span>
                    <input type="password" name="con_contra" id="con_contra_edit" maxlength="30" autocomplete="off" required>
                </label>
            </div>
        </form>



        <div class="submit_btn">
            <input type="submit" class="btn-edit" id="btn-edit" value="Editar" form="form-modal-edit">
        </div>

    </div>

</div>