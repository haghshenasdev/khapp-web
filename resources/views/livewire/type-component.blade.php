<div>
    <select name="type" class="form-select" aria-label="Default select example">
        @foreach($types as $type)
            <option title="{{ $type->description }}"
                    wire:click="showSub({{ $type }},'{{ $type->optional_sub_select }}')" value="{{$type->id}}"
                    @if(!is_null($mainType) && $type->id === $mainType) selected @elseif(is_null($mainType) and $type->default) selected @endif>
                {{$type->title}}
            </option>
        @endforeach
    </select>

    @if($description != null)
        <p class="mt-2">{{ $description }}</p>
    @endif

    @if($subTypes != null && count($subTypes) > 0)
        <select name="subType" class="form-select mt-2" aria-label="Default select example">
            @if($optional_sub_select)
                <option value="0" wire:click="selectOther">
                    همه موارد زیر مجموعه
                </option>
            @endif

            @foreach($subTypes as $subType)
                <option wire:click="subSelect({{ $subType }})" title="{{ $subType->description }}"
                        value="{{$subType->id}}"
                        @if(!is_null($subTypeId) && $subType->id === $subTypeId) selected @elseif(is_null($subTypeId) and $subType->default) selected @endif>
                    {{$subType->title}}
                </option>
            @endforeach
        </select>

        @if($subDescription != null)
            <p class="mt-2">توضیحات : {{ $subDescription }}</p>
        @endif
    @endif

    <div class="mt-3" wire:loading>
            <div class="d-flex align-items-center">
                <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
            </div>
    </div>
</div>
