<?php

return [
    // uploads, spaces
    'upload_disk' => 'spaces',
    'filePath' => [
        'small'         => '/uploads/files/small/',
        'medium'        => '/uploads/files/medium/',
        'large'         => '/uploads/files/large/',
        'original'      => '/uploads/files/original/',
        'default'       => 'uploads/files/default/default-image.png',
        'default_user'  => 'uploads/files/default/default-user-icon.png',
        'default-image' => 'uploads/files/default/default-image.png',
        'default-pdf'   => 'uploads/files/default/pdf-icon.png',
        'default-docx'  => 'uploads/files/default/docx-icon.png',
        'default-pptx'  => 'uploads/files/default/pptx-icon.png',
        'default-cic'  => 'uploads/files/default/cic.png',
        'default-recode'  => 'uploads/files/default/template.png',
        'cic-sign-right'  => 'uploads/files/default/cic-sign-right.png',
        'cic-sign-left'  => 'uploads/files/default/cic-sign-left.png',
        'cic-sign-left-1'  => 'uploads/files/default/cic-sign-left-1.png',
        'cic-sign-template'  => 'uploads/files/default/template.png',
        'default-bg-certificate' => 'uploads/files/default/bg-certificate.png',
        'icon'          => '/uploads/files/icons/',
        'icon_cic_url_svg'  => 'uploads/files/default/icon_cic_url.svg',
        'icon_cic_pdf_svg'  => 'uploads/files/default/icon_cic_pdf.svg',
        'default_icon'      => '/uploads/files/default/Question_mark_Icons.svg'
    ],
    's3Path' => [
        'small' => env('DO_SPACE_URL') . env('DO_SPACE_NAME') . '/uploads/files/small/',
        'medium' => env('DO_SPACE_URL') . env('DO_SPACE_NAME') . '/uploads/files/medium/',
        'large' => env('DO_SPACE_URL') . env('DO_SPACE_NAME') . '/uploads/files/large/',
        'original' => env('DO_SPACE_URL') . env('DO_SPACE_NAME') . '/uploads/files/original/'
    ],
    'phone_lib' => [
        'intl_tel_input_regex' => '/^[+]([\/+0-9])+$/',
        // 'plasgate_username' => 'vtrustkhapi',
        // 'plasgate_password' => 'xXH95o3DQF',
        // 'plasgate_sender_name' => 'Z1App',
        // 'plasgate_sender_name_saleforce' => 'VTrust App',
        'plasgate_username' => 'cickhapi',
        'plasgate_password' => 'c!c0@#2*',
        'plasgate_sender_name' => 'CiC App',
        'plasgate_sender_name_saleforce' => 'VTrust App',
    ],
    'formatDate' => [
        'date_number' => 'd/m/Y',
        'date_string' => 'j-F-Y',
        'datetime' => 'd-m-Y H:i'
    ],
    'currency_symbol' => [
        'dollar' => '$'
    ],
    'options' => [
        'notification' => [
            'sms' => 'sms',
            'firebase' => 'firebase',
            'database' => 'database',
            'mail' => 'mail',
        ]
    ],
    'firebase' => [
        'url' => 'https://fcm.googleapis.com/fcm/send',
        'server_api_key' => 'AAAAhUy58BA:APA91bGRKkKR2K5UvA3T-DAHLZbk4iyhS5TBIytwpRlfWgMR15fYhen7EpQ52Y6VV71wfZ7JC6w0btyFI3x2N6PtplPgzwwaW8irA1gaHYaF8jt_GH6LSgq1r9W4w8DU3RoAKd4D-fV8'
    ],
    'firebase_type' => [ // config('const.firebase_type.general')
        'general' => 'General',
        'payment' => 'Payment',
        'disbursement' => 'Disbursement',
        'announcement' => 'Announcement',
        'in_review_disbursement' => 'In Review Disbursement'
    ],
    'message' => [
        'notification' => [
            'accepted_disburment' => 'Congratulations on your generate_loan_setting_key...!',
            'rejected_disburment' => 'Thank you for your time and if any more information contact our support team.'
        ]
    ],
    'qm_setting_key' => [
        'enable_direct_trading',
        'bright_primary_color',
        'bright_second_color',
        'bright_accent_color',
        'bright_card_color',
        'dark_card_color',
        'dark_accent_color',
        'dark_second_color',
        'dark_primary_color'
    ],
    'am_setting_key' => [
        'am_enable_direct_trading',
        'am_bright_primary_color',
        'am_bright_second_color',
        'am_bright_accent_color',
        'am_bright_card_color',
        'am_dark_card_color',
        'am_dark_accent_color',
        'am_dark_second_color',
        'am_dark_primary_color'
    ],
    'qm_&_am_setting_key' => [
        'enable_pin_code',
        'application_name',
        'application_version',
        'firebase_token',
        'google_maps_key',
        'application_logo',
        'company_khmer_name',
        'company_english_name',
        'company_head_office',
        'telegram_link',
        'company_phone',
        'company_email',
        'copyright_english',
        'copyright_khmer',
        'term_and_condition_khmer',
        'term_and_condition_english',
        'privacy_and_policy_khmer',
        'privacy_and_policy_english',
        'application_type',
        'android_link',
        'ios_ink',
        'application_new_version',
        'password_min_length',
        'password_required_lowercase',
        'password_required_uppercase',
        'password_required_special_characters',
        'password_required',
        'about_app_english',
        'about_app_khmer'
    ],
    'fif_setting_key' => [
        'fif_admin',
        'about_fif',
        'renew_option',
        'fif_prefix_code',
        'auto_renew_days',
        'fif_payment_reminder',
        'fif_accessible_by_tag',
        'fif_accessible_by_user',
        'fif_application_prefix_code',
    ],
    'privilege_setting_key' => [
        'qr_code_shop_size',
        'shop_distance',
        'default_latitude',
        'default_longitude'
    ],
    'generate_loan_setting_key' => [
        'schedule_movement_date',
        'collection_order',
        'generate_loan_disbursement_date',
        'generate_loan_first_payment_date',
        'generate_loan_day_in_year',
        'generate_loan_day_in_month',
        'generate_loan_interest_method',
        'generate_loan_currency',
        'generate_loan_disbursement_amount',
        'generate_loan_interest_rate',
        'admin_fee',
        'generate_loan_favorable_principle',
        'generate_loan_interest_term',
        'generate_loan_term',
        'generate_loan_step',
        'generate_loan_duration',
        'generate_loan',
        'approval_loan',
        'min_duration',
        'max_duration',
        'min_amount_dollar',
        'max_amount_dollar',
        'min_amount_riel',
        'max_amount_riel',
        'exchange_riel_to_usd',
        'penalty_rate',
        'penalty_calc_base',
        'penalty_calc_period',
        'holiday_and_weekend',
        'disbursement_prefix_code',
        'customer_prefix_code',
        'application_prefix_code',
        'disbursed_by_en',
        'disbursed_by_kh',
        'posted_by_en',
        'posted_by_kh',
        'lenders',
        'exclude_weekend_and_holiday',
        'approved_by_en',
        'approved_by_kh',
        'verifed_by_en',
        'verifed_by_kh',
        'received_by_en',
        'received_by_kh',
        'represented_by_en',
        'represented_by_kh',
        'represented_identity_number',
        'represented_issue_date',
        'represented_house_no',
        'represented_street_no',
        'represented_address',
        'investor_prefix_code',
        'draft_expire',
        'group_member_prefix_code'
    ],
    'ut_trading' => [
        'last_trading_session',
        'block_share',
        'min_price',
        'min_number_of_share_for_selling',
        'min_number_of_share_for_buying',
        'scope_of_trading',
        'trading_method',
        'trading_session',
        'mode_of_payment',
        'transaction_fee',
        'more_information',
        'at_less_fee_amount',
        'fee_in_percentage',
        'expired_ut_card',
        'number_of_days_to_cancel_traded',
        'max_number_of_share_for_selling',
        'max_number_of_share_for_buying',
        'remove_unmatched_specific_trading',
        'notify_users_when_has_any_requested_trading',
        'trading_telegram_link',
        'view_trading_info'
    ],
    'event' => [
        'reminder_event',
        'qr_code_size',
        'available_zone'
    ],
    'investment_dividend_per_ut_key' => [
        'investment_dividend_per_ut'
    ],
    'bonus' => [
        'service_agreement',
        'notify_users_when_has_any_requested_cashout',
        'notify_users_when_has_any_requested_payment',
        'last_date_of_payment',
        'min_ut_subscription',
        'minimum_cash_out_amount',
        'cash_out_sending_date_after_days',
        'waiting_message',
        'maximum_ut_subscription',
        'open_market'
    ],
    'equity_setting_key' => [
        'equity_minimum_amount',
        'equity_maximum_amount',
        'equity_message',
        'get_funding_admin'
    ],
    'setting_tool' => [
        'header_class',
        'main_header',
        'content_class',
        'body_class',
        'sidebar_class',
        'footer_class',
    ],
    'status' => [
        'approved'  => 'approved',
        'rejected'  => 'rejected',
        'new'       => 'new',
        'draft'     => 'draft',
        'pending'   => 'pending',
        'canceled'  => 'canceled',
        'delete'    => 'delete',
        'disbursed' => 'disbursed'
    ],
    // *** Fixed Icome Fund Color
    'investment_account_colors' => [
        '#49A942',
        '#FF6C5F',
        '#3369E7',
        '#1CC7D0',
        '#84BD00',
        '#FFC20E',
        '#DA69B4',
        '#2DDE98',
        '#FF4F81',
        '#B84592',
        '#8E43E7',
        '#0036666',
        '#ED8083',
        '#FDC673',
        '#48B8FA',
        '#F5BBBC',
        '#FB5043'
    ],
    // *** Report Icon Color
    'report_icon_color' => [
        '#DF5249',
        '#FF9402',
        '#02B3E7',
        '#0AB267',
        '#C534E7',
        '#0386FC'
    ],
    // *** Crud col-md
    'crudColMd' => [
        'md_1'  => ['class' => 'form-group col-md-1'],
        'md_2' => ['class' => 'form-group col-md-2'],
        'md_3' => ['class' => 'form-group col-md-3'],
        'md_4' => ['class' => 'form-group col-md-4'],
        'md_5' => ['class' => 'form-group col-md-5'],
        'md_6' => ['class' => 'form-group col-md-6'],
        'md_7' => ['class' => 'form-group col-md-7'],
        'md_8' => ['class' => 'form-group col-md-8'],
        'md_9' => ['class' => 'form-group col-md-9'],
        'md_10' => ['class' => 'form-group col-md-10'],
        'md_11' => ['class' => 'form-group col-md-11'],
        'md_12' => ['class' => 'form-group col-md-12']
    ],

    // ** Mobile Icon color
    'mobile_icon_color' => [
        '#DF5249',
        '#FF9402',
        '#02B3E7',
        '#0AB267',
        '#C534E7',
        '#0386FC'
    ],
    // ** Module: Mobile Icon
    'modules' => [
        'Payment' => 'Payment',
        'Get Funding' => 'Get Funding',
        'CiC MM Account' => 'CiC MM Account',
        'CiC Fixed Income Fund' => 'CiC Fixed Income Fund'
    ]
];
