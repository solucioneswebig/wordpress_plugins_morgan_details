<?php

$user = wp_get_current_user();
$id = $user->ID;



?>
<div class="container">
    
    <div class="row">
        <div class="col-md-12">
            <h1>Perfil de la cuenta</h1>
            <h4>Cambio de contraseña y usuario de la cuenta</h4>           
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
        <div class="wpum-template wpum-form wpum-password-form">

                <form action="/morgan/account/password" method="post" id="wpum-submit-password-form" enctype="multipart/form-data">

                 <fieldset class="fieldset-password">

                            
                                <label for="password">
                                    Contraseña													<span class="wpum-required">*</span>
                                                        </label>
                                <div class="field required-field">
                                    
                <input type="password" class="input-text" name="password" id="password" placeholder="" value="" maxlength="" required="">
                                </div>

                            
                        </fieldset>
                                <fieldset class="fieldset-password_repeat">

                            
                                <label for="password_repeat">
                                    Repetir contraseña<span class="wpum-required">*</span>
                                                        </label>
                                <div class="field required-field">
                                    
                <input type="password" class="input-text" name="password_repeat" id="password_repeat" placeholder="" value="" maxlength="" required="">
                                </div>

                            
                        </fieldset>
                    
                    <input type="hidden" name="wpum_form" value="password">
                    <input type="hidden" name="step" value="0">
                    <input type="hidden" id="password_change_nonce" name="password_change_nonce" value="0120d8245c"><input type="hidden" name="_wp_http_referer" value="/morgan/account/password">		<input type="submit" name="submit_password" class="button" value="Change password">

                </form>


                </div>
        </div>
    </div>    
</div>