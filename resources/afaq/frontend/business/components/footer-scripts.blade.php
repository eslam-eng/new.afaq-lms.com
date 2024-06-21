    <!-- ***************** all script ************************************** -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
{{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>--}}
    <script src="{{ asset('afaq/new-assets/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('afaq/new-assets/jquery3.7.0.js') }}"></script>
    <!-- ******************* Business Special request your event js ********************* -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>
    <script src="{{ asset('afaq/business/js/specialRequest.js') }}"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.5.0/jquery.flexslider.min.js"
            integrity="sha512-M3wq5WV8hxDfr57VnaB8R3j7TK1dTBwwTWCemilGC1b1bk447mxw8v7t0ImJ0z4pfRVlVcwODbkQbkWiCQGh0w=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('afaq/new-assets/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('afaq/business/js/main.js') }}"></script>

    <script>
        function get_sub_specialists(selected = null) {
            var id = $('#specialty_id').val();
            console.log(id);
            if (id) {
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/{{ app()->getLocale() }}/get_specialty/' + id,
                    success: function(data) {
                        var subuser = `
                <select class=" sub_specialty_id"  name="sub_specialty_id" id="sub_specialty_id" required>
                `;
                        for (let index = 0; index < data.length; index++) {
                            const element = data[index];
                            subuser += `<option value="` + element.id +
                                `" ${selected == element.id ? 'selected' : ''}>` + element.name + `</option>`
                        }

                        subuser += `</select>`;
                        $('.sub_specialty_id').remove();
                        $('#subs').append(subuser);
                        $('#subs').show();

                    }
                });
            }

            switch (id) {
                case '9':
                    $('.occupational_classification_number').hide();
                    $('#occupational_classification_number').val('');
                    $('#occupational_classification_number').prop('required', false);
                    break;
                case '10':
                    $('.occupational_classification_number').hide();
                    $('#occupational_classification_number').val('');
                    $('#occupational_classification_number').prop('required', false);
                    break;

                default:
                    $('.occupational_classification_number').show();
                    $('#occupational_classification_number').prop('required', true);
                    break;
            }
        }

        @if (old('specialty_id'))
        get_sub_specialists({{ old('sub_specialty_id') ?? null }})
        @endif


    </script>
