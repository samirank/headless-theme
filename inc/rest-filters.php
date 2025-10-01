<?php
// Allow anonymous comments in the REST API.
function headless_allow_anonymous_comments() {
    return true;
}
add_filter('rest_allow_anonymous_comments', 'headless_allow_anonymous_comments');