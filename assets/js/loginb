<script>
    $("#submit").click( function() {
        if( $("#username").val() == "" || $("#password").val() == "")
            $("#errMessage").html("Please Enter Username and Password");
        else
            $.post( $("#formLogin").attr("action"),
                    $("#formLogin :input").serializeArray(),
                    function(data) {
                        $("span#errMessage").html(data);
                    });
            $("#formLogin").submit(function() {
                return false;
            });
    });
</script>