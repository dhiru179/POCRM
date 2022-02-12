<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Login</title>
  </head>
  <body>
    <div class="container utils_center">
      <div class="col-4 offset-4 border p-1 mt-5 ">
        <div class="alert alert-primary text-center" role="alert">
            Login
          </div>
        <form class="col-10 offset-1" action="{{ route('loginAuth') }}" method="post"
        enctype="multipart/form-data">
@csrf
        <div class="mb-3">
              <label for="exampleInput2" class="form-label">User</label>
              <input type="text" class="form-control" name="user" id="exampleInput2">
            </div>
            
              <div class="mb-3">
                <label for="exampleInput4" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="exampleInput4">
              </div>
             
              <div class="d-flex justify-content-end">
                <a href="" class="text-primary " style="text-decoration: none;display:inline-block">forget password</a>
              </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            @if(session()->has('error'))
            <div class="alert alert-success" role="alert">
                {{session('error')}}  
               
            </div> 
            @endif 
          </form>
      </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>