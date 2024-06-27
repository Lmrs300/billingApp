<script type="text/javascript">
    function showModalEdit(e) {

        const reg = e.currentTarget.parentElement.parentElement

        reg.classList.add("reg_select")

        //obtener datos del registro

        const id = reg.getAttribute("id_reg")

        const cod_prod = reg.children[0].innerText

        const nom_prod = reg.children[1].innerText

        const prec_comp_prod = reg.children[2].innerText

        const prec_ven_prod = reg.children[3].innerText

        //rellenar inputs

        $("#nom_prod_edit").val(nom_prod)

        $("#cod_prod_edit").val(cod_prod)

        $("#prec_comp_prod_edit").val(prec_comp_prod.replace(" Bs", ""))

        $("#prec_ven_prod_edit").val(prec_ven_prod.replace(" Bs", ""))

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

        $("#form-modal-edit").on("submit", (e) => editProd(e))

    })
</script>

<div class="modal-fade-form" id="modal-fade-form-edit" style="display: none;">

    <div class="modal-contenedor-form" id="modal-contenedor-form-edit">

        <header class="header_edit">
            Editar producto
            <button class="btn-cerrar" type="button" onclick="hideModalEdit()"><img src="../../imgs/xmark-white.svg"></button>
        </header>

        <form method="post" class="form-modal" id="form-modal-edit" enctype="multipart/form-data">
            <div class="div_form_grid">

                <label class="form_field" for="cod_prod">
                    <span>Código:</span>
                    <input type="text" name="cod_prod" id="cod_prod_edit" maxlength="50" autocomplete="off" required>
                </label>

                <label class="form_field" for="nom_prod">
                    <span>Producto:</span>
                    <input type="text" name="nom_prod" id="nom_prod_edit" maxlength="200" required>
                </label>

                <label class="form_field" for="prec_comp_prod">
                    <span>Precio compra:</span>
                    <input type="number" name="prec_comp_prod" id="prec_comp_prod_edit" step="0.000000000000001" maxlength="80" autocomplete="off" required>
                </label>

                <label class="form_field" for="prec_ven_prod">
                    <span>Precio venta:</span>
                    <input type="number" name="prec_ven_prod" id="prec_ven_prod_edit" step="0.000000000000001" maxlength="80" autocomplete="off" required>
                </label>
            </div>
        </form>



        <div class="submit_btn">
            <input type="submit" class="btn-edit" id="btn-edit" value="Editar" form="form-modal-edit">
        </div>

    </div>

</div>