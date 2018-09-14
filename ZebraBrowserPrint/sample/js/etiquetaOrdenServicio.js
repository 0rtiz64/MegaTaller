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

var op1 = "\n" +
    "^XA\n" +
    "^MMT\n" +
    "^PW406\n" +
    "^LL0203\n" +
    "^LS0\n" +
    "^FT238,52^A0I,31,31^FH\\^FD";


var op2 ="^FS\n" +
"^FT289,17^A0I,31,31^FH\\^FD";

var op3 ="^FS\n" +
"^FT335,18^A0I,31,31^FH\\^FDSN:^FS\n" +
"^FT368,172^A0I,25,24^FH\\^FDMEGACENTER -TEL: 2566-0426^FS\n" +
"^BY4,3,66^FT335,86^BCI,,N,N\n" +
"^FD>:";

var op4 ="^FS\n" +
"^PQ1,0,1,Y^XZ";

var miZpl = "\n" +
    "^XA\n" +
    "^MMT\n" +
    "^PW406\n" +
    "^LL0203\n" +
    "^LS0\n" +
    "^FT238,52^A0I,31,31^FH\\^FD11^FS\n" +
    "^FT289,17^A0I,31,31^FH\\^FDXXXJ145781416^FS\n" +
    "^FT335,18^A0I,31,31^FH\\^FDSN:^FS\n" +
    "^FT368,172^A0I,25,24^FH\\^FDMEGACENTER -TEL: 2566-0426^FS\n" +
    "^BY4,3,66^FT335,86^BCI,,N,N\n" +
    "^FD>:11^FS\n" +
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





function imprimirEtiquetas() {
   var corr = $('#idCorrelativoHidden').val();

    var url ="../Model/itemDeOrden.php";



    $.ajax({
        type:'POST',
        url:url,
        data:{
            phpCorrelativoOrden: corr
        },
        success: function(response){
            imprimirEtiquetasOrden(response);
            return false;
        }
    });

}



function imprimirEtiquetasOrden(response)
{

    showLoading("Printing...");
    checkPrinterStatus( function (text){
        if (text == "Ready to Print")
        {
            var jsonData = JSON.parse(response);
            var contador =0;
            var contadorB = 0;
            for( var i=0; i< Object.keys(jsonData).length; i++){
                for (var b = 0; b<(Object.keys(jsonData).length); b++){
                    var correlativoItem1 = jsonData[i][0];
                    var serie = jsonData[i][2];
                    var correlativoItem = parseInt(correlativoItem1);
                }
                console.log(correlativoItem);
               selected_printer.send(op1+correlativoItem+op2+serie+op3+correlativoItem+op4);
                //selected_printer.send(miZpl);
            }
printComplete();

        }
        else
        {
            printerError(text);
        }
    });
};

// FIN FUNCION CARNET MODAL






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
    alertify.success("IMPRESION TERMINADA");

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


