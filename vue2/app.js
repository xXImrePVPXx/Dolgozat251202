new Vue({
    el: '#app',
    data: {
        message: '',
        egy: '',
        ketto: '',
        backgroundcolor: 'yellow'
    },
    methods: {
        osszeg() {
            if(this.egy !== '' && this.ketto !== '') {
                this.message = this.egy + this.ketto;
                this.backgroundcolor = 'green';
            }else{
                this.message = 'Valamilyen értéket be kell írni mindkét mezőbe!';
                this.backgroundcolor = 'red';
            }
        }
    }
});