
class eclMod_bookstoreCadastro extends eclMod {
    raw = '';
    step = 1;
    stepMonitor = 0;
    headerElement;
    fields = {};
    error = {};

    get _headerContent_() {
        switch (this.step) {
            case 1:
                return 'Cadastrar';
            case 2:
                return this.fields.minor ? 'Dados do responsável' : 'Dados pessoais';
            case 3:
                return 'Perfil público';
            case 4:
                return 'Login';
            case 5:
                return 'Pronto para cadastrar';
            case 6:
                return 'Documento';
            case 7:
                return 'Pronto!';
        }
    }

    get _formularyName_() {
        if (this.fields.minor)
            return 'bookstoreCadastro_formularySponsor';
        else
            return 'bookstoreCadastro_formularyPersonal';
    }

    get _step_() {
        return 'Passo ' + this.step + ' de 7';
    }

    connectedCallback() {
        this.track('error');
        this.track('raw');
        this.track('step');
    }

    renderedCallback() {
        if (this.stepMonitor !== this.step) {
            this.stepMonitor = this.step;
            this.headerElement.focus();
        }
    }

    formularyAction(event) {
        var action = event.detail.action;
        var formulary = event.detail.formulary;
        this.fields = formulary.fields;

        if (action === 'next') {
            const data = {
                step: this.step,
                fields: this.fields
            };
            io.request(data)
                .then(response => {
                    if (this.step === 5 && response.user) {
                        page.session.user = response.user;
                        page.sessionUpdate();
                        page.domain.reset();
                    }

                    this.fields = response.fields;
                    this.step++;
                })
                .catch((error, raw) => {
                    this.error = error;
                    if (error.message)
                        page.alertOpen('alert');
                    else
                        this.raw = raw;
                });
        } else {
            this.step--;
        }
    }

    actionStep6(event) {
            this.step++;
    }

    actionStep7() {
        navigate(page.url(page.application.parent.path));
    }

    get _urlHome_(){
        return page.url([page.domain.name]);
    }

}
