<?php

$config = new PhpCsFixer\Config('default');
$config->setRiskyAllowed(true);
$config->setRules([
    '@PSR2' => true,
    'align_multiline_comment' => true,
    'array_indentation' => true,
    'array_syntax' => [
        'syntax' => 'short',
    ],
    'binary_operator_spaces' => [
        'operators' => ['=' => null, '=>' => null],
    ],
    'blank_line_after_namespace' => true,
    'blank_line_after_opening_tag' => true,
    'blank_line_before_statement' => [
        'statements' => [
            'return',
        ],
    ],
    'cast_spaces' => [
        'space' => 'single',
    ],
    'class_attributes_separation' => [
        'elements' => [
            'method' => 'one', 
            'property' => 'one',
        ],
    ],
    'compact_nullable_typehint' => true,
    'concat_space' => [
        'spacing' => 'one',
    ],
    'declare_equal_normalize' => true,
    'declare_strict_types' => true,
    'function_typehint_space' => true,
    'include' => true,
    'increment_style' => ['style' => 'pre'],
    'indentation_type' => true,
    'lowercase_cast' => true,
    'method_chaining_indentation' => true,
    'multiline_comment_opening_closing' => true,
    'native_function_casing' => true,
    'new_with_braces' => true,
    'no_blank_lines_after_phpdoc' => true,
    'no_empty_comment' => true,
    'no_empty_phpdoc' => true,
    'no_empty_statement' => true,
    'no_extra_blank_lines' => [
        'tokens' => [
            'curly_brace_block',
            'extra',
            'parenthesis_brace_block',
            'square_brace_block',
            'throw',
            'use',
        ],
    ],
    'no_leading_import_slash' => true,
    'no_leading_namespace_whitespace' => true,
    'no_mixed_echo_print' => [
        'use' => 'echo',
    ],
    'no_multiline_whitespace_around_double_arrow' => true,
    'no_short_bool_cast' => true,
    'no_singleline_whitespace_before_semicolons' => true,
    'no_spaces_around_offset' => true,
    'no_superfluous_phpdoc_tags' => [
        'allow_mixed' => true,
    ],
    'no_trailing_comma_in_list_call' => true,
    'no_trailing_comma_in_singleline_array' => true,
    'no_unneeded_control_parentheses' => true,
    'no_unused_imports' => true,
    'no_whitespace_before_comma_in_array' => true,
    'no_whitespace_in_blank_line' => true,
    'not_operator_with_successor_space' => true,
    'normalize_index_brace' => true,
    'object_operator_without_whitespace' => true,
    'ordered_imports' => true,
    'phpdoc_align' => false,
    'phpdoc_annotation_without_dot' => true,
    'phpdoc_indent' => true,
    'phpdoc_no_package' => true,
    'phpdoc_no_useless_inheritdoc' => true,
    'phpdoc_order' => true,
    'phpdoc_scalar' => true,
    'phpdoc_separation' => true,
    'phpdoc_single_line_var_spacing' => true,
    'phpdoc_to_comment' => true,
    'phpdoc_trim' => true,
    'phpdoc_trim_consecutive_blank_line_separation' => true,
    'phpdoc_types' => true,
    'phpdoc_var_without_name' => true,
    'psr_autoloading' => true,
    'return_type_declaration' => true,
    'short_scalar_cast' => true,
    'single_blank_line_before_namespace' => true,
    'single_class_element_per_statement' => true,
    'single_quote' => true,
    'space_after_semicolon' => true,
    'standardize_not_equals' => true,
    'ternary_operator_spaces' => true,
    'ternary_to_null_coalescing' => true,
    'trailing_comma_in_multiline' => ['elements' => ['arrays']],
    'trim_array_spaces' => true,
    'unary_operator_spaces' => true,
    'whitespace_after_comma_in_array' => true,
]);

$finder = PhpCsFixer\Finder::create();
$finder->in(__DIR__);
$config->setFinder($finder);

return $config;
