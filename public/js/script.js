/*const form = document.querySelector(".wrapper form"),
fullURL = form.querySelector("input"),
shortenBtn = form.querySelector("form button"),
blurEffect = document.querySelector(".blur-effect"),
popupBox = document.querySelector(".popup-box"),
infoBox = popupBox.querySelector(".info-box"),
form2 = popupBox.querySelector("form"),
shortenURL = popupBox.querySelector("form .shorten-url"),
copyIcon = popupBox.querySelector("form .copy-icon"),
saveBtn = popupBox.querySelector("button");

form.onsubmit = (e)=>{
    e.preventDefault();
}

shortenBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/url-controll.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState == 4 && xhr.status == 200){
            let data = xhr.response;
            if(data.length <= 5){
                blurEffect.style.display = "block";
                popupBox.classList.add("show");

                //paste your url here. Like this: codingnepalweb.com/
                let domain = "localhost/url/"; 
                shortenURL.value = domain + data;
                copyIcon.onclick = ()=>{
                    shortenURL.select();
                    document.execCommand("copy");
                }

                saveBtn.onclick = ()=>{
                    form2.onsubmit = (e)=>{
                        e.preventDefault();
                    }

                    let xhr2 = new XMLHttpRequest();
                    xhr2.open("POST", "php/save-url.php", true);
                    xhr2.onload = ()=>{
                        if(xhr2.readyState == 4 && xhr2.status == 200){
                            let data = xhr2.response;
                            if(data == "success"){
                                location.reload();
                            }else{
                                infoBox.classList.add("error");
                                infoBox.innerText = data;
                            }
                        }
                    }
                    let shorten_url1 = shortenURL.value;
                    let hidden_url = data;
                    xhr2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhr2.send("shorten_url="+shorten_url1+"&hidden_url="+hidden_url);
                }
            }else{
                alert(data);
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}

*/

const blurEffect = document.querySelector(".blur-effect"),
popupBox = document.querySelector(".popup-box"),
infoBox = popupBox.querySelector(".info-box"),
form2 = popupBox.querySelector("form"),
shortenURL = popupBox.querySelector("form .shorten-url"),
copyIcon = popupBox.querySelector("form .copy-icon"),
saveBtn = popupBox.querySelector("button");


$(function() { 
    
$("#url").keypress(function(e) {
    if (e.which == 13) {
        $("#acortador").click();
        return false;
    }
});

$("#acortador").click(function(){
    var url = $("#url").val();
    if(!isValidURL(url)){
        isNotUrlAlert();
        return false;
    }
    $.ajax({
        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
        data:  {'url': url},
        url:   '/save_url',
        type: 'POST',
        beforeSend: function () {
            Swal.fire({
                title: 'Acortando enlace',
                icon:'info',
                allowEscapeKey: false,
                allowOutsideClick: false,
                // background: '#19191a',
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading()
                },
    
                // timer: 3000,
                // timerProgressBar: true
            });
        },
        success:  function (response){
               
            Swal.close();
            blurEffect.style.display = "block";
            popupBox.classList.add("show");
            
            $nueva_ruta_corta  = $raiz + response.url_corto;
            shortenURL.value =$nueva_ruta_corta;
            $("#url_corto").attr("href",$nueva_ruta_corta);
            
            saveBtn.onclick = ()=>{
                blurEffect.style.display = "none";
                popupBox.classList.remove("show");
                $("#table_data_1").html(`<a href='${$nueva_ruta_corta}' target='_blank'>${$nueva_ruta_corta}</a>`);
                $("#table_data_2").html(`<label>${response.url_real}</label>`);
                $("#urls-area").css("display","block");
                
            }

            
        },
        error: function (response){
            console.log("Error",response.data);
        }
    });
  })

    
  

    function isValidURL(url){
        var RegExp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;

        if(RegExp.test(url)){
            return true;
        }else{
            return false;
        }
    }
    
    function isNotUrlAlert(){
        Swal.fire({
            icon: 'error',
            title: '¡Error!',
            text: 'Ingrese una URL válida'
          })
    }

});
function copiar_url(){
    shortenURL.select();
    document.execCommand("copy");
  }
