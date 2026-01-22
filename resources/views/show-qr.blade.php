<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Result</title>
</head>
<body>
    <h1>Item</h1>
    <label for="">Serial Number</label>
    <p>{{ $item->serial_number }}</p>
    <label for="">Specs</label>
    <input type="text" value="{{ $item->specs }}"><br>
    <label for="">Brand</label>
    <input type="text" value="{{ $item->brand }}"><br>
    <label for="">status</label>
    <input type="text" value="{{ $item->status }}"><br>

    <label for="">remarks</label>
    <textarea name="" id="" cols="30" rows="10"></textarea>
</body>
</html>
