<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>QR Scanner</title>

<script src="https://unpkg.com/html5-qrcode"></script>
<script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white shadow-lg rounded-xl p-6 w-full max-w-md">

<h1 class="text-xl font-semibold text-center mb-4">
QR Code Scanner
</h1>

<div id="reader" class="rounded-lg overflow-hidden"></div>

<p class="text-center text-sm text-gray-500 mt-4">
Scan Asset QR Code
</p>

</div>

<script>

function onScanSuccess(decodedText, decodedResult) {

    // redirect to scanned link
    window.location.href = decodedText;

}

let html5QrcodeScanner = new Html5QrcodeScanner(
    "reader",
    { fps: 10, qrbox: 250 }
);

html5QrcodeScanner.render(onScanSuccess);

</script>

</body>
</html>