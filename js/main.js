const $ = jQuery

// State object defaults are updated automatically by the browser.js file
export const state = {
    homeURL: serverVars.homeURL,
    themeURL: serverVars.themeURL,
    winHeight : $(window).height(),
    winWidth : $(window).width(),
    sTop: 0
}

// Code that runs when the document is ready.
function init() {
}

// Called on resize
export function onResize() {
}

// Called on scroll
export function onScroll() {    
}

// Called when all fonts have rendered
export function onFontsRendered() {
}

$( document ).ready(()=>{
    init()
})