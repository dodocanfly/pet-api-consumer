@extends('layouts.app')

@section('content')
    <x-pet-form header="Delete Pet" route="pets.destroy" method="DELETE" :categories="$categories" :tags="$tags"
                :statuses="$statuses" :pet="$pet" :disabled="true" />
@endsection
