@extends('layouts.admin')

@section('title', 'Create Program — GIEC Staff Admin')
@section('page_title', 'Create New Program & Student Packages')
@section('page_subtitle', 'Add curriculum modules, entry requirements, and student package tiers.')

@section('header_actions')
    <a href="{{ route('admin.programs.index') }}" class="text-sm font-semibold text-slate-600 hover:text-navy-900">
        &larr; Back to Programs
    </a>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.programs.store') }}">
        @csrf
        @include('admin.programs.form')
    </form>
@endsection
