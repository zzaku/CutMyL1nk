document.querySelectorAll(".qrcode").forEach((element, index) => {
    let qrcode = new QRCode(element);
    qrcode.makeCode(`localhost/CutMyLink/${myShortUrlsArray[index].short_url}`);
});