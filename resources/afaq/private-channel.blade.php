<html>
<head>
    <title>Private Channel Example</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
</head>
<body>
    <h1>Private Channel Example</h1>
    <div id="messages"></div>

    <script>
        $(document).ready(function () {
            var pusher = new Pusher('c4f989bb80e6cca43991', {
                cluster: 'eu',
                authEndpoint: '/broadcasting/auth',
                headers: {
                    "Authorization": "Bearer TOKEN", // No need to include the access token here
                },
            });

            var channel = pusher.subscribe('private-popup-channel');
            // channel.bind('pusher:subscription_succeeded', function () {
            //     console.log('Subscription succeeded');
            // });
            // channel.bind('user-register', function (data) {
            //     alert('ffff');
            //     // $('#messages').append('<p>' + data.message + '</p>');
            // });

            channel.bind('Illuminate\Notifications\Events\BroadcastNotificationCreated', function (data) {
                alert('fffhjhjhjf');
                // $('#messages').append('<p>' + data.message + '</p>');
            });
        });
`
        
    </script>
</body>
</html>