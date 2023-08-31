<!DOCTYPE html>
<html>
<head>
    <title>CSV File Upload</title>
</head>
<body>
    <h1>CSV File Upload</h1>
    
    @if(session('message'))
        <p>{{ session('message') }}</p>
    @endif

    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="csv_file">
        <button type="submit">Upload CSV</button>
    </form>
</body>
</html>
