<div class="card">
    <div class="card-header">{{ $header }}</div>
    <div class="card-body">
        <form action="{{ route($route, $pet?->id) }}" method="POST">
            @csrf
            @method($method)
            <fieldset @if($disabled ?? false) disabled @endif>
                @if(!empty($pet?->id))
                    <x-forms.input type="number" name="id" label="Id" placeholder="e.g. 666" :value="$pet?->id" :readonly="true"/>
                @endif
                <x-forms.input name="name" label="Name" placeholder="e.g. doggie" :value="$pet?->name"/>
                <x-forms.select name="category" label="Category" :items="$categories" :current-value="$pet?->category?->id"/>
                <x-forms.textarea name="photoUrls" label="Photo URLs" placeholder="e.g. https://img.com/photo.jpg" rows="3" :value="$pet?->photoUrlsString()"/>
                <x-forms.select-multi name="tags" label="Tags" :items="$tags" size="5" :current-value="$pet?->tagsIds()"/>
                <x-forms.select name="status" label="Status" :items="$statuses" :current-value="$pet?->status"/>
            </fieldset>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
