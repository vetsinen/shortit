<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortener</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.16/dist/vue.js"></script>
    <script>
        const app = new Vue({
            el: '#app',
            data: {
                message: 'Hello Vue!'
            }
        })
    </script>
</head>
<body>
<div id="app">
    {{ message }}
    <form action="/api/shorten" method="POST">
        @csrf
        <label for="url">Enter URL to shorten:</label>
        <input type="url" name="url" required>
        <button type="submit">Shorten</button>
    </form>
</div>

@if (session('shortened_url'))
<p>Shortened URL: <a href="{{ session('shortened_url') }}">{{ session('shortened_url') }}</a></p>
@endif

</body>
</html>
