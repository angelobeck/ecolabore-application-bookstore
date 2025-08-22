
class eclMod_bookstoreLogin_accessDenied extends eclMod {
    identifierElement;
    identifierFocus = true;
    identifierValue = '';

    passwordElement;
    passwordFocus = false;
    passwordReadonly = false;
    passwordType = "password";
    passwordValue = '';

    welcomeElement;
    welcomeFocus = false;
    welcomeMessage;

    errorElement;
    errorFocus = false;
    errorMessage;

    step = 'identifier'; // identifier, password, welcome, error

    levelUpUrl;

    connectedCallback() {
        this.track('step');
        this.track('passwordReadonly');
        this.track('passwordType');
    }

    refreshCallback() {
        this.step = 'identifier';
        this.identifierValue = '';
        this.passwordValue = '';
        this.identifierFocus = true;
        this.passwordReadonly = false;
        this.levelUpUrl = page.url(page.application.parent.path);
        this.levelUpTitle = page.application.parent.data.text.title;
    }

    renderedCallback() {
        if (this.identifierFocus) {
            this.identifierFocus = false;
            this.identifierElement.focus();
        } else if (this.passwordFocus) {
            this.passwordFocus = false;
            this.passwordElement.focus();
        } else if (this.welcomeFocus) {
            this.welcomeFocus = false;
            this.welcomeElement.focus();
        } else if (this.errorFocus) {
            this.errorFocus = false;
            this.errorElement.focus();
        }
    }

    handleIdentifierAction() {
        this.identifierValue = this.identifierElement.value;
        this.step = 'password';
        this.passwordFocus = true;
    }

    handleIdentifierKeydown(event) {
        if (event.key === "Enter")
            this.handleIdentifierAction();
    }

    handlePasswordAction() {
        this.passwordValue = this.passwordElement.value;
        this.passwordReadonly = true;
        var data = {
            identifier: this.identifierValue,
            password: this.passwordValue
        };
        this.identifierValue = '';
        this.passwordValue = '';
        io.request(data)
            .then((response, raw) => {
                page.session.user = response.user;
                page.sessionUpdate();
                page.domain.reset();
                this.step = "welcome";
                this.welcomeFocus = true;
                this.passwordReadonly = false;
            }).catch((error, raw) => {
                this.errorMessage = error.message;
                this.step = "error";
                this.errorFocus = true;
                this.passwordReadonly = false;
            });
    }

    handlePasswordKeydown(event) {
        if (event.key === "Enter")
            this.handlePasswordAction();
    }

    handlePasswordVisibility(event) {
        var visibility = event.currentTarget.checked;
        this.passwordType = visibility ? "text" : "password";
    }

    handleWelcomeAction() {
        this.step = 'identifier';
        var url = page.url(page.application.parent.path);
        navigate(url);
    }

    handleErrorCancel() {
        var url = page.url(page.application.parent.path);
        navigate(url);
    }

    handleErrorRetry() {
        this.step = 'identifier';
        this.identifierFocus = true;
    }

}
