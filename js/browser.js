import {state, onScroll as onScrollMain, onResize as onResizeMain} from "./main.js"

function onResize(){
    state.winHeight = jQuery(window).height();
    state.winWidth = jQuery(window).width();
    onResizeMain();
}

function onScroll(){
    state.sTop = jQuery(window).scrollTop();
    onScrollMain();
}

jQuery( document ).ready(($)=>{
    $(window).resize(()=>{
        window.requestAnimationFrame( onResize );
    });
    $(window).scroll(()=>{
        window.requestAnimationFrame( onScroll );
    })    
})