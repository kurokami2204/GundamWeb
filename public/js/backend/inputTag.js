var tags = [];
var $container = document.querySelector('div');
var $input = document.querySelector('input');
var $tags = document.querySelector('.js-tags-phone');

console.log($container);

$container.addEventListener('click', function() {
    $input.focus();
});

$container.addEventListener('keydown', function(evt) {
    if ( !evt.target.matches('.js-tag-input-phone') ) {
    return;
    }

    if ( evt.keyCode !== 13 ) {
    return;
    }

    var value = String(evt.target.value);

    if ( !value.length || value.length > 20 || tags.length === 3 ) {
    return;
    }

    tags.push(evt.target.value);
    $input.value = '';
    render(tags, $tags);
});

$container.addEventListener('keydown', function(evt) {
    if ( !evt.target.matches('.js-tag-input-phone') ) {
    return;
    }

    if ( evt.keyCode !== 8 ) {
    return;
    }

    if ( String(evt.target.value).length ) {
    return;
    }

    tags = tags.slice(0, tags.length - 1);
    $input.value = '';
    render(tags, $tags);
});

$container.addEventListener('click', function(evt) {
    if ( evt.target.matches('.js-tag-close') || evt.target.matches('.js-tag') ) {
    tags = tags.filter(function(tag, i) {
        return i != evt.target.getAttribute('data-index');
    });
    render(tags, $tags);
    }
}, true);


function render(tags, el) {
    var list = [];
    el.innerHTML = tags.map(function(tag, i) {
        list.push(tag);
    return (
        '<div class="tag js-tag" data-index="' + i + '"><input value="' +
        list.toString() + '" class="hidden" name="contact_phone">' + tag +
        '<span class="tag-close js-tag-close" data-index="' + i + '">×</span>' +
        '</div>'
    );
    }).join('') + (tags.length === 3 ? '' : '<input placeholder="Số điện thoại liên lạc" class="js-tag-input-phone">')
    ;

    $container.querySelector('.js-tag-input-phone').focus();
    $("#textInputPhone").css("width","100%")

}

function phapLuatTagInput(){
    var tags = [];
    var $container = document.querySelector('div');
    var $input = document.querySelector('input');
    var $tags = document.querySelector('.js-tags');

    $container.addEventListener('click', function() {
    $input.focus();
    });

    $container.addEventListener('keydown', function(evt) {
    if ( !evt.target.matches('.js-tag-input') ) {
        return;
    }

    if ( evt.keyCode !== 13 ) {
        return;
    }

    var value = String(evt.target.value);

    if ( !value.length || value.length > 20 || tags.length === 3 ) {
        return;
    }

    tags.push(evt.target.value);
    $input.value = '';
    render(tags, $tags);
    });

    $container.addEventListener('keydown', function(evt) {
    if ( !evt.target.matches('.js-tag-input') ) {
        return;
    }

    if ( evt.keyCode !== 8 ) {
        return;
    }

    if ( String(evt.target.value).length ) {
        return;
    }

    tags = tags.slice(0, tags.length - 1);
    $input.value = '';
    render(tags, $tags);
    });

    $container.addEventListener('click', function(evt) {
    if ( evt.target.matches('.js-tag-close') || evt.target.matches('.js-tag') ) {
        tags = tags.filter(function(tag, i) {
        return i != evt.target.getAttribute('data-index');
        });
        render(tags, $tags);
    }
    }, true);


    function render(tags, el) {
        var list = [];
    el.innerHTML = tags.map(function(tag, i) {
        list.push(tag);
        return (
            '<div class="tag js-tag" data-index="' + i + '"><input value="' +
            list.toString() + '" class="hidden" name="phap_ly">' + tag +
            '<span class="tag-close js-tag-close" data-index="' + i + '">×</span>' +
            '</div>'
    );
    }).join('') + (tags.length === 3 ? '' : '<input placeholder="Pháp lý" class="js-tag-input">')
    ;

    $container.querySelector('.js-tag-input').focus();
        $("#textInput").css("width","100%")

    }
}
