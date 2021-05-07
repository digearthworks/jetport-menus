@extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __(isset($exception)?$exception->getMessage() : __('Unauthorized')))
