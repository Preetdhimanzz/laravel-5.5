
    // in this file only three funtions
    // NOTE:- if using this file your some event are disabled or not init then you need to re init on success event of the funtion. DOM
    // or any jquery lib funtion not working also you need to re init on ajax success funtion

    /*

    // NOTE:  you neeed to pass your html in json formal like {html:'<h1> your html</h1>'} using json encode funtion in php  echo json_encode(array('html' => '<h1>hello </h1>'))

    1. asynLoad method which help to load content dynamic and your application run without reloading again and again
        // NOTE
        replaceWithElemet is class or id where you want to replace your response html

    2. Ajax paginator url you neeed to pass your html in json formal like {html:'<h1> your html</h1>'} using json encode funtion in php  echo json_encode(array('html' => '<h1>hello </h1>'))

    3. triggerEdit this method reduse your edit ajax req you no need to write ajax code again and pagination
        Data To pass
        a button having class var triggerEdit;
        data prifix like you want to pass var orderid then you need to pass attr like this data-orderid="000152" then you access on url orderid
        URL:- href attribute for full url like www.exmple.com/login
        type required req post or get you need to pass like data-type="post"

        required params
        data-type="post" or get
        href ="www.exmple.com/login" URL

        rest pass parms acccouding your requirement
        Likes
        data-name="name"
        data-summary="summary"
        data-id="id"
        data-state="state"

        you ll access on post data on url like thisUrl

        Array[
          "name" => "name",
          "summary" => "summary",
          "id" => "id",
          "state" => "state",
      ]

    */
    $(document).ready(function() {
        // where you want to load all the content e.g class name or id with syntax .class #id
        var replaceWithElemet = ".content-wrapper";
        var loader_div        = ".loader_div";
        var asynLoad          = ".router";
        var paginatortarget   = '.pagination li a';
        var triggerEdit       = '.isEditState';

        jQuery(document).on('click', asynLoad, function(event) {
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

        $(document).on('click', paginatortarget, function(event) {
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
                  // DEBUG: your request
                }
            });
            return false;
        });

        jQuery(document).on('click', triggerEdit, function(event) {
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
                error : function(error) {
                    // DEBUG:  your error
                }

            });
        });



    });
