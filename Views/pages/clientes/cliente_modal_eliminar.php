<link rel="stylesheet" href="../../css/modal_eliminar.css?v=<?php echo (rand()); ?>" />

<script src="../../js/jquery-3.6.4.min.js"></script>

<script type="text/javascript">
    function showModalElim(e) {

        const reg = e.currentTarget.parentElement.parentElement

        reg.classList.add("reg_select")

        const id = reg.getAttribute("id_reg")

        const ced_rif_cli = reg.children[0].innerText

        const nom_cli = reg.children[1].innerText

        let modal = $(".modal-contenedor-elim");

        let par = modal.children("p")

        par.html(`¿Esta seguro que desea eliminar al cliente <b>${nom_cli}</b>, con cédula/RIF: <b>${ced_rif_cli}</b>?`)

        modal.parent("#modal-fade-elim").fadeIn(200);

        modal.parent("#modal-fade-elim").css("display", "flex");

        modal.fadeIn(300);

    }

    function hideModalElim() {

        $(".reg_select").removeClass("reg_select")

        const btnEliminar = document.getElementById("btn-eliminar");

        var modal = $("#modal-contenedor-elim");

        modal.fadeOut(200, () => {
            modal.parent("#modal-fade-elim").fadeOut(200);

            btnEliminar.removeAttribute("disabled");
        });
    }
</script>


<div class="modal-fade-elim" id="modal-fade-elim" style="display: none;">

    <div class="modal-contenedor-elim" id="modal-contenedor-elim">
        <header>Confirmación de eliminación</header>
        <button class="btn-cerrar" type="button" onclick="hideModalElim()"><img src="../../imgs/xmark.svg"></button>
        <p></p>

        <button type="button" class="btn-eliminar" id="btn-eliminar" onclick="deleteCli()">Eliminar</button>
    </div>


</div>