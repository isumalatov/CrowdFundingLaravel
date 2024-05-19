<!-- resources/views/dashboard.blade.php -->
<!DOCTYPE html>
@extends('layouts.app')
<html>
<head>
    <title>Dashboard</title>
@section('content')
</head>
<body>
    <h1>Hola de nuevo {{Auth::user()->name}}</h1>
</body>
</html>
@endsection