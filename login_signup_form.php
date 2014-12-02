<?php $active = "signup_form"; ?>
<?php include '_header.php'; ?>
<?php include '_connect.php'; ?>

<style>
    .error_label {
        color:red;
        padding-left: 5px;
    }
</style>

<h3>Please desired Username and Password:</h3>

<form id="new_user_form" action="login_signup_submit.php">
    <input type="hidden" name="fallback_url" value="login_submit_form.php"/>

    <table>
        <tr>
            <td>Username:</td>
            <td><input id="user_name" type="text" name="user_name"/></td>
            <td><div id="user_name_error" class="error_label" style="display: none">User already exists with this user name.</div></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input id="password" type="password" name="password"/></td>
            <td><div id="password_error" class="error_label" style="display: none">Password must be between 8-25 characters</div></td>
        </tr>
        <tr>
            <td>Repeat Password:</td>
            <td><input id="re_password" type="password" name="repeat_password"/></td>
            <td><div id="re_password_error" class="error_label" style="display: none">Passwords does not match.</div></td>
        </tr>
        <tr>
            <td></td>
            <td><input id="form_submit_button" type="submit"/></td>
        </tr>
    </table>
</form>

<script>
    $(document).ready(function () {
        $('#form_submit_button').click(function (evt) {
            // suppress normal form submission
            evt.preventDefault();

            // reset warnings
            var error_in_form = false;
            $('#user_name_error').hide();
            $('#password_error').hide();
            $('#re_password_error').hide();

            // validate the inputs
            if ($('#password').val().length < 8 || $('#password').val().length > 25) {
                // Password length incorrect
                $('#password_error').show();
                error_in_form = true;
            }

            if ($('#password').val() != $('#re_password').val()) {
                // provided passwords did not match
                $('#re_password_error').show();
                error_in_form = true;
            }

            $.post("login_signup_ajax.php", { user_name: $('#user_name').val()})
                .done (function (data) {
                    //alert("login_signup_ajax callback: " + data);
                    if (!data.user_name_free) {
                        // User name was taken
                        $('#user_name_error').show();
                        error_in_form = true;
                    }

                    if (!error_in_form) {
                        // No errors we can submit the form
                        $('#new_user_form').submit();
                    }
                });
        });
    });
</script>

<?php include '_footer.php'; ?>
