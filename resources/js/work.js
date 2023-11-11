$($('[name=type]')).change((e) => {
    let $type = $(e.target);
    let $duration = $type.parent('div').parent('form').find('[name=duration]');
    let $quota = $type.parent('div').parent('form').find('[name=quota]');

    if ($type.val() !== 'delivery') {
        $duration.val(1);
        $quota.val(100);
    } else {
        $duration.val($duration.data('load-distance'));
        $quota.val(30);
    }
});