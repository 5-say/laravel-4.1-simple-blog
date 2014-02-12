@section('style')
/* google search */

#goog-fixurl ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

#goog-fixurl form {
    margin: 0;
}

#goog-wm-qt,
#goog-wm-sb {
    border: 1px solid #bbb;
    font-size: 16px;
    line-height: normal;
    vertical-align: top;
    color: #444;
    border-radius: 2px;
}

#goog-wm-qt {
    width: 220px;
    height: 20px;
    padding: 5px;
    margin: 5px 10px 0 0;
    box-shadow: inset 0 1px 1px #ccc;
}

#goog-wm-sb {
    display: inline-block;
    height: 32px;
    padding: 0 10px;
    margin: 5px 0 0;
    white-space: nowrap;
    cursor: pointer;
    background-color: #f5f5f5;
    background-image: -webkit-linear-gradient(rgba(255,255,255,0), #f1f1f1);
    background-image: -moz-linear-gradient(rgba(255,255,255,0), #f1f1f1);
    background-image: -ms-linear-gradient(rgba(255,255,255,0), #f1f1f1);
    background-image: -o-linear-gradient(rgba(255,255,255,0), #f1f1f1);
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    *overflow: visible;
    *display: inline;
    *zoom: 1;
}

#goog-wm-sb:hover,
#goog-wm-sb:focus {
    border-color: #aaa;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
    background-color: #f8f8f8;
}

#goog-wm-qt:hover,
#goog-wm-qt:focus {
    border-color: #105cb6;
    outline: 0;
    color: #222;
}
@parent @stop

<script>
    var GOOG_FIXURL_LANG = (navigator.language || '').slice(0,2),
        GOOG_FIXURL_SITE = location.host;
</script>
<script src="http://linkhelp.clients.google.com/tbproxy/lh/wm/fixurl.js"></script>