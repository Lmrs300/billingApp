$(document).ready(function () {
    var fecha = new Date

    //obtener mes actual del calendario
    var month_act = fecha.getMonth() + 1
    //obtener año actual del calendario
    var year_act = fecha.getFullYear()

    //obtener el select del mes en el formulario de firefox
    var sel_month = document.getElementById("month")

    //obtener el valor actual del año seleccionado en el formulario de firefox
    var opt_sel_year = document.getElementById("year").value


    //corregir el valor del mes añadiendole un 0 a los valores de un digito. ej: 1 cambia a 01.
    if (month_act < 10) {
        month_act = "0" + month_act
    }

    //iniciacilizar vectores con los nombres y valores de los meses.
    var month_name = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

    var month_val = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"]

    var month_opt = ""

    //ver si la variable "mes_seleccionado" esta inicializada, en cuyo caso el formulario ya habra sido enviado.
    if (typeof mes_seleccionado !== 'undefined') {

        //crear las opciones de mes segun el año seleccionado.
        if (year_act == opt_sel_year) {
            for (i = 0; i < month_act; i++) {
                if (mes_seleccionado == month_val[i]) {
                    month_opt += "<option value='" + month_val[i] + "' selected>" + month_name[i] + "</option>"
                } else {
                    month_opt += "<option value='" + month_val[i] + "'>" + month_name[i] + "</option>";
                }
            }
        } else {
            for (i = 0; i < month_name.length; i++) {
                if (mes_seleccionado == month_val[i]) {
                    month_opt += "<option value='" + month_val[i] + "' selected>" + month_name[i] + "</option>"
                } else {
                    month_opt += "<option value='" + month_val[i] + "'>" + month_name[i] + "</option>";
                }
            }
        }
    } else {
        for (i = 0; i < month_act; i++) {
            if (month_act == month_val[i]) {
                month_opt += "<option value='" + month_val[i] + "' selected>" + month_name[i] + "</option>"
            } else {
                month_opt += "<option value='" + month_val[i] + "'>" + month_name[i] + "</option>";
            }
        }
    }


    //Colocar las opciones en el select del mes.
    sel_month.innerHTML = month_opt

    //resetar la variable "month_opt".
    month_opt = ""

    $("#year").change(function () {
        //obtener valor actual del año del select.
        opt_sel_year = document.getElementById("year").value

        //obtener valor actual del mes del select.
        opt_sel_month = document.getElementById("month").value - 1


        //crear las opciones de mes segun el año seleccionado.
        if (year_act == opt_sel_year) {

            for (i = 0; i < month_act; i++) {
                if (i == opt_sel_month) {
                    month_opt += "<option value='" + month_val[i] + "' selected>" + month_name[i] + "</option>";
                } else {
                    month_opt += "<option value='" + month_val[i] + "'>" + month_name[i] + "</option>";
                }



            }
            sel_month.innerHTML = month_opt
            month_opt = ""
        } else {
            for (i = 0; i < month_name.length; i++) {
                if (i == opt_sel_month) {
                    month_opt += "<option value='" + month_val[i] + "' selected>" + month_name[i] + "</option>";
                } else {
                    month_opt += "<option value='" + month_val[i] + "'>" + month_name[i] + "</option>";
                }
            }

            sel_month.innerHTML = month_opt
            month_opt = ""
        }
    })

})