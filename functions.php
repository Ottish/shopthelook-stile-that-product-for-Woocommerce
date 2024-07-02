add_filter('template_include', 'include_look_template', 1);

function include_look_template($template) {
    if (is_singular('look')) {
        if ($new_template = locate_template(array('single-look.php'))) {
            return $new_template;
        }
    }
    return $template;
}
