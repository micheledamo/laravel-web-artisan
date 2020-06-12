@include('webartisan::_styles')
<div id="webartisan__window" @if($webartisan->isAuthenticated()) class="webartisan__window__authenticated" @endif>

    <span id="webartisan__window_close_button">close</span>

    <span id="webartisan__window__title" class="webartisan__window__for_commands">Welcome to Web Artisan, run your commands below.</span>
    <span class="webartisan__window__command webartisan__window__for_commands" id="webartisan__window__command">
        <label for="webartisan__window__input_command" class="webartisan__window__init_text">webartisan:/$</label>
        <input id="webartisan__window__input_command" type="text" autocomplete="off" />
    </span>
    <span id="webartisan__window__loading">running...</span>

    @if(config('webartisan.use_authentication'))
        <span id="webartisan__window_logout_button" class="webartisan__window__for_commands">logout</span>
        <span id="webartisan__window__auth_title" class="webartisan__window__for_auth">Please, authenticate yourself before to start using Web Artisan.</span>
        <span class="webartisan__window__command_auth webartisan__window__for_auth" id="webartisan__window__command_username">
            <label for="webartisan__window__input_command_username" class="webartisan__window__init_text">webartisan:/$ <b>Username:</b></label>
            <input id="webartisan__window__input_command_username" type="text" autocomplete="off" />
        </span>
        <span class="webartisan__window__command_auth webartisan__window__for_auth" id="webartisan__window__command_password" style="display:none;">
            <label for="webartisan__window__input_command_password" class="webartisan__window__init_text">webartisan:/$ <b>Password:</b></label>
            <input id="webartisan__window__input_command_password" type="password" autocomplete="off" />
        </span>
        <span id="webartisan__window__loading_auth">trying to authenticate...</span>
    @endif

    <span id="webartisan__window__results"></span>

</div>
@include('webartisan::_scripts')