let tblEmpleados, tblAnticipos, tblDescuentos, tblTipDescuentos, tblImpuestoRenta;
document.addEventListener('DOMContentLoaded', function () {
    if (document.getElementById('myModal1')) {
        myModal1 = new bootstrap.Modal(document.getElementById('myModal1'));
    }
    tblEmpleados = $('#tblEmpleados').DataTable(
        {
            responsive: true,
            processing: true,
            serverSide: false,
            ajax: {
                url: base_url + 'Empleados/listar',
                type: 'get',
                dataType: 'json',
                dataSrc: ''
            },

            columns: [

                { 'data': 'id' },
                { 'data': 'DNI' },
                { 'data': 'P_nombre' },
                { 'data': 'S_nombre' },
                { 'data': 'P_apellido' },
                { 'data': 'S_apellido' },
                { 'data': 'edad' },
                { 'data': 'direccion' },
                { 'data': 'cargo' },
                { 'data': 'area' },
                { 'data': 'editar' },
                { 'data': 'eliminar' }
            ],
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
            },

            resonsieve: true,
            bDestroy: true,
            iDisplayLength: 10,
            order: [
                [0, "desc"]
            ]
        }
    );

    tblAnticipos = $('#tblAnticipos').DataTable(
        {
            responsive: true,
            processing: true,
            serverSide: false,
            ajax: {
                url: base_url + 'Anticipos/listar',
                type: 'get',
                dataType: 'json',
                dataSrc: ''
            },
            columns: [
                { 'data': 'DNI' },
                { 'data': 'NombresC' },
                { 'data': 'monto' },
                { 'data': 'estado' },
                { 'data': 'fecha'},
                { 'data': 'editar' },
                { 'data': 'eliminar' }
            ],
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
            },

            resonsieve: true,
            bDestroy: true,
            iDisplayLength: 10,
            order: [
                [0, "desc"]
            ]
        }
    );

    tblDescuentos = $('#tblDescuentos').DataTable(
        {
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: base_url + 'Descuentos/listar',
                type: 'get',
                dataType: 'json',
                dataSrc: ''
            },
            columns: [
                { 'data': 'DNI' },
                { 'data': 'P_nombre' }, 
                { 'data': 'P_apellido' },
                { 'data': 'descuento' },
                { 'data': 'editar' },
                { 'data': 'eliminar' }
            ],

            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
            },

            resonsieve: true,
            bDestroy: true,
            iDisplayLength: 10,
            order: [
                [0, "desc"]
            ]
        }
    );

    tblTipDescuentos = $('#tblTipDescuentos').DataTable(
        {
            responsive: true,
            processing: true,
            serverSide: false,
            ajax: {
                url: base_url + 'Descuentos/listarTpDescuentos',
                type: 'get',
                dataType: 'json',
                dataSrc: ''
            },

            columns: [

                { 'data': 'id' },
                { 'data': 'descripcion' },
                { 'data': 'monto' },
                { 'data': 'editar' },
                { 'data': 'eliminar' }



            ],
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
            },

            resonsieve: true,
            bDestroy: true,
            iDisplayLength: 10,
            order: [
                [0, "desc"]
            ]
        }
    );
    tblImpuestoRenta = $('#tblImpuestoRenta').DataTable(
        {
            responsive: true,
            processing: true,
            serverSide: false,
            ajax: {
                url: base_url + 'Descuentos/listarIR',
                type: 'get',
                dataType: 'json',
                dataSrc: ''
            },
            columns: [
                { 'data': 'id' },
                { 'data': 'descripcion' },
                { 'data': 'monto' },
                { 'data': 'editar' }
               
            ],
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
            },

            resonsieve: true,
            bDestroy: true,
            iDisplayLength: 10,
            order: [
                [0, "desc"]
            ]
        }
    );
})

function frmEmpleados() {
    document.getElementById("title").textContent = "Nuevo Empleado";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("formulario").reset();
    document.getElementById("id").value = "";
    myModal.show();
}

function registrarEmpleado(e) {
    e.preventDefault();
    const url = base_url + 'Empleados/registrar';
    const frm = document.getElementById('formulario');
    const http = new XMLHttpRequest();
    http.open('POST', url, true);
    console.log(new  FormData(frm).values);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            myModal.hide();
            frm.reset();
            tblEmpleados.ajax.reload();
            alertas(res.msg, res.icon);
        }
    }
}

function btnEditarEmpleado(id) {
    document.getElementById("title").textContent = "Editar Empleado";
    document.getElementById("btnAccion").textContent = "Actualizar";
    const url = base_url + 'Empleados/editar/' + id;
    const http = new XMLHttpRequest();
    http.open('POST', url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById('id').value = res.id;
            document.getElementById('dni').value = res.DNI;
            document.getElementById('p_nombre').value = res.P_nombre;
            document.getElementById('s_nombre').value = res.S_nombre;
            document.getElementById('p_apellido').value = res.P_apellido;
            document.getElementById('s_apellido').value = res.S_apellido;
            document.getElementById('edad').value = res.edad;
            document.getElementById('fech_nacimiento').value = res.fecha_nacimiento;
            document.getElementById('direccion').value = res.direccion;
            document.getElementById('cargo').value = res.id_cargo;
            myModal.show();

        }
    }
}

function btnEliminarEmpleado(id) {
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "Esta Empleado se eliminara permanentemente del registro",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + 'Empleados/delete/' + id;
            const http = new XMLHttpRequest();
            http.open('GET', url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icon);
                    tblEmpleados.ajax.reload();
                }
            }
        }
    });
}

//----------------------------------------ANTICIPOS EMPLEADOS----------------------------------------------------------------------------
function frmAnticipos() {
    document.getElementById("title").textContent = "Nuevo Solicitud";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("formulario").reset();
    document.getElementById("id").value = "";
    myModal.show();
}

function registerAnticipo(e) {
    e.preventDefault();
    
    const url = base_url + 'Anticipos/register';
    const frm = document.getElementById('formulario');
    const http = new XMLHttpRequest();
    http.open('POST', url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            frm.reset();
            myModal.hide();
            tblAnticipos.ajax.reload();
            alertas(res.msg, res.icon);
        }
    }
}

function btnEditarAnticipo(id) {
    document.getElementById("title").textContent = "Editar solicitud de anticipo";
    document.getElementById("btnAccion").textContent = "Actualizar";
    const url = base_url + 'Anticipos/edit/' + id;
    const http = new XMLHttpRequest();
    http.open('POST', url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById('id').value = res.id;
            document.getElementById('mon_anticipo').value = res.monto;
            document.getElementById('fech_anticipo').value = res.fecha;
            document.getElementById('estado').value = res.estado;
            document.getElementById('empleado').value = res.id_empleado;
            myModal.show();
        }
    }
}

function btnEliminarAnticipo(id) {
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "Esta solicitud de anticipo se eliminara permanentemente",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + 'Anticipos/delete/' + id;
            const http = new XMLHttpRequest();
            http.open('GET', url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icon);
                    tblAnticipos.ajax.reload();
                }
            }
        }
    });
}

//----------------------------------------DESCUENTOS EMPLEADOS----------------------------------------------------------------------------
function frmDescuentos() {
    document.getElementById("title").textContent = "Nueva Solicitud";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("formulario").reset();
    document.getElementById("id").value = "";
    
    myModal.show();
}

function registerDescuento(e) {
    e.preventDefault();
    const url = base_url + 'Descuentos/registerDescuento';
    const frm = document.getElementById('formulario');
    const http = new XMLHttpRequest();
    http.open('POST', url , true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            frm.reset();
            myModal.hide();
            tblDescuentos.ajax.reload();
            alertas(res.msg, res.icon);
        }
    }
}

function btnEditarDescuento(id){
    document.getElementById("title").textContent = "Actualizar asignación de descuento";
    document.getElementById("btnAccion").textContent = "Modificar";
    const url = base_url + 'Descuentos/editDescuento/' + id;
    const http = new XMLHttpRequest();
    http.open('GET', url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById('id').value = res.id;
            console.log(res.id_tipoDescuento);
            document.getElementById('empleado').value = res.id_empleado;
            if (res.id_tipoDescuento >= 39 && res.id_tipoDescuento <= 43) {
                document.getElementById('id_descuentos').value = 'IR';
            } else {
                document.getElementById('id_descuentos').value = res.id_tipoDescuento;
            }
            myModal.show();
        }
    }
}
function btnEliminarDescuento(id) {
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "este tipo de descuento se eliminara permanentemente",    
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + 'Descuentos/deleteDescuento/' + id;
            const http = new XMLHttpRequest();
            http.open('GET', url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icon);
                    tblDescuentos.ajax.reload();
                }
            }
        }
    });
}
//----------------------------------------TIPOSDESCUENTOS EMPLEADOS----------------------------------------------------------------------------

function frmTpDescuentos() {
   
    document.getElementById('title').textContent = 'Nuevo Descuento';
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("formulario").reset();
    document.getElementById('id').value = ''; 
    myModal.show();
}
function registerTpDescuento(e) {
    e.preventDefault();
    const url = base_url + 'Descuentos/registerTpDescuento';
    const frm = document.getElementById('formulario');
    const http = new XMLHttpRequest();
    http.open('POST', url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            alertas(res.msg, res.icon);
            frm.reset();
            myModal.hide();
            tblTipDescuentos.ajax.reload();
            tblImpuestoRenta.ajax.reload();
        }
    }
}

function btnEliminarTpDescuento(id) {
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "este tipo de descuento se eliminara permanentemente",    
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + 'Descuentos/deleteTpDescuento/' + id;
            const http = new XMLHttpRequest();
            http.open('GET', url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icon);
                    tblTipDescuentos.ajax.reload();
                }
            }
        }
    });
}

function btnEditarTpDescuento(id) {
    if(id >= 39 && id <= 43) document.getElementById('mon_descuento').readOnly = true; else document.getElementById('mon_descuento').readOnly = false;
    document.getElementById("title").textContent = "Actualizar descuento";
    document.getElementById("btnAccion").textContent = "Modificar";
    const url = base_url + 'Descuentos/editTpDescuento/' + id;
    const http = new XMLHttpRequest();
    http.open('GET', url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById('id_tpDescuentos').value = res.id;
            document.getElementById('mon_descuento').value = res.descripcion;
            document.getElementById('porcent').value = res.monto;
            myModal.show();
        }
    }

}

/*function btnEditIR(id){
    const url = base_url + 'Descuentos/getDataEditIR/' + id;
    const http= new XMLHttpRequest();
    http.open('GET', url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById('id_IR').value = res.id;
            document.getElementById('IR').value = res.descripcion;
            document.getElementById('percent_ir').value = res.monto;
            myModal .show();
        }
    }
}*/