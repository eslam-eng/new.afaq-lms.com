/*=========================================================================================
    File Name: wizard-steps.js
    Description: wizard steps page specific js
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

// Wizard tabs with icons setup
$(".icons-tab-steps").steps({
    headerTag: "h6",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: {
        finish: 'Submit'
    },
    onFinished: function (event, currentIndex) {
        // alert("Form submitted.");
        $('#course_form').submit()

    }
});

// Validate steps wizard

// Show form
var form = $(".steps-validation").show();

$(".steps-validation").steps({
    headerTag: "h6",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: {
        finish: 'Submit'
    },
    onStepChanging: function (event, currentIndex, newIndex) {
        if ($(this).parsley().isValid(`step-${currentIndex + 1}`)) {
            return true;
        } else {
            $(this).parsley().validate(`step-${currentIndex + 1}`);
        }

        // Allways allow previous action even if the current form is not valid!
        if (currentIndex > newIndex) {
            return true;
        }

        // Needed in some cases if the user went back (clean up)
        if (currentIndex < newIndex) {
            // To remove error styles
            form.find(".body:eq(" + newIndex + ") label.error").remove();
            form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
        }
        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
    onFinishing: function (event, currentIndex) {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
    onFinished: function (event, currentIndex) {
        alert("Submitted!");
    }
});

// Initialize validation
$(".steps-validation").validate({
    ignore: 'input[type=hidden]', // ignore hidden fields
    errorClass: 'danger',
    successClass: 'success',
    highlight: function (element, errorClass) {
        $(element).removeClass(errorClass);
    },
    unhighlight: function (element, errorClass) {
        $(element).removeClass(errorClass);
    },
    errorPlacement: function (error, element) {
        error.insertAfter(element);
    },
    rules: {
        email: {
            email: true
        }
    }
});

window.Parsley.addValidator('maxFileSize', {
    validateString: function (_value, maxSize, parsleyInstance) {
        if (!window.FormData) {
            alert('You are making all developpers in the world cringe. Upgrade your browser!');
            return true;
        }
        var files = parsleyInstance.$element[0].files;
        return files.length != 1 || files[0].size <= maxSize * 1024;
    },
    requirementType: 'integer',
    messages: {
        en: 'This file should not be larger than %s Kb',
        fr: 'Ce fichier est plus grand que %s Kb.'
    }
});

window.Parsley.addValidator('mindate', {
    validateString: function (value, requirement) {
        if (!window.FormData) {
            alert('You are making all developpers in the world cringe. Upgrade your browser!');
            return true;
        }
        // is valid date?
        var timestamp = Date.parse(value),
            minTs = Date.parse(requirement);

        return isNaN(timestamp) ? false : timestamp > minTs;

    },
    requirementType: 'string',
    messages: {
        en: 'This date should be greater than %s',
    }
});

// Parsley custom validation
window.Parsley.addValidator('filemimetypes', {
    requirementType: 'string',
    validateString: function (value, requirement, parsleyInstance) {

        var file = parsleyInstance.$element[0].files;

        if (file.length == 0) {
            return true;
        }

        var allowedMimeTypes = requirement.replace(/\s/g, "").split(',');
        return allowedMimeTypes.indexOf(file[0].type) !== -1;

    },
    messages: {
        en: 'File mime type not allowed',
        ar: 'هذا النوع من الملفات غير مقبول'
    }
});
