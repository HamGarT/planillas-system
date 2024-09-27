
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo base_url;?>Assets/css/login.css">
</head>
<body>
    <div class="container">
        <div class="container__image">
            <img class="container__image1" src="<?php echo base_url;?>Assets/img/login.jpg" alt="" srcset="" >
        </div>
        <div class="container__form">
            <h2 class="container__form-title">
                LOGIN - PLANILLA
            </h2>
            <div class="container__form-div">
            <form id="frmLogin" class="form" onsubmit="frmLogin(event)">                
                <h5>Username</h5>
                <input class="form__input" type="text" name="username" id="username">

                <h5>Password</h5>
                <input class="form__input" type="password" name="password" id="password">

                <div class="form__alert" id='alert'> </div>

                <input class="form__input form__input--submit" type="submit" >
                
            </form>
            </div>
            <p class="container__form-pass btn-login">¿Has olvidado <a href="">Contraseña</a>?</p> 
        </div>
    </div>
    
    <script>
        const base_url= '<?php echo base_url; ?>'
   </script>
   <script src="<?php echo base_url;?>Assets/js/login.js"></script>
   
</body>
</html>
