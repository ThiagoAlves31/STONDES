<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    
    <title>@yield('title')</title>     
</head>
<body>
<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark justify-content-center">
        <ul class="nav justify-content-center">
          <li class="nav-item">
            <a class="nav-link" href="/">Produtos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/contacts">Contatos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Empréstimos</a>
          </li>
        </ul>
    </nav>
</header>
<style>
    header {
      padding: 12px;
      font-size: 16px;
      margin-bottom: 70px;
    }
    .nav-link{
        color:white
    }
</style>
