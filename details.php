<?php
    // Including the DB configuration
    include('config/db_config.php');
    
    $pizza = [];

    $error = '';

    if(isset($_POST['delete'])){
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

        // Now we query
        $sql = "DELETE FROM pizzas WHERE id = $id_to_delete";

        if(mysqli_query($conn, $sql)){
            header("Location: index.php");
        }
        else{
            echo "Query Error : " . mysqli_error($conn);
        }

    }


    // check id parameter from get request
    if(isset($_GET['id'])){

        $id = mysqli_real_escape_string($conn, $_GET['id']);

        // Now we query
        $sql = "SELECT * FROM pizzas WHERE id = $id";

        // Get the Query Result
        $result = mysqli_query($conn, $sql);

        // Fetch result in array format
        $pizza = mysqli_fetch_assoc($result);

        mysqli_free_result($result);

        mysqli_close($conn);

    }
    else{
        $error = "Invalid Request";
    }

?>
<html lang="en">
    <?php  include('templates/header.php'); ?>
    
    <div class="container center">
        <?php if($pizza) : ?>
            <h4><?php echo htmlspecialchars($pizza['title']);?></h4>
            <p>Created By : <?php echo htmlspecialchars($pizza['email']);?></p>
            <p><?php echo date($pizza['created_at']);?></p>
            <h5>Ingredients</h5>
            <p><?php echo htmlspecialchars($pizza['ingredients']);?></p>

            <!-- Form to delete the pizza -->
            <form action="details.php" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id'];?>">
                <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
            </form>

        <?php else : ?>
           <?php if(strlen($error)>0) :?>
            <h4><? echo $error ?></h4>
            <?php else : ?>
                <h4>No Such Pizza Exists!</h4>
            <?php endif ; ?>
            
        <?php endif ; ?>

    </div>

    <?php  include('templates/footer.php'); ?>
</html>