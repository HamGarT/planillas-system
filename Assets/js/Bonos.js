let tblTpBonos, tblBonos;

document.addEventListener('DOMContentLoaded', function () {


    tblTpBonos = $('#tblTpBonos').DataTable(
        {
            responsive: true,
            processing: true,
            serverSide: false,
            ajax: {
                url: base_url + 'Bonos/listarTpBonos',
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

    tblBonos = $('#tblBonos').DataTable(
        {
            responsive: true,
            processing: true,
            serverSide: false,
            ajax: {
                url: base_url + 'Bonos/listarBonos',
                type: 'get',
                dataType: 'json',
                dataSrc: ''
            },

            columns: [

                { 'data': 'DNI' },
                { 'data': 'P_nombre' },
                { 'data': 'P_apellido' },
                { 'data': 'Bono' },
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
});


//---------------------------------------TIPO BONOS---------------------------------------------
function frmTpBonos() {
    document.getElementById("title").textContent = "Nuevo Bono";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("formulario").reset();
    document.getElementById("id_tpBono").value = "";
    myModal.show();
}
function registerTpBonos(e) {
    e.preventDefault();
    const url = base_url + 'Bonos/registerTpBonos';
    const frm = document.getElementById('formulario');
    const http = new XMLHttpRequest();
    http.open('POST', url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            myModal.hide();
            frm.reset();
            tblTpBonos.ajax.reload();
            alertas(res.msg, res.icon);
        }
    }
}
function btnEditarTpBono(id) {
    document.getElementById("title").textContent = "Editar Bono";
    document.getElementById("btnAccion").textContent = "Actualizar";
    const url = base_url + 'Bonos/getAllDataforEdirTpBono/' + id;
    const http = new XMLHttpRequest();
    http.open('POST', url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById('id_tpBono').value = res.id;
            document.getElementById('Nbono').value = res.descripcion;
            document.getElementById('montoBono').value = res.monto;
            myModal.show();
        }
    }

}
function btnEliminarTpBono(id) {
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "Este bono se eliminara permanentemente del registro",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + 'Bonos/sendDataForDeleteTpBono/' + id;
            const http = new XMLHttpRequest();
            http.open('GET', url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icon);
                    tblTpBonos.ajax.reload();
                }
            }
        }
    });
}


//-----------------------------------------BONOS--------------------------------------------------------------------------
function frmBonos(){
    document.getElementById("title").textContent = "Nuevo Bono";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("formulario").reset();
    document.getElementById("id").value = "";
    myModal.show();
}

function registerBono(e) {
    e.preventDefault();
    const url = base_url + 'Bonos/registerBono';
    const frm = document.getElementById('formulario');
    const http = new XMLHttpRequest();
    http.open('POST', url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            myModal.hide();
            frm.reset();
            tblBonos.ajax.reload();
            alertas(res.msg, res.icon);
        }
    }
}

function btnEditarBono(id){
    document.getElementById("title").textContent = "Editar Asignación de Bono";
    document.getElementById("btnAccion").textContent = "Actualizar";
    const url= base_url + 'Bonos/getDataforEditBono/'+id;
    const options={method: "GET"};
    fetch(url, options)
    .then(response=>{if (response.ok) return response.json();})
    .then(res=>{
        document.getElementById('id').value= res.id;
        console.log(res.id);
        document.getElementById('Bono_empleado').value= res.id_empleado;
        document.getElementById('id_Bono').value= res.id_tipoBono;
        myModal.show();

    })
}
function btnEliminarBono(id){
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "Este bono se eliminara permanentemente del registro",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + 'Bonos/sendDataforDeleteBono/' + id;
            const http = new XMLHttpRequest();
            http.open('GET', url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icon);
                    tblBonos.ajax.reload();
                }
            }
        }
    });
}
