@extends('layouts.admin')

@section('title', 'Edit ' . $program->title . ' — GIEC Staff Admin')
@section('page_title', 'Edit Program: ' . $program->title)
@section('page_subtitle', 'Update curriculum modules, study formats, and student package tiers.')

@section('header_actions')
    <a href="{{ route('admin.programs.index') }}" class="text-sm font-semibold text-slate-600 hover:text-navy-900">
        &larr; Back to Programs
    </a>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.programs.update', $program) }}">
        @csrf
        @method('PUT')
        @include('admin.programs.form')
    </form>
@endsection
