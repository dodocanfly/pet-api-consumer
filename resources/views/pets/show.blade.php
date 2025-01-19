@extends('layouts.app')

@section('content')
    <x-pet-form header="Show Pet" route="pets.show" method="GET" :categories="$categories" :tags="$tags"
                :statuses="$statuses" :pet="$pet" :disabled="true" />
@endsection
