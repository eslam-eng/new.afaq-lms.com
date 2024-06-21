@if($course->courseAccreditation && $course->courseAccreditation->slug == 'accredited')
    <div class="cme-hours">
        <div class="cme-top d-flex">
            <img  src="/afaq/imgs/Groupkkkk.png" alt="cme">
            <h2 class="stroke-double" title="{{ $course->accredit_hours }}">{{ $course->accredit_hours }}</h2>
            <p>CME HOURS</p>
        </div>
        <div class="cme-bottom">
            <p>{{ $course->accreditation_number }}</p>
        </div>
    </div>
@elseif($course->courseAccreditation && $course->courseAccreditation->slug == 'under-accreditation')

    <div class="cme-top- d-flex">
        <img   src="{{asset('storage/'.$course->courseAccreditation->image)}}" alt="under-accreditation_cme">
    </div>
@endif
