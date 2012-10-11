function OS()
{
    var isAndroid = function()
    {
        return navigator.userAgent.match(/Android/i) ? true : false;
    };
    
    var isBlackBerry = function()
    {
        return navigator.userAgent.match(/BlackBerry/i) ? true : false;
    };
    
    var isIOS = function()
    {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i) ? true : false;
    };
    
    var isWindows = function()
    {
        return navigator.userAgent.match(/IEMobile/i) ? true : false;
    };
    
    var isMeeGo = function()
    {
        return navigator.userAgent.match(/MeeGo/i) ? true : false;
    };
    
    var isMaemo = function()
    {
        return navigator.userAgent.match(/Maemo/i) ? true : false;
    };
    
    this.isMobile = function()
    {
        return (isAndroid() ||
                    isBlackBerry() ||
                        isIOS() ||
                            isWindows() ||
                                isMeeGo() ||
                                    isMaemo());
    };
}

