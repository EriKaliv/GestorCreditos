 /*
| -------------------------------------------------------------------
| NUEVOS CREDITOS
| -------------------------------------------------------------------
*/ 

$("#cupo").on({
	focus: function (event) {
	  $(event.target).select();
	},
	keyup: function (event) {
	  $(event.target).val(function (index, value) {
		return (
		  "$ " +
		  value
			.replace(/\D/g, "")
			.replace(/([0-9])([0-9]{0})$/, "$1$2")
			.replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".")
		);
	  });
	},
  });

$('#calcular').click(function(){
	
	tasa= $('#tasa').val();
	cupo = $('#cupo').val();
	cupo = cupo.replace(/[$.]/g,'');
	cuotas = $('#cuotas').val();
	frecuencia = '';

	if (document.getElementById('mensual').checked){
		frecuencia = $('#mensual').val();
	} else if (document.getElementById('quincenal').checked){
		frecuencia = $('#quincenal').val();
	}
	datosCredito(tasa, cupo, cuotas, frecuencia);
});

function datosCredito(tasa, cupo, cuotas, frecuencia){
	
	$.ajax({
		type: "POST",
		url: "http://localhost/GestorCreditos/creditos/helperCreditos",
		data: "tasa=" + tasa +
				"&cupo=" + cupo +
				"&frecuencia=" + frecuencia +
				"&cuotas=" + cuotas,

		success: function (r) {
			var registros = JSON.parse(r);
      if(registros.proyeccion != null)
      {
        $('#valorProyectar').val("$ " + registros.proyeccion);
        $('#cupo').val("$ " +registros.cupo);
        $('#valorCuota').val("$ " + registros.cuota);
  
        $('#transferencia').text("$ " + registros.transfer);
        $('#ivaTransf').text("$ " + registros.ivaTransf);
        $('#cuatroxmil').text("$ " + registros.cuatroxmil);
        $('#recaudo1').text("$ " + registros.recaudo1);
        $('#ivaRecaudo1').text("$ " + registros.ivaRecaudo1);
  
        $('#cobranza').text("$ " + registros.cobranza);
        $('#ivaCobranza').text("$ " + registros.ivaCobranza);
        $('#recaudo2').text("$ " + registros.recaudo2);
        $('#ivaRecaudo2').text("$ " + registros.ivaRecaudo2);
  
        $('#software').text("$ " + registros.software);

      }else{

		if(registros.cupo != null && registros.frecuencia != null && registros.cuotas != null){
        html = "<div class='alert alert-danger'>"+registros.cupo+"</div>"
		html += "<div class='alert alert-danger'>"+registros.frecuencia+"</div>"
		html += "<div class='alert alert-danger'>"+registros.cuotas+"</div>"
		
		}else if(registros.cupo != null && registros.frecuencia){
			html = "<div class='alert alert-danger'>"+registros.cupo+"</div>"
			html += "<div class='alert alert-danger'>"+registros.frecuencia+"</div>"
		
		}else if(registros.cupo != null && registros.cuotas){
			html = "<div class='alert alert-danger'>"+registros.cupo+"</div>"
			html += "<div class='alert alert-danger'>"+registros.cuotas+"</div>"
		
		}else if(registros.frecuencia != null && registros.cuotas){
			html = "<div class='alert alert-danger'>"+registros.frecuencia+"</div>"
			html += "<div class='alert alert-danger'>"+registros.cuotas+"</div>"
		
		}else if(registros.cupo != null){
			html = "<div class='alert alert-danger'>"+registros.cupo+"</div>"
		
		}else if(registros.frecuencia != null){
			html = "<div style='visibility: hidden; position: absolute'>"+registros.cupo+"</div>"
			html += "<div class='alert alert-danger'>"+registros.frecuencia+"</div>"
		
		}else if(registros.cuotas != null){
			html = "<div style='visibility: hidden; position: absolute'>"+registros.cupo+"</div>"
			html += "<div class='alert alert-danger'>"+registros.cuotas+"</div>"}

        $('#errores').html(html);
			
      }
		}
	});
}

$('#guardarCredito').click(function(){

	idDeudor= $('#idDeudor').val();
	valorProyectar= $('#valorProyectar').val();
	tasa= $('#tasa').val();
	cupo= $('#cupo').val();
	cuotas= $('#cuotas').val();
	valorCuota= $('#valorCuota').val();

	//Costos del Credito
	transferencia = document.getElementById('transferencia').innerHTML;
	ivaTransferencia = document.getElementById('ivaTransf').innerHTML;
	cuatroxmil = document.getElementById('cuatroxmil').innerHTML;
	recaudo1 = document.getElementById('recaudo1').innerHTML;
	ivaRecaudo1 = document.getElementById('ivaRecaudo1').innerHTML;
	cobranza = document.getElementById('cobranza').innerHTML;
	ivaCobranza = document.getElementById('ivaCobranza').innerHTML;
	recaudo2 = document.getElementById('recaudo2').innerHTML;
	ivaRecaudo2 = document.getElementById('ivaRecaudo2').innerHTML;
	software = document.getElementById('software').innerHTML;
	
	frecuencia= '';

	if (document.getElementById('mensual').checked){
		frecuencia = $('#mensual').val();
	} else if (document.getElementById('quincenal').checked){
		frecuencia = $('#quincenal').val();
	}

	if($.isEmptyObject(idDeudor)){
		html = '<p class="text-danger ml-1">Selecciona un Deudor.</p>';
		$('#deudor').html(html)
	}
	
	
	datos="idDeudor=" + idDeudor +
			"&valorProyectar=" + valorProyectar +
			"&tasa=" + tasa +
			"&cupo=" + cupo +
			"&frecuencia=" + frecuencia +
			"&cuotas=" + cuotas +
			"&valorCuota=" + valorCuota +
			"&transferencia=" + transferencia +
			"&ivaTransferencia=" + ivaTransferencia +
			"&cuatroxmil=" + cuatroxmil +
			"&recaudo1=" + recaudo1 +
			"&ivaRecaudo1=" + ivaRecaudo1 +
			"&cobranza=" + cobranza +
			"&ivaCobranza=" + ivaCobranza +
			"&recaudo2=" + recaudo2 +
			"&ivaRecaudo2=" + ivaRecaudo2 +
			"&software=" + software;
			//alert(datos)
	$.ajax({
		type:"POST",
		url:"http://localhost/GestorCreditos/creditos/crear",
		data:datos,
		success:function(r){
    registros = JSON.parse(r);

    if(registros === 'Crédito Solicitado')
      {
        html = html = "<div class='alert alert-success text-center h4 ml-2 mr-2' role='alert'>"+registros+"</div>";
        $('#solicitado').html(html)

      } else if(registros === 'infoIncompleta') 
      {
        $('#myModal').modal('show');
        
      } else {
        if(registros.cupo != null){
        html = "<div class='alert alert-danger'>"+registros.cupo+" Antes de <span class='font-weight-bold'>solicitar, </span>dar clic en <span class='font-weight-bold'>Caluclar Crédito</span></div>"};
        if(registros.frecuencia != null){
        html += "<div class='alert alert-danger'>"+registros.frecuencia+" Antes de <span class='font-weight-bold'>solicitar, </span>dar clic en <span class='font-weight-bold'>Caluclar Crédito</span></div>"};
        if(registros.cuotas != null){
        html += "<div class='alert alert-danger'>"+registros.cuotas+" Antes de <span class='font-weight-bold'>solicitar, </span>dar clic en <span class='font-weight-bold'>Caluclar Crédito</span></div>"};
      
        $('#errorSolicitar').html(html);
      }
		}
	});
});


/*
| -------------------------------------------------------------------
| CARGA DE PAISES DEPARTAMENTOS CIUDADES
| -------------------------------------------------------------------
*/ 

let paths = window.location.pathname.split('/');
let usuario = paths[paths.length-3];
let deudor = paths[paths.length-1];
let empresa = paths[paths.length-2];

let $departamento = document.querySelector('#departamento')
let $ciudad = document.querySelector('#ciudad')

$(document).ready(function () 
{	
	//muestra el pais
	$('.js-example-basic-single').select2();
	$('#pais').select2();

	//muestra el departamento
	option = "<select id='depa' class='form-control' style='width: 100%' data-style='btn-primary' tabindex='-1'>";
	option += "<option disabled selected>Elije una Opción</option>";
	option += "</select>"
	//$departamento.innerHTML = option;	
	$('#departamento').html(option);
	$('#depa').select2();

	//muestra el ciudad
	option = "<select id='ciud' class='form-control' style='width: 100%' data-style='btn-primary' tabindex='-1'>";
	option += "<option disabled selected>Elije una Opción</option>";
	option += "</select>"
	//$departamento.innerHTML = option;	
	$('#ciudad').html(option);
	$('#ciud').select2();

	if(deudor === 'registroInfo'){
		
		$.ajax({
			url: 'http://localhost/GestorCreditos/Ubicacion/depaDeudor',
			type: 'POST',
			//data: datos,
			success: function(r){
				
				depaDeudor = eval(r)

				idPais = $('#pais').val();
				const datos = {
					'idPais' : idPais,
					'idDepartamento' : depaDeudor
				}
				
				cargarDepartamentos(datos)
			}
		})
	}else if(usuario === 'deudores'){
		
		let idDeudor = paths[paths.length-1];
		
		$.ajax({
			url: 'http://localhost/GestorCreditos/Ubicacion/depaDeudor',
			type: 'POST',
			data: "idDeudor=" + idDeudor,
			success: function(r){
				
				depaDeudor = eval(r)
		
				idPais = $('#pais').val();
				const datos = {
					'idPais' : idPais,
					'idDepartamento' : depaDeudor
				}
				//alert(depaPrestatario.idDepartamento)
				cargarDepartamentos(datos)
			}
		})
	}else if(empresa === 'editar'){
		let idEmpresa = paths[paths.length-1];
		
		$.ajax({
			url: 'http://localhost/GestorCreditos/Ubicacion/depaEmpresa',
			type: 'POST',
			data: "idEmpresa=" + idEmpresa,
			success: function(r){

				depaEmpresa = eval(r)
		
				idPais = $('#pais').val();
				const datos = {
					'idPais' : idPais,
					'idDepartamento' : depaEmpresa
				}
				cargarDepartamentos(datos)
			}
		})
	}
})	

$('#pais').on( 'change', function(){

	if(deudor === 'registroInfo'){
		
		$.ajax({
			url: 'http://localhost/GestorCreditos/Ubicacion/depaDeudor',
			type: 'POST',
			//data: datos,
			success: function(r){
				
				depaDeudor = eval(r)

				idPais = $('#pais').val();
				const datos = {
					'idPais' : idPais,
					'idDepartamento' : depaDeudor
				}
				cargarDepartamentos(datos)
			}
		})
	}else if(usuario === 'deudores'){
		let idDeudor = paths[paths.length-1];

		$.ajax({
			url: 'http://localhost/GestorCreditos/Ubicacion/depaDeudor',
			type: 'POST',
			data: "idDeudor=" + idDeudor,
			success: function(r){

				ciudadDeudor = eval(r)

				idPais = $('#pais').val();
				const datos = {
					'idPais' : idPais,
					'idDepartamento' : ciudadDeudor
				}
				
				cargarDepartamentos(datos)
		}
		})
	}else if(empresa === 'editar' || empresa === 'empresas'){
		
		idPais = $('#pais').val();
			const datos = {
				'idPais' : idPais,
			}
			cargarDepartamentos(datos)
	}
})

function cargarDepartamentos(datos){
	
	$.ajax({
		url: 'http://localhost/GestorCreditos/Ubicacion/departamento',
		type: 'POST',
		data: datos,
		success: function(r){
		
			departamentos = JSON.parse(r)
			
			option = "<select id='depa' name='depa' class='form-control' style='width: 100%' data-style='btn-primary' tabindex='-1'>";
			option += "<option disabled selected>Elije una Opción</option>";
			
			departamentos.forEach(departamento => {
				if(datos.idDepartamento==departamento.idDepartamento){
					option += "<option value=" + departamento.idDepartamento +" selected="+datos+" >" + departamento.nombreDepartamento + "</option>";
				}else{
					option += "<option value=" + departamento.idDepartamento +" >" + departamento.nombreDepartamento + "</option>";
				}
				
			})

			option += "</select>"
			$('#depa').html(option);
			$departamento.innerHTML = option;
			//alert(r)
			$('#depa').select2();

		if(deudor === 'registroInfo'){

			$.ajax({
				url: 'http://localhost/GestorCreditos/Ubicacion/ciudadDeudor',
				type: 'POST',
				//data: datos,
				success: function(r){
					
					ciudadDeudor = JSON.parse(r)
					
					idDepartamento = $('#depa').val();
					const datos = {
						'idDepartamento' : idDepartamento,
						'idCiudMuni' : ciudadDeudor.idCiudMuni
					}
					
					CargarCiudMuni(datos)
				
			}
		
			})
		}else if(usuario === 'deudores'){
			let idDeudor = paths[paths.length-1];
			$.ajax({
				url: 'http://localhost/GestorCreditos/Ubicacion/ciudadDeudor',
				type: 'POST',
				data: "idDeudor=" + idDeudor,
				success: function(r){
					ciudadDeudor = JSON.parse(r)
					//alert(depaPrestatario.idDepartamento)
					idDepartamento = $('#depa').val();
					const datos = {
						'idDepartamento' : idDepartamento,
						'idCiudMuni' : ciudadDeudor.idCiudMuni
					}
					
					CargarCiudMuni(datos)
				
			}
		
			})
		}else if(empresa === 'editar'){
			let idEmpresa = paths[paths.length-1];
			$.ajax({
				url: 'http://localhost/GestorCreditos/Ubicacion/ciudadEmpresa',
				type: 'POST',
				data: "idEmpresa=" + idEmpresa,
				success: function(r){
					ciudadEmpresa = JSON.parse(r)
					//alert(depaPrestatario.idDepartamento)
					idDepartamento = $('#depa').val();
					const datos = {
						'idDepartamento' : idDepartamento,
						'idCiudMuni' : ciudadEmpresa.idCiudMuni
					}
					
					CargarCiudMuni(datos)
				
			}
		
			})
		}

		}

	})

}

$('#departamento').on( 'change', function(){
	idDepartamento = $('#depa').val();
	const datos = {
		'idDepartamento' : idDepartamento
	}

	CargarCiudMuni(datos);
	})

	function CargarCiudMuni(datos){
	
		$.ajax({
			url: 'http://localhost/GestorCreditos/Ubicacion/ciudadMunicipio',
			type: 'POST',
			data: datos,
			success: function(r){
				
				var ciudades = JSON.parse(r)
				
				option = "<select id='ciud' name='ciud' class='form-control' style='width: 100%' data-style='btn-primary' tabindex='-1'>";
				option += "<option disabled selected>Elije una Opción</option>";
				
				ciudades.forEach(ciudad => {
					if(datos.idCiudMuni==ciudad.idCiudMuni){
						option += "<option value="+ ciudad.idCiudMuni + " selected="+datos+">"+ ciudad.nombreCiudMuni + "</option>";
					}else{
						option += "<option value="+ ciudad.idCiudMuni + ">"+ ciudad.nombreCiudMuni + "</option>";
					}
				})
				option += "</select>"
				$('#ciud').html(option);
				$ciudad.innerHTML = option;
				//alert(r)
				$('#ciud').select2();	
			}
		})
	}
	
  /*
| -------------------------------------------------------------------
| Deudores
| -------------------------------------------------------------------
*/ 

/*
| -------------------------------------------------------------------
| registroInfo.php
| -------------------------------------------------------------------
*/ 

function formRegistro(){
if (typeof ($.fn.smartWizard) === 'undefined') { return; }
$('#wizard').smartWizard();

    $('#wizard_verticl').smartWizard({
		transitionEffect: 'slide',
        labelFinish: 'Guardar',
		
    });

	$('.buttonFinish').addClass('guardar');

	$('.buttonFinish').click(function() {
		$('#formRegistro')[0].submit();
	});
}

$(document).ready(function () 
{

	formRegistro();

});

/*
| -------------------------------------------------------------------
| deudores/nuevoCredito.php
| -------------------------------------------------------------------
*/ 


/*
| -------------------------------------------------------------------
| roles.php modal permisos
| -------------------------------------------------------------------
*/ 

function permisosRol(idRol) {
	
	$('#modalPermisos').on('show.bs.modal', function () {
		$.ajax({
			type: "POST",
			url: "http://localhost/GestorCreditos/roles/permisos",
			data: "idRol="+idRol,
			success: function (response) {
				//data = JSON.parse(response)
			$(".modal").html(response);
			}
		});
  });
}

/*
| -------------------------------------------------------------------
| verCredito.php
| -------------------------------------------------------------------
*/ 

$('#estado').on( 'change', function(){
	estado = $('#estado').val();
	if(estado == 'Desembolsado'){
		listaCajas();
	}
})

function listaCajas(){
	$.ajax({
		url: 'http://localhost/GestorCreditos/creditos/ConsultarCajas',
		type: 'POST',
		data: "estado="+estado,
		success: function(r){
			let $banco = document.querySelector('#banco')
			cajas = JSON.parse(r)
			//alert(cajas)

			html='<div class="input-group-prepend"><label class="input-group-text text-label rounded-0">Caja/Banco</label></div><select class="js-example-basic-single form-control" tabindex="-1" name="caja"  id="caja" style="font-size: 13px;height: 38px;color: #73879C; width: 100%;"><option disabled selected>Elije una Opción</option>';

			cajas.forEach(caja => {
				html += `<option value="${caja.idCaja}" id="opcion">${caja.nombre}&nbsp;${caja.tipoCuenta}&nbsp;${caja.numero}</option>`;
			})
			
			html += "</select></div>"
			$('#caja').html(html);
			$banco.innerHTML = html;
			//alert(r)
			$('#caja').select2();
		}
	})
}
	
