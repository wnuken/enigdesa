// DANE - 2015-08-21 - mayandarl - Funciones Javascript para control de Fuente y formularios.
//var SMLV = 616000;

function tipocampo(campo) {
	var tipo = '';
	try {
		tipo = document.getElementById(campo).type;
	}
	catch(err) {
		try {
			tipo = document.getElementById(campo +'.1').type;
		}
		catch(err2) {
			return false;
		}
	}
	return tipo;
}

// 2015-08-06 - mayandarl - Funcion para verificacion de reglas de consistencia.
function chk_cons(id, regla) {
	var i = 1;
	var color = "";
	//var error = false;
	var msj_consistencia = "";
	while (typeof regla[id + '__' + i] != "undefined") {
		// regla[id + '__' + i][0]
		if (eval(regla[id + '__' + i][0])) { //  && regla[id +'__'+ i][3] == 0
			// "(" + id + ": " + regla[id + '__' + i][2] + ") " + // mostrar Campo y Tipo de error
			msj_consistencia += regla[id + '__' + i][1] + " ";
			//console.log(id +"= "+ regla[id + '__' + i][0]);
			if (regla[id + '__' + i][2] == "Corrija") {
				color = "FF0000";
				// Estado en tipo_error corrija es regla no superada (0)
				regla[id + '__' + i][3] = 0;
			} else {
				color = "FFCC00";
			}
			//error = true;
		} else {
			// Estado es regla superada (1)
			regla[id + '__' + i][3] = 1;
		}
		i++;
		//error = false;
	}
	if (color == "") {
		$('#RESP_' + id).removeClass("alert alert-danger");
		//$('#' + id).css('border', '1px solid #A9A9A9');
	} else {
		$('#RESP_' + id).addClass("alert alert-danger");
		//$('#' + id).css('border', '2px solid #' + color);
	}
	$('#RESP_' + id).attr('data-content', msj_consistencia);
	//$('#' + id).attr('data-content', msj_consistencia);
	return true;
}

// 2016-04-21 - mayandarl - Funcion para evaluacion de campos a mostrar segun dependencias.
function chk_depend(campo, seccion, valores, asigna) {
	var ctl = false;
	var tipo = tipocampo(campo);
	var val = '';
	if (tipo == 'select-one'  || tipo == 'hidden') {
		val = $('#' + campo).val();
		$.each(valores, function (k, valor) {
			if (val == valor)
				ctl = true;
		});
	}
	else if (tipo == 'text' || tipo == 'textarea') {
		ctl = valores.test($('#' + campo).val());
	}
	else if (tipo == 'radio') {
		val = $('input[name='+ campo +']:checked').val();
		$.each(valores, function (k, valor) {
			if (val == valor)
				ctl = true;
		});
	}
	//console.log('origen:' + campo +' ['+ val +'], destino:'+ seccion +', res:'+ ctl);
	if (ctl) {
		$('#div-' + seccion).show();
		$('#' + seccion).show();
	} else {
		$('#div-' + seccion).hide();
		if (asigna)
			asignarValor(seccion, '');
		$('#' + seccion).hide();
	}
}

// 2015-08-09 - mayandarl - Funcion para buscar municipios del Depto. basada en funcion Camilo Medina.
function cargar_mpios(dep, mun, val, url) {
	if ($('#' + dep).val()) {
		$.ajax({
			success: function (html) {
				$("#" + mun).html(html);
				$("#" + mun).val(val);
			},
			type: "POST",
			contentType: "application/x-www-form-urlencoded; charset=UTF-8",
			url: url,
			data: {
				depto: $("#" + dep).val()
			},
			cache: false
		});
	}
}

function asignarValor(id, valor) {
	var tipo = tipocampo(id);
	if (tipo == 'radio') {
		//console.log(id +'.'+ valor);
		$('[name='+ id +']').val([valor]);
	}
	else {//if (tipo == 'select-one' || tipo == 'text' || tipo == 'textarea') {
		$('#'+ id).val(valor);
	}
}

$(function ()
{
	//$('.btnNext').click(function(){
	//	$('.nav-tabs > .active').next('li').find('a').trigger('click');
	//});
	//$('.btnPrevious').click(function () {
	//	$('.nav-tabs > .active').prev('li').find('a').trigger('click');
	//});
	// Dependencias entre variables - Mario A. Yandar - 2016-03
	$.fn.dependencias = function (campo, seccion, valores, asigna) {
		chk_depend(campo, seccion, valores, asigna);
		return this.change(function (event) {
			chk_depend(campo, seccion, valores, asigna);
		});
	};

	/*$.fn.dependencias2 = function (campo, seccion, expr) {
		$('#' + seccion).hide();
		$('#div-' + seccion).hide();
		return this.blur(function (event) {
			var ctl = expr.test($('#' + campo).val());
			if (ctl) {
				$('#' + seccion).show();
				$('#div-' + seccion).show();
			} else {
				$('#' + seccion).hide();
				$('#' + seccion).val('');
				$('#div-' + seccion).hide();
			}
		});
	}*/

	$.fn.dependencias2 = function (campo, seccion, valor) {
		var ctl = false;
		//if ($('#' + campo).val() != '98' && $('#' + campo).val() != '99' && $('#' + campo).val() > valor) {
		if ($('#' + campo).val() <= valor) {
			ctl = true;
		}
		if (ctl) {
			$('#' + seccion).show();
			$('#div-' + seccion).show();
		} else {
			$('#' + seccion).hide();
			$('#div-' + seccion).hide();
		}
		return this.blur(function (event) {
			var ctl = false;
			//if ($('#' + campo).val() != '98' && $('#' + campo).val() != '99' && $('#' + campo).val() > valor) {
			if ($('#' + campo).val() <= valor) {
				ctl = true;
			}
			if (ctl) {
				$('#' + seccion).show();
				$('#div-' + seccion).show();
			} else {
				$('#' + seccion).hide();
				$('#div-' + seccion).hide();
			}
		});
	}
	
	$.fn.dependencias3 = function (campo, seccion, valor) {
		var ctl = false;
		//if ($('#' + campo).val() != '98' && $('#' + campo).val() != '99' && $('#' + campo).val() > valor) {
		if ($('#' + campo).val() > valor) {
			ctl = true;
		}
		if (ctl) {
			$('#' + seccion).show();
			$('#div-' + seccion).show();
		} else {
			$('#' + seccion).hide();
			$('#div-' + seccion).hide();
		}
		return this.blur(function (event) {
			var ctl = false;
			//if ($('#' + campo).val() != '98' && $('#' + campo).val() != '99' && $('#' + campo).val() > valor) {
			if ($('#' + campo).val() > valor) {
				ctl = true;
			}
			if (ctl) {
				$('#' + seccion).show();
				$('#div-' + seccion).show();
			} else {
				$('#' + seccion).hide();
				$('#div-' + seccion).hide();
			}
		});
	}

	$.fn.reemplazarValorLabel = function (campo, label) {
		if ($('#' + campo).val().length > 0) {
			console.log("Campo: "+ campo +", Label: "+ label);
			$('#lbl-' + label).html($('#lbl-' + label).html().replace('#' + campo + '#', $('#' + campo).val()));
		}
	}

	$.fn.moneda = function () {
		return this.keyup(function (event) {
			//console.log($(this).val());
			var valor = $(this).val();
			var num = valor.replace(/\./g,'');
			if(!isNaN(num)){
				num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
				num = num.split('').reverse().join('').replace(/^[\.]/,'');
				valor = num;
			}  else {
				alert('Solo se permiten numeros');
				valor = valor.replace(/[^\d\.]*/g,'');
			}
			$(this).val(valor);
		});
	};

	//*****************************************************************************************
	//* Convierte todos los caracteres de una caja de texto a mayusculas cuando pierde el foco
	//*****************************************************************************************
	$.fn.mayusculas = function () {
		return this.blur(function (event) {
			$(this).val($(this).val().toUpperCase());
		});
	};
	$.fn.texto = function () {
		return this.keypress(function (event) {
			var valor = false;
			var valid = event.which == 32 || event.which == 8 || event.which == 241 || event.which == 209 || 
				event.which == 193 || event.which == 201 || event.which == 205 || event.which == 211 || event.which == 218 || 
				event.which == 225 || event.which == 233 || event.which == 237 || event.which == 243 || event.which == 250 || 
				(event.which >= 65 && event.which <= 90) || (event.which >= 97 && event.which <= 122);
			if (!valid)
				valor = false;
			else
				valor = true;
			$(this).val($(this).val().toUpperCase());
			return valor;
		});
	};

	//************************************************************************
	//* Bloquea el ingreso de caracteres de texto sobre una caja de texto
	//************************************************************************
	$.fn.numerico = function () {
		return this.keypress(function (event) {
			if ((event.which == 8) || (event.which == 0))
				return true;
			if ((event.which >= 48) && (event.which <= 57))
				return true;
			else
				return false;
		});
	};
	
	$.fn.numnosabe = function (id) {
		return this.blur(function (event) {
			if ($(this).val() != '98')
				document.getElementById(id +".98").checked = false;
			if ($(this).val() != '99')
				document.getElementById(id +".99").checked = false;
			if ($(this).val() == '98' || $(this).val() == '99')
				$(this).css('color', 'white');
			else {
				$(this).css('color', 'black');
			}
		});
	};

/*	$.fn.numnosabeopc = function (id) {
		return this.click(function (event) {
			$("#" + id).css('color', 'white');
			$("#" + id).val($(this).val());
			$("#" + id).focus();
		});
	};*/

	//////////////////////////////////////
	// FORMULARIO PRINCIPAL MODULOS
	// campo de solo lectura
	$.fn.sololectura = function () {
		$(this).attr('disabled', true);
		//$(this).children(':input').attr('disable', disable);
	};

	$.fn.consistencia = function (id, regla) {
		return this.blur(function (event) {
			return chk_cons(id, regla);
		});
	};

	$.fn.separamiles = function (id) {
		return this.keyup(function (event) {
			var parts = $('#'+ id).val();
			parts = parts.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
			return $('#'+ id).val(parts);

/*		var nStr = $('#'+ id).val();
			nStr += '';
			var rgx = /(\d+)(\d{3})/;
			while (rgx.test(nStr)) {
				nStr = nStr.replace(rgx, '$1' + '.' + '$2');
			}
			return $('#'+ id).val(nStr);*/
		});
	};
	
	// 2015-07-31 - mayandarl - Funcion para verificacion de reglas de consistencia del formulario y envio.
	$.fn.verificar_enviar = function (capitulo, url, regla) {
		return this.click(function (event) {
			var estado = 1;
			var txt = "";
			var id;
			for (var id_i in regla) {
				id = id_i.split('__');
				chk_cons(id[0], regla);
				estado = estado * regla[id_i][3];
				txt += id_i + ":" + regla[id_i][3] + " | \n";
			}
			//console.log(txt);
			if (estado) {
				var myf = $('#form_' + capitulo);
				var args = myf.serialize().replace(/(%0D%0A|%0D|%0A|%22|%5C|')/g, " ");
				$(this).attr('disabled', true);
				$.ajax({
					type: 'POST',
					url: url,
					cache: false,
					contentType: "application/x-www-form-urlencoded; charset=UTF-8",
					data: args,
					beforeSend: function (objeto) {
						$('#mensaje_' + capitulo).html('<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Enviando m&oacute;dulo</div>');
					},
					success: function (respuesta) {
						$('#mensaje_' + capitulo).html('<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> '+ respuesta +'</div>');
						location.reload();
					},
					error: function (respuesta) {
						$('#mensaje_' + capitulo).html('<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Error guardando m&oacute;dulo</div>');
					}
				});
				$(this).attr('disabled', false);
			} else {
				$('#mensaje_' + capitulo).html('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Hay campos que requieren correcciones, por favor verifique e intente nuevamente</div>');
			}
		});
	};

	// 2015-07-31 - mayandarl - Funcion para verificacion de reglas de consistencia del formulario y envio.
/*	$.fn.verificar_confirmar_enviar = function (capitulo, url, regla) {
		return this.click(function (event) {
			var estado = 1;
			var txt = "";
			var id;
			for (var id_i in regla) {
				id = id_i.split('__');
				chk_cons(id[0], regla);
				estado = estado * regla[id_i][3];
				txt += id_i + ":" + regla[id_i][3] + " | \n";
			}
			//console.log(txt);
			if (estado) {
				var r=confirm('Esta seguro de las respuestas anteriormente contestadas?, Si desea modificar alguna respuesta oprima SI, de lo contrario oprima GUARDAR Y CONTINUAR. Dado que después de esta pregunta usted ya no podrá regresar a modificar alguna respuesta.');
				if (r==true) {
					var myf = $('#form_' + capitulo);
					var args = myf.serialize().replace(/(%0D%0A|%0D|%0A|%22|%5C|')/g, " ");
					$(this).attr('disabled', true);
					$.ajax({
						type: 'POST',
						url: url,
						cache: false,
						contentType: "application/x-www-form-urlencoded; charset=UTF-8",
						data: args,
						beforeSend: function (objeto) {
							$('#mensaje_' + capitulo).html('Enviando m&oacute;dulo');
							//$('#CHK_'+ capitulo).removeClass();
							//$('#CHK_'+ capitulo).addClass('ui-icon ui-icon-clock');
						},
						success: function (respuesta) {
							$('#mensaje_' + capitulo).html('<b>' + respuesta + '</b>');
							//$('#CHK_'+ capitulo).removeClass();
							//$('#CHK_'+ capitulo).addClass('ui-icon ui-icon-check');
							$('.nav-tabs > .active').next('li').find('a').trigger('click');
							location.reload();
						},
						error: function (respuesta) {
							$('#mensaje_' + capitulo).html('<font color="red">Error guardando m&oacute;dulo</font>');
							//$('#CHK_'+ capitulo).removeClass();
							//$('#CHK_'+ capitulo).addClass('ui-icon ui-icon-cancel');
						}
					});
					$(this).attr('disabled', false);
				}
				else {
					return true;
				}
			} else {
				var id;
				for (var id_i in regla) {
					id = id_i.split('__');
					if (regla[id_i][3] == 0)
						$('#' + id[0]).css('border', '2px solid #FF0000');
				}
				$('#mensaje_' + capitulo).html("<font color='red'>Hay campos que requieren correcciones, por favor verifique e intente nuevamente.</font>");
			}
		});
	};*/

	// 2015-08-05 - cemedinaa - Funci&oacute;n para sumar todos los elementos de una misma clase
	$.fn.sumarCamposDinamicos = function (idTotal) {
		return this.blur(function (event) {
			if ($('.sumar' + idTotal)) {
				var elemento = $('.sumar' + idTotal);
				var total = 0;
				elemento.each(function () {
					var valor = parseInt($(this).val());
					if (!isNaN(valor))
						total += valor;
				});
				$('#' + idTotal).val(total);
			}
		});
	};

	$.fn.mpiosXdepto = function (id, url) {
		return this.change(function (event) {
			$.ajax({
				success: function (html) {
					$("#" + id).html(html);
				},
				type: "POST",
				url: url,
				contentType: "application/x-www-form-urlencoded; charset=UTF-8",
				data: {
					depto: $(this).val()
				},
				cache: false,
				dataType: "html"
			});
		});
	};

	/*
	 * Funcion para validar el correo electr�nico
	 * @author Camilo Medina
	 * @since  Agosto 10 / 2015
	 */
	$.fn.validarEmail = function () {
		var emailExp = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		return emailExp.test($(this).val());
	}

	/*
	 * Funcion para validar la url de una p�gina web
	 * @author Camilo Medina
	 * @since  Agosto 10 / 2015
	 */
	$.fn.validarPaginaWeb = function () {
		var paginaExp = /^((www)+\.+([\w-]+\.)+[\w-]{2,4})?$/;
		return paginaExp.test($(this).val());
	}

	$.fn.campoReadonly = function (campo, valor) {
		return this.change(function (event) {
			if ($(this).val() == valor) {
				$('#' + campo).attr('readonly', false);
			} else {
				$('#' + campo).attr('readonly', true);
				$('#' + campo).val('');
			}
		});
	};

	// 2015-08-13 - cemedinaa - Resalta fila donde esta el elemento del formulario que tiene el foco
	$.fn.resaltarFilaForm = function () {
		$((this).prop('elements')).each(function () {
			$('#' + $(this).attr('id')).blur(function () {
				$(this).parent().parent().css('background-color', '');
				//$(this).parent().parent().css('border','');
			});
			$('#' + $(this).attr('id')).focus(function () {
				$(this).parent().parent().css('background-color', 'lightblue');
				//$(this).parent().parent().css('border','5px GREEN solid');
			});
		});
	};

	/////////////////////////////////////////////////
	// Cambio de contrase�a desde el modulo de fuente
	$("#opciones").click(function () {
		$.ajax({
			type: "POST",
			url: base_url + "fuente/opcionesUsuario",
			data: {},
			dataType: "html",
			contentType: "application/x-www-form-urlencoded;charset=ISO-8859-15",
			cache: false,
			success: function (data) {
				$("#divOpciones").html(data);
				$("#btnOpcionesUser").click(function () {
					var actual = $("#txtClaveActual").val();
					var nueva = $("#txtNuevaClave").val();
					var confirma = $("#txtConfirm").val();
					$.ajax({
						type: "POST",
						url: base_url + "fuente/modificarPassword",
						data: {'actual': actual,
							'nueva': nueva,
							'confirm': confirma
						},
						dataType: "html",
						contentType: "application/x-www-form-urlencoded;charset=UTF-8",
						cache: false,
						success: function (data) {
							var obj = eval("(" + data + ")");
							switch (obj.index) {
								case 1:
									alert("Se ha modificado la contrasena del usuario.");
									$("#divOpciones").dialog("close");
									break;
								case 2:
									alert("No se ha podido modificar la contrasena del usuario. Intente Nuevamente.");
									break;
								case 3:
									alert("La nueva contrasena no coincide con la modificacion.");
									break;
								case 4:
									alert("La contrasena actual no coincide.");
									break;
							}
						}
					});
				});
				$("#divOpciones").dialog({
					width: 510,
					title: 'Opciones de Usuario',
					modal: true
				});
			}
		});
	});

	// Cargar municipio autocompletar
	$.fn.municipio = function (nomb, idmun) {
		$(this).val(idmun);
		$.map(lista_municipios, function (ele) {
			if (ele.id == idmun) {
				$('#' + nomb).val(ele.name);
			}
		});
	};

	// Buscar municipio autocompletar
	$.fn.mun_autocomp = function (nomb, divi) {
		var myid = $('#' + divi).val();
		//console.log(divi +': '+ $('#'+ divi).val() +' | '+ nomb +': '+ $('#'+ nomb).val());
		$('#' + nomb).autocomplete({
			select: function (event, ui) {
				myid = ui.item.id;
				$('#' + divi).val(ui.item.id);
			},
			minLength: 2,
			search: function (event, ui) {
				var sValue = $(event.target).val();
				var aSearch = [];
				$.map(lista_municipios, function (ele) {
					if (ele.name.substr(0, sValue.length) == sValue.toUpperCase()) {
						var b = {label: ele.name, value: ele.name, 'id': ele.id};
						aSearch.push(b);
					}
				});
				$(this).autocomplete('option', 'source', aSearch);
			}
		});
		return this.change(function (event) {
			if (myid == '' || $('#' + nomb).val() == '') {
				$('#' + nomb).val('');
				$('#' + divi).val('');
			}
			//return myid = '';
		});
	};

	/*	$("#formulario").tabs({
	 beforeLoad: function( event, ui ) {
	 ui.jqXHR.fail(function() {
	 ui.panel.html("Modulo No disponible por el momento.");
	 });
	 },
	 beforeActivate: function(event, ui) {
	 if (!$("#formulario_confirm").data("confirmed")) { // If event is not triggered by user
	 event.preventDefault(); // prevent switching tabs
	 $("#formulario_confirm").dialog("open").data("ui", ui); // open the dialog and pass the info
	 }
	 },
	 activate: function(event, ui) {
	 $("#formulario_confirm").data("confirmed", false);
	 }
	 });
	 
	 $("#formulario_confirm").dialog({
	 autoOpen: false,
	 modal: true,
	 buttons: {
	 Yes: function() {
	 var ui = $(this).data("ui");
	 // if user clicks yes, change the stored data to true to avoid re-opening dialog
	 $(this).dialog('close').data("confirmed", true);
	 $("#formulario").tabs("option", "active", ui.newTab.index());
	 },
	 No: function() {
	 // if user clicks no, change the stored data so that dialog will be reopened
	 $(this).dialog('close').data("confirmed", false);
	 }
	 }
	 });
	 $("#fin_formulario").click(function() {
	 $.ajax({
	 type: 'POST',
	 url: base_url + "fuente/enviar",
	 contentType: "application/x-www-form-urlencoded; charset=UTF-8",
	 cache: false,
	 //data: args,
	 beforeSend: function(objeto) {
	 $('#fin_mensaje').html('Verificando formulario...');
	 },
	 success: function(respuesta) {
	 $('#fin_mensaje').html('<b>'+ respuesta + '</b>');
	 },
	 error: function(respuesta) {
	 $('#fin_mensaje').html('<font color="red">Error envio formulario</font>');
	 }
	 });
	 });
	 
	 $("a#enviar_vformulario").click(function(e) {
	 e.preventDefault();
	 $.ajax({
	 type: 'POST',
	 url: $(this).attr('href'),
	 cache: false,
	 contentType: "application/x-www-form-urlencoded; charset=UTF-8",
	 //data: args,
	 beforeSend: function(objeto) {
	 $('#fin_mensaje').html('Verificando formulario Placa...');
	 },
	 success: function(respuesta) {
	 $('#fin_mensaje').html('<b>'+ respuesta + '</b>');
	 },
	 error: function(respuesta) {
	 $('#fin_mensaje').html('<font color="red">Error envio formulario</font>');
	 }
	 });
	 });
	 
	 $("a#critica_formulario").click(function(e) {
	 e.preventDefault();
	 $.ajax({
	 type: 'POST',
	 url: $(this).attr('href'),
	 cache: false,
	 contentType: "application/x-www-form-urlencoded; charset=UTF-8",
	 //data: args,
	 beforeSend: function(objeto) {
	 $('#fin_mensaje').html('Verificando formulario...');
	 },
	 success: function(respuesta) {
	 $('#fin_mensaje').html('<b>'+ respuesta + '</b>');
	 },
	 error: function(respuesta) {
	 $('#fin_mensaje').html('<font color="red">Error envio formulario</font>');
	 }
	 });
	 });
	 */
});

var lista_municipios = [
	{"id": "05002", "name": "ABEJORRAL, Antioquia"},
	{"id": "54003", "name": "ABREGO, Norte de Santander"},
	{"id": "05004", "name": "ABRIAQUI, Antioquia"},
	{"id": "50006", "name": "ACACIAS, Meta"},
	{"id": "27006", "name": "ACANDI, Choco"},
	{"id": "41006", "name": "ACEVEDO, Huila"},
	{"id": "13006", "name": "ACHI, Bolivar"},
	{"id": "41013", "name": "AGRADO, Huila"},
	{"id": "25001", "name": "AGUA DE DIOS, Cundinamarca"},
	{"id": "20011", "name": "AGUACHICA, Cesar"},
	{"id": "68013", "name": "AGUADA, Santander"},
	{"id": "17013", "name": "AGUADAS, Caldas"},
	{"id": "85010", "name": "AGUAZUL, Casanare"},
	{"id": "20013", "name": "AGUSTIN CODAZZI, Cesar"},
	{"id": "41016", "name": "AIPE, Huila"},
	{"id": "25019", "name": "ALBAN, Cundinamarca"},
	{"id": "52019", "name": "ALBAN, Nari~o"},
	{"id": "18029", "name": "ALBANIA, Caqueta"},
	{"id": "44035", "name": "ALBANIA, La Guajira"},
	{"id": "68020", "name": "ALBANIA, Santander"},
	{"id": "76020", "name": "ALCALA, Valle del Cauca"},
	{"id": "52022", "name": "ALDANA, Nari~o"},
	{"id": "05021", "name": "ALEJANDRIA, Antioquia"},
	{"id": "47030", "name": "ALGARROBO, Magdalena"},
	{"id": "41020", "name": "ALGECIRAS, Huila"},
	{"id": "19022", "name": "ALMAGUER, Cauca"},
	{"id": "15022", "name": "ALMEIDA, Boyaca"},
	{"id": "73024", "name": "ALPUJARRA, Tolima"},
	{"id": "41026", "name": "ALTAMIRA, Huila"},
	{"id": "27025", "name": "ALTO BAUDO, Choco"},
	{"id": "13030", "name": "ALTOS DEL ROSARIO, Bolivar"},
	{"id": "73026", "name": "ALVARADO, Tolima"},
	{"id": "05030", "name": "AMAGA, Antioquia"},
	{"id": "05031", "name": "AMALFI, Antioquia"},
	{"id": "73030", "name": "AMBALEMA, Tolima"},
	{"id": "25035", "name": "ANAPOIMA, Cundinamarca"},
	{"id": "52036", "name": "ANCUYA, Nari~o"},
	{"id": "76036", "name": "ANDALUCIA, Valle del Cauca"},
	{"id": "05034", "name": "ANDES, Antioquia"},
	{"id": "05036", "name": "ANGELOPOLIS, Antioquia"},
	{"id": "05038", "name": "ANGOSTURA, Antioquia"},
	{"id": "25040", "name": "ANOLAIMA, Cundinamarca"},
	{"id": "05040", "name": "ANORI, Antioquia"},
	{"id": "17042", "name": "ANSERMA, Caldas"},
	{"id": "76041", "name": "ANSERMANUEVO, Valle del Cauca"},
	{"id": "05044", "name": "ANZA, Antioquia"},
	{"id": "73043", "name": "ANZOATEGUI, Tolima"},
	{"id": "05045", "name": "APARTADO, Antioquia"},
	{"id": "66045", "name": "APIA, Risaralda"},
	{"id": "25599", "name": "APULO, Cundinamarca"},
	{"id": "15047", "name": "AQUITANIA, Boyaca"},
	{"id": "47053", "name": "ARACATACA, Magdalena"},
	{"id": "17050", "name": "ARANZAZU, Caldas"},
	{"id": "68051", "name": "ARATOCA, Santander"},
	{"id": "81001", "name": "ARAUCA, Arauca"},
	{"id": "81065", "name": "ARAUQUITA, Arauca"},
	{"id": "25053", "name": "ARBELAEZ, Cundinamarca"},
	{"id": "52051", "name": "ARBOLEDA, Nari~o"},
	{"id": "54051", "name": "ARBOLEDAS, Norte de Santander"},
	{"id": "05051", "name": "ARBOLETES, Antioquia"},
	{"id": "15051", "name": "ARCABUCO, Boyaca"},
	{"id": "13042", "name": "ARENAL, Bolivar"},
	{"id": "05055", "name": "ARGELIA, Antioquia"},
	{"id": "19050", "name": "ARGELIA, Cauca"},
	{"id": "76054", "name": "ARGELIA, Valle del Cauca"},
	{"id": "47058", "name": "ARIGUANI, Magdalena"},
	{"id": "13052", "name": "ARJONA, Bolivar"},
	{"id": "05059", "name": "ARMENIA, Antioquia"},
	{"id": "63001", "name": "ARMENIA, Quindio"},
	{"id": "73055", "name": "ARMERO, Tolima"},
	{"id": "13062", "name": "ARROYOHONDO, Bolivar"},
	{"id": "20032", "name": "ASTREA, Cesar"},
	{"id": "73067", "name": "ATACO, Tolima"},
	{"id": "27050", "name": "ATRATO, Choco"},
	{"id": "23068", "name": "AYAPEL, Cordoba"},
	{"id": "27073", "name": "BAGADO, Choco"},
	{"id": "27075", "name": "BAHIA SOLANO, Choco"},
	{"id": "27077", "name": "BAJO BAUDO, Choco"},
	{"id": "19075", "name": "BALBOA, Cauca"},
	{"id": "66075", "name": "BALBOA, Risaralda"},
	{"id": "08078", "name": "BARANOA, Atlantico"},
	{"id": "41078", "name": "BARAYA, Huila"},
	{"id": "52079", "name": "BARBACOAS, Nari~o"},
	{"id": "05079", "name": "BARBOSA, Antioquia"},
	{"id": "68077", "name": "BARBOSA, Santander"},
	{"id": "68079", "name": "BARICHARA, Santander"},
	{"id": "50110", "name": "BARRANCA DE UPIA, Meta"},
	{"id": "68081", "name": "BARRANCABERMEJA, Santander"},
	{"id": "44078", "name": "BARRANCAS, La Guajira"},
	{"id": "13074", "name": "BARRANCO DE LOBA, Bolivar"},
	{"id": "94343", "name": "BARRANCO MINAS, Guainia"},
	{"id": "08001", "name": "BARRANQUILLA, Atlantico"},
	{"id": "20045", "name": "BECERRIL, Cesar"},
	{"id": "17088", "name": "BELALCAZAR, Caldas"},
	{"id": "15087", "name": "BELEN, Boyaca"},
	{"id": "18094", "name": "BELEN DE LOS ANDAQUIES, Caqueta"},
	{"id": "66088", "name": "BELEN DE UMBRIA, Risaralda"},
	{"id": "52083", "name": "BELEN, Nari~o"},
	{"id": "05088", "name": "BELLO, Antioquia"},
	{"id": "05086", "name": "BELMIRA, Antioquia"},
	{"id": "25086", "name": "BELTRAN, Cundinamarca"},
	{"id": "15090", "name": "BERBEO, Boyaca"},
	{"id": "05091", "name": "BETANIA, Antioquia"},
	{"id": "15092", "name": "BETEITIVA, Boyaca"},
	{"id": "05093", "name": "BETULIA, Antioquia"},
	{"id": "68092", "name": "BETULIA, Santander"},
	{"id": "25095", "name": "BITUIMA, Cundinamarca"},
	{"id": "15097", "name": "BOAVITA, Boyaca"},
	{"id": "54099", "name": "BOCHALEMA, Norte de Santander"},
	{"id": "11001", "name": "BOGOTA, D.C., Bogota D.C."},
	{"id": "25099", "name": "BOJACA, Cundinamarca"},
	{"id": "27099", "name": "BOJAYA, Choco"},
	{"id": "19100", "name": "BOLIVAR, Cauca"},
	{"id": "68101", "name": "BOLIVAR, Santander"},
	{"id": "76100", "name": "BOLIVAR, Valle del Cauca"},
	{"id": "20060", "name": "BOSCONIA, Cesar"},
	{"id": "15104", "name": "BOYACA, Boyaca"},
	{"id": "05107", "name": "BRICE~O, Antioquia"},
	{"id": "15106", "name": "BRICE~O, Boyaca"},
	{"id": "68001", "name": "BUCARAMANGA, Santander"},
	{"id": "54109", "name": "BUCARASICA, Norte de Santander"},
	{"id": "76109", "name": "BUENAVENTURA, Valle del Cauca"},
	{"id": "15109", "name": "BUENAVISTA, Boyaca"},
	{"id": "23079", "name": "BUENAVISTA, Cordoba"},
	{"id": "63111", "name": "BUENAVISTA, Quindio"},
	{"id": "70110", "name": "BUENAVISTA, Sucre"},
	{"id": "19110", "name": "BUENOS AIRES, Cauca"},
	{"id": "52110", "name": "BUESACO, Nari~o"},
	{"id": "76113", "name": "BUGALAGRANDE, Valle del Cauca"},
	{"id": "05113", "name": "BURITICA, Antioquia"},
	{"id": "15114", "name": "BUSBANZA, Boyaca"},
	{"id": "25120", "name": "CABRERA, Cundinamarca"},
	{"id": "68121", "name": "CABRERA, Santander"},
	{"id": "50124", "name": "CABUYARO, Meta"},
	{"id": "94886", "name": "CACAHUAL, Guainia"},
	{"id": "05120", "name": "CACERES, Antioquia"},
	{"id": "25123", "name": "CACHIPAY, Cundinamarca"},
	{"id": "54128", "name": "CACHIRA, Norte de Santander"},
	{"id": "54125", "name": "CACOTA, Norte de Santander"},
	{"id": "05125", "name": "CAICEDO, Antioquia"},
	{"id": "76122", "name": "CAICEDONIA, Valle del Cauca"},
	{"id": "70124", "name": "CAIMITO, Sucre"},
	{"id": "73124", "name": "CAJAMARCA, Tolima"},
	{"id": "19130", "name": "CAJIBIO, Cauca"},
	{"id": "25126", "name": "CAJICA, Cundinamarca"},
	{"id": "13140", "name": "CALAMAR, Bolivar"},
	{"id": "95015", "name": "CALAMAR, Guaviare"},
	{"id": "63130", "name": "CALARCA, Quindio"},
	{"id": "05129", "name": "CALDAS, Antioquia"},
	{"id": "15131", "name": "CALDAS, Boyaca"},
	{"id": "19137", "name": "CALDONO, Cauca"},
	{"id": "76001", "name": "CALI, Valle del Cauca"},
	{"id": "68132", "name": "CALIFORNIA, Santander"},
	{"id": "76126", "name": "CALIMA, Valle del Cauca"},
	{"id": "19142", "name": "CALOTO, Cauca"},
	{"id": "05134", "name": "CAMPAMENTO, Antioquia"},
	{"id": "08137", "name": "CAMPO DE LA CRUZ, Atlantico"},
	{"id": "41132", "name": "CAMPOALEGRE, Huila"},
	{"id": "15135", "name": "CAMPOHERMOSO, Boyaca"},
	{"id": "23090", "name": "CANALETE, Cordoba"},
	{"id": "08141", "name": "CANDELARIA, Atlantico"},
	{"id": "76130", "name": "CANDELARIA, Valle del Cauca"},
	{"id": "13160", "name": "CANTAGALLO, Bolivar"},
	{"id": "05138", "name": "CA~ASGORDAS, Antioquia"},
	{"id": "25148", "name": "CAPARRAPI, Cundinamarca"},
	{"id": "68147", "name": "CAPITANEJO, Santander"},
	{"id": "25151", "name": "CAQUEZA, Cundinamarca"},
	{"id": "05142", "name": "CARACOLI, Antioquia"},
	{"id": "05145", "name": "CARAMANTA, Antioquia"},
	{"id": "68152", "name": "CARCASI, Santander"},
	{"id": "05147", "name": "CAREPA, Antioquia"},
	{"id": "73148", "name": "CARMEN DE APICALA, Tolima"},
	{"id": "25154", "name": "CARMEN DE CARUPA, Cundinamarca"},
	{"id": "27150", "name": "CARMEN DEL DARIEN, Choco"},
	{"id": "05150", "name": "CAROLINA, Antioquia"},
	{"id": "13001", "name": "CARTAGENA, Bolivar"},
	{"id": "18150", "name": "CARTAGENA DEL CHAIRA, Caqueta"},
	{"id": "76147", "name": "CARTAGO, Valle del Cauca"},
	{"id": "97161", "name": "CARURU, Vaupes"},
	{"id": "73152", "name": "CASABIANCA, Tolima"},
	{"id": "50150", "name": "CASTILLA LA NUEVA, Meta"},
	{"id": "05154", "name": "CAUCASIA, Antioquia"},
	{"id": "68160", "name": "CEPITA, Santander"},
	{"id": "23162", "name": "CERETE, Cordoba"},
	{"id": "15162", "name": "CERINZA, Boyaca"},
	{"id": "68162", "name": "CERRITO, Santander"},
	{"id": "47161", "name": "CERRO SAN ANTONIO, Magdalena"},
	{"id": "27160", "name": "CERTEGUI, Choco"},
	{"id": "52240", "name": "CHACHAG�I, Nari~o"},
	{"id": "25168", "name": "CHAGUANI, Cundinamarca"},
	{"id": "70230", "name": "CHALAN, Sucre"},
	{"id": "85015", "name": "CHAMEZA, Casanare"},
	{"id": "73168", "name": "CHAPARRAL, Tolima"},
	{"id": "68167", "name": "CHARALA, Santander"},
	{"id": "68169", "name": "CHARTA, Santander"},
	{"id": "25175", "name": "CHIA, Cundinamarca"},
	{"id": "47170", "name": "CHIBOLO, Magdalena"},
	{"id": "05172", "name": "CHIGORODO, Antioquia"},
	{"id": "23168", "name": "CHIMA, Cordoba"},
	{"id": "68176", "name": "CHIMA, Santander"},
	{"id": "20175", "name": "CHIMICHAGUA, Cesar"},
	{"id": "54172", "name": "CHINACOTA, Norte de Santander"},
	{"id": "15172", "name": "CHINAVITA, Boyaca"},
	{"id": "17174", "name": "CHINCHINA, Caldas"},
	{"id": "23182", "name": "CHINU, Cordoba"},
	{"id": "25178", "name": "CHIPAQUE, Cundinamarca"},
	{"id": "68179", "name": "CHIPATA, Santander"},
	{"id": "15176", "name": "CHIQUINQUIRA, Boyaca"},
	{"id": "15232", "name": "CHIQUIZA, Boyaca"},
	{"id": "20178", "name": "CHIRIGUANA, Cesar"},
	{"id": "15180", "name": "CHISCAS, Boyaca"},
	{"id": "15183", "name": "CHITA, Boyaca"},
	{"id": "54174", "name": "CHITAGA, Norte de Santander"},
	{"id": "15185", "name": "CHITARAQUE, Boyaca"},
	{"id": "15187", "name": "CHIVATA, Boyaca"},
	{"id": "15236", "name": "CHIVOR, Boyaca"},
	{"id": "25181", "name": "CHOACHI, Cundinamarca"},
	{"id": "25183", "name": "CHOCONTA, Cundinamarca"},
	{"id": "13188", "name": "CICUCO, Bolivar"},
	{"id": "23189", "name": "CIENAGA DE ORO, Cordoba"},
	{"id": "47189", "name": "CIENAGA, Magdalena"},
	{"id": "15189", "name": "CIENEGA, Boyaca"},
	{"id": "68190", "name": "CIMITARRA, Santander"},
	{"id": "63190", "name": "CIRCASIA, Quindio"},
	{"id": "05190", "name": "CISNEROS, Antioquia"},
	{"id": "05101", "name": "CIUDAD BOLIVAR, Antioquia"},
	{"id": "13222", "name": "CLEMENCIA, Bolivar"},
	{"id": "05197", "name": "COCORNA, Antioquia"},
	{"id": "73200", "name": "COELLO, Tolima"},
	{"id": "25200", "name": "COGUA, Cundinamarca"},
	{"id": "41206", "name": "COLOMBIA, Huila"},
	{"id": "52203", "name": "COLON, Nari~o"},
	{"id": "86219", "name": "COLON, Putumayo"},
	{"id": "70204", "name": "COLOSO, Sucre"},
	{"id": "15204", "name": "COMBITA, Boyaca"},
	{"id": "05206", "name": "CONCEPCION, Antioquia"},
	{"id": "68207", "name": "CONCEPCION, Santander"},
	{"id": "05209", "name": "CONCORDIA, Antioquia"},
	{"id": "47205", "name": "CONCORDIA, Magdalena"},
	{"id": "27205", "name": "CONDOTO, Choco"},
	{"id": "68209", "name": "CONFINES, Santander"},
	{"id": "52207", "name": "CONSACA, Nari~o"},
	{"id": "52210", "name": "CONTADERO, Nari~o"},
	{"id": "68211", "name": "CONTRATACION, Santander"},
	{"id": "54206", "name": "CONVENCION, Norte de Santander"},
	{"id": "05212", "name": "COPACABANA, Antioquia"},
	{"id": "15212", "name": "COPER, Boyaca"},
	{"id": "13212", "name": "CORDOBA, Bolivar"},
	{"id": "52215", "name": "CORDOBA, Nari~o"},
	{"id": "63212", "name": "CORDOBA, Quindio"},
	{"id": "19212", "name": "CORINTO, Cauca"},
	{"id": "68217", "name": "COROMORO, Santander"},
	{"id": "70215", "name": "COROZAL, Sucre"},
	{"id": "15215", "name": "CORRALES, Boyaca"},
	{"id": "25214", "name": "COTA, Cundinamarca"},
	{"id": "23300", "name": "COTORRA, Cordoba"},
	{"id": "15218", "name": "COVARACHIA, Boyaca"},
	{"id": "70221", "name": "COVE~AS, Sucre"},
	{"id": "73217", "name": "COYAIMA, Tolima"},
	{"id": "81220", "name": "CRAVO NORTE, Arauca"},
	{"id": "52224", "name": "CUASPUD, Nari~o"},
	{"id": "15223", "name": "CUBARA, Boyaca"},
	{"id": "50223", "name": "CUBARRAL, Meta"},
	{"id": "15224", "name": "CUCAITA, Boyaca"},
	{"id": "25224", "name": "CUCUNUBA, Cundinamarca"},
	{"id": "54001", "name": "CUCUTA, Norte de Santander"},
	{"id": "54223", "name": "CUCUTILLA, Norte de Santander"},
	{"id": "15226", "name": "CUITIVA, Boyaca"},
	{"id": "50226", "name": "CUMARAL, Meta"},
	{"id": "99773", "name": "CUMARIBO, Vichada"},
	{"id": "52227", "name": "CUMBAL, Nari~o"},
	{"id": "52233", "name": "CUMBITARA, Nari~o"},
	{"id": "73226", "name": "CUNDAY, Tolima"},
	{"id": "18205", "name": "CURILLO, Caqueta"},
	{"id": "68229", "name": "CURITI, Santander"},
	{"id": "20228", "name": "CURUMANI, Cesar"},
	{"id": "05234", "name": "DABEIBA, Antioquia"},
	{"id": "76233", "name": "DAGUA, Valle del Cauca"},
	{"id": "44090", "name": "DIBULLA, La Guajira"},
	{"id": "44098", "name": "DISTRACCION, La Guajira"},
	{"id": "73236", "name": "DOLORES, Tolima"},
	{"id": "05237", "name": "DONMATIAS, Antioquia"},
	{"id": "66170", "name": "DOSQUEBRADAS, Risaralda"},
	{"id": "15238", "name": "DUITAMA, Boyaca"},
	{"id": "54239", "name": "DURANIA, Norte de Santander"},
	{"id": "05240", "name": "EBEJICO, Antioquia"},
	{"id": "76243", "name": "EL AGUILA, Valle del Cauca"},
	{"id": "05250", "name": "EL BAGRE, Antioquia"},
	{"id": "47245", "name": "EL BANCO, Magdalena"},
	{"id": "76246", "name": "EL CAIRO, Valle del Cauca"},
	{"id": "50245", "name": "EL CALVARIO, Meta"},
	{"id": "27135", "name": "EL CANTON DEL SAN PABLO, Choco"},
	{"id": "27245", "name": "EL CARMEN DE ATRATO, Choco"},
	{"id": "13244", "name": "EL CARMEN DE BOLIVAR, Bolivar"},
	{"id": "68235", "name": "EL CARMEN DE CHUCURI, Santander"},
	{"id": "05148", "name": "EL CARMEN DE VIBORAL, Antioquia"},
	{"id": "54245", "name": "EL CARMEN, Norte de Santander"},
	{"id": "50251", "name": "EL CASTILLO, Meta"},
	{"id": "76248", "name": "EL CERRITO, Valle del Cauca"},
	{"id": "52250", "name": "EL CHARCO, Nari~o"},
	{"id": "15244", "name": "EL COCUY, Boyaca"},
	{"id": "25245", "name": "EL COLEGIO, Cundinamarca"},
	{"id": "20238", "name": "EL COPEY, Cesar"},
	{"id": "18247", "name": "EL DONCELLO, Caqueta"},
	{"id": "50270", "name": "EL DORADO, Meta"},
	{"id": "76250", "name": "EL DOVIO, Valle del Cauca"},
	{"id": "91263", "name": "EL ENCANTO, Amazonas"},
	{"id": "15248", "name": "EL ESPINO, Boyaca"},
	{"id": "68245", "name": "EL GUACAMAYO, Santander"},
	{"id": "13248", "name": "EL GUAMO, Bolivar"},
	{"id": "27250", "name": "EL LITORAL DEL SAN JUAN, Choco"},
	{"id": "44110", "name": "EL MOLINO, La Guajira"},
	{"id": "20250", "name": "EL PASO, Cesar"},
	{"id": "18256", "name": "EL PAUJIL, Caqueta"},
	{"id": "52254", "name": "EL PE~OL, Nari~o"},
	{"id": "13268", "name": "EL PE~ON, Bolivar"},
	{"id": "25258", "name": "EL PE~ON, Cundinamarca"},
	{"id": "68250", "name": "EL PE~ON, Santander"},
	{"id": "47258", "name": "EL PI~ON, Magdalena"},
	{"id": "68255", "name": "EL PLAYON, Santander"},
	{"id": "47268", "name": "EL RETEN, Magdalena"},
	{"id": "95025", "name": "EL RETORNO, Guaviare"},
	{"id": "70233", "name": "EL ROBLE, Sucre"},
	{"id": "25260", "name": "EL ROSAL, Cundinamarca"},
	{"id": "52256", "name": "EL ROSARIO, Nari~o"},
	{"id": "05697", "name": "EL SANTUARIO, Antioquia"},
	{"id": "52258", "name": "EL TABLON DE GOMEZ, Nari~o"},
	{"id": "19256", "name": "EL TAMBO, Cauca"},
	{"id": "52260", "name": "EL TAMBO, Nari~o"},
	{"id": "54250", "name": "EL TARRA, Norte de Santander"},
	{"id": "54261", "name": "EL ZULIA, Norte de Santander"},
	{"id": "41244", "name": "ELIAS, Huila"},
	{"id": "68264", "name": "ENCINO, Santander"},
	{"id": "68266", "name": "ENCISO, Santander"},
	{"id": "05264", "name": "ENTRERRIOS, Antioquia"},
	{"id": "05266", "name": "ENVIGADO, Antioquia"},
	{"id": "73268", "name": "ESPINAL, Tolima"},
	{"id": "25269", "name": "FACATATIVA, Cundinamarca"},
	{"id": "73270", "name": "FALAN, Tolima"},
	{"id": "17272", "name": "FILADELFIA, Caldas"},
	{"id": "63272", "name": "FILANDIA, Quindio"},
	{"id": "15272", "name": "FIRAVITOBA, Boyaca"},
	{"id": "73275", "name": "FLANDES, Tolima"},
	{"id": "18001", "name": "FLORENCIA, Caqueta"},
	{"id": "19290", "name": "FLORENCIA, Cauca"},
	{"id": "15276", "name": "FLORESTA, Boyaca"},
	{"id": "68271", "name": "FLORIAN, Santander"},
	{"id": "76275", "name": "FLORIDA, Valle del Cauca"},
	{"id": "68276", "name": "FLORIDABLANCA, Santander"},
	{"id": "25279", "name": "FOMEQUE, Cundinamarca"},
	{"id": "44279", "name": "FONSECA, La Guajira"},
	{"id": "81300", "name": "FORTUL, Arauca"},
	{"id": "25281", "name": "FOSCA, Cundinamarca"},
	{"id": "52520", "name": "FRANCISCO PIZARRO, Nari~o"},
	{"id": "05282", "name": "FREDONIA, Antioquia"},
	{"id": "73283", "name": "FRESNO, Tolima"},
	{"id": "05284", "name": "FRONTINO, Antioquia"},
	{"id": "50287", "name": "FUENTE DE ORO, Meta"},
	{"id": "47288", "name": "FUNDACION, Magdalena"},
	{"id": "52287", "name": "FUNES, Nari~o"},
	{"id": "25286", "name": "FUNZA, Cundinamarca"},
	{"id": "25288", "name": "FUQUENE, Cundinamarca"},
	{"id": "25290", "name": "FUSAGASUGA, Cundinamarca"},
	{"id": "25293", "name": "GACHALA, Cundinamarca"},
	{"id": "25295", "name": "GACHANCIPA, Cundinamarca"},
	{"id": "15293", "name": "GACHANTIVA, Boyaca"},
	{"id": "25297", "name": "GACHETA, Cundinamarca"},
	{"id": "68327", "name": "G�EPSA, Santander"},
	{"id": "15332", "name": "G�ICAN, Boyaca"},
	{"id": "68296", "name": "GALAN, Santander"},
	{"id": "08296", "name": "GALAPA, Atlantico"},
	{"id": "70235", "name": "GALERAS, Sucre"},
	{"id": "25299", "name": "GAMA, Cundinamarca"},
	{"id": "20295", "name": "GAMARRA, Cesar"},
	{"id": "68298", "name": "GAMBITA, Santander"},
	{"id": "15296", "name": "GAMEZA, Boyaca"},
	{"id": "15299", "name": "GARAGOA, Boyaca"},
	{"id": "41298", "name": "GARZON, Huila"},
	{"id": "63302", "name": "GENOVA, Quindio"},
	{"id": "41306", "name": "GIGANTE, Huila"},
	{"id": "76306", "name": "GINEBRA, Valle del Cauca"},
	{"id": "05306", "name": "GIRALDO, Antioquia"},
	{"id": "25307", "name": "GIRARDOT, Cundinamarca"},
	{"id": "05308", "name": "GIRARDOTA, Antioquia"},
	{"id": "68307", "name": "GIRON, Santander"},
	{"id": "05310", "name": "GOMEZ PLATA, Antioquia"},
	{"id": "20310", "name": "GONZALEZ, Cesar"},
	{"id": "54313", "name": "GRAMALOTE, Norte de Santander"},
	{"id": "05313", "name": "GRANADA, Antioquia"},
	{"id": "25312", "name": "GRANADA, Cundinamarca"},
	{"id": "50313", "name": "GRANADA, Meta"},
	{"id": "68318", "name": "GUACA, Santander"},
	{"id": "15317", "name": "GUACAMAYAS, Boyaca"},
	{"id": "76318", "name": "GUACARI, Valle del Cauca"},
	{"id": "19300", "name": "GUACHENE, Cauca"},
	{"id": "25317", "name": "GUACHETA, Cundinamarca"},
	{"id": "52317", "name": "GUACHUCAL, Nari~o"},
	{"id": "76111", "name": "GUADALAJARA DE BUGA, Valle del Cauca"},
	{"id": "05315", "name": "GUADALUPE, Antioquia"},
	{"id": "41319", "name": "GUADALUPE, Huila"},
	{"id": "68320", "name": "GUADALUPE, Santander"},
	{"id": "25320", "name": "GUADUAS, Cundinamarca"},
	{"id": "52320", "name": "GUAITARILLA, Nari~o"},
	{"id": "52323", "name": "GUALMATAN, Nari~o"},
	{"id": "47318", "name": "GUAMAL, Magdalena"},
	{"id": "50318", "name": "GUAMAL, Meta"},
	{"id": "73319", "name": "GUAMO, Tolima"},
	{"id": "19318", "name": "GUAPI, Cauca"},
	{"id": "68322", "name": "GUAPOTA, Santander"},
	{"id": "70265", "name": "GUARANDA, Sucre"},
	{"id": "05318", "name": "GUARNE, Antioquia"},
	{"id": "25322", "name": "GUASCA, Cundinamarca"},
	{"id": "05321", "name": "GUATAPE, Antioquia"},
	{"id": "25324", "name": "GUATAQUI, Cundinamarca"},
	{"id": "25326", "name": "GUATAVITA, Cundinamarca"},
	{"id": "15322", "name": "GUATEQUE, Boyaca"},
	{"id": "66318", "name": "GUATICA, Risaralda"},
	{"id": "68324", "name": "GUAVATA, Santander"},
	{"id": "25328", "name": "GUAYABAL DE SIQUIMA, Cundinamarca"},
	{"id": "25335", "name": "GUAYABETAL, Cundinamarca"},
	{"id": "15325", "name": "GUAYATA, Boyaca"},
	{"id": "25339", "name": "GUTIERREZ, Cundinamarca"},
	{"id": "54344", "name": "HACARI, Norte de Santander"},
	{"id": "13300", "name": "HATILLO DE LOBA, Bolivar"},
	{"id": "85125", "name": "HATO COROZAL, Casanare"},
	{"id": "68344", "name": "HATO, Santander"},
	{"id": "44378", "name": "HATONUEVO, La Guajira"},
	{"id": "05347", "name": "HELICONIA, Antioquia"},
	{"id": "54347", "name": "HERRAN, Norte de Santander"},
	{"id": "73347", "name": "HERVEO, Tolima"},
	{"id": "05353", "name": "HISPANIA, Antioquia"},
	{"id": "41349", "name": "HOBO, Huila"},
	{"id": "73349", "name": "HONDA, Tolima"},
	{"id": "73001", "name": "IBAGUE, Tolima"},
	{"id": "73352", "name": "ICONONZO, Tolima"},
	{"id": "52352", "name": "ILES, Nari~o"},
	{"id": "52354", "name": "IMUES, Nari~o"},
	{"id": "94001", "name": "INIRIDA, Guainia"},
	{"id": "19355", "name": "INZA, Cauca"},
	{"id": "52356", "name": "IPIALES, Nari~o"},
	{"id": "41357", "name": "IQUIRA, Huila"},
	{"id": "41359", "name": "ISNOS, Huila"},
	{"id": "27361", "name": "ISTMINA, Choco"},
	{"id": "05360", "name": "ITAGUI, Antioquia"},
	{"id": "05361", "name": "ITUANGO, Antioquia"},
	{"id": "15362", "name": "IZA, Boyaca"},
	{"id": "19364", "name": "JAMBALO, Cauca"},
	{"id": "76364", "name": "JAMUNDI, Valle del Cauca"},
	{"id": "05364", "name": "JARDIN, Antioquia"},
	{"id": "15367", "name": "JENESANO, Boyaca"},
	{"id": "05368", "name": "JERICO, Antioquia"},
	{"id": "15368", "name": "JERICO, Boyaca"},
	{"id": "25368", "name": "JERUSALEN, Cundinamarca"},
	{"id": "68368", "name": "JESUS MARIA, Santander"},
	{"id": "68370", "name": "JORDAN, Santander"},
	{"id": "08372", "name": "JUAN DE ACOSTA, Atlantico"},
	{"id": "25372", "name": "JUNIN, Cundinamarca"},
	{"id": "27372", "name": "JURADO, Choco"},
	{"id": "23350", "name": "LA APARTADA, Cordoba"},
	{"id": "41378", "name": "LA ARGENTINA, Huila"},
	{"id": "68377", "name": "LA BELLEZA, Santander"},
	{"id": "25377", "name": "LA CALERA, Cundinamarca"},
	{"id": "15380", "name": "LA CAPILLA, Boyaca"},
	{"id": "05376", "name": "LA CEJA, Antioquia"},
	{"id": "66383", "name": "LA CELIA, Risaralda"},
	{"id": "91405", "name": "LA CHORRERA, Amazonas"},
	{"id": "52378", "name": "LA CRUZ, Nari~o"},
	{"id": "76377", "name": "LA CUMBRE, Valle del Cauca"},
	{"id": "17380", "name": "LA DORADA, Caldas"},
	{"id": "54385", "name": "LA ESPERANZA, Norte de Santander"},
	{"id": "05380", "name": "LA ESTRELLA, Antioquia"},
	{"id": "52381", "name": "LA FLORIDA, Nari~o"},
	{"id": "20383", "name": "LA GLORIA, Cesar"},
	{"id": "94885", "name": "LA GUADALUPE, Guainia"},
	{"id": "20400", "name": "LA JAGUA DE IBIRICO, Cesar"},
	{"id": "44420", "name": "LA JAGUA DEL PILAR, La Guajira"},
	{"id": "52385", "name": "LA LLANADA, Nari~o"},
	{"id": "50350", "name": "LA MACARENA, Meta"},
	{"id": "17388", "name": "LA MERCED, Caldas"},
	{"id": "25386", "name": "LA MESA, Cundinamarca"},
	{"id": "18410", "name": "LA MONTA~ITA, Caqueta"},
	{"id": "25394", "name": "LA PALMA, Cundinamarca"},
	{"id": "20621", "name": "LA PAZ, Cesar"},
	{"id": "68397", "name": "LA PAZ, Santander"},
	{"id": "91407", "name": "LA PEDRERA, Amazonas"},
	{"id": "25398", "name": "LA PE~A, Cundinamarca"},
	{"id": "05390", "name": "LA PINTADA, Antioquia"},
	{"id": "41396", "name": "LA PLATA, Huila"},
	{"id": "54398", "name": "LA PLAYA, Norte de Santander"},
	{"id": "99524", "name": "LA PRIMAVERA, Vichada"},
	{"id": "85136", "name": "LA SALINA, Casanare"},
	{"id": "19392", "name": "LA SIERRA, Cauca"},
	{"id": "63401", "name": "LA TEBAIDA, Quindio"},
	{"id": "52390", "name": "LA TOLA, Nari~o"},
	{"id": "05400", "name": "LA UNION, Antioquia"},
	{"id": "52399", "name": "LA UNION, Nari~o"},
	{"id": "70400", "name": "LA UNION, Sucre"},
	{"id": "76400", "name": "LA UNION, Valle del Cauca"},
	{"id": "15403", "name": "LA UVITA, Boyaca"},
	{"id": "19397", "name": "LA VEGA, Cauca"},
	{"id": "25402", "name": "LA VEGA, Cundinamarca"},
	{"id": "91430", "name": "LA VICTORIA, Amazonas"},
	{"id": "15401", "name": "LA VICTORIA, Boyaca"},
	{"id": "76403", "name": "LA VICTORIA, Valle del Cauca"},
	{"id": "66400", "name": "LA VIRGINIA, Risaralda"},
	{"id": "54377", "name": "LABATECA, Norte de Santander"},
	{"id": "15377", "name": "LABRANZAGRANDE, Boyaca"},
	{"id": "68385", "name": "LANDAZURI, Santander"},
	{"id": "68406", "name": "LEBRIJA, Santander"},
	{"id": "52405", "name": "LEIVA, Nari~o"},
	{"id": "50400", "name": "LEJANIAS, Meta"},
	{"id": "25407", "name": "LENGUAZAQUE, Cundinamarca"},
	{"id": "73408", "name": "LERIDA, Tolima"},
	{"id": "91001", "name": "LETICIA, Amazonas"},
	{"id": "73411", "name": "LIBANO, Tolima"},
	{"id": "05411", "name": "LIBORINA, Antioquia"},
	{"id": "52411", "name": "LINARES, Nari~o"},
	{"id": "27413", "name": "LLORO, Choco"},
	{"id": "19418", "name": "LOPEZ, Cauca"},
	{"id": "23417", "name": "LORICA, Cordoba"},
	{"id": "52418", "name": "LOS ANDES, Nari~o"},
	{"id": "23419", "name": "LOS CORDOBAS, Cordoba"},
	{"id": "70418", "name": "LOS PALMITOS, Sucre"},
	{"id": "54405", "name": "LOS PATIOS, Norte de Santander"},
	{"id": "68418", "name": "LOS SANTOS, Santander"},
	{"id": "54418", "name": "LOURDES, Norte de Santander"},
	{"id": "08421", "name": "LURUACO, Atlantico"},
	{"id": "15425", "name": "MACANAL, Boyaca"},
	{"id": "68425", "name": "MACARAVITA, Santander"},
	{"id": "05425", "name": "MACEO, Antioquia"},
	{"id": "25426", "name": "MACHETA, Cundinamarca"},
	{"id": "25430", "name": "MADRID, Cundinamarca"},
	{"id": "52427", "name": "MAG�I, Nari~o"},
	{"id": "13430", "name": "MAGANGUE, Bolivar"},
	{"id": "13433", "name": "MAHATES, Bolivar"},
	{"id": "44430", "name": "MAICAO, La Guajira"},
	{"id": "70429", "name": "MAJAGUAL, Sucre"},
	{"id": "68432", "name": "MALAGA, Santander"},
	{"id": "08433", "name": "MALAMBO, Atlantico"},
	{"id": "52435", "name": "MALLAMA, Nari~o"},
	{"id": "08436", "name": "MANATI, Atlantico"},
	{"id": "20443", "name": "MANAURE, Cesar"},
	{"id": "44560", "name": "MANAURE, La Guajira"},
	{"id": "85139", "name": "MANI, Casanare"},
	{"id": "17001", "name": "MANIZALES, Caldas"},
	{"id": "25436", "name": "MANTA, Cundinamarca"},
	{"id": "17433", "name": "MANZANARES, Caldas"},
	{"id": "50325", "name": "MAPIRIPAN, Meta"},
	{"id": "94663", "name": "MAPIRIPANA, Guainia"},
	{"id": "13440", "name": "MARGARITA, Bolivar"},
	{"id": "13442", "name": "MARIA LA BAJA, Bolivar"},
	{"id": "05440", "name": "MARINILLA, Antioquia"},
	{"id": "15442", "name": "MARIPI, Boyaca"},
	{"id": "17442", "name": "MARMATO, Caldas"},
	{"id": "17444", "name": "MARQUETALIA, Caldas"},
	{"id": "66440", "name": "MARSELLA, Risaralda"},
	{"id": "17446", "name": "MARULANDA, Caldas"},
	{"id": "68444", "name": "MATANZA, Santander"},
	{"id": "05001", "name": "MEDELLIN, Antioquia"},
	{"id": "25438", "name": "MEDINA, Cundinamarca"},
	{"id": "27425", "name": "MEDIO ATRATO, Choco"},
	{"id": "27430", "name": "MEDIO BAUDO, Choco"},
	{"id": "27450", "name": "MEDIO SAN JUAN, Choco"},
	{"id": "73449", "name": "MELGAR, Tolima"},
	{"id": "19450", "name": "MERCADERES, Cauca"},
	{"id": "50330", "name": "MESETAS, Meta"},
	{"id": "18460", "name": "MILAN, Caqueta"},
	{"id": "15455", "name": "MIRAFLORES, Boyaca"},
	{"id": "95200", "name": "MIRAFLORES, Guaviare"},
	{"id": "19455", "name": "MIRANDA, Cauca"},
	{"id": "91460", "name": "MIRITI - PARANA, Amazonas"},
	{"id": "66456", "name": "MISTRATO, Risaralda"},
	{"id": "97001", "name": "MITU, Vaupes"},
	{"id": "86001", "name": "MOCOA, Putumayo"},
	{"id": "68464", "name": "MOGOTES, Santander"},
	{"id": "68468", "name": "MOLAGAVITA, Santander"},
	{"id": "23464", "name": "MOMIL, Cordoba"},
	{"id": "13468", "name": "MOMPOS, Bolivar"},
	{"id": "15464", "name": "MONGUA, Boyaca"},
	{"id": "15466", "name": "MONGUI, Boyaca"},
	{"id": "15469", "name": "MONIQUIRA, Boyaca"},
	{"id": "05467", "name": "MONTEBELLO, Antioquia"},
	{"id": "13458", "name": "MONTECRISTO, Bolivar"},
	{"id": "23466", "name": "MONTELIBANO, Cordoba"},
	{"id": "63470", "name": "MONTENEGRO, Quindio"},
	{"id": "23001", "name": "MONTERIA, Cordoba"},
	{"id": "85162", "name": "MONTERREY, Casanare"},
	{"id": "23500", "name": "MO~ITOS, Cordoba"},
	{"id": "13473", "name": "MORALES, Bolivar"},
	{"id": "19473", "name": "MORALES, Cauca"},
	{"id": "18479", "name": "MORELIA, Caqueta"},
	{"id": "94888", "name": "MORICHAL, Guainia"},
	{"id": "70473", "name": "MORROA, Sucre"},
	{"id": "25473", "name": "MOSQUERA, Cundinamarca"},
	{"id": "52473", "name": "MOSQUERA, Nari~o"},
	{"id": "15476", "name": "MOTAVITA, Boyaca"},
	{"id": "73461", "name": "MURILLO, Tolima"},
	{"id": "05475", "name": "MURINDO, Antioquia"},
	{"id": "05480", "name": "MUTATA, Antioquia"},
	{"id": "54480", "name": "MUTISCUA, Norte de Santander"},
	{"id": "15480", "name": "MUZO, Boyaca"},
	{"id": "05483", "name": "NARI~O, Antioquia"},
	{"id": "25483", "name": "NARI~O, Cundinamarca"},
	{"id": "52480", "name": "NARI~O, Nari~o"},
	{"id": "41483", "name": "NATAGA, Huila"},
	{"id": "73483", "name": "NATAGAIMA, Tolima"},
	{"id": "05495", "name": "NECHI, Antioquia"},
	{"id": "05490", "name": "NECOCLI, Antioquia"},
	{"id": "17486", "name": "NEIRA, Caldas"},
	{"id": "41001", "name": "NEIVA, Huila"},
	{"id": "25486", "name": "NEMOCON, Cundinamarca"},
	{"id": "25488", "name": "NILO, Cundinamarca"},
	{"id": "25489", "name": "NIMAIMA, Cundinamarca"},
	{"id": "15491", "name": "NOBSA, Boyaca"},
	{"id": "25491", "name": "NOCAIMA, Cundinamarca"},
	{"id": "17495", "name": "NORCASIA, Caldas"},
	{"id": "13490", "name": "NOROSI, Bolivar"},
	{"id": "27491", "name": "NOVITA, Choco"},
	{"id": "47460", "name": "NUEVA GRANADA, Magdalena"},
	{"id": "15494", "name": "NUEVO COLON, Boyaca"},
	{"id": "85225", "name": "NUNCHIA, Casanare"},
	{"id": "27495", "name": "NUQUI, Choco"},
	{"id": "76497", "name": "OBANDO, Valle del Cauca"},
	{"id": "68498", "name": "OCAMONTE, Santander"},
	{"id": "54498", "name": "OCA~A, Norte de Santander"},
	{"id": "68500", "name": "OIBA, Santander"},
	{"id": "15500", "name": "OICATA, Boyaca"},
	{"id": "05501", "name": "OLAYA, Antioquia"},
	{"id": "52490", "name": "OLAYA HERRERA, Nari~o"},
	{"id": "68502", "name": "ONZAGA, Santander"},
	{"id": "41503", "name": "OPORAPA, Huila"},
	{"id": "86320", "name": "ORITO, Putumayo"},
	{"id": "85230", "name": "OROCUE, Casanare"},
	{"id": "73504", "name": "ORTEGA, Tolima"},
	{"id": "52506", "name": "OSPINA, Nari~o"},
	{"id": "15507", "name": "OTANCHE, Boyaca"},
	{"id": "70508", "name": "OVEJAS, Sucre"},
	{"id": "15511", "name": "PACHAVITA, Boyaca"},
	{"id": "25513", "name": "PACHO, Cundinamarca"},
	{"id": "97511", "name": "PACOA, Vaupes"},
	{"id": "17513", "name": "PACORA, Caldas"},
	{"id": "19513", "name": "PADILLA, Cauca"},
	{"id": "15514", "name": "PAEZ, Boyaca"},
	{"id": "19517", "name": "PAEZ, Cauca"},
	{"id": "41518", "name": "PAICOL, Huila"},
	{"id": "20517", "name": "PAILITAS, Cesar"},
	{"id": "25518", "name": "PAIME, Cundinamarca"},
	{"id": "15516", "name": "PAIPA, Boyaca"},
	{"id": "15518", "name": "PAJARITO, Boyaca"},
	{"id": "41524", "name": "PALERMO, Huila"},
	{"id": "17524", "name": "PALESTINA, Caldas"},
	{"id": "41530", "name": "PALESTINA, Huila"},
	{"id": "08520", "name": "PALMAR DE VARELA, Atlantico"},
	{"id": "68522", "name": "PALMAR, Santander"},
	{"id": "68524", "name": "PALMAS DEL SOCORRO, Santander"},
	{"id": "76520", "name": "PALMIRA, Valle del Cauca"},
	{"id": "70523", "name": "PALMITO, Sucre"},
	{"id": "73520", "name": "PALOCABILDO, Tolima"},
	{"id": "54518", "name": "PAMPLONA, Norte de Santander"},
	{"id": "54520", "name": "PAMPLONITA, Norte de Santander"},
	{"id": "94887", "name": "PANA PANA, Guainia"},
	{"id": "25524", "name": "PANDI, Cundinamarca"},
	{"id": "15522", "name": "PANQUEBA, Boyaca"},
	{"id": "97777", "name": "PAPUNAUA, Vaupes"},
	{"id": "68533", "name": "PARAMO, Santander"},
	{"id": "25530", "name": "PARATEBUENO, Cundinamarca"},
	{"id": "25535", "name": "PASCA, Cundinamarca"},
	{"id": "52001", "name": "PASTO, Nari~o"},
	{"id": "19532", "name": "PATIA, Cauca"},
	{"id": "15531", "name": "PAUNA, Boyaca"},
	{"id": "15533", "name": "PAYA, Boyaca"},
	{"id": "85250", "name": "PAZ DE ARIPORO, Casanare"},
	{"id": "15537", "name": "PAZ DE RIO, Boyaca"},
	{"id": "47541", "name": "PEDRAZA, Magdalena"},
	{"id": "20550", "name": "PELAYA, Cesar"},
	{"id": "17541", "name": "PENSILVANIA, Caldas"},
	{"id": "05541", "name": "PE~OL, Antioquia"},
	{"id": "05543", "name": "PEQUE, Antioquia"},
	{"id": "66001", "name": "PEREIRA, Risaralda"},
	{"id": "15542", "name": "PESCA, Boyaca"},
	{"id": "19533", "name": "PIAMONTE, Cauca"},
	{"id": "68547", "name": "PIEDECUESTA, Santander"},
	{"id": "73547", "name": "PIEDRAS, Tolima"},
	{"id": "19548", "name": "PIENDAMO, Cauca"},
	{"id": "63548", "name": "PIJAO, Quindio"},
	{"id": "47545", "name": "PIJI~O DEL CARMEN, Magdalena"},
	{"id": "68549", "name": "PINCHOTE, Santander"},
	{"id": "13549", "name": "PINILLOS, Bolivar"},
	{"id": "08549", "name": "PIOJO, Atlantico"},
	{"id": "15550", "name": "PISBA, Boyaca"},
	{"id": "41548", "name": "PITAL, Huila"},
	{"id": "41551", "name": "PITALITO, Huila"},
	{"id": "47551", "name": "PIVIJAY, Magdalena"},
	{"id": "73555", "name": "PLANADAS, Tolima"},
	{"id": "23555", "name": "PLANETA RICA, Cordoba"},
	{"id": "47555", "name": "PLATO, Magdalena"},
	{"id": "52540", "name": "POLICARPA, Nari~o"},
	{"id": "08558", "name": "POLONUEVO, Atlantico"},
	{"id": "08560", "name": "PONEDERA, Atlantico"},
	{"id": "19001", "name": "POPAYAN, Cauca"},
	{"id": "85263", "name": "PORE, Casanare"},
	{"id": "52560", "name": "POTOSI, Nari~o"},
	{"id": "76563", "name": "PRADERA, Valle del Cauca"},
	{"id": "73563", "name": "PRADO, Tolima"},
	{"id": "52565", "name": "PROVIDENCIA, Nari~o"},
	{"id": "88564", "name": "PROVIDENCIA, San Andres, Providencia y Sta. Catalina"},
	{"id": "20570", "name": "PUEBLO BELLO, Cesar"},
	{"id": "23570", "name": "PUEBLO NUEVO, Cordoba"},
	{"id": "66572", "name": "PUEBLO RICO, Risaralda"},
	{"id": "05576", "name": "PUEBLORRICO, Antioquia"},
	{"id": "47570", "name": "PUEBLOVIEJO, Magdalena"},
	{"id": "68572", "name": "PUENTE NACIONAL, Santander"},
	{"id": "52573", "name": "PUERRES, Nari~o"},
	{"id": "91530", "name": "PUERTO ALEGRIA, Amazonas"},
	{"id": "91536", "name": "PUERTO ARICA, Amazonas"},
	{"id": "86568", "name": "PUERTO ASIS, Putumayo"},
	{"id": "05579", "name": "PUERTO BERRIO, Antioquia"},
	{"id": "15572", "name": "PUERTO BOYACA, Boyaca"},
	{"id": "86569", "name": "PUERTO CAICEDO, Putumayo"},
	{"id": "99001", "name": "PUERTO CARRE~O, Vichada"},
	{"id": "08573", "name": "PUERTO COLOMBIA, Atlantico"},
	{"id": "94884", "name": "PUERTO COLOMBIA, Guainia"},
	{"id": "50450", "name": "PUERTO CONCORDIA, Meta"},
	{"id": "23574", "name": "PUERTO ESCONDIDO, Cordoba"},
	{"id": "50568", "name": "PUERTO GAITAN, Meta"},
	{"id": "86571", "name": "PUERTO GUZMAN, Putumayo"},
	{"id": "86573", "name": "PUERTO LEGUIZAMO, Putumayo"},
	{"id": "23580", "name": "PUERTO LIBERTADOR, Cordoba"},
	{"id": "50577", "name": "PUERTO LLERAS, Meta"},
	{"id": "50573", "name": "PUERTO LOPEZ, Meta"},
	{"id": "05585", "name": "PUERTO NARE, Antioquia"},
	{"id": "91540", "name": "PUERTO NARI~O, Amazonas"},
	{"id": "68573", "name": "PUERTO PARRA, Santander"},
	{"id": "18592", "name": "PUERTO RICO, Caqueta"},
	{"id": "50590", "name": "PUERTO RICO, Meta"},
	{"id": "81591", "name": "PUERTO RONDON, Arauca"},
	{"id": "25572", "name": "PUERTO SALGAR, Cundinamarca"},
	{"id": "91669", "name": "PUERTO SANTANDER, Amazonas"},
	{"id": "54553", "name": "PUERTO SANTANDER, Norte de Santander"},
	{"id": "19573", "name": "PUERTO TEJADA, Cauca"},
	{"id": "05591", "name": "PUERTO TRIUNFO, Antioquia"},
	{"id": "68575", "name": "PUERTO WILCHES, Santander"},
	{"id": "25580", "name": "PULI, Cundinamarca"},
	{"id": "52585", "name": "PUPIALES, Nari~o"},
	{"id": "19585", "name": "PURACE, Cauca"},
	{"id": "73585", "name": "PURIFICACION, Tolima"},
	{"id": "23586", "name": "PURISIMA, Cordoba"},
	{"id": "25592", "name": "QUEBRADANEGRA, Cundinamarca"},
	{"id": "25594", "name": "QUETAME, Cundinamarca"},
	{"id": "27001", "name": "QUIBDO, Choco"},
	{"id": "63594", "name": "QUIMBAYA, Quindio"},
	{"id": "66594", "name": "QUINCHIA, Risaralda"},
	{"id": "15580", "name": "QUIPAMA, Boyaca"},
	{"id": "25596", "name": "QUIPILE, Cundinamarca"},
	{"id": "54599", "name": "RAGONVALIA, Norte de Santander"},
	{"id": "15599", "name": "RAMIRIQUI, Boyaca"},
	{"id": "15600", "name": "RAQUIRA, Boyaca"},
	{"id": "85279", "name": "RECETOR, Casanare"},
	{"id": "13580", "name": "REGIDOR, Bolivar"},
	{"id": "05604", "name": "REMEDIOS, Antioquia"},
	{"id": "47605", "name": "REMOLINO, Magdalena"},
	{"id": "08606", "name": "REPELON, Atlantico"},
	{"id": "50606", "name": "RESTREPO, Meta"},
	{"id": "76606", "name": "RESTREPO, Valle del Cauca"},
	{"id": "05607", "name": "RETIRO, Antioquia"},
	{"id": "25612", "name": "RICAURTE, Cundinamarca"},
	{"id": "52612", "name": "RICAURTE, Nari~o"},
	{"id": "20614", "name": "RIO DE ORO, Cesar"},
	{"id": "27580", "name": "RIO IRO, Choco"},
	{"id": "27600", "name": "RIO QUITO, Choco"},
	{"id": "13600", "name": "RIO VIEJO, Bolivar"},
	{"id": "73616", "name": "RIOBLANCO, Tolima"},
	{"id": "76616", "name": "RIOFRIO, Valle del Cauca"},
	{"id": "44001", "name": "RIOHACHA, La Guajira"},
	{"id": "05615", "name": "RIONEGRO, Antioquia"},
	{"id": "68615", "name": "RIONEGRO, Santander"},
	{"id": "17614", "name": "RIOSUCIO, Caldas"},
	{"id": "27615", "name": "RIOSUCIO, Choco"},
	{"id": "17616", "name": "RISARALDA, Caldas"},
	{"id": "41615", "name": "RIVERA, Huila"},
	{"id": "52621", "name": "ROBERTO PAYAN, Nari~o"},
	{"id": "76622", "name": "ROLDANILLO, Valle del Cauca"},
	{"id": "73622", "name": "RONCESVALLES, Tolima"},
	{"id": "15621", "name": "RONDON, Boyaca"},
	{"id": "19622", "name": "ROSAS, Cauca"},
	{"id": "73624", "name": "ROVIRA, Tolima"},
	{"id": "68655", "name": "SABANA DE TORRES, Santander"},
	{"id": "08634", "name": "SABANAGRANDE, Atlantico"},
	{"id": "05628", "name": "SABANALARGA, Antioquia"},
	{"id": "08638", "name": "SABANALARGA, Atlantico"},
	{"id": "85300", "name": "SABANALARGA, Casanare"},
	{"id": "47660", "name": "SABANAS DE SAN ANGEL, Magdalena"},
	{"id": "05631", "name": "SABANETA, Antioquia"},
	{"id": "15632", "name": "SABOYA, Boyaca"},
	{"id": "85315", "name": "SACAMA, Casanare"},
	{"id": "15638", "name": "SACHICA, Boyaca"},
	{"id": "23660", "name": "SAHAGUN, Cordoba"},
	{"id": "41660", "name": "SALADOBLANCO, Huila"},
	{"id": "17653", "name": "SALAMINA, Caldas"},
	{"id": "47675", "name": "SALAMINA, Magdalena"},
	{"id": "54660", "name": "SALAZAR, Norte de Santander"},
	{"id": "73671", "name": "SALDA~A, Tolima"},
	{"id": "63690", "name": "SALENTO, Quindio"},
	{"id": "05642", "name": "SALGAR, Antioquia"},
	{"id": "15646", "name": "SAMACA, Boyaca"},
	{"id": "17662", "name": "SAMANA, Caldas"},
	{"id": "52678", "name": "SAMANIEGO, Nari~o"},
	{"id": "70670", "name": "SAMPUES, Sucre"},
	{"id": "41668", "name": "SAN AGUSTIN, Huila"},
	{"id": "20710", "name": "SAN ALBERTO, Cesar"},
	{"id": "05647", "name": "SAN ANDRES DE CUERQUIA, Antioquia"},
	{"id": "52835", "name": "SAN ANDRES DE TUMACO, Nari~o"},
	{"id": "88001", "name": "SAN ANDRES, San Andres, Providencia y Sta. Catalina"},
	{"id": "68669", "name": "SAN ANDRES, Santander"},
	{"id": "23670", "name": "SAN ANDRES SOTAVENTO, Cordoba"},
	{"id": "23672", "name": "SAN ANTERO, Cordoba"},
	{"id": "25645", "name": "SAN ANTONIO DEL TEQUENDAMA, Cundinamarca"},
	{"id": "73675", "name": "SAN ANTONIO, Tolima"},
	{"id": "70678", "name": "SAN BENITO ABAD, Sucre"},
	{"id": "68673", "name": "SAN BENITO, Santander"},
	{"id": "25649", "name": "SAN BERNARDO, Cundinamarca"},
	{"id": "23675", "name": "SAN BERNARDO DEL VIENTO, Cordoba"},
	{"id": "52685", "name": "SAN BERNARDO, Nari~o"},
	{"id": "54670", "name": "SAN CALIXTO, Norte de Santander"},
	{"id": "05649", "name": "SAN CARLOS, Antioquia"},
	{"id": "23678", "name": "SAN CARLOS, Cordoba"},
	{"id": "50680", "name": "SAN CARLOS DE GUAROA, Meta"},
	{"id": "25653", "name": "SAN CAYETANO, Cundinamarca"},
	{"id": "54673", "name": "SAN CAYETANO, Norte de Santander"},
	{"id": "13620", "name": "SAN CRISTOBAL, Bolivar"},
	{"id": "20750", "name": "SAN DIEGO, Cesar"},
	{"id": "15660", "name": "SAN EDUARDO, Boyaca"},
	{"id": "13647", "name": "SAN ESTANISLAO, Bolivar"},
	{"id": "94883", "name": "SAN FELIPE, Guainia"},
	{"id": "13650", "name": "SAN FERNANDO, Bolivar"},
	{"id": "05652", "name": "SAN FRANCISCO, Antioquia"},
	{"id": "25658", "name": "SAN FRANCISCO, Cundinamarca"},
	{"id": "86755", "name": "SAN FRANCISCO, Putumayo"},
	{"id": "68679", "name": "SAN GIL, Santander"},
	{"id": "13654", "name": "SAN JACINTO, Bolivar"},
	{"id": "13655", "name": "SAN JACINTO DEL CAUCA, Bolivar"},
	{"id": "05656", "name": "SAN JERONIMO, Antioquia"},
	{"id": "68682", "name": "SAN JOAQUIN, Santander"},
	{"id": "17665", "name": "SAN JOSE, Caldas"},
	{"id": "05658", "name": "SAN JOSE DE LA MONTA~A, Antioquia"},
	{"id": "68684", "name": "SAN JOSE DE MIRANDA, Santander"},
	{"id": "15664", "name": "SAN JOSE DE PARE, Boyaca"},
	{"id": "23682", "name": "SAN JOSE DE URE, Cordoba"},
	{"id": "18610", "name": "SAN JOSE DEL FRAGUA, Caqueta"},
	{"id": "95001", "name": "SAN JOSE DEL GUAVIARE, Guaviare"},
	{"id": "27660", "name": "SAN JOSE DEL PALMAR, Choco"},
	{"id": "50683", "name": "SAN JUAN DE ARAMA, Meta"},
	{"id": "70702", "name": "SAN JUAN DE BETULIA, Sucre"},
	{"id": "25662", "name": "SAN JUAN DE RIO SECO, Cundinamarca"},
	{"id": "05659", "name": "SAN JUAN DE URABA, Antioquia"},
	{"id": "44650", "name": "SAN JUAN DEL CESAR, La Guajira"},
	{"id": "13657", "name": "SAN JUAN NEPOMUCENO, Bolivar"},
	{"id": "50686", "name": "SAN JUANITO, Meta"},
	{"id": "52687", "name": "SAN LORENZO, Nari~o"},
	{"id": "05660", "name": "SAN LUIS, Antioquia"},
	{"id": "15667", "name": "SAN LUIS DE GACENO, Boyaca"},
	{"id": "85325", "name": "SAN LUIS DE PALENQUE, Casanare"},
	{"id": "70742", "name": "SAN LUIS DE SINCE, Sucre"},
	{"id": "73678", "name": "SAN LUIS, Tolima"},
	{"id": "70708", "name": "SAN MARCOS, Sucre"},
	{"id": "20770", "name": "SAN MARTIN, Cesar"},
	{"id": "13667", "name": "SAN MARTIN DE LOBA, Bolivar"},
	{"id": "50689", "name": "SAN MARTIN, Meta"},
	{"id": "15673", "name": "SAN MATEO, Boyaca"},
	{"id": "15676", "name": "SAN MIGUEL DE SEMA, Boyaca"},
	{"id": "86757", "name": "SAN MIGUEL, Putumayo"},
	{"id": "68686", "name": "SAN MIGUEL, Santander"},
	{"id": "70713", "name": "SAN ONOFRE, Sucre"},
	{"id": "13670", "name": "SAN PABLO, Bolivar"},
	{"id": "15681", "name": "SAN PABLO DE BORBUR, Boyaca"},
	{"id": "52693", "name": "SAN PABLO, Nari~o"},
	{"id": "52694", "name": "SAN PEDRO DE CARTAGO, Nari~o"},
	{"id": "05664", "name": "SAN PEDRO DE LOS MILAGROS, Antioquia"},
	{"id": "05665", "name": "SAN PEDRO DE URABA, Antioquia"},
	{"id": "70717", "name": "SAN PEDRO, Sucre"},
	{"id": "76670", "name": "SAN PEDRO, Valle del Cauca"},
	{"id": "23686", "name": "SAN PELAYO, Cordoba"},
	{"id": "05667", "name": "SAN RAFAEL, Antioquia"},
	{"id": "05670", "name": "SAN ROQUE, Antioquia"},
	{"id": "19693", "name": "SAN SEBASTIAN, Cauca"},
	{"id": "47692", "name": "SAN SEBASTIAN DE BUENAVISTA, Magdalena"},
	{"id": "73443", "name": "SAN SEBASTIAN DE MARIQUITA, Tolima"},
	{"id": "05674", "name": "SAN VICENTE, Antioquia"},
	{"id": "68689", "name": "SAN VICENTE DE CHUCURI, Santander"},
	{"id": "18753", "name": "SAN VICENTE DEL CAGUAN, Caqueta"},
	{"id": "47703", "name": "SAN ZENON, Magdalena"},
	{"id": "52683", "name": "SANDONA, Nari~o"},
	{"id": "47707", "name": "SANTA ANA, Magdalena"},
	{"id": "05679", "name": "SANTA BARBARA, Antioquia"},
	{"id": "47720", "name": "SANTA BARBARA DE PINTO, Magdalena"},
	{"id": "52696", "name": "SANTA BARBARA, Nari~o"},
	{"id": "68705", "name": "SANTA BARBARA, Santander"},
	{"id": "13673", "name": "SANTA CATALINA, Bolivar"},
	{"id": "68720", "name": "SANTA HELENA DEL OPON, Santander"},
	{"id": "73686", "name": "SANTA ISABEL, Tolima"},
	{"id": "08675", "name": "SANTA LUCIA, Atlantico"},
	{"id": "15690", "name": "SANTA MARIA, Boyaca"},
	{"id": "41676", "name": "SANTA MARIA, Huila"},
	{"id": "47001", "name": "SANTA MARTA, Magdalena"},
	{"id": "13683", "name": "SANTA ROSA, Bolivar"},
	{"id": "19701", "name": "SANTA ROSA, Cauca"},
	{"id": "66682", "name": "SANTA ROSA DE CABAL, Risaralda"},
	{"id": "05686", "name": "SANTA ROSA DE OSOS, Antioquia"},
	{"id": "15693", "name": "SANTA ROSA DE VITERBO, Boyaca"},
	{"id": "13688", "name": "SANTA ROSA DEL SUR, Bolivar"},
	{"id": "99624", "name": "SANTA ROSALIA, Vichada"},
	{"id": "15696", "name": "SANTA SOFIA, Boyaca"},
	{"id": "52699", "name": "SANTACRUZ, Nari~o"},
	{"id": "05042", "name": "SANTAFE DE ANTIOQUIA, Antioquia"},
	{"id": "15686", "name": "SANTANA, Boyaca"},
	{"id": "19698", "name": "SANTANDER DE QUILICHAO, Cauca"},
	{"id": "70820", "name": "SANTIAGO DE TOLU, Sucre"},
	{"id": "54680", "name": "SANTIAGO, Norte de Santander"},
	{"id": "86760", "name": "SANTIAGO, Putumayo"},
	{"id": "05690", "name": "SANTO DOMINGO, Antioquia"},
	{"id": "08685", "name": "SANTO TOMAS, Atlantico"},
	{"id": "66687", "name": "SANTUARIO, Risaralda"},
	{"id": "52720", "name": "SAPUYES, Nari~o"},
	{"id": "81736", "name": "SARAVENA, Arauca"},
	{"id": "54720", "name": "SARDINATA, Norte de Santander"},
	{"id": "25718", "name": "SASAIMA, Cundinamarca"},
	{"id": "15720", "name": "SATIVANORTE, Boyaca"},
	{"id": "15723", "name": "SATIVASUR, Boyaca"},
	{"id": "05736", "name": "SEGOVIA, Antioquia"},
	{"id": "25736", "name": "SESQUILE, Cundinamarca"},
	{"id": "76736", "name": "SEVILLA, Valle del Cauca"},
	{"id": "15740", "name": "SIACHOQUE, Boyaca"},
	{"id": "25740", "name": "SIBATE, Cundinamarca"},
	{"id": "86749", "name": "SIBUNDOY, Putumayo"},
	{"id": "54743", "name": "SILOS, Norte de Santander"},
	{"id": "25743", "name": "SILVANIA, Cundinamarca"},
	{"id": "19743", "name": "SILVIA, Cauca"},
	{"id": "68745", "name": "SIMACOTA, Santander"},
	{"id": "25745", "name": "SIMIJACA, Cundinamarca"},
	{"id": "13744", "name": "SIMITI, Bolivar"},
	{"id": "70001", "name": "SINCELEJO, Sucre"},
	{"id": "27745", "name": "SIPI, Choco"},
	{"id": "47745", "name": "SITIONUEVO, Magdalena"},
	{"id": "25754", "name": "SOACHA, Cundinamarca"},
	{"id": "15753", "name": "SOATA, Boyaca"},
	{"id": "15757", "name": "SOCHA, Boyaca"},
	{"id": "68755", "name": "SOCORRO, Santander"},
	{"id": "15755", "name": "SOCOTA, Boyaca"},
	{"id": "15759", "name": "SOGAMOSO, Boyaca"},
	{"id": "18756", "name": "SOLANO, Caqueta"},
	{"id": "08758", "name": "SOLEDAD, Atlantico"},
	{"id": "18785", "name": "SOLITA, Caqueta"},
	{"id": "15761", "name": "SOMONDOCO, Boyaca"},
	{"id": "05756", "name": "SONSON, Antioquia"},
	{"id": "05761", "name": "SOPETRAN, Antioquia"},
	{"id": "13760", "name": "SOPLAVIENTO, Bolivar"},
	{"id": "25758", "name": "SOPO, Cundinamarca"},
	{"id": "15762", "name": "SORA, Boyaca"},
	{"id": "15764", "name": "SORACA, Boyaca"},
	{"id": "15763", "name": "SOTAQUIRA, Boyaca"},
	{"id": "19760", "name": "SOTARA, Cauca"},
	{"id": "68770", "name": "SUAITA, Santander"},
	{"id": "08770", "name": "SUAN, Atlantico"},
	{"id": "19780", "name": "SUAREZ, Cauca"},
	{"id": "73770", "name": "SUAREZ, Tolima"},
	{"id": "41770", "name": "SUAZA, Huila"},
	{"id": "25769", "name": "SUBACHOQUE, Cundinamarca"},
	{"id": "19785", "name": "SUCRE, Cauca"},
	{"id": "68773", "name": "SUCRE, Santander"},
	{"id": "70771", "name": "SUCRE, Sucre"},
	{"id": "25772", "name": "SUESCA, Cundinamarca"},
	{"id": "25777", "name": "SUPATA, Cundinamarca"},
	{"id": "17777", "name": "SUPIA, Caldas"},
	{"id": "68780", "name": "SURATA, Santander"},
	{"id": "25779", "name": "SUSA, Cundinamarca"},
	{"id": "15774", "name": "SUSACON, Boyaca"},
	{"id": "15776", "name": "SUTAMARCHAN, Boyaca"},
	{"id": "25781", "name": "SUTATAUSA, Cundinamarca"},
	{"id": "15778", "name": "SUTATENZA, Boyaca"},
	{"id": "25785", "name": "TABIO, Cundinamarca"},
	{"id": "27787", "name": "TADO, Choco"},
	{"id": "13780", "name": "TALAIGUA NUEVO, Bolivar"},
	{"id": "20787", "name": "TAMALAMEQUE, Cesar"},
	{"id": "85400", "name": "TAMARA, Casanare"},
	{"id": "81794", "name": "TAME, Arauca"},
	{"id": "05789", "name": "TAMESIS, Antioquia"},
	{"id": "52786", "name": "TAMINANGO, Nari~o"},
	{"id": "52788", "name": "TANGUA, Nari~o"},
	{"id": "97666", "name": "TARAIRA, Vaupes"},
	{"id": "91798", "name": "TARAPACA, Amazonas"},
	{"id": "05790", "name": "TARAZA, Antioquia"},
	{"id": "41791", "name": "TARQUI, Huila"},
	{"id": "05792", "name": "TARSO, Antioquia"},
	{"id": "15790", "name": "TASCO, Boyaca"},
	{"id": "85410", "name": "TAURAMENA, Casanare"},
	{"id": "25793", "name": "TAUSA, Cundinamarca"},
	{"id": "41799", "name": "TELLO, Huila"},
	{"id": "25797", "name": "TENA, Cundinamarca"},
	{"id": "47798", "name": "TENERIFE, Magdalena"},
	{"id": "25799", "name": "TENJO, Cundinamarca"},
	{"id": "15798", "name": "TENZA, Boyaca"},
	{"id": "54800", "name": "TEORAMA, Norte de Santander"},
	{"id": "41801", "name": "TERUEL, Huila"},
	{"id": "41797", "name": "TESALIA, Huila"},
	{"id": "25805", "name": "TIBACUY, Cundinamarca"},
	{"id": "15804", "name": "TIBANA, Boyaca"},
	{"id": "15806", "name": "TIBASOSA, Boyaca"},
	{"id": "25807", "name": "TIBIRITA, Cundinamarca"},
	{"id": "54810", "name": "TIBU, Norte de Santander"},
	{"id": "23807", "name": "TIERRALTA, Cordoba"},
	{"id": "41807", "name": "TIMANA, Huila"},
	{"id": "19807", "name": "TIMBIO, Cauca"},
	{"id": "19809", "name": "TIMBIQUI, Cauca"},
	{"id": "15808", "name": "TINJACA, Boyaca"},
	{"id": "15810", "name": "TIPACOQUE, Boyaca"},
	{"id": "13810", "name": "TIQUISIO, Bolivar"},
	{"id": "05809", "name": "TITIRIBI, Antioquia"},
	{"id": "15814", "name": "TOCA, Boyaca"},
	{"id": "25815", "name": "TOCAIMA, Cundinamarca"},
	{"id": "25817", "name": "TOCANCIPA, Cundinamarca"},
	{"id": "15816", "name": "TOG�I, Boyaca"},
	{"id": "05819", "name": "TOLEDO, Antioquia"},
	{"id": "54820", "name": "TOLEDO, Norte de Santander"},
	{"id": "70823", "name": "TOLU VIEJO, Sucre"},
	{"id": "68820", "name": "TONA, Santander"},
	{"id": "15820", "name": "TOPAGA, Boyaca"},
	{"id": "25823", "name": "TOPAIPI, Cundinamarca"},
	{"id": "19821", "name": "TORIBIO, Cauca"},
	{"id": "76823", "name": "TORO, Valle del Cauca"},
	{"id": "15822", "name": "TOTA, Boyaca"},
	{"id": "19824", "name": "TOTORO, Cauca"},
	{"id": "85430", "name": "TRINIDAD, Casanare"},
	{"id": "76828", "name": "TRUJILLO, Valle del Cauca"},
	{"id": "08832", "name": "TUBARA, Atlantico"},
	{"id": "23815", "name": "TUCHIN, Cordoba"},
	{"id": "76834", "name": "TULUA, Valle del Cauca"},
	{"id": "15001", "name": "TUNJA, Boyaca"},
	{"id": "15832", "name": "TUNUNGUA, Boyaca"},
	{"id": "52838", "name": "TUQUERRES, Nari~o"},
	{"id": "13836", "name": "TURBACO, Bolivar"},
	{"id": "13838", "name": "TURBANA, Bolivar"},
	{"id": "05837", "name": "TURBO, Antioquia"},
	{"id": "15835", "name": "TURMEQUE, Boyaca"},
	{"id": "15837", "name": "TUTA, Boyaca"},
	{"id": "15839", "name": "TUTAZA, Boyaca"},
	{"id": "25839", "name": "UBALA, Cundinamarca"},
	{"id": "25841", "name": "UBAQUE, Cundinamarca"},
	{"id": "76845", "name": "ULLOA, Valle del Cauca"},
	{"id": "15842", "name": "UMBITA, Boyaca"},
	{"id": "25845", "name": "UNE, Cundinamarca"},
	{"id": "27800", "name": "UNGUIA, Choco"},
	{"id": "27810", "name": "UNION PANAMERICANA, Choco"},
	{"id": "05842", "name": "URAMITA, Antioquia"},
	{"id": "50370", "name": "URIBE, Meta"},
	{"id": "44847", "name": "URIBIA, La Guajira"},
	{"id": "05847", "name": "URRAO, Antioquia"},
	{"id": "44855", "name": "URUMITA, La Guajira"},
	{"id": "08849", "name": "USIACURI, Atlantico"},
	{"id": "25851", "name": "UTICA, Cundinamarca"},
	{"id": "05854", "name": "VALDIVIA, Antioquia"},
	{"id": "23855", "name": "VALENCIA, Cordoba"},
	{"id": "68855", "name": "VALLE DE SAN JOSE, Santander"},
	{"id": "73854", "name": "VALLE DE SAN JUAN, Tolima"},
	{"id": "86865", "name": "VALLE DEL GUAMUEZ, Putumayo"},
	{"id": "20001", "name": "VALLEDUPAR, Cesar"},
	{"id": "05856", "name": "VALPARAISO, Antioquia"},
	{"id": "18860", "name": "VALPARAISO, Caqueta"},
	{"id": "05858", "name": "VEGACHI, Antioquia"},
	{"id": "68861", "name": "VELEZ, Santander"},
	{"id": "73861", "name": "VENADILLO, Tolima"},
	{"id": "05861", "name": "VENECIA, Antioquia"},
	{"id": "25506", "name": "VENECIA, Cundinamarca"},
	{"id": "15861", "name": "VENTAQUEMADA, Boyaca"},
	{"id": "25862", "name": "VERGARA, Cundinamarca"},
	{"id": "76863", "name": "VERSALLES, Valle del Cauca"},
	{"id": "68867", "name": "VETAS, Santander"},
	{"id": "25867", "name": "VIANI, Cundinamarca"},
	{"id": "17867", "name": "VICTORIA, Caldas"},
	{"id": "05873", "name": "VIGIA DEL FUERTE, Antioquia"},
	{"id": "76869", "name": "VIJES, Valle del Cauca"},
	{"id": "54871", "name": "VILLA CARO, Norte de Santander"},
	{"id": "15407", "name": "VILLA DE LEYVA, Boyaca"},
	{"id": "25843", "name": "VILLA DE SAN DIEGO DE UBATE, Cundinamarca"},
	{"id": "54874", "name": "VILLA DEL ROSARIO, Norte de Santander"},
	{"id": "19845", "name": "VILLA RICA, Cauca"},
	{"id": "86885", "name": "VILLAGARZON, Putumayo"},
	{"id": "25871", "name": "VILLAGOMEZ, Cundinamarca"},
	{"id": "73870", "name": "VILLAHERMOSA, Tolima"},
	{"id": "17873", "name": "VILLAMARIA, Caldas"},
	{"id": "13873", "name": "VILLANUEVA, Bolivar"},
	{"id": "85440", "name": "VILLANUEVA, Casanare"},
	{"id": "44874", "name": "VILLANUEVA, La Guajira"},
	{"id": "68872", "name": "VILLANUEVA, Santander"},
	{"id": "25873", "name": "VILLAPINZON, Cundinamarca"},
	{"id": "73873", "name": "VILLARRICA, Tolima"},
	{"id": "50001", "name": "VILLAVICENCIO, Meta"},
	{"id": "41872", "name": "VILLAVIEJA, Huila"},
	{"id": "25875", "name": "VILLETA, Cundinamarca"},
	{"id": "25878", "name": "VIOTA, Cundinamarca"},
	{"id": "15879", "name": "VIRACACHA, Boyaca"},
	{"id": "50711", "name": "VISTAHERMOSA, Meta"},
	{"id": "17877", "name": "VITERBO, Caldas"},
	{"id": "25885", "name": "YACOPI, Cundinamarca"},
	{"id": "52885", "name": "YACUANQUER, Nari~o"},
	{"id": "41885", "name": "YAGUARA, Huila"},
	{"id": "05885", "name": "YALI, Antioquia"},
	{"id": "05887", "name": "YARUMAL, Antioquia"},
	{"id": "97889", "name": "YAVARATE, Vaupes"},
	{"id": "05890", "name": "YOLOMBO, Antioquia"},
	{"id": "05893", "name": "YONDO, Antioquia"},
	{"id": "85001", "name": "YOPAL, Casanare"},
	{"id": "76890", "name": "YOTOCO, Valle del Cauca"},
	{"id": "76892", "name": "YUMBO, Valle del Cauca"},
	{"id": "13894", "name": "ZAMBRANO, Bolivar"},
	{"id": "68895", "name": "ZAPATOCA, Santander"},
	{"id": "47960", "name": "ZAPAYAN, Magdalena"},
	{"id": "05895", "name": "ZARAGOZA, Antioquia"},
	{"id": "76895", "name": "ZARZAL, Valle del Cauca"},
	{"id": "15897", "name": "ZETAQUIRA, Boyaca"},
	{"id": "25898", "name": "ZIPACON, Cundinamarca"},
	{"id": "25899", "name": "ZIPAQUIRA, Cundinamarca"},
	{"id": "47980", "name": "ZONA BANANERA, Magdalena"}
];
