<?php

function sanitize($item, $type) {
    switch($type) {
    case 'string':
        $item = filter_var($item, FILTER_SANITIZE_STRING);
        break;
    case 'email':
        $item = filter_var($item, FILTER_SANITIZE_EMAIL);
        break;
    case 'int':
        $item = filter_var($item, FILTER_SANITIZE_NUMBER_INT);
        break;
    case 'url':
        $item = filter_var($item, FILTER_SANITIZE_URL);
        break;
    }

    return $item;
}

function validate(array $items, array $rule_items) {
    $result = array();
    foreach($rule_items as $item_key => $item_value) {

        // Jika terdapat array key '$item_key' pada $items (mis. $item_key berisi string 'name', dan $items berisi array asosiatif $items['name'])
        if (array_key_exists($item_key, $items)) {
            $form_items[$item_key] = trim($items[$item_key]);
            $form_label = $item_value['label'];

            foreach($item_value as $rule_key => $rule_value) {
                switch($rule_key) {
                case 'required':
                    if ($rule_value === TRUE && empty($form_items[$item_key])) {
                        $result['danger'][] = $form_label . ' is required!';
                    }
                    break;
                case 'sanitize':
                    if (!sanitize($form_items[$item_key], $rule_value)) {
                        $result['danger'][] = $form_label . ' is not valid!';
                    }
                    break;
                case 'min':
                    if (strlen($form_items[$item_key]) < $rule_value) {
                        $result['danger'][] = $form_label . ' is min. '.$rule_value.' characters!';
                    }
                    break;
                case 'max':
                    if (strlen($form_items[$item_key]) > $rule_value) {
                        $result['danger'][] = $form_label . ' is max. '.$rule_value.' characters!';
                    }
                    break;
                case 'regexp':
                    if (!preg_match($rule_value, $form_items[$item_key])) {
                        $result['danger'][] = $form_label . ' pattern does not match'; 
                    }
                    break;
                case 'matches':
                    if ($form_items[$item_key] !== $form_items[$rule_value]) {
                        $result['danger'][] = $form_label . ' does not match'; 
                    }
                    break;

                }

                $result['item'] = $form_items;
            }
        }
    }
    return $result;

}

function is_passed(array $items) {
    return !array_key_exists('danger', $items);
}

function check_validation(array $validated_items, array $after_validation) {
    if (is_passed($validated_items)) {

        $after_validated_items = $validated_items['item'];
        if (!empty($after_validation)) {
            foreach($after_validation as $action_key => $action_value) {
                switch($action_key) {
                case 'hash':
                    $argument = explode(':', $action_value);
                    $after_validated_items[$argument[0]] = password_hash($after_validated_items[$argument[0]], constant($argument[1]));
                    break;
                case 'remove':
                    unset($after_validated_items[$action_value]);
                    break;
                }
            }
        }
        return $after_validated_items;
    } else {
        $result['danger'] = $validated_items['danger'];
        return $result;
    }
}
