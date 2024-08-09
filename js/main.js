const $ = jQuery

const state = {
    homeURL: serverVars.homeURL,
    themeURL: serverVars.themeURL,
    winWidth : $(window).width(),
    winHeight : $(window).height(),
    sTop: 0,
    referrer: document.referrer
}

// Code that runs when the document is ready.
function init() {
    console.log('Main init', state)
}

// Called on resize
function onResize(){
    console.log('Main onResize')
}

// Called on scroll
function onScroll(){    
    console.log('Main onScroll')
}

// Called when all fonts have rendered
function onFontsLoaded() {
    console.log('Main onFontsLoaded')
}

// Start the app
init()

// Listen for events
$(window).resize(()=>{
    onResize();
});
$(window).scroll(()=>{
    onScroll();
})
$(window).on('fonts-loaded', ()=>{
    onFontsLoaded();
})

export default state