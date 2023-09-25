<?php

    include('config/db_connect.php');

    $errors = array('email'=>'', 'title'=>'', 'ingredients'=>'');
    $email = $title = $ingredients = '';

    if(isset($_POST['submit'])) {
        if(empty($_POST['email'])) {
            $errors['email'] = 'Email is required';
        } else {
            $email = $_POST['email'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email must be valid email address';
            }
        }
        if(empty($_POST['title'])) {
            $errors['title'] = 'Title is required';
        } else {
            $title = $_POST['title'];
            if(!preg_match('/^[a-zA-Z\s]+$/', $title)) {
                $errors['title'] = 'Title must be letters and spaces only';
            }
        }
        if(empty($_POST['ingredients'])) {
            $errors['ingredients'] = 'Ingredients are required';
        } else {
            $ingredients = $_POST['ingredients'];
            if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
                $errors['ingredients'] = 'Ingredients must be comma separated list';
            }
        }

        if(array_filter($errors)) {

        } else {
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

            $sql = "INSERT INTO pizzas (title, email, ingredients) VALUES ('$title', '$email', '$ingredients')";

            if(mysqli_query($conn, $sql)) {
                header('Location: index.php');
            } else {
                echo "query error: " . mysqli_error($conn);
            }
        } 
    }

?>

<!DOCTYPE html>
<html lang="en">

<?php include('./templates/header.php'); ?>

    <section class="container grey-text">
        <h4 class="center">Add a Pizza</h4>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" class="white" method="POST">
            <label for="">Your Email:</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <div class="red-text"><?php echo $errors['email'];?></div>
            <label for="">Pizza Title:</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>">
            <div class="red-text"><?php echo $errors['title'];?></div>
            <label for="">Ingredients (comma separated):</label>
            <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients); ?>">
            <div class="red-text"><?php echo $errors['ingredients'];?></div>
            <div class="center">
                <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
            </div>
        </form>
    </section>

<?php include('./templates/footer.php'); ?>
   
</html>