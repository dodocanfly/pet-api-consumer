@extends('layouts.app')

@section('content')
    <x-pet-form header="Edit Pet" route="pets.update" method="PUT" :categories="$categories" :tags="$tags"
                :statuses="$statuses" :pet="$pet" />
@endsection
