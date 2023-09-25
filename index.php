<?php

    include('config/db_connect.php');

    $sql = 'SELECT title, ingredients, id FROM pizzas ORDER BY created_at DESC';

    $result = mysqli_query($conn, $sql);

    $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);

    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<?php include('./templates/header.php'); ?>

     
     <div class="container">
        <div class="row">
            <?php if($pizzas): ?>
                <h4 class="center grey-text">Pizzas</h4>
                <?php foreach($pizzas as $pizza): ?>
                    
                    <div class="col s6 md3">
                        <div class="card z-depth-0">
                            <div class="card-content center">
                                <h4><?php echo htmlspecialchars($pizza['title']); ?></h4>
                                <ul>
                                    <?php foreach(explode(',', htmlspecialchars($pizza['ingredients'])) as $ingredient): ?>
                                        <li><?php echo $ingredient; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="card-action right-align">
                                <a href="detail.php?id=<?php echo $pizza['id']?>" class="brand-text">more info</a>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            <?php else: ?>
                <h3 class="center grey-text">You have no pizzas yet!!!!!!!!</h3>
            <?php endif; ?>
        </div>
     </div>

<?php include('./templates/footer.php'); ?>
   

</html>