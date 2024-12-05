import './bootstrap';

import * as bootstrap from 'bootstrap';

import {Modal} from 'bootstrap';

document.addEventListener("DOMContentLoaded", function() {

    let modalsElement = document.getElementById('livewire-bootstrap-modal');

    modalsElement.addEventListener('hidden.bs.modal', () => {
        Livewire.dispatch('resetModal');
    });

    Livewire.on('showBootstrapModal', (e) => {
        let modal = Modal.getOrCreateInstance(modalsElement);
        modal.show();
    });

    Livewire.on('hideModal', () => {
        let modal = Modal.getInstance(modalsElement);
        modal.hide();
        Livewire.dispatch('resetModal');
    });

});

