var app = (function(){

    function showLoader(){
        hideError();
        $.blockUI({
            "message":"<i class='fa fa-circle-o-notch fa-spin'></i>",
            css: {
                padding:	5,
                margin:		0,
                top:		'48%',
                width:		'60px',
                left:		'48%',
                border:     "none",
                textAlign:	'center',
                color:		'rgb(128, 128, 128)',
                backgroundColor:'#fff',
                cursor:		'wait'
            }
        });
        $(".blockUI").css("z-index",9999);
    }

    function hideLoader(){
        $.unblockUI();
    }

    function serializeObject(form){
        var o = {};
        var a = $(form).serializeArray();
        $.each(a, function() {
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    }

    function setCookie(c_name, value, exdays) {
        var exdate = new Date();
        exdate.setDate(exdate.getDate() + exdays);
        var c_value = escape(value) + ((exdays === null) ? "" : "; expires=" + exdate.toUTCString() + "path=/");
        document.cookie = c_name + "=" + c_value;
    }

    function showError(title,msg){
        var t = _.template($('#errorTemplate').html());
        $("#pageErrors").append(t({
            title: title,
            msg: msg
        }));
        $('html, body').animate({ scrollTop: $("#pageErrors").offset().top-20 }, 500);
    }

    function hideError(){
        $("#pageErrors").children().remove();
    }

    function callRoute(url,callback){
        showLoader();
        url+=window.location.search;
        $.ajax({
            url: base_url+url,
            headers: {
                "HTTP_X_REQUESTED_WITH":"XMLHttpRequest"
            },
            success: function(data){
                hideLoader();
                if(callback){
                    callback(data);
                }
                else{
                    updateContent(data);
                }
            }
        });
    }

    function updateContent(data){
        $("#contentContainer").html(data);
    }

    function isEmpty(){
        return $("#contentContainer").children().length == 0;
    }

    function remove(url,callback){
        app.confirmDialog("Do you want to remove it?",function(status){
            if(status){
                app.showLoader();
                $.get(url,function(data){
                    app.hideLoader();
                    if(data["status"]){
                        app.reload();
                        if(callback){
                            callback();
                        }
                    }
                    else{
                        app.customDialog("Remove Request",data["msg"]);
                    }
                });
            }
        });
    }

    function confirmDialog(msg,callback){
        bootbox.confirm(msg,callback);
    }

    function customDialog(title,msg,buttons,escapeCallback,large){
        if(!buttons)
            buttons = {
                success: {
                    label: "OK",
                    className: "btn-success"
                }
            };
        if(typeof msg == "object"){
            var t = "";
            for(var x in msg){
                t+="- "+msg[x]+"<br/>";
            }
            msg = t;
        }
        bootbox.dialog({
            title: title,
            message: msg,
            buttons: buttons,
            onEscape: escapeCallback
        });
        if(large){
            $(".bootbox").find(".modal-dialog").addClass("modal-lg");
        }
    }

    $.validator.addMethod('filesize', function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param*1000)
    });

    $.validator.addMethod('inputmask', function(value, element, param) {
        return $(element).val().trim()=="" || $(element).inputmask("isComplete");
    });

    $.validator.addMethod('mindate', function(value, element, param) {
        if(typeof param == "object") param = $(param).val();
        return value.trim().length == 0 || (new Date(value)>new Date(param));
    });

    $.validator.addMethod('maxValue', function(value, element, param) {
        if(typeof param == "object")
            param = $(param).val();
        else if(typeof param == "function")
            param = param();
        return (parseFloat(value)<=parseFloat(param));
    });

    function redirect(url){
        app.routes.navigate(url,{trigger: true});
    }

    $(document).ajaxError(function(a,b) {
        if(!(b["statusText"]=="abort")){
            hideLoader();
            if([404,500,403,401].indexOf(b["status"])>-1){
                updateContent(b["responseText"]);
            }
            else{
                customDialog("Error","Unable to process request, please try later!!!");
            }
        }
    });

    $.ajaxSetup({ cache: false });

    function reload(){
        Backbone.history.loadUrl(Backbone.history.fragment);
    }

    function updateHeader(title,subtitle,links){
        subtitle = subtitle || "";
        links = links || [];
        $("title").html(title+" | Dashboard");
        $("#navigationHeader").find("span").html(title);
        $("#navigationHeader").find("small").html(subtitle);
        var t = _.template($('#breadcrumbTemplate').html());
        $("#breadcrumb").html(t({
            items: links
        }));
    }

    var root = base_url.replace(window.location.origin,"");
    if(root.indexOf("index.php")==-1){
        root+="index.php";
    }
    else{
        if(root.charAt(root.length-1)=="/"){
            root = root.substring(0,root.length-1);
        }
    }

    function validateEmail(email) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(email);
    }

    function print(title,element){
        if(typeof element == "string"){
            element = document.getElementById(element);
        }
        else if(element.length){
            element = element.eq(0);
        }
        var printWin = window.open('','_blank');
        printWin.document.open();
        printWin.document.write("Please wait...");
        printWin.document.close();
        $(element).find(".btn,input,.hidePrint").hide();
        html2canvas(element,{
            onrendered: function(canvas){
                $(element).find(".btn,input,.hidePrint").show();
                var dataUrl = canvas.toDataURL();
                var windowContent = "<!DOCTYPE html>";
                windowContent += "<html>";
                windowContent += "<head><title>"+title+"</title></head>";
                windowContent += '<body>';
                windowContent += "<img style='max-width: 100%;' src='" + dataUrl + "'>";
                windowContent += "</body>";
                windowContent += "</html>";
                printWin.document.open();
                printWin.document.write(windowContent);
                printWin.document.close();
                printWin.focus();
                printWin.print();
                printWin.close();
            }
        });
    }

    var NoUrlModel = Backbone.Model.extend({});
    NoUrlModel.prototype.sync = function() { return null; };
    NoUrlModel.prototype.fetch = function() { return null; };
    NoUrlModel.prototype.save = function() { return null; };

    return {
        showLoader: showLoader,
        hideLoader: hideLoader,
        serializeObject: serializeObject,
        setCookie: setCookie,
        callRoute: callRoute,
        updateContent: updateContent,
        showError: showError,
        hideError: hideError,
        isEmpty: isEmpty,
        redirect: redirect,
        reload: reload,
        remove: remove,
        validateEmail: validateEmail,
        updateHeader: updateHeader,
        confirmDialog: confirmDialog,
        customDialog: customDialog,
        root: root,
        NoUrlModel: NoUrlModel,
        print: print
    }
})();

