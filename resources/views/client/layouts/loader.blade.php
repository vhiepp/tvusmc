<style>
    #preloder {
	position: fixed;
	width: 100%;
	height: 100%;
	top: 0;
	left: 0;
	z-index: 999999;
	background: rgba(255, 255, 255, 0.8);
    }

    .loader {
        width: 40px;
        height: 40px;
        position: absolute;
        top: 50%;
        left: 50%;
        margin-top: -13px;
        margin-left: -13px;
        border-radius: 60px;
        animation: loader 0.8s linear infinite;
        -webkit-animation: loader 0.8s linear infinite;
    }

    @keyframes loader {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
            border: 4px solid #d9f100;
            border-left-color: transparent;
        }
        50% {
            -webkit-transform: rotate(180deg);
            transform: rotate(180deg);
            border: 4px solid #525f7f;
            border-left-color: transparent;
        }
        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
            border: 4px solid #d9f100;
            border-left-color: transparent;
        }
    }

    @-webkit-keyframes loader {
        0% {
            -webkit-transform: rotate(0deg);
            border: 4px solid #525f7f;
            border-left-color: transparent;
        }
        50% {
            -webkit-transform: rotate(180deg);
            border: 4px solid #525f7f;
            border-left-color: transparent;
        }
        100% {
            -webkit-transform: rotate(360deg);
            border: 4px solid #d9f100;
            border-left-color: transparent;
        }
    }

</style>

<div id="preloder">
    <div class="loader"></div>
</div>

<script>

    $(".loader").fadeOut();
    $("#preloder").delay(100).fadeOut();

    document.body.onunload = () => {
        $(".loader").fadeOut();
        $("#preloder").delay(100).fadeOut();
    }

    $(window).ready(() => {
        const aTags = document.getElementsByTagName('a')
        const forms = document.getElementsByTagName('form')

        for (let i = 0; i < forms.length; i++) {
            forms[i].onsubmit = function () {
                $(".loader").fadeIn();
                $("#preloder").fadeIn("slow");
            }
        }

        for (let i = 0; i < aTags.length; i++) {
            if (!aTags[i].classList.contains('no-loader')) {
                aTags[i].addEventListener('click', function () {
                    $(".loader").fadeIn();
                    $("#preloder").fadeIn("slow");
                })
            }
        }
    })


</script>
