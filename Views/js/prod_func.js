const urlProd = "../../../Controllers/producto_controller.php";

async function listProd() {
  const productos = await getProd();

  const tbody = $("table tbody");

  tbody.html("");

  productos.forEach((prod) => {
    tbody.append(
      `<tr id_reg="${prod.id_prod}"><td>${prod.cod_prod}</td><td>${prod.nom_prod}</td><td>${prod.prec_comp_prod} Bs</td><td>${prod.prec_ven_prod} Bs</td><td><button type="button" class="editar"><img src="../../imgs/edit.svg"></button><button type="button" class="eliminar"><img src="../../imgs/delete.svg"></button></td></tr>`
    );
  });

  const btnElimTable = document.querySelectorAll(".eliminar");

  btnElimTable.forEach((btn) => {
    btn.addEventListener("click", (e) => showModalElim(e));
  });

  const btnEditTable = document.querySelectorAll(".editar");

  btnEditTable.forEach((btn) => {
    btn.addEventListener("click", (e) => showModalEdit(e));
  });
}

function showModalAgreg() {
  var modal = $("#modal-contenedor-form");

  modal.parent("#modal-fade-form").fadeIn(200);

  modal.parent("#modal-fade-form").css("display", "flex");

  modal.fadeIn(300);
}

function hideModalAgreg() {
  var form = document.getElementById("form-modal");

  const btnAgregar = document.getElementById("btn-agregar");

  var modal = $("#modal-contenedor-form");

  modal.fadeOut(200, () => {
    modal.parent("#modal-fade-form").fadeOut(200);

    form.reset();

    btnAgregar.removeAttribute("disabled");
  });
}

async function getProd() {
  const formData = new FormData();

  formData.append("accion", "get_prod");

  try {
    const res = await fetch(urlProd, {
      method: "post",
      body: formData,
    });

    const productos = await res.json();

    return productos;
  } catch (e) {
    console.error("Error", e.message);

    createErrorToast(
      "Error",
      "Ocurrió un error al conectar con el servidor.",
      false
    );
  }
}

async function verifyDatos(formData, id_edit = 0) {
  //verificar que el código del producto no sea el de un producto registrado

  const productos = await getProd();

  let errorCod = false;

  productos.forEach((prod) => {
    if (
      prod["cod_prod"] == formData.get("cod_prod") &&
      prod["id_prod"] != id_edit
    ) {
      errorCod = true;
    }
  });

  if (errorCod == true) {
    createErrorToast(
      "Error",
      `Ya existe un producto registrado con el código: <b>${formData.get(
        "cod_prod"
      )}</b>.`
    );
    return false;
  }

  //verificar que el nombre del producto no sea el de un producto registrado

  let errorNom = false;

  productos.forEach((prod) => {
    if (
      prod["nom_prod"].toLowerCase() ==
        formData.get("nom_prod").toLowerCase() &&
      prod["id_prod"] != id_edit
    ) {
      errorNom = true;
    }
  });

  if (errorNom == true) {
    createErrorToast(
      "Error",
      `Ya existe un producto registrado con el nombre: <b>${formData.get(
        "nom_prod"
      )}</b>.`
    );
    return false;
  }

  return true;
}

async function addProd(e) {
  e.preventDefault();

  const btnAgregar = document.getElementById("btn-agregar");

  const formData = new FormData(e.target);

  const validateDatos = await verifyDatos(formData);

  if (validateDatos == false) {
    return;
  }

  //enviar al servidor
  btnAgregar.disabled = true;

  formData.set("accion", "add_prod");

  try {
    let res = await fetch(urlProd, {
      method: "post",
      body: formData,
    });

    res = await res.text();

    createSuccessToast(
      "Registro exitoso",
      "Se ha añadido el producto exitosamente.",
      true,
      3
    );
    await listProd();
    hideModalAgreg();
    btnAgregar.removeAttribute("disabled");
  } catch (error) {
    console.log(error.message);
    btnAgregar.removeAttribute("disabled");
    createErrorToast(
      "Error",
      "Ocurrió un error al conectar con el servidor.",
      false
    );
  }
}

async function editProd(e) {
  e.preventDefault();

  const btnEdit = document.getElementById("btn-edit");

  const formData = new FormData(e.target);

  const regSelect = document.querySelector(".reg_select");

  const id_prod = regSelect.getAttribute("id_reg");

  const validateDatos = await verifyDatos(formData, id_prod);

  if (validateDatos == false) {
    return;
  }

  //enviar al servidor
  btnEdit.disabled = true;

  formData.set("id_prod", id_prod);

  formData.set("accion", "edit_prod");

  try {
    let res = await fetch(urlProd, {
      method: "post",
      body: formData,
    });

    res = await res.text();

    createSuccessToast(
      "Modificación exitosa",
      "Se ha modificado el producto exitosamente.",
      true,
      3
    );

    await listProd();
    hideModalEdit();
    btnEdit.removeAttribute("disabled");
  } catch (error) {
    console.log(error.message);
    btnEdit.removeAttribute("disabled");
    createErrorToast(
      "Error",
      "Ocurrió un error al conectar con el servidor.",
      false
    );
  }
}

async function deleteProd() {
  const btnEliminar = document.getElementById("btn-eliminar");

  const regSelect = document.querySelector(".reg_select");

  const id_prod = regSelect.getAttribute("id_reg");

  const formData = new FormData();

  //enviar al servidor
  btnEliminar.disabled = true;

  formData.set("id_prod", id_prod);

  formData.set("accion", "delete_prod");

  try {
    let res = await fetch(urlProd, {
      method: "post",
      body: formData,
    });

    res = await res.text();

    createSuccessToast(
      "Eliminación exitosa",
      "Se ha eliminado el producto exitosamente.",
      true,
      3
    );
    await listProd();
    hideModalElim();
  } catch (error) {
    console.log(error.message);
    btnEliminar.removeAttribute("disabled");
    createErrorToast(
      "Error",
      "Ocurrió un error al conectar con el servidor.",
      false
    );
  }
}
