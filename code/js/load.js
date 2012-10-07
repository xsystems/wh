function loadLink(url, rel, type, media, callback)
{
    // adding the script tag to the head as suggested before
    var head = document.getElementsByTagName('head')[0];
    var link = document.createElement('link');
    link.rel= rel;
    link.type = type;
    link.href = url;
    link.media = media;

    // then bind the event to the callback function
    // there are several events for cross browser compatibility
    link.onreadystatechange = callback;
    link.onload = callback;

    // fire the loading
    head.appendChild(link);
}

function loadScript(url, callback)
{
    // adding the script tag to the head as suggested before
    var head = document.getElementsByTagName('head')[0];
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = url;

    // then bind the event to the callback function
    // there are several events for cross browser compatibility
    script.onreadystatechange = callback;
    script.onload = callback;

    // fire the loading
    head.appendChild(script);
}
