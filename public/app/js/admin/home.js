

function post(path, params, method) {
    method = method || "post"; // Set method to post by default if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
         }
    }

    document.body.appendChild(form);
    form.submit();
}


$(document).ready(function () {
    if ($("#start")!=undefined){
        var newYear = new Date($("#start1").data("time"));
        $('#start1').countdown({until: newYear});
    }
    if ($("#start2")!=undefined){
        var newYear = new Date($("#start2").data("time"));
        $('#start2').countdown({until: newYear});
    }
    if ($("#start3")!=undefined){
        var newYear = new Date($("#start3").data("time"));
        $('#start3').countdown({until: newYear});
    }
    if ($("#start4")!=undefined){
        var newYear = new Date($("#start4").data("time"));
        $('#start4').countdown({until: newYear});
    }
        
    $("[name='match']").bootstrapSwitch();
    $("[name='registration']").bootstrapSwitch();
    
    $("[name='registration']").bootstrapSwitch();
    
    $('input[name="match"]').on('switchChange.bootstrapSwitch', function(event, state) {
        post("/admin/game/op",{st:state})
    });
    
    $('input[name="registration"]').on('switchChange.bootstrapSwitch', function(event, state) {
        post("/admin/game/regop",{st:state})
    });
    
    
    $("#start").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
    $("#end").datetimepicker({format: 'yyyy-mm-dd hh:ii',pickerPosition:'top-left'});
    $('.color').colorpicker();
    $('.colorreg').colorpicker();
    
    
}
);