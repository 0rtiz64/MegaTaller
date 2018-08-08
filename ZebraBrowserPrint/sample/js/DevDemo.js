$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    })


});

var available_printers = null;
var selected_category = null;
var default_printer = null;
var selected_printer = null;
var format_start = "^XA^LL200^FO80,50^A0N36,36^FD";
var format_end = "^FS^XZ";
var default_mode = true;

var p1 ="^XA\n" +
    "^MMT\n" +
    "^PW670\n" +
    "^LL0386\n" +
    "^LS0\n" +
    "^FO512,224^GFA,03200,03200,00020,:Z64:\n" +
    "eJzt1c9r01AcAPCXvdmUGZoqQzLNDGwMd9BR6SWyYVfwUBgMj2OnjoJeA/MwNlmyhdEdBPHiSZB50b9BGEZy8DLw6kkzCs6DjMouO5Q83492+74kmwXxIvtCQ/jw+t73++17rwhdxEX8g5j7+mP3ULu14Bxtv1175XGbfHB7a+zqZG17uPku/0bY2t7h7uHdqfn8k62plffCarU7W2NXxhfzw/54frNrD+l3r08sfrm2OZF/6Z0uNPjnXOolhFT24gArG5oVEHspzpWmUcDNbRnP7P3QbHzOVY6KwiotY89Z9s2GmrOODGF2OPKzvoz1A5wzGzPCRsIbnXoZW9+VphauCxv1rZmojO1HyvNCeCBM92+adFzpMX7d9ENhKjY1Oh+1kU/+Rs8MzWn5dqN5L/S7+Q3g4mDlI7H241ILnxid03P1qOMsDaBZURzOaELujOa4pDP44tfluYVZyS4Vd4aqs7KNFndWq9NBYlx1qJqXx5nt6up8WR6XtW6WmRlmRRl2nLIYrWeY7qUNR2lDxxk2k2F6hqle2nCQNiVKG9yVwgjdYimLkZky4kHDwtoFYKqwjgosp3CLMUi6oNKeEkIUYJolbAMUYrLe64QEwAz2WKYGiuP5PyUkqp9aiaftkggUzF/dD5Lxr7jfSFRKGp0PNCbqmXG+BT0zzzXlxLRT89izQmv7C/P6NJQ0i/7o/VmnTztOmU7a0IKzLQIm+qeSACV7qhIPWiSsu0mA4ViyOl+pI218p/dM2grqbiYR7BUTJB0ku5uKmFgEW86iKYsERJjcom7yIliZFWoKsAK3NoLng50plxo8R+zdpW2G561n8OJgczODZ5XlxUw6545YQ7oPbGHSvWGK/CJoBV4HLIPfXrRemDK/qXQSyPcavalo/+5LRhuvxLz7INgQpS2bHoiPtAj9cWOUCBJYqX8Bi5AgaYgkr/uL+C/iN80ldBE=:A29B\n" +
    "^FO32,224^GFA,03200,03200,00020,:Z64:\n" +
    "eJzt1k9v3EQUAPA3nsruYbG3QoIRsnaXb+CjhaLdCPggToPK1aEXRwr1bBM1PaCGI4cq/RjcYLaF7AWlfIRJcujVKAeM6uzwxuOs/+0BBBxAjHKwf3lvZ9547BmA/1ajed/Gqm8zxXumlOwSUSrrdaFUrxN60zfn5reiZ8UvPfOKbNq3n9y+Pd9g6rxr7lv1rBf3UJ3Wd6kqG1XfmwtRm1JpbZHJVauVyWtYelN0zXnxtm+/vsm7RvNxz+p5rq1+Hg1Ly4G1bXb7fBvmrfq2bn/GdhfXb5aL0wPmnR6M8uusjJNX5AkdMt8OWBgIWVp8RY4cNCtgQcCNBZfkyJ2w96wJi28tlB/ygcXetyyMGxrz0XyLvfu4YR5aSNm9lxZjATPG5IwHNB++pDnNxlUfGBdbbHhpscFtboQm0b7QuWsjc8HZ8CPAMUNlF2TO0T7Qtl3VcTE/nD9lzL2LuZWFF4sl/cpn3sD3w0j+1Tn9w2beZrOqSGFsNIJZTo+v9Pp1FDfjc4AKh8jE44nrCFMH5VS4IEOHJ4yYMWdUGKMiGRrbkURqi0JMDyDrWJZMIC5NQGmTELIEING2KwB/0QMIIekYR9vqmKwsrM0p0PTrsFUbUWhh0jJIuem3kQtjocfc6gOnoazNmBnzHSLbdknFp8ZYVZskaGfQNFwur7QJY9XaoId0sSRoMvGrOQ0devhqOed6LCMqqmeEH8kfl1TxVI1PzHNzcrQfHqF56l7xj6yXzxWfzfMvi+kLleYzmmt74JBjiFn8yXM/kgvzrj6wLRviYbT4Bk2Icsyf2bYNwTDiXzNc9FFlA207/GcfJyA2tT1BCyc74mM9KUFlvg1jGUnLhwtZ2Rka245yinFQ2QptsB1NaVHbmTGvGaf7cHlEH/tts3k05xjHjd23XWNPtUWVYR0ORAttVR27Nj0GijbQdZg52FVccYsU33qK5tdmrv7u57HeU1S9pwAM6iDr9mKjnT98PZoOvNH++f22eSfTrj3abN/tn192c7s2Rjtt2DtV3GizNfrY32B7r6ddu7Nn4vaO1rV5gpyUFsN6T8ePGbhT71lj88KzC17etfQ/RT1FamXiZU0Qp4XeRrNGGH5GVIFEecN8vdfmuEIazcZM/Aa1ThdVUtg0Yn48bpq5o6JlW2WNvGXl7UGLgOCmT7sHrJTrv3ZzlOqdmzae6/5v/672O66RQME=:8A14\n" +
    "^FT486,315^A0I,39,40^FH\\^FD";

var p2 ="^FS\n" +
"^FT638,194^A0I,34,31^FH\\^FD";

var p3="^FS\n" +
"^FT436,47^A0I,34,33^FH\\^FD";

var p4 ="^FS\n" +
"^FT139,43^A0I,30,30^FH\\^FD";

var p5 ="^FS\n" +
"^BY3,3,78^FT496,86^B3I,N,,N,N\n" +
"^FD";

var p6 ="^FS\n" +
"^PQ2,0,1,Y^XZ";


var miZpl = "^XA\n" +
    "^MMT\n" +
    "^PW670\n" +
    "^LL0386\n" +
    "^LS0\n" +
    "^FO512,224^GFA,03200,03200,00020,:Z64:\n" +
    "eJzt1c9r01AcAPCXvdmUGZoqQzLNDGwMd9BR6SWyYVfwUBgMj2OnjoJeA/MwNlmyhdEdBPHiSZB50b9BGEZy8DLw6kkzCs6DjMouO5Q83492+74kmwXxIvtCQ/jw+t73++17rwhdxEX8g5j7+mP3ULu14Bxtv1175XGbfHB7a+zqZG17uPku/0bY2t7h7uHdqfn8k62plffCarU7W2NXxhfzw/54frNrD+l3r08sfrm2OZF/6Z0uNPjnXOolhFT24gArG5oVEHspzpWmUcDNbRnP7P3QbHzOVY6KwiotY89Z9s2GmrOODGF2OPKzvoz1A5wzGzPCRsIbnXoZW9+VphauCxv1rZmojO1HyvNCeCBM92+adFzpMX7d9ENhKjY1Oh+1kU/+Rs8MzWn5dqN5L/S7+Q3g4mDlI7H241ILnxid03P1qOMsDaBZURzOaELujOa4pDP44tfluYVZyS4Vd4aqs7KNFndWq9NBYlx1qJqXx5nt6up8WR6XtW6WmRlmRRl2nLIYrWeY7qUNR2lDxxk2k2F6hqle2nCQNiVKG9yVwgjdYimLkZky4kHDwtoFYKqwjgosp3CLMUi6oNKeEkIUYJolbAMUYrLe64QEwAz2WKYGiuP5PyUkqp9aiaftkggUzF/dD5Lxr7jfSFRKGp0PNCbqmXG+BT0zzzXlxLRT89izQmv7C/P6NJQ0i/7o/VmnTztOmU7a0IKzLQIm+qeSACV7qhIPWiSsu0mA4ViyOl+pI218p/dM2grqbiYR7BUTJB0ku5uKmFgEW86iKYsERJjcom7yIliZFWoKsAK3NoLng50plxo8R+zdpW2G561n8OJgczODZ5XlxUw6545YQ7oPbGHSvWGK/CJoBV4HLIPfXrRemDK/qXQSyPcavalo/+5LRhuvxLz7INgQpS2bHoiPtAj9cWOUCBJYqX8Bi5AgaYgkr/uL+C/iN80ldBE=:A29B\n" +
    "^FO32,224^GFA,03200,03200,00020,:Z64:\n" +
    "eJzt1k9v3EQUAPA3nsruYbG3QoIRsnaXb+CjhaLdCPggToPK1aEXRwr1bBM1PaCGI4cq/RjcYLaF7AWlfIRJcujVKAeM6uzwxuOs/+0BBBxAjHKwf3lvZ9547BmA/1ajed/Gqm8zxXumlOwSUSrrdaFUrxN60zfn5reiZ8UvPfOKbNq3n9y+Pd9g6rxr7lv1rBf3UJ3Wd6kqG1XfmwtRm1JpbZHJVauVyWtYelN0zXnxtm+/vsm7RvNxz+p5rq1+Hg1Ly4G1bXb7fBvmrfq2bn/GdhfXb5aL0wPmnR6M8uusjJNX5AkdMt8OWBgIWVp8RY4cNCtgQcCNBZfkyJ2w96wJi28tlB/ygcXetyyMGxrz0XyLvfu4YR5aSNm9lxZjATPG5IwHNB++pDnNxlUfGBdbbHhpscFtboQm0b7QuWsjc8HZ8CPAMUNlF2TO0T7Qtl3VcTE/nD9lzL2LuZWFF4sl/cpn3sD3w0j+1Tn9w2beZrOqSGFsNIJZTo+v9Pp1FDfjc4AKh8jE44nrCFMH5VS4IEOHJ4yYMWdUGKMiGRrbkURqi0JMDyDrWJZMIC5NQGmTELIEING2KwB/0QMIIekYR9vqmKwsrM0p0PTrsFUbUWhh0jJIuem3kQtjocfc6gOnoazNmBnzHSLbdknFp8ZYVZskaGfQNFwur7QJY9XaoId0sSRoMvGrOQ0devhqOed6LCMqqmeEH8kfl1TxVI1PzHNzcrQfHqF56l7xj6yXzxWfzfMvi+kLleYzmmt74JBjiFn8yXM/kgvzrj6wLRviYbT4Bk2Icsyf2bYNwTDiXzNc9FFlA207/GcfJyA2tT1BCyc74mM9KUFlvg1jGUnLhwtZ2Rka245yinFQ2QptsB1NaVHbmTGvGaf7cHlEH/tts3k05xjHjd23XWNPtUWVYR0ORAttVR27Nj0GijbQdZg52FVccYsU33qK5tdmrv7u57HeU1S9pwAM6iDr9mKjnT98PZoOvNH++f22eSfTrj3abN/tn192c7s2Rjtt2DtV3GizNfrY32B7r6ddu7Nn4vaO1rV5gpyUFsN6T8ePGbhT71lj88KzC17etfQ/RT1FamXiZU0Qp4XeRrNGGH5GVIFEecN8vdfmuEIazcZM/Aa1ThdVUtg0Yn48bpq5o6JlW2WNvGXl7UGLgOCmT7sHrJTrv3ZzlOqdmzae6/5v/672O66RQME=:8A14\n" +
    "^FT486,315^A0I,39,40^FH\\^FDPROMOCION #32^FS\n" +
    "^FT638,194^A0I,34,31^FH\\^FDALEJANDRO AUGUSTO GABARRETE AKTINSON^FS\n" +
    "^FT436,47^A0I,34,33^FH\\^FD1611198800059^FS\n" +
    "^FT139,43^A0I,45,45^FH\\^FD0001^FS\n" +
    "^BY3,3,78^FT496,86^B3I,N,,N,N\n" +
    "^FD0001^FS\n" +
    "^PQ1,0,1,Y^XZ";


function setup_web_print()
{
	$('#printer_select').on('change', onPrinterSelected);
	showLoading("Loading Printer Information...");
	default_mode = true;
	selected_printer = null;
	available_printers = null;
	selected_category = null;
	default_printer = null;
	
	BrowserPrint.getDefaultDevice('printer', function(printer)
	{
		default_printer = printer
		if((printer != null) && (printer.connection != undefined))
		{
			selected_printer = printer;
			var printer_details = $('#printer_details');
			var selected_printer_div = $('#selected_printer');
			
			selected_printer_div.text("Using Default Printer: " + printer.name);
			hideLoading();
			printer_details.show();
			$('#print_form').show();

		}
		BrowserPrint.getLocalDevices(function(printers)
			{
				available_printers = printers;
				var sel = document.getElementById("printers");
				var printers_available = false;
				sel.innerHTML = "";
				if (printers != undefined)
				{
					for(var i = 0; i < printers.length; i++)
					{
						if (printers[i].connection == 'usb')
						{
							var opt = document.createElement("option");
							opt.innerHTML = printers[i].connection + ": " + printers[i].uid;
							opt.value = printers[i].uid;
							sel.appendChild(opt);
							printers_available = true;
						}
					}
				}
				
				if(!printers_available)
				{
					showErrorMessage("No Zebra Printers could be found!");
					hideLoading();
					$('#print_form').hide();
					return;
				}
				else if(selected_printer == null)
				{
					default_mode = false;
					changePrinter();
					$('#print_form').show();
					hideLoading();
				}
			}, undefined, 'printer');
	}, 
	function(error_response)
	{
		showBrowserPrintNotFound();
	});
};
function showBrowserPrintNotFound()
{
	showErrorMessage("An error occured while attempting to connect to your Zebra Printer. You may not have Zebra Browser Print installed, or it may not be running. Install Zebra Browser Print, or start the Zebra Browser Print Service, and try again.");

};

function  consultarIdParaCarnet() {
    var identidad = $('#identidadRegistrar').val();
    var url = 'php/buscarUltIdParaCarnet.php';
    $.ajax({
        type:'POST',
        url:url,
        data:{

            phpIdentidad:identidad

        },
        success: function(idIntegrante){

            consultarCorrelativoParaCarnet(idIntegrante);



            return false;


        }
    });
    return false;
}

function consultarCorrelativoParaCarnet(idIntegrante) {
    var identidad = $('#identidadRegistrar').val();
    var url = 'php/buscarUltCorrelativoParaCarnet.php';
    $.ajax({
        type:'POST',
        url:url,
        data:{

            phpIdentidad:identidad

        },
        success: function(correlativo){

            sendData(idIntegrante,correlativo);



            return false;


        }
    });
    return false;
}


//INICIO FUNCION CARNET MODAL
function  consultarIdParaCarnetModal() {
    var identidad = $('#identidadRegistrarModal').val();
    var url = 'php/buscarUltIdParaCarnet.php';
    $.ajax({
        type:'POST',
        url:url,
        data:{

            phpIdentidad:identidad

        },
        success: function(idIntegrante){

            consultarCorrelativoParaCarnetModal(idIntegrante);



            return false;


        }
    });
    return false;
}


function consultarCorrelativoParaCarnetModal(idIntegrante) {
    var identidad = $('#identidadRegistrarModal').val();
    var url = 'php/buscarUltCorrelativoParaCarnet.php';
    $.ajax({
        type:'POST',
        url:url,
        data:{

            phpIdentidad:identidad

        },
        success: function(correlativo){

            sendDataModal(idIntegrante,correlativo);



            return false;


        }
    });
    return false;
}


function sendDataModal(idIntegrante,correlativo)
{

    showLoading("Printing...");
    checkPrinterStatus( function (text){
        if (text == "Ready to Print")
        {
            var nombre1 =$('#NombreRegistroModal').val();
            var id =$('#identidadRegistrarModal').val();
            //var corr =$('#numeroExpedienteRegistrar').val();
            var nombre = nombre1.toUpperCase();
            var promocion = $('#promoAc').val();
            var promocion1 =promocion.toUpperCase()
            //var corrVisible = $('#correlativo').val();

            var contraPleca = String.fromCharCode(92);

            var nombreNuevo = nombre.replace("Ñ",contraPleca+"A5");

            selected_printer.send(p1+promocion1+p2+nombreNuevo+p3+id+p4+correlativo+p5+idIntegrante+p6, printComplete, printerError);
            //$('#formularioRegistro')[0].reset();
        }
        else
        {
            printerError(text);
        }
    });
};

// FIN FUNCION CARNET MODAL




function sendData(idIntegrante,correlativo)
{


	showLoading("Printing...");
	checkPrinterStatus( function (text){
		if (text == "Ready to Print")
		{
			var nombre1 =$('#NombreRegistro').val();
			var id =$('#identidadRegistrar').val();
			//var corr =$('#numeroExpedienteRegistrar').val();
			var nombre = nombre1.toUpperCase();
			var promocion = $('#promoAc').val();
			var promocion1 =promocion.toUpperCase();
			//var corrVisible = $('#correlativo').val();

            var contraPleca = String.fromCharCode(92);

            var nombreNuevo = nombre.replace("Ñ",contraPleca+"A5");

			selected_printer.send(p1+promocion1+p2+nombreNuevo+p3+id+p4+correlativo+p5+idIntegrante+p6, printComplete, printerError);
            //$('#formularioRegistro')[0].reset();
		}
		else
		{
			printerError(text);
		}
	});
};

function checkPrinterStatus(finishedFunction)
{
	selected_printer.sendThenRead("~HQES", 
				function(text){
						var that = this;
						var statuses = new Array();
						var ok = false;
						var is_error = text.charAt(70);
						var media = text.charAt(88);
						var head = text.charAt(87);
						var pause = text.charAt(84);
						// check each flag that prevents printing
						if (is_error == '0')
						{
							ok = true;
							statuses.push("Ready to Print");
						}
						if (media == '1')
							statuses.push("Paper out");
						if (media == '2')
							statuses.push("Ribbon Out");
						if (media == '4')
							statuses.push("Media Door Open");
						if (media == '8')
							statuses.push("Cutter Fault");
						if (head == '1')
							statuses.push("Printhead Overheating");
						if (head == '2')
							statuses.push("Motor Overheating");
						if (head == '4')
							statuses.push("Printhead Fault");
						if (head == '8')
							statuses.push("Incorrect Printhead");
						if (pause == '1')
							statuses.push("Printer Paused");
						if ((!ok) && (statuses.Count == 0))
							statuses.push("Error: Unknown Error");
						finishedFunction(statuses.join());
			}, printerError);
};
function hidePrintForm()
{
	$('#print_form').hide();
};
function showPrintForm()
{
	$('#print_form').show();
};
function showLoading(text)
{
	$('#loading_message').text(text);
	$('#printer_data_loading').show();
	hidePrintForm();
	$('#printer_details').hide();
	$('#printer_select').hide();
};
function printComplete()
{
	hideLoading();
	alert ("Printing complete");
	
}
function hideLoading()
{
	$('#printer_data_loading').hide();
	if(default_mode == true)
	{
		showPrintForm();
		$('#printer_details').show();
	}
	else
	{
		$('#printer_select').show();
		showPrintForm();
	}
};
function changePrinter()
{
	default_mode = false;
	selected_printer = null;
	$('#printer_details').hide();
	if(available_printers == null)
	{
		showLoading("Finding Printers...");
		$('#print_form').hide();
		setTimeout(changePrinter, 200);
		return;
	}
	$('#printer_select').show();
	onPrinterSelected();
	
}
function onPrinterSelected()
{
	selected_printer = available_printers[$('#printers')[0].selectedIndex];
}
function showErrorMessage(text)
{
	$('#main').hide();
	$('#error_div').show();
	$('#error_message').html(text);
}
function printerError(text)
{
	showErrorMessage("An error occurred while printing. Please try again." + text);
}
function trySetupAgain()
{
	$('#main').show();
	$('#error_div').hide();
	setup_web_print();
	//hideLoading();
}


