@extends('layout.main')

@section('navigation')

        <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">

                   <!Navbar Brand>
            <a class="navbar-brand" href="/">Inventory</a>

                  <!links>
            <ul class="navbar-nav">

                <li class="nav-item active"><a href=""class="nav-link">Home</a></li>
                

            </ul>

        </nav>
@endsection

@section('content')

<div class="container-fluid">

    <div class="leftpane">
        
    </div>

    <div align="center" class="rightpane">

            
               
                <h5>Login to your account</h5>
                <p id="msg1"></p>
                <form id="loginForm">
                    <input type="email" name="email" class="form-control-sm" placeholder="email.." required="required">
                    <input type="password" name="password" class="form-control-sm" placeholder="password.." required="required">

                    <button id="loginSubmit" type="submit" class="btn btn-primary btn-sm" style="margin-top: 5px">Login</button>
                </form>



            <br>
            <br>

        
                <h5>Create a new account</h5>
                <p id="msg"></p>
                <form id="signupForm">
                    <input type="text" name="name" class="form-control-sm" placeholder="name.." required="required">
                    <input type="email" name="email" class="form-control-sm" placeholder="email.." required="required">
                    <input type="password" name="password" class="form-control-sm" placeholder="password.." required="required">
                    <input type="password" name="repeat_password" class="form-control-sm"placeholder="Repeat-password.." required="required">
                    <button id="signupSubmit" type="submit" class="btn btn-primary btn-sm" style="margin-top: 5px">Signup</button>

                </form>     

    </div>

</div>

@endsection

@section('jquery')

    
<script type="text/javascript">

  // Request for storing information of a user

    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });
    
    $("#signupForm").on('submit',function(e)
    {   
        e.preventDefault();
        var data = $(this).serialize();

        $.ajax({

            type:'POST',
            url:'/store_user',
            data: data,
            success:function(result){

                if(result.msg == 'have')
                {
                    $("#msg").html('Already have an account !');
                }
                else if(result.msg == 'mismatch')
                {
                    $("#msg").html('Password mismatched !');
                }
                else
                {
                    $("#msg").html('Successfuly Created !');
                }
            },
            error:function()
            {
                alert(data);
            }
        });
    });


            $("#loginForm").on('submit',function(e){

                e.preventDefault();
                var data = $(this).serialize();

                $.ajax({

                    type:'POST',
                    url: '/check_user',
                    data:data,
                    success:function(result)
                    {
                        if(result.msg == 'incorrect')
                        {
                            $("#msg1").html('Incorrect email or password !');
                        }
                        else
                        {
                            //$("body").html(result.html);
                            window.location.href=result.href;

                        }
                    },
                    error:function()
                    {
                        alert(data);
                    }
                });
            });
</script>

@endsection