<?php

return [

    // 🔐 These are at the ROOT level (not inside `cloud`)
    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
    'api_key'    => env('CLOUDINARY_API_KEY'),
    'api_secret' => env('CLOUDINARY_API_SECRET'),

    // ✅ Optionally enable secure URLs
    'secure'     => true,
];
