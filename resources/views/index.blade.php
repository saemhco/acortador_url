

<!DOCTYPE html>
<!-- Coding By CodingNepal - youtube.com/codingnepal -->
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>URL Shortener in PHP | CodingNepal</title>
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  <!-- Iconsout Link for Icons -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    

</head>
<body>
  <div class="wrapper">
    <form id="form_acortador" autocomplete="off">
      <input type="web" id="url" spellcheck="false" name="full_url" placeholder="Ingrese o pegue una URL larga" required>
      <i class="url-icon uil uil-link"></i>
      <button id="acortador" type="button">Acortar</button>
    </form>  
    <div id="urls-area" style="display:none"> <br>
      <table class="table">
          <thead>
            <tr>
              <th>Enlace corto</th>
              <th>Enlace real</th>
            </tr>
          </thead>
          <tbody>
              <tr>
                <td id="table_data_1"></td>
                <td id="table_data_2"></td>
              </tr>
          </tbody>
      </table>        
    </div>     
  </div>

  <div class="blur-effect"></div>
  <div class="popup-box">
    <div class="info-box">Tu enlace corto está listo. Puede abrirlo haciendo <a href="#" id="url_corto" target="_blank"> clic aquí.</a></div>
      <form id="formulario" autocomplete="off">
        <label>Edit your shorten url</label>
        <input type="text" class="shorten-url" spellcheck="false" required>
        <i class="copy-icon uil uil-copy-alt" onclick="copiar_url()"></i>
        <button onClick="copiar_url()" class="col-sm-6" type="button">Copiar y cerrar</button>
      </form>
      
    </div>
  </div>
  
  
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script> var $raiz = "{{asset('')}}";</script>
  <script src="{{asset('js/script.js')}}"></script>

  <script>
  // $(function() { 
  // });
    
  </script>

</body>
</html>

