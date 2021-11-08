@extends('layouts.app')

@section('heading')
    Start
@endsection

@section('content')
<form method="POST" class="grid md:grid-cols-2 gap-4">
    @csrf
    @error('from')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('to')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="mb-6">
        <label for="from" class="text-sm font-medium text-gray-900 block mb-2">Startdatum</label>
        <input type="date" 
            id="from" 
            name="from"
            value="1900-01-01"
            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" >
    </div>
    <div class="mb-6">
        <label for="to" class="text-sm font-medium text-gray-900 block mb-2">Enddatum</label>
        <input type="date" 
            id="to" 
            name="to"
            value="{{ date('Y-m-d'); }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" >
    </div>
    <button class="p-2 pl-5 pr-5 bg-blue-500 text-gray-100 text-lg rounded-lg focus:border-4 border-blue-300" type="submit">Abschicken</button>
</form>
     
@endsection