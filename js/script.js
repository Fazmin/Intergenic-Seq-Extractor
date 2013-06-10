function draw(names, type) {
    console.log("drawing");
    // Get Canvas and Create Chart
    $("#canvass").width(($(window).width() / 2) - 20);
    var canvas = document.getElementById("canvass");
    // Create Chart
    var bl = ($(window).width() / 2) - 8;
    console.log(bl + ' --- ' + $(window).width());
    chart = new Scribl(canvas, bl);
    chart.laneSizes = 15;
    $.post("getfile.php", {
        "get": 1,
        "name": names,
        "type": type
    }).done(function(data) {
        // parse and load genbank file
        console.log(names + " -------------- " + data);
        chart.loadGenbank(data);
        // Draw Chart
        // chart.scrollable = true;
        chart.scale.pretty = true;
        chart.draw();
    });
}

function extract(id) {
    console.log('Click Made!');
    if ($("#fileu").text() != "") {
        $('.headbigA').empty();
        $("#loader").show();
        var up = $("#fileu").text();
        var upn = up.replace(".gb", "");
        var len = $("#acclen").val();
        var lenm = $("#acclenm").val();
        var type = $("#types").text();
        $.post("getfile.php", {
            "up": up,
            "type": type,
            "len": len,
            "lenm": lenm
        }).done(function(data) {
            console.log("The file is out ! " + up + " --- " + len + " --- " + type + ' ---> ' + data);
            $("#loader").hide();
            $("#donezone").empty().hide(400);
            $("#donezone2").html('<br/><br/><span class="donet">Done. Click cloud below to open results</span><br/><br/><br/><a target="_new" href="' + upn + '_ign_' + type + '.fasta"><img src="img/download.png" id="downloadicon"></a><br/><br/>OR<br/><button class="btn btn-danger btn-large" value="Reload Page" onClick="window.location.reload()">Do Another</button><br/><br/><button class="btn btn-primary" type="button" id="splitt">SHOW ME</button>').show(400);
            //$("#seq").html('<iframe src="'+upn+'_ign_'+type+'.fasta"  frameborder="0" width="100%" height="100%"></iframe>');
            //draw(upn);
            triggertog();
        });
    } else {
        $('.headbigA').empty();
        $("#loader").show();
        var id = $("#acc").val();
        var type = $("#types").text();
        var lenm = $("#acclenm").val();
        var len = $("#acclen").val();
        $.post("getfile.php", {
            "id": id,
            "type": type,
            "len": len,
            "lenm": lenm
        }).done(function(data) {
            console.log("The file is out ! " + id + " --- " + len + " --- " + type + ' ---> ' + data);
            $("#loader").hide();
            $("#donezone").empty().hide(400);
            $("#donezone2").html('<br/><br/><span class="donet">Done. Click cloud below to open results</span><br/><br/><br/><a target="_new" href="' + id + '-' + type + '_ign_' + type + '.fasta"><img src="img/download.png" id="downloadicon"></a><br/><br/>OR<br/><button class="btn btn-danger btn-large" value="Reload Page" onClick="window.location.reload()">Do Another</button><br/><br/><button class="btn btn-primary" type="button" id="splitt">SHOW ME (Might take a while to load)</button>').show(400);
            //$("#seq").html('<iframe src="'+id+'-'+type+'_ign_'+type+'.fasta" frameborder="0" width="100%" height="100%"></iframe>');
            draw(id, type);
            triggertog();
        });
    }
}(function($) {
    $.fn.clickToggle = function(func1, func2) {
        var funcs = [func1, func2];
        this.data('toggleclicked', 0);
        this.click(function() {
            var data = $(this).data();
            var tc = data.toggleclicked;
            $.proxy(funcs[tc], this)();
            data.toggleclicked = (tc + 1) % 2;
        });
        return this;
    };
}(jQuery));

function triggertog() {
    $('#splitt').clickToggle(

    function() {
        $(".mainhold").stop(true).animate({
            'right': "70%"
        }, 200);
        $('#tool').stop(true).animate({
            'width': "50%"
        }, 200);
        $('#seq').stop(true).animate({
            'width': "50%"
        }, 200);
    }, function() {
        $('#seq').stop(true).animate({
            'width': "0%"
        }, 300);
        $('#tool').stop(true).animate({
            'width': "100%"
        }, 200);
        $(".mainhold").stop(true).animate({
            'right': "50%"
        }, 200);
    });
}
$('#typess').on('switch-change', function(e, data) {
    var $el = $(data.el),
        value = data.value;
    console.log(e, $el, value);
    if ($("#types").text() == 'CDS') {
        $("#types").text('gene');
        console.log($("#types").text());
    } else {
        $("#types").text('CDS');
        console.log($("#types").text());
    }
});
Dropzone.options.yodropzone = {
    //paramName: "file", // The name that will be used to transfer the file
    maxFilesize: 40,
    // MB
    accept: function(file, done) {
        done();
        $("#fileu").text(file.name);
    }
};