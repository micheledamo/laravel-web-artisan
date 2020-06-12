<style>
    @import url(https://fonts.googleapis.com/css?family=Inconsolata:400,700);
    #webartisan__window {
        position: fixed;
        bottom: 0;
        background-color: #FFFFFF;
        border-top: 1px solid #dddddd;
        color: #666666;
        padding: 0;
        width: 100%;
        min-height: 200px;
        height: 200px;
        font: 16px/1.6 'Inconsolata', monospace;
        overflow-y: auto;
        cursor: text;
        font-weight: 400;
        z-index: 9999999999999999;
    }
    #webartisan__window::-webkit-scrollbar {
        width: 2px;
    }
    #webartisan__window::-webkit-scrollbar-thumb {
        background-color: #dddddd;
    }
    #webartisan__window.webartisan__window__closed {
        width: 0;
        height: 0;
        min-height: 0;
        overflow: hidden;
        padding: 0;
        border-left: 1px solid #dddddd;
    }
    #webartisan__window #webartisan__window_logout_button {
        position: fixed;
        bottom: 200px;
        right: 70px;
        height: 30px;
        line-height: 30px;
        text-align: center;
        cursor: pointer;
        border: 1px solid #dddddd;
        border-right: 0;
        border-bottom: 0;
        padding: 0 15px;
        background-color: #FFFFFF;
        color: #f00;
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
    #webartisan__window.webartisan__window__closed #webartisan__window_logout_button {
        display: none;
    }
    #webartisan__window.webartisan__window__closed #webartisan__window_close_button {
        bottom: 0;
        padding: 0;
        width: 40px;
        font-weight: 700;
        background-color: #FFFFFF;
    }
    #webartisan__window #webartisan__window_close_button:hover,
    #webartisan__window #webartisan__window_logout_button:hover {
        background-color: #f2f2f2;
    }
    #webartisan__window #webartisan__window__title {
        display: flex;
        padding: 15px 15px 5px 15px;
        color: #222222;
        font-weight: 700;
    }
    #webartisan__window .webartisan__window__command {
        display: flex;
        justify-content: flex-start;
        height: 20px;
        padding: 5px 15px;
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
    #webartisan__window #webartisan__window__loading {
        font: 16px/1.6 'Inconsolata', monospace;
        line-height: 20px;
        padding: 5px 15px;
        display: none;
        justify-content: flex-start;
        width: auto;
    }
    #webartisan__window #webartisan__window__results {
        border: none;
        outline: none;
        font: 16px/1.6 'Inconsolata', monospace;
        resize: none;
        font-weight: 700;
        line-height: 20px;
        padding: 5px 15px 15px 15px;
        display: flex;
        justify-content: flex-start;
        width: auto;
    }
    #webartisan__window .webartisan__window__results__error {
        color: #f00 !important;
    }
    #webartisan__window .webartisan__window__results__success {
        color: #299711 !important;
    }

    /* AUTH */
    #webartisan__window #webartisan__window__auth_title {
        display: flex;
        padding: 15px 15px 5px 15px;
    }
    #webartisan__window .webartisan__window__command_auth {
        display: flex;
        justify-content: flex-start;
        height: 20px;
        padding: 5px 15px;
    }
    #webartisan__window .webartisan__window__command_auth .webartisan__window__init_text {
        line-height: 20px;
        margin-top: 0;
    }
    #webartisan__window .webartisan__window__command_auth input {
        border: none;
        outline: none;
        font: 16px/1.6 'Inconsolata', monospace;
        font-weight: 700;
        color: #222222;
        width: auto;
        height: 20px;
        line-height: 20px;
        padding: 0;
        margin-left: 15px;
        animation: blink-caret .75s step-end infinite;
    }
    #webartisan__window #webartisan__window__loading_auth {
        font: 16px/1.6 'Inconsolata', monospace;
        line-height: 20px;
        padding: 5px 15px;
        display: none;
        justify-content: flex-start;
        width: auto;
    }

    #webartisan__window.webartisan__window__authenticated .webartisan__window__for_auth {
        display:none !important;
    }
    #webartisan__window:not(.webartisan__window__authenticated) .webartisan__window__for_commands {
        display:none !important;
    }

    /* The typewriter cursor effect */
    @keyframes blink-caret {
        from, to { border-color: transparent }
        50% { border-color: orange; }
    }
</style>