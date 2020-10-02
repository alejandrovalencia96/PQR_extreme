$(document).ready(function(){

  $('#liveSearchUsuario').select2({
         placeholder: 'Seleccione un usuario',
         width: '100%',
         ajax: {
           url: 'ajax/getUsuarios.php',
           dataType: 'json',
           delay: 250,
           processResults: function (data) {
             return {
               results: data
             };
           },
           cache: true
         }
       });

   //     $('#fecha_creacion').datetimepicker({
   //     timepicker:false,
   //    			format: 'Y-m-d',
   //    			formatDate: 'Y-m-d',
   //     minDate:'-1970/01/02',//yesterday is minimum date(for today use 0 or -1970/01/01)
   //     //maxDate:'+1970/01/02'//tomorrow is maximum date calendar
   //   });
   });


   $("#tipo").change(function(){

     let tipo = $(this).val();
     let fecha_creacion = $("#fecha_creacion").val();
     let dias;

     if(tipo == 'peticion'){
       dias = 7;
     }else if(tipo == 'queja'){
       dias = 3;
     }else{
       dias = 2;
     }

     let date = new Date(fecha_creacion);
     date.setDate(date. getDate() + dias);
     let dd = date.getDate().toString().padStart(2, "0");
     let mm = (date.getMonth() + 1).toString().padStart(2, "0");
     let yyyy = date.getFullYear();

     let someFormattedDate = yyyy+'-'+mm+'-'+dd;
     $("#fecha_limite").val(someFormattedDate);
   });


     $("#añadirPQR").submit(function(e){
       e.preventDefault();

       let tipo = $("#tipo").val();
       let asunto = $("#asunto").val();
       let usuario = $("#liveSearchUsuario").val();
       let estado = $("#estado").val();
       let fecha_creacion = $("#fecha_creacion").val();
       let fecha_limite = $("#fecha_limite").val();

       let nombreUsuario = $("#select2-liveSearchUsuario-container").attr('title');

       //VALIDATE DATES
       let date = new Date();
       let dd = date.getDate().toString().padStart(2, "0");
       let mm = (date.getMonth() + 1).toString().padStart(2, "0");
       let yyyy = date.getFullYear();
       let someFormattedDate = yyyy+'-'+mm+'-'+dd;
       console.log(fecha_creacion);
       console.log(someFormattedDate);

       if(fecha_creacion < someFormattedDate){
         $(".messageModal").css('color','red');
         $(".messageModal").text('Las fechas tienen que ser mayores a la actual.');
         $('#añadirPQR')[0].reset();
         $("#liveSearchUsuario").val([]).trigger('change');
         return;
       }else{
         console.log("entra aqui");
       }


       if(tipo != '' && asunto != '' && estado != '' && fecha_creacion != '' && fecha_limite != ''){

         let dataString = 'tipo='+tipo+'&asunto='+asunto+'&usuario='+usuario+'&estado='+estado+'&fecha_creacion='+fecha_creacion+'&fecha_limite='+fecha_limite;

         $.ajax({
           url: 'ajax/insert.php',
           method: 'POST',
           data: dataString,
           dataType: 'json',
           success: function(data){
           console.log(data);
           if(data['ok'] == true){
             $('#añadirPQR')[0].reset();
             $("#liveSearchUsuario").val([]).trigger('change');
             $("li.notpqr").remove();

             let html = `<li class="list-group-item" id="itemlist`+data['id']+`">
             <div class="row">
             <div class="col-md-1 itemsCenter">`
             if(tipo == 'peticion'){
               html+= `<i class="fas fa-hand-holding fa-2x" style="color:#00a3b4;"></i>`;
             }else if(tipo == 'queja'){
               html+= `<i class="fas fa-exclamation-triangle fa-2x" style="color:orange;"></i>`;
             }else{
               html+= `<i class="fas fa-retweet fa-2x" style="color:red;"></i>`;
             }
             html+= `</div>
             <div class="col-md-8">
             <h3 `;
             if(tipo == 'peticion'){
             html+= `class="peticion"`;
            }else if(tipo == 'queja'){
             html+= `class="queja"`;
            }
             else {
              html+= `class="reclamo"`;
            }
              html+= `>`+tipo+` <span class="spanEstado">(`+estado+`)</span>
             </h3>
             <p class="asunto">`+asunto+`</p>
             <p class="text-muted">
               <span>Para `+nombreUsuario+`.</span><br>
               <span>Por `+phpAdminVar+`.</span>
               <i class="far fa-calendar-alt"></i> <span>`+fecha_creacion+`</span>
               <i class="fas fa-grip-lines-vertical"></i> <span>`+fecha_limite+`</span>
             </p>
             </div>
             <div class="col-md-3">
                 <button type="button" class="btn btn-info btn-sm btnEditar float-right" id="`+data['id']+`" data="`+estado+`"><i class="far fa-edit"></i></button>
             </div>
             </div>
             </li>`;
             $(".ulPQR").prepend(html);
             $("#modalAgregarPQR").modal("toggle");
             $(".message").css('color','green');
             $(".message").text(data['message']).fadeIn();
             $(".message").text(data['message']).fadeOut(4000);
             if(estado == 'cerrado'){
               $("#"+data['id']).attr('disabled', true);
             }

           }else{
             $(".messageModal").css('color','red');
             $(".messageModal").text(data['message']).fadeIn();
             $(".messageModal").text(data['message']).fadeOut(4000);
           }
           }
         })

       }else{
         $(".messageModal").css('color','red');
         $(".messageModal").text('Por favor llenar todos los campos.');
       }


     });

$(document).on('click', '.btnEditar',  function(){
  let id = $(this).attr('id');
  let estado = $(this).attr('data');
  $("#modalEditarPQR").modal("toggle");
  let option = ``;
  if(estado == 'nuevo'){
  option+= `<option value="nuevo" selected>Nuevo</option>
            <option value="ejecucion">En ejecución</option>
            <option value="cerrado">Cerrado</option>`;
  }else if(estado == 'ejecucion'){
    option+= `<option value="ejecucion" selected>En ejecución</option>
              <option value="cerrado">Cerrado</option>`;
  }else{
    option+= `<option value="cerrado" selected>Cerrado</option>`;
  }

  //set id PQR in input text
  $("#idPQR").val(id);
  $("#estadoModal").html('').append(option);

});

$("#editarPQR").submit(function(e){
  e.preventDefault();
  let idPQR = $("#idPQR").val();
  let estadoModal = $("#estadoModal").val();
  let dataString = 'idPQR='+idPQR+'&estadoModal='+estadoModal;

  if(estadoModal != ''){

    $.ajax({
      url: 'ajax/edit.php',
      method: 'POST',
      data: dataString,
      dataType: 'json',
      success: function(data){
        $("#itemlist"+idPQR+" .spanEstado").text('');
        $("#itemlist"+idPQR+" .spanEstado").text('('+data['estado']+')');
        $(".messageModal").css('color','green');
        $(".message").text(data['message']).fadeIn();
        $(".message").text(data['message']).fadeOut(3000);
        $("#"+idPQR).attr('data', data['estado']);
        $("#modalEditarPQR").modal("toggle");

        if(data['estado'] == 'cerrado'){
          $("#"+idPQR).attr('disabled', true);
        }

      }


    })

  }else{
    $(".messageModalEdit").css('color','red');
    $(".messageModalEdit").text('Por favor llenar todos los campos.');
  }

});
