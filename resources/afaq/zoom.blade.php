<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/2.13/css/bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/2.13/css/react-select.css" />
<style>
    div#zmmtg-root {
    width: 80% !important;
    height: 80% !important;
    top: 40px;
    left: calc(50% - 40%);
    border-radius: 6px;
}
</style>
</head>

<body>
    <!-- added on import -->
    <div id="zmmtg-root"></div>
    <div id="aria-notify-area"></div>
    <!-- added on meeting init -->
    <div class="ReactModalPortal"></div>
    <div class="ReactModalPortal"></div>
    <div class="ReactModalPortal"></div>
    <div class="ReactModalPortal"></div>
    <div class="global-pop-up-box"></div>
    <div class="sharer-controlbar-container sharer-controlbar-container--hidden"></div>

    <!-- Dependencies for client view and component view -->
    <script src="https://source.zoom.us/2.13/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/2.13/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/2.13/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/2.13/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/2.13/lib/vendor/lodash.min.js"></script>

    <!-- Choose between the client view or component view: -->

    <!-- CDN for client view -->
    <script src="https://source.zoom.us/zoom-meeting-2.13.min.js"></script>

    <!-- CDN for component view -->
    <script src="https://source.zoom.us/zoom-meeting-embedded-2.13.min.js"></script>
    <script>
        ZoomMtg.init({
            leaveUrl: leaveUrl, // https://example.com/thanks-for-joining
            success: (success) => {
                ZoomMtg.join({
                    sdkKey: "{{ env('ZOOM_API_KEY') }}",
                    signature: 1, // role in SDK signature needs to be 1
                    meetingNumber: meetingNumber,
                    passWord: passWord,
                    userName: userName,
                    zak: zakToken, // the host's ZAK token
                    success: (success) => {
                        console.log(success)
                    },
                    error: (error) => {
                        console.log(error)
                    }
                })
            },
            error: (error) => {
                console.log(error)
            }
        })
    </script>
</body>

</html>
