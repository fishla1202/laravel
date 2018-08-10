 <nav class="navbar navbar-light bg-light navbar-expand-md">
    <!-- Brand and toggle get grouped for better mobile display -->
    <button type="button" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span>
    </button> 
    <a class="navbar-brand" href="#">Laravel Answers</a>
    <!-- Collect the nav links, forms, and other
    content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li class="active nav-item"><a href="{{ route('index') }}" class="nav-link">Home</a>
            </li>
            <li class="nav-item"><a href="#" class="nav-link">Recent</a>
            </li>
            <li class="nav-item"><a href="#" class="nav-link">Popular</a>
            </li>
        </ul>
        <ul class="nav navbar-nav ml-auto"> <a href="#" class="btn btn-primary" style="margin-top:5px;">Ask A Question</a>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
    <!-- /.container-fluid -->
</nav>