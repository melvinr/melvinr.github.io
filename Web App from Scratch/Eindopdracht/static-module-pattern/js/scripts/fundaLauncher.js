var fShaker = fShaker || {};
'use strict';

fShaker.launcher = (function () {
    
    return {
        init: () =>  {
            fShaker.ux.loader(true);
            fShaker.api.getLocation();
        }
    }
    
})();

fShaker.launcher.init();