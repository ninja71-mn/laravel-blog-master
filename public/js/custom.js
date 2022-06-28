const menuBtn = document.querySelector('.toggle-btn');
let menuOpen = false;

function toggleSidebar() {
    document.getElementById("sidebar").classList.toggle('active');
}

menuBtn.addEventListener('click', () => {
    if (!menuOpen) {
        menuBtn.classList.add('open');
        menuOpen = true;
    } else {
        menuBtn.classList.remove('open');
        menuOpen = false;
    }
});


$(document).ready(function () {
    $(".category").click(function () {
        $("#sidebar .categories").toggle('slow');
        $(this).toggleClass('active');
    });
});
$(document).ready(function () {
    $(".personalise").click(function () {
        $("#sidebar .personalises").toggle('slow');
        $(this).toggleClass('active');
    });
});

$('#mode-switcher').on('click',function(){
   $('#mode-switch').toggleClass('active');
});

$('#lang-switcher').on('click',function(){
    $(this).toggleClass('active');
});


$('.colors').each(function () {
    $(this).click(function(){
        let color=$(this).attr('data-color');
        document.documentElement.style.setProperty('--theme',color);
        localStorage.setItem('--theme', color);
    })
});

$('.mode').each(function () {
    $(this).click(function(){
        let background=$(this).attr('data-color');
        if (background==='#111'){
            document.documentElement.style.setProperty('--text','#fff');
            document.documentElement.style.setProperty('--postcontent','#252525');
            document.documentElement.style.setProperty('--titlebg','rgba(255, 255, 255, 0.07)');
            localStorage.setItem('--text','#fff');
            localStorage.setItem('--postcontent','#252525');
            localStorage.setItem('--titlebg','rgba(255, 255, 255, 0.07)');
        }else {
            document.documentElement.style.setProperty('--text','#666');
            document.documentElement.style.setProperty('--postcontent','#f2f2f2');
            document.documentElement.style.setProperty('--titlebg','rgba(30, 37, 48, 0.07)');
            localStorage.setItem('--text','#666');
            localStorage.setItem('--postcontent','#f2f2f2');
            localStorage.setItem('--titlebg','rgba(30, 37, 48, 0.07)');


        }
        document.documentElement.style.setProperty('--backcolor',background);
        localStorage.setItem('--backcolor',background);
    })
});


$(document).ready(function () {
    var theme = localStorage.getItem('--theme');
    var backcolor=localStorage.getItem("--backcolor");
    var text=localStorage.getItem("--text");
    var postcontent=localStorage.getItem("--postcontent");
    var titlebg=localStorage.getItem("--titlebg");

    if (titlebg !== null){
        document.documentElement.style.setProperty('--titlebg',titlebg);
    }
    if (theme !== null){
        document.documentElement.style.setProperty('--theme',theme);
    }
    if (backcolor !== null){
        document.documentElement.style.setProperty('--backcolor',backcolor);
    }
    if (text !== null){
        document.documentElement.style.setProperty('--text',text);
    }
    if (postcontent !== null){
        document.documentElement.style.setProperty('--postcontent',postcontent);
    }
$('.loading').hide();
});

