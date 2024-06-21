<?php

return [
    'accepted'         => 'يجب قبول  :attribute.',
    'active_url'       => 'هذا  :attribute  ليس رابط صالحا.',
    'after'            => 'يجب أن يكون :attribute تاريخا بعد :date.',
    'after_or_equal'   => 'يجب أن يكون :attribute تاريخا بعد أو يساوي :date.',
    'alpha'            => 'قد يحتوي :attribute على أحرف فقط.',
    'alpha_dash'       => 'قد تحتوي ال :attribute  على أحرف وأرقام وشرطات فقط.',
    'alpha_num'        => 'قد تحتوي ال :attribute  على أحرف وأرقام  فقط.',
    'latin'            => ':attribute قد تحتوي فقط على أحرف أبجدية لاتينية أساسية ISO.',
    'latin_dash_space' => ':attribute  قد تحتوي فقط ISO الأساسية الأبجدية اللاتينية الحروف والأرقام، شرطات، الواصلات والمسافات.',
    'array'            => ':attribute  يجب ان تكون مصفوفة',
    'before'           => 'يجب أن يكون :attribute تاريخا قبل :date.',
    'before_or_equal'  => 'يجب أن يكون :attribute تاريخا قبل أو يساوي :date.',
    'between'          => [
        'numeric' => 'يجب أن يكون :attribute بين  :min و  :max  .',
        'file'    => 'يجب أن يكون :attribute بين  :min و  :max  كيلو بايت.',
        'string'  => 'يجب أن يكون :attribute بين  :min و  :max  حرف.',
        'array'   => 'يجب أن يكون :attribute بين  :min و  :max  نوع.',
    ],
    'boolean'        => 'يجب أن يكون :attribute صح او خطأ',
    'confirmed'      => 'تأكيد :attribute لا يطابق.',
    'date'           => ':attribute  ليست تاريخا صالحا.',
    'date_equals'    => ':attribute يجب ان تكون مساوية ل  :date.',
    'date_format'    => ':attribute لايتطابق مع الصيغة :format.',
    'different'      => 'يجب أن يختلف  :attribute عن :الاخرين.',
    'digits'         => 'هذا :attribute يجب ان يكون :digits ارقام.',
    'digits_between' => 'هذايجب ان يكون بين :min و :max ارقام.',
    'dimensions'     => 'هذه :attribute ذات ابعاد خاطئة.',
    'distinct'       => 'هذا :attribute الحقل موجود مسبقا',
    'email'          => 'هذا :attribute يجب ان يكون بريد الكتروني صالح',
    'ends_with'      => ':attribute يجب أن ينتهي بواحد مما يلي: :قيم.',
    'exists'         => 'الحقل المختار :attribute غير صالح',
    'file'           => 'هذا :attribute يجب ان يكون ملف',
    'filled'         => 'هذا :attribute الحقل مطلوب.',
    'gt'             => [
        'numeric' => 'يجب أن يكون :attribute أكبر من :value  .',
        'file'    => 'يجب أن يكون :attribute أكبر من :value كيلوبايت.',
        'string'  => 'يجب أن يكون :attribute أكبر من :value  .',
        'array'   => 'يجب أن يحتوي :attribute على أكثر من: value عناصر .',
    ],
    'gte' => [
        'numeric' => ':attribute يجب أن يكون أكبر من أو يساوي  :value.',
        'file'    => ':attribute يجب أن يكون أكبر من أو يساوي  :value كيلوبايت.',
        'string'  => ':attribute يجب أن يكون أكبر من أو يساوي :value احرف.',
        'array'   => ':attribute يجب ان يملك  :value من العناصر أو أكثر.',
    ],
    'image'    => 'ال :attribute يجب ان تكون صورة',
    'in'       => 'قيمة  :attribute المختارة غير صالحة.',
    'in_array' => 'حقل :attribute غير موجود فى :other.',
    'integer'  => 'حقل :attribute يجب ان يكون رقم.',
    'ip'       => ':attribute يجب ان يكون عنوان IP صالح.',
    'ipv4'     => ':attribute يجب أن يكون عنوان IPv4 صالحًا .',
    'ipv6'     => ':attribute يجب أن يكون عنوان IPv6 صالحًا .',
    'json'     => ':attribute  يجب ان يكون في صيغة  JSON.',
    'lt'       => [
        'numeric' => ':attribute  يجب أن يكون أقل من  :value.',
        'file'    => ':attribute  يجب أن يكون أقل من :value كيلوبايت.',
        'string'  => ':attribute  يجب أن يكون أقل من  :value احرف.',
        'array'   => ':attribute يجب أن يكون أقل من  :value العناصر.',
    ],
    'lte' => [
        'numeric' => ':attribute يجب أن يكون أصغر من أو يساوي  :value.',
        'file'    => ':attribute يجب أن يكون أصغر من أو يساوي  :value كيلوبايت.',
        'string'  => ':attribute يجب أن يكون أصغر من أو يساوي  :value احرف.',
        'array'   => ':attribute يجب ألا يحتوي على أكثر من  :value العناصر.',
    ],
    'max' => [
        'numeric' => ':attribute  قد لا يكون أكبر من  :max.',
        'file'    => ':attribute قد لا يكون أكبر من  :max كيلوبايت.',
        'string'  => ':attribute  قد لا يكون أكبر من  :max احرف.',
        'array'   => ':attribute قد لا يكون أكثر من  :max العناصر.',
    ],
    'mimes'     => ':attribute يجب أن يكون ملف  type: :values.',
    'mimetypes' => ':attribute يجب أن يكون ملف  type: :values.',
    'min'       => [
        'numeric' => ':attribute لا بد أن يكون على الأقل  :min.',
        'file'    => ':attribute لا بد أن يكون على الأقل :min كيلوبايت.',
        'string'  => ':attribute لا بد أن يكون على الأقل :min احرف.',
        'array'   => ':attribute يجب أن يكون على الأقل  :min items.',
    ],
    'not_in'               => 'المختار :attribute غير صالح .',
    'not_regex'            => ':attribute شكل غير صالح.',
    'numeric'              => ':attribute يجب أن يكون رقما.',
    'password'             => 'كلمة مرور خاطئة',
    'present'              => ':attribute يجب أن يكون الحقل الحالي.',
    'regex'                => ':attribute التنسيق غير صالح.',
    'required'             => 'حقل :attribute مطلوب',
    'required_if'          => ':attribute الحقل مطلوب عندما  :other يكون :value.',
    'required_unless'      => ':attribute الحقل مطلوب ما لم يكن :other في داخل  :values.',
    'required_with'        => ':attribute الحقل مطلوب عندما  :values حاضر.',
    'required_with_all'    => ':attribute الحقل مطلوب عندما :values حاضر.',
    'required_without'     => ':attribute الحقل مطلوب عندما :values غير موجود.',
    'required_without_all' => ':attribute الحقل مطلوبًا في حالة عدم وجود أي من  :values حاضر.',
    'same'                 => ':attribute و :other يجب أن تتطابق.',
    'size'                 => [
        'numeric' => ':attribute يجب أن يكون  :size.',
        'file'    => ':attribute يجب أن يكون  :size كيلوبايت.',
        'string'  => ':attribute يجب أن يكون  :size احرف.',
        'array'   => ':attribute يجب أن يحتوي على :size العناصر.',
    ],
    'starts_with' => ':attribute يجب أن تبدأ بأحد  following: :values.',
    'string'      => ':attribute يجب ان يكون احرف',
    'timezone'    => ':attribute يجب أن تكون منطقة صالحة.',
    'unique'      => ':attribute مأخوذ من قبل',
    'uploaded'    => 'فشل التحميل :attribute .',
    'url'         => ':attribute نوعة غير صحيح',
    'uuid'        => ':attribute يجب أن يكون UUID صالحًا.',
    'custom'      => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],
    'reserved_word'                  => ':attribute  يحتوي على كلمة محجوزة',
    'dont_allow_first_letter_number' => 'حقل الادخال \":input\" لايمكن ان يكون اول خانة رقم',
    'exceeds_maximum_number'         => 'ال :attribute وصل الحد الاقصى للمودل',
    'db_column'                      => 'ال :attribute يمكن ان يحتوى فقط على ترميز الايزو للاحراف اللاتينية وارقام وعلامة الداش ولايمكن ان يبدأ برقم',
    'attributes'                     => [


                'name'                     => 'الاسم',

                'email'                    => 'البريد الإليكتروني ',

                'email_verified_at'        => 'تم التفعيل في ',

                'password'                 => 'كلمة المرور',

                'roles'                    => 'الاشتراطات',

                'remember_token'           => 'تذكر الرمز',

                'created_at'        => 'أنشئت في',

                'updated_at'        => 'تم التحديث في',

                'deleted_at'        => 'تم الحذف في',

                'program'                  => 'البرنامج',

                'approved'                  => 'الحالة',

                'verified'                  => 'مفعل',

                'verified_at'               => 'تم التفعيل في ',

                'verification_token'        => 'توكن التفعيل',


                'last_name'                 => 'الاسم الاخير',

                'full_name_en'              => 'الاسم باللغة الانجليزية المكتوب في الهويه / الباسبور',

                'full_name_ar'              => 'الاسم باللغة العربية المكتوب في الهويه / الباسبور(لو متاح )',

                'personal_photo'            => 'الصورة الشخصية',

                'national'                  => 'جواز السفر او الهوية',

                'id_photo'                  => 'صورة جواز السفر او الهوية',

                'birth_date'                => 'تاريخ الميلاد',

                'phone'                     => 'رقم الهاتف (يرجى إضافة رمز الدولة)',
                'phone_helper'              => '(يرجى إضافة رمز الدولة)',
                'birth_country'             => 'بلد الميلاد',

                'country'                   => 'بلد الإقامة',
                'country2'                  => 'الدولة',
                'nationality'               => 'الجنسية',

                'state'                     => 'مكان الإقامة',

                'linkedin'                  => 'رابط ملف تعريف LinkedIn (إن وجد)',

                'undergraduate'             => 'مجال دراستك الجامعية',

                'degree'                    => 'أحدث درجتك التعليمية',

                'degree_photo'              => 'صورة المؤهل',

                'certificates'              => 'صورة (صور) الشهادات الأخرى (إن وجدت)',

                'cv'                        => 'السيرة الذاتية (إن وجدت)',

                'personal_statement'        => 'بيان شخصي',

               // 'date' => 'التاريخ ',
                'know_us'                   => 'كيف عرفت عنا؟',

                'installment'            => 'يوجد تقسيط ',





                'name_helper'           => 'الرجاء إدخال اسم المحاضرة الذي سيظهر أثناء التقديم',
                'date'                  => 'تاريخ المحاضرة',

                'time'                  => 'وقت المحاضرة',

                'instructor'            => 'اسم المدرب',

                'price_forign'          => 'سعر الأجانب',
                'price_forign_helper'   => 'هذا هو الثمن الذي سيدفعه كل الأجانب',
                'price_egyption'        => 'السعر للمصريين',
                'price_egyption_helper' => 'هذا هو الثمن الذي سيدفعه المصريين',
                'description'           => 'الوصف',
                'description_helper'    => 'هذا الحقل اختياري إذا أردنا تقديم مزيد من التفاصيل',



            'title'          => 'المتدربين',
            'title_singular' => 'متدرب',
            'binding'      => 'قيد الانتظار',
            'Unchecked'    => 'متقدم جديد',
            'withdrawal'   => 'منسحب',

            'disapproved'  => 'تم الرفض',
            'Unverified'   => 'غير مفعل',



                'alert_text'        => 'نص تنبيه',
                'alert_link'        => 'لينك التنبيه',
                'user'              => 'المستخدمين',


                'id'                => 'الرقم التعريفي',

                'category'          => 'فئة',

                'question'          => 'السؤال',
                'question_helper'   => ' ',
                'answer'            => 'الاجابة',
                'answer_helper'     => ' ',
                'transaction'              => 'العملية',
                'transaction_helper'       => ' ',
                'session_indicator'        => 'مؤشر الدورة',
                'session_indicator_helper' => ' ',
                'amount'                   => 'القيمة',
                'amount_helper'            => ' ',
                'status'                   => 'الحالة',
                'status_helper'            => ' ',

                'fullresponse'             => 'الرد الكامل',
                'fullresponse_helper'      => ' ',
                'currency'                 => 'العملة',
                'currency_helper'          => ' ',

                'lecture'  => 'المحاضرة ',
                'programme'  => 'البرنامج التدريبي ',



                'slug'                  => 'الاسم المميز',
                'list'                  => 'قائمة البريد الإلكتروني للنظام',
                'subject'               => 'الموضوع',
                'subject_helper'           => 'موضوع البريد الإلكتروني',
                'price'             => 'السعر',
                'price_helper'      => ' ',
                'active'            => 'الحالة',
                'active_helper'     => ' ',








                'title_ar'                 => 'العنوان للعربي',

                'tag'                   => 'العلامات',
                'page_text'             => 'النص الكامل ',
                'excerpt'               => 'مقتطفات',

                'featured_image'        => 'صورة مميزة',

                'show_in_menu'              => 'عرض في القائمة',




                'name_en'           => 'الاسم باللغة الانجليزية',
                'name_en_helper'    => ' ',
                'name_ar'           => 'الاسم باللغة العربية',
                'name_ar_helper'    => ' ',
                'link'              => 'اللينك',
                'link_helper'       => ' ',
                'is_parent'         => 'Is head title',
                'is_parent_helper'  => ' ',



                'title_helper'      => 'فقط لوضع علامة على شريط التمرير',
                'content_ar'        => 'المحتوى العربي',
                'content_ar_helper' => 'ضع محتوي البانر الدعائي هنا',
                'content_en'        => 'المحتوى الانجليزي',
                'content_en_helper' => 'ضع المحتوى الإنجليزي لشريط التمرير هنا',






                'title_en'              => 'المسمى الوظيفي باللغة الانجليزية',
                'description_ar'        => 'الوصف باللغة العربية',
                'description_en'        => 'الاسم باللغة الانجليزية',
                'image'                 => 'الصورة الشخصية',

                'department'          => 'القسم ',


                'message'           => 'الرسالة',



                'author'                => 'مؤلف',
                'author_helper'         => 'اكتب اسم المؤلف هنا',

                'page_text_ar'          => 'النص بالكامل بالعربي',
                'excerpt_ar'            => 'مقطتفات بالعربي',



                'blog'              => 'المدونة',

                'comment'           => 'التعليق',

                'responsibilities'        => ' الواجبات والمسؤوليات',
                'responsibilities_helper' => ' ',
                'requirements'            => 'متطلبات',
                'requirements_helper'     => ' ',


                'job'                              => 'الوظيفة',
                'job_helper'                       => ' ',

                'first_name'                       => 'الاسم الاول',

                'middle_name'                      => 'الاسم الاوسط',

                'street_address'                   => 'عنوان الشارع',
                'city'                             => 'المدينة',
                'post_code'                        => 'الرمز البريدي',
                'email_address'                    => 'عنوان البريد الالكتروني',
                'phone_number_1'                   => 'رقم الهاتف 1',
                'phone_number_2'                   => 'رقم الهاتف 2',
                'linked_in_profile'                => 'ملف لينكد إن',
                'highest_degree'                   => 'تم الحصول على أعلى مستوى درجة',
                'field_of_study'                   => 'مجال الدراسة',
                'institute'                        => 'المعهد/ الجامعة',
              //  'country'                          => 'الدولة',

                'start_date'                       => 'تاريخ البدأ',
                'end_date'                         => 'تاريخ الانتهاء',
                'high_school_name'                 => 'اسم المدرسة الثانوية',
                'certificate_type'                 => 'نوع الشهادة',
                'grade'                            => 'التقدير',
                'comments'                         => 'التعليقات',
                'history_title'                    => 'عنوان السجلات',
                'history_type_of_institute'        => 'سجل نوع المعهد',
                'history_city'                     => 'سجل المدينة',
                'history_country'                  => 'سجل الدولة',
                'history_start_date'               => 'تاريخ بدا السجل',
                'history_end_date'                 => 'تاريخ انتهاء السجل',
                'history_reason_of_leaving'        => 'سجل سبب المغادرة',
                'current_notice_period'            => 'فترة الإشعار الحالية',

                'best_candidate'                   => 'اشرح لماذا تعتقد أنك أفضل مرشح لهذه الوظيفة',
//                'cv'                               => 'تحميل المستندات (السيرة الذاتية ، خطاب التقديم ، الشهادات ، أي مستندات ذات صلة) في Word ، PDF ، JPG ، Excel.',
//                'nationality'                      => 'الجنسية',
                'race'                             => 'السلالة',
                'age_groups'                       => 'الفئات العمرية',
                'gender'                           => 'الجنس',
                'religion'                         => 'الديانة',
                'disability'                       => 'عجز',
                'disability_yes'                   => 'إذا كانت الإجابة بنعم ، إذا تمت دعوتك لإجراء مقابلة ، فهل هناك أي استعدادات لازمة؟ " نعم أم لا ، إذا كانت الإجابة نعم - يرجى التحديد',




                'link_en'               => 'اللينك للغه الانجليزية',
                'link_ar'               => 'اللينك للغه العربية',

                'image_ar'              => 'الصورة للعربي',








                'text_en'              => 'العنوان باللغه الانجليزية',
                'text_ar'              => 'العنوان باللغه العربية',


                'icon'                  => 'الايقون',



                'mobile'            => 'رقم الهاتف',


                'mail'              => 'البريد الاكتروني',




                'moodle'                                         => 'Moodle / الموودل',
//
                'early_register_date'                                     => 'تاريخ الحجز المبكر',

                'image_title_en'                                 => 'عنوان الصورة باللغه الانجليزية',
                'image_title_ar'                                 => 'عنوان الصورة باللغه العربية',
                'offer_type'                                     => 'نوع العرض',
                'pop_description'                                => 'Pop توصيف',

                'introduction_to_course_en'                      => 'مقدمة الى الدورة باللغه  الانجليزية',
                'introduction_to_course_ar'                      => 'مقدمة الى الدورة باللغه العربية',
                'certificate_price'                              => 'سعر الشهادة',
                'accreditation_number'                           => 'رقم الاعتماد الاكاديمي',
                'start_register_date'                            => 'تاريخ بدأ التسجيل',
                'end_register_date'                              => 'تاريخ انتهاء التسجيل',
                'course_place'                                   => 'مكان  انعقادرالدورة',
                'training_type'                                  => 'نوع التدريب',
                'lecture_hours'                                  => 'عدد ساعات المحاضرات',
                'seating_number'                                 => 'عدد المقاعد',
                'accreditation'                                  => 'معتمدة من',
                'course_sub_specialty'                           => 'التخصص الفرعي للدورة',
                'member_price'                                   => 'السعر للاعضاء',

                'non_member_price'                               => 'السعر لغير الاعضاء',

                'course_accreditation_sponsor'                   => 'معتمدة من',
                'cooperate_accreditation_sponsor'                => 'بالتعاون مع',
                'hosting_cooperate_accreditation_sponsor'        => 'الاستضافة من ',
                'target_group'                                   => 'الفئة المستهدفة',
                'location'                                   => 'الموقع',
                'show_in_homepage'                                   => 'إظهار في الصفحة الرئيسية',
                'course_sub_specialty_id'                           => 'التخصص الفرعي للدورة',
                'zoom_link'                                      => 'لينك الزوم',
                'certificate'                                      => 'الشهادات المعتمدة',


                'early_price' => "سعر الحجز المبكر",
                'late_price' => "سعر الحجز المتآخر",








                'specialty'         => 'التخصص الصحي',



                'coupon_text'               => 'اسم الكوبون',
                'coupon_type'               => 'نوع الكوبون',
                'coupon_amount'             => 'نسبة / خصم الكوبون',
                'coupon_expire_date'        => 'تاريخ انتهاء الكوبون',

                'course'                => 'اسم الدورة التدريبية',

                'key'               => 'المفتاح',

                'logo'              => 'اللوجو',

                'country_en_name'               => 'اسم البلد باللغة الانجليزية',
                'country_ar_name'               => 'اسم البلد باللغه العربية',
                'country_en_nationality'        => 'اسم الدولة باللغه الانجليزية',

                'country_ar_nationality'        => 'اسم الدوله باللغه العربية',

                'order'                         => 'الترتيب',






                'membership_type'        => 'نوع العضوية',

                'time_type'              => 'مدة العضوية',


                'subscribtion_count'     => 'عدد الاشتراكات',




                'member_type'                 => 'نوع العضوية',


                'file'                        => 'المرفق',






                'templete'          => 'قالب',





                'exam_title'            => 'عنوان الاختبار',

                'correct_answer'        => 'هل الاجابة الصحيحة',

                'Master'        => 'الاجابة الصحيحة',





                'tips_guidelines'           => 'الملاحظات والنقاط الهامة',

                'success_percentage'        => 'نسبة لانجاح',


                'start_at'                  => 'يبدأ في ',

                'end_at'                    => 'ينتهي في',






                'days'              => 'Days',
                'days_helper'       => ' ',



                'user_name'              => 'اسم المستخدم',
                'user_name_helper'       => ' ',
                'payment_number'         => 'رقم العملية الدفع',
                'payment_number_helper'  => ' ',

                'payments_number'        => 'رقم علمية الدفع',
                'payments_number_helper' => ' ',

                'offer'                  => 'الخصم',
                'offer_helper'           => ' ',
                'final_price'            => 'السعر النهائي',
                'final_price_helper'     => ' ',

                'payment_details'                  => 'بيانات الدفع',
                'payment_details_helper'           => ' ',



                'enrolled_at'            => 'Enrolled At',
                'enrolled_at_helper'     => ' ',
                'coupon'                 => 'Coupon',
                'coupon_helper'          => ' ',
                'coupon_discount'        => 'Coupon Discount',
                'coupon_discount_helper' => ' ',
                'final_total'            => 'Final Total',
                'final_total_helper'     => ' ',

                'enroll_payments'             => 'مدفوعات الالتحاق ',



                'headers'                  => 'Headers',
                'headers_helper'           => ' ',
                'topic'                    => 'Topic',
                'topic_helper'             => ' ',
                'start_time'               => 'Start Time',
                'start_time_helper'        => ' ',
                'duration'                 => 'Duration',
                'duration_helper'          => ' ',
                'agenda'                   => 'Agenda',
                'agenda_helper'            => ' ',
                'host_video'               => 'Host Video',
                'host_video_helper'        => ' ',
                'participant_video'        => 'Participant Video',
                'participant_video_helper' => ' ',
                'waiting_room'             => 'Waiting Room',
                'waiting_room_helper'      => ' ',


                'default_password'         => 'Default Password',
                'default_password_helper'  => ' ',
                'type'                     => 'Meeting_Type',
                'type_helper'              => ' ',
                'audio'                    => 'Audio',
                'audio_helper'             => ' ',
                'auto_recording'           => 'Auto Recording',
                'auto_recording_helper'    => ' ',
                'alternative_hosts'        => 'Alternative Hosts',
                'alternative_hosts_helper' => ' ',
                'mute_upon_entry'          => 'Mute Upon Entry',
                'mute_upon_entry_helper'   => ' ',
                'watermark'                => 'Watermark',
                'watermark_helper'         => ' ',
                'start_url'                  => 'Start URL',
                'start_url_helper'              => ' ',
                'join_url'                  => 'Join URL',
                'join_url_helper'                  => ' ',


        'ticket_category_id'                  => 'ticket_category_id ',
        'user_id'                  => 'user_id ',



    ],
];
