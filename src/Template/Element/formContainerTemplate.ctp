<?php
    $this->Form->templates([
        'inputContainer' => '<div class="form-container-field">'
                         .'<div class="form-container-field-column">{{content}}</div>'
                         .'</div>',
        'inputContainerError' => '<div class="form-container-field">'
                              .'<div class="form-container-field-column">{{content}}</div>'
                              .'<div class="form-container-field-error">{{error}}</div>'
                              .'</div>',
        'error' => '{{content}}',
        'label' => '<label class="form-container-field-column-label" {{attrs}}>{{text}}</label>',
        'input' => '<input class="form-container-field-column-input" name="{{name}}" type="{{type}}" name="{{name}}" {{attrs}} />',
        'select' => '<select class="form-container-field-column-select" name="{{name}}" {{attrs}}>{{content}}</select>',
        'textarea' => '<textarea class="form-container-field-column-textarea" name="{{name}}" {{attrs}}>{{value}}</textarea>',
        'dateWidget' => '{{year}}{{month}}{{day}}{{hour}}{{minute}}',
    ])
?>
