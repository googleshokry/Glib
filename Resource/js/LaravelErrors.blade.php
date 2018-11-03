<script type="text/javascript" src="js/LaravelError.js"></script>
<?php //dd(collect($errors->getMessages())->toJson())?>
<script>

    let errorMessages = JSON.parse('{!! collect($errors->getMessages())->toJson()!!}');

    (function (errorMessages) {

        LaravelErrors = function (errors) {
            const MessageClass = "olderrorP";
            localStorage.setItem("L_ERR", JSON.stringify(errors));

            let render = (err) => {

                $("." + MessageClass).remove();

                for (let InputName in err) {

                    let input = $("[name=" + InputName + "]");
                    for (let ind in err[InputName])
                        input.after(" <span style='display: block;margin: 2px' class='olderrorP text-danger'>" + err[InputName][ind] + "</span>");


                }
            };
            return {
                getLast: () => render(JSON.parse(localStorage.getItem("L_ERR"))),
                clear: () => localStorage.removeItem("L_ERR"),
                showHints: () => render(errors)
            }
        };

        /**
         *  exec
         */
        new LaravelErrors(errorMessages).showHints();


    })(errorMessages)


</script>