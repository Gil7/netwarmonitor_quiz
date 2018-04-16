@extends("layouts.app")

@section("content")
    <div class="col-xs-12 col-md-offset-3 col-md-6" style="margin-top:15px;"> 
        <p class="lead">
            <i class="fa fa-user"></i>
            Gilberto Méndez Sántiz
        </p>
        <p class="lead">
            <i class="fa fa-envelope"></i>
            <a href="">gilberto.mendez.santiz@gmail.com</a>
            
        </p>
        <p class="lead">
            <i class="fa fa-phone"></i>
            (961)-322-56-96
        </p>
        <br>
        <a href="https://github.com/gil7"><i class="fa fa-code"></i> Ver código fuente de proyecto</a>
        <br>
        <a class="btn btn-success white-text"><i class="fa fa-eye"></i> Ver proyectos extras</a>
    </div>
@endsection
@section('extra-js')
    <script src="/js/about.js"></script>
@endsection

