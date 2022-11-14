<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
        crossorigin="anonymous"></script>

<script>

//    check or uncheck checkboxes for each radio button
    $("input[value='small']").change(function() {
        $("input[type='checkbox']").prop('disabled', true).prop('checked', false);
        $("input[value='twix']").prop('disabled', false);
        $("input[value='crumbs']").prop('disabled', false);
    });

    $("input[value='medium']").change(function() {
        $("input[type='checkbox']").prop('disabled', true).prop('checked', false);
        $("input[value='nutella']").prop('disabled', false);
        $("input[value='crumbs']").prop('disabled', false);
    });

    $("input[value='large']").change(function() {
        $("input[type='checkbox']").prop('disabled', true).prop('checked', false);
        $("input[value='twix']").prop('disabled', false);
        $("input[value='nutella']").prop('disabled', false);
        $("input[value='coconut']").prop('disabled', false);
        $("input[value='plazma']").prop('disabled', false);
        $("input[value='cherry']").prop('disabled', false);
    });


    // document
    //     .getElementById("submit")
    //     .addEventListener("click", function( e ){ //e => event
    //         if( ! confirm("Have you finished with your order?") ){
    //             e.preventDefault(); // ! => don't want to do this
    //         }
    //     });


</script>

</body>
</html>