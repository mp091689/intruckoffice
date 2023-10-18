class Invoice {
    constructor($form) {
        this.$form = $form;
        this.$works = this.$form.find('[id^=work-id-]');
        this.$customWork = this.$form.find('#custom_work');
        this.$customTotal = this.$form.find('#custom_total');

        this.$works.each(function (idx, work) {
            $(work).click(function () {
                this.render();
            }.bind(this));
        }.bind(this));

        this.$customWork.keyup(function () {
            this.render();
        }.bind(this));

        this.$customTotal.keyup(function () {
            this.render();
        }.bind(this));

        this.render();
    }

    getCustomWork() {
        if (!this.$customWork.val()) {
            return '';
        }

        return '\n' + this.$customWork.val() + '\n';
    }

    render() {
        let $generatedLog = this.$form.find('#generated_log');
        let generatedLog = $generatedLog.data('header') + '\n\n';
        let total = 0;

        this.$works.each(function () {
            if (this.checked) {
                generatedLog += $(this).data('title') + ' - $ ' + $(this).data('price') + '\n';
                total = Number(total) + Number($(this).data('price'));
            }
        });

        total = Number(total) + Number(this.$customTotal.val());
        generatedLog += this.getCustomWork() + '\nTOTAL: $ ' + total;

        $generatedLog.val(generatedLog);
        this.$form.find('#pre_generated_log').text(generatedLog);
        this.$form.find('#total').val(total);
    }
}

new Invoice($('#invoice-form'));
