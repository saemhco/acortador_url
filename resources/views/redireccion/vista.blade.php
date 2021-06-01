<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enlace corto</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
</head>

<body>
    <main class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <h2>Redireccionando en  <label id="number">10</label>...</h2>
                <div class="alert alert-primary">
                    <h4>Para continuar, hacer <a href="<?php echo $link->url_real ?>"> clic aquí</a></h4>
                </div>
                
            </div>
            <div class="col-12 mt-2 text-center" id="link"> </div>
            <div class="col-12 text-center">
                <div class="">
                    <h5 > Tu mejor opción</h5>
                    <img src="{{asset('img/innvacion.jpeg')}}">
                </div>
            </div>
            
        </div>
        
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            var raiz = "{{asset('')}}";
            document.addEventListener("DOMContentLoaded", () => {
                var l = document.getElementById("number");
                var n = 9;
                window.setInterval(function(){
                            if(n<1) n++;
                            l.innerHTML = n;
                            n--;
                },1000);

                setTimeout(async () => {
                    (async () => {
                        window.location.href = "{{$link->url_real}}";
                    })();
                }, 9000)
                
            });
        </script>
