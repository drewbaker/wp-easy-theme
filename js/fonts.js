import {onFontsRendered} from './main.js';
/*
 * Font loader
 * SEE https://github.com/typekit/webfontloader
 */

WebFont.load({
    // custom: {
    //     families: ['My Font']
    // },
    // google: {
    //     families: ['Droid Sans', 'Droid Serif:bold']
    // },    
    active() {
        onFontsRendered()
    },
    fontactive(familyName, fvd) {
        //console.log('A single font rendered', familyName, fvd);
    },   
});