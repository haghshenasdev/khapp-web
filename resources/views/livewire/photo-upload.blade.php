<div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    @if ($photo)
                        پیش نمایش تصویر جدید:
                        <img class="img-fluid my-3" src="{{ $photo->temporaryUrl() }}">
                    @endif
                    <div wire:loading wire:target="photo">
                        <div class="d-flex align-items-center mt-2">
                            <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
                        </div>
                    </div>
                    <p>آپلود جدید :</p>
                    <input type="file" class="form-control" wire:model="photo"/>
                    @error('photo') <span class="text-danger">{{ $message }}</span> @enderror

                    @if ($urlphoto)
                        پیش نمایش تصویر جدید:
                        <img class="img-fluid my-3" src="{{ $urlphoto }}">
                    @endif
                    <div wire:loading wire:target="urlphotoPreview">
                        <div class="d-flex align-items-center mt-2">
                            <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
                        </div>
                    </div>
                    <p>از آدرس اینترنتی :</p>
                    <div class="row">
                        <div class="col"><input type="text" class="form-control" wire:model="url"/></div>
                        <div class="col-auto"><button type="button" wire:click="urlphotoPreview()" class="btn btn-primary">پیش نمایش تصویر</button></div>
                    </div>
                    @error('url') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
                    <button type="button" class="btn btn-primary" wire:click="add()">افزودن</button>
                </div>
            </div>
        </div>
    </div>


</div>
