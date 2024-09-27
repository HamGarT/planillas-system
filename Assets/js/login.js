


/*frm.onsubmit=async (e) =>  {
       e.preventDefault();
       let response = await fetch (url, {
           method: 'POST',
           body: new FormData(frm)
       });
        
       let result= await response.text();
       console.log(result);
   }*/


function frmLogin(e) {
    e.preventDefault();
    const url = base_url + 'Usuarios/validar';
    const frm = document.getElementById('frmLogin');



    /*const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText)
        }
    }*/


    const options = {
        method: "POST",
        body: new FormData(frm)
    };

    const request = fetch(url, options);
    request.then(response => {
        if (response.ok) {
            return response.json();
        } else {
            throw 'error en llamada';
        }
    })
        .then(res => {
            if (res == 'ok') {
                window.location = base_url + 'Administracion/home';
            } else {
                document.getElementById('alert').classList.add('form__alert--enable');
                document.getElementById('alert').innerHTML = res;
            }
        })
        .catch(err => {
            console.log(err);
        });



}