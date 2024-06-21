<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        #zmmtg-root, .meeting-client, .meeting-client-inner {
          width: 1000px;
          height: 500px;
          position: relative;
        }

        .zmwebsdk-makeStyles-videoCustomize-1{
            width: 98%;
            transform: translate(1%, 0px) !important;
        }

        #wc-footer {
          bottom: auto !important;
          width: 1000px !important;
        }

        #dialog-join {
          width: 1000px !important;
        }

        #sv-active-video, .active-main, #sv-active-speaker-view, .main-layout {
          height: 500px !important;
          width: 1000px !important;
        }

        .suspension-window {
          transform: translate(-444px, 10px) !important;
        }

        #dialog-invite {
          display: none;
        }

        #zmmtg-root{
            background-color: #fff !important;
        }

        .zmwebsdk-makeStyles-rootInSharing-34{
            width: 100% !important;
        }
    </style>

    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/2.10.1/css/bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/2.10.1/css/react-select.css" />
</head>

<body>
    <div class="container">
        <div id="zmmtg-root"></div>
        <div id="aria-notify-area"></div>
    </div>

    <script src="https://source.zoom.us/3.1.6/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/3.1.6/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/3.1.6/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/3.1.6/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/3.1.6/lib/vendor/lodash.min.js"></script>
    <!-- For Client View -->
    <script src="https://source.zoom.us/zoom-meeting-3.1.6.min.js"></script>
    <script src="https://source.zoom.us/zoom-meeting-embedded-3.1.6.min.js"></script>
    <!-- For Component and Client View -->

    <script>
        ZoomMtg.setZoomJSLib('https://source.zoom.us/3.1.6/lib', '/av')
        // loads WebAssembly assets
        ZoomMtg.preLoadWasm()
        ZoomMtg.prepareWebSDK()
        // loads language files, also passes any error messages to the ui
        ZoomMtg.i18n.load('en-US')
        ZoomMtg.i18n.reload('en-US')
        var CLIENT_ID = "lCdaTnEEQem4LLqeYfzibA";

        var CLIENT_SECRET = "GKl7TIOzkB76pqSbm9qJNuYtdLv4d5Vt";

        var authEndpoint = '{{ url()->full() }}'
        var sdkKey = CLIENT_ID
        var meetingNumber = '{{ $meeting_number }}'
        var passWord = "{{$zoom->password}}"
        var role = 0
        var userName = '{{ auth()->user()->full_name_en }}'
        var userEmail = '{{ auth()->user()->email }}'
        var registrantToken = ''
        var zakToken = ''
        var leaveUrl = '{{ url()->full() }}'

        var signature = '';
        const client = ZoomMtgEmbedded.createClient()

        let meetingSDKElement = document.getElementById('zmmtg-root')

        client.init({
            zoomAppRoot: meetingSDKElement,
            language: 'en-US',
            customize: {
                video: {
                    isResizable: true,
                    viewSizes: {
                        default: {
                            width: 1000,
                            height: 600
                        },
                        ribbon: {
                            width: 300,
                            height: 700
                        }
                    }
                }
            }
        })
        ZoomMtg.generateSDKSignature({
            meetingNumber: meetingNumber,
            sdkKey: CLIENT_ID,
            sdkSecret: CLIENT_SECRET,
            role: 0,
            success: function(res) {
                signature = res;
                var registrantToken = new URL('{{ $zoom->join_url }}').searchParams.get('tk')

                client.join({
                    sdkKey: sdkKey,
                    signature: signature, // role in SDK signature needs to be 0
                    meetingNumber: meetingNumber,
                    password: passWord,
                    userName: userEmail,
                    userEmail: userEmail, // userEmail property required
                    tk: registrantToken
                })
                // ZoomMtg.init({
                //     leaveUrl: leaveUrl, // https://example.com/thanks-for-joining
                //     success: (success) => {
                //         ZoomMtg.join({
                //             sdkKey: sdkKey,
                //             signature: signature, // role in SDK signature needs to be 0
                //             meetingNumber: meetingNumber,
                //             passWord: passWord,
                //             userName: userName,
                //             success: (success) => {
                //                 console.log(success)
                //             },
                //             error: (error) => {
                //                 console.log(error)
                //             }
                //         })
                //     },
                //     error: (error) => {
                //         console.log(error)
                //     }
                // })
            },
            error: (error) => {
                console.log(error)
            }
        });
    </script>

    {{-- <script>
        $(document).ready(function() {
            join();
        })
    </script>
    <script>
        function join() {

            var CLIENT_ID = "lCdaTnEEQem4LLqeYfzibA";

            var CLIENT_SECRET = "GKl7TIOzkB76pqSbm9qJNuYtdLv4d5Vt";
            var signature = '';
            ZoomMtg.generateSDKSignature({
                meetingNumber: meetingNumber,
                sdkKey: CLIENT_ID,
                sdkSecret: CLIENT_SECRET,
                role: 0,
                success: function(res) {
                    signature = res.result;

                },
            });

            console.log(signature);
            ZoomMtg.init({
                leaveUrl: leaveUrl,
                webEndpoint: authEndpoint,
                disableCORP: !window.crossOriginIsolated, // default true
                // disablePreview: false, // default false
                // externalLinkPage: './externalLinkPage.html',
                success: function() {
                    console.log("signature", signature);
                    ZoomMtg.i18n.load('en');
                    ZoomMtg.i18n.reload('en');
                    ZoomMtg.join({
                        meetingNumber: meetingNumber,
                        userName: userName,
                        signature: signature,
                        sdkKey: CLIENT_ID,
                        userEmail: userEmail,
                        passWord: null,
                        success: function(res) {
                            console.log("join meeting success");
                            console.log("get attendeelist");
                            ZoomMtg.getAttendeeslist({});
                            ZoomMtg.getCurrentUser({
                                success: function(res) {
                                    console.log("success getCurrentUser", res.result
                                        .currentUser);
                                },
                            });
                        },
                        error: function(res) {
                            console.log(res);
                        },
                    });
                },
                error: function(res) {
                    console.log(res);
                },
            });


        }
    </script> --}}

</body>

</html>
