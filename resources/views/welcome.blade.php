<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortener</title>
</head>
<body>
<form action="/api/shorten" method="POST">
    @csrf
    <label for="url">Enter URL to shorten:</label>
    <input type="url" name="url" required>
    <button type="submit">Shorten</button>
</form>
@if (session('shortened_url'))
<p>Shortened URL: <a href="{{ session('shortened_url') }}">{{ session('shortened_url') }}</a></p>
@endif
</body>
</html>
