import state from "wp-easy/main";

const $ = jQuery

function onResize(fn){
    state.winWidth = $(window).width();
    state.winHeight = $(window).height();
}

function onScroll(fn){
    state.sTop = $(window).scrollTop();
}

$(window).resize(()=>{
    onResize();
});
$(window).scroll(()=>{
    onScroll();
})