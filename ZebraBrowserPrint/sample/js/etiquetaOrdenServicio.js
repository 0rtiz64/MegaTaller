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

var op1 = " \"\\n\" +\n" +
    "    \"^XA\\n\" +\n" +
    "    \"^MMT\\n\" +\n" +
    "    \"^PW406\\n\" +\n" +
    "    \"^LL0203\\n\" +\n" +
    "    \"^LS0\\n\" +\n" +
    "    \"^FO64,128^GFA,03072,03072,00032,:Z64:\\n\" +\n" +
    "    \"eJzt1LFu1EAQANBZrcSmOMVINCmiOJ+Q8gp0ayoaJH4AxPEHR+fC0jq6ggYJSgokzB9EoqEIsi2E7hcokFgrP7ARBY6YeDL2JpcgxXZPbq456Wl2Z8a7C7CJTQxHNPC7AzHUftSfFuSUDS0bELkhD8e9HnJ95VKs0PymHfEN9mCmnCS3EBYMEXo/fNuYE/Yl+8MA2et/vPz+83n16xnnv4BEk/JORE3UujhMt2FfTuQSApjqfJkffREZ5JQ34L2YwIJdgnoXJ2EK7f4CNWpY58/lduvkYlWAqx9ZibrWaecl58+VomuPX7aO3qHq8lUjgUuPpeX8U59fdG66/dU99tKaZUXu1alVbf6lv244nwsAWXk/O7MBzmJtW46qFUbzx/KJjMRJ0fnfc/sUk8S46Lp/+UYCfE5BfsqP8q9ZiNMd7W70Lz6w/ylAcv3mo9U43dW1n39Xv3jPTmnn1PrB1pV3/Ysf7CbdavunwBo8mGi8MT+oW4c9HoprAs7fB58vynKX9wf34D67Jh5SomyIIvUO1PXPqyLMQDfsKNll6usHs0LeP1oQRrMo7M6H5PmoQt92QP03geBYZTrrP54Kucai3yUGbtjDy/Nxewg+nzTm/Qyw9p6bz/ejGbr/JqfjofXX96sn9Mj9Hrv/Y+/H2PvDbv2/zft/twewif83LgDmxDbJ:DC7D\\n\" +\n" +
    "    \"^BY4,3,53^FT358,22^BCI,,N,N\\n\" +\n" +
    "    \"^FD>:";

var op2 ="^FS\\n\" +\n" +
    "    \"^FT361,106^A0I,28,28^FH\\\\^FD";

var op3="^FS\n" +
"^PQ1,0,1,Y^XZ";


var miZpl = "\n" +
    "^XA\n" +
    "^MMT\n" +
    "^PW406\n" +
    "^LL0203\n" +
    "^LS0\n" +
    "^FO64,128^GFA,03072,03072,00032,:Z64:\n" +
    "eJzt1LFu1EAQANBZrcSmOMVINCmiOJ+Q8gp0ayoaJH4AxPEHR+fC0jq6ggYJSgokzB9EoqEIsi2E7hcokFgrP7ARBY6YeDL2JpcgxXZPbq456Wl2Z8a7C7CJTQxHNPC7AzHUftSfFuSUDS0bELkhD8e9HnJ95VKs0PymHfEN9mCmnCS3EBYMEXo/fNuYE/Yl+8MA2et/vPz+83n16xnnv4BEk/JORE3UujhMt2FfTuQSApjqfJkffREZ5JQ34L2YwIJdgnoXJ2EK7f4CNWpY58/lduvkYlWAqx9ZibrWaecl58+VomuPX7aO3qHq8lUjgUuPpeX8U59fdG66/dU99tKaZUXu1alVbf6lv244nwsAWXk/O7MBzmJtW46qFUbzx/KJjMRJ0fnfc/sUk8S46Lp/+UYCfE5BfsqP8q9ZiNMd7W70Lz6w/ylAcv3mo9U43dW1n39Xv3jPTmnn1PrB1pV3/Ysf7CbdavunwBo8mGi8MT+oW4c9HoprAs7fB58vynKX9wf34D67Jh5SomyIIvUO1PXPqyLMQDfsKNll6usHs0LeP1oQRrMo7M6H5PmoQt92QP03geBYZTrrP54Kucai3yUGbtjDy/Nxewg+nzTm/Qyw9p6bz/ejGbr/JqfjofXX96sn9Mj9Hrv/Y+/H2PvDbv2/zft/twewif83LgDmxDbJ:DC7D\n" +
    "^BY4,3,53^FT358,22^BCI,,N,N\n" +
    "^FD>:100^FS\n" +
    "^FT361,106^A0I,28,28^FH\\^FDXXXJ145781416^FS\n" +
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
    var serie ="";
    var url ="../Model/trabajarArray.php";

    $("input[name='serieA[]']").each(function () {
        serie=serie+","+$(this).val();
    });

    $.ajax({
        type:'POST',
        url:url,
        data:{
            phpSerie: serie
        },
        success: function(series){
                for (var i = 0; i<series.length; i++){
                    console.log(series[i]);
                   imprimirEtiquetasOrden(series[i]);
                }
            return false;
        }
    });

}



function imprimirEtiquetasOrden()
{

    showLoading("Printing...");
    checkPrinterStatus( function (text){
        if (text == "Ready to Print")
        {

            selected_printer.send(miZpl, printComplete, printerError);

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


