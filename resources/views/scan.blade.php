<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
          href="style.css">
    <title>QR Code Scanner / Reader
    </title>
    <style>
            

        #my-qr-reader {
            padding: 20px !important;
            border: 1.5px solid #b2b2b2 !important;
            border-radius: 8px;
        }

        #my-qr-reader img[alt="Info icon"] {
            display: none;
        }

        #my-qr-reader img[alt="Camera based scan"] {
            width: 100px !important;
            height: 100px !important;
        }

        button {
            padding: 10px 20px;
            border: 1px solid #b2b2b2;
            outline: none;
            border-radius: 0.25em;
            font-size: 15px;
            cursor: pointer;
            margin-top: 15px;
            margin-bottom: 10px;
            transition: 0.3s background-color;
        }

        

        #html5-qrcode-anchor-scan-type-change {
            text-decoration: none !important;
            color: #1d9bf0;
        }

        video {
            width: 50% !important;
            border: 1px solid #b2b2b2 !important;
            border-radius: 0.25em;
        }
    </style>
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>Scan QR Codes</h1>
        <div class="section">
            <div id="my-qr-reader">
            </div>
        </div>
    </div>
    <script
        src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js">
    </script>
    <script>
        
function domReady(fn) {
    if (
        document.readyState === "complete" ||
        document.readyState === "interactive"
    ) {
        setTimeout(fn, 1000);
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
}

domReady(function () {

    function onScanSuccess(decodedText, decodeResult) {
        window.location.href = `/show-qr?qr=${encodeURIComponent(decodedText)}`;
    }

    let htmlscanner = new Html5QrcodeScanner(
        "my-qr-reader",
        { fps: 10, qrbos: 250 }
    );
    htmlscanner.render(onScanSuccess);
});
    </script>
</body>

</html>