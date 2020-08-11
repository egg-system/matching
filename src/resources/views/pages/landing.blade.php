@extends('templates.landing-page')

@section('content')
    <landing-page-first-view></landing-page-first-view>
    <landing-page-descriptions></landing-page-descriptions>
    <landing-page-questions></landing-page-questions>
    <landing-page-conversion></landing-page-conversion>
@endsection

@push('scripts')
    {{-- Twitterのシェアボタンに必要になる --}}
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
@endpush
