
class eclMod_bookstoreCadastro_filterPhone extends eclMod {
    control;
    formulary;

    countryCode = '';
    phone = '';

    connectedCallback() {
        this.api('formulary');
        this.api('control');
    }

    refreshCallback() {
        if (!this.formulary)
            return;

        this.countryCode = this.formulary.getField('details.countryCode');
        this.phone = this.formulary.getField('details.phone');

        if (!this.countryCode || this.countryCode === '') {
            let country = this.formulary.getField('details.country');
            this.countryCode = this.defaultCountryCodes(country);

            this.formulary.setField('details.countryCode', this.countryCode);
        }
    }

    disconnectedCallback() {
        if (!this.formulary)
            return;

        this.formulary.unsubscribe(this);
    }

    get _countryCodeId_() {
        return this.control.flags.id + '_countryCode';
    }

    get _label_() {
        var country = this.formulary.getField('details.country');
        if (country == 'Portugal')
            return 'Telemóvel';
        else if (country == 'Brasil')
            return 'Telefone com código de área';
        else
            return 'Telefone (com código de área se existir)';
    }
    handleCountryCodeChange(event) {
        this.formulary.setField('details.countryCode', event.detail.value);
    }

    handlePhoneChange(event) {
        this.formulary.setField('details.phone', event.detail.value);
    }

    defaultCountryCodes(country) {
        switch (country) {
            case 'Angola': return '+244';
            case 'Brasil': return '+55';
            case 'Cabo Verde': return '+238';
            case 'Guiné-Bissau': return '+245';
            case 'Macau': return '+853';
            case 'Portugal': return '+351';
            case 'Moçambique': return '+258';
            case 'São Tomé e Príncipe': return '+239';
            case 'Timor-Leste': return '+670';
            default: return '';
        }
    }

}
