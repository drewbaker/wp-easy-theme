import { state } from "../js/main.js"

const $ = jQuery

function init(){
    console.log("work.js loaded", state)
}

$( document ).ready(()=>{
    init()
})