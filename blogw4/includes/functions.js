shortcuts = {
    "fcg"   : "FC Groningen",
    "wu"    : "Wu-Tang Clan",
    "cl"    : "Champions League",
    "pl"    : "Premier League",
    "sws"   : "sowieso",
    "gg"    : "good game",
    "cg"    : "CodeGorilla"
}


window.onload = function() {
    var ta = document.getElementById("message") || document.getElementById("comment");
    var timer = 0;
    var re = new RegExp("\\b(" + Object.keys(shortcuts).join("|") + ")\\b", "g");


    update = function() {
        ta.value = ta.value.replace(re, function($0, $1) {
            return shortcuts[$1.toLowerCase()];
        });
    }

    ta.onkeydown = function() {
        clearTimeout(timer);
        timer = setTimeout(update, 200);

    }

}

$(document).ready(function(){
    $('#characterLeft').text('140 characters left');
    $('#message').keydown(function () {
        var max = 140;
        var len = $(this).val().length;
        if (len >= max) {
            $('#characterLeft').text('You have reached the limit');
            $('#characterLeft').addClass('red');
            $('#btnSubmit').addClass('disabled');
        }
        else {
            var ch = max - len;
            $('#characterLeft').text(ch + ' characters left');
            $('#btnSubmit').removeClass('disabled');
            $('#characterLeft').removeClass('red');
        }
    });
}); // voor de comment

$(document).ready(function () {

    $(".anon").on("click", function () {
        var $this = $(this);

        if ($this.is(':checked')) {
            $(".name-field").val("Remain anonymus");
            $(".email-field").val("anon@anonymous.com");
            $(".remain-anonymous").hide();

        } else {
            $(".name-field").val("Name");
            $(".email-field").val("Email");
            $(".remain-anonymous").show()
        }

    });

}); //checkbox
