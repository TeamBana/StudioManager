<link href="/assets/css/login.css" rel="stylesheet" type="text/css" />
<div class="container-fluid">
    <div class="row" id="error">
        <?php
        $error = 0;

        if(isset($_GET['error']))
            $error = htmlspecialchars($_GET["error"]);

        if($error == 1)
        {
            bootAlert("<strong>Login Failed!</strong> Invalid Username or Password", 'danger');
        }
        $logout = 0;

        if(isset($_GET['l']))
            $logout = htmlspecialchars($_GET["l"]);

        if($logout == 1)
        {
            //error_reporting(0);
            if(session_start())
                session_destroy();
            bootAlert("<strong>Logout Sucessful!</strong>", 'success');
            error_reporting(E_NOTICE);
        }

        ?>
    </div>

    <div class="row clearfix">
        <div class="col-md-12 column">

            <form class="form-horizontal" name="loginform" id="login" method="post" action="connect.php">
                <div id="wrapper">
                    <table>
                        <p align="center" id="caption">Chikuvi Studio</p>
                        <tr>
                            <div <?php if(isset($_GET['error']) && $_GET['error']==1) echo '
                                class="form-group has-error has-feedback"';?>>
                                <div class="input-group margin-bottom-sm" id="title">
                                    <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                    <input class="form-control" type="text" placeholder="Username" id="username" name="user" required>
                                </div>
                            </div>
                        </tr>
                        <tr>
                            <div <?php if(isset($_GET['error']) && $_GET['error']==1) echo '
                                class="form-group has-error has-feedback"';?>>
                                <div class="input-group" id="title">
                                    <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                    <input class="form-control" type="password" placeholder="Password" id="passwd" name="pass" required>
                                </div>
                            </div>
                        <tr>
                            <td id="smallTitle">
                                Forgot username / password? <br/>
                                <a href="forgottenAccount.html">click here</a>
                            </td>
                            <td><input class="btn btn-success" type="submit" name="login" value="Login" id="loginButtonStyle"/></td>
                        </tr>
                    </table>
                </form>
                </div>
            </form>
        </div>
    </div>
</div>