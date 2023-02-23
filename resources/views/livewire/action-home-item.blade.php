<div>
    <select name="action" class="form-select">
        @foreach($hiActionlist as $classname => $hiAction)
            <option  wire:click="select('{{$classname}}')" value="{{$classname}}" title="{{ $hiAction }}" @if($selected == $classname) selected @endif>
                {{ $hiAction }}
            </option>
        @endforeach
    </select>

    <div class="card mt-3 p-3">
        <div class="mt-3 w-100 text-center" wire:loading>
            <div class="align-items-center">
                <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
            </div>
        </div>

        @if(!is_null($params))
            @foreach($params as $key => $param)
                <div class="mb-3">
                    <label for="title" class="col-form-label">{{ __($key) }} :</label>
                    <input name="hi-prop-{{$key}}" type="text" class="form-control" id="title"   @isset($selectedData[$key]) value="{{$selectedData[$key]}}" @endisset>
                </div>
            @endforeach
        @endif
    </div>
</div>
