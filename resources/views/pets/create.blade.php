@extends('layouts.app')

@section('content')
    <x-pet-form header="Create Pet" route="pets.store" method="POST" :categories="$categories" :tags="$tags"
                :statuses="$statuses" :pet="null"/>
@endsection
