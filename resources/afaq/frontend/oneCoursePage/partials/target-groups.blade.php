@if (count($oneCourse->course_target_group))
    <div class="target_groups">
        <h4>
            {{ __('global.target_groups') }}
        </h4>
        <ul class="target_list d-flex flex-row">
            @foreach ($oneCourse->course_target_group as $target_group)
                <li>
                    <span class="material-symbols-outlined">
                        arrow_back
                    </span>
                    {{ app()->getLocale() == 'en' ? $target_group->name_en : $target_group->name_ar }}
                </li>
            @endforeach
        </ul>
    </div>
@endif
