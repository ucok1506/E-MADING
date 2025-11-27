<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Test Like Function</title>
</head>
<body>
    <h1>Test Like Function</h1>
    
    @auth
        <p>User logged in: {{ auth()->user()->name }}</p>
        <p>User ID: {{ auth()->user()->id }}</p>
        
        @php
            $mading = \App\Models\Mading::first();
        @endphp
        
        @if($mading)
            <div>
                <h2>Test dengan artikel: {{ $mading->title }}</h2>
                <p>Mading ID: {{ $mading->id }}</p>
                <p>Current likes: <span id="likes-count">{{ $mading->likesCount() }}</span></p>
                <p>Is liked: {{ $mading->isLikedBy(auth()->user()) ? 'Yes' : 'No' }}</p>
                
                <button id="like-btn" onclick="testLike({{ $mading->id }})">Toggle Like</button>
                
                <div id="debug-log" style="margin-top: 20px; padding: 10px; background: #f0f0f0;">
                    <h3>Debug Log:</h3>
                    <pre id="log-content"></pre>
                </div>
            </div>
        @else
            <p>Tidak ada artikel untuk test</p>
        @endif
    @else
        <p>Silakan <a href="{{ route('login') }}">login</a> terlebih dahulu</p>
    @endauth
    
    <script>
    function log(message) {
        const logEl = document.getElementById('log-content');
        const timestamp = new Date().toLocaleTimeString();
        logEl.textContent += `[${timestamp}] ${message}\n`;
        console.log(message);
    }
    
    function testLike(madingId) {
        log('Starting like request for mading ID: ' + madingId);
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        log('CSRF Token: ' + csrfToken.substring(0, 10) + '...');
        
        const url = `/mading/${madingId}/like`;
        log('URL: ' + url);
        
        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            log('Response status: ' + response.status);
            log('Response ok: ' + response.ok);
            
            if (!response.ok) {
                return response.text().then(text => {
                    log('Error response body: ' + text);
                    throw new Error('HTTP ' + response.status + ': ' + text);
                });
            }
            return response.json();
        })
        .then(data => {
            log('Success! Response data: ' + JSON.stringify(data));
            document.getElementById('likes-count').textContent = data.likes_count;
            alert('Like berhasil! Liked: ' + data.liked + ', Total likes: ' + data.likes_count);
        })
        .catch(error => {
            log('ERROR: ' + error.message);
            alert('Error: ' + error.message);
        });
    }
    </script>
</body>
</html>
