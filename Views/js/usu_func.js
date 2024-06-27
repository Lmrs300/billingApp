const urlUsu = "../../../Controllers/usuario_controller.php";

async function listUsu() {
  const usuarios = await getUsu();

  const tbody = $("table tbody");

  tbody.html("");

  usuarios.forEach((usu) => {
    tbody.append(
      `<tr id_reg="${usu.id_usu}"><td>${usu.ced_usu}</td><td>${usu.nom_usu}</td><td>${usu.contra}</td><td><button type="button" class="editar"><img src="../../imgs/edit.svg"></button><button type="button" class="eliminar"><img src="../../imgs/delete.svg"></button></td></tr>`
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

  const btnAgregar = document.getElementById("btn_agregar");

  var modal = $("#modal-contenedor-form");

  modal.fadeOut(200, () => {
    modal.parent("#modal-fade-form").fadeOut(200);

    form.reset();

    btnAgregar.removeAttribute("disabled");
  });
}

async function getUsu() {
  const formData = new FormData();

  formData.append("accion", "get_usu");

  try {
    const res = await fetch(urlUsu, {
      method: "post",
      body: formData,
    });

    const usuarios = await res.json();

    return usuarios;
  } catch (e) {
    console.error("Error", e.message);

    createErrorToast(
      "Error",
      "Ocurrió un error al conectar con el servidor.",
      false
    );
  }
}

async function verifyDatos(formData, url = urlUsu, id_edit = 0) {
  //verificar si el nombre contiene números

  for (let i = 0; i < formData.get("nom_usu").length; i++) {
    if (!isNaN(parseFloat(formData.get("nom_usu")[i]))) {
      createErrorToast("Error", "El nombre no puede contener números.");
      return false;
    }
  }

  //verificar de que no haya espacios en blanco en la contraseña

  if (formData.get("contra").includes(" ")) {
    createErrorToast(
      "Error",
      "La contraseña no puede tener espacios en blanco."
    );
    return false;
  }

  //verificar que hayan caracteres alfabéticos en contraseña

  //verificar que hayan mayúsculas en la contraseña

  if (formData.get("contra") == formData.get("contra").toLowerCase()) {
    createErrorToast(
      "Error",
      "Error: La contraseña debe contener al menos una letra mayúscula."
    );
    return false;
  }

  //verificar que hayan minúsculas en la contraseña

  if (formData.get("contra") == formData.get("contra").toUpperCase()) {
    createErrorToast(
      "Error",
      "Error: La contraseña debe contener al menos una letra minúscula."
    );
    return false;
  }

  //verificar que hayan números en la contraseña

  const regexNum = /[0-9]/;

  if (!regexNum.test(formData.get("contra"))) {
    createErrorToast(
      "Error",
      "Error: La contraseña debe contener al menos un carácter numérico."
    );
    return false;
  }

  //verificar que haya al menos un carácter especial en contraseña.

  const regexEsp = /[!"#$%&'*+-./?_~]/;

  if (!regexEsp.test(formData.get("contra"))) {
    createErrorToast(
      "Error",
      "Error: La contraseña debe contener al menos uno de los siguientes caracteres especiales: <b>!</b>, <b>\"</b>, <b>#</b>, <b>$</b>, <b>%</b>, <b>&</b>, <b>'</b>, <b>*</b>, <b>+</b>, <b>-</b>, <b>.</b>, <b>/</b>, <b>?</b>, <b>_</b>, <b>~</b>."
    );
    return false;
  }

  if (formData.get("contra").length > 20) {
    //verificar que hayan menos de 21 caracteres en la contraseña.

    createErrorToast(
      "Error",
      "Error: La contraseña debe ser de máximo 20 caracteres."
    );
    return false;
  }

  //verificar que hayan mas de 5 caracteres en la contraseña.

  if (formData.get("contra").length < 6) {
    createErrorToast(
      "Error",
      "Error: La contraseña debe ser de mínimo 6 caracteres."
    );
    return false;
  }

  if (formData.get("contra") != formData.get("con_contra")) {
    //verificar si las contraseñas coinciden

    createErrorToast("Error", "Las contraseñas no coinciden.");
    return false;
  }

  //verificar que la cédula del usuario no sea de un usuario registrado

  const usuarios = await getUsu(url);

  let errorCed = false;

  usuarios.forEach((usu) => {
    if (usu["ced_usu"] == formData.get("ced_usu") && usu["id_usu"] != id_edit) {
      errorCed = true;
    }
  });

  if (errorCed == true) {
    createErrorToast(
      "Error",
      `Ya existe un usuario registrado con la cédula: <b>${formData.get(
        "ced_usu"
      )}</b>.`
    );
    return false;
  }

  return true;
}

async function addUsu(e, url = urlUsu, register = false) {
  e.preventDefault();

  const btnAgregar = document.getElementById("btn_agregar");

  const formData = new FormData(e.target);

  const validateDatos = await verifyDatos(formData, url);

  if (validateDatos == false) {
    return;
  }

  //enviar al servidor
  btnAgregar.disabled = true;

  formData.set("accion", "add_usu");

  try {
    let res = await fetch(url, {
      method: "post",
      body: formData,
    });

    res = await res.text();

    if (register == true) {
      createSuccessToast(
        "Registro exitoso",
        "Se ha registrado exitosamente.",
        true,
        3
      );
      setTimeout(() => {
        window.location.replace("./iniciar_sesion.php");
        btnAgregar.removeAttribute("disabled");
      }, 3500);
    } else {
      createSuccessToast(
        "Registro exitoso",
        "Se ha añadido el usuario exitosamente.",
        true,
        3
      );
      await listUsu();
      hideModalAgreg();
      btnAgregar.removeAttribute("disabled");
    }
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

async function editUsu(e) {
  e.preventDefault();

  const btnEdit = document.getElementById("btn-edit");

  const formData = new FormData(e.target);

  const regSelect = document.querySelector(".reg_select");

  const id_usu = regSelect.getAttribute("id_reg");

  const validateDatos = await verifyDatos(formData, urlUsu, id_usu);

  if (validateDatos == false) {
    return;
  }

  //enviar al servidor
  btnEdit.disabled = true;

  formData.set("id_usu", id_usu);

  formData.set("accion", "edit_usu");

  try {
    let res = await fetch(urlUsu, {
      method: "post",
      body: formData,
    });

    res = await res.text();

    createSuccessToast(
      "Modificación exitosa",
      "Se ha modificado el usuario exitosamente.",
      true,
      3
    );

    await listUsu();
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

async function deleteUsu() {
  const btnEliminar = document.getElementById("btn-eliminar");

  const regSelect = document.querySelector(".reg_select");

  const id_usu = regSelect.getAttribute("id_reg");

  const formData = new FormData();

  //enviar al servidor
  btnEliminar.disabled = true;

  formData.set("id_usu", id_usu);

  formData.set("accion", "delete_usu");

  try {
    let res = await fetch(urlUsu, {
      method: "post",
      body: formData,
    });

    res = await res.text();

    createSuccessToast(
      "Eliminación exitosa",
      "Se ha eliminado el usuario exitosamente.",
      true,
      3
    );
    await listUsu();
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
