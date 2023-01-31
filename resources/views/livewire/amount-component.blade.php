<div>
    <input name="amount" type="text" class="form-control" id="amount"
           wire:model="amount">
    @error('amount') <span class="error">{{ $message }}</span> @enderror
</div>
