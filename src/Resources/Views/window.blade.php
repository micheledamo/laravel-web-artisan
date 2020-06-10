<style>
    @import url(https://fonts.googleapis.com/css?family=Inconsolata:300,700);
    #webartisan__window {
        position: fixed;
        bottom: 0;
        right: 0;
        background-color: #FFFFFF;
        border-top: 1px solid #dddddd;
        color: #666666;
        padding: 15px;
        width: 100%;
        min-height: 200px;
        height: 200px;
        font: 16px/1.6 'Inconsolata', monospace;
        overflow-y: auto;
        cursor: text;
        font-weight: 300;
        z-index: 9999999999999999;
    }
    #webartisan__window::-webkit-scrollbar {
        width: 2px;
    }
    #webartisan__window::-webkit-scrollbar-thumb {
        background-color: #dddddd;
    }
    #webartisan__window.webartisan__window__minified {
        min-height: auto;
        height: 2rem;
        padding: 0 1rem;
    }
    #webartisan__window.webartisan__window__closed {
        width: 0;
        height: 0;
        min-height: 0;
        overflow: hidden;
        padding: 0;
        border-left: 1px solid #dddddd;
    }
    #webartisan__window #webartisan__window_close_button {
        position: fixed;
        bottom: 200px;
        right: 0;
        height: 30px;
        line-height: 30px;
        text-align: center;
        cursor: pointer;
        border: 1px solid #dddddd;
        border-right: 0;
        border-bottom: 0;
        padding: 0 15px;
        background-color: #FFFFFF;
    }
    #webartisan__window.webartisan__window__closed #webartisan__window_close_button {
        bottom: 0;
        padding: 0;
        width: 40px;
        font-weight: 700;
        background-color: #FFFFFF;
    }
    #webartisan__window #webartisan__window_close_button:hover,
    #webartisan__window #webartisan__window_minimize_button:hover {
        background-color: #f2f2f2;
    }
    #webartisan__window #webartisan__window_minimize_button {
        position: fixed;
        bottom: 0;
        right: 2rem;
        width: 2rem;
        height: 2rem;
        line-height: 2rem;
        text-align: center;
        cursor: pointer;
    }
    #webartisan__window .webartisan__window__command {
        display: flex;
        justify-content: flex-start;
        height: 20px;
    }
    #webartisan__window .webartisan__window__command .webartisan__window__init_text {
        line-height: 20px;
        margin-top: 0;
    }
    #webartisan__window .webartisan__window__command input {
        border: none;
        outline: none;
        font: 16px/1.6 'Inconsolata', monospace;
        font-weight: 700;
        color: #222222;
        width: 100%;
        height: 20px;
        line-height: 20px;
        padding: 0;
        margin-left: 15px;
        animation: blink-caret .75s step-end infinite;
    }
    #webartisan__window #webartisan__window__results {
        border: none;
        outline: none;
        font: 16px/1.6 'Inconsolata', monospace;
        width: 100%;
        resize: none;
        font-weight: 700;
        line-height: 20px;
    }
    #webartisan__window .webartisan__window__results__error {
        color: #f00 !important;
    }
    #webartisan__window .webartisan__window__results__success {
        color: #299711 !important;
    }
    /* The typewriter cursor effect */
    @keyframes blink-caret {
        from, to { border-color: transparent }
        50% { border-color: orange; }
    }
</style>
<div id="webartisan__window">
    <!--<span id="webartisan__window_minimize_button">_</span>-->
    <span id="webartisan__window_close_button">close</span>
    <span class="webartisan__window__command" id="webartisan__window__command">
        <label for="webartisan__window__input_command" class="webartisan__window__init_text">webartisan:/$</label>
        <input id="webartisan__window__input_command" type="text" autocomplete="off" />
    </span>
    <span id="webartisan__window__results"></span>
</div>
<script>
    let webartisan_window = document.getElementById('webartisan__window');
    let webartisan_minified_cookie = WebArtisan_ReadCookie("webartisan__minified");
    let webartisan_closed_cookie = WebArtisan_ReadCookie("webartisan__closed");

    if(webartisan_minified_cookie !== null) webartisan_window.classList.add('webartisan__window__minified');
    if(webartisan_closed_cookie !== null) {
        webartisan_window.classList.add('webartisan__window__closed');
        document.getElementById('webartisan__window__command').style.display = "none";
        document.getElementById('webartisan__window_close_button').innerHTML = ">_";
    }

    webartisan_window.onclick = function(){
        document.getElementById('webartisan__window__input_command').focus();
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
    /*
    document.getElementById('webartisan__window_minimize_button').onclick = function(){
        if(webartisan_window.classList.contains('webartisan__window__minified')) {
            webartisan_window.classList.remove('webartisan__window__minified');
            new WebArtisan_DeleteCookie('webartisan__minified');
        }
        else {
            webartisan_window.classList.add('webartisan__window__minified');
            new WebArtisan_WriteCookie('webartisan__minified', 'yes', 1440); // 1440 minutes = 1 day
        }
    }
    */

    // Execute a function when the user releases a key on the keyboard
    document.getElementById('webartisan__window__input_command').addEventListener("keyup", function(event) {
        // Number 13 is the "Enter" key on the keyboard
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById('webartisan__window__results').innerHTML = "";
            let command = this.value;
            sendCommand(command);
        }
    });

    function sendCommand(command) {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == XMLHttpRequest.DONE) {
                document.getElementById('webartisan__window__results').innerHTML = xhttp.responseText;
                webartisan_window.scrollTop = webartisan_window.scrollHeight;
            }
        }
        xhttp.open("POST", "{{ route('webartisan.run') }}", true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
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