$(() => {
    $('form').on('submit', () => {
        $('button').attr('disabled', 'disabled');
    });
});