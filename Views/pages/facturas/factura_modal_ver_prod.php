<script type="text/javascript">
    async function showModalVerProd(e) {
        const reg = e.currentTarget.parentElement.parentElement

        reg.classList.add("reg_select")

        const id = reg.getAttribute("id_reg")

        let modal = $("#modal-contenedor-ver-prod");

        modal.children("header").html("Factura: " + reg.children[0].innerText)

        await loadTableVerProd(id)


        modal.parent("#modal-fade-ver-prod").fadeIn(200);

        modal.parent("#modal-fade-ver-prod").css("display", "flex");

        modal.fadeIn(300);
    }

    async function hideModalVerProd() {

        $(".reg_select").removeClass("reg_select")

        await listFac()

        var modal = $("#modal-contenedor-ver-prod");

        modal.fadeOut(200, () => {
            modal.parent("#modal-fade-ver-prod").fadeOut(200);
        });
    }

    async function loadTableVerProd(id_fac) {
        let prod_fac = await getProdVen(id_fac)

        if (prod_fac.length == 0) {
            $("#modal-contenedor-ver-prod").children(".modal-contenido-ver-prod").html("<div id='ver_aviso'>No hay productos relacionados con esta factura.</div>")
        } else {
            $("#modal-contenedor-ver-prod").children(".modal-contenido-ver-prod").html(`<div class="scroll-table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>PrecioxUnidad</th>
                        <th>Cantidad</th>
                        <th>Precio total</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>`)
            prod_fac.forEach((prod) => {

                const prec_total = prod.cant_ven * prod.prod_prec_unid

                const prec_total_fix = Number.isInteger(prec_total) ? prec_total : delZero(prec_total.toFixed(2))

                $("#modal-contenedor-ver-prod .modal-contenido-ver-prod .scroll-table-wrapper table tbody").append(`
                    <tr id_reg="${prod.id_cant_prod_ven}">
                        <td>${prod.prod_ven}</td>
                        <td>${prod.prod_prec_unid} Bs</td>
                        <td>${prod.cant_ven}</td>
                        <td>${prec_total_fix} Bs</td>
                        <td><button type="button" class="elim_prod" title="Eliminar producto">X</button></td>
                    </tr>
            `)
            })
            const btnElimProdTable = document.querySelectorAll(".elim_prod");

            btnElimProdTable.forEach((btn) => {
                btn.addEventListener("click", (e) => deleteProdVen(e));
            });
        }
    }

    $(document).ready(() => {
        $("#form-modal-ver-prod").on("submit", (e) => addProdVen(e))
    })
</script>

<div class="modal-fade-form" id="modal-fade-ver-prod" style="display: none;">

    <div class="modal-contenedor-form" id="modal-contenedor-ver-prod">
        <header></header>
        <button class="btn-cerrar" type="button" onclick="hideModalVerProd()"><img src="../../imgs/xmark-white.svg"></button>

        <form method="post" class="form-modal" id="form-modal-ver-prod" enctype="multipart/form-data">
            <div class="div_form_grid" style="grid-template-columns: 1fr 1fr 120px;">

                <label class="form_field" for="prod_ven">
                    <span>Producto:</span>
                    <div class="content-select" style="width: 100%;">
                        <select name="prod_ven" id="prod_ven" required>
                        </select>
                        <i></i>
                    </div>
                </label>

                <label class="form_field" for="cant_ven">
                    <span>Cantidad:</span>
                    <input type="number" name="cant_ven" id="cant_ven" min="1" autocomplete="off" required>
                </label>

                <div class="submit_btn" style="margin: auto; margin-top:30px;">
                    <button type="submit" id="btn-agregar" form="form-modal-ver-prod" title="Agregar producto" style="padding: 5px 5px 0px 5px"><img src="../../imgs/plus-icon-white.svg" style="width: 40px; height:40px;"></button>
                </div>

            </div>
        </form>



        <div class="modal-contenido-ver-prod">

        </div>
    </div>

</div>

<style>
    #modal-contenedor-ver-prod {
        width: 100%;
        max-width: 800px;
        background: rgb(236, 240, 243);
        border-radius: 4px;
        position: relative;
        overflow: hidden;
        box-shadow: 1px 7px 25px rgba(0, 0, 0, 0.3);

    }


    #modal-contenedor-ver-prod header {
        background-color: #03a9f4;
        text-align: center;
        font-weight: bold;
        font-size: 1.6em;
        padding: 10px;
        padding-right: 30px;
        user-select: none;

    }

    #modal-contenedor-ver-prod .btn-cerrar {
        top: 10px;
        right: 7px;
    }

    .modal-contenido-ver-prod {
        width: 100%;
        padding: 20px;
    }

    #ver_aviso {
        padding-bottom: 20px;
        text-align: center;
        font-size: 1.1em;
    }

    .scroll-table-wrapper {
        margin: auto;
        width: 100%;
        height: 200px;
        overflow-y: auto;
    }

    .scroll-table-wrapper table {
        overflow-y: auto;

    }

    .scroll-table-wrapper table thead {
        position: -webkit-sticky;
        position: sticky;
        z-index: 1;
        top: 0;
        left: 0;
    }

    .scroll-table-wrapper table thead th:first-of-type {

        border-radius: 4px 0px 0px 0px;
    }

    .scroll-table-wrapper table thead th:last-of-type {

        border-radius: 0px 4px 0px 0px;
    }

    .scroll-table-wrapper table tbody tr:last-of-type td:first-of-type {

        border-radius: 0px 0px 0px 4px;
    }

    .scroll-table-wrapper table tbody tr td:last-of-type {

        border-radius: 0px 0px 4px 0px;
    }

    .elim_prod {
        border: none;
        outline: none;
        padding: 0px 5px;
        background-color: red;
        color: #fff;
        font-weight: bold;
        font-size: 1em;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.3s ease;
        user-select: none;
    }

    .elim_prod:hover {
        background: rgb(197, 1, 1);
    }

    @media screen and (max-width: 800px) {
        .modal-contenedor_ver {
            width: 90%;
        }
    }
</style>