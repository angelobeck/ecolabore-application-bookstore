
class eclMod_bookstoreCadastro_filterDocument extends eclMod {
    control;
    formulary;

    document = '';
    documentType = 'Identidade';
    country = 'Brasil';

    connectedCallback() {
        this.api('formulary');
        this.api('control');
    }

    refreshCallback() {
        if (!this.formulary)
            return;

        this.document = this.formulary.getField('details.document');
        this.documentType = this.formulary.getField('details.documentType');
        this.country = this.formulary.getField('details.country');

        if (!this.documentType || this.documentType == '') {
            this.documentType = this.findDocumentType(this.country);
            this.formulary.setField('details.documentType', this.documentType);
        }
    }

    disconnectedCallback() {
        if (!this.formulary)
            return;

        this.formulary.unsubscribe(this);
    }

    get _documentTypeId_() {
        return this.control.flags.id + '_documentType';
    }

    get _otherCountry_() {
        return this.country != 'Brasil' && this.country != 'Portugal';
    }
    handleDocumentChange(event) {
        if (!this.formulary)
            return;

        this.formulary.setField('details.document', event.detail.value);
    }

    handleDocumentTypeChange(event) {
        if (!this.formulary)
            return;

        this.formulary.setField('details.documentType', event.detail.value);
    }

    handleCountryChange(event) {
        if (!this.formulary)
            return;

        this.formulary.setField('details.country', event.detail.value);
    }

    findDocumentType(country) {
        switch (country) {
            case 'Brasil': return 'CPF';
            case 'Portugal': return 'NIF';
            default: return 'Identidade';
        }
    }

}
