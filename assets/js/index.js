$(document).ready(function(){

$("#login").submit(function(e){
  e.preventDefault();
  let username = $("#username").val();
  let password = $("#password").val();

  if(username != '' && password != ''){

    let dataString = 'username='+username+'&password='+password;
    console.log(dataString);
    $.ajax({
      url: 'ajax/login.php',
      method: 'POST',
      data: dataString,
      dataType: 'json',
      success: function(data){
      console.log(data);
      if(data['ok'] == true){
        window.location.href = 'dashboard.php';
      }else{
        $(".message").css('color','red');
        $(".message").text(data['message']);
      }
      }
    })

  }else{
    $(".message").css('color','red');
    $(".message").text('Por favor llenar todos los campos.');
  }

});



$("#registro").submit(function(e){
  e.preventDefault();
  let name = $("#nameRegistro").val();
  let lastname = $("#lastnameRegistro").val();
  let username = $("#usernameRegistro").val();
  let password = $("#passwordRegistro").val();

  if(name != '' && lastname != '' && username != '' && password != ''){

    let dataString = 'name='+name+'&lastname='+lastname+'&username='+username+'&password='+password;
    console.log(dataString);
    $.ajax({
      url: 'ajax/registro.php',
      method: 'POST',
      data: dataString,
      dataType: 'json',
      success: function(data){
      console.log(data);
      if(data['ok'] == true){
        window.location.href = 'dashboard.php';
      }else{
        $(".messageModalRegistro").css('color','red');
        $(".messageModalRegistro").text(data['message']);
      }
      }
    })

  }else{
    $(".messageModalRegistro").css('color','red');
    $(".messageModalRegistro").text('Por favor llenar todos los campos.');
  }

});


});
