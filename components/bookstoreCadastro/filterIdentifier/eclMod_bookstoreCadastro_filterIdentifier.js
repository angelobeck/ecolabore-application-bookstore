
class eclMod_bookstoreCadastro_filterIdentifier extends eclMod {
    control;
    formulary;
    value = '';

    connectedCallback() {
        this.api('formulary');
        this.api('control');
    }

    refreshCallback() {
        var value;
        if (!this.formulary)
            return;

        if (this.control.flags && this.control.flags.target)
            value = this.formulary.getField(this.control.flags.target);

        if(!value || value === '') {
            value = eclIo_convert.slug(this.formulary.getField('text.title.pt.value'));
            this.formulary.setField(this.control.flags.target, value);
        }
        this.value = value;
    }

    disconnectedCallback() {
        if (!this.formulary)
            return;

        this.formulary.unsubscribe(this);
    }

    handleChange(event) {
        if (!this.formulary || !this.control.flags || !this.control.flags.target)
            return;

        this.formulary.setField(this.control.flags.target, event.detail.value);
    }

}
