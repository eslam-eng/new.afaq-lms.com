@extends('frontend.personalInfos.index')

@section('myprofile')

<section class="idu-programss">
   <div class="container sit-container">
      <div class="all-courses">
         <div class="container">
            <div class="row course-title">
               <h1> {{__('lms.my_courses')}}</h1>
            </div>

            @if($courses)
            <div class="row">
               <div class="col-lg-12">
                  <div class="allcourses-vertical open-box" style="padding-bottom: 100px;">
                     @foreach($courses as $course)
                        @include('frontend.partials.course-card',['course' => $course])
                     @endforeach
                  </div>
               </div>
            </div>
            @endif
            @if($courses)
            <div class="p-5">
               {!! $courses->links('vendor.pagination.bootstrap-4') !!}
            </div>
            @endif
         </div>
      </div>
   </div>
</section>

@endsection

@section('scripts')
<script>
   $('select').on('change', function(e) {
      var url = window.location.href;
      var item = $(this).attr('name');
      var value = $('#' + item).val();
      url = updateQueryStringParameter(url, item, value);
      window.location = url;
   });

   // $('#text').on('change', function(e) {
   //    var url = window.location.href;
   //    var item = $(this).attr('name');
   //    var value = $('#' + item).val();
   //    url = updateQueryStringParameter(url, item, value);
   //    window.location = url;
   // });

   $('.filter').on('click', function(e) {
      cleanUrl();
      var url = window.location.href;
      var item = $(this).attr('name');
      var value = $(this).attr('value');
      url = updateQueryStringParameter(url, item, value);
      window.location = url;
   });

   $('.btn_filter').on('click', function(e) {
      var item = $('#text').attr('name');
      var value = $('#text').val();
      if (value != '') {
         cleanUrl();
         var url = window.location.href;
         url = updateQueryStringParameter(url, item, value);
         window.location = url;
      } else {
         alert('please, type text in search box ...')
      }
   });
</script>
@endsection
