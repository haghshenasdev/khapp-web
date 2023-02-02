<div>
    <input type="text" class="form-control" id="amount"
           wire:model="amountFormat">
    <input type="hidden" name="amount" wire:model="amount">
    @error('amount') <span class="error">{{ $message }}</span> @enderror

    <div wire:loading>
        <div class="d-flex align-items-center mt-2">
            <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
        </div>
    </div>
</div>
