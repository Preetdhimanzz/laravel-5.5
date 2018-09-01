$(document).ready(function() {
    // where you want to load all the content e.g class name or id with syntax .class #id
    var replaceWithElemet = ".content-wrapper";
    var loader_div        = ".loader_div";
    jQuery(document).on('click', '.router', function(event) {
        event.preventDefault();
        let thisUrl = jQuery(this).attr('href');
        $.ajax({
            url: thisUrl,
            type: 'GET',
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function() {
                $(loader_div).show();
            },
            complete: function() {
                $(loader_div).hide();
            },
            success: function(response) {
                window.history.pushState('page2', 'Title', thisUrl);
                $(replaceWithElemet).replaceWith(response.html);
            },
            error: function(response) {

            }
        })
    });

    $(document).on('click', '.pagination li a', function(event) {
        event.preventDefault();
        var url = $(this).attr("href");
        $.ajax({
            type: "GET",
            dataType: "json",
            url: url,
            beforeSend: function() {
                $(loader_div).show();
            },
            complete: function() {
                $(loader_div).hide();
            },
            success: function(response) {
                $(document).find(replaceWithElemet).replaceWith(response.html);
            },
            error: function(response) {

            }
        });
        return false;
    });

    jQuery(document).on('click', '.isEditState', function(event) {
        event.preventDefault();
        var formData    = new FormData();
        var formaction  = '';
        var method      = '';
        jQuery(this).each(function() {
            $.each(this.attributes, function()
            {
                if (this.specified)
                {
                    if (this.name != "class") {
                        console.log(this.name.replace('data', ''), this.value);
                        var dataString = this.name.replace('data-', '');
                        if (dataString == 'href') {
                            formaction = this.value;
                        } else if (dataString == 'type') {
                            method = this.value;
                        } else {
                            formData.append(dataString, this.value);
                        }
                    }
                }
            })
        });

        // get an error and give notification
        if ( formaction == '' ||  method == '') {
            toster('Error','Submit URL or Method invalid please check and submit request again',1000);
            return false;
        }
        $.ajax({
            url: formaction,
            type: method,
            data: formData,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            cache: false,
            processData: false,
            dataType: "json",
            success: function(response) {
                $(document).find('.hasEditArea').html(response.html);
            },
            error : function(error {
                // DEBUG:  your error
            }

        });
    });

});
