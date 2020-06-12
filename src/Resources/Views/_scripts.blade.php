<script>
    let webartisan_window = document.getElementById('webartisan__window');
    let webartisan_closed_cookie = WebArtisan_ReadCookie("webartisan__closed");

    if(webartisan_closed_cookie !== null) {
        webartisan_window.classList.add('webartisan__window__closed');
        document.getElementById('webartisan__window__command').style.display = "none";
        document.getElementById('webartisan__window_close_button').innerHTML = ">_";
    }

    webartisan_window.onclick = function(){
        let command = document.getElementById('webartisan__window__input_command');
        if(command) command.focus();

        let command_auth_username = document.getElementById('webartisan__window__command_username');
        let command_auth_username_input = document.getElementById('webartisan__window__input_command_username');
        let command_auth_password = document.getElementById('webartisan__window__command_password');
        let command_auth_password_input = document.getElementById('webartisan__window__input_command_password');
        if(command_auth_username && command_auth_username.style.display !== 'none') command_auth_username_input.focus();
        if(command_auth_password && command_auth_password.style.display !== 'none') command_auth_password_input.focus();
    };
    document.getElementById('webartisan__window_close_button').onclick = function(){
        if(webartisan_window.classList.contains('webartisan__window__closed')) {
            webartisan_window.classList.remove('webartisan__window__closed');
            document.getElementById('webartisan__window__command').style.display = "flex";
            document.getElementById('webartisan__window__results').style.display = "inherit";
            this.innerHTML = "close";
            new WebArtisan_DeleteCookie('webartisan__closed');
        }
        else {
            webartisan_window.classList.add('webartisan__window__closed');
            document.getElementById('webartisan__window__command').style.display = "none";
            document.getElementById('webartisan__window__results').style.display = "none";
            this.innerHTML = ">_";
            new WebArtisan_WriteCookie('webartisan__closed', 'yes', 1440); // 1440 minutes = 1 day
        }
    }

    // Execute a function when the user releases a key on the keyboard
    let command = document.getElementById('webartisan__window__input_command');
    if(command) {
        command.addEventListener("keyup", function(event) {
            // Number 13 is the "Enter" key on the keyboard
            if (event.keyCode === 13) {
                event.preventDefault();
                document.getElementById('webartisan__window__loading').style.display = "flex";
                document.getElementById('webartisan__window__results').innerHTML = "";
                let command = this.value;
                sendCommand(command);
            }
        });
    }

    let username = '';
    let password = '';

    let username_input = document.getElementById('webartisan__window__input_command_username');
    if(username_input) {
        username_input.addEventListener("keyup", function(event) {
            // Number 13 is the "Enter" key on the keyboard
            if (event.keyCode === 13) {
                event.preventDefault();
                username = this.value;
                document.getElementById('webartisan__window__command_username').style.display = "none";
                document.getElementById('webartisan__window__command_password').style.display = "flex";
                document.getElementById('webartisan__window__results').innerHTML = "";
                document.getElementById('webartisan__window__input_command_password').focus();
            }
        });
    }

    let password_input = document.getElementById('webartisan__window__input_command_password');
    if(password_input) {
        password_input.addEventListener("keyup", function(event) {
            // Number 13 is the "Enter" key on the keyboard
            if (event.keyCode === 13) {
                event.preventDefault();
                password = this.value;
                document.getElementById('webartisan__window__command_password').style.display = "none";
                document.getElementById('webartisan__window__loading_auth').style.display = "flex";
                sendAuth(username, password);
            }
        });
    }

    let logout_button = document.getElementById('webartisan__window_logout_button');
    if(logout_button) {
        logout_button.onclick = function(){
            sendLogout();
        }
    }

    /**
     * Send auth and catch response
     */
    function sendAuth(username, password) {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == XMLHttpRequest.DONE) {
                document.getElementById('webartisan__window__loading_auth').style.display = "none";
                document.getElementById('webartisan__window__input_command_username').value = "";
                document.getElementById('webartisan__window__input_command_password').value = "";
                if(xhttp.responseText.includes("webartisan__window__results__error")) {
                    document.getElementById('webartisan__window__command_username').style.display = "flex";
                    document.getElementById('webartisan__window__input_command_username').focus();
                    document.getElementById('webartisan__window__results').innerHTML = xhttp.responseText;
                }
                else {
                    webartisan_window.classList.add("webartisan__window__authenticated");
                    document.getElementById('webartisan__window__input_command').focus();
                }
                webartisan_window.scrollTop = webartisan_window.scrollHeight;
            }
        }
        xhttp.open("POST", "{{ route('webartisan.auth') }}", true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
        xhttp.send("username="+username+"&password="+password);
    }

    /**
     * Send auth and catch response
     */
    function sendLogout() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == XMLHttpRequest.DONE) {
                document.getElementById('webartisan__window__loading_auth').style.display = "none";
                document.getElementById('webartisan__window__command_username').style.display = "flex";
                document.getElementById('webartisan__window__results').innerHTML = "";
                webartisan_window.classList.remove("webartisan__window__authenticated");
                document.getElementById('webartisan__window__input_command_username').focus()
            }
        }
        xhttp.open("POST", "{{ route('webartisan.logout') }}", true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
        xhttp.send();
    }

    /**
     * Send a command and catch response
     */
    function sendCommand(command) {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == XMLHttpRequest.DONE) {
                document.getElementById('webartisan__window__loading').style.display = "none";
                document.getElementById('webartisan__window__results').innerHTML = xhttp.responseText;
                webartisan_window.scrollTop = webartisan_window.scrollHeight;
            }
        }
        xhttp.open("POST", "{{ route('webartisan.run') }}", true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
        xhttp.send("command="+command);
    }

    /**
     * Read the cookie preference for Web Artisan
     *
     * @param name
     * @returns {string|null}
     * @constructor
     */
    function WebArtisan_ReadCookie(name) {
        let dc = document.cookie;
        let prefix = name + "=";
        let begin = dc.indexOf("; " + prefix);
        let end = null;
        if (begin === -1) {
            begin = dc.indexOf(prefix);
            if (begin !== 0) return null;
        }
        else {
            begin += 2;
            let end = document.cookie.indexOf(";", begin);
            if (end === -1) end = dc.length;
        }
        // because unescape has been deprecated, replaced with decodeURI
        // return unescape(dc.substring(begin + prefix.length, end));
        return decodeURI(dc.substring(begin + prefix.length, end));
    }

    /**
     * Write the cookie preference for Web Artisan
     *
     * @param name
     * @param value
     * @param duration
     * @constructor
     */
    function WebArtisan_WriteCookie(name, value, duration) {
        let deadline = new Date();
        let now = new Date();
        deadline.setTime(now.getTime() + (parseInt(duration) * 60000));
        document.cookie = name + '=' + escape(value) + '; expires=' + deadline.toGMTString() + '; path=/';
    }

    /**
     * Delete the cookie preference for Web Artisan
     *
     * @param name
     * @constructor
     */
    function WebArtisan_DeleteCookie(name) {
        let deadline = 'Thu, 01 Jan 1970 00:00:01 GMT';
        document.cookie = name + '=; expires=' + deadline + '; path=/';
    }
</script>