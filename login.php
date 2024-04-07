<!DOCTYPE html>
<?php
include "../conn/koneksi.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
    function onSubmit(token) {
        document.getElementById("demo-form").submit();
    }
 </script>
    <title>Log In</title>
    <?php
    $rand = rand(9999,1000);
    ?>
    <style>
        .captca{
            width: 100px;
            background: yellow;
            text-align:center;
            font: size 24px, weight: 700px;

        }
        </style>
</head>
<body>
    <div class="container">
            <h1>Login</h1>
                <form method="POST" action="../process/loginprocess.php">
                    <!-- tipe hidden tidak akan tampil pada website --> 
                    <input name="tujuan" type="hidden" value="login" >
                    <label>Email</label>
                    <br>
                    <input name="email" type="text" placeholder="Masukan Email">
                    <br>
                    <label>Password</label>
                    <br>
                    <input name="password" type="password" placeholder="Masukan Password">
                    <br>
                    <label for="captca-code">Recaptcha</label>
                    <div class="captca">
                        <?php
                        echo $rand;
                        ?>
                    </div>
                    <input name="captca" id="captca" placeholder="Masukan Captca"
                    require data-parsley-trigger="keyup" class="form-control">
                    <input type="hidden" name="captca-rand" value="<?php echo $rand;?>">
                </input>
                    <br>
                    <br>
                    <button>Log In</button>
                    <p>Belum punya akun?
                    <a href="../signup/signup.php">Daftar di sini</a></br>
                </form>
            </div>
</body>
</html>