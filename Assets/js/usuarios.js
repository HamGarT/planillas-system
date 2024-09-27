let tblUsuarios, myModal;


document.addEventListener('DOMContentLoaded', function () {

    if (document.getElementById('myModal')) {
        myModal = new bootstrap.Modal(document.getElementById('myModal'));
    }

    tblUsuarios = $('#tblUsuarios').DataTable({
        responsive: true,
        processing: true,
        serverSide: false,
        ajax: {
            url: base_url + 'Usuarios/listar',
            type: 'get',
            dataType: 'json',
            dataSrc: ''
        },

        columns: [

            { 'data': 'id' },
            { 'data': 'username' },
            { 'data': 'nombre' },
            { 'data': 'correo' },
            { 'data': 'editar' },
            { 'data': 'eliminar' },
            { 'data': 'permisos' }
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
    });

    

});

function alertas(mensaje, icono) {
    Swal.fire({
        position: 'top-end',
        icon: icono,
        title: mensaje,
        showConfirmButton: false,
        timer: 3000
    })
}

function frmUsuario() {
    document.getElementById("title").textContent = "Nuevo Usuario";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("claves").classList.remove("d-none");
    document.getElementById("formulario").reset();
    document.getElementById("id").value = "";
    myModal.show();

}

function registrarUser(e) {
    e.preventDefault();
    const usuario = document.getElementById("usuario").value;
    const nombre = document.getElementById("nombre").value;
    const correo = document.getElementById("correo").value;

    if (usuario == "" || nombre == "" || correo == "") {
        alertas('Todo los campos son obligatorios', 'warning');
        return false;
    } else {
        const url = base_url + 'Usuarios/registrar';
        const frm = document.getElementById("formulario");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                myModal.hide();
                tblUsuarios.ajax.reload();
                alertas(res.msg, res.icono);
            }
        }
    }
}

function btnEliminarUser(id) {
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "El usuario no se eliminará de forma permanente, solo cambiará el estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + 'Usuarios/eliminar/' + id;
            const http = new XMLHttpRequest();
            http.open('GET', url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono);
                    tblUsuarios.ajax.reload();
                }
            }
        }
    });
}

function btnEditarUser(id){
    document.getElementById('title').textContent='Actualizar Usuario';
    document.getElementById("btnAccion").textContent = "Actualizar";
    const url = base_url + 'Usuarios/editar/' + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("usuario").value = res.username;
            document.getElementById("nombre").value = res.nombre;
            document.getElementById("correo").value = res.correo;
            document.getElementById("telefono").value = res.telefono;
            document.getElementById("claves").classList.add("d-none");
            myModal.show();
        }
    }
}





