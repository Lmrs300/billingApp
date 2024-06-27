const urlCli = "../../../Controllers/cliente_controller.php";

async function listCli() {
  const clientes = await getCli();

  const tbody = $("table tbody");

  tbody.html("");

  clientes.forEach((cli) => {
    tbody.append(
      `<tr id_reg="${cli.id_cli}"><td>${cli.ced_rif_cli}</td><td>${cli.nom_cli}</td><td>${cli.tel_cli}</td><td>${cli.dir_cli}</td><td><button type="button" class="editar"><img src="../../imgs/edit.svg"></button><button type="button" class="eliminar"><img src="../../imgs/delete.svg"></button></td></tr>`
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

async function getCli() {
  const formData = new FormData();

  formData.append("accion", "get_cli");

  try {
    const res = await fetch(urlCli, {
      method: "post",
      body: formData,
    });

    const clientes = await res.json();

    return clientes;
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
  //verificar que la cédula o rif sea valido

  const regexLetter = /[a-zA-Z]{2,}/;

  const regexEsp = /[!"#$%&'()*+,/:;<=>?@\[\]^_{|}~]/;

  if (
    regexLetter.test(formData.get("ced_rif_cli")) ||
    regexEsp.test(formData.get("ced_rif_cli"))
  ) {
    createErrorToast("Error", `Ingrese una cédula o RIF valido`);
    return false;
  }

  //verificar que la cedula o rif del cliente no sea el de un cliente registrado

  const clientes = await getCli();

  let errorCedRif = false;

  clientes.forEach((cli) => {
    if (
      cli["ced_rif_cli"] == formData.get("ced_rif_cli") &&
      cli["id_cli"] != id_edit
    ) {
      errorCedRif = true;
    }
  });

  if (errorCedRif == true) {
    createErrorToast(
      "Error",
      `Ya existe un cliente registrado con la cédula/RIF: <b>${formData.get(
        "ced_rif_cli"
      )}</b>.`
    );
    return false;
  }

  //verificar que el teléfono del cliente no sea el de un cliente registrado

  let errorTel = false;

  clientes.forEach((cli) => {
    if (
      cli["nom_cli"].toLowerCase() == formData.get("nom_cli").toLowerCase() &&
      cli["id_cli"] != id_edit
    ) {
      errorTel = true;
    }
  });

  if (errorTel == true) {
    createErrorToast(
      "Error",
      `Ya existe un cliente registrado con el teléfono: <b>${formData.get(
        "nom_cli"
      )}</b>.`
    );
    return false;
  }

  return true;
}

async function addCli(e) {
  e.preventDefault();

  const btnAgregar = document.getElementById("btn-agregar");

  const formData = new FormData(e.target);

  const validateDatos = await verifyDatos(formData);

  if (validateDatos == false) {
    return;
  }

  //enviar al servidor
  btnAgregar.disabled = true;

  formData.set("accion", "add_cli");

  try {
    let res = await fetch(urlCli, {
      method: "post",
      body: formData,
    });

    res = await res.text();

    createSuccessToast(
      "Registro exitoso",
      "Se ha añadido el cliente exitosamente.",
      true,
      3
    );
    await listCli();
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

async function editCli(e) {
  e.preventDefault();

  const btnEdit = document.getElementById("btn-edit");

  const formData = new FormData(e.target);

  const regSelect = document.querySelector(".reg_select");

  const id_cli = regSelect.getAttribute("id_reg");

  const validateDatos = await verifyDatos(formData, id_cli);

  if (validateDatos == false) {
    return;
  }

  //enviar al servidor
  btnEdit.disabled = true;

  formData.set("id_cli", id_cli);

  formData.set("accion", "edit_cli");

  try {
    let res = await fetch(urlCli, {
      method: "post",
      body: formData,
    });

    res = await res.text();

    createSuccessToast(
      "Modificación exitosa",
      "Se ha modificado el cliente exitosamente.",
      true,
      3
    );

    await listCli();
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

async function deleteCli() {
  const btnEliminar = document.getElementById("btn-eliminar");

  const regSelect = document.querySelector(".reg_select");

  const id_cli = regSelect.getAttribute("id_reg");

  const formData = new FormData();

  //enviar al servidor
  btnEliminar.disabled = true;

  formData.set("id_cli", id_cli);

  formData.set("accion", "delete_cli");

  try {
    let res = await fetch(urlCli, {
      method: "post",
      body: formData,
    });

    res = await res.text();

    createSuccessToast(
      "Eliminación exitosa",
      "Se ha eliminado el cliente exitosamente.",
      true,
      3
    );
    await listCli();
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
