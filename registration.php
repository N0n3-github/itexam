<?php
    require './config.php';
    $data = $_POST;
    $errors = array();
    $show_errors = false;

    if (isset($data['do_signup'])) {
        if (strpos($data['name'], ' ') !== false)
            $errors[] = 'Поле "Имя" не должно содержать пробелов';
        if (strpos($data['surname'], ' ') !== false)
            $errors[] = 'Поле "Фамилия" не должно содержать пробелов';
        if (strpos($data['username'], ' ') !== false)
            $errors[] = 'Поле "Логин" не должно содержать пробелов';
        if ($data['confirm_password'] != $data['password'])
            $errors[] = 'Пароли не совпадают';
        
        if (R::count('profiles', 'username = ?', array(strtolower($data['username']))) > 0)
            $errors[] = 'Пользователь с данным логином уже существует';
        if (empty($errors)) {
            $user = R::dispense('profiles');
            $user->name = mb_convert_case(mb_strtolower($data['name']), MB_CASE_TITLE, "UTF-8");
            $user->surname = mb_convert_case(mb_strtolower($data['surname']), MB_CASE_TITLE, "UTF-8");
            $user->grade = $data['grade'];
            $user->letter = $data['letter'];
            $user->username = mb_strtolower($data['username']);
            $user->password = $data['password'];
            $user->date = date("d.m.Y H:i:s");
            R::store($user);
            header('Location: ./');
        }
        else {
            $show_errors = true;
            echo '<script>window.location.href = "./registration.php#error"</script>';
        }
    }
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.5">
    <link rel="stylesheet" href="src/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="src/css/registration.css">
    <script src="src/js/validate.js"></script>
    <title>IT Exam</title>
</head>
<body>
    <div class="container">
        <h1>Регистрация</h1>
        <form action="./registration.php" method="POST">
            <div class="input-container">
                <input id="name" type="text" class="form-control input" name="name" placeholder="Имя" required value="<?php if (strpos(@$data['name'], ' ') == false) echo @$data['name']?>">
            </div>
            <div class="input-container">
                <input id="surname" type="text" class="form-control input" name="surname" placeholder="Фамилия" required value="<?php if (strpos(@$data['surname'], ' ') == false) echo @$data['surname']?>">
            </div>
            <font class="grade-txt">Класс:</font>
            <select class="grade" name="grade" required>
                <option></option>
                <option value="11"
                <?php if(isset($data['grade']) && $data['grade'] == '11') 
                          echo ' selected="selected"';
                ?>>11</option>
                <option value="10"
                <?php if(isset($data['grade']) && $data['grade'] == '10') 
                          echo ' selected="selected"';
                ?>>10</option>
                <option value="9"
                <?php if(isset($data['grade']) && $data['grade'] == '9') 
                          echo ' selected="selected"';
                ?>>9</option>
                <option value="8"
                <?php if(isset($data['grade']) && $data['grade'] == '8') 
                          echo ' selected="selected"';
                ?>>8</option>
            </select>
            <select class="letter" name="letter" required>
                <option></option>
                <option value="А"
                <?php if(isset($data['letter']) && $data['letter'] == 'А') 
                          echo ' selected="selected"';
                ?>>А</option>
                <option value="Б"
                <?php if(isset($data['letter']) && $data['letter'] == 'Б') 
                          echo ' selected="selected"';
                ?>>Б</option>
                <option value="В"
                <?php if(isset($data['letter']) && $data['letter'] == 'В') 
                          echo ' selected="selected"';
                ?>>В</option>
                <option value="Г"
                <?php if(isset($data['letter']) && $data['letter'] == 'Г') 
                          echo ' selected="selected"';
                ?>>Г</option>
                <option value="Д"
                <?php if(isset($data['letter']) && $data['letter'] == 'Д') 
                          echo ' selected="selected"';
                ?>>Д</option>
                <option value="Е"
                <?php if(isset($data['letter']) && $data['letter'] == 'Е') 
                          echo ' selected="selected"';
                ?>>Е</option>
            </select>
            <div class="input-container">
                <input id="username"  type="text" class="form-control input" name="username" placeholder="Имя пользователя" required value="<?php if (strpos(@$data['username'], ' ') == false) echo @$data['username']?>">
            </div>
            <div class="input-container">
                <input id="password" type="password" class="form-control input" name="password" placeholder="Пароль" required value="<?php if (strpos(@$data['password'], ' ') == false) echo @$data['password']?>">
            </div>
            <div class="input-container">
                <input id="confirm_password" type="password" class="form-control input" name="confirm_password" placeholder="Повторный пароль" required value="<?php if (@$data['confirm_password'] == @$data['password']) echo @$data['password']?>">
            </div>
            <div class="button-container">
                <button type="submit" class="btn btn-primary form-control button" name="do_signup" onclick="return Validate_form();">Зарегистрироваться</button>
            </div>
        </form>
        <?php 
            if ($show_errors)
                echo '<h1 id="error">'.array_shift($errors).'</h1>';
        ?>
    </div>
</body>
</html>
