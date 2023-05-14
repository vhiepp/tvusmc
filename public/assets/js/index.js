
window.addEventListener('scroll', () => {
    if (document.body.scrollTop > 82 || document.documentElement.scrollTop > 82) {

        document.getElementById('navbar-main').classList.add('change');
        document.getElementById('navbar-main').classList.add('shadow');
        document.getElementById('navbar-main').style = "background-color: #fff !important;";

        document.getElementById('btn-back').classList.add('show');
        document.getElementById('btn-back').classList.remove('hide');
    } else {

        document.getElementById('navbar-main').classList.remove('change');
        document.getElementById('navbar-main').classList.remove('shadow');
        document.getElementById('navbar-main').style = "";

        document.getElementById('btn-back').classList.remove('show');
        document.getElementById('btn-back').classList.add('hide');
    }
})

$('#btn-back').on('click', function () {
    $(window).scrollTop(0);
});
