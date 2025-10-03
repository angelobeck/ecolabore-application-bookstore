
class eclMod_bookstoreLivro_audiobook extends eclMod {
    range; // the range element
    audio; // the audio element

    currentTime = 0;
    duration = 0;
    paused = true;
    rate = 1;
    volume = 100;

    configuration = {};
    name;
    src = '';
    url = false;

    connectedCallback() {
        this.track('currentTime');
        this.track('duration');
        this.track('paused');
        this.track('rate');
        this.track('url');
        this.track('volume');

        this.name = page.application.parent.name;
        this.retrieveConfiguration();

        io.request()
            .then(response => {
                this.audio = document.createElement('audio');
                document.body.appendChild(this.audio);
                this.audio.src = response.url;
                this.audio.onloadedmetadata = () => {
                    this.duration = this.audio.duration;
                    this.audio.currentTime = this.currentTime;
                    this.audio.volume = this.volume / 100;
                    this.audio.playbackRate = this.rate;
                    this.url = this.audio.src;
                };
            });
    }

    get _fileName_() {
        return page.application.parent.name + '.mp3';
    }

    get _duration_() {
        return this.formatTime(this.duration);
    }

    get _currentTime_() {
        return this.formatTime(this.audio.currentTime);
    }

    get _playPauseLabel_() {
        return this.audio.paused ? "Reproduzir" : "Pausar";
    }

    actionPlayPause() {
        if (this.audio.paused) {
            this.audio.play();
            this.paused = false;
            this.timeUpdate();
        } else {
            this.audio.pause();
            this.paused = true;
        }
    }

    timeUpdate() {
        if (!this.audio || this.audio.paused)
            return;
        this.currentTime = this.audio.currentTime;
        this.storeConfiguration();
        setTimeout(() => {
            this.timeUpdate();
        }, 1000);
    }

    formatTime(time) {
        time = Math.floor(time);
        var seconds = time % 60;
        var totalMinutes = Math.floor((time - seconds) / 60);
        var minutes = totalMinutes % 60;
        var hours = Math.floor((totalMinutes - minutes) / 60);

        return hours.toString().padStart(2, '0') + ':' + minutes.toString().padStart(2, '0') + ':' + seconds.toString().padStart(2, '0');
    }

    actionSeekArrowLeft() {
        this.audio.currentTime -= 10;
        this.currentTime = this.audio.currentTime;
    }

    actionSeekArrowRight() {
        this.audio.currentTime += 10;
        this.currentTime = this.audio.currentTime;
    }

    actionSeekPageUp() {
        this.audio.currentTime -= 60;
        this.currentTime = this.audio.currentTime;
    }

    actionSeekPageDown() {
        this.audio.currentTime += 60;
        this.currentTime = this.audio.currentTime;
    }

    actionSeekHome() {
        this.audio.currentTime -= 600;
        this.currentTime = this.audio.currentTime;
    }

    actionSeekCtrlHome() {
        this.audio.currentTime = 0;
        this.currentTime = this.audio.currentTime;
    }

    actionSeekEnd() {
        this.audio.currentTime += 600;
        this.currentTime = this.audio.currentTime;
    }

    actionSeekCtrlEnd() {
        this.audio.currentTime = this.audio.duration - 10;
        this.currentTime = this.audio.currentTime;
    }

    actionRateSlow() {
        if (this.rate > 0.5) {
            this.rate -= 0.25;
            this.audio.playbackRate = this.rate;
        }
    }

    actionRateFast() {
        if (this.rate < 2) {
            this.rate += 0.25;
            this.audio.playbackRate = this.rate;
        }
    }

    actionVolumeDown() {
        if (this.volume > 5) {
            this.volume -= 5;
            this.audio.volume = this.volume / 100;
        }
    }

    actionVolumeUp() {
        if (this.volume < 100) {
            this.volume += 5;
            this.audio.volume = this.volume / 100;
        }
    }

    handleRangeKeydown(event) {
        switch (event.key) {
            case "Enter":
            case " ":
                this.actionPlayPause();
                break;

            case "ArrowLeft":
                this.actionSeekArrowLeft();
                break;

            case "ArrowRight":
                this.actionSeekArrowRight();
                break;

            case "PageUp":
                this.actionSeekPageUp();
                break;

            case "PageDown":
                this.actionSeekPageDown();
                break;

            case "Home":
                this.actionSeekHome();
                break;

            case "End":
                this.actionSeekEnd();
                break;

            case "ArrowUp":
                this.actionVolumeUp();
                break;

            case "ArrowDown":
                this.actionVolumeDown();
                break;

            default:
                return;
        }
        event.preventDefault();
        event.stopPropagation();
    }

    disconnectedCallback() {
        document.body.removeChild(this.audio);
        delete this.audio;
    }

    retrieveConfiguration() {
        var configuration = {};
        var serialized = localStorage.getItem('bookstoreLivro_audioConfiguration');
        if (serialized)
            configuration = unserialize(serialized);

        this.updateConfigurationList(configuration);
        this.configuration.name = this.name;
        this.configuration.volume = configuration.volume || 100;
        this.configuration.rate = configuration.rate || 1;

        this.currentTime = this.configuration.currentTime || 0;
        this.rate = this.configuration.rate;
        this.volume = this.configuration.volume;
    }

    storeConfiguration() {
        this.configuration.currentTime = this.currentTime;
        this.configuration.rate = this.rate;
        this.configuration.volume = this.volume;
        this.configuration.tics++;
        this.configuration.listened = Math.ceil((this.configuration.tics / this.duration) * 100);
        this.configuration.updated = new Date().getTime();
        localStorage.setItem('bookstoreLivro_audioConfiguration', serialize(this.configuration));
    }

    updateConfigurationList(configuration) {
        var configurationList = [];
        var serialized = localStorage.getItem('bookstoreLivro_audioConfigurationList');
        if (serialized)
            configurationList = unserialize(serialized);
        if (configurationList.length > 20)
            configurationList.shift();

        this.setConfiguration(configurationList, configuration);
        this.findConfiguration(configurationList, this.name);
        localStorage.setItem('bookstoreLivro_audioConfigurationList', serialize(configurationList));
    }

    setConfiguration(configurationList, configuration) {
        if (!configuration.name)
            return;

        var data = {
            name: configuration.name,
            currentTime: configuration.currentTime,
            tics: configuration.tics,
            listened: configuration.listened,
            updated: configuration.updated
        };

        for (let i = 0; i < configurationList.length; i++) {
            if (configurationList[i].name === configuration.name) {
                configurationList[i] = data;
                return;
            }
        }

        configurationList.push(data);
    }

    findConfiguration(configurationList, name) {
        for (let i = 0; i < configurationList.length; i++) {
            if (configurationList[i].name === name) {
                this.configuration = configurationList[i];
                return;
            }
        }
        this.configuration.tics = 0;
        this.configuration.currentTime = 0;
    }

}
