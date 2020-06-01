$(() => {
    let passwordError = true;
    let confirmError = true;
    enableSubmit();
    $("#password-error").hide();
    $("#confirmation-error").hide();

    $('#passwordInput').on('input', () => {
        const passwordValue = $('#passwordInput').val();
        const passwordRegex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,}$/

        passwordError = passwordValue.match(passwordRegex) == null;
        console.log(passwordError)
        enableSubmit();
    });

    $('#confirmInput').on('input', () => {
        console.log($("#passwordInput").val() !== $("#confirmInput").val());
        confirmError = $("#passwordInput").val() !== $("#confirmInput").val();
        enableSubmit();
    })

    $("form :input").on('change', () => {
        if(passwordError && $('#passwordInput').val() != '') {
            $("#password-error").show();
        } else {
            $("#password-error").hide();
        }

        if (confirmError && $('#confirmInput').val() != '') {
            $("#confirmation-error").show();
        } else {
            $("#confirmation-error").hide();
        }
    });

    function enableSubmit() {
        $('#submit').prop('disabled', passwordError || confirmError );
    }
})