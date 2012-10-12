function Loader()
{
    var scriptType = "text/javascript";
    
    var load = function( element )
    {
        // adding the script tag to the head
        var head = document.getElementsByTagName('head')[0];
        // fire the loading
        head.appendChild(element);
    };

    this.loadLink = function(url, rel, type, media, callback)
    {
        var link = document.createElement('link');
        link.rel= rel;
        link.type = type;
        link.href = url;
        link.media = media;

        // then bind the event to the callback function
        // there are several events for cross browser compatibility
        //link.onreadystatechange = callback;
        link.onload = callback;

        load(link);
    };
    
    this.loadScript = function(url, callback)
    {
        var script = document.createElement('script');
        script.type = scriptType;
        script.src = url;

        // then bind the event to the callback function
        // there are several events for cross browser compatibility
        //script.onreadystatechange = callback;
        script.onload = callback;

        load(script);
    };

    this.loadGoogleAPI = function(url, callback)
    {
        var script = document.createElement('script');
        script.type = scriptType;
        script.src = url+"&callback="+callback.name;

        load(script);
    };
}

