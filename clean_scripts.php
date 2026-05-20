<?php
$dir = 'c:\\Users\\Dave\\Desktop\\Aptech\\my-project\\Laravel-Store\\resources\\views';
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
foreach ($iterator as $file) {
    if ($file->isFile() && preg_match('/\.blade\.php$/', $file->getFilename()) && $file->getFilename() !== 'user.blade.php') {
        $content = file_get_contents($file->getPathname());
        $orig = $content;
        
        $content = preg_replace('/<script>\s*const ASSET_URL = \"\{\{asset\(\'user\'\)\}\}\"\s*<\/script>/', '', $content);
        
        $patterns = [
            '/<script src=\"\{\{asset\(\'user\/js\/vendor\/jquery-2\.2\.4\.min\.js\'\)\}\}\"><\/script>/',
            '/<script src=\"https:\/\/cdnjs\.cloudflare\.com\/ajax\/libs\/popper\.js\/1\.11\.0\/umd\/popper\.min\.js\"[^>]*><\/script>/',
            '/<script src=\"\{\{asset\(\'user\/js\/vendor\/bootstrap\.min\.js\'\)\}\}\"><\/script>/',
            '/<script src=\"\{\{asset\(\'user\/js\/jquery\.ajaxchimp\.min\.js\'\)\}\}\"><\/script>/',
            '/<script src=\"\{\{asset\(\'user\/js\/jquery\.nice-select\.min\.js\'\)\}\}\"><\/script>/',
            '/<script src=\"\{\{asset\(\'user\/js\/jquery\.sticky\.js\'\)\}\}\"><\/script>/',
            '/<script src=\"\{\{asset\(\'user\/js\/nouislider\.min\.js\'\)\}\}\"><\/script>/',
            '/<script src=\"\{\{asset\(\'user\/js\/jquery\.magnific-popup\.min\.js\'\)\}\}\"><\/script>/',
            '/<script src=\"\{\{asset\(\'user\/js\/owl\.carousel\.min\.js\'\)\}\}\"><\/script>/',
            '/<!--gmaps Js-->\s*<script src=\"\{\{asset\(\'user\/js\/gmaps\.min\.js\'\)\}\}\"><\/script>/',
            '/<script src=\"\{\{asset\(\'user\/js\/main\.js\'\)\}\}\"><\/script>/',
            '/<script src=\"https:\/\/cdn\.jsdelivr\.net\/npm\/sweetalert2@11\"><\/script>/',
            '/<script src=\"\{\{asset\(\'user\/js\/countdown\.js\'\)\}\}\"><\/script>/',
            '/<script src=\"\{\{asset\(\'user\/js\/elementJs\/carousel\.js\'\)\}\}\"><\/script>/',
            '/<script src=\"\{\{asset\(\'admin\/assets\/js\/elementJs\/main\.js\'\)\}\}\"><\/script>/'
        ];
        foreach ($patterns as $p) {
            $content = preg_replace($p, '', $content);
        }
        
        $content = preg_replace('/<script>\s*window\.App = \{\s*loggedIn: @json\(Auth::check\(\)\),\s*roleId: @json\(optional\(Auth::user\(\)\)->role_id\)\s*\};\s*<\/script>/', '', $content);
        
        $content = preg_replace('/function isLogined\(\)\s*\{\s*return window\.App\?\.loggedIn === true;\s*\}/', '', $content);
        $content = preg_replace('/function isAdmin\(\)\s*\{\s*return isLogined\(\) && window\.App\?\.roleId === 1;\s*\}/', '', $content);
        $content = preg_replace('/function showError\(title, message\)\s*\{\s*Swal\.fire\(\{\s*icon: \'error\',\s*title,\s*text: message\s*\}\);\s*\}/', '', $content);
        $content = preg_replace('/function isLogined\(\)\s*\{\s*return @json\(Auth::check\(\)\);\s*\}/', '', $content);
        
        $content = preg_replace('/<script>\s*(\/\/ Ki[ểe]m tra [đd]ăng nh[ậa]p)?\s*<\/script>/', '', $content);
        
        if ($content !== $orig) {
            file_put_contents($file->getPathname(), $content);
            echo "Cleaned " . $file->getPathname() . "\n";
        }
    }
}
