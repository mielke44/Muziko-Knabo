@extends('layouts.vuetify-default')

@section('vuetify-app-content')

<v-content>
    @yield('l-content')
</v-content>
<v-footer color="primary">
    @yield('l-footer')
</v-footer>
@endsection
