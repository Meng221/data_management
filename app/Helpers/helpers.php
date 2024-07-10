<?php
    if (!function_exists('isHomeRelatedRoute')) {
        function isHomeRelatedRoute() {
            return request()->routeIs('home') || request()->routeIs('plan') || request()->routeIs('defense') || request()->routeIs('advisor') || request()->routeIs('group') || request()->routeIs('about');
        }
    }
?>
