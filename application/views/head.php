<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="/static/css/style.css" media="all">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Complatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <Style>
    @import url(//fonts.googleapis.com/earlyaccess/nanumpenscript.css);
    @import url(http://fonts.googleapis.com/earlyaccess/jejuhallasan.css);
    @import url(http://fonts.googleapis.com/earlyaccess/hanna.css);
    @import url('https://fonts.googleapis.com/css?family=Numans');
    </style>
  </head>

  <body>
    <nav class="navbar transparent navbar-inverse fixed-top" id="nav1">
      <h6 style="color:#4A0112;font-weight:800;margin-left:20px;">FM2019 안양정보</h6>
      <ul>
        <a class="nav-link" href="/index.php/fm">Home</a>

        <?php
        if ($this->session->userdata('is_login') == true) {
        ?>

          <p><?php echo $this->session->userdata('email')?>님 환영합니다.</p>
            <a class="nav-link" href="/index.php/auth/logout">로그아웃</a>
        <?php
        } else {
        ?>
            <a class="nav-link" href="/index.php/auth/register">회원가입</a>
            <a class="nav-link" href="/index.php/auth/login">로그인</a>
        <?php
        }
        ?>
      </ul>
    </nav>
