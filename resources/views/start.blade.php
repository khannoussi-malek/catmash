@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <h1>Welcome to my website!</h1>
    <p>This is the home page.</p>
    <h2>Cat {{ $firstCat->id }}</h2>
    <a href="/{{ $firstCat->id }}/{{ $secondCat->id }}">
    <img src="{{ $firstCat->url }}" alt="{{ $firstCat->name }}">
    </a>
    <p>{{ $firstCat->name }}</p>

    <h2>Cat {{ $secondCat->id }}</h2>
    <a href="/{{ $secondCat->id }}/{{ $firstCat->id }}">
    <img src="{{ $secondCat->url }}" alt="{{ $secondCat->name }}">
    </a>
    <p>{{ $secondCat->name }}</p>
@endsection
