<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        <form action="/submit" method="POST" class="grid grid-cols-2">
            @csrf
            <div>
                <label for="">Serial NUmber</label>
                <input type="text" name="serial_number">
            </div>
            <div>
                <label for="">Specs</label>
                <input type="text" name="specs">
            </div>
            <div>
                <label for="">Location</label>
                <input type="text" name="location">
            </div>
            <div>
                <label for="">Status</label>
                <select name="status" id="status">
                    <option value="available">available</option>
                    <option value="checked_out">checked_out</option>
                    <option value="under_maintenance">under_maintenance</option>
                    <option value="in use">in use</option>
                </select>
            </div>
            <div>
                <label for="">Category</label>
                {{-- <input type="text" name="category"> --}}
                <select name="category" id="category">
                    <option value="laptop">laptop</option>
                    <option value="desktop">desktop</option>
                    <option value="monitor">monitor</option>
                    <option value="printer">printer</option>
                    <option value="other">other</option>
                </select>
            </div>
            <button type="submit">submit</button>
        </form>
    </div>
</body>
</html>