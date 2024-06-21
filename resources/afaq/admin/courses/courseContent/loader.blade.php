<script>
    let statusDivId;
    let loadDivId;
    let progressDivId;
    let input;

    function _(el) {
        return document.getElementById(el);
    }

    function uploadFile(inputId, url, inputName, statusId, loadId, progressId, token = null, type = null) {
        statusDivId = statusId;
        loadDivId = loadId;
        progressDivId = progressId;
        input = inputId;
        var file = _(inputId).files[0];
        console.log(file);
        var formdata = new FormData();
        formdata.append(`${inputName}`, file);
        formdata.append('type', type)
        if (token) {
            formdata.append('_token', token);
        }
        var ajax = new XMLHttpRequest();
        ajax.upload.addEventListener("progress", progressHandler, false);
        ajax.addEventListener("load", completeHandler, false);
        ajax.addEventListener("error", errorHandler, false);
        ajax.addEventListener("abort", abortHandler, false);
        ajax.open("POST", url);
        ajax.send(formdata);
    }

    function progressHandler(event) {
        _(loadDivId).innerHTML = "Uploaded " + event.loaded + " bytes of " + event.total;
        var percent = (event.loaded / event.total) * 100;
        _(progressDivId).value = Math.round(percent);
        _(statusDivId).innerHTML = Math.round(percent) + "% uploading... please wait";
    }

    function completeHandler(event) {
        console.log(event.target.responseText);
        _(statusDivId).innerHTML = JSON.parse(event.target.responseText).original_name;
        _('attachment-id').value = JSON.parse(event.target.responseText).name;
        if(_('attachment-id-up')){
            _('attachment-id-up').value = JSON.parse(event.target.responseText).name;
        }
        _(progressDivId).value = 0; //wil clear progress bar after successful upload

        $(document).find('input[name=file]').val('');
        $('.normal-update').removeAttr('disabled')
        $('.normal-submit').removeAttr('disabled')

    }

    function errorHandler(event) {
        _(statusDivId).innerHTML = "Upload Failed";
    }

    function abortHandler(event) {
        _(statusDivId).innerHTML = "Upload Aborted";
    }
</script>
