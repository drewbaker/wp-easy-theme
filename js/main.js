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
}

// Called on resize
function onResize(){
    state.winWidth = $(window).width();
    state.winHeight = $(window).height();    
}

// Called on scroll
function onScroll(){    
    state.sTop = $(window).scrollTop();
}

// Called when all fonts have rendered
function onFontsLoaded() {
    
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