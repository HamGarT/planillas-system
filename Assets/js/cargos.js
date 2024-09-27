
let tblCargos;
document.addEventListener('DOMContentLoaded', function () {

    tblCargos = $('#tblCargos').DataTable(
        {
            responsive: true,
            processing: true,
            serverSide: false,
            ajax: {
                url: base_url + 'Cargos/listar',
                type: 'get',
                dataType: 'json',
                dataSrc: ''
            },

            columns: [

                { 'data': 'id' },
                { 'data': 'nom_Cargo' },
                { 'data': 'nom_area' },
                { 'data': 'sueldo' },
                { 'data': 'editar' },
                { 'data': 'eliminar' },
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
});

function frmCargos() {
    document.getElementById("title").textContent = "Nuevo Cargo";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("formulario").reset();
    document.getElementById("id_cargo").value = "";
    myModal.show();
}

function registrarCargo(e) {
    e.preventDefault();
    console.log('joder');
    
    const url = base_url + 'Cargos/registrar';
    const frm = document.getElementById("formulario");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            frm.reset();
            myModal.hide();
            tblCargos.ajax.reload();
            alertas(res.msg, res.icono);
        }
    }

}

function btnEditarCargo(id) {
    document.getElementById('title').textContent = 'Actualizar Cargo';
    document.getElementById("btnAccion").textContent = "Actualizar";
    const url = base_url + 'Cargos/editar/' + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById('id_cargo').value = res.id;
            document.getElementById("cargo").value = res.nom_Cargo;
            document.getElementById("area").value = res.id_area;
            document.getElementById('sueldo_cargo').value = res.sueldo;
            myModal.show();
        }
    }
}
function btnEliminarCargo(id) {
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "El Cargo se eliminará de forma permanente",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + 'Cargos/eliminar/' + id;
            const http = new XMLHttpRequest();
            http.open('GET', url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono);
                    tblCargos.ajax.reload();
                }
            }
        }
    });
}