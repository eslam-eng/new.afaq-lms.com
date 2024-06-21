<div id="share_course_popup">
    <div class="share_to_social_media">
        {{ __('global.share_to_social_media') }}
        <i class="fa-solid fa-xmark" onclick="shareCourse()"></i>
        <div>
            <!-- Twitter -->
            <a style="color: #55acee;" href="https://twitter.com/intent/tweet?text=sna-academy&url={{ url()->current() }}"
                role="button">
                <i class="fab fa-twitter fa-lg"></i>
            </a>
            <!-- Facebook -->
            <a style="color: #3b5998;"
                href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}&quote=sna-academy"
                role="button">
                <i class="fab fa-facebook-f fa-lg"></i>
            </a>
            <!-- Whatsapp -->
            <a style="color: #25d366;" href="https://wa.me/?text=sna-academy%5Cn%20{{ url()->current() }}"
                role="button">
                <i class="fab fa-whatsapp fa-lg"></i>
            </a>
            <!-- Linkedin -->
            <a style="color: #0e76a8;" href="https://www.linkedin.com/sharing/share-offsite/?url={{ url()->current() }}"
                role="button">
                <i class="fab fa-linkedin fa-lg"></i>
            </a>
            <!-- Gmail -->
            <a style="color: #bb001b;"
                href="https://mail.google.com/mail/u/0/?view=cm&to&su=Awesome+Blog!&body=https%3A%2F%2F{{ url()->current() }}%0A&bcc&cc&fs=1&tf=1"
                role="button">
                <i class="fa-brands fa-google"></i>
            </a>
        </div>
    </div>

</div>
