<div class="modal modal--callback-product" id="modal-callback-product" wire:ignore.self
    data-modal-path="modal-callback-product">
    <div class="modal__overlay">
        <div class="modal__wrapper">
            <button class="modal__close-btn" data-modal-close><i class="ri-close-line"></i></button>
            <div class="modal__header">
                <div class="modal__header-label h4">Купить в 1 клик</div>
            </div>
            <div class="modal__body">
                @if(session()->has('orderSuccess'))
                    <div class="alert alert-success">
                        {{ session('orderSuccess') }}
                    </div>
                @endif
                <form wire:submit.prevent="submit" class="modal__form">
                    <input type="hidden" wire:model="product_name">
                    <input type="hidden" wire:model="product_url">
                    <div class="modal__form-field field">
                        <div class="field__label">Имя</div>
                        <input wire:model.defer='name' type="text" class="field__text" placeholder="Иван" required>
                    </div>
                    <div class="modal__form-field field">
                        <div class="field__label">Номер телефона</div>
                        <input wire:model.defer='phone' type="text" class="field__text" placeholder="8 (___) ___-__-__"
                            required>
                    </div>
                    <div class="modal__form-field field">
                        <div class="field__label">Telegram</div>
                        <input wire:model.defer='telegram' type="text" class="field__text" placeholder="@username">
                    </div>
                    <div class="modal__form-field field">
                        <div class="field__label">E-Mail</div>
                        <input wire:model.defer='email' type="email" class="field__text" placeholder="example@ex.com">
                    </div>
                    <button class="modal__form-submit button button--primary">Отправить</button>
                </form>
            </div>
        </div>
    </div>
</div>