<div>
    @if($image)
        <img class="img-fluid mb-3 bg-gray-300" src="{{ $image }}"/>
    @endif

    <div class="row">
        <div class="col">
            <input type="text" dir="ltr" class="form-control" name="image"
                  wire:model="url" />
        </div>
        <div class="col-auto">
            <button type="button" class="btn btn-outline-primary" wire:click="show">
                پیش نمایش تصویر
            </button>
        </div>
    </div>

        <div class="mt-3" wire:loading>
            <div class="d-flex align-items-center">
                <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
            </div>
        </div>
</div>
