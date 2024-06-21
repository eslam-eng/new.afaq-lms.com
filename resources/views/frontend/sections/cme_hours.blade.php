@if($course->courseAccreditation && $course->courseAccreditation->slug == 'accredited')
    <div class="cme-hours">
        <div class="cme-top d-flex">
            <img src="/nazil/imgs/cme.svg" alt="cme">
            <h2 class="stroke-double" title="{{ $course->accredit_hours }}">{{ $course->accredit_hours }}</h2>
            <p>CME HOURS</p>
        </div>
        <div class="cme-bottom">
            <p>{{ $course->accreditation_number }}</p>
        </div>
    </div>
@endif
