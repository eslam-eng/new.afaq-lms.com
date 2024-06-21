
<style>
    section.generat-card {
        width: 100%;
        height: 60vh;
        background: #f1f1f1;
        border-radius: 10px;
        align-items: center;
        display: flex;
        justify-content: center;
        position: relative;
        bottom: 33px;
        box-shadow: 0px 4px 13px #020202a8;
    }
    .bg-card a i {
        margin: 0 10px;
    }
    .bg-card a {
        font-size: 20px;
        font-weight: bold;
        padding: 10px 35px;
        border-radius: 10px;
        background: #88bd2f;
        color: #fff !important;
        box-shadow: 0px 5px 12px #00000078;
    }
</style>

<section class="generat-card">

    <div class="bg-card">
        <a
            href="{{ route('admin.get_attendance_design', ['locale' => app()->getLocale(), 'course_id' => $oneCourse->id,
 'attendance_design_id' => $oneCourse->attendance_design->attendance_design_id,
 'lecture_id' => $lect->id]) }}">
            Generate Card  <i class="fas fa-id-card"></i> </a>
    </div>

</section>
