const urlFac = "../../../Controllers/factura_controller.php";
const urlCli = "../../../Controllers/cliente_controller.php";
const urlUsu = "../../../Controllers/usuario_controller.php";
const urlProd = "../../../Controllers/producto_controller.php";

async function listFac() {
  const facturas = await getFac();

  const tbody = $(".principal_table tbody");

  tbody.html("");

  facturas.forEach((fac) => {
    let newFecha = convertFec_hor_span(fac.fec_fac);

    tbody.append(
      `<tr id_reg="${fac.id_fac}"><td>${fac.serial_fac}</td><td>${newFecha}</td><td>${fac.nom_cli}</td><td>${fac.nom_usu}</td><td><button type="button" class="ver_prod" title="Ver productos"><img src="../../imgs/eye_white.svg"></button></td><td>${fac.met_pago}</td><td>${fac.monto_fac}</td><td>${fac.iva_fac}%</td><td>${fac.total_fac}</td><td><button type="button" class="editar" title="Editar"><img src="../../imgs/edit.svg"></button><button type="button" class="eliminar" title="Eliminar"><img src="../../imgs/delete.svg"></button><a href="factura_reporte.php?id_fac=${fac.id_fac}" class="reporte" title="Generar factura"><button type="button"><img src="../../imgs/bill.svg"></button></a></td></tr>`
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

  const btnVerProdTable = document.querySelectorAll(".ver_prod");

  btnVerProdTable.forEach((btn) => {
    btn.addEventListener("click", (e) => showModalVerProd(e));
  });

  const btnAgregElimProdTable = document.querySelectorAll(".agreg_elim_prod");

  btnAgregElimProdTable.forEach((btn) => {
    btn.addEventListener("click", (e) => showModalAgregElimProd(e));
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

async function getFac() {
  const formData = new FormData();

  formData.append("accion", "get_fac");

  try {
    const res = await fetch(urlFac, {
      method: "post",
      body: formData,
    });

    const facturas = await res.json();

    return facturas;
  } catch (e) {
    console.error("Error", e.message);

    createErrorToast(
      "Error",
      "Ocurrió un error al conectar con el servidor.",
      false
    );
  }
}

async function getProdVen(id_fac) {
  const formData = new FormData();

  formData.append("id_fac", id_fac);

  formData.append("accion", "get_prod_ven");

  try {
    const res = await fetch(urlFac, {
      method: "post",
      body: formData,
    });

    const prodVen = await res.json();

    return prodVen;
  } catch (e) {
    console.error("Error", e.message);

    createErrorToast(
      "Error",
      "Ocurrió un error al conectar con el servidor.",
      false
    );
  }
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

async function loadDataCli() {
  const clientes = await getCli();

  clientes.forEach((cli) => {
    $("#nom_cli").append(
      `<option value="${cli.nom_cli}">${cli.nom_cli}</option>`
    );

    $("#nom_cli_edit").append(
      `<option value="${cli.nom_cli}">${cli.nom_cli}</option>`
    );
  });
}

async function loadDataUsu() {
  const usuarios = await getUsu();

  usuarios.forEach((usu) => {
    $("#nom_usu").append(
      `<option value="${usu.nom_usu}">${usu.nom_usu}</option>`
    );

    $("#nom_usu_edit").append(
      `<option value="${usu.nom_usu}">${usu.nom_usu}</option>`
    );
  });
}

async function loadDataProd() {
  const productos = await getProd();

  productos.forEach((prod) => {
    $("#prod_ven").append(
      `<option value="${prod.nom_prod}">${prod.nom_prod}</option>`
    );
  });
}

async function verifyDatos(formData, id_edit = 0) {
  //verificar que en el serial de la factura no hayan espacios

  if (formData.get("serial_fac").includes(" ")) {
    createErrorToast("Error", "El serial no puede tener espacios en blanco.");
    return false;
  }

  //verificar que el serial de la factura no sea el de una factura registrada

  const facturas = await getFac();

  let errorSerial = false;

  facturas.forEach((fac) => {
    if (
      fac["serial_fac"] == formData.get("serial_fac") &&
      fac["id_fac"] != id_edit
    ) {
      errorSerial = true;
    }
  });

  if (errorSerial == true) {
    createErrorToast(
      "Error",
      `Ya existe una factura registrada con el serial: <b>${formData.get(
        "serial_fac"
      )}</b>.`
    );
    return false;
  }

  return true;
}

async function addFac(e) {
  e.preventDefault();

  const btnAgregar = document.getElementById("btn-agregar");

  const formData = new FormData(e.target);

  const validateDatos = await verifyDatos(formData);

  if (validateDatos == false) {
    return;
  }

  //enviar al servidor
  btnAgregar.disabled = true;

  formData.set("accion", "add_fac");

  try {
    let res = await fetch(urlFac, {
      method: "post",
      body: formData,
    });

    res = await res.text();

    createSuccessToast(
      "Registro exitoso",
      "Se ha añadido la factura exitosamente.",
      true,
      3
    );
    await listFac();
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

async function addProdVen(e) {
  e.preventDefault();

  const btnProdAgregar = document.querySelector(
    "#modal-contenedor-ver-prod #btn-agregar"
  );

  const id_fac = $(".reg_select").attr("id_reg");

  const formData = new FormData(e.target);

  formData.set("id_fac", id_fac);

  //enviar al servidor
  btnProdAgregar.disabled = true;

  formData.set("accion", "add_prod_ven");

  try {
    let res = await fetch(urlFac, {
      method: "post",
      body: formData,
    });

    res = await res.text();

    e.target.reset();
    await loadTableVerProd(id_fac);
    btnProdAgregar.removeAttribute("disabled");
  } catch (error) {
    console.log(error.message);
    btnProdAgregar.removeAttribute("disabled");
    createErrorToast(
      "Error",
      "Ocurrió un error al conectar con el servidor.",
      false
    );
  }
}

async function editFac(e) {
  e.preventDefault();

  const btnEdit = document.getElementById("btn-edit");

  const formData = new FormData(e.target);

  const regSelect = document.querySelector(".reg_select");

  const id_fac = regSelect.getAttribute("id_reg");

  const validateDatos = await verifyDatos(formData, id_fac);

  if (validateDatos == false) {
    return;
  }

  //enviar al servidor
  btnEdit.disabled = true;

  formData.set("id_fac", id_fac);

  formData.set("accion", "edit_fac");

  try {
    let res = await fetch(urlFac, {
      method: "post",
      body: formData,
    });

    res = await res.text();

    createSuccessToast(
      "Modificación exitosa",
      "Se ha modificado la factura exitosamente.",
      true,
      3
    );

    await listFac();
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

async function deleteFac() {
  const btnEliminar = document.getElementById("btn-eliminar");

  const regSelect = document.querySelector(".reg_select");

  const id_fac = regSelect.getAttribute("id_reg");

  const formData = new FormData();

  //enviar al servidor
  btnEliminar.disabled = true;

  formData.set("id_fac", id_fac);

  formData.set("accion", "delete_fac");

  try {
    let res = await fetch(urlFac, {
      method: "post",
      body: formData,
    });

    res = await res.text();

    createSuccessToast(
      "Eliminación exitosa",
      "Se ha eliminado la factura exitosamente.",
      true,
      3
    );
    await listFac();
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

async function deleteProdVen(e) {
  const btnEliminarProd = e.target;

  const regSelect = document.querySelector(".reg_select");

  const id_fac = regSelect.getAttribute("id_reg");

  const regProd = e.currentTarget.parentElement.parentElement;

  const id_cant_prod_ven = regProd.getAttribute("id_reg");

  const formData = new FormData();

  formData.set("prec_prod", regProd.children[1].innerText.replace("Bs", ""));

  formData.set("cant_ven", regProd.children[2].innerText);

  formData.set("id_cant_prod_ven", id_cant_prod_ven);

  formData.set("id_fac", id_fac);

  formData.set("accion", "delete_prod_ven");

  //enviar al servidor
  btnEliminarProd.disabled = true;

  try {
    let res = await fetch(urlFac, {
      method: "post",
      body: formData,
    });

    res = await res.text();

    await loadTableVerProd(id_fac);
  } catch (error) {
    console.log(error.message);
    btnEliminarProd.removeAttribute("disabled");
    createErrorToast(
      "Error",
      "Ocurrió un error al conectar con el servidor.",
      false
    );
  }
}

function convertFec_hor_span(fecha) {
  const fecha_orig = new Date(Date.parse(fecha));

  let day = fecha_orig.getDate();
  if (String(day).length != 2) {
    day = "0" + day;
  }

  let month = fecha_orig.getMonth() + 1;
  if (String(month).length != 2) {
    month = "0" + month;
  }

  let year = fecha_orig.getFullYear();

  let hours = fecha_orig.getHours();

  if (String(hours).length != 2) {
    hours = "0" + hours;
  }

  let minutes = fecha_orig.getMinutes();
  if (String(minutes).length != 2) {
    minutes = "0" + minutes;
  }

  const newFecha = `${day}-${month}-${year} ${hours}:${minutes}`;

  return newFecha;
}

function convertFec_hor_eng(fecha) {
  const day = fecha.substr(0, 2);
  const month = fecha.substr(3, 2);
  const year = fecha.substr(6, 4);
  const hours = fecha.substr(11, 2);
  const minutes = fecha.substr(14, 2);

  const newFecha = `${year}-${month}-${day} ${hours}:${minutes}`;

  return newFecha;
}

function delZero(num) {
  let newNum = num.toString();

  while (newNum[-1] == "0") {
    newNum = newNum.slice(0, -1);
  }

  return Number.parseFloat(newNum);
}
