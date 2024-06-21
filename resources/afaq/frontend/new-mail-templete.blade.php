<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
    <div class="home-page container"
        style="background: #dfe9ef;position: relative; padding: 0 20px 20px 20px;width: 80%;margin: 0 auto;">
        <header class="header-section" style="width: 100%; position: relative;">
            <div class="header-logo" style="width: 250px;margin: 0 auto;">
                <img src="https://afaq-lms.com/mail/imgs/Logo-Type-1v-2.png" alt="" style="width: 250px;">
            </div>
        </header>
        <main class="area-body"
            style="  position: relative; height: 300px; max-height: 300px;overflow-y: visible; background: #fff;">
            {!! $content !!}
        </main>
        <footer class="footer-page">
            <div class="afadq-dsc" style="text-align: center;">
                <p style=" color: #000;font-size: 1.5rem;">
                    We'd love to hear from you!
                </p>
                <p style=" color: #494949;font-size: 12px;">
                    Help us improve by your feedback
                </p>
            </div>
            <div class="afaq-apps " style=" padding: 20px 0;display:-webkit-box;justify-content:center;text-align: center;">
		<div style="display: flex;margin: auto;">
                <div class="app-img">
                    <img src="https://afaq-lms.com/mail/imgs/Group-2.png" alt="" style="  width: 100px; height: 40px; margin: 0 5px;">
                </div>
                <div class="app-img">
                    <img src="https://afaq-lms.com/mail/imgs/Group-1.png" alt="" style="  width: 100px; height: 40px; margin: 0 5px;">
                </div>
		</div>
            </div>
            <div class=" social" style="padding: 40px 50px 20px 50px; text-align: center;display:-webkit-box;justify-content:center;">
                <div class="afaq-social" style="display: flex;margin: auto;"">
                    <span  style=" width: 40px;height: 40px; display: inline-block; text-align: center; color: #DFE9EF; border-radius: 50%;">
                        <img src="https://afaq-lms.com/mail/imgs/facebook.png" alt="" style=" width: 40px; height: 40px;">
                    </span>
                    <span style=" width: 40px;height: 40px; display: inline-block; text-align: center; color: #DFE9EF; border-radius: 50%;">
                        <img src="https://afaq-lms.com/mail/imgs/twitter.png" alt="" style=" width: 40px; height: 40px;">
                    </span>
                    <span style=" width: 40px;height: 40px; display: inline-block; text-align: center; color: #DFE9EF; border-radius: 50%;">
                        <img src="https://afaq-lms.com/mail/imgs/linkedin.png" alt="" style=" width: 40px; height: 40px;">
                    </span>
                    <span style=" width: 40px;height: 40px; display: inline-block; text-align: center; color: #DFE9EF; border-radius: 50%;">
                        <img src="https://afaq-lms.com/mail/imgs/pinterest.png" alt="" style=" width: 40px; height: 40px;">
                    </span>
                </div>

            </div>

            <div class="afadq-dsc" style="text-align: center;">
                <p style=" color: #494949;font-size: 12px;">
                Copyright © {{date('Y')}} <a href="https://afaq-lms.com"><strong>AFAQ-LMS</strong></a> All Rights Reserved
                </p>
                <p style=" color: #494949;font-size: 12px;">
                    Support@afaq-lms.com | (+966)920035377
                </p>
            </div>
        </footer>
        {{-- <footer class="footer-page">
            <div class=" social"
                style="padding: 40px 50px 20px 50px;align-items: center; display: -webkit-box;width:100%">
                <div class="afaq-social" style="display: inline-block;">
                    <span
                        style=" width: 25px;height: 25px; display: inline-block; text-align: center; color: #dfe9ef; border-radius: 50%;">

                        <img src="https://afaq-lms.com/mail/imgs/facebook.png" alt="" style=" width: 25px; height: 25px;">
                    </span>
                    <span
                        style="width: 25px;height: 25px; display: inline-block; text-align: center; color: #dfe9ef; border-radius: 50%;">

                        <img src="https://afaq-lms.com/mail/imgs/twitter.png" alt="" style=" width: 25px; height: 25px;">
                    </span>
                    <span
                        style="width: 25px;height: 25px; display: inline-block; text-align: center; color: #dfe9ef; border-radius: 50%;">
                        <img src="https://afaq-lms.com/mail/imgs/linkedin.png" alt="" style=" width: 25px; height: 25px;">
                    </span>
                    <span
                        style="width: 25px;height: 25px; display: inline-block; text-align: center; color: #dfe9ef; border-radius: 50%;">
                        <img src="https://afaq-lms.com/mail/imgs/pinterest.png" alt="" style=" width: 25px; height: 25px;">
                    </span>
                </div>
                <div style="width: 100px;display: inline-block;"></div>
                <div class="web-site" style="display: inline-block;margin:10px;10px;">
                    <a href="https://afaq-lms.com/ar/homepage"
                        style=" color: #494949;font-size: 22px;font-weight: 600;text-decoration: none;">www.afaq-lms.com</a>
                </div>
                <div style="width: 100px;display: inline-block;"></div>

                <div class="call-afaq" style="display: inline-block;margin:10px;10px;">
                    <a href="tel:920035377" style="text-decoration: none;display: flex;align-items: center;">
                        <span
                            style="width: 25px;height: 25px; display: inline-block; text-align: center; color: #dfe9ef; border-radius: 50%;">
                            <img src="https://afaq-lms.com/mail/imgs/telephone-call2.png" alt="" style=" width: 25px; height: 25px;">
                        </span>
                        <em style=" color: #494949;font-size: 22px;font-weight: 600;font-style: normal;">920035377</em>
                    </a>
                </div>
            </div>
            <div class="afaq-small-log" style="width: 100%">
                <div class="small-logo" style="text-align: center; display: block;margin: 0 auto;">
                    <img src="https://afaq-lms.com/mail/imgs/Group30541849.png" alt=""
                        style="display: block;width: 65px; height: 60px;margin: 0 auto;">
                    <strong style=" display: block;padding: 15px 0;">AFAQ|آفاق</strong>
                </div>
            </div>
            <div class="afaq-apps "
                style=" padding: 20px 0;width: 100%; position: relative;left:100px; display: inline-block;">
                <div style="width: 500px;margin: auto auto;"></div>
                <div class="app-img" style="display: inline-block;">
                    <img src="https://afaq-lms.com/mail/imgs/Group-2.png" alt=""
                        style="  width: 160px; height: 40px; margin: 0 5px;">
                </div>
                <div class="app-img" style="display: inline-block;">
                    <img src="https://afaq-lms.com/mail/imgs/Group-1.png" alt=""
                        style="  width: 160px; height: 40px; margin: 0 5px;">
                </div>
                <div class="app-img" style="display: inline-block;">
                    <img src="https://afaq-lms.com/mail/imgs/Groghup.png" alt=""
                        style="  width: 160px; height: 40px; margin: 0 5px;">
                </div>
            </div>
            <div class="afadq-dsc" style="text-align: center;">
                <p style=" color: #494949;font-size: 12px;">
                    Incase you received this email without registering on the platform,
                    please ignore the message and do not interact with it.
                </p>
            </div>
        </footer> --}}
    </div>


</body>

</html>

