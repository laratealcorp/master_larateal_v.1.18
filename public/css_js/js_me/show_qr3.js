function qrcode(id,data,logo,color){
    const qrCode1 = new QRCodeStyling({
    width: 200,
    height: 200,
    type: "png",
    data: data,
     image:logo,
    dotsOptions: {
       // color: "#6A1A4C", //Ungu
        color: color,
        type: "dots"
    },
    cornersSquareOptions: {
        color: "#000000",
        type: "dot"
    },
    cornersDotOptions: {
        color: "#000000",
        type: "dot"
    },
    backgroundOptions: {
        color: "#ffffff",
    },
    imageOptions: {
        crossOrigin: "anonymous",
        hideBackgroundDots:true,
        imageSize: 0.2,
        margin: 0
    }
});
    qrCode1.append(document.getElementById(id));
}
function download_qrcode(data,logo,color){
    const qrCode2 = new QRCodeStyling({
    width: 600,
    height: 600,
    type: "png",
    data: data,
     image:logo,
     dotsOptions: {
        // color: "#6A1A4C", //Ungu
         color: color,
         type: "dots"
     },
     cornersSquareOptions: {
         color: "#000000",
         type: "dot"
     },
     cornersDotOptions: {
         color: "#000000",
         type: "dot"
     },
     backgroundOptions: {
         color: "#ffffff",
     },
     imageOptions: {
         crossOrigin: "anonymous",
         hideBackgroundDots:true,
         imageSize: 0.2,
         margin: 1
     }
});
    qrCode2.download({ name: "Qrcode_"+Date.now(), extension: "png" });
}