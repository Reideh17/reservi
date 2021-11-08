
	
	
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  var form = document.getElementById("form-id-contribuir");

  document.getElementById("enviar-contribuir").addEventListener("click", function () {
    form.submit();
  });
 