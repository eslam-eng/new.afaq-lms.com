
Pusher.logToConsole = true;

var pusher = new Pusher('c4f989bb80e6cca43991', {
    cluster: 'eu',
    debug: true
});

var channel = pusher.subscribe('notification');

channel.bind('user-register', function (data) {
    toastr.options.timeOut = 50000;
    toastr.info(data.data.message);
    // var result = $('..notifcations-btn .numb-notifc').map(function() {
    //     return $(this).text();
    //   }).get().join('') + '1';
      
      toastr.info(result); // Output the result
    // toastr.info(JSON.stringify(data));
});

