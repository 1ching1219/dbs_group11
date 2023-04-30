document.addEventListener("DOMContentLoaded",function(){

    var tl = gsap.timeline();

    tl.from("#logo",{duration:2.5,opacity:0, scale:0.3, ease:"Power2.easeout",rotation:90}) //logo動畫
    .to("#logo",{opacity:0,duration:0.5})//logo動畫隱藏
    .from("#popup",{opacity:0 , duration:2 ,backgroundColor:"#F5F5F5",stagger: .3})//一進來的東西顯示
    

});