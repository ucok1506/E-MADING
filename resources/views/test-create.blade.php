<!DOCTYPE html>
<html>
<head>
    <title>Test Create</title>
</head>
<body>
    <h1>Test Create Page</h1>
    <p>User: {{ auth()->check() ? auth()->user()->nama : 'Not logged in' }}</p>
    <p>Role: {{ auth()->check() ? auth()->user()->role : 'No role' }}</p>
    <p>Categories: {{ \App\Models\Kategori::count() }}</p>
</body>
</html>