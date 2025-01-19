<div class="d-grid gap-2 mb-3">
    <a href="{{ route('pets.create') }}" class="btn btn-success">Create</a>
</div>
<div class="input-group mb-3">
    <span class="input-group-text">Pet ID</span>
    <input type="text" class="form-control" id="petId" placeholder="e.g. 666">
    <button class="btn btn-primary w-25" type="button" onclick="gotoPetRoute('show')">Show</button>
    <button class="btn btn-warning w-25" type="button" onclick="gotoPetRoute('edit')">Edit</button>
    <button class="btn btn-danger w-25" type="button" onclick="gotoPetRoute('delete')">Delete</button>
</div>

<script>
    function gotoPetRoute(route) {
        const petId = document.getElementById('petId').value;
        let link = '';
        switch (route) {
            case 'edit': link = '{{ route('pets.edit', 'petId') }}'; break;
            case 'delete': link = '{{ route('pets.delete', 'petId') }}'; break;
            default: link = '{{ route('pets.show', 'petId') }}';
        }
        window.location.href = link.replace('petId', petId);
    }
</script>
