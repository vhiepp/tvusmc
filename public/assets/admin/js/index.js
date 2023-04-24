
const copyText = (text) => {
    var inputCopy = document.createElement('input');

    document.body.appendChild(inputCopy);

    inputCopy.value = text;

    inputCopy.select();

    document.execCommand('copy');

    document.body.removeChild(inputCopy);
}