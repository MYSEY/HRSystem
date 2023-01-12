<?php

return [
    // uploads, spaces
    // 'upload_disk' => 'spaces',
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
        'original' => env('DO_SPACE_URL') . env('DO_SPACE_NAME') . '/storage/uploads/files/original/'
    ],
];
