<div class="contact-form">
    @if(session('contactSuccess'))
        <div class="alert alert-success">
            <i class="ri-checkbox-circle-fill"></i>
            <p>{{ session('contactSuccess') }}</p>
            <button class="button button--primary" @click="$wire.reset()">
                Отправить новый запрос
            </button>
        </div>
    @else
        <form wire:submit.prevent="submit" class="modal__form">
            <div class="modal__form-field field">
                <div class="field__label">Имя</div>
                <input wire:model='name' type="text" class="field__text" placeholder="Иван" required>
            </div>
            <div class="modal__form-field field">
                <div class="field__label">Номер телефона</div>
                <input wire:model='phone' type="text" class="field__text" placeholder="8 (___) ___-__-__"
                       required>
            </div>
            <div class="modal__form-field field">
                <div class="field__label">Telegram</div>
                <input wire:model='telegram' type="text" class="field__text" placeholder="@username">
            </div>
            <div class="modal__form-field field">
                <div class="field__label">E-Mail</div>
                <input wire:model='email' type="email" class="field__text" placeholder="example@ex.com">
            </div>
            <div class="modal__form-field field">
                <div class="field__label">Сообщение</div>
                <textarea wire:model='message' class="field__text"></textarea>
            </div>
            <button class="modal__form-submit button button--primary">Отправить</button>
        </form>
    @endif
</div>
