define(['ckeditor'], function(CKEDITOR) {
    'use strict';

    var updateCounter = function(counter, chars) {
        var maxChars = counter.dataset.maxChars;
        var warningChars = counter.dataset.warningChars;

        counter.innerHTML = chars + ' / ' + maxChars;

        if (chars >= maxChars) {
            counter.classList.add('label-danger');
            counter.classList.remove('label-warning');
            counter.classList.remove('label-info');
        } else if (chars >= warningChars) {
            counter.classList.remove('label-danger');
            counter.classList.remove('label-info');
            counter.classList.add('label-warning');
        } else {
            counter.classList.remove('label-danger');
            counter.classList.remove('label-warning');
            counter.classList.add('label-info');
        }
    }

    var removeHtml = function(value) {
        var tmp = document.createElement('div');
        tmp.innerHTML = value;

        return tmp.textContent || tmp.innerText;
    }

    document.querySelectorAll('.js-character-counter-wizard').forEach(element => {
        var fieldName = element.dataset.fieldName;
        var field = document.querySelector('[data-formengine-input-name="' + fieldName + '"]');

        if (field) {
            // This is regular input or textarea
            field.addEventListener('input', function() {
                updateCounter(element, field.value.length);
            })
            setTimeout(function() {
                updateCounter(element, field.value.length);
            }, 100);
        }
    });

    CKEDITOR.on('instanceReady', function(ev) {
        var editor = ev.editor;
        var field = editor.element;
        var counter = document.querySelector('.js-character-counter-wizard[data-field-name="' + field.getAttribute('name') + '"]');
        editor.on('change', function() {
            updateCounter(counter, removeHtml(editor.getData()).length);
        })
        updateCounter(counter, removeHtml(editor.getData()).length);
    });
});
